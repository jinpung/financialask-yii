<?php
Yii::import('system.web.widgets.CWidget');

class StripeWidget extends CWidget
{
	public $imageUrl;

	public $apiScriptUrl = 'https://checkout.stripe.com/checkout.js';

	public $description;

	public $chargeUrl ='/payment/done';

	public $email;

	public $key;

	public $name;

	public $amountSelector = '#creditAmount';

	public $label = 'Pay with Stripe';

	public $inputSelector = '#creditInput';

	private $_assetsUrl;

	public function init()
	{
		$this->email = $this->email?$this->email:Yii::app()->user->userModel->email;
		$this->key = $this->key ? $this->key : Yii::app()->stripe->publicKey;
		$this->name = Yii::app()->name;
		$this->registerClientScript();
	}

	public function run()
	{
		$this->render('stripeForm');
	}

	protected function getAssetsUrl()
	{
		if ($this->_assetsUrl === null) {
			$this->_assetsUrl = Yii::app()->getAssetManager()->publish(
				Yii::getPathOfAlias('ext.YiiStripe.widget.assets')
			);
		}
		return $this->_assetsUrl;
	}

	protected function registerClientScript()
	{
		/* @var $cs CClientScript */
		$cs = Yii::app()->clientScript;
		$cs->registerScriptFile($this->apiScriptUrl)
			->registerCssFile($this->getAssetsUrl().'/css/yii-stripe-widget.css')
			->registerScriptFile($this->getAssetsUrl().'/js/stripeWidget.js')
			->registerScript($this->getId(),'
				initStripeWidget('.CJSON::encode(array(
					'wId'=>$this->getId(),
					'publicKey'=>$this->key,
					'email'=>$this->email,
					'name'=>$this->name,
					'chargeUrl'=>$this->chargeUrl,
					'description'=>$this->description,
					'imageUrl'=>$this->imageUrl,
					'amountSelector'=>$this->amountSelector,
					'inputSelector'=>$this->inputSelector
				)).');
			');
	}
}