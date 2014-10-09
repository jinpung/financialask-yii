<?php
/* @var $this Question_agreeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Question Agrees',
);

$this->menu=array(
	array('label'=>'Create QuestionAgree', 'url'=>array('create')),
	array('label'=>'Manage QuestionAgree', 'url'=>array('admin')),
);
?>

<h1>Question Agrees</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
