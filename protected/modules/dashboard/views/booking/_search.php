<?php
/* @var $this BookingController */
/* @var $model Booking */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'userId'); ?>
		<?php echo $form->textField($model,'userId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'adviserId'); ?>
		<?php echo $form->textField($model,'adviserId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'callId'); ?>
		<?php echo $form->textField($model,'callId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'reason'); ?>
		<?php echo $form->textArea($model,'reason',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'datetime'); ?>
		<?php echo $form->textField($model,'datetime'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->