<?php
/* @var $this BookingController */
/* @var $model Booking */

$this->breadcrumbs=array(
	'Bookings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Booking', 'url'=>array('index')),
	array('label'=>'Manage Booking', 'url'=>array('admin')),
);
?>

<h1>Create Booking for <?=$model->adviser->user->displayname?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>