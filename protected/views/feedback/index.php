<?php
/* @var $this FeedbackController */
/* @var $dataProvider CActiveDataProvider */

?>

<h1>My Feedback</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
