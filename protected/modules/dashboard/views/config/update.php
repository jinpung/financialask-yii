<?php
/** @var $model ConfigModel */
$this->breadcrumbs=array(
	'Config'=>array('index'),
	'Update',
);

$this->menu=array(
	array('label'=>'Manage configuration', 'url'=>array('index')),
	array('label'=>'Add new config entry', 'url'=>array('create')),
);
?>

	<h1>Update config entry</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>