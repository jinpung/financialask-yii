<?php
foreach ($list as $event) {

    if ($event->typeId == NotificationEventType::QUESTION_RESPONSE)
        $link = "/questions/" . $event->objectId;
    else
        $link = "/";
    ?>
    <ul class="list-item">
        <a href="<?= $link ?>" class="event" evID="<?= $event->id ?>">
            <?php echo CActiveRecord::model($event->type->modelClass)->findByPk($event->objectId)->prepareAnswer($event) ?>
        </a>
    </ul>
    <?php
}
?>
<ul class="last-item">
    <a href="<?php  echo Yii::app()->createUrl("/notification/index")?>">see all notifications</a>
</ul>
