<?php
/* @var $this NewsletterController */
/* @var $model Newsletter */

$this->breadcrumbs=array(
	'Newsletters'=>array('index'),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Newsletter', 'url'=>array('create')),
	array('label'=>'Manage Newsletter', 'url'=>array('index')),
);
?>

<h1>Update Newsletter <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>