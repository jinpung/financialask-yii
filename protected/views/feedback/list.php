<?php
/* @var $this FeedbackController */
/* @var $dataProvider CActiveDataProvider */

?>

<h1>Feedback for <?=$adviser->user->displayname?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_listview',
)); ?>
