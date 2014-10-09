<?php
/* @var $this Controller */
/* @var $cs CClientScript */
$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;
$cs->registerCoreScript('jquery')->registerCoreScript('jquery.ui')
	->registerScriptFile($baseUrl . '/bootstrap/js/bootstrap.min.js')
	->registerScriptFile($baseUrl . '/js/plugins/hamburger/hamburger.js')
	->registerCssFile($baseUrl . '/js/plugins/hamburger/hamburger.css')
	->registerCssFile($baseUrl . '/bootstrap/css/bootstrap.min.css')
	->registerCssFile($baseUrl . '/bootstrap/css/bootstrap-theme.min.css')
//	->registerCssFile($baseUrl . '/js/plugins/font-awesome-4.1.0/css/font-awesome.css')
	->registerCssFile($baseUrl . '/style/css/default/menu.css')
	->registerCssFile($baseUrl . '/style/css/default/new_menu.css')
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">
	<meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no"/>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<style>
ul li
{
	
	position: relative;
	left:-20px;
	top:100px;
	float:left;
	font-size: 1em;
	font-weight: bold;
	padding: 10px;
	border-style:none!important;
	
}	
nav li a
{
	margin-left:10px;
	text-align:left;
}
.searchBar
{
	position:relative;
	top:50px;
}
.mobileNav ul
{
	min-height:600px;
}


	

</style>
</head>
<body style="overflow:hidden;">
<div id="container" >

	<header>
		<div id="hamburger">
			<div></div>
			<div></div>
			<div></div>
		</div>
		<div id="pageHeader"><a href="/">FinancialAsk</a></div>
	</header>

	<nav class="mobileNav">
		<ul>
			<div class="searchBar">
				<div class="input-group input-group-sm">
					<input type="text" class="form-control"/>
					<span class="input-group-btn">
						<button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span>
						</button>
					</span>
				</div>
			</div>
			<?php
			$this->widget('application.components.widgets.MenuItems');
			?>
		</ul>
	</nav>


	<div id="contentLayer"></div>

	<div id="content" style="overflow:hidden;">
		<div class="container">

			<?php
			$user = Yii::app()->user;
			if (!$user->isGuest && ($user->userModel->activeEvents||AdminNotification::checkUser($user->userModel))):
				echo CHtml::ajaxLink(
					'<i style="font-size: 2em;color: #ff0000;float: right" class="fa fa-envelope-o fa-3"></i>',
					array('site/events'),
					array(
						'type' => 'POST',
						'success' => new CJavaScriptExpression('
						function(data) {
							$("#eventsArea").html(data);
						}
					')
					)
				)?>
			<?php endif; ?>
			<?php
			if(!$user->isGuest && $user->userModel->userTypeID == User::TYPE_ADVISER)
				$this->widget('application.components.widgets.adviserStatus.AdviserStatus');
			?>
			<br clear="both"/>
			<div id="eventsArea">
					
			</div>
			<div style="position:relative;   height:550px;">
			<?php echo $content; ?>
				
			</div>
    </div>

    <div id="footer">
      <ul class="fa-ul">
      <li><?=CHtml::link('Who we are', '')?></li>
          <li><i class="fa-li fa fa-circle"></i><?= CHtml::link('What we make', '')?></li>
          <li><i class="fa-li fa fa-circle"></i><?=CHtml::link('Work with us', '')?></li>
          <li><i class="fa-li fa fa-circle"></i><?=CHtml::link('Terms', '')?></li>
          <li><i class="fa-li fa fa-circle"></i><?=CHtml::link('Privacy', '')?></li>
          <li><i class="fa-li fa fa-circle"></i><?=CHtml::link('Contact', '')?></li>
          <li><i class="fa-li fa fa-circle"></i><?=CHtml::link('Topics by Specialty', '')?></li>
          <li><i class="fa-li fa fa-circle"></i><?=CHtml::link('Answers by Specialty', '')?></li>
      </ul>
      <div class="disclaimer">FinancialAsk does not provide financial advice<br>
      For these services, please see <?=CHtml::link('Additional Information', '')?></div>
      <div class="copy">&copy; 2014 FinancialAsk</div>
    </div>
	</div>


</div>

</body>
</html>
