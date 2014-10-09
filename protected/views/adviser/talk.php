<?php
/* @var $cs CClientScript */
$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;
$cs->registerCssFile($baseUrl . '/style/css/default/viewAdvisers.css');
$cs->registerCssFile($baseUrl . '/style/css/default/videoChat.css');
?>

<div class="adviser-head clearfix">
        <div class="left">
            Talk to adviser
        </div>
    </div>
	<div class="page_wrapper">
        
        <div class="span50 left left-panel">
        	<div class="adviser-element padding20 margintop10">
	            <?php $this->widget('zii.widgets.CListView', array(
					'dataProvider' => $model->advancedSearch(),
					'itemView' => '_viewtalk',
					'template' => '{items}',
				)); ?>
			</div>
        </div>
        <div class="span50 right right-panel">
	        <div class="adviser-element padding20 margintop10">
	            <?php $this->renderPartial('_talkform', array('model' => $model)) ?>
	        </div>
        </div>
    </div>
    <div class="clearfix"></div>