<?php
/** @var $model ConfigModel */
$this->breadcrumbs=array(
		'Config'=>array('index'),
		'Create',
);

$this->menu=array(
		array('label'=>'Manage configuration', 'url'=>array('index')),
);
?>

	<h1>Add new config entry</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>