<?php
/* @var $this PaymentController */
?>
	<script>
		$(document).ready(function () {
			$('#creditInput').on('keypress focusout', function (e) {
				var $this = $(this);
				if (e.type == 'keypress' && e.keyCode != 13)
					return e.default;
				var credit = parseFloat($this.val());
				if (isNaN(credit) || credit < 1) {
					$this.val(1)
				}
			});
			$('#paypal-button').on('click',function(){
				var amount = $('#creditInput').val();
				window.location.replace('/paypal/pay/amount/'+amount);
			});
		});
	</script>
	<h2>
		Your current credit amount - $<span
			id="creditAmount"><?= number_format(Yii::app()->user->userModel->credit, 2) ?></span>
	</h2>
	<div class="input-group">
		<span class="input-group-addon">$</span>
		<?= CHtml::textField('credit', 1, array(
			'class' => 'form-control',
			'placeholder' => 'Add Credit',
			'id' => 'creditInput'
		)) ?>
	</div>
<?php
$this->widget('ext.YiiStripe.widget.StripeWidget');
?>
<?php
echo CHtml::htmlButton(
	CHtml::image(
		'https://www.paypalobjects.com/en_US/i/btn/x-click-but6.gif',
		'Pay with PayPal',
		array('style'=>'height: 30px;')
	),
	array(
		'id'=>'paypal-button'
	)
);
?>