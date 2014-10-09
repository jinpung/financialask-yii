<?php
/* @var $this FeedbackController */
/* @var $model Feedback */

$this->breadcrumbs=array(
	'Feedbacks'=>array('index'),
	$model->title=>array('update','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Manage Feedback', 'url'=>array('index')),
	array('label'=>'Create Feedback', 'url'=>array('create')),
);
?>

<h1>Update Feedback <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>