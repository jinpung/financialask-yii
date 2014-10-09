<?php
/* @var $this FeedbackController */
/* @var $model Feedback */

?>
	<h1>Add Feedback for <?=$adviser->user->displayname?></h1>
	<?php $this->renderPartial('_form', array('model'=>$model)); ?>