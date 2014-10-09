<h3>Advisers currently online </h3>
<?php
	CHtml::openTag($this->tagName,$this->htmlOptions);
	foreach($models as $model)
		$this->render('_view',compact('model'));
	CHtml::closeTag($this->tagName);
?>