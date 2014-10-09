<?php
/* @var $cs CClientScript */
$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;
$cs->registerCssFile($baseUrl . '/style/css/default/viewAdvisers.css');
$cs->registerCssFile($baseUrl . '/style/css/default/videoChat.css');
?>

<div class="adviser-head clearfix">
        <div class="left">
            Video Chat
        </div>
    </div>
	<div class="page_wrapper">
        	<div class="adviser-element padding20 margintop10">
	            <?php
					$this->widget('ext.YiiOpenTok.widget.OpenTokWidget',array(
						'token'=>$token,
						'sessionId'=>$sessionId
					));
				?>
			</div>   
    </div>
    <div class="clearfix"></div>


