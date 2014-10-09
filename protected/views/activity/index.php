<?php
/* @var $this ActivityController */
/* @var $dataProvider CActiveDataProvider */
/* @var $cs CClientScript */
$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;
$cs->registerCssFile($baseUrl . '/style/css/default/viewQuestion.css')
        ->registerCssFile($baseUrl . '/style/css/default/askQuestion.css')
        ->registerCssFile($baseUrl . '/css/questionResponse.css')
        ->registerScriptFile($baseUrl . '/js/activity.js');

$messages = Yii::app()->user->getFlashes();
if (isset($messages['question_success'])) {
    ?>
    <div id="question-submit-notification" class="top-content">
        <div class="sprite-icon question-sent"></div>
        <div class="text-1">Your question has been submitted</div>
        <div class="text-2">You will receive a notification once an adviser has responded.</div>
    </div>
<?php } ?>
<div ng-controller="ActivitiesController">
    <div id="container-feed"
         isotope-container="isotope-container"
         infinite-scroll="load()"
         infinite-scroll-container="maincont"
         infinite-scroll-distance="0"
         infinite-scroll-disabled="isDisabled()">

        <div ng-repeat="feed in feeds" class="{{feed.type}}-item feed-item" isotope-item="isotope-item" ng-include="tpl(feed.type)">
        </div>

    </div>

    <div class="fg-spinner" id="loading-more" style=" margin: 20px auto;" ng-show="loading"></div>
</div>
