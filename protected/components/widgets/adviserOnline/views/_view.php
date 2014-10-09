<div class="adviser-online">
	<?php $this->widget('ext.yii-gravatar.YiiGravatar', array(
		'email'=>$model->user->email,
		'size'=>80,
		'defaultImage'=>'http://www.amsn-project.net/images/download-linux.png',
		'secure'=>false,
		'rating'=>'r',
		'emailHashed'=>false,
		'htmlOptions'=>array(
			'alt'=>$model->user->displayname,
			'title'=>$model->user->displayname,
		)
	)); ?>
	<div class="adviser-online-name">
		<?=CHtml::link($model->user->displayname,array('profile/view','id'=>$model->user->id)) ?>
	</div>
</div>