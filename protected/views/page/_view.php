<?php
/* @var $data Page */
?>

<div class="pageBlock">
	<div class="title"><?=CHtml::link($data->title,array('view','id'=>$data->id))?></div>
	<div class="content"><?=$data->content?></div>
</div>