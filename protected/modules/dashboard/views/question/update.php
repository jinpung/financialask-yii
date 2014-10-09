<?php
/* @var $this QuestionController */
/* @var $model Question */

$this->breadcrumbs=array(
	'Questions'=>array('index'),
	'Update',
);

$this->menu=array(
	array('label'=>'Manage Questions', 'url'=>array('index')),
	array('label'=>'Create Question', 'url'=>array('create')),
);
?>

<h1>Update Question <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>