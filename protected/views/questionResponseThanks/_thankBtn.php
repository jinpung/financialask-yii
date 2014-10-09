<?php
/*  vars
    $response   QuestionResponse*/

if(!Yii::app()->user->isGuest){
  $thankAtts = array('responseId' => $response->id, 
              'userId' => Yii::app()->user->userModel->id);
  $currentThank = QuestionResponseThank::model()->findByAttributes($thankAtts);
}else $currentThank = false;
$THANK_POS_TXT = 'Thank';
$THANK_NEG_TXT = 'Thanked!';
$thankBtnText = ($currentThank ? $THANK_NEG_TXT : $THANK_POS_TXT);

$thankBtnHTMLops = array('class' => 'thank-btn btn');
if($currentThank) $thankBtnHTMLops = array_merge($thankBtnHTMLops, array('disabled'=>'disabled'));

echo CHtml::ajaxLink(
  CHtml::tag('div', array(), $thankBtnText), array('/questionResponseThanks/thank', 'id' => $response->id), array('btnID' => 'js:$(this).attr("id")',
  'beforeSend' => 'function(){
      $("#"+this.btnID).html("<img src=\'/img/ajax-loader.gif\'></img>");
  }',
  'success' => 'function(ret){
      var btnVal = "' . $THANK_NEG_TXT . '";
      if(ret.result == "deleted") btnVal = "' . $THANK_POS_TXT . '";
      $("#"+this.btnID).html(btnVal);
      $("#"+this.btnID).attr("disabled", "disabled");
  }', 'dataType' => 'json'), $thankBtnHTMLops
);

?>
