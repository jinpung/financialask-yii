<?php
Yii::import('system.web.widgets.CWidget');

class AdviserStatus extends CWidget
{


	public $htmlOptions = array();

	public $checkUrl = '/chat/check';

	public $statusUrl = '/chat/changeStatus';

	public $checkInterval = 3000; //3 seconds

	public $callerInfoUrl = '/chat/callerInfo';

	protected $assetsUrl;

	public function init()
	{
		$this->htmlOptions['id'] = isset($this->htmlOptions['id']) ? $this->htmlOptions['id'] : $this->getId();
		$this->registerClientScript();
	}

	public function run()
	{
		$this->render('adviserStatus');
	}

	protected function getAssetsUrl()
	{
		if ($this->assetsUrl === null) {
			$this->assetsUrl = Yii::app()->getAssetManager()->publish(
				Yii::getPathOfAlias('application.components.widgets.adviserStatus.assets')
			);
		}
		return $this->assetsUrl;
	}

	protected function registerClientScript()
	{
		/* @var $cs CClientScript */
		$cs = Yii::app()->clientScript;
		$cs->registerCoreScript('jquery')
			->registerScriptFile($this->getAssetsUrl() . '/js/adviserStatus.js')
			->registerScript($this->getId(), 'adviserStatus(' . CJSON::encode(array(
					'statusUrl' => CHtml::normalizeUrl($this->statusUrl),
					'checkUrl'=>CHtml::normalizeUrl($this->checkUrl),
					'selector' => '#' . $this->htmlOptions['id'],
					'checkInterval'=>$this->checkInterval,
					'callerInfoUrl'=>CHtml::normalizeUrl($this->callerInfoUrl)
				)) . ')');
	}
} 