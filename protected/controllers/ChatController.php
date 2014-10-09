<?php

class ChatController extends FrontController
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

	public function getActionParams()
	{
		return $_POST + $_GET;
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
				'actions' => array('check'),
				'users' => array('@'),
				'expression' => function () {
					$userModel = Yii::app()->user->userModel;
					return (isset($userModel) && $userModel->userTypeID == User::TYPE_ADVISER);
				}
			),
			array(
				'allow',
				'actions'=>array('call','changeStatus','callerInfo','index'),
				'users'=>array('@')
			),
			array(
				'deny',  // deny all users
				'users' => array('*'),
			),
		);
	}

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionChangeStatus($callId,$status)
	{
		$call = Call::model()->findByPk($callId);
		if(!$call)
			throw new CHttpException('404','Call not found');

		switch($status){
			case Call::STATUS_DECLINED:
				if($call->status == Call::STATUS_CALLING)
					$call->status = $status;
				break;
			default:
				$call->status = Call::STATUS_ACCEPTED;

		}
		$call->save();
	}

	public function actionCheck()
	{

		$call = Call::model()->findByAttributes(
			array(
				'adviserId' => Yii::app()->user->userModel->adviserProfile->id,
				'status' => Call::STATUS_CALLING
			)
		);
		$result = $call ? array(
			'status' => true,
			'callId'=> $call->id,
			'link' => CHtml::normalizeUrl(array(
				'chat/call',
				'sessionId' => $call->sessionId,
				'adviserId' => $call->adviserId)
			)
		) : array(
			'status' => false,
			'link' => false,
			'callId'=>false
		);
		echo CJSON::encode($result);
		Yii::app()->end();
	}

	public function actionCallerInfo($callId)
	{
		$call = Call::model()->findByPk($callId);
		if(!$call)
			throw new CHttpException('404','Call not found');
		$this->renderPartial('caller',array('user'=>$call->user));

	}
	public function actionCall($sessionId = false, $adviserId)
	{
		/* @var $openTok \OpenTok\OpenTok */
		$openTok = Yii::app()->openTok->getInstance();


		if (!$sessionId) {
			/* @var $session \OpenTok\Session; */
			$session = $openTok->createSession();
			$sessionId = $openTok->createSession()->getSessionId();
		}
		$token = $sessionId ? $openTok->generateToken($sessionId) : $session->generateToken();
		if (Yii::app()->user->userModel->userTypeID != User::TYPE_ADVISER) {
			$call = new Call();
			$call->attributes = array(
				'userId' => Yii::app()->user->id,
				'adviserId' => $adviserId,
				'sessionId' => $sessionId,
				'status' => Call::STATUS_CALLING
			);
			$call->save();
		}else
		{
			$call = Call::model()->findByAttributes(array(
				'sessionId'=>$sessionId,
				'adviserId'=>Yii::app()->user->userModel->adviserProfile->id
			));
			if(!$call)
				throw new CHttpException(403,'Not enough permissions');
			$call->status = Call::STATUS_IN_PROGRESS;
			$call->save();
		}
		$this->render('call', array(
			'token' => $token,
			'sessionId' => $sessionId
		));
	}
}