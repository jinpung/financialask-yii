<?php
/* @var $this SearchController */
/* @var $cs CClientScript */
$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;
$cs->registerCssFile($baseUrl . '/style/css/default/search.css');
$cs->registerCssFile($baseUrl . '/style/css/default/questionList.css');
?>
<div id="content">
    <div class="content_inner clearfix">
        <div class="page-wrapper">
            <div class="subheader">
                <div data-context="Abilify," data-checked-context="Abilify," class="sharing clearfix">
                    <div class="left">
                        <i class="topic-icon"></i>
                        Topic
                    </div>
                </div>
                <div style="background-image: url('<?php echo $topicBg ?>'); background-position: center;" class="photo">
                    <div class="black-gradient"></div>
                    <div class="topic-text">
                        <div class="topic-title">
                            <?php echo $topic; ?>
                        </div>
                        <span style="" class="known-as"></span>
                        <!-- %i{class: common_class} -->
                        <!-- .topic-prevalence #{@topic.prevalence} -->
                    </div>
                </div>
                <div class="actions tabs2">
                    <div data-content="learn-module" class="action-tab active learn">
                        <div class="action-icon learn-tab-icon"></div>
                        <div class="action-text">Learn</div>
                        <div class="active-indicator"></div>
                    </div>
                    <a href="<?php echo $this->createUrl('adviser/talk'); ?>">
                        <div data-content="talk2docs-module" class="action-tab talk2docs">
                            <div class="action-icon about-icon"></div>
                            <div class="action-text">Talk to Adviser</div>
                            <div class="active-indicator"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="learn-module">
                <div class="span66 left left-panel">
                    <div class="feed-container">
                        <?php
                        foreach ($questions as $question) {
                            ?>
                            <div class="answer-item feed-item">
                                <?php if ($question->responses) { ?>
                                    <div class="feed-item-author clearfix">
                                        <div style="background-image: url('<?php echo $question->responses[0]->user->avatarUrl; ?>')" class="avatar left"></div>
                                        <div class="caduceus left"></div>
                                        <div class="feed-header-text">
                                            <a href="<?php echo $this->createUrl('profile/view', array('id' => $question->responses[0]->user->id)) ?>" class="author-name"><?php echo CHtml::encode($question->responses[0]->user->displayname); ?></a>
                                            <span>answered:</span>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="feed-item-content">
                                    <div class="answer-icon"></div>
                                    <a href="<?php echo $this->createUrl('questions/view', array('id' => $question->id)); ?>" class="question"><?php echo CHtml::encode($question->title); ?></a>
                                    <?php if ($question->responses) { ?>
                                        <span class="in-brief">In brief:</span>
                                        <span class="short-answer"><?php echo CHtml::encode($question->responses[0]->brief); ?></span>
                                        <div class="long-answer"><?php echo CHtml::encode($question->responses[0]->content); ?></div>
                                        <?php if ($question->responses[0]->imgUrl) { ?>
                                            <a style="background-image: url('<?php echo $question->responses[0]->imgUrl; ?>')" href="<?php echo $this->createUrl('questions/view', array('id' => $question->id)) ?>" class="answer-img"></a>
                                        <?php } ?>
                                        <div class="long-answer"><?php echo CHtml::encode($question->responses[0]->summary); ?></div>
                                        <div track_event="thank_answer" class="thank-btn btn">
                                            <div class="thank-icon"></div>
                                            Thank
                                        </div>
                                    <?php } else { ?>
                                        <div class="adviser-answers-count">No advisor answers</div>
                                    <?php } ?>

                                </div>
                            </div>
                            <?php
                        }
                        if (!$questions) {
                            ?>
                            <div class="answer-item feed-item">
                                <div class="no_result">
                                    Sorry, no search results found
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="span33 right right-panel">
                    <?php
                    $this->widget('application.components.widgets.relatedTopics.RelatedTopics', array(
                        'htmlOptions' => array('class' => 'related-topics'))
                    );
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>