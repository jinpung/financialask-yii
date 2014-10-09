<?php
/* @var $this ResponseController */
/* @var $model QuestionResponse */

$this->breadcrumbs=array(
	'Question Responses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List QuestionResponse', 'url'=>array('index')),
	array('label'=>'Manage QuestionResponse', 'url'=>array('admin')),
);
?>

<h1>Create QuestionResponse</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>