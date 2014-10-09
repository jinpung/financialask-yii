<?php
/* @var $this TipController */
/* @var $model Tip */

$this->breadcrumbs=array(
	'Tips'=>array('index'),
	$model->title=>array('update','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Manage Tip', 'url'=>array('index')),
	array('label'=>'Create Tip', 'url'=>array('create')),
);
?>

<h1>Update Tip <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>