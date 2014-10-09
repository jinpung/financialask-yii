<?php

class ProfileController extends FrontController {

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('view'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('recommendation', 'update', 'follow', 'award', 'education', 'publication', 'changephoto', 'Updateprofile'),
                'users' => array('@'),
            ),
            array(
                'allow',
                'actions' => array('rate', 'calls'),
                'users' => array('@'),
                'expression' => function() {
            $userModel = Yii::app()->user->userModel;
            return (isset($userModel) && $userModel->userTypeID == User::TYPE_ADVISER);
        }
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionEducation() {
        $model = new Education();
        $model->attributes = $_POST['Education'];
        $model->adviserId = Yii::app()->user->userModel->adviserProfile->id;
        if ($model->save())
            $this->renderPartial('_educationList', array('data' => Yii::app()->user->userModel->adviserProfile));
        Yii::app()->end();
    }

    public function actionAward() {
        $model = new Award();
        $model->attributes = $_POST['Award'];
        $model->adviserId = Yii::app()->user->userModel->adviserProfile->id;
        if ($model->save())
            $this->renderPartial('_awardList', array('data' => Yii::app()->user->userModel->adviserProfile));
        Yii::app()->end();
    }

    public function actionPublication() {
        $model = new Publication();
        $model->attributes = $_POST['Publication'];
        $model->adviserId = Yii::app()->user->userModel->adviserProfile->id;
        if ($model->save())
            $this->renderPartial('_publicationList', array('data' => Yii::app()->user->userModel->adviserProfile));
        Yii::app()->end();
    }

    public function actionUpdate() {

        $user = User::model()->with('adviserProfile')->findByPk(Yii::app()->user->id);
        if (!$user)
            throw new CHttpException('404', 'User not found');
        $savedSpecialties = Adviser::model()->with('specialties')->findByPk($user->adviserProfile->id)->specialties;
        $specialtyList = Specialties::getList();
        
        /* ----------Get Feed------------------------ */
            $criteria = new CDbCriteria();
            $criteria->addColumnCondition(array('t.userId' => Yii::app()->user->id));
            $dataProvider = new CActiveDataProvider('QuestionResponse', array('criteria' => $criteria));
            $feeddata = $dataProvider->getData();
        /* -----------Get Agresor----------------------- */
            
            $criteria = new CDbCriteria();
            $criteria->order = 'RAND()';
            $criteria->alias  = 'adviser';
            $subQuery = "SELECT adviserId FROM  QuestionAgree as T1 Inner JOIN QuestionResponses as T2 On T1.responseID = T2.id WHERE T2.userId='".Yii::app()->user->id."'";
            $criteria->condition = "adviser.id IN ({$subQuery})";
            $agreers = Adviser::model()->with('user','specialties')->findAll($criteria);
        /* ----------------------------------- */
        
        $this->render('update', compact('user', 'savedSpecialties', 'specialtyList','feeddata','agreers'));
    }

    public function actionView($id) {
        $user = User::model()->with('adviserProfile')->findByPk($id);
        if (!$user)
            throw new CHttpException('404', 'User not found');
        $savedSpecialties = Adviser::model()->with('specialties')->findByPk($user->adviserProfile->id)->specialties;
        $specialtyList = Specialties::getList();

        /* ----------Get Feed------------------------ */
            $criteria = new CDbCriteria();
            $criteria->addColumnCondition(array('t.userId' => $user->id));
            $dataProvider = new CActiveDataProvider('QuestionResponse', array('criteria' => $criteria));
            $feeddata = $dataProvider->getData();
        /* -----------Get Agresor----------------------- */
            
            $criteria = new CDbCriteria();
            $criteria->order = 'RAND()';
            $criteria->alias  = 'adviser';
            $subQuery = "SELECT adviserId FROM  QuestionAgree as T1 Inner JOIN QuestionResponses as T2 On T1.responseID = T2.id WHERE T2.userId='".$user->id."'";
            $criteria->condition = "adviser.id IN ({$subQuery})";
            $agreers = Adviser::model()->with('user','specialties')->findAll($criteria);
        /* ----------------------------------- */
        $this->render('view', compact('user', 'savedSpecialties', 'specialtyList','feeddata','agreers'));
    }

    public function actionFollow($id) {
        $advAtts = array('userId' => $id);
        $adviser = Adviser::model()->findByAttributes($advAtts);
        if (!$adviser)
            throw new CHttpException('404', 'User not found');

        // if relation already exists
        $relExistAtts = array('adviserID' => $adviser->id, 'userID' => Yii::app()->user->id);
        $currentRelation = AdviceRelation::model()->findByAttributes($relExistAtts);
        if ($currentRelation) {
            $currentRelation->deleteAllByAttributes($relExistAtts);
            echo CJSON::encode(array('result' => 'deleted'));
            return;
        }
        $relation = new AdviceRelation();
        $relation->adviserID = $adviser->id;
        $relation->userID = Yii::app()->user->id;
        if ($relation->validate() && $relation->save()) {
            echo CJSON::encode(array('result' => 'success'));
        } else
            throw new CHttpException('500', 'Error following adviser');
    }

    public function actionRecommendation() {
        $model = new Recommendation();
        $model->authorId = Yii::app()->user->userModel->id; //adviserProfile->id;

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'recommendation-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['Recommendation'])) {
            $model->attributes = $_POST['Recommendation'];
            if ($model->save())
                echo CJSON::encode(true);
        }
    }

    public function actionRate($value) {
        /** @var  $adviser Adviser */
        $adviser = Yii::app()->user->userModel->adviserProfile;
        $adviser->rate = $value;
        echo CJSON::encode($adviser->save() ? array(
                    'status' => true,
                    'value' => $adviser->rate
                        ) : array(
                    'status' => false,
                    'value' => $adviser->getError('rate')
        ));
        Yii::app()->end();
    }

    public function actionCalls($value) {
        /** @var  $adviser Adviser */
        $adviser = Yii::app()->user->userModel->adviserProfile;
        $adviser->directCalls = $value;
        $adviser->save();
        $data = $adviser->getStatusList();
        echo $data[$adviser->directCalls];
        Yii::app()->end();
    }

    public function actionChangephoto() {
        if (sizeof($_FILES) == 0) {
            echo CJSON::encode(array('status' => 'nofiles', 'message' => 'Only images are allowed'));
            die();
        }
        $file = CUploadedFile::getInstanceByName('phpto');
        if (isset($file)) {
            if (in_array(strtolower($file->getExtensionName()), array('jpeg', 'jpg', 'png', 'bmp'))) {
                $avatarUrl = '/images/avatars/' . md5(time()) . '.' . $file->getExtensionName();
                $fileName = Yii::app()->basePath . '/..' . $avatarUrl;
                if ($file->saveAs($fileName)) {
                    $model = User::model()->findByPk(Yii::app()->user->userModel->id);
                    $model->avatarUrl = $avatarUrl;
                    $model->save();
                }
                echo CJSON::encode(array('status' => 'ok', 'message' => '', 'filename' => $avatarUrl));
            } else {
                echo CJSON::encode(array('status' => 'error', 'message' => 'Only images are allowed'));
            }
        }
        Yii::app()->end();
    }

    public function actionUpdateprofile() {

        $userModel = User::model()->with('adviserProfile')->findByPk(Yii::app()->user->userModel->id);
        $adviserModel = $userModel->adviserProfile;

        $adviserId = $adviserModel->id;

        $data = $_POST;
        
        
        $colums = User::model()->getMetaData()->columns;
        foreach($colums as $columName => $columInfo){
            if(isset($_POST[$columName])){
                $userModel->$columName = $_POST[$columName];
            }
        }        
        if (!$userModel->save()) {
            var_dump($userModel->getErrors());
            die("USER Change Error");
            return false;
        }

        //$adviserModel->attributes = $data;
        
        $colums = Adviser::model()->getMetaData()->columns;
        foreach($colums as $columName => $columInfo){
            if(isset($_POST[$columName])){
                $adviserModel->$columName = $_POST[$columName];
            }
        }
        
        if (!$adviserModel->save()) {
            var_dump($adviserModel->getErrors());
            die("Adviser Change Error");
            return false;
        }

        if (isset($data['specializelist'])) {
            $relExistAtts = array('adviserId' => $adviserId);
            $currentRelation = Specialties::model()->findByAttributes($relExistAtts);
            if ($currentRelation) {
                $currentRelation->deleteAllByAttributes($relExistAtts);
            }
            $list = explode(',', $data['specializelist']);
            foreach ($list as $spcId) {
                if ($spcId) {
                    $relation = new Specialties();
                    $relation->adviserId = $adviserId;
                    $relation->specId = $spcId;
                    $relation->save();
                }
            }
        }
        echo "OK";
        Yii::app()->end();
    }

}
