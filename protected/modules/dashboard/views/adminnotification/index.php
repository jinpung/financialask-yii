<?php
/* @var $this AdminnotificationController */
/* @var $model AdminNotification */

$this->breadcrumbs=array(
	'Admin Notifications'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create Admin Notification', 'url'=>array('create')),
);
?>

<h1>Manage Admin Notifications</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'admin-notification-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		'content',
		'datetime',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{delete}{update}',
		),
	),
)); ?>
