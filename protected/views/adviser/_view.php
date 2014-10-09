<?php
/* @var $this AdviserController */
/* @var $data Adviser */


$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->getBaseUrl(true);
//$cs->registerCssFile($baseUrl.'/style/css/default/viewQuestion.css');
//$cs->registerCssFile($baseUrl.'/css/questionResponse.css');        
$cs->registerCssFile($baseUrl.'/style/css/default/viewAdvisers.css');        
$cs->registerScriptFile($baseUrl.'/js/advisersList.js', CClientScript::POS_END);
$specialtyList = Specialties::getList();
$specialties = '';
if (count($data->specialties) > 0) {
    foreach ($data->specialties as $spec) {
        if ($specialties != '')
            $specialties .= ', ';
        $specialties .= $specialtyList[$spec['specId']];
    }
}
?>
<div class="doctor-result">
    <div class="clearfix">
        <?php echo CHtml::link('', array('/profile/' . $data->userId), array('class' => 'avatar left')); ?>
        <img src="<?php echo $baseUrl.''.$data->user->avatarUrl ?>" class="avatar-loader" style="display: none;"/>
        <div class="caduceus left"></div>
        <div class="doctor-info left" itemprop="url">
            <?php echo CHtml::link(CHtml::encode($data->user->displayname), array('/profile/' . $data->userId), array('class' => 'doctor-name emphasis')); ?>
            <div class="specialty"><?php echo $specialties; ?></div>
            <div class="rating">
                <span class="star_wrap">
                    <div class="star filled-star"></div>
                    <div class="star filled-star"></div>
                    <div class="star filled-star"></div>
                    <div class="star filled-star"></div>
                    <div class="star filled-star"></div>
                </span>
            </div>

            <div class="location">
                <div class="small-location-icon"></div><?php echo $data->address; ?>
            </div>
        </div>
    </div>
</div>
