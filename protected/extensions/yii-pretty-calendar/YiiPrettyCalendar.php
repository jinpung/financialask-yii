<?php

class YiiPrettyCalendar extends CWidget {

	public $events = array();

	public $selectorId;

	public $enableNavigation = false;

	public $customLabels = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');

	private $_assetsUrl;

	public function init()
	{
		$this->registerClientScript();
	}

	public function run()
	{

	}

	private function getAssetsUrl()
	{
		if ($this->_assetsUrl === null) {
			$this->_assetsUrl = Yii::app()->getAssetManager()->publish(
				Yii::getPathOfAlias('ext.yii-pretty-calendar.assets')
			);
		}
		return $this->_assetsUrl;
	}

	protected function registerClientScript()
	{
		/* @var $cs CClientScript */
		$cs = Yii::app()->clientScript;
		$cs ->registerScriptFile($this->getAssetsUrl() . '/js/pretty-calendar.js')
			->registerCssFile($this->getAssetsUrl().'/css/pretty-calendar.css')
			->registerCssFile($this->getAssetsUrl().'/css/custom-calendar.css')
			->registerScript(
				$this->getId(),
				'var prettyCal = new PrettyCalendar(
				'.CJSON::encode($this->events).',
				 "'.$this->selectorId.'",
				  '.CJSON::encode($this->enableNavigation).',
				 '.CJSON::encode($this->customLabels).');
			', CClientScript::POS_READY
			);
	}
} 