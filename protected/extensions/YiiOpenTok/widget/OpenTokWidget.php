<?php
Yii::import('system.web.widgets.CWidget');

class OpenTokWidget extends CWidget
{

	public $sessionId;

	public $token;

	public $apiScriptUrl = '//static.opentok.com/webrtc/v2.2/js/TB.min.js';

	protected $assetsUrl;


	public function init()
	{
		$this->registerClientScript();
	}

	public function run()
	{
		$this->render('openTok');
	}

	protected function getAssetsUrl()
	{
		if ($this->assetsUrl === null) {
			$this->assetsUrl = Yii::app()->getAssetManager()->publish(
				Yii::getPathOfAlias('ext.YiiOpenTok.widget.assets')
			);
		}
		return $this->assetsUrl;
	}

	protected function registerClientScript()
	{
		/* @var $cs CClientScript */
		$cs = Yii::app()->clientScript;
		$cs->registerScriptFile($this->apiScriptUrl)
			->registerScriptFile($this->getAssetsUrl() . '/js/openTokWidget.js')
			->registerScript(
				"OpenTakWidget",
				'initYiiOpenTok(' . CJSON::encode(array(
					'sessionId' => $this->sessionId,
					'token' => $this->token,
					'apiKey' => Yii::app()->openTok->apiKey
				)) . ');', CClientScript::POS_HEAD
			);
	}
} 