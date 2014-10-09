<?php
/* @var $this QuestionResponseThanksController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Question Response Thanks',
);

$this->menu=array(
	array('label'=>'Create QuestionResponseThanks', 'url'=>array('create')),
	array('label'=>'Manage QuestionResponseThanks', 'url'=>array('admin')),
);
?>

<h1>Question Response Thanks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
