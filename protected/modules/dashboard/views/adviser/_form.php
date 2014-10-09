<?php
/* @var $this AdviserController */
/* @var $model Adviser */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'adviser-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'userId'); ?>
		<?php echo $form->textField($model,'userId'); ?>
		<?php echo $form->error($model,'userId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->checkBox($model,'active'); ?>
		<?php echo $form->error($model,'active'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>1024)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'postcode'); ?>
		<?php echo $form->textField($model,'postcode',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'postcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bio'); ?>
		<?php echo $form->textArea($model,'bio'); ?>
		<?php echo $form->error($model,'bio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'directCalls'); ?>
		<?php echo $form->checkBox($model,'directCalls'); ?>
		<?php echo $form->error($model,'directCalls'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'pointSum'); ?>
		<?php echo $form->textField($model,'pointSum'); ?>
		<?php echo $form->error($model,'pointSum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pointCount'); ?>
		<?php echo $form->textField($model,'pointCount'); ?>
		<?php echo $form->error($model,'pointCount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reviewCount'); ?>
		<?php echo $form->textField($model,'reviewCount'); ?>
		<?php echo $form->error($model,'reviewCount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reviewSum'); ?>
		<?php echo $form->textField($model,'reviewSum'); ?>
		<?php echo $form->error($model,'reviewSum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'answerCount'); ?>
		<?php echo $form->textField($model,'answerCount'); ?>
		<?php echo $form->error($model,'answerCount'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->