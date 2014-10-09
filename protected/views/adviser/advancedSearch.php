<?php
/* @var $cs CClientScript */
$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;
$cs->registerCssFile($baseUrl . '/style/css/default/viewAdvisers.css');
?>

<h1>Advanced Search</h1>
<?php $this->renderPartial('_advancedSearchForm',array('model'=>$model)) ?>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$model->advancedSearch(),
	'itemView'=>'_view',
)); ?>
