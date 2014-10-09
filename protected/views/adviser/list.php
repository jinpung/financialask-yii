<?php

/* @var $this AdviserController */
/* @var $data Adviser */
/* @var $cs CClientScript */
//
$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;
//$cs->registerCssFile($baseUrl.'/style/css/default/adviserProfile.css');

if (count($advisers) > 0) {
    foreach ($advisers as $data) {
        $this->renderPartial('_view', array('data' => $data));
    }
    if (isset($reqParams) && count($advisers) == $reqParams['limit']) {
        echo '
            <div class="more-results">
                <div class="down-arrow"></div>
            </div>';
    }
}
?>
