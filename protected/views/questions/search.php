<h1>Questions Search</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$model->search(),
	'itemView'=>'_viewPreview',
)); ?>
