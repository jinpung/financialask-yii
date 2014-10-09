<?php
/* @var $model AdviserSearchForm */
/* @var $form CActiveForm */
$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;
$cs->registerCssFile($baseUrl . '/style/css/default/registerAdviser.css');
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableClientValidation'=>false,
)); ?>
<div class="form-group">
	<?php echo $form->labelEx($model, 'displayname'); ?>
	<?php echo $form->textField($model, 'displayname', array('size' => 60, 'maxlength' => 1024, 'class' => 'form-control')); ?>
	<?php echo $form->error($model, 'displayname'); ?>
</div>
	<div class="form-group">
		<?php echo $form->labelEx($model, 'online'); ?>
		<?php echo $form->checkBox($model, 'online'); ?>
		<?php echo $form->error($model, 'online'); ?>
	</div>
	<div class="form-group">
	<?php echo $form->labelEx($model, 'address'); ?>
	<?php echo $form->textField($model, 'address', array('size' => 60, 'maxlength' => 1024, 'class' => 'form-control')); ?>
	<?php echo $form->error($model, 'address'); ?>
</div>

<div class="form-group">
	<?php echo $form->labelEx($model, 'suburb'); ?>
	<?php echo $form->textField($model, 'suburb', array('size' => 60, 'maxlength' => 200, 'class' => 'form-control')); ?>
	<?php echo $form->error($model, 'suburb'); ?>
</div>

<div class="form-group">
	<?php echo $form->labelEx($model, 'postcode'); ?>
	<?php echo $form->textField($model, 'postcode', array('size' => 10, 'maxlength' => 10, 'class' => 'form-control')); ?>
	<?php echo $form->error($model, 'postcode'); ?>
</div>
<span class="topic help-block">About Adviser</span>
<br/>
<div class="form-group">
	<?php echo $form->labelEx($model, 'specialtiesList', array('class' => 'control-label')); ?>
	<div class="checkbox-seg">
		<?php foreach (Specialties::getList() as $value => $title): ?>
			<?php
			$isChecked = (is_array($model->specialtiesList) && in_array($value,$model->specialtiesList)) ? array('checked'=>'checked') : array();
			?>
			<div class="form-group">
				<?php echo $form->checkBox($model, 'specialtiesList[]', array_merge(array('value' => $value),$isChecked)) ?>
				<?php echo $title; ?>
			</div>
		<?php endforeach; ?>
	</div>
	<?php echo $form->error($model, 'specialtiesList'); ?>
</div>
<div class="form-group">
	<?php echo $form->labelEx($model, 'bio'); ?>
	<?php echo $form->textArea($model, 'bio', array('size' => 60, 'maxlength' => 10000, 'class' => 'form-control')); ?>
	<?php echo $form->error($model, 'bio'); ?>
</div>

<div class="form-group " id="qualificationBlock">
	<label class="control-label" for="educationField"><i class="fa fa-graduation-cap"></i> Education</label>
	<hr>
	<div class="allEducation">
		<div class="dynamicInput">
			<?php echo $form->labelEx($model, 'educationTitle', array('class' => 'control-label')); ?>
			<?php echo $form->textField($model, 'educationTitle', array('size' => 10, 'class' => 'form-control')); ?>
			<?php echo $form->error($model, 'educationTitle'); ?>
			<?php echo $form->labelEx($model, 'educationYear', array('class' => 'control-label')); ?>
			<?php echo $form->textField($model, 'educationYear', array('size' => 10, 'maxlength' => 4, 'class' => 'form-control')); ?>
			<?php echo $form->error($model, 'educationYear'); ?>
			<?php echo $form->labelEx($model, 'educationInstitution', array('class' => 'control-label')); ?>
			<?php echo $form->textField($model, 'educationInstitution', array('size' => 10, 'class' => 'form-control')); ?>
			<?php echo $form->error($model, 'educationInstitution'); ?>

			<hr>
		</div>
	</div>
</div>
<div class="form-group " id="awardsBlock">
	<label class="control-label" for="awardsField"><i class="fa fa-trophy"></i> Awards</label>
	<hr>
		<?php echo $form->labelEx($model, 'awardTitle', array('class' => 'control-label')); ?>
		<?php echo $form->textField($model, 'awardTitle', array('size' => 10, 'class' => 'form-control')); ?>
		<?php echo $form->error($model, 'awardTitle'); ?>
		<?php echo $form->labelEx($model, 'awardInstitution', array('class' => 'control-label')); ?>
		<?php echo $form->textField($model, 'awardInstitution', array('size' => 10, 'class' => 'form-control')); ?>
		<?php echo $form->error($model, 'awardInstitution'); ?>
		<hr>

</div>
<div class="form-group " id="publicationBlock">
	<label class="control-label" for="publicationsField"><i class="fa fa-book"></i> Publications</label>

		<?php echo $form->labelEx($model, 'publicationTitle', array('class' => 'control-label')); ?>
		<?php echo $form->textField($model, 'publicationTitle', array('size' => 10, 'class' => 'form-control')); ?>
		<?php echo $form->error($model, 'publicationTitle'); ?>
		<?php echo $form->labelEx($model, 'publicationYear', array('class' => 'control-label')); ?>
		<?php echo $form->textField($model, 'publicationYear', array('size' => 10, 'maxlength' => 4, 'class' => 'form-control')); ?>
		<?php echo $form->error($model, 'publicationYear'); ?>
		<?php echo $form->labelEx($model, 'publicationPublisher', array('class' => 'control-label')); ?>
		<?php echo $form->textField($model, 'publicationPublisher', array('size' => 10, 'class' => 'form-control')); ?>
		<?php echo $form->error($model, 'publicationPublisher'); ?>
	<hr>
</div>


<?php echo CHtml::submitButton('Search',array('class'=>'btn btn-primary','id'=>'submitBtn')); ?>


<?php $this->endWidget(); ?>