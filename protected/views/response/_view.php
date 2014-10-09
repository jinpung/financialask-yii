<?php
/* @var $this ResponseController */
/* @var $data QuestionResponse */

$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;
$cs->registerCssFile($baseUrl . '/css/questionResponse.css');
$cs->registerCssFile($baseUrl . '/style/css/default/viewQuestion.css');
$cs->registerCssFile($baseUrl . '/style/css/default/adviserRating.css');
$cs->registerScriptFile($baseUrl . '/js/adviserRating.js');

$adviserFlag = !Yii::app()->user->isGuest && Yii::app()->user->userModel->userTypeID == User::TYPE_ADVISER;
?>

<div class="answer-item feed-item shadowed" style="position: relative;">

    <div class="feed-item-author clearfix">
        <div class="feed-item-author-inner">
            <div class="avatar left" style="background-image: url('<?= $data->user->avatarUrl ?>')"></div>
            <div class="caduceus left"></div>
            <div class="feed-header-text">
                <?= CHtml::link(CHtml::encode($data->user->name), array('/profile/view', 'id' => $data->userId), array('class', 'author-name')) ?>
                <span>answered:</span>
      <?php if($data->refURL != '') echo "<a class=\"another-source\" target=\"_blank\" href=\"{$data->refURL}\">External content</a>" ?>
            </div>
        </div>
    </div>

    <div class="feed-item-content">
        <div class="answer-icon"></div>

        <?= CHtml::link(CHtml::encode($data->question->title), array('view', 'id' => $data->questionID), array('class' => 'question')) ?>
        <span class="in-brief">In brief:</span>
        <span class="short-answer">
            <?= Chtml::encode($data->brief) ?>
        </span>

        <div class="long-answer">
            <span
                class="answer-text"> <?php $this->widget('application.components.widgets.ReadMore', array('content' => $data->content)); ?></span>
        </div>
        <?php
            if (!$adviserFlag && $data->question->userId == Yii::app()->user->id) {
                $rating = !empty($data->responseRating->rating) ? $data->responseRating->rating : 0;
                $this->widget('application.components.widgets.adviserRating.AdviserRatings', array('rating' => $rating, 'responseId' => $data->id));
            }
        ?>
        <?php if ($data->imgUrl) { ?>
            <a class="answer-img" href="<?= $this->createUrl('view', array('id' => $data->questionID)) ?>"
               style="background-image: url('<?= $data->imgUrl ?>')"></a>
           <?php } else { ?>
               <?php $this->widget('ext.loremPixelWidget.LoremPixelWidget', array('category' => 'business')) ?>
           <?php } ?>
        <div class="answer-summary">
            <?= $data->summary ?>
        </div>

        <?php
          if (!$adviserFlag) $this->renderPartial('/questionResponseThanks/_thankBtn', array('response'=>$data));
          else $this->renderPartial('/question_agree/_agreeBtn', array('response'=>$data));
        ?>
        

    </div>
    <div class="agreeBlock">
<?php
$this->renderPartial('/question_agree/_responseAgrees', array(
    'response' => $data,
));
?>
    </div>
    <!--
            <a class="more-answers answer-list-el" href="FILLME_MORE_ANSWERS_URL" style="text-align: center;">
                    <span> See 1 more answer</span>
            </a>-->
</div>


