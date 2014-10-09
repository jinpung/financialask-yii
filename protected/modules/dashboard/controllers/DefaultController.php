<?php

class DefaultController extends DashboardController
{
	public function actionIndex()
	{
		$this->render('index');
	}
}