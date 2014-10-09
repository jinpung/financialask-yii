<?php
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseUrl . '/style/css/default/sprites.css');
$cs->registerCssFile($baseUrl . '/style/css/default/eventList.css');
$cs->registerScriptFile($baseUrl . '/js/eventList.js', CClientScript::POS_END);
?>
<div class="page-wraper">
    <div class="span50 left left-panel">
        <div class="eventlist">
            <div class="title center">
                Notifications
                <span class="number"><?php if (sizeof($data) > 0) echo sizeof($data); ?></span>
            </div>
            <?php
            if (sizeof($data) > 0) {
               foreach ($data as $item) {
                    $this->renderPartial('_eventItem', array('event' => $item));
               }
            } else {
                ?>
                <div class="container-element"> 
                    You haven't received any notification.
                </div>
            <?php } ?>
        </div>

    </div>
    <div class="span50 right right-panel">
        <div class="follow contatiner">
            <div class="title">Follow up</div>
            <div class="follow-body">
                Follow up on your question and talk with an adviser now.                
                <input class="btn" type="button" id="talkwithadviser" value="Video chat with an Adviser"/>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>