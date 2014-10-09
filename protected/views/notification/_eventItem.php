<?php
if ($event->typeId == NotificationEventType::QUESTION_RESPONSE):
    $row = CActiveRecord::model($event->type->modelClass)->with('user')->with('question')->findByPk($event->objectId);
    $link = "/questions/" . $row->question->id;
    ?>
    <div class="container-element">
        <div class="clearfix">
            <a class="avatar left" href="<?php echo Yii::app()->createUrl('/profile/' . $row->user->id); ?>" style="background-image: url(<?php echo Yii::app()->createUrl('/img/default-avatar.png'); ?>)"></a>        
            <img src="<?php echo Yii::app()->createUrl($row->user->avatarUrl); ?>" class="avatar-loader" style="display: none;">            
            <div class="notification-text left" itemprop="url">
                <a href="<?php echo $link; ?>" class="text-content">Your recent question has been answered by </a><a href="<?php echo Yii::app()->createUrl('/profile/' . $row->user->id); ?>"><?php echo $row->user->displayname; ?></a>
            </div>
        </div>
    </div>
    <?php
endif;
if ($event->typeId == NotificationEventType::QUESTION_NEW):
    $link = "/";
    $row = CActiveRecord::model($event->type->modelClass)->with('user')->findByPk($event->objectId);
endif;
?>
