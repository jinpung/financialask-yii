<?php
/* @var $this Controller */
/* @var $cs CClientScript */
$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;
$cs // this is equal to /components/jquery/dist/jquery.min.js, but prevents Yii widgets from including additional copy of library
	->registerCoreScript('jquery')
//	->registerCoreScript('jquery.ui')
//	->registerScriptFile($baseUrl . '/bootstrap/js/bootstrap.min.js', CClientScript::POS_END)
	->registerScriptFile($baseUrl . '/components/fastclick/lib/fastclick.js', CClientScript::POS_END)
//	->registerScriptFile($baseUrl . '/components/jquery/dist/jquery.min.js')
	->registerScriptFile($baseUrl . '/components/jquery-cookie/jquery.cookie.js')
	->registerScriptFile($baseUrl . '/components/jquery-ui/jquery-ui.min.js')
	->registerScriptFile($baseUrl . '/components/nanoscroller/bin/javascripts/jquery.nanoscroller.js', CClientScript::POS_END)
	->registerScriptFile($baseUrl . '/components/isotope/jquery.isotope.min.js', CClientScript::POS_END)
	->registerScriptFile($baseUrl . '/components/bootstrap/dist/js/bootstrap.js', CClientScript::POS_END)
	->registerScriptFile($baseUrl . '/components/bootbox/bootbox.js',CClientScript::POS_END)
	->registerScriptFile($baseUrl . '/components/angular/angular.min.js', CClientScript::POS_END)
	->registerScriptFile($baseUrl . '/components/angular-isotope/dist/angular-isotope.min.js', CClientScript::POS_END)
	->registerScriptFile($baseUrl . '/components/ngInfiniteScroll/build/ng-infinite-scroll.js', CClientScript::POS_END)
	->registerScriptFile($baseUrl . '/js/core.js', CClientScript::POS_END)
	->registerScriptFile($baseUrl . '/js/app.js?'.date('YmdHis'), CClientScript::POS_END)
	->registerCssFile($baseUrl . '/components/bootstrap/dist/css/bootstrap.min.css')
	->registerCssFile($baseUrl . '/components/font-awesome/css/font-awesome.min.css')
	->registerCssFile($baseUrl . '/components/nanoscroller/bin/css/nanoscroller.css')
  ->registerCssFile($baseUrl . '/style/css/default/menu.css?'.date('YmdHis'))
  ->registerCssFile($baseUrl . '/style/css/default/notifications.css?'.date('YmdHis'))
  ->registerScriptFile($baseUrl . '/js/notificationMenu.js', CClientScript::POS_END)
	->registerCssFile($baseUrl . '/css/main-ng.css?'.date('YmdHis'))
	->registerCssFile($baseUrl . '/css/financialask-responsive.css?'.date('YmdHis'));

	// Testing AJAX links
	if(isset($_GET['ajax_wrapper']) && $_GET['ajax_wrapper']=='1')
		$cs->registerScriptFile($baseUrl . '/js/ajax_links.js');
?><!DOCTYPE html>
<html lang="en" ng-app="faApp">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="<?php echo $baseUrl ?>/images/icon.png">

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Raleway:300,200,100' rel='stylesheet' type='text/css'> 

</head>
<body class="animated sb-collapsed" ng-controller="MainController" ng-class="{'sb-collapsed': collapsed}" resize>

<div id="head-nav" class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div id="fa-navbar" class="right">
			<a class="icon-box you-box" ng-click="showYou()">
				<div class="you-nav-icon"></div>
				<div class="text">You</div>
			</a>
			<a class="icon-box home-box" href="<?php echo $this->createUrl('/activity')?>">
				<div class="feed-nav-icon"></div>
				<div class="text">Home</div>
			</a>
			<a class="icon-box search-box" href="<?php echo $this->createUrl('/search')?>">
				<div class="search-nav-icon"></div>
				<div class="text">Search</div>
			</a>
			<a class="icon-box ask-docs" href="<?php echo $this->createUrl('/questions/ask')?>">
				<div class="talk2docs-nav-icon"></div>
				<div class="text">Ask</div>
			</a>
			<a class="icon-box checklists-box" href="<?php echo $this->createUrl('/adviser/index')?>">
				<div class="checklists-nav-icon">
				<!--	<div class="red-circle" style="display: none;">
						<div class="number"></div>
					</div>-->
				</div>
				<div class="text">Advisers</div>
			</a>
		</div>
		<a class="navbar-brand" id="navbar-brand-logo" href="<?php echo Yii::app()->baseUrl ?>"><img src="<?php echo Yii::app()->baseUrl ?>/img/financialask_logo.png"></a>
	</div>
</div>

<div class="cl-sidebar" ng-mouseover="over()" ng-mouseleave="leave()">
	<div class="cl-navblock">
		<div class="menu-space">
			<div class="content">
				<div class="sidebar-logo">
					<div class="logo">
					</div>
				</div>
				<?php /* <div class="upper">
					<div class="hello">
						Hi Ivan!
					</div>
					<div class="progressBar">
						<!-- .inner{ :style => 'width: '+percent_str } -->
						<div class="inner" style="width: 37%;"></div>
						<div class="apex" style="display: block;">
							<div class="percent-completion">37%</div>
						</div>
					</div>
					<div class="text"></div>
					<div class="profile">
						<a class="profile-link link" data=".profile-container">
							Complete your profile ›
						</a>
						<p class="sub-text">
							for better answers
						</p>
						<!-- %a.sign -->
						<!-- =" ›" -->
					</div>
				</div> */ ?>
				<ul class="cl-vnavigation">
					<?php
					$this->widget('application.components.widgets.MenuItems');
        ?>
<!--
					<li><a href="#"><i class="fa fa-home"></i><span>Test Parent Menu</span></a>
						<ul class="sub-menu">
							<li class="active"><a href="index.html">Test Sub 1</a></li>
							<li><a href="dashboard2.html"><span class="label label-primary pull-right">New</span>Test Sub 2</a></li>
						</ul>
					</li>
-->
				</ul>
			</div>
		</div>
		<div class="text-right collapse-button" style="padding:7px 9px; display: none;">
			<button id="sidebar-collapse" class="btn btn-default" style=""><i style="color:#fff;"
			                                                                  class="fa fa-angle-left"></i></button>
		</div>
	</div>
</div>

<div id="cl-wrapper">


	<div class="container-fluid" id="pcont">
<?php
$user = Yii::app()->user;
if(!$user->isGuest && $user->userModel->userTypeID == User::TYPE_ADVISER)
	$this->widget('application.components.widgets.adviserStatus.AdviserStatus');
?>
		<div class="cl-mcont">

			<section id="content">
			<?php echo $content; ?>
			</section>
      <?php $this->renderPartial('/site/_notifications'); ?>
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
