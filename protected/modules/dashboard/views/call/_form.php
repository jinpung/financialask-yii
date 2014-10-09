<?php
/* @var $this CallController */
/* @var $model Call */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'call-form',
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
		<?php echo $form->labelEx($model,'adviserId'); ?>
		<?php echo $form->textField($model,'adviserId'); ?>
		<?php echo $form->error($model,'adviserId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sessionId'); ?>
		<?php echo $form->textField($model,'sessionId',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'sessionId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'datatime'); ?>
		<?php echo $form->textField($model,'datatime'); ?>
		<?php echo $form->error($model,'datatime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',$model->getStatusList()); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->