<?php
Yii::import('system.web.widgets.CWidget');

class AdviserRecommendation extends CWidget{

	public $tagName = 'div';

	public $htmlOptions = array();

	public $formAction='/profile/recommendation';

	public $adviserId;
	public $recExists;

	public $limit = 10;

	public $title = 'Testimonials';

	private $adviser;

	private $_models;

	public function init()
	{
		$this->adviser = Adviser::model()->findByPk($this->adviserId);
		if(!$this->adviser)
			throw new CHttpException('404','Adviser not found');
		$criteria = new CDbCriteria();
		$criteria->addColumnCondition(array(
			'adviserId'=>$this->adviserId
		));
		$criteria->with = array('author','author.user');
		$criteria->order ='t.datetime DESC';
		$criteria->together = true;
		$criteria->limit = $this->limit;
		$this->_models = Recommendation::model()->findAll($criteria);
	}

	public function run()
	{
		$this->render('adviserRecommendation',array(
			'models'=>$this->_models,
      'adviser'=>$this->adviser,
      'recExists'=>$this->recExists,
		));
	}
} 
