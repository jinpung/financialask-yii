<?php
Yii::import('system.web.widgets.CWidget');
class ReadMore extends CWidget{

	public $limit = 150;

	public $content;

	public $tagName = 'div';

	public $htmlOptions = array();

	protected $preview;

	public function init()
	{
		if(strlen($this->content)>$this->limit){
			$this->preview = substr($this->content,0,150).'<br/>'.CHtml::link(
					'Read More',
					'#'.$this->getId(),
					array('onClick'=>"readMore('{$this->getId()}')"
					)
				);
		} else
			$this->preview = $this->content;
		$this->registerClientScript();
	}

	public function run()
	{
		$this->render('readMore');
	}

	protected function registerClientScript()
	{
		/* @var $cs CClientScript */
		$cs = Yii::app()->clientScript;
		$cs->registerScript('ReadMore',"
		function readMore(id)
		{
			$('#preview'+id).hide();
			$('#'+id).show();
		}",CClientScript::POS_HEAD
		);
	}
}