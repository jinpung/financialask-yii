
<div class="caller" style="margin-left: 60px;">
	<?php $this->widget('ext.yii-gravatar.YiiGravatar', array(
		'email'=>$user->email,
		'size'=>80,
		'defaultImage'=>'http://www.amsn-project.net/images/download-linux.png',
		'secure'=>false,
		'rating'=>'r',
		'emailHashed'=>false,
		'htmlOptions'=>array(
			'alt'=>'Gravatar image',
			'title'=>'Gravatar image',
		)
	)); ?>
	<div class="name"><?=$user->displayname; ?></div>
</div>