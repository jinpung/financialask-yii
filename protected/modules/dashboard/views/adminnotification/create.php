<?php
/* @var $this AdminnotificationController */
/* @var $model AdminNotification */

$this->breadcrumbs=array(
	'Admin Notifications'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Admin Notifications', 'url'=>array('index')),
);
?>

<h1>Create Admin Notification</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>