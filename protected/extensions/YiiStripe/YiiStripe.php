<?php
/**
 * YiiStripe class - wrapper for Stripe PHP api
 * @package YiiStripe
 * @author Mihail Marchitan
 * @license    http://opensource.org/licenses/BSD-3-Clause	BSD
 * @version 0.1, 2014-09-3
 */
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php');
class YiiStripe  extends CApplicationComponent{

	public $publicKey;

	public $secretKey;


	public function init()
	{
		Stripe::setApiKey($this->secretKey);
	}

	public function customer($params = array())
	{
		return Stripe_Customer::create($params);
	}
	public function charge($params = array())
	{
		return Stripe_Charge::create($params);
	}
} 