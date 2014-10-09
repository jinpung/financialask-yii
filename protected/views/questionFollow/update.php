<?php
/* @var $this QuestionFollowController */
/* @var $model QuestionFollow */

$this->breadcrumbs=array(
	'Question Follows'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List QuestionFollow', 'url'=>array('index')),
	array('label'=>'Create QuestionFollow', 'url'=>array('create')),
	array('label'=>'View QuestionFollow', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage QuestionFollow', 'url'=>array('admin')),
);
?>

<h1>Update QuestionFollow <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>