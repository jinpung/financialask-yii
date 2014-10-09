<?php
/* @var $this BookingController */
/* @var $model Booking */

$this->breadcrumbs=array(
	'Bookings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Booking', 'url'=>array('index')),
);
?>

<h1>Create Booking</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>