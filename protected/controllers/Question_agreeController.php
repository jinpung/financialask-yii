<?php

class Question_agreeController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
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
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'agree', 'response'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new QuestionAgree;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['QuestionAgree']))
		{
			$model->attributes=$_POST['QuestionAgree'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['QuestionAgree']))
		{
			$model->attributes=$_POST['QuestionAgree'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('QuestionAgree');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new QuestionAgree('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['QuestionAgree']))
			$model->attributes=$_GET['QuestionAgree'];

		$this->render('admin',array(
			'model'=>$model,
		));
  }

  public function actionResponse($id)
  {
    $response = QuestionResponse::model()->findByPk($id);
    $this->renderPartial('_responseAgrees', array(
      'response'=>$response,
    ));

  }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return QuestionAgree the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=QuestionAgree::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param QuestionAgree $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='question-agree-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
  }

  public function actionAgree($id){
    $questionResponse = QuestionResponse::model()->findByPk($id);
    $loggedUserID = Yii::app()->user->id;
    $loggedAdviser = Adviser::model()->findByAttributes(
      array(
        'userId' => $loggedUserID
      ));
    $adviserID = $loggedAdviser->id;
    if(!$questionResponse) 
      throw new CException('404', 'Response not found');
    // if agreement already exists
    $agreeAttributes = array(
        'responseID' => $id,
        'adviserId' => $adviserID
    );
    $current = QuestionAgree::model()->findByAttributes($agreeAttributes);
    if($current) {
      $current->deleteAllByAttributes($agreeAttributes);
      $toInsert = $this->renderPartial('/question_agree/_responseAgrees', array(
        'response'=>$questionResponse,
      ), true);
      echo CJSON::encode(array('result'=>'deleted', 'toInsert'=>$toInsert));
      return;
    }
    $agreement = new QuestionAgree();
    $agreement->responseID = $id;
    $agreement->adviserId = $adviserID;
    $agreement->datetime = (new DateTime())->getTimestamp();
    if($agreement->validate() && $agreement->save()){
      $toInsert = $this->renderPartial('/question_agree/_responseAgrees', array(
        'response'=>$questionResponse,
      ), true);
      echo CJSON::encode(array('result'=>'success', 'toInsert'=>$toInsert));
    }else
      throw new CHttpException('500', 'Error agreeing with answer');
  }
}
