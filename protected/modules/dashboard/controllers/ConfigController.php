<?php

class ConfigController extends DashboardController
{
	public function actionIndex()
	{

		$this->render('index',array('dataProvider'=>ConfigModel::getDataProvider()));
	}

	public function actionCreate()
	{
		$model = new ConfigModel();
		if(isset($_POST['ConfigModel']))
		{
			$model->attributes=$_POST['ConfigModel'];
			if($model->validate()&&$model->save())
				$this->redirect(array('index'));
		}
		$this->render('create',compact('model'));
	}

	public function actionDelete($type,$key)
	{
		$data = ConfigModel::getConfigData();
		unset($data[$type][$key]);
		if(!count($data[$type])) unset($data[$type]); // if last record in selected type, we delete whole type
		ConfigModel::setConfigData($data);
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}
	public function actionUpdate($type,$key)
	{
		$data = ConfigModel::getConfigData();
		$model = new ConfigModel();
		$model->type = $type;
		$model->key = $key;
		$model->value = $data[$type][$key];
		$model->isNewRecord = false;
		if(isset($_POST['ConfigModel']))
		{
			$model->attributes=$_POST['ConfigModel'];
			if($model->validate())
			{
				$data[$type][$key] = $model->value;
				ConfigModel::setConfigData($data);
				$this->redirect(array('index'));
			}
		}
		$this->render('update',compact('model'));
	}

}