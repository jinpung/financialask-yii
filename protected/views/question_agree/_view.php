<?php
/* @var $this Question_agreeController */
/* @var $data QuestionAgree */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('responseID')); ?>:</b>
	<?php echo CHtml::encode($data->responseID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adviserId')); ?>:</b>
	<?php echo CHtml::encode($data->adviserId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datetime')); ?>:</b>
	<?php echo CHtml::encode($data->datetime); ?>
	<br />


</div>