<ul>
	<?php
	/* @var $publication Publication */
	foreach($data->publications as $publication){
		?>
		<li class='certification'>
			<?=$publication->title?> - <?=$publication->year?> - <?=$publication->publisher?>
		</li>
	<?php } // endforeach?>
</ul>