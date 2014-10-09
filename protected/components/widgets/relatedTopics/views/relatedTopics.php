<?php
$i = 0;
echo CHtml::openTag($this->tagName, $this->htmlOptions);
echo CHtml::openTag('ul');
?>
<div class="title">Related topics</div>
<?php
foreach ($list as $id => $topic) {
    if($limit !=0 && $i++ >= $limit)
        break;
    ?>
    <li class="clearfix topic">
        <?= CHtml::link($topic, '#', array('class' => 'item-value emphasis')) ?>
        <!--<div class="follow-btn" data-id="<?= $id ?>" data-name="<?= $topic ?>" data-state="not_followed" data-type="Topic">
            <span class="follow-text">Follow</span>
            <div class="follow-icon-teal" data-action="follow">
            </div>
          </div>-->
    </li>
    <?php
}
echo CHtml::closeTag('ul');
echo CHtml::closeTag($this->tagName);
?>
