<?php
/* @var $this Question_agreeController */
/* @var $model QuestionAgree */

$this->breadcrumbs=array(
	'Question Agrees'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List QuestionAgree', 'url'=>array('index')),
	array('label'=>'Create QuestionAgree', 'url'=>array('create')),
	array('label'=>'View QuestionAgree', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage QuestionAgree', 'url'=>array('admin')),
);
?>

<h1>Update QuestionAgree <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>