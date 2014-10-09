<?php
/* @var $this ResponseController */
/* @var $model QuestionResponse */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'question-response-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'questionID'); ?>
		<?php echo $form->textField($model,'questionID'); ?>
		<?php echo $form->error($model,'questionID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'userId'); ?>
		<?php echo $form->textField($model,'userId'); ?>
		<?php echo $form->error($model,'userId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'brief'); ?>
		<?php echo $form->textField($model,'brief',array('size'=>60,'maxlength'=>5120)); ?>
		<?php echo $form->error($model,'brief'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'summary'); ?>
		<?php echo $form->textField($model,'summary',array('size'=>60,'maxlength'=>5120)); ?>
		<?php echo $form->error($model,'summary'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textField($model,'content',array('size'=>60,'maxlength'=>5120)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'datetime'); ?>
		<?php echo $form->textField($model,'datetime'); ?>
		<?php echo $form->error($model,'datetime'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->