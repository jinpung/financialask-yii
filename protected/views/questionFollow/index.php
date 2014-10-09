<?php
/* @var $this QuestionFollowController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Question Follows',
);

$this->menu=array(
	array('label'=>'Create QuestionFollow', 'url'=>array('create')),
	array('label'=>'Manage QuestionFollow', 'url'=>array('admin')),
);
?>

<h1>Question Follows</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
