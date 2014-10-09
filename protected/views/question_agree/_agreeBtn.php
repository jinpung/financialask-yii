<?php
/*     @var $response QuestionResponse */

$loggedAdviser = Adviser::model()->findByAttributes(array('userId' => Yii::app()->user->id));
if (Yii::app()->user->id != $response->userId) { 
    $agreeAttributes = array('responseID' => $response->id, 'adviserId' => $loggedAdviser->id);
    $currentAgreement = QuestionAgree::model()->findByAttributes($agreeAttributes);
    $AGREE_POS_TXT = 'Agree';
    $AGREE_NEG_TXT = 'Agreed!';
    $agreeBtnText = ($currentAgreement ? $AGREE_NEG_TXT : $AGREE_POS_TXT);
    
    echo CHtml::ajaxLink(
      CHtml::tag('div', array(), $agreeBtnText), array('question_agree/agree', 'id' => $response->id), array('btnID' => 'js:$(this).attr("id")',      
      'beforeSend' => 'function(){
          $("#"+this.btnID).html("<img src=\'/img/ajax-loader.gif\'></img>");
      }',
      'success' => 'function(ret){
          var btnVal = "' . $AGREE_NEG_TXT . '";
          if(ret.result == "deleted") btnVal = "' . $AGREE_POS_TXT . '";
          successAgree(ret, $("#"+this.btnID).parent().parent().find(".agreeBlock"));
          $("#"+this.btnID).html(btnVal);
      }', 'dataType' => 'json'), array('class' => 'thank-btn btn')
    );
}


?>
