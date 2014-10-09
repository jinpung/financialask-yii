<?php
/* @var $this TipController */
/* @var $model Tip */

$this->breadcrumbs=array(
	'Tips'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Tip', 'url'=>array('index')),
	array('label'=>'Manage Tip', 'url'=>array('admin')),
);
?>

<h1>Create Tip</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>