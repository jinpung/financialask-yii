<?php
/* @var $this CallController */
/* @var $model Call */

$this->breadcrumbs=array(
	'Call Log'=>array('index'),
	'Update',
);

$this->menu=array(
	array('label'=>'Call Log', 'url'=>array('index')),
	array('label'=>'Create Call', 'url'=>array('create')),
);
?>

<h1>Update Call <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>