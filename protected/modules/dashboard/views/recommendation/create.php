<?php
/* @var $this RecommendationController */
/* @var $model Recommendation */

$this->breadcrumbs=array(
	'Recommendations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Recommendation', 'url'=>array('index')),
);
?>

<h1>Create Recommendation</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>