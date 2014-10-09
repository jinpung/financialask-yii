<?php
/* @var $this QuestionResponseThanksController */
/* @var $model QuestionResponseThanks */

$this->breadcrumbs=array(
	'Question Response Thanks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List QuestionResponseThanks', 'url'=>array('index')),
	array('label'=>'Manage QuestionResponseThanks', 'url'=>array('admin')),
);
?>

<h1>Create QuestionResponseThanks</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>