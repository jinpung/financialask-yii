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
		<?php echo $form->labelEx($model, 'postcode'); ?>
		<?php echo $form->textField($model, 'postcode', array('size' => 10, 'maxlength' => 10, 'class' => 'form-control')); ?>
		<?php echo $form->error($model, 'postcode'); ?>
	</div>
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




<?php echo CHtml::submitButton('Search',array('class'=>'btn btn-primary','id'=>'submitBtn')); ?>


<?php $this->endWidget(); ?>
</div>
