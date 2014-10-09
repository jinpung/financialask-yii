<ul>
	<?php
	/* @var $award Award */
	foreach($data->awards as $award){
		?>
		<li class='award'>
			<?=$award->title?> - <?=$award->institution?>
		</li>
	<?php } // endforeach?>
</ul>