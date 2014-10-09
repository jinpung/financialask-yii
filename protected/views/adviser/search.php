<?php
/* @var $cs CClientScript */
$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;
$cs->registerCssFile($baseUrl . '/style/css/default/viewAdvisers.css');
?>

<h1>Advisers Search</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$model->simpleSearch(),
	'itemView'=>'_view',
)); ?>
