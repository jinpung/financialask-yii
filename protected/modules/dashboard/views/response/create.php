<?php
/* @var $this ResponseController */
/* @var $model QuestionResponse */

$this->breadcrumbs=array(
	'Question Responses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Question Responses', 'url'=>array('index')),
);
?>

<h1>Create Question Response</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>