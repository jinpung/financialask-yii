<?php
class NewsletterCommand extends CConsoleCommand
{
	public function getHelp()
	{
		echo "Cron jobs for sending  newsletter ".PHP_EOL;
		echo 'Usage : yiic newsletter'.PHP_EOL;
	}

	public function run($args)
	{

		$criteria = new CDbCriteria();
		$criteria->condition = 't.complete = 0';
		$letters = Newsletter::model()->findAll($criteria);
		$mail = new YiiMailer;
		//use "cron" view from views/mail
		$mail->setView('newsletter');
		$mail->setFrom(	Yii::app()->params['cronEmail'], 'Financial Ask');
		foreach($letters as $letter){
			$dataProvider = new CActiveDataProvider("User");
			$iterator = new CDataProviderIterator($dataProvider,100);
			foreach ($iterator as $user)
			{
				$mail->setData(array('message' => $letter->content, 'name' =>'Financial Ask', 'description' => 'Newsletter', 'mailer' => $mail));

				//set properties

				$mail->setSubject( $letter->title);
				$mail->setTo($user->email);
				if ($mail->send()) {
					echo 'Mail sent successfuly'.PHP_EOL;
				} else {
					echo 'Error while sending email: '.$mail->getError().PHP_EOL;
				}
			}
			$letter->complete = 1;
			$letter->save();
		}
		echo PHP_EOL;
	}
}