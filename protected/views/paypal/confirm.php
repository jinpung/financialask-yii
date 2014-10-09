<?php
/* @var $this PaypalController */
?>
<h1>Transaction result</h1>

<p>
	<?php if($result): ?>
	You successfully added $<?=$credit?>
	Your current credit - $<?=Yii::app()->user->userModel->credit?>
	<?php else: ?>
	There is error with processing your transaction.
	Please contact administrator.
	<?php endif;?>
</p>
