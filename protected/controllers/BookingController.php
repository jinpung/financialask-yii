<?php

class BookingController extends FrontController
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
				'actions'=>array('create','index','view','status','check','checkPrice'),
				'users'=>array('@'),
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
		$model = $this->loadModel($id);
		switch(Yii::app()->user->userModel->userTypeID)
		{
			case User::TYPE_ADVISER :
				if(Yii::app()->user->userModel->adviserProfile->id != $model->adviserId)
					throw new CHttpException('403','Not enough permissions');
				break;
			case User::TYPE_USER :
				if(Yii::app()->user->id != $model->userId)
					throw new CHttpException('403','Not enough permissions');
				break;
		}
		$this->render('view',array(
			'model'=>$model,
		));
	}

	public function actionStatus($id,$status)
	{
		$model = $this->loadModel($id);
		switch($status){
			case Booking::STATUS_CANCELED :
				if(Yii::app()->user->id != $model->userId)
					throw new CHttpException('403','Not enough permissions');
				break;
			case Booking::STATUS_ACCEPTED:
			case Booking::STATUS_DECLINED:
				if(Yii::app()->user->userModel->adviserProfile->id != $model->adviserId)
					throw new CHttpException('403','Not enough permissions');
				break;
		}
		$model->status = $status;
		if($model->save())
			$this->redirect(array('index'));
		throw new CHttpException('500',$model->getError('status'));
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Booking;
		$model->userId = Yii::app()->user->id;
		$model->status = Booking::STATUS_CREATED;
		$result = array();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Booking']))
		{
			$model->attributes=$_POST['Booking'];
			if($model->save())
				$result = array(
					'status'=>true,
					'message'=>'Booking created'
				);
			else{
				$result = array(
					'status'=>false,
					'message'=> CHtml::errorSummary($model)
				);
			}
		} else
			$result = array(
				'status'=>false,
				'message'=>'Error while processing your request'
			);
		echo CJSON::encode($result);
		Yii::app()->end();
	}


	/**
	 * Lists all models.
	 */
	public function actionIndex($adviserId)
  {
		$adviser = Adviser::model()->findByPk($adviserId);
    if(!$adviser){
      throw new CHttpException('404','Adviser not found');
      exit;
    }
		$bookingForm = new Booking();
		$bookingForm->adviserId = $adviserId;
		$this->render('index',array('adviser'=>$adviser,'bookingForm'=>$bookingForm));
	}

	public function actionCheck($adviserId,$start,$end)
	{
		$startTime = new DateTime($start);
		$endTime = new DateTime($end);
		$result = array();
		$criteria = new CDbCriteria();
		$criteria->addColumnCondition(array(
			'adviserId'=>$adviserId
		));
		$criteria->addBetweenCondition('start',$startTime->format('Y-m-d H:i:s'),$endTime->format('Y-m-d H:i:s'));
		$models = Booking::model()->findAll($criteria);
		foreach($models as $model)
		{
			$title = $model->userId == Yii::app()->user->id ? $model->reason :'BOOKED';
			if(
				(Yii::app()->user->userModel->userTypeID == User::TYPE_ADVISER) &&
				(Yii::app()->user->userModel->adviserProfile->id == $model->adviserId)
			){
				$title = "Request from {$model->user->displayname} with reason: {$model->reason}";
			}
			$result[] = array(
				'id'=>$model->id,
				'start'=>(new DateTime($model->start))->format(DateTime::ISO8601),
				'end'=>(new DateTime($model->end))->format(DateTime::ISO8601),
				'title'=>$title,
				'color'=>$model->userId == Yii::app()->user->id ? 'green':'blue'
			);
		}
		echo CJSON::encode($result);
		Yii::app()->end();
	}
	public function actionCheckPrice($adviserId,$duration)
	{
		$user = Yii::app()->user->userModel;
		$adviser = Adviser::model()->findByPk($adviserId);
		echo CJSON::encode($user->credit >= ($duration * $adviser->rate));
		Yii::app()->end();
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Booking the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Booking::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Booking $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='booking-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
