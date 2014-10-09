<?php
/* @var $this AdviserController */
/* @var $dataProvider CActiveDataProvider */
/* @var $cs CClientScript */
$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;
?>

<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/style/css/default/sprites.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/style/css/default/viewAdvisers.css" />


<div class="advisers-wrapper">
    <div class="default-doc-list">
        <div class="doctor-results search-results" style="display: none;"></div>
        <div class="doctor-results suggest-doctors">
            <div class="result-title">Your Advisers</div>
            <?php $this->renderPartial('list', array('advisers'=>$advisers)); ?>
        </div>
    </div>
</div>
