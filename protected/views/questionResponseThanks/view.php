<?php
/* @var $this QuestionResponseThanksController */
/* @var $model QuestionResponseThanks */

$this->breadcrumbs=array(
	'Question Response Thanks'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List QuestionResponseThanks', 'url'=>array('index')),
	array('label'=>'Create QuestionResponseThanks', 'url'=>array('create')),
	array('label'=>'Update QuestionResponseThanks', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete QuestionResponseThanks', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage QuestionResponseThanks', 'url'=>array('admin')),
);
?>

<h1>View QuestionResponseThanks #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'questionId',
		'adviserId',
		'userId',
		'datetime',
	),
)); ?>
