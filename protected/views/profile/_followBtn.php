<?php 
/* @var $data User */
/* @var $adviser Adviser */

$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;

$loggedAdviser = !Yii::app()->user->isGuest && Yii::app()->user->userModel->userTypeID == User::TYPE_ADVISER;
$logged = !Yii::app()->user->isGuest;


if ($logged && !$loggedAdviser) {
  $followAttributes = array('userID' => Yii::app()->user->userModel->id, 'adviserID' => $adviser->id);
  $currentFollowing = AdviceRelation::model()->findByAttributes($followAttributes);
  $FOLLOW_POS_TXT = "Follow <i class='follow-icon-dark'></i>";
  $FOLLOW_NEG_TXT = "Following <i class='follow-icon-dark'></i>";
  if ($currentFollowing) $btnText = $FOLLOW_NEG_TXT;
  else $btnText = $FOLLOW_POS_TXT;
  
  echo CHtml::ajaxLink(
    CHtml::tag('span', array(), $btnText),
    array('profile/follow', 'id' => $data->id),
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
