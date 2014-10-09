<?php
/* @var $this ConfigController */
/* @var $dataProvider CArrayDataProvider */

$this->breadcrumbs=array(
		'Config'=>array('index'),
		'Manage',
);

$this->menu=array(
		array('label'=>'Create entry', 'url'=>array('create')),
);
?>

<h1>Configuration </h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'config-grid',
		'dataProvider'=>$dataProvider,
		'columns'=>array(
			'id',
			'type',
			'key',
			'value',
			array(
				'class'=>'CButtonColumn',
				'template'=>'{update}{delete}',
				'deleteButtonUrl'=>function($data)
				{
					return  CHtml::normalizeUrl(array(
						'delete',
						'type'=>$data['type'],
						'key'=>$data['key'],
					));
				},
				'updateButtonUrl'=>function($data)
				{
					return  CHtml::normalizeUrl(array(
						'update',
						'type'=>$data['type'],
						'key'=>$data['key'],
					));
				}
			),
		),
)); ?>
