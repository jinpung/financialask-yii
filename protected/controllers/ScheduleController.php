<?php

class ScheduleController extends FrontController
{

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
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
			array(
				'allow',
				'actions' => array('create', 'index', 'delete','my','manage','export'),
				'users' => array('@'),
				'expression' => function () {
					$userModel = Yii::app()->user->userModel;
					return (isset($userModel) && $userModel->userTypeID == User::TYPE_ADVISER);
				}
			),
			array(
				'allow',
				'actions' => array('booking', 'busy'),
				'users' => array('@'),
			),
			array('deny',  // deny all users
				'users' => array('*'),
			),
		);
	}

	public function actionCreate($startTime, $endTime)
	{
		$model = new AdviserSchedule();
		$model->attributes = array(
			'adviserId' => Yii::app()->user->userModel->adviserProfile->id,
			'startTime' => $startTime,
			'endTime' => $endTime
		);
		echo CJSON::encode($model->save());
		Yii::app()->end();
	}

	public function actionDelete($startTime, $endTime)
	{
		echo CJSON::encode(AdviserSchedule::model()->findByAttributes(array(
			'adviserId' => Yii::app()->user->userModel->adviserProfile->id,
			'startTime' => $startTime,
			'endTime' => $endTime
		))->delete());
	}
	public function actionManage()
	{
		$adviser = Yii::app()->user->userModel->adviserProfile;
		$this->render('manage',compact('adviser'));
	}
	public function actionMy($start,$end)
	{
		$start = new DateTime($start);
		$end = new DateTime($end);
		$schedule = array();
		$models = AdviserSchedule::model()->findAllByAttributes(array(
			'adviserId' => Yii::app()->user->userModel->adviserProfile->id
		));
		$dateTime = new DateTime();
		foreach ($models as $model) {
			$startTimeArray = explode(':', $model->startTime);
			$dateTime->setISODate(date('Y'), $start->format('W'), $startTimeArray[0]);
			$dateTime->setTime($startTimeArray[1], $startTimeArray[2]);
			$startTime = $dateTime->format(DateTime::ISO8601);
			$endTimeArray = explode(':', $model->endTime);
			$dateTime->setISODate(date('Y'), $start->format('W'), $endTimeArray[0]);
			$dateTime->setTime($endTimeArray[1], $endTimeArray[2]);
			$endTime = $dateTime->format(DateTime::ISO8601);
			$schedule[] = array(
				'start' => $startTime,
				'end' => $endTime,
				'title' => 'Available'
			);
		}
		echo CJSON::encode($schedule);
		Yii::app()->end();

	}
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionExport($bookingId)
	{
		$model = Booking::model()->findByPk($bookingId);
		header('Content-type: text/calendar; charset=utf-8');
		header('Content-Disposition: attachment; filename=' . 'event.ics');
		echo Yii::app()->ical->generate(
			$model->user->displayname,
			$model->user->email,
			$model->start,$model->end,
			$model->reason
		);
	}

	public function actionBusy($adviserId,$start,$end)
	{
		$criteria = new CDbCriteria();
		$criteria->addColumnCondition(array(
			'adviserId' => (int)$adviserId
		));
		$criteria->order = 'startTime ASC';
		$models = AdviserSchedule::model()->findAll($criteria);
		$schedule = array();
		$dateTime = new DateTime();
		$start = new DateTime($start);
		$end = new DateTime($end);
		$modelsCount = count($models);
		foreach ($models as $index => $model) {
			if($index) // if not first model in the list
			{
				$startTImeModel = $models[$index-1]; // taking previous model for getting start time
				$startTimeArray = explode(':', $startTImeModel->endTime);
				$dateTime->setISODate(date('Y'), $start->format('W'),$startTimeArray[0]);
				$dateTime->setTime($startTimeArray[1], $startTimeArray[2]);
				$startTime = $dateTime->format(DateTime::ISO8601);
			} else {
				$startTime = $start->format(DateTime::ISO8601);
			}
			$endTimeArray = explode(':', $model->startTime);
			$dateTime->setISODate(date('Y'), $start->format('W'),$endTimeArray[0]);
			$dateTime->setTime($endTimeArray[1], $endTimeArray[2]);
			$endTime = $dateTime->format(DateTime::ISO8601);
			$schedule[] = array(
				'start' => $startTime,
				'end' => $endTime,
				'title' => 'Not Available'
			);
			if($index==($modelsCount-1))// if last model, we add additional time frame till end of the week
			{
				$endTimeArray = explode(':', $model->endTime);
				$dateTime->setISODate(date('Y'), $start->format('W'),$endTimeArray[0]);
				$dateTime->setTime($endTimeArray[1], $endTimeArray[2]);
				$endTime = $dateTime->format(DateTime::ISO8601);
				$schedule[] = array(
					'start' => $endTime,
					'end' => $end->format(DateTime::ISO8601),
					'title' => 'Not Available'
				);
			}
		}

	//	$this->render('booking',compact('schedule'));
		echo CJSON::encode($schedule);
		Yii::app()->end();
	}
}