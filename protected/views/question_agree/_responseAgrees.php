<?php
/* @var $this ResponseController */
/* @var $data QuestionResponse */

$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;

?>

<?php
  $agreementCount = count($response->agreements);
  if($agreementCount == 0) return;
?>
<div class="answer-agrees answer-list-el agrees-link">
  <div class="caduceus-icon"></div>
<?php
  for($i=0;$i<$agreementCount && $i<3;$i++){
    $oStr = "<span class='small-faces' style=\"background-image: url('".$response->agreements[$i]->adviser->user->avatarUrl."')\"></span>";
    echo CHtml::link($oStr, array('/profile/view', 'id' => $response->agreements[$i]->adviser->userId));
  }
?>
  <a class="agrees"><?= $agreementCount ?> adviser<?=$agreementCount>1?'s':''?></a> agree<?=$agreementCount==1?'s':''?>
</div>


