<?php
/* @var $this Question_agreeController */
/* @var $model QuestionAgree */

$this->breadcrumbs=array(
	'Question Agrees'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List QuestionAgree', 'url'=>array('index')),
	array('label'=>'Create QuestionAgree', 'url'=>array('create')),
	array('label'=>'Update QuestionAgree', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete QuestionAgree', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage QuestionAgree', 'url'=>array('admin')),
);
?>

<h1>View QuestionAgree #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'responseID',
		'adviserId',
		'datetime',
	),
)); ?>
