<?php
Yii::app()->clientScript->registerScript('helpers', '
        rateAdviserUrl = ' . CJSON::encode(Yii::app()->createUrl('adviser/rate')) . ';
');
?>
<div class="ratingBlock">
<?php
if($this->rating == 0) {
?>
  <div class="ask-txt">Please rate this answer</div>
<?php
}
?>
  <div class="doc-tooltip-icon rating rate-row">
      <span class="star_wrap<?php echo ($this->rating == 0) ? ' active' : ''; ?>" data-rating="<?php echo $this->rating ?>" data-responseid="<?php echo $this->responseId; ?>">
          <div class="star filled-star"><div class="star-half first"></div><div class="star-half second"></div></div>
          <div class="star filled-star"><div class="star-half first"></div><div class="star-half second"></div></div>
          <div class="star filled-star"><div class="star-half first"></div><div class="star-half second"></div></div>
          <div class="star filled-star"><div class="star-half first"></div><div class="star-half second"></div></div>
          <div class="star filled-star"><div class="star-half first"></div><div class="star-half second"></div></div>
      </span>
      <div class="feedback-div">
          <div class="rate-row">
              <textarea name="adviser-feedback" placeholder="Feedback for the adivser for this answer" class="adviser-feedback form-control titleField" maxlength="50" rows="1"></textarea>
          </div>
          <div class="rate-row">
              <button type="button" class="btn btn-default btn-xs rate-btn">
                  <span class="glyphicon glyphicon-star"></span> Rate
              </button>
              <button type="button" class="btn btn-default btn-xs cancel-btn">
                  <span class=""></span> Cancel
              </button>
          </div>
      </div>
  </div>
</div>
