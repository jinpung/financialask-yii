<?php
/* @var $this AdviserController */
/* @var $model Adviser */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'userId'); ?>
		<?php echo $form->textField($model,'userId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>1024)); ?>
	</div>


	<div class="row">
		<?php echo $form->label($model,'postcode'); ?>
		<?php echo $form->textField($model,'postcode',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bio'); ?>
		<?php echo $form->textField($model,'bio',array('size'=>60,'maxlength'=>10000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pointSum'); ?>
		<?php echo $form->textField($model,'pointSum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pointCount'); ?>
		<?php echo $form->textField($model,'pointCount'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'reviewCount'); ?>
		<?php echo $form->textField($model,'reviewCount'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'reviewSum'); ?>
		<?php echo $form->textField($model,'reviewSum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'answerCount'); ?>
		<?php echo $form->textField($model,'answerCount'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->