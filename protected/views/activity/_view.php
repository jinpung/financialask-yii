<div class="questionBlock">
	<div class="author">
		<div class="name"><?=$data->user->displayname?> <?=$data->id?></div>
	</div>
	<hr>
	<div class="date"><?=date("m/d/Y", strtotime($data->datetime)); ?></div>
	<div class="content"><?=$data->content ?></div>
	<?php $this->widget('ext.loremPixelWidget.LoremPixelWidget', array('category'=>'business')) ?>
</div>
