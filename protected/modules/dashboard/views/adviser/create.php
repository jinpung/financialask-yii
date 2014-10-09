<?php
/* @var $this AdviserController */
/* @var $model Adviser */

$this->breadcrumbs=array(
	'Advisers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Advisers', 'url'=>array('index')),
);
?>

<h1>Create Adviser</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>