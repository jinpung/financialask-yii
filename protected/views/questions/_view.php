<?php
/* @var $this QuestionController */
/* @var $data Question */
/* @var $this Controller */
/* @var $cs CClientScript */
$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;
$cs->registerCssFile($baseUrl.'/style/css/default/viewQuestion.css');
$cs->registerCssFile($baseUrl.'/css/questionResponse.css');


$loggedUserAsked = Yii::app()->user->id == $data->userId;
$loggedUser = User::model()->findByPk(Yii::app()->user->id);
?>
<div class="subheader">
    <div class="sharing">
        <div class="left">
            <div class="answer-icon"></div>
            Answers
        </div>
        <div class="right">
            <span class="follow-wrap icon-btn" data-follow="false">
                <?= $this->renderPartial('_followBtn', array('data' => $loggedUser, 'question' => $data)); ?>
            </span>
            <!--<span class="share-wrap icon-btn">
                <span class="share btn-text">Share</span>
                <i class="share-icon"></i>
            </span>-->
        </div>
    </div>
    <div class="span100 question-item-detail " style="position: relative;" onclick="location.href='<?= Yii::app()->createUrl('/questions/view', array('id' => $data->id)); ?>'">
        <div class="innerText">
            <div class="question-author"><?= ($loggedUserAsked ? "You" : "A user"); ?> asked:</div>
            <div class="question-content"><?= $data->content ?></div>
            <div class="adviser-answers-count"><?= $data->responsesCount == 0 ? "No" : $data->responsesCount ?> advisor answer<?= $data->responsesCount == 0 ? "s" : "" ?></div>
            <?php if($data->refURL != '') echo "<a class=\"another-source\" target=\"_blank\" href=\"{$data->refURL}\">External content (Full article here)</a>" ?>
        </div>
        <div class="tabs">
            <div class="action-tab learn active">
                <div class="action-icon learn-tab-icon"></div>
                <div class="action-text">Learn</div>
                <div class="active-indicator"></div>
            </div>
            <div class="action-tab talk2docs" data-content="talk2docs-module">
                <div class="action-icon about-icon"></div>            
                <div class="action-text">Talk&nbsp;to&nbsp;Advisers</div>            
                <div class="active-indicator hidden"></div>          
            </div>
        </div>
    </div>
</div>
