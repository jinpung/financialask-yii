<?php
/* @var $this BookingController */
/* @var $model Booking */

$this->breadcrumbs=array(
	'Bookings'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Manage Booking', 'url'=>array('index')),
	array('label'=>'Create Booking', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#booking-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Bookings</h1>

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
	'id'=>'booking-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array(
			'name'=>'userId',
			'value'=>function($data)
			{
				return CHtml::link($data->user->displayname,array('user/update','id'=>$data->userId));
			},
			'type'=>'html'
		),
		array(
			'name'=>'adviserId',
			'value'=>function($data)
			{
				return CHtml::link($data->adviser->user->displayname,array('adviser/update','id'=>$data->adviserId));
			},
			'type'=>'html'
		),
		array(
			'name'=>'callId',
			'value'=>function($data)
			{
				return $data->getCallStatus();
			},
			'type'=>'html'
		),
		'reason',
		'start',
		'end',
		array(
			'name'=>'status',
			'value'=>function($data)
			{
				return $data->statusList[$data->status];
			}
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}{delete}'
		),
	),
)); ?>
