<?php
/* @var $this QuestionController */
/* @var $model Question */
$this->renderPartial('_view', array('data' => $model));


//var_dump(Yii::app()->user);
//die();

$adviserFlag = !Yii::app()->user->isGuest && Yii::app()->user->userModel->userTypeID == User::TYPE_ADVISER;
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
if ($adviserFlag) {
    $cs->registerScriptFile($baseUrl . '/js/questionResponse.js');
    $cs->registerScriptFile($baseUrl . '/js/plugins/jquery_textarea_v2/jquery.textareaCounter.plugin.js');
}
$cs->registerCssFile($baseUrl . '/css/style-fix.css');
$cs->registerCssFile($baseUrl . '/style/css/default/sprites.css');
//$cs->registerCssFile($baseUrl . '/style/css/default/questionList.css');
$cs->registerCssFile($baseUrl . '/style/css/default/question.css');
?>

<div id="answers" class="span66 left">

    <?php
    foreach ($model->responses as $responseItem) {
        $this->renderPartial('/response/_view', array('data' => $responseItem));
    }
    if (count($model->responses) == 0) {
        ?>
        <div class="answer-item feed-item no-answer-item" style="position: relative;">
            <div class="no-answer">
                Sorry, there are no answers to this question yet.
            </div>
        </div>
        <?php
    }
    ?>
    <?php if ($adviserFlag): ?>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'response-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation' => false,
        ));
        ?>
        <div class="feed-item">
            <div class="heading">Submit a Response</div>
            <?php //$form->textArea($response, 'summary', array('rows' => 1, 'maxlength' => 50, 'class' => 'form-control titleField', 'placeholder' => 'Brief summary of the question')); ?>
            <?php //$form->error($response, 'summary'); ?>
            <div class="form-group">
                <div class="counterWrapper">
                    <?= $form->textArea($response, 'content', array('rows' => 5, 'maxlength' => 5120, 'class' => 'form-control responseInput', 'placeholder' => 'Answer to the question')); ?>
                </div>
                <?= $form->error($response, 'content'); ?>
            </div>

            <div class="form-group">
                <div class="subheading mid">In Brief</div>
                <div class="counterWrapper">
                    <?= $form->textArea($response, 'brief', array('rows' => 2, 'maxlength' => 25, 'class' => 'form-control briefInput', 'placeholder' => 'Brief keyword answer to the question')); ?>
                </div>
                <?= $form->error($response, 'brief'); ?>
            </div>
            
            <div class="form-group">
                <div class="subheading text-left"><a href="#" id="add-stock-image">Add Stock Image</a></div>

                <div class="counterWrapper" style="">
                    <!--<div class="span50 left" style="min-width: initial;">-->
                    <div id="slider" style="display:none;">  
                        <a href="#" class="control_next">&gt;</a>
                        <a href="#" class="control_prev">&lt;</a>
                        <ul>
                            <?php
                            foreach ($images as $item) {
                                printf('<li style="background-image: url(%s)" data="%s">%s</li>', $item, $item, '');
                            }
                            ?>
                        </ul>  
                    </div>
                    <div class="select-image" style="display:none;">
                    </div>
                    <div class="mid" id="contorl-image" style="display:none;"><a href="#" id="change-stock-image">change</a><a href="#">|</a><a href="#" id="cancel-stock-image">cancel</a></div>
                    <div class="clear"></div>
                </div>
                <?= $form->hiddenField($response, 'imgUrl'); ?>
                <?= $form->error($response, 'imgUrl'); ?>
            </div>

            
          <?php
          echo CHtml::ajaxSubmitButton("Respond", array('/questions/respond', 'id' => $model->id), array(
            'beforeSend' => 'function(xhr, s){
                if($("#QuestionResponse_imgUrl").val() == ""){
                  // Since imgUrl is the last field, we can do this!
                  var imgs = $("#slider ul li");
                  s.data += $(imgs[Math.floor(Math.random() * imgs.length)]).attr("data");
                }
        }',
              'success' => 'function(ret){
            successResponse(ret);
          }', 'dataType' => 'json'), array('class' => 'thank-btn btn submitBtn', 'id' => 'submitBtn')
            );
            ?>
        </div>

        <?php $this->endWidget(); ?>
    <?php endif; ?>
</div>

<div class="span33 right">
    <?php
    $this->widget('application.components.widgets.relatedTopics.RelatedTopics', array(
        'htmlOptions' => array(
            'class' => 'related-topics'
        )
            )
    );
    ?>
    <?php
    $this->widget('application.components.widgets.relatedQuestions.RelatedQuestions', array(
        'htmlOptions' => array(
            'class' => 'related-questions'
        )
            )
    );
    ?>
</div>
<div class="clear"></div>
