<?php
/* @var $this RecommendationController */
/* @var $model Recommendation */

$this->breadcrumbs=array(
	'Recommendations'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Recommendation', 'url'=>array('index')),
	array('label'=>'Create Recommendation', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#recommendation-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Recommendations</h1>

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
	'id'=>'recommendation-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array(
			'name'=>'adviserId',
			'value'=>function($data)
			{
				return CHtml::link($data->adviser->user->displayname,array(
					'adviser/update',
					'id'=>$data->adviserId
				));
			},
			'type'=>'html'
		),
		array(
			'name'=>'authorId',
			'value'=>function($data)
			{
				return CHtml::link($data->author->user->displayname,array(
					'adviser/update',
					'id'=>$data->authorId
				));
			},
			'type'=>'html'
		),
		'content',
		'datetime',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
