<?php
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php');

class YiiOpenTok extends CApplicationComponent{
	public $apiKey;
	public $apiSecret;
	protected $instance;

	public function init()
	{
		$this->instance = new \OpenTok\OpenTok($this->apiKey,$this->apiSecret);
	}
	public function getInstance()
	{
		return $this->instance;
	}
}