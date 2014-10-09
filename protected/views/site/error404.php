<?php
$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;
$cs->registerCssFile($baseUrl.'/style/css/default/error404.css');
$cs->registerCssFile($baseUrl.'/css/questionResponse.css');
?>

<div class="error404 " style="position: relative;">
    <div class="innerText">
        <h1 id="header"> Woops! </h1>
        <p id="content">Unfortunately the page your were looking for wasn't found!</p>
        <div class="redirect">
            <?= CHtml::link(
                'Return to the main page',
                array(
                    'activity/index'
                ),
                array(
                    'id'=>'link'
                )
            );
            ?>
        </div>
    </div>
</div>