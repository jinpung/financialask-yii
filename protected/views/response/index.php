<?php
/* @var $this ResponseController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Question Responses',
);

$this->menu=array(
	array('label'=>'Create QuestionResponse', 'url'=>array('create')),
	array('label'=>'Manage QuestionResponse', 'url'=>array('admin')),
);
?>

<?php 
  $this->renderPartial('/response/_myanswerHeader');
  $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'/response/_view',
  )); 

?>
