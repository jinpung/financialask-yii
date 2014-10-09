<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
// reading configuration from json file
if(file_exists(__DIR__ . '/config.json'))
	$config = json_decode(file_get_contents(__DIR__ . '/config.json'), true);
else
	$config = json_decode(file_get_contents(__DIR__ . '/config.json.example'), true);
return array(
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name' => 'Financial Ask',
	'language' => 'en',
	// preloading 'log' component
	'preload' => array('log'),

	// preloading 'log' component
//    'preload' => array('log'),

	// autoloading model and component classes
	'import' => array(
		'application.models.*',
		'application.models.forms.*',
		'application.components.*',
		'ext.YiiMailer.YiiMailer',
		'ext.yii-composite-unique-validator.ECompositeUniqueValidator',
	),

	'modules' => array(
		'dashboard',
		'gii' => array(
			'class' => 'system.gii.GiiModule',
			'password' => 'giipass',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters' => array('127.0.0.1', '::1'),
		),
	),

	// application components
	'components' => array(
		'Paypal' => array(
			'class' => 'application.components.Paypal',
			'apiUsername' => $config['Paypal']['apiUsername'],
			'apiPassword' => $config['Paypal']['apiPassword'],
			'apiSignature' => $config['Paypal']['apiSignature'],
			'apiLive' => false,
			'returnUrl' => '/paypal/confirm/', //regardless of url management component
			'cancelUrl' => '/paypal/cancel/', //regardless of url management component
			// Default currency to use, if not set USD is the default
			'currency' => 'USD',

			// Default description to use, defaults to an empty string
			//'defaultDescription' '',

			// Default Quantity to use, defaults to 1
			//'defaultQuantity' => '1',

			//The version of the paypal api to use, defaults to '3.0' (review PayPal documentation to include a valid API version)
			//'version' => '3.0',
		),

		'user' => array(
			// enable cookie-based authentication
			'allowAutoLogin' => true,
			'class' => 'FaWebUser',
		),
		'clientScript' => array(
			'packages' => array(
				'jquery' => array(
					'baseUrl' => '/components/jquery/dist/',
					'js' => array('jquery.min.js'),
				)
			),
		),
		'ical' => array(
			'class' => 'ext.YiiIcal.YiiIcal'
		),
		'stripe' => array(
			'class' => 'application.extensions.YiiStripe.YiiStripe',
			'publicKey' => 'pk_test_TxhHu5IC3wgsXdAHGgYU67zF',
			'secretKey' => 'sk_test_yx2vB7k50jKq7souc2PwUCbS'
		),
		'openTok' => array(
			'class' => 'ext.YiiOpenTok.YiiOpenTok',
			'apiKey' => '44970372',
			'apiSecret' => '3110485499a31e933269bc4048b348d1c2a86bd7'
		),
		'urlManager' => array(
			'urlFormat' => 'path',
			'rules' => array(
				'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'search/<query:\w+>' => 'search',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>/<view:\w+>' => '<controller>/<action>',
			),
			'showScriptName' => false,
			'caseSensitive' => true,
		),


		// database settings are configured in database.php
		'db' => require(dirname(__FILE__) . '/database.php'),
		// 'db'=>array(
		// 'connectionString' => 'mysql:host=localhost;dbname=financialask-yii',
		// 'emulatePrepare' => true,
		// 'username' => 'root',
		// 'password' => '',
		// ),
		'errorHandler' => array(
			// use 'site/error' action to display errors
			'errorAction' => 'site/error',
		),


		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CWebLogRoute',
				),

			),
		),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params' => array(
		// this is used in contact page
		'adminEmail' => 'webmaster@example.com',
	),
	// Default to activity/index if user is logged in
	'onBeginRequest' => function () {
		if (!Yii::app()->user->isGuest)
			Yii::app()->defaultController = 'activity';
	}
);
