<?php 
  foreach($list as $event){

  if($event->typeId == NotificationEventType::QUESTION_RESPONSE)
    $link = "/questions/".$event->objectId;
  else $link = "/";
?>
<a href="<?= $link ?>" class="event" evID="<?= $event->id ?>">
  <?= CActiveRecord::model($event->type->modelClass)->findByPk($event->objectId)->prepareAnswer($event)?>
</a>
<?php
  }
?>
