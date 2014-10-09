<?php
Yii::import('system.web.widgets.CWidget');

class RelatedTopics extends CWidget {

	public $tagName ='div';

	public $htmlOptions = array();

    public $limit = 3;
    
	private  $_list;
    
    

	public function init()
	{
		$this->_list = Specialties::getList();
	}

	public function run()
	{
		$this->render('relatedTopics',array('list'=>$this->_list, 'limit' => $this->limit));
	}
} 