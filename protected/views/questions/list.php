<?php
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseUrl . '/style/css/default/sprites.css');
$cs->registerCssFile($baseUrl . '/style/css/default/questionList.css');
$cs->registerCssFile($baseUrl . '/style/css/default/search.css');
$cs->registerScriptFile($baseUrl . '/js/questionsList.js', CClientScript::POS_END);

Yii::app()->clientScript->registerScript('helpers', '
        getQuestionsUrl = ' . CJSON::encode(Yii::app()->createUrl('questions/answered')) . ';
');
?>

<div class="question-wraper" style="position: relative">
    <div class="sub-header">
        <div class="search-nav top-doctor-search">
            <div class="search-inner">
                <div class="input-wrap">
                    <input class="search-input" placeholder="Search answers advisers, or topic" value="<?php echo $search_str; ?>" search_url="<?php echo "/questions/{$action}" ?>">
                    <span class="search-x" style="display: none;"></span>
                    <div class="open-filter-btn">
                        <div class="filter-icon"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <div class="page_wrapper">
        <div class="span66 left left-panel">
            <div class="questions">
                <div class="sidepanel-list-title">
                    <div class="sidepanel-title-icon answer-icon"></div>
                    Questions
                    <span class="number total-count"><?php echo $totalCount; ?></span>
                </div>
<?php
                if (sizeof($data) > 0) {
                    foreach ($data as $question) {
                        $this->renderPartial('_viewPreview', array('data' => $question));
                    }
                    if ($totalCount > ($offset)) {
                        ?>
                        <div class="show-more answer-item" style="text-align: center; padding: 0 0 10px 0">
                            <a href="#" data-offset="<?php echo $offset; ?>">
                                <h4>View more questions</h4>
                            </a>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="container-element"> 
                        <?php
                        if (!$search_str) echo "You haven't asked any questions yet, please ask one!";
                        else echo "no matching data found";
                        ?>                        
                    </div>
                <?php } ?>
            </div>

        </div>
        <div class="span33 right right-panel">
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
    </div>
</div>

<?php
  //foreach($data as $question) $this->renderPartial('_viewPreview', array('data'=>$question))
?>
