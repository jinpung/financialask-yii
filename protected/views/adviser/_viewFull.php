<?php
/* @var $this AdviserController */
/* @var $data Adviser */
?>
<div class="adviserBlockFull">
	<img class="display img-circle avatar"/>

	<div class="name"><?= $data->user->displayname; ?></div>
	<div class="rating">
		<h2><i class="fa fa-star"></i> Rating</h2>
		<?php $this->widget('CStarRating', array(
			'name' => 'rate',
			'value'=>(int)$data->getRating(),
			'readOnly' => true,
		));
		?>
		<br clear="both">
		</div>
	<?php if($data->isOnline()){?>
	<div class="video-chat">
		<a class="btn " href = "<?=CHtml::normalizeUrl(array('chat/call','adviserId'=>$data->id))?>">
		<span style="font-size: 60px" class="glyphicon glyphicon-facetime-video"></span> <H2>Call Adviser </H2>
		</a>
	</div>
	<?php }else{?>

	<h3>Adviser is offline</h3>


	<?php }?>
	<div class="education">
		<h2><i class="fa fa-graduation-cap"></i> Education</h2>
		<hr>
		<ul>
			<?php
			/* @var $education Education */
			foreach ($data->educations as $education) {
				?>
				<li class='certification'>
					<?= $education->title ?> - <?= $education->year ?> - <?= $education->institution ?>
				</li>
			<?php } // endforeach?>
		</ul>
	</div>
	<div class="awards">
		<h2><i class="fa fa-trophy"></i> Awards</h2>
		<hr>
		<ul>
			<?php
			/* @var $award Award */
			foreach ($data->awards as $award) {
				?>
				<li class='award'>
					<?= $award->title ?> - <?= $award->institution ?>
				</li>
			<?php }// endforeach?>
		</ul>
	</div>
	<div class="bio">
		<h2><i class="fa fa-male"></i> Bio</h2>
		<hr>
		<?= $data->bio ?>
	</div>
	<div class="publications">
		<h2><i class="fa fa-book"></i> Publications</h2>
		<hr>
		<ul>
			<?php
			/* @var $publication Publication */
			foreach ($data->publications as $publication) {
				?>
				<li class='publication'><?= $publication->title ?></li>
			<?php }  //endforeach?>
		</ul>
	</div>
	<div class="specialties">
		<h2><i class="fa fa-suitcase"></i> Specialties</h2>
		<hr>
		<ul>
			<?php
			foreach ($data->specialties as $spec)
				echo CHtml::tag('li', array('class' => 'specialty'), $spec->getTitle());
			?>
		</ul>
	</div>
	<?php if (!Yii::app()->user->isGuest&&Yii::app()->user->userModel->isFollowing($data)): ?>
		<?= CHtml::link(CHtml::tag('i', array('class' => 'fa fa-rss-square'), ' Following'),'#',array('class' => 'btn btn-primary followBtn') )?>
	<?php else: ?>
		<?= CHtml::ajaxLink(
			CHtml::tag('i', array('class' => 'fa fa-rss-square'), ' Follow'),
			array('profile/follow', 'id' => $data->id),
			array(
				'beforeSend' => 'function(){
				$("#followBtm").html("<i class=\" fa fa-circle-o-notch fa-spin \"></i> Following");
			}',
				'success' => 'function(){
				$("#followBtm").html("<i class=\" fa fa-rss-square \"></i> Following");
			}'
			),
			array('class' => 'btn btn-primary followBtn', 'id' => 'followBtm')
		) ?>
	<?php endif ?>
</div>
