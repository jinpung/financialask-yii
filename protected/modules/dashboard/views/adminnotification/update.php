<?php
/* @var $this AdminnotificationController */
/* @var $model AdminNotification */

$this->breadcrumbs=array(
	'Admin Notifications'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Admin Notification', 'url'=>array('create')),
	array('label'=>'Manage Admin Notification', 'url'=>array('index')),
);
?>

<h1>Update Admin Notification #<?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>