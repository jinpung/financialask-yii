<?php

class PaypalController extends Controller
{
	public function actionPay($amount){
		if(!is_numeric($amount))
		{
			throw new CHttpException('500','Wrong amount');
		}
		// set
		Yii::app()->session['theTotal'] = $amount;
		$paymentInfo['Order']['theTotal'] =$amount;
		$paymentInfo['Order']['description'] = "Add credit to Financial Ask";
		$paymentInfo['Order']['quantity'] = '1';

		// call paypal
		$result = Yii::app()->Paypal->SetExpressCheckout($paymentInfo);
		//Detect Errors
		if(!Yii::app()->Paypal->isCallSucceeded($result)){
			if(Yii::app()->Paypal->apiLive === true){
				//Live mode basic error message
				$error = 'We were unable to process your request. Please try again later';
			}else{
				//Sandbox output the actual error message to dive in.
				$error = $result;
			}
			print_r($error);
			Yii::app()->end();

		}else {
			// send user to paypal
			$token = urldecode($result["TOKEN"]);

			$payPalURL = Yii::app()->Paypal->paypalUrl.$token;
			$this->redirect($payPalURL);
		}
	}

	public function actionConfirm()
	{
		$token = trim($_GET['token']);
		$payerId = trim($_GET['PayerID']);
		$result = Yii::app()->Paypal->GetExpressCheckoutDetails($token);
		$result['PAYERID'] = $payerId;
		$result['TOKEN'] = $token;
		$result['ORDERTOTAL'] =	Yii::app()->session['theTotal'];
		//Detect errors
		if(!Yii::app()->Paypal->isCallSucceeded($result)){
			if(Yii::app()->Paypal->apiLive === true){
				//Live mode basic error message
				$error = 'We were unable to process your request. Please try again later';
			}else{
				//Sandbox output the actual error message to dive in.
				$error = $result['L_LONGMESSAGE0'];
			}
			echo $error;
			Yii::app()->end();
		}else{
			$paymentResult = Yii::app()->Paypal->DoExpressCheckoutPayment($result);
			//Detect errors
			if(!Yii::app()->Paypal->isCallSucceeded($paymentResult)){
				if(Yii::app()->Paypal->apiLive === true){
					//Live mode basic error message
					$error = 'We were unable to process your request. Please try again later';
				}else{
					//Sandbox output the actual error message to dive in.
					$error = $paymentResult['L_LONGMESSAGE0'];
				}
				echo $error;
				Yii::app()->end();
			}else{
				$user = Yii::app()->user->userModel;
				$user->credit+= Yii::app()->session['theTotal'];

				//payment was completed successfully

				$this->render('confirm',array('result'=>$user->save(),'credit'=>Yii::app()->session['theTotal']));
			}
		}
	}

	public function actionCancel()
	{
		//The token of the cancelled payment typically used to cancel the payment within your application
		$token = $_GET['token'];
		$this->render('cancel');
	}
}