<?php
/* @var $this RecommendationController */
/* @var $model Recommendation */

$this->breadcrumbs=array(
	'Recommendations'=>array('index'),
	$model->id=>array('update','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Recommendation', 'url'=>array('create')),
	array('label'=>'Manage Recommendation', 'url'=>array('index')),
);
?>

<h1>Update Recommendation <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>