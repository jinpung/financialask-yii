<?php

class PaymentController extends FrontController
{

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
			array('allow',
				'actions' => array('prepare', 'done'),
				'users' => array('@'),
			),
			array('deny', // deny all users
				'users' => array('*'),
			),
		);
	}

	public function actionDone()
	{
		$token = $_POST['token'];

		$customer = Yii::app()->stripe->customer(array(
			'email' => Yii::app()->user->userModel->email,
			'card' => $token
		));
		/** @var  $charge Stripe_Charge */
		$charge = Yii::app()->stripe->charge(array(
			'customer' => $customer->id,
			'amount' => intval($_POST['amount']) * 100,
			'currency' => 'usd'
		));
		$result = array();
		$user = Yii::app()->user->userModel;
		if ($charge->paid) {
			$user->credit += $charge->amount / 100;
			$saved = $user->save();
			$result = array(
				'status' => $saved,
				'message' => $saved ? 'You successfully added $' . $charge->amount / 100 : $user->getError('credit'),
				'amount' => $user->credit
			);
		} else {
			$result = array(
				'status' => false,
				'message' => $charge->failure_message,
				'amount' => $user->credit
			);
		}
		echo CJSON::encode($result);
		Yii::app()->end();
	}

	public function actionPrepare()
	{
		$this->render('prepare');
	}

}