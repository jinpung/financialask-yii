<?php
/* @var $this QuestionFollowController */
/* @var $model QuestionFollow */

$this->breadcrumbs=array(
	'Question Follows'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List QuestionFollow', 'url'=>array('index')),
	array('label'=>'Manage QuestionFollow', 'url'=>array('admin')),
);
?>

<h1>Create QuestionFollow</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>