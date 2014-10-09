<?php
/* @var $this QuestionFollowController */
/* @var $model QuestionFollow */

$this->breadcrumbs=array(
	'Question Follows'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List QuestionFollow', 'url'=>array('index')),
	array('label'=>'Create QuestionFollow', 'url'=>array('create')),
	array('label'=>'Update QuestionFollow', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete QuestionFollow', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage QuestionFollow', 'url'=>array('admin')),
);
?>

<h1>View QuestionFollow #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'userId',
		'questionId',
		'datetime',
	),
)); ?>
