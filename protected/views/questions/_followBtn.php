<?php 
/* @var $data User */
/* @var $question Question */

$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;

$loggedAdviser = !Yii::app()->user->isGuest && Yii::app()->user->userModel->userTypeID == User::TYPE_ADVISER;
$logged = !Yii::app()->user->isGuest;


if ($logged && !$loggedAdviser) {
  $followAttributes = array('userId' => Yii::app()->user->userModel->id, 'questionId' => $question->id);
  $currentFollowing = QuestionFollow::model()->findByAttributes($followAttributes);
  $FOLLOW_POS_TXT = "Follow <i class='follow-icon-dark'></i>";
  $FOLLOW_NEG_TXT = "Following <i class='follow-icon-dark'></i>";
  if ($currentFollowing) $btnText = $FOLLOW_NEG_TXT;
  else $btnText = $FOLLOW_POS_TXT;
  
  echo CHtml::ajaxLink(
    CHtml::tag('div', array(), $btnText),
    array('questions/follow', 'id' => $question->id),
    array('btnID' => 'js:$(this).attr("id")',
      'beforeSend' => 'function(){
  }', 
  'success' => 'function(ret){ 
        var btnVal = "' . $FOLLOW_NEG_TXT . '";
        if(ret.result == "deleted") btnVal = "' . $FOLLOW_POS_TXT . '";
        $("#"+this.btnID).html(btnVal);
        $("#"+this.btnID).css("display", "none");
        $("#"+this.btnID).fadeIn();
  }', 'dataType' => 'json'),
    array('class' => 'followBtn')
  );
}
?>
