<?php
/* @var $model ConfigModel */
/* @var $form CActiveForm */
$options = ($this->action->id == 'update') ? array('disabled'=>'disabled') : array();

?>

<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'config-form',
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
			'enableAjaxValidation'=>false,
	)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textField($model,'type',array_merge(array('size'=>60,'maxlength'=>255),$options)); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'key'); ?>
		<?php echo $form->textField($model,'key',array_merge(array('size'=>60,'maxlength'=>255),$options)); ?>
		<?php echo $form->error($model,'key'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'value'); ?>
		<?php echo $form->textField($model,'value',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'value'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Update'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->