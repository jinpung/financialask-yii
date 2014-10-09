<?php
/* @var $this ResponseController */
/* @var $model QuestionResponse */

$this->breadcrumbs=array(
	'Question Responses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List QuestionResponse', 'url'=>array('index')),
	array('label'=>'Create QuestionResponse', 'url'=>array('create')),
	array('label'=>'View QuestionResponse', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage QuestionResponse', 'url'=>array('admin')),
);
?>

<h1>Update QuestionResponse <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>