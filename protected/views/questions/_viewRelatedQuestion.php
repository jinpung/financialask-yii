<?php
/* @var $this QuestionController */
/* @var $data Question */
/* @var $this Controller */
/* @var $cs CClientScript */
$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;
$cs->registerCssFile($baseUrl . '/style/css/default/viewQuestion.css');
$cs->registerCssFile($baseUrl . '/css/questionResponse.css');
$loggedUserAsked = Yii::app()->user->id == $data->userId;
$text = $data->content;
?>
<li class="clearfix question-item-li">
    <a class="question" name="short-content" href="<?php echo Yii::app()->createUrl('/questions/view', array('id' => $data->id)); ?>">
        <?php echo substr($data->content, 0, 103);?>
    </a>
    <?php 
      if(strlen($data->content) >= 103){
          printf('<a class="more">more</a>');
          printf('<a class="question full-question" name="long-content" style="display: none;">%s</a>', $data->content);
      }
    ?>    
    <div class="answers">
        <div class="caduceus-icon"></div>
        <span class="num">
            <?php if($data->responsesCount>0){echo $data->responsesCount;} ?>
        </span>
        <span class="text">
            <?php
             if($data->responsesCount == 0){
                 echo 'not responded';
             }else if($data->responsesCount ==1){
                 echo 'advisor responded';
             }else if($data->responsesCount > 1){
                 echo 'advisors responded';
             }
            ?>            
        </span>
    </div>
</li>
