<?php
/* @var $this SiteController */
/* @var $model RegisterAdviserForm */
/* @var $form CActiveForm */
$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;
$cs->registerCssFile($baseUrl . '/style/css/default/register.css')
        ->registerCssFile($baseUrl . '/style/css/default/sprites.css');
$cs->registerScriptFile($baseUrl . '/js/adviserRegister_step2.js', CClientScript::POS_END);
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
        'stateful' => true,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
    ));
    ?>
    <span class="topic help-block text-center"><b>Complete your profile</b></span>
    <?php echo $form->hiddenField($model, 'step', array('value' => 2)) ?>
    <?php echo $form->hiddenField($model, 'email') ?>
    <?php echo $form->hiddenField($model, 'password') ?>
    <div class="step" id="step2" >
        <div class="form-group">
            <?php
            echo $form->textField($model, 'name', array(
                'size' => 60,
                'maxlength' => 255,
                'class' => 'form-control',
                'placeholder' => $model->getAttributeLabel('name')
                    )
            );
            ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>
        <div class="form-group">
            <?php
            echo $form->textField($model, 'displayname', array(
                'size' => 60,
                'maxlength' => 255,
                'class' => 'form-control',
                'placeholder' => $model->getAttributeLabel('displayname')
                    )
            );
            ?>
            <?php echo $form->error($model, 'displayname'); ?>
        </div>
        <div class="form-group">
            <div class='member-avatar'>
                <div class='optional-overlay text-center'>Your photo (optional)</div>
                <div class='loading-container hidden'>
                    <div class='fg-spinner'></div>
                </div>                
                <?php echo $form->fileField($model, 'file'); ?>
                <div class='camera-button-icon' name='image_preview[avatar]'></div>
            </div>
            <?php echo $form->error($model, 'file'); ?>
        </div>        
        <div class="form-group">
            <?php echo $form->dropDownList($model, 'gender', User::model()->genderList); ?>

            <?php echo $form->error($model, 'gender'); ?>
        </div>
    </div>
    <?php echo CHtml::submitButton('Continue', array('class' => 'btn btn-primary', 'id' => 'submitBtn')); ?>

    <?php $this->endWidget(); ?>

</div><!-- form -->