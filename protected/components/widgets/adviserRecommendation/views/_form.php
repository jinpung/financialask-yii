<!-- Button trigger modal -->
<button class="btn btn-primary btn-lg recommend-btn" data-toggle="modal" data-target="#<?= $this->getId() ?>">
  <div class="recommend-btn-icon"></div>
	Recommend me
</button>

<!-- Modal -->
<div class="modal fade" id="<?= $this->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="adviserRecommendation"
     aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<?php ?>
			<div class="modal-header">
				<?php $form = $this->beginWidget('CActiveForm', array(
					'id' => 'recommendation-form',
					// Please note: When you enable ajax validation, make sure the corresponding
					// controller action is handling ajax validation correctly.
					// There is a call to performAjaxValidation() commented in generated controller code.
					// See class documentation of CActiveForm for details on this.
					'enableAjaxValidation' => true,
					'clientOptions' => array(
						'validateOnSubmit' => true,
						'afterValidate'=>'js:function(form,data,hasError)
            {
                if(!hasError)
                {
                    $.ajax
                    ({
                            "type":"POST",
                            "url":"'.CHtml::normalizeUrl($this->formAction).'",
                            "data":form.serialize(),
                            "success":function(data){
                             location.reload();
                            //$("#'.$this->getId().'").modal("hide")
                            },
                     });
                 }
              }'
					),
					'action' => CHtml::normalizeUrl($this->formAction)
				)); ?>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
						class="sr-only">Close</span></button>
				<h4 class="modal-title" id="adviserRecommendation">
					Recommend <?= $adviser->user->displayname ?>'s expertise
				</h4>
			</div>
			<div class="modal-body">
				<?php echo $form->errorSummary($model); ?>
				<?php echo $form->hiddenField($model, 'adviserId', array('value' => $adviser->id)) ?>
				<?php echo $form->errorSummary($model); ?>
				<?php echo $form->textArea($model, 'content', array('class' => 'form-control', 'rows' => 4)); ?>
				<?php echo $form->error($model, 'content'); ?>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<?= CHtml::submitButton('Recommend', array('class' => 'btn btn-primary')) ?>
			</div>
			<?php $this->endWidget(); ?>
		</div>
	</div>
</div>
