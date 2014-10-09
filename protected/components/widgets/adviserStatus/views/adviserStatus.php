<!-- Modal -->
<div class="modal fade" id="<?=$this->htmlOptions['id']?>" tabindex="-1" role="dialog" aria-labelledby="Incoming call" aria-hidden="true">
	<div class="modal-dialog" style="width: 250px">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Incoming call</h4>
			</div>
			<div class="modal-body">
				<div class="caller" style="margin-left: 60px;">
					<?php $this->widget('ext.yii-gravatar.YiiGravatar', array(
						'email'=>'markitanm@gmail.com',
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
					<div class="name">Darkwave MD</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Decline</button>
				<button type="button" class="btn btn-primary accept">Accept</button>
			</div>
		</div>
	</div>
</div>