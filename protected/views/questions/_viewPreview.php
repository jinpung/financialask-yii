<?php
/* @var $this QuestionController */
/* @var $data Question */
/* @var $this Controller */
/* @var $cs CClientScript */
$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;

$cs->registerCssFile($baseUrl . '/style/css/default/adviserRating.css');
$cs->registerScriptFile($baseUrl . '/js/adviserRating.js');

$loggedUserAsked = Yii::app()->user->id == $data->userId;
$adviserFlag = !Yii::app()->user->isGuest && Yii::app()->user->userModel->userTypeID == User::TYPE_ADVISER;
?>
<div class="answer-item feed-item">
    <?php if ($data->responses) { ?>

    <?php } ?>
    <div class="feed-item-content">
        <div class="answer-icon"></div>
        <a href="<?php echo $this->createUrl('questions/view', array('id' => $data->id)); ?>" class="question"><?php echo CHtml::encode($data->title); ?></a>
    <a href="<?= $this->createUrl('view', array('id' => $data->id)) ?>">
        <?php echo $data->content; ?>
    </a>
        <?php if (false && $data->responses && count($data->responses)>0) { ?>
        
            <div class="feed-item-author clearfix">
                <div style="background-image: url('<?php echo $data->responses[0]->user->avatarUrl; ?>')" class="avatar left"></div>
                <div class="caduceus left"></div>
                <div class="feed-header-text">
                    <a href="<?php echo $this->createUrl('profile/view', array('id' => $data->responses[0]->user->id)) ?>" class="author-name"><?php echo CHtml::encode($data->responses[0]->user->displayname); ?></a>
                    <span>answered:</span>
                </div>
            </div>
            <?php
            if (!$adviserFlag && $data->userId == Yii::app()->user->id) {
                $rating = !empty($data->responses[0]->QuestionResponse->rating) ? $data->responses[0]->QuestionResponse->rating : 0;
                $this->widget('application.components.widgets.adviserRating.AdviserRatings', array('rating' => $rating, 'responseId' => $data->responses[0]->id));
            }
            ?>
            <span class="in-brief">In brief:</span>
            <span class="short-answer"><?php echo CHtml::encode($data->responses[0]->brief); ?></span>
            <div class="long-answer"><?php echo CHtml::encode($data->responses[0]->content); ?></div>
            <?php if ($data->responses[0]->imgUrl) { ?>
                <a style="background-image: url('<?php echo $data->responses[0]->imgUrl; ?>')" href="/user_questions/554772" class="answer-img"></a>
            <?php } ?>
            <div class="long-answer"><?php echo CHtml::encode($data->responses[0]->summary); ?></div>
        <?php } else { ?>
<!--            <div class="adviser-answers-count">No advisor answers</div>-->
        <?php } ?>
        <div class="adviser-answers-count"><?= $data->responses && count($data->responses)>0 ? count($data->responses)." answers" : "No advisor answers"?></div>
      <?php if($data->refURL != '') echo "<a class=\"another-source\" target=\"_blank\" href=\"{$data->refURL}\">External content</a>" ?>
    </div>
</div>
