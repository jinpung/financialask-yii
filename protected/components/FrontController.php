<?php
class FrontController extends Controller
{
	protected  function beforeAction($action)
	{
		$user = Yii::app()->user;
		if(!$user->isGuest && $user->userModel->userTypeID == User::TYPE_ADVISER)
		{
			$user->userModel->adviserProfile->actiontime = new CDbExpression('NOW()');
			$user->userModel->adviserProfile->save();
		}
		// Don't use layout on AJAX request
		if (isset($_GET['ajax']))
			$this->layout=false;
		return parent::beforeAction($action);
	}
}