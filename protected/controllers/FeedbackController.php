<?php

class FeedbackController extends FrontController
{

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

			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','delete','index','list'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($adviserId)
	{
		$model=new Feedback;
		$adviser = Adviser::model()->findByPk($adviserId);
		if(!$adviser)
			throw new CHttpException('404','Adviser not found');
		$model->userId = Yii::app()->user->id;
		$model->adviserId = $adviserId;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Feedback']))
		{
			$model->attributes=$_POST['Feedback'];
			if($model->save())
				$this->redirect(array('index','adviserId'=>$adviserId));
		}

		$this->render('create',array(
			'model'=>$model,
			'adviser'=>$adviser
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
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	public function actionList($adviserId)
	{
		$criteria = new CDbCriteria();
		$adviser = Adviser::model()->findByPk($adviserId);
		if(!$adviser)
			throw new CHttpException('404','Adviser not found');
		$criteria->addColumnCondition(array('adviserId'=>$adviserId));
		$dataProvider=new CActiveDataProvider('Feedback',array('criteria'=>$criteria));
		$this->render('list',array(
			'dataProvider'=>$dataProvider,
			'adviser'=>$adviser
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$criteria = new CDbCriteria();
		if(Yii::app()->user->userModel->userTypeID == User::TYPE_ADVISER)
			$criteria->addColumnCondition(array('adviserId'=>Yii::app()->user->userModel->adviserProfile->id));
		else
			$criteria->addColumnCondition(array('userId'=>Yii::app()->user->id));
		$dataProvider=new CActiveDataProvider('Feedback',array('criteria'=>$criteria));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Feedback the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Feedback::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Feedback $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='feedback-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
