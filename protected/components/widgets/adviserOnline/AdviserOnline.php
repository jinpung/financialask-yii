<?php
Yii::import('system.web.widgets.CWidget');
class AdviserOnline extends CWidget{

	public $htmlOptions = array();

	public $tagName = 'div';

	public $limit = 5;

	protected  $models;

	public function init()
	{
		$this->models = Adviser::model()->online()->findAll(array(
				'limit'=>$this->limit
			));
	}

	public function run()
	{
		$this->render('adviserOnline',array('models'=>$this->models));
	}

} 