<?php
/* @var $this BookingController */
/* @var $model Booking */

$this->breadcrumbs=array(
	'Bookings'=>array('index'),
	$model->id=>array('update','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Booking', 'url'=>array('create')),
	array('label'=>'Manage Booking', 'url'=>array('index')),
);
?>

<h1>Update Booking <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>