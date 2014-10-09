<?php
/*
 * @var $this ProfileController
 * @var $user User
 */
/* @var $cs CClientScript */
$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;
$cs->registerCssFile($baseUrl . '/style/css/default/sprites.css');
?>

<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/style/css/default/updateProfile.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/components/bootstrap-select-master/dist/css/bootstrap-select.min.css">
<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/advisorProfileEditor.js"></script>

<div class="profile-wrapper">
    <div class="doctor-actions clearfix">
        <div class="left">
            <div class="doctor-icon"></div>
            &nbsp;
            Financial Adviser
        </div>
        <div class="right">
            <span class="recommend-doc-btn icon-btn">
                <span class="btn-text">Recommend</span>
                <i class="recommend-icon"></i>
            </span>
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
        <form enctype="multipart/form-data" id="adviser-wizard-form" action="/profile/changephoto" method="post" class="ng-pristine ng-valid">
            <div class="main-avatar">         
                <div class='loading-container hidden'>
                    <div class='fg-spinner'></div>
                </div>
                <input type="file" id="update_phpto" name="phpto"/>
                <div class='camera-button-icon' name='image_preview[avatar]'></div>
            </div>
        </form>

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
            <div class="doc-tooltip-icon rating">
                <span class="star_wrap">
                    <div class="star filled-star"></div>
                    <div class="star filled-star"></div>
                    <div class="star filled-star"></div>
                    <div class="star filled-star"></div>
                    <div class="star filled-star"></div>
                </span>
            </div>            
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
                <div class="action-text">Network</div>
                <div class="active-indicator"></div>
            </div>
        </div>
    </div>

    <div class="tab-content about-content clearfix" style="display: block;">
        <div class="left-panel">
            <div class="about-item bio-area">
                <div class="item-title">A little about me<a class="right" href="#" id="bio_edit_link">Edit</a></div>
                <div class="item-content" id="bio_contentbox">
                    <div class="collapsible-item collapsed" id="bio_edit">
                        <div class="item-fade"></div>
                        <div class="content" id="bio_content">
                            <?php
                            echo str_replace("\n", "<br/>", $user->adviserProfile->bio);
                            ?>
                        </div>                        
                    </div>

                </div>
                <div class="item-content hidden" id="bio_editbox">
                    <textarea class="textarea" id="bio_text"><?php echo nl2br($user->adviserProfile->bio); ?></textarea>
                    <input class="btn cancel"  id="bio_cancel" type="button" name="yt0" value="Cancel">
                    <input class="btn btn-primary " id="bio_save" type="button" name="yt0" value="Save">                    
                </div>
            </div>

            <div class="about-item specializitem-area">
                <div class="item-title">I specialize in</div>
                <?php if (count($savedSpecialties) > 0): ?>                    
                    <?php foreach ($savedSpecialties as $spec): ?>
                        <div class="item-list-el specializitem">
                            <?php echo $specialtyList[$spec->specId]; ?>
                            <div class="filter-x" data-type="specializitem" data-id="<?php echo $spec->specId ?>"></div>
                        </div>
                    <?php endforeach; ?>                    
                <?php endif; ?>
                <div class="item-list-el no-specialize">
                    No Specialize              
                </div>
                <div class="item-list-el">
                    <select id="specialist" class="item-list selectpicker" multiple="multiple" title="Specialties Lists">
                        <?php
                        foreach (Specialties::getList() as $key => $value) {
                            printf('<option value="%s">%s</option>', $key, $value);
                        }
                        ?>
                    </select>
                    <a class="" href="#" id="add-specialism">&nbsp;+Add</a>
                </div>
            </div>

        </div>

        <div class="right-panel">

            <div class="about-item suburb-area">
                <div class="item-title">Suburb<a class="right" href="#" id="suburb_edit_link">Edit</a></div>
                <div class="item-content" id="suburb_contentbox">
                    <?php echo $user->suburb; ?>
                </div>
                <div class="item-content hidden" id="suburb_editbox">
                    <input class="input-box" placeholder="Enter suburb" id="suburb_text"/>                    
                    <input class="btn cancel"  id="suburb_cancel" type="button" name="yt0" value="Cancel">
                    <input class="btn btn-primary " id="suburb_save" type="button" name="yt0" value="Save">   
                </div>
            </div>

            <div class="about-item yearstartpractice-area">
                <div class="item-title">Year Start Practice<a class="right" href="#" id="yearstartpractice_edit_link">Edit</a></div>
                <div class="item-content" id="yearstartpractice_contentbox">
                    <?php echo $user->adviserProfile->yearStartPractice; ?>
                </div>
                <div class="item-content hidden" id="yearstartpractice_editbox">
                    <input class="input-box" placeholder="Enter Your YearStartPractice" id="yearstartpractice_text" maxlength="4">                    
                    <input class="btn cancel"  id="yearstartpractice_cancel" type="button" name="yt0" value="Cancel">
                    <input class="btn btn-primary " id="yearstartpractice_save" type="button" name="yt0" value="Save">   
                </div>
            </div>

            <div class="about-item located_area">
                <div class="item-title">I am located at <a class="right" href="#" id="located_edit_link">Edit</a></div>
                <div class="item-content" id="located_contentbox">
                    <div clas="">
                        <div class="location-address">
                            <?php
                            printf('<span id="location_address">%s</span> <span id="postcode">%s</span>', $user->adviserProfile->address, $user->adviserProfile->postcode);
                            ?>
                        </div>
                        <?php if (!empty($user->phone)): ?>
                            <div class="phone-number">
                                Call
                                <a class="number-info" href=#">
                                    <span id="phonenumber"><?php echo $user->phone; ?></span>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>                    
                </div>
                <div class="item-content hidden" id="located_editbox">
                    Address:
                    <input class="input-box" placeholder="Your Address" id="location_address_text"/>
                    Postcode:
                    <input class="input-box" placeholder="Postcode" id="postcode_text"/>
                    Phone Number:
                    <input class="input-box" placeholder="Phone Number" id="phonenumber_text"/>                    
                    <input class="btn cancel"  id="located_cancel" type="button" name="yt0" value="Cancel"/>
                    <input class="btn btn-primary " id="located_save" type="button" name="yt0" value="Save"/>  
                </div>
            </div>


            <div class="about-item">                
                <div class="item-title">Gender</div>
                <div class="item-content">
                    <div class="gender-filter filter-item clickable-radio-group" data-type="gender">                        
                        <input class="fg-radio" id="female-radio" name="gender" type="radio" value="0" <?php
                        if ($user->gender == 0) {
                            echo 'checked="checked"';
                        }
                        ?>>
                        <label class="filter-label" for="female-radio">Female</label>
                        <input class="fg-radio" id="male-radio" name="gender" type="radio" value="1" <?php
                        if ($user->gender == 1) {
                            echo 'checked="checked"';
                        }
                        ?>>
                        <label class="filter-label" for="male-radio">Male</label>                        
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    <div class="tab-content feed-content clearfix">
        <div class="content-text feed-container">
            <?php
            if (sizeof($feeddata) > 0) {
                foreach ($feeddata as $data) {
                    $this->renderPartial('/response/_view', array('data' => $data));
                }
            } else {
                ?>
                <div class="advisor-result-none feed-item">
                    <div class="no-result">
                        You has no activity.
                    </div>
                </div>
                <?php
            }
            ?> 
        </div>
    </div>
    <div class="tab-content network-content clearfix">
        <div class="content-text feed-container">
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
</div>
