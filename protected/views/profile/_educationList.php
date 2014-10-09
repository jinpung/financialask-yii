<ul>
	<?php
	/* @var $education Education */
	foreach($data->educations as $education){
		?>
		<li class='certification'>
			<?=$education->title?> - <?=$education->year?> - <?=$education->institution?>
		</li>
	<?php } // endforeach?>
</ul>