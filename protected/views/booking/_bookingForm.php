<?php
/** @var $adviser Adviser */
/** @var $bookingForm Booking */
?>
<div class="modal fade" id="modalBookingForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'booking-form',
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// There is a call to performAjaxValidation() commented in generated controller code.
				// See class documentation of CActiveForm for details on this.
				'action'=>array('booking/create')
			)); ?>
			<?php echo $form->hiddenField($bookingForm,'adviserId'); ?>
			<?php echo $form->hiddenField($bookingForm,'start'); ?>
			<?php echo $form->hiddenField($bookingForm,'end'); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Book a call with <?=$bookingForm->adviser->user->name?></h4>
			</div>
			<div class="modal-body">
				<div class="alert"></div>
				<div class="form-group">
					<dl class="dl-horizontal">
						<dt>Start time</dt>
						<dd id="startTime">...</dd>
						<dt>End time</dt>
						<dd id="endTime">...</dd>
					</dl>
				</div>
				<div class="form-group">
					<?php echo $form->textArea($bookingForm,'reason',array(
						'class'=>'form-control',
						'placeholder'=>'Reason for booking',
					)); ?>
				</div>
			</div>
			<div class="modal-footer">
				<?=CHtml::button('Close',array(
					'class'=>'btn btn-default',
					'data-dismiss'=>'modal'
				))?>
				<?= CHtml::ajaxSubmitButton('Make booking',array('booking/create'),
					array(
						'dataType'=>'json',
						'data'=>new CJavaScriptExpression("$('#booking-form').serialize()"),
						'success'=> new CJavaScriptExpression("function(data)
							{
								$('#modalBookingForm').find('.alert')
								.addClass(data.status ? 'alert-success' : 'alert-danger')
								.html(data.message);
								if(data.status){
									setTimeout($('#modalBookingForm').modal('hide'),50000);
									$('#modalBookingForm').find('form')[0].reset();
									$('#bookingCalendar').fullCalendar( 'refetchEvents');
								}
							}
						")
					),
					array(
						'class'=>'btn btn-primary'
					))?>

			</div>
			<?php $this->endWidget(); ?>
		</div>
	</div>
</div>
