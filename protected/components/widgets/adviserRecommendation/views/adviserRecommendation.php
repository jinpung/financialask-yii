<?php
/** @var $model Recommendation */
echo CHtml::openTag($this->tagName, $this->htmlOptions);
?>
	<div class="item-title "><?=$this->title?></div>
	<div class="item-content recommendationContent">
		<?php foreach($models as $model){ ?>
			<div class="item-list-el recommendationItem">
				<div class="voter clearfix">
					<div class="avatar")"></div>
          <div class="voter-name">A member
<?php
//          CHtml::link($model->author->user->displayname,array('profile/view','id'=>$model->adviserId))
?>
					</div>
				</div>
				<div class="testimonial-note">
					<?=$model->content?>
				</div>
			</div>

		<?php } ?>
<?php
if(!Yii::app()->user->isGuest && Yii::app()->user->userModel->userTypeID != User::TYPE_ADVISER && !$this->recExists){
		$this->render('_form',array(
			'model'=> new Recommendation(),
			'adviser'=>$adviser
    ));
}
		?>
	</div>

<?= CHtml::closeTag($this->tagName) ?>
