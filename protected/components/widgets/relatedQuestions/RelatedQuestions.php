<?php
Yii::import('system.web.widgets.CWidget');

class RelatedQuestions extends CWidget{

	public $tagName = 'div';

	public $htmlOptions = array();

	public $limit = 5;

	private $_models;

	public function init()
	{
		$criteria = new CDbCriteria();
		$criteria->limit = $this->limit;
		$criteria->order = 'RAND()';
		$this->_models = Question::model()->with('responsesCount')->findAll($criteria);
	}

	public function run()
	{
		$this->render('relatedQuestions',array('models'=>$this->_models));
	}

} 