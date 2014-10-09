<?php
/* @var $this SiteController */
/* @var $model RegisterAdviserForm */
/* @var $form CActiveForm */
$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;
$cs->registerCssFile($baseUrl.'/style/css/default/register.css');
?>

<div class="register-form">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'adviser-wizard-form',
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>false,
		'stateful'=>true
	)); ?>
	<?php echo $form->errorSummary(array($model)); ?>
	<?php echo $form->hiddenField($model,'step',array('value'=>3)) ?>
	<?php echo $form->hiddenField($model,'email') ?>
	<?php echo $form->hiddenField($model,'password') ?>
	<?php echo $form->hiddenField($model,'name') ?>
	<?php echo $form->hiddenField($model,'displayname') ?>
	<?php echo $form->hiddenField($model,'avatarUrl') ?>

	<div class="form-group">
		<?php echo $form->textField($model,'phone',
			array(
				'size'=>20,
				'maxlength'=>20,
				'class'=>'form-control',
				'placeholder'=>$model->getAttributeLabel('phone')
			)
		); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->textField($model,'suburb',
			array(
				'size'=>60,
				'maxlength'=>200,
				'class'=>'form-control',
				'placeholder'=>$model->getAttributeLabel('suburb')
			)
		); ?>
		<?php echo $form->error($model,'suburb'); ?>
	</div>

	<?php echo CHtml::submitButton('Continue',array('class'=>'btn btn-primary','id'=>'submitBtn')); ?>

	<?php $this->endWidget(); ?>

</div><!-- form -->