<?php
class EmailReminderCommand extends CConsoleCommand
{
	public function getHelp()
	{
		echo "Cron jobs for periodic emails ".PHP_EOL;
		echo 'Usage : yiic emailreminder number_of_days_without_visit'.PHP_EOL;
	}

	public function run($args)
	{
		//Do some cron processing...
		if(!isset($args[0]))
		{
			$this->getHelp();
			return 1;
		}
		$days = (int)$args[0];
		$message="We are waiting for you";
		$criteria = new CDbCriteria();
		$criteria->condition = 'DATEDIFF(NOW(),t.logintime)=:days';
		$criteria->params = array(
			'days'=>$days
		);
		$users = User::model()->findAll($criteria);
		$mail = new YiiMailer;
		//use "cron" view from views/mail
		$mail->setView('reminder');
		$mail->setFrom(	Yii::app()->params['cronEmail'], 'Financial Ask');
		foreach ($users as $user)
		{
			$mail->setData(array('message' => $message, 'name' =>'Financial Ask', 'description' => 'Reminder', 'mailer' => $mail));

			//set properties

			$mail->setSubject($message);
			$mail->setTo($user->email);
			if ($mail->send()) {
				echo 'Mail sent successfuly';
			} else {
				echo 'Error while sending email: '.$mail->getError();
			}
		}

		echo PHP_EOL;
	}
}