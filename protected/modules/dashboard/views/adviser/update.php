<?php
/* @var $this AdviserController */
/* @var $model Adviser */

$this->breadcrumbs=array(
	'Advisers'=>array('index'),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Adviser', 'url'=>array('create')),
	array('label'=>'Manage Adviser', 'url'=>array('index')),
);
?>

<h1>Update Adviser <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>