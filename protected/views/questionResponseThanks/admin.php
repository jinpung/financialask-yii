<?php
/* @var $this QuestionResponseThanksController */
/* @var $model QuestionResponseThanks */

$this->breadcrumbs=array(
	'Question Response Thanks'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List QuestionResponseThanks', 'url'=>array('index')),
	array('label'=>'Create QuestionResponseThanks', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#question-response-thanks-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Question Response Thanks</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'question-response-thanks-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'questionId',
		'adviserId',
		'userId',
		'datetime',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
