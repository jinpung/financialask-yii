<?php

class QuestionsController extends FrontController {

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
                'actions' => array('index', 'view', 'search'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('ask', 'respond', 'answered', 'unanswered', 'archive', 'my', 'myanswers', 'follow', 'rateanswer'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {

        $response = new QuestionResponse();
        $model = $this->loadModel($id);
        $response->userId = Yii::app()->user->id;
        $response->questionID = $model->id;

        /* ----------- */
        $rootDir = Yii::getPathOfAlias('webroot');
        $imagePath = '/images/stockphotos/';
        $images = array();
        $fullPath = $rootDir . '/' . $imagePath;
        if (is_dir($fullPath)) {
            $files = scandir($fullPath);
            if (sizeof($files) > 0) {
                foreach ($files as $fileName) {
                    $fileExtension = (($pos = strrpos($fileName, '.')) !== false) ? (string) substr($fileName, $pos + 1) : '';
                    if (in_array(strtolower($fileExtension), array('jpeg', 'jpg', 'png', 'gif'))) {
                        $images[] = $imagePath . '/' . $fileName;
                    }
                }
            }
        }
        /* ----------- */
        $this->render('view', array(
            'model' => $model,
            'response' => $response,
            'images' => $images
        ));
    }

    public function actionRespond($id) {
        $response = new QuestionResponse();
        $model = $this->loadModel($id);
        $response->userId = Yii::app()->user->id;
        $response->questionID = $model->id;
        if (isset($_POST['QuestionResponse'])) {
            $response->attributes = $_POST['QuestionResponse'];
            if ($response->validate() && $response->save()) {
                //$response->unsetAttributes();
                $toInsert = $this->renderPartial('/response/_view', array('data' => $response), true);
                echo CJSON::encode(array('result' => 'success', 'toInsert' => $toInsert));
                return;
            }
        }
        echo CJSON::encode(array('result' => 'failed'));
    }

    public function actionMyAnswers() {
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('t.userId' => Yii::app()->user->id));
        $dataProvider = new CActiveDataProvider('QuestionResponse', array('criteria' => $criteria));
        $this->render('/response/index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAnswered() {
        $reqParams = $_GET;
        if (!empty($_GET['str'])) $search_str = $_GET['str'];
        else $search_str = false;
        
        $offset = (isset($_GET['offset'])) ? (int)$_GET['offset'] : 0;
        $limit = 10;
        
        $criteria = new CDbCriteria();
        $criteria->alias = 't';
        $criteria->condition = 1;
        $criteria->distinct = true;
        //$criteria->condition = "t.userId='" . Yii::app()->user->id . "'";
        $criteria->join = ' INNER JOIN QuestionResponses responses ON t.id = responses.questionID';
        if ($search_str) {
            $searchStr = "t.title LIKE :searchStr OR t.content LIKE :searchStr OR responses.content LIKE :searchStr";
            $criteria->condition .= " AND ({$searchStr})";
            $criteria->params = array(':searchStr' => '%' . $search_str . '%');
        }

        if (isset($_GET['ajax'])) $totalCount = $_GET['totalCount'];
        else $totalCount = Question::model()->with('user')->count($criteria);

        $criteria->offset = $offset;
        $offset += $limit;
        $criteria->limit = $limit;
        //$criteria->condition .= ' AND responses.id is not null';
        $data = Question::model()->findAll($criteria);
        $action = 'answered';

        if (isset($_GET['ajax'])) $this->renderPartial('list', compact('data', 'search_str', 'action', 'totalCount', 'limit', 'offset'));
        else $this->render('list', compact('data', 'search_str', 'action', 'totalCount', 'limit', 'offset'));
    }

    public function actionUnanswered() {
        $offset = (isset($_GET['offset'])) ? (int)$_GET['offset'] : 0;
        $limit = 10;

        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('t.userId' => Yii::app()->user->id));
        $criteria->join = ' LEFT JOIN QuestionResponses responses ON t.id = responses.questionID';
        $criteria->with = array('responses' => array(
                'select' => '*'
        ));
        $criteria->condition = 'responses.id is null';

        $criteria->offset = $offset;
        $offset += $limit;
        $criteria->limit = $limit;

        $data = Question::model()->findAll($criteria);
        $search_str = '';
        $action = 'unanswered';
        $totalCount = count($data);
        $this->render('list', compact('data', 'search_str', 'action', 'totalCount', 'limit', 'offset'));
    }

    public function actionArchive() {
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('t.userId' => Yii::app()->user->id));
        $criteria->limit = 10;
        $criteria->order = 'id DESC';
        $data = Question::model()->findAll($criteria);
        $this->render('list', compact('data'));
    }

    public function actionMy() {
        $reqParams = $_GET;
        if (!empty($_GET['str'])) $search_str = $_GET['str'];
        else $search_str = false;

        $offset = (isset($_GET['offset'])) ? (int)$_GET['offset'] : 0;
        $limit = 10;

        $criteria = new CDbCriteria();
        $criteria->alias = 't';
        $criteria->condition = "t.userId='" . Yii::app()->user->id . "'";
        $criteria->join = ' LEFT JOIN QuestionResponses responses ON t.id = responses.questionID';
        if ($search_str) {
            $searchStr = "t.title LIKE '%{$search_str}%' OR t.content LIKE '%{$search_str}%' OR responses.content LIKE '%{$search_str}%'";
            $criteria->condition .= " AND ({$searchStr})";
        }

        $criteria->offset = $offset;
        $offset += $limit;
        $criteria->limit = $limit;

        $data = Question::model()->findAll($criteria);
        $action = 'my';
        $totalCount = count($data);
        $this->render('list', compact('data', 'search_str', 'action', 'totalCount', 'limit', 'offset'));

    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionAsk() {
        $model = new Question;
        $model->userId = Yii::app()->user->id;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Question'])) {
            $model->attributes = $_POST['Question'];
            if ($model->save()) {
                Yii::app()->user->setFlash('question_success', "Question saved!");
                //$this->redirect(array('view', 'id' => $model->id));
                $this->redirect($this->createUrl('activity/'));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionRateanswer($id, $rate) {
        $answer = QuestionResponse::model()->findByPk($id);
        $answer->rate = $rate;
        $answer->save();
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {

        $dataProvider = new CActiveDataProvider('Question');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionSearch($query) {
        $model = new Question('search');
        $model->unsetAttributes();  // clear any default values
        $model->content = $query;
        $this->render('search', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Question the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Question::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Question $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'question-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionFollow($id) {
        $qAtts = array('id' => $id);
        $question = Question::model()->findByAttributes($qAtts);
        if (!$question)
            throw new CHttpException('404', 'Question not found');

        // if relation already exists
        $relExistAtts = array('questionId' => $question->id, 'userId' => Yii::app()->user->id);
        $currentRelation = QuestionFollow::model()->findByAttributes($relExistAtts);
        if ($currentRelation) {
            $currentRelation->deleteAllByAttributes($relExistAtts);
            echo CJSON::encode(array('result' => 'deleted'));
            return;
        }
        $relation = new QuestionFollow();
        $relation->questionId = $question->id;
        $relation->userId = Yii::app()->user->id;
        $relation->datetime = time();
        if ($relation->validate() && $relation->save()) {
            echo CJSON::encode(array('result' => 'success'));
        }
        else
            throw new CHttpException('500', 'Error following question');
    }

}
