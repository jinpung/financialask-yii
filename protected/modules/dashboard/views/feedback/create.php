<?php
/* @var $this FeedbackController */
/* @var $model Feedback */

$this->breadcrumbs=array(
	'Feedbacks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Feedback', 'url'=>array('index')),
);
?>

<h1>Create Feedback</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>