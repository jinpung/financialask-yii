<?php
/* @var $this SiteController */
/* @var $model RegisterAdviserForm */
/* @var $form CActiveForm */
$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;
$cs->registerCssFile($baseUrl.'/style/css/default/register.css');
$cs->registerCssFile($baseUrl.'/style/css/default/sprites.css');
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
	<span class="topic help-block text-center">Create a <b>free, private, secure</b> account</span>
	
	<?php echo $form->hiddenField($model,'step',array('value'=>1)) ?>
	<div class="form-group">
		<?php echo $form->textField($model,'email',
			array(
				'size'=>60,
				'maxlength'=>255,
				'class'=>'form-control',
				'placeholder'=>$model->getAttributeLabel('email'),
                'required' => 'required',
			)
		); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->passwordField($model,'password',
			array(
				'size'=>60,
				'maxlength'=>255,
				'class'=>'form-control',
				'placeholder'=>$model->getAttributeLabel('password'),
                'required' => 'required',
			)
		); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->passwordField($model,'passwordRepeat',
			array(
				'size'=>60,
				'maxlength'=>255,
				'class'=>'form-control',
				'placeholder'=>$model->getAttributeLabel('passwordRepeat'),
                'required' => 'required',
			)
		); ?>
		<?php echo $form->error($model,'passwordRepeat'); ?>
	</div>
	<?php echo CHtml::submitButton('Get started',array('class'=>'btn btn-primary','id'=>'submitBtn')); ?>

	<?php $this->endWidget(); ?>
	<p class="text-center"  style="margin:20px 0;">You agree to our <?php echo CHtml::link('Terms',array('')); ?> and <?php echo CHtml::link('Privacy Policy',array('')); ?><p>
	<p class="text-center" style="margin:20px 0;">Already a user? <?php echo CHtml::link('Log in',array('site/login')); ?></p>
	<?php echo CHtml::link('<span class="caduceus-big"></span>Adviser sign up',array('registerAdviser'),array('class'=>'text-center','style'=>'display:block;margin:20px 0;')); ?>
</div><!-- form -->