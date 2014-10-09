<?php
/* @var $data Adviser */
$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;
$cs->registerCssFile($baseUrl.'/style/css/default/viewQuestion.css');
$cs->registerCssFile($baseUrl.'/css/questionResponse.css');
?>

<div class="adviserBlock" style="clear: both">
	<div class="avatar left" style="background-image: url('<?=$data->user->avatarUrl?>')"></div>
	 <div class="caduceus left"></div>
	 <div class="doctor-info left" itemprop="url">
		<?=CHtml::link(CHtml::encode($data->user->name), array('/profile/view', 'id'=>$data->userId), array('class'=>'author-name'))?>
		<br clear="both">
	 </div>

	 <div class="clearfix"></div>
	 <?=CHtml::link('Call',array('chat/call','adviserId'=>$data->id),array('class'=>'btn submit-btn btn-block'))?>
</div>
