<?php
/* @var $this QuestionController */
/* @var $model Question */
/* @var $form CActiveForm */
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/askQuestion.js', CClientScript::POS_END);
$cs->registerScriptFile($baseUrl.'/js/plugins/jquery_textarea_v2/jquery.textareaCounter.plugin.js', CClientScript::POS_END);
?>

<div class="form-group">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'question-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


		<?= $form->textArea($model,'content',array('rows'=>5,'maxlength'=>255,'class'=>'form-control questionInput', 'placeholder'=>'Enter your descriptive question here')); ?>
		<?= $form->error($model,'content'); ?>
	</div>
	<?= CHtml::submitButton('Ask',array('class'=>'submitBtn', 'disabled'=>'disabled')); ?>

<?php $this->endWidget(); ?>

<!-- form -->
