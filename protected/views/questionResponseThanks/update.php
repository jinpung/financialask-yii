<?php
/* @var $this QuestionResponseThanksController */
/* @var $model QuestionResponseThanks */

$this->breadcrumbs=array(
	'Question Response Thanks'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List QuestionResponseThanks', 'url'=>array('index')),
	array('label'=>'Create QuestionResponseThanks', 'url'=>array('create')),
	array('label'=>'View QuestionResponseThanks', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage QuestionResponseThanks', 'url'=>array('admin')),
);
?>

<h1>Update QuestionResponseThanks <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>