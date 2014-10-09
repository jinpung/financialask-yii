<h1>Booking #<?=$model->id?></h1>
<div class="description">
	<h3>Advisor</h3>
	<?=$model->adviser->user->displayname?>
	<h3>User</h3>
	<?=$model->user->displayname?>
	<h3>Call time</h3>
	<?=$model->calltime?>
	<h3>Reason</h3>
	<?=$model->reason?>
	<h3>Status</h3>
	<?=$model->statusList[$model->status]?>
	<br clear="both">
	<?php if(Yii::app()->user->userModel->userTypeID== User::TYPE_ADVISER){
		if($model->status == Booking::STATUS_CREATED){
			echo CHtml::link(
				'Accept',
				array('booking/status','id'=>$model->id,'status'=>Booking::STATUS_ACCEPTED),
				array('class'=>'btn btn-success')
			);
			echo CHtml::link(
				'Decline',
				array('booking/status','id'=>$model->id,'status'=>Booking::STATUS_DECLINED),
				array('class'=>'btn btn-danger')
			);
		}

	} else {
		if(in_array($model->status,array(Booking::STATUS_CREATED,Booking::STATUS_ACCEPTED)))
		echo CHtml::link(
			'Cancel Booking',
			array('booking/status','id'=>$model->id,'status'=>Booking::STATUS_CANCELED),
			array('class'=>'btn btn-danger')
		);
	} ?>
</div>