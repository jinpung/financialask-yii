<?php

class AdviserController extends FrontController {

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
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
                'actions' => array('index', 'getadvisers', 'search', 'advancedsearch', 'talk'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('my', 'rate'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionMy() {
        $this->render('my', array('advisers' => Yii::app()->user->userModel->advisersList));
    }

    public function actionTalk() {
        $model = new AdviserSearchForm();
        $model->unsetAttributes();  // clear any default values
        $model->online = 1; // we need online online advisers
        if (isset($_POST['AdviserSearchForm'])) {
            $model->attributes = $_POST['AdviserSearchForm'];
            $model->validate();
        }


        $this->render('talk', array(
            'model' => $model,
        ));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $this->render('index');
    }

    public function actionGetadvisers() {
        $reqParams = $_GET;
        $criteria = new CDbCriteria();
        if ($_GET['category'] == 'suggest') {
            $criteria->order = 'RAND()';
            $criteria->limit = 5;
            $criteria->offset = 0;
            $criteria->condition = "1";
            $criteria->alias = 'adviser';
            //featured job
            $subQuery = "SELECT adviserId FROM AdviserFeatured WHERE 1";
            $criteria->condition .= " AND adviser.id IN ({$subQuery})";
        } else if ($_GET['category'] == 'search') {
            $criteria->limit = $reqParams['limit'];
            $criteria->offset = $reqParams['offset'];
            $criteria->condition = "1";
            $criteria->alias = 'adviser';
            $criteria->join = "INNER JOIN Users as user  ON adviser.userId=user.id";

            if (!empty($reqParams['searchword'])) {
                $where = "user.name LIKE '%{$reqParams['searchword']}%'";
                $criteria->condition .= " AND ({$where})";
            }
            if (!empty($reqParams['location'])) {
                $criteria->condition .= " AND (adviser.address LIKE '%{$reqParams['location']}%' OR user.suburb LIKE '%{$reqParams['location']}%')";
            }
            if (!empty($reqParams['specialty'])) {
                $criteria->condition .= " AND adviser.id IN (SELECT DISTINCT(adviserId) FROM Specialties WHERE specId='{$reqParams['specialty']}')";
            }
            if (isset($reqParams['gender'])) {
                $criteria->condition .= " AND user.gender='{$reqParams['gender']}'";
            }
            if (!empty($reqParams['highrated'])) {
                $criteria->condition .= " AND reviewCount>0 AND reviewSum/reviewCount>4.5";
            }
            //featured job
            if (!empty($reqParams['featured'])) {
                $subQuery = "SELECT adviserId FROM AdviserFeatured WHERE 1";
                $criteria->condition .= " AND adviser.id IN ({$subQuery})";
            }
            //yearStartPractice
            if (!empty($reqParams['years'])) {
                $year = (int) $reqParams['years'];
                $sinceYear = date('Y') - $year;
                $criteria->condition .= " AND yearStartPractice <> 0";
                $criteria->condition .= " AND yearStartPractice <= {$sinceYear}";
            }
            //most poplur Adviser
            if (!empty($reqParams['mostpopular'])) {
                $criteria->join .= " INNER JOIN (SELECT userId, COUNT(id) cnt FROM QuestionResponses GROUP BY userId ORDER BY COUNT(id) DESC LIMIT 50) as moustpuplar  ON moustpuplar.userId=adviser.userId";
                $criteria->order = "moustpuplar.cnt DESC";
            }
        }
        $advisers = Adviser::model()->findAll($criteria);
        $this->renderPartial('list', array(
            'advisers' => $advisers,
            'reqParams' => $reqParams
        ));
    }

    public function actionSearch($query) {
        $model = new Adviser('search');
        $model->unsetAttributes();  // clear any default values
        $model->attributes = array(
            'userId' => $query,
            'address' => $query,
            'bio' => $query,
            'suburb' => $query
        );
        $this->render('search', array(
            'model' => $model,
        ));
    }

    public function actionAdvancedSearch() {
        $model = new AdviserSearchForm();
        $model->unsetAttributes();  // clear any default values
        if (isset($_POST['AdviserSearchForm'])) {
            $model->attributes = $_POST['AdviserSearchForm'];
            $model->validate();
        }
    }

    public function actionRate() {
        $userId = Yii::app()->user->id;
        $rating = $_POST['rating'];
        $responseId = $_POST['responseId'];
        $feedback = $_POST['feedback'];

        $criteria = new CDbCriteria();
        $criteria->alias = 'qr';
        $criteria->select = 'ar.id as arId, qr.userId';
        $criteria->join = ' JOIN Questions q ON q.id = qr.questionId';
        $criteria->join .= ' LEFT JOIN QuestionResponseRating ar ON ar.responseId = qr.id';
        $criteria->condition = ' q.userId = "' . $userId . '" AND qr.id = :responseId';
        $criteria->params = array(':responseId' => $responseId);
        $questionResponse = QuestionResponse::model()->find($criteria);

        if ($questionResponse && empty($questionResponse->arId)) {
            $responseRating = new QuestionResponseRating();
            $responseRating->adviserId = $questionResponse->userId;
            $responseRating->responseId = $responseId;
            $responseRating->rating = $rating;
            $responseRating->feedback = $feedback;
            $responseRating->userId = $userId;
            $responseRating->save();
        } else {
            echo 'error';
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Adviser the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Adviser::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Adviser $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'adviser-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionView($id) {
        $model = Advised::model()->findByPk($id);
        if (!$model)
            throw new CHttpException('404', 'Page not found');
        $this->render('view', compact('model'));
    }

}
