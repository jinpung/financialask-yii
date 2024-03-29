<?php
/* @var $this BookingController */
/* @var $model Booking */
/* @var $form CActiveForm */
?>

<div class="form">

	<?php $form = $this->beginWidget('CActiveForm', array(
		'id' => 'booking-form',
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation' => false,
	)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	<div class="row">
		<?php echo $form->labelEx($model, 'reason'); ?>
		<?php echo $form->textArea($model, 'reason', array('rows' => 6, 'cols' => 50)); ?>
		<?php echo $form->error($model, 'reason'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'calltime'); ?>
		<?php
		$this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
			'model' => $model, //Model object
			'language' => '',
			'attribute' => 'calltime', //attribute name
			'mode' => 'datetime', //use "time","date" or "datetime" (default)
			'options' => array(
				'dateFormat'=>'dd-mm-yy',
				'timeFormat' => 'hh:mm:ss',
				'showSecond' => true,
				'minDateTime'=>new CJavaScriptExpression('new Date()')
			) // jquery plugin options
		));
		?>

	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->