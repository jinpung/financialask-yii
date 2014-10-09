<?php
/* @var $this ResponseController */
/* @var $model QuestionResponse */

$this->breadcrumbs=array(
	'Question Responses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List QuestionResponse', 'url'=>array('index')),
	array('label'=>'Create QuestionResponse', 'url'=>array('create')),
	array('label'=>'Update QuestionResponse', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete QuestionResponse', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage QuestionResponse', 'url'=>array('admin')),
);
?>

<h1>View QuestionResponse #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'questionID',
		'userId',
		'content',
		'datetime',
	),
)); ?>
