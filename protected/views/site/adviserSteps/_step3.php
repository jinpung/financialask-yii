<?php
/* @var $this SiteController */
/* @var $model RegisterAdviserForm */
/* @var $form CActiveForm */
$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;
$cs->registerCssFile($baseUrl . '/style/css/default/registerAdviser.css');
//$cs->registerCssFile($baseUrl . '/bootstrap/css/bootstrap-select.css');
echo '<link rel="stylesheet" type="text/css" href="/components/bootstrap-select-master/dist/css/bootstrap-select.min.css">';
//$cs->registerScriptFile($baseUrl.'/bootstrap/js/bootstrap-select.min.js', CClientScript::POS_END);

$cs->registerScriptFile($baseUrl . '/js/adviserRegister_step3.js', CClientScript::POS_END);

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
    <?php echo $form->hiddenField($model, 'step', array('value' => 3)) ?>
    <?php echo $form->hiddenField($model, 'email') ?>
    <?php echo $form->hiddenField($model, 'password') ?>
    <?php echo $form->hiddenField($model, 'name') ?>
    <?php echo $form->hiddenField($model, 'displayname') ?>
    <?php echo $form->hiddenField($model, 'avatarUrl') ?>
    <div class="form-group">
        <?php
        echo $form->textField($model, 'phone', array(
            'size' => 20,
            'maxlength' => 20,
            'class' => 'form-control',
            'placeholder' => $model->getAttributeLabel('phone')
                )
        );
        ?>
        <?php echo $form->error($model, 'phone'); ?>
    </div>
    
    

    <div class="form-group">
        <?php
        echo $form->textField($model, 'address', array(
            'size' => 60,
            'maxlength' => 1024,
            'class' => 'form-control',
            'placeholder' => $model->getAttributeLabel('address')
                )
        );
        ?>
        <?php echo $form->error($model, 'address'); ?>
    </div>

    <div class="form-group">
        <?php
        echo $form->textField($model, 'suburb', array(
            'size' => 60,
            'maxlength' => 200,
            'class' => 'form-control',
            'placeholder' => $model->getAttributeLabel('suburb')
                )
        );
        ?>
        <?php echo $form->error($model, 'suburb'); ?>
    </div>

    <div class="form-group">
        <?php
        echo $form->textField($model, 'postcode', array(
            'size' => 10,
            'maxlength' => 10,
            'class' => 'form-control',
            'placeholder' => $model->getAttributeLabel('postcode')
                )
        );
        ?>
        <?php echo $form->error($model, 'postcode'); ?>
    </div>
    <div class="form-group">
        <?php
        echo $form->textField($model, 'yearStartPractice', array(
            'size' => 10,
            'maxlength' => 4,
            'class' => 'form-control',
            'placeholder' => $model->getAttributeLabel('yearStartPractice')
                )
        );
        ?>
        <?php echo $form->error($model, 'postcode'); ?>
    </div>
    
    <div class="form-group text-center">
        <?php echo $form->dropDownList($model, 'specialtiesList', array_merge(array(), Specialties::getList()), 
                array('class' => 'selectpicker',
                      'multiple' => 'multiple',
                      'title' => 'Specialties Lists',
                      'data-selected-text-format' => 'count>4',
                      'data-width'  => "275px"
                     )); ?>
        <?php echo $form->error($model, 'specialtiesList'); ?>
    </div>
    
    <div class="form-group">
        <?php
        echo $form->textArea($model, 'bio', array(
            'size' => 60,
            'maxlength' => 10000,
            'class' => 'form-control',
            'placeholder' => $model->getAttributeLabel('bio')
        ));
        ?>
        <?php echo $form->error($model, 'bio'); ?>
    </div>
    <?php echo CHtml::submitButton('Continue', array('class' => 'btn btn-primary', 'id' => 'submitBtn')); ?>

    <?php $this->endWidget(); ?>

</div><!-- form -->