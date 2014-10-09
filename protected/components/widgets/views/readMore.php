
<?=CHtml::openTag($this->tagName,$this->htmlOptions)?>
	<div id ='preview<?=$this->getId()?>'>
	<?=$this->preview?>
	</div>
	<div style="display: none" id = "<?=$this->getId()?>" >
	<?=$this->content?>
	</div>
<?=CHtml::closeTag($this->tagName)?>