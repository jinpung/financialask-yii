<?php
/*
 * @var $this ProfileController
 * @var $user User
 */
/* @var $cs CClientScript */
$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;

if(!Yii::app()->user->isGuest){
  $rAtts = array('adviserId' => $user->adviserProfile->id, 'authorId' => Yii::app()->user->userModel->id);
  $recExists = Recommendation::model()->findByAttributes($rAtts);
}
?>

<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/style/css/default/adviserProfile.css"/>
<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/advisorProfile.js"></script>


<div class="profile-wrapper">
    <div class="doctor-actions clearfix">
        <div class="left">
            <div class="doctor-icon"></div>
            &nbsp;
            Financial Adviser
        </div>
        <div class="right">
            <?php if (!Yii::app()->user->isGuest && Yii::app()->user->userModel->userTypeID != User::TYPE_ADVISER) { ?>
                <span class="recommend-doc-btn icon-btn">
                    <span class="btn-text">Recommend<?= ($recExists ? "ed" : "") ?></span>
                    <i class="recommend-icon"></i>
                </span>
            <?php } ?>
            <span class="follow-doc-btn icon-btn" data-follow="false">
                
                <?= $this->renderPartial('_followBtn', array('data' => $user, 'adviser' => $user->adviserProfile)); ?>

            </span>
            <!--<span class="share-btn icon-btn">
                <span class="btn-text">Share</span>
                <i class="share-icon"></i>
            </span>-->
        </div>
    </div>

    <div class="doctor-header" data-doctor-id="10005831">
        <div class="main-avatar"></div>
        <img src="<?php echo $user->avatarUrl; ?>" class="avatar-loader" style="display: none;"/>

        <div class="avatar-placeholder"></div>
        <div class="main-doc-description">
            <div class="caduceus-big"></div>
            <h1 class="doctor-name">
                <?php echo $user->name; ?>
            </h1>

            <div class="intro">
                <?php echo $user->displayname; ?>
            </div>
            <div class="location">
                <div class="location-icon-big"></div>
                <?php
                if ($user->adviserProfile) {
                    echo $user->adviserProfile->address;
                }
                ?>
            </div>
            <?php
            $this->widget('application.components.widgets.adviserProfileRating.AdviserProfileRating', array('user' => $user));
            ?>

            <div class="tooltip-icon doc-tooltip-icon"></div>
            <div class="degrees-separation">
            </div>
        </div>
        <div class="actions tabs3">
            <div class="action-tab active" data-content="about-content">
                <div class="about-icon action-icon"></div>
                <div class="action-text">About</div>
                <div class="active-indicator"></div>
            </div>
            <div class="action-tab" data-content="feed-content">
                <div class="feed-icon action-icon"></div>
                <div class="action-text">Feed</div>
                <div class="active-indicator"></div>
            </div>
            <div class="action-tab" data-content="network-content">
                <div class="networks-icon action-icon"></div>
                <div class="action-text">Agreers</div>
                <div class="active-indicator"></div>
            </div>
        </div>
    </div>

    <div class="tab-content about-content clearfix" style="display: block;">

        <?php if ($user->adviserProfile->unclaimed) { ?>
            <div class="span100">
                <div class="about-item not-participant-item">
                    <div class="item-title">Notice!</div>
                    <div class="item-content">
                        This is only a listing of this adviser. This adviser is not a site participant.
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="span50 left left-panel">
            <div class="about-item">
                <div class="item-title">A little about me</div>
                <div class="item-content">
                    <div class="collapsible-item collapsed" onclick="$(this).toggleClass('collapsed')">
                        <div class="item-fade"></div>
                        <?php
                        echo nl2br($user->adviserProfile->bio);
                        ?>
                    </div>
                </div>
            </div>

            <?php if (count($savedSpecialties) > 0): ?>

                <div class="about-item">
                    <div class="item-title">I specialize in</div>
                    <?php foreach ($savedSpecialties as $spec): ?>
                        <div class="item-list-el">
                            <?php echo $specialtyList[$spec->specId]; ?>
                        </div>
                    <?php endforeach; ?>
                </div>

            <?php endif; ?>
            <?php
            $this->widget('application.components.widgets.adviserRecommendation.AdviserRecommendation', array(
                'adviserId' => $user->adviserProfile->id,
                'recExists' => (isset($recExists)?$recExists:false),
                'htmlOptions' => array(
                    'class' => 'about-item'
                )
                    )
            );
            ?>
        </div>

        <div class="span50 right right-panel">

            <div class="about-item">
                <div class="item-title">Suburb</div>
                <div class="item-content">
                    <?php echo $user->suburb; ?>
                </div>
            </div>

            <div class="about-item">
                <div class="item-title">I am located at</div>
                <div class="item-content">
                    <div class="location-address">
                        <?php
                        echo $user->adviserProfile->address . ' ' . $user->adviserProfile->postcode;
                        ?>
                    </div>
                    <?php if (!empty($user->phone)): ?>
                        <div class="phone-number">
                            Call
                            <a class="number-info" href="tel:<?php echo $user->phone; ?>">
                                <?php echo $user->phone; ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>


            <div class="about-item">
                <div class="item-title">Gender</div>
                <div class="item-content">
                    <?= $user->genderList[$user->gender] ?>
                </div>
            </div>
            <div class="about-item">
                <div class="item-title">Contact information</div>
                <div class="item-content">
                    <?= CHtml::link('Call me', array('chat/call', 'adviserId' => $user->adviserProfile->id)) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-content feed-content clearfix">
        <div class="feed-container">
            <?php
            if (sizeof($feeddata) > 0) {
                foreach ($feeddata as $data) {
                    $this->renderPartial('/response/_view', array('data' => $data));
                }
            } else {
?>
        <div class="advisor-result-none feed-item">
          <div class="no-result">
                This advisor has no activity.
          </div>
        </div>
<?php
            }
            //$this->renderPartial('/response/_view', array('dataProvider' => $dataProvider));
            ?> 
        </div>

    </div>
    <div class="tab-content network-content clearfix">
        <?php
        if (sizeof($agreers) > 0) {
            foreach ($agreers as $data) {
                $this->renderPartial('_adviseritem', array('row' => $data));                
            }
        } else {
?>
        <div class="advisor-result-none feed-item">
          <div class="no-result">
                There are no agreers just yet.
          </div>
        </div>
<?php
        }
        ?>        
    </div>
</div>
