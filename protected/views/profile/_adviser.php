<?php /* @var $model User */
$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;
$cs->registerCssFile($baseUrl . '/style/css/default/registerAdviser.css');

?>
<script>
	$(document).ready(function () {
		var hideText = "<i class='fa fa-minus'></i> Hide";
		var addText = "<i class='fa fa-plus'></i> Add";
		$(".addBtn").click(
			function (e) {
				e.preventDefault();
				$(this).parent().find('.dynamicInput').toggle();
				if ($(this).find('i').hasClass('fa-plus')) {
					$(this).html(hideText);
				} else {
					$(this).html(addText);
				}

			}
		)
	});

</script>
<div class="form-group">
	<?php echo $form->labelEx($adviser, 'address'); ?>
	<?php echo $form->textField($adviser, 'address', array('size' => 60, 'maxlength' => 1024, 'class' => 'form-control')); ?>
	<?php echo $form->error($adviser, 'address'); ?>
</div>

<div class="form-group">
	<?php echo $form->labelEx($adviser, 'suburb'); ?>
	<?php echo $form->textField($adviser, 'suburb', array('size' => 60, 'maxlength' => 200, 'class' => 'form-control')); ?>
	<?php echo $form->error($adviser, 'suburb'); ?>
</div>

<div class="form-group">
	<?php echo $form->labelEx($adviser, 'postcode'); ?>
	<?php echo $form->textField($adviser, 'postcode', array('size' => 10, 'maxlength' => 10, 'class' => 'form-control')); ?>
	<?php echo $form->error($adviser, 'postcode'); ?>
</div>
<span class="topic help-block">About you</span>
<br/>
<div class="form-group">
	<?php echo $form->labelEx($adviser, 'specialtiesList', array('class' => 'control-label')); ?>
	<div class="checkbox-seg">
		<?php foreach (Specialties::getList() as $value => $title): ?>
			<?php
			$isChecked = in_array($value,$adviser->specialtiesIdx) ? array('checked'=>'checked') : array();
			?>
			<div class="form-group">
				<?php echo $form->checkBox($adviser, 'specialtiesList[]', array_merge(array('value' => $value),$isChecked)) ?>
				<?php echo $title; ?>
			</div>
		<?php endforeach; ?>
	</div>
	<?php echo $form->error($adviser, 'specialtiesList'); ?>
</div>
<div class="form-group">
	<?php echo $form->labelEx($adviser, 'bio'); ?>
	<?php echo $form->textArea($adviser, 'bio', array('size' => 60, 'maxlength' => 10000, 'class' => 'form-control')); ?>
	<?php echo $form->error($adviser, 'bio'); ?>
</div>

<div class="form-group dynamicAddField" id="qualificationBlock">
	<label class="control-label" for="educationField"><i class="fa fa-graduation-cap"></i> Education</label>
	<?= CHtml::link(
		'<i class="fa fa-plus"></i> Add',
		'#',
		array(
			'class' => 'btn btn-primary addBtn',
			'id' => 'addQualificationBtn',
		)
	) ?>

	<hr>
	<div class="allEducation">
		<div id="educationList">
			<?php
				$this->renderPartial('_educationList', array('data'=>$adviser))
			?>
		</div>
		<div class="dynamicInput">
			<?php echo $form->labelEx($education, 'title', array('class' => 'control-label')); ?>
			<?php echo $form->textField($education, 'title', array('size' => 10, 'class' => 'form-control')); ?>
			<?php echo $form->error($education, 'title'); ?>
			<?php echo $form->labelEx($education, 'year', array('class' => 'control-label')); ?>
			<?php echo $form->textField($education, 'year', array('size' => 10, 'maxlength' => 4, 'class' => 'form-control')); ?>
			<?php echo $form->error($education, 'year'); ?>
			<?php echo $form->labelEx($education, 'institution', array('class' => 'control-label')); ?>
			<?php echo $form->textField($education, 'institution', array('size' => 10, 'class' => 'form-control')); ?>
			<?php echo $form->error($education, 'institution'); ?>

			<?= CHtml::ajaxLink(
				'<i class="fa fa-plus"></i> Submit Qualifcation',
				array('profile/education'),
				array(
					'type' => 'POST',
					'data' => new CJavaScriptExpression('
						$(this).parent().find("input").serialize()
					'),
					'success'=> new CJavaScriptExpression('
						function(data) {
							$("#educationList").html(data);
							$("div#qualificationBlock").find("input").val("")
						}
					')
				),
				array('class' => 'btn btn-primary submitDynBtn')
			)
			?>
			<hr>
		</div>
	</div>
</div>
<div class="form-group dynamicAddField" id="awardsBlock">
	<label class="control-label" for="awardsField"><i class="fa fa-trophy"></i> Awards</label>
	<?= CHtml::link(
		'<i class="fa fa-plus"></i> Add',
		'#',
		array(
			'class' => 'btn btn-primary addBtn',
			'id' => 'addAwardBtn',
		)
	) ?>
	<hr>
	<div id="allAwards">
		<?php
		$this->renderPartial('_awardList', array('data' => $adviser))
		?>
	</div>
	<div class="dynamicInput">
		<?php echo $form->labelEx($award, 'title', array('class' => 'control-label')); ?>
		<?php echo $form->textField($award, 'title', array('size' => 10, 'class' => 'form-control')); ?>
		<?php echo $form->error($award, 'title'); ?>
		<?php echo $form->labelEx($award, 'institution', array('class' => 'control-label')); ?>
		<?php echo $form->textField($award, 'institution', array('size' => 10, 'class' => 'form-control')); ?>
		<?php echo $form->error($award, 'institution'); ?>
		<?= CHtml::ajaxLink(
			'<i class="fa fa-plus"></i> Submit Award',
			array('profile/award'),
			array(
				'type' => 'POST',
				'data' => new CJavaScriptExpression('
						$(this).parent().find("input").serialize()
					'),
				'success'=> new CJavaScriptExpression('
						function(data) {
							$("#allAwards").html(data);
							$("div#awardsBlock").find("input").val("")
						}
					')
			),
			array('class' => 'btn btn-primary submitDynBtn')
		)
		?>
		<hr>
	</div>
</div>
<div class="form-group dynamicAddField" id="publicationBlock">
	<label class="control-label" for="publicationsField"><i class="fa fa-book"></i> Publications</label>
	<?= CHtml::link(
		'<i class="fa fa-plus"></i> Add',
		'#',
		array(
			'class' => 'btn btn-primary addBtn',
			'id' => 'addPublicationBtn',
		)
	) ?>
	<div id="allPublications">
		<?php
		$this->renderPartial('_publicationList', array('data' => $adviser))
		?>
	</div>
	<div class="dynamicInput">
		<?php echo $form->labelEx($publication, 'title', array('class' => 'control-label')); ?>
		<?php echo $form->textField($publication, 'title', array('size' => 10, 'class' => 'form-control')); ?>
		<?php echo $form->error($publication, 'title'); ?>
		<?php echo $form->labelEx($publication, 'year', array('class' => 'control-label')); ?>
		<?php echo $form->textField($publication, 'year', array('size' => 10, 'maxlength' => 4, 'class' => 'form-control')); ?>
		<?php echo $form->error($publication, 'year'); ?>
		<?php echo $form->labelEx($publication, 'publisher', array('class' => 'control-label')); ?>
		<?php echo $form->textField($publication, 'publisher', array('size' => 10, 'class' => 'form-control')); ?>
		<?php echo $form->error($publication, 'publisher'); ?>
		<?= CHtml::ajaxLink(
			'<i class="fa fa-plus"></i> Submit Publication',
			array('profile/publication'),
			array(
				'type' => 'POST',
				'data' => new CJavaScriptExpression('
						$(this).parent().find("input").serialize()
					'),
				'success'=> new CJavaScriptExpression('
						function(data) {
							$("#allPublications").html(data);
							$("div#publicationBlock").find("input").val("")
						}
					')
			),
			array('class' => 'btn btn-primary submitDynBtn')
		)
		?>
	</div>
	<hr>
</div>
