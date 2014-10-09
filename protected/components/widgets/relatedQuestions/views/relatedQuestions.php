<?php
/** @var $model Question */
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl. '/js/relatedQuestion.js', CClientScript::POS_END);
echo CHtml::openTag($this->tagName, $this->htmlOptions);
echo CHtml::openTag('ul');
?>
	<div class="title">Related questions</div>
<?php

foreach ($models as $model) {
  $this->controller->renderPartial('/questions/_viewRelatedQuestion', array('data'=>$model)); 
}
echo CHtml::closeTag('ul');
echo CHtml::closeTag($this->tagName);
?>
