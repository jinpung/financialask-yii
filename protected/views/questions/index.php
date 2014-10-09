<?php
/* @var $this QuestionController */
/* @var $dataProvider CActiveDataProvider */
/* @var $headerText String */
  if(!isset($headerText)) $headerText = "Questions";
	echo CHtml::form(array('search'),'get',array('class'=>'navbar-form navbar-right','role'=>'search'));
?>
<div class="form-group">
	<?=CHtml::textField('query','',array('placeholder'=>'Search','class'=>'form-control')) ?>
</div>
<?php
	echo CHtml::submitButton('Submit',array('class'=>'btn btn-default'));
	echo CHtml::endForm();

  $this->renderPartial('_questionsHeader', array('headerText'=>$headerText));

  $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_viewPreview',
)); ?>
