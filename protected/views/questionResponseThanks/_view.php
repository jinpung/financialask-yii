<?php
/* @var $this QuestionResponseThanksController */
/* @var $data QuestionResponseThanks */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('questionId')); ?>:</b>
	<?php echo CHtml::encode($data->questionId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adviserId')); ?>:</b>
	<?php echo CHtml::encode($data->adviserId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('userId')); ?>:</b>
	<?php echo CHtml::encode($data->userId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datetime')); ?>:</b>
	<?php echo CHtml::encode($data->datetime); ?>
	<br />


</div>