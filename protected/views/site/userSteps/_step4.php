<?php
/* @var $this SiteController */
/* @var $model RegisterAdviserForm */
/* @var $form CActiveForm */
$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;
$cs->registerCssFile($baseUrl . '/style/css/default/register.css');
$cs->registerScript('onload', '$(document).ready(function(){
            $("#acceptterms").change(function(){
                if($(this).is(":checked")){
                    $("#submitBtn").removeAttr("disabled");
                }else{
                    $("#submitBtn").prop("disabled", "disabled");
                }
            })
        })', CClientScript::POS_END);
?>

<div class="register-form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'adviser-wizard-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'stateful' => true
    ));
    ?>
    <?php echo $form->errorSummary(array($model)); ?>
    <?php echo $form->hiddenField($model, 'step', array('value' => 4)) ?>
    <?php echo $form->hiddenField($model, 'email') ?>
    <?php echo $form->hiddenField($model, 'password') ?>
    <?php echo $form->hiddenField($model, 'name') ?>
    <?php echo $form->hiddenField($model, 'displayname') ?>
    <?php echo $form->hiddenField($model, 'avatarUrl') ?>
    <?php echo $form->hiddenField($model, 'suburb') ?>
    <?php echo $form->hiddenField($model, 'phone') ?>
    <span class="topic help-block text-center">Terms of Use</span>
    <div class="form-group content-terms">
        To clarify what this document means, certain words with capital letters will be defined. Here are the definitions for this agreement:
        "HealthTap" or the "Apps" means https://www.healthtap.com and related web sites and HealthTap's mobile applications, including HealthTap, HealthTap for Doctors, Talk to Docs (other terms apply), HealthTap Prime (other terms apply) and any other Apps we release.
    </div>
    <div class="form-group accept-terms">   
        <input type="checkbox" id="acceptterms"/><label for="acceptterms">I consent to the terms of use</label>
    </div>	
    <?php echo CHtml::submitButton('Continue', array('class' => 'btn btn-primary', 'id' => 'submitBtn', 'disabled' => 'disabled')); ?>

    <?php $this->endWidget(); ?>

</div><!-- form -->