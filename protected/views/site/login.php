<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Login';
$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;
$cs->registerCssFile($baseUrl . '/style/css/default/login.css');
?>
<div class="login-form">

    <span class="topic help-block text-center"><b>Good afternoon <span class="smile">:)</span></b>
        <div class="text-center">Welcome back</div>
    </span> 

    <div class="form">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'login-form',
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
        ));
        ?>

<!--	<p class="note">Fields with <span class="required">*</span> are required.</p>-->

        <div class="form-group">
            <!--		--><?php //echo $form->labelEx($model,'email',array('class'=>'control-label'));    ?>
            <?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control', 'placeholder' => 'Email')); ?>
            <?php echo $form->error($model, 'email'); ?>
        </div>

        <div class="form-group">
            <!--		--><?php //echo $form->labelEx($model,'password',array('class'=>'control-label'));    ?>
            <?php echo $form->passwordField($model, 'password', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control', 'placeholder' => 'Password')); ?>
            <?php echo $form->error($model, 'password'); ?>
        </div>

        <!--	<div class="form-group">-->
        <!--		--><?php // echo $form->checkBox($model,'rememberMe');     ?>
        <!--		--><?php //echo $form->label($model,'rememberMe',array('class'=>'control-label'));     ?>
        <!--		--><?php //echo $form->error($model,'rememberMe');     ?>
        <!--	</div>-->

		<input type="hidden" name="LoginForm[gcm_regid]" id="gcm_regid" value=""/>
        <div class="row buttons">
            <?php echo CHtml::submitButton('Log in', array('class' => 'btn btn-primary', 'id' => 'submitBtn')); ?>
        </div>
        <?php echo CHtml::link('Forgot password?', array(''), array('class' => 'text-center', 'style' => 'display:block;margin:20px 0;')); ?>

        <p class="text-center" style="margin:20px 0;">Not a member? <?php echo CHtml::link('Sign up', array('site/register')); ?></p>

        <?php $this->endWidget(); ?>
    </div>

</div><!-- form -->
