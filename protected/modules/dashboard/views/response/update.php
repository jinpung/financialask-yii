<?php
/* @var $this ResponseController */
/* @var $model QuestionResponse */

$this->breadcrumbs=array(
	'Question Responses'=>array('index'),
	'Update',
);

$this->menu=array(
	array('label'=>'Create QuestionResponse', 'url'=>array('create')),
	array('label'=>'Manage QuestionResponse', 'url'=>array('index')),
);
?>

<h1>Update QuestionResponse <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>