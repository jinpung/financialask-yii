<?php
/* @var $this Question_agreeController */
/* @var $model QuestionAgree */

$this->breadcrumbs=array(
	'Question Agrees'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List QuestionAgree', 'url'=>array('index')),
	array('label'=>'Manage QuestionAgree', 'url'=>array('admin')),
);
?>

<h1>Create QuestionAgree</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>