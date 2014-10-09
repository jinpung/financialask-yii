<?php
/* @var $this QuestionController */
/* @var $model Question */
/* @var $cs CClientScript */
$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;
$cs->registerCssFile($baseUrl . '/style/css/default/askQuestion.css');
$cs->registerCssFile($baseUrl . '/css/questionResponse.css');
?>
<div class="askWrapper ">
    <div class='banner'>
        <div class="question-form-img"></div>
        <div class="adviserCount">
            <i class="fa fa-circle"></i> <?= Adviser::model()->count() ?> Advisers available
            <div class="icons">
                <i class="fa fa-video-camera"></i>
                <i class="fa fa-phone"></i>
                <i class="fa fa-comments-o"></i>
                <i class="fa fa-envelope-o"></i>
            </div>
        </div>
    </div>
    <div class="askHeader">What is your question?</div>
    <div class="form">
        <?php $this->renderPartial('_form', array('model' => $model)); ?>
    </div>
</div>
