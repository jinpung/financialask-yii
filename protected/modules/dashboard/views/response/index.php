<?php
/* @var $this ResponseController */
/* @var $model QuestionResponse */

$this->breadcrumbs=array(
	'Question Responses'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Question Responses', 'url'=>array('index')),
	array('label'=>'Create Question Response', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#question-response-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Question Responses</h1>

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
	'id'=>'question-response-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'questionID',
		[
			'name'=>'questionID',
			'value'=>function($data){
				return CHtml::link( $data->question->content,array('question/update','id'=>$data->question->id));
			},
			'type'=>'html'
		],
		[
			'name'=>'userId',
			'value'=>function($data){ return $data->user->displayname; }
		],
		'brief',
		'datetime',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{delete}{update}',
		),
	),
)); ?>
