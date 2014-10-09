<?php
/* @var $this AdviserController */
/* @var $dataProvider CActiveDataProvider */
/* @var $cs CClientScript */
$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;
$cs->registerScriptFile($baseUrl.'/js/advisers.js', CClientScript::POS_END);
$cs->registerScriptFile($baseUrl.'/js/advisersList.js', CClientScript::POS_END);

echo '<link rel="stylesheet" type="text/css" href="'.$baseUrl.'/style/css/default/viewAdvisers.css">';
echo '<link rel="stylesheet" type="text/css" href="'.$baseUrl.'/style/css/default/sprites.css">';

?>

<!--<div class="row">
    <div class="search-control col-md-8 col-md-offset-2">
        <input class="search-control form-control" placeholder="Search name, specialty, or topic">
        <span class="glyphicon glyphicon-search"></span>
    </div>
</div>-->

<div class="advisers-wrapper">
    <div class="sub-header">
        <div class="search-nav top-doctor-search">
            <div class="search-inner">
                <div class="input-wrap">
                    <input class="search-input" placeholder="Search name, specialty, or topic">
                    <span class="search-x" style="display: none;"></span>
                    <div class="open-filter-btn">
                        <div class="filter-icon"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <div class="page_wrapper">
        <div class="span50 right right-panel">
            <div class="doctor-filter">
    
                <!-- START location filter -->
                <div class="location-filter filter-item clickable-input" data-type="location">
                    <div class="location-icon filter-el-icon"></div>
                    <a>
                        <span class="filter-label" style="display: block;">Location/Suburb</span>
                        <span class="filter-value"></span>
                    </a>
                    <div class="remove-filter-x" style="display: none;"></div>
                </div>
                <div class="location-filter-form" data-type="location" style="display: none;">
                    <div class="filter-input-wrapper location-input">
                        <input class="filter-input search-input" placeholder="Enter location or suburb">
                        <div class="filter-x" data-type="location"></div>
                    </div>
                    <div class="autocomplete-results">
                        <div class="location-results"></div>
                    </div>
                </div>
                <!-- END location filter -->
    
    
                <!-- START specialty filter -->
                <div class="specialty-filter filter-item clickable-select" data-type="specialty">
                    <div class="specialty-icon filter-el-icon"></div>
                    <a>
                        <span class="filter-label" style="display: block;">Specialty</span>
                        <span class="filter-value"></span>
                    </a>
                    <div class="remove-filter-x" style="display: none;"></div>
                </div>
                <div class="specialty-filter-form" data-type="specialty" style="display: none;">
                    <div class="select-results" data-type="specialty">
                        <?php
                        $specialties = Specialties::getList();
                        if (count($specialties) > 0) {
                            foreach ($specialties as $id => $val) {
                                echo '<div class="select-item" data-value="' . $id . '">' . $val . '</div>';
                            }
                        }
                        ?>
                    </div>
                </div>
                <!-- END specialty filter -->
    
                <!-- START years in practice -->
                <div class="years-filter filter-item clickable-select" data-type="years">
                    <div class="years-icon filter-el-icon"></div>
                    <a>
                        <span class="filter-label">Years in Practice</span>
                        <span class="filter-value"></span>
                    </a>
                    <div class="remove-filter-x" style="display: none"></div>
                </div>
                <div class="years-filter-form" data-type="years" style="display: none">
                    <div class="select-results" data-type="years">
                        <div class="select-item">5+</div>
                        <div class="select-item">10+</div>
                        <div class="select-item">15+</div>
                        <div class="select-item">20+</div>
                        <div class="select-item">25+</div>
                    </div>
                </div>
                <!-- END years in practice -->
    
    
                <!-- START gender filter -->
                <div class="gender-filter filter-item clickable-radio-group" data-type="gender">
                    <div class="gender-icon"></div>
                    <input class="fg-radio" id="female-radio" name="gender" type="radio" value="0">
                    <label class="filter-label" for="female-radio">Female</label>
                    <input class="fg-radio" id="male-radio" name="gender" type="radio" value="1">
                    <label class="filter-label" for="male-radio">Male</label>
                    <div class="filter-x" data-type="gender"></div>
                </div>
                <!-- END gender filter -->
    
                <!-- START Highest Rated -->
                <div class="highrated-filter filter-item clickable-checkbox" data-type="highrated">
                    <div class="docscore-icon"></div>
                    <input class="fg-checkbox" id="highrated-checkbox" name="highrated" type="checkbox">
                    <label class="filter-label" for="highrated-checkbox">Highest Rated</label>
                </div>
                <!-- END Highest Rated -->
    
                <!-- START Most Popular -->
                <div class="mostpopular-filter filter-item clickable-checkbox" data-type="mostpopular">
                    <div class="certified-icon"></div>
                    <input class="fg-checkbox" id="mostpopular-checkbox" name="mostpopular" type="checkbox">
                    <label class="filter-label" for="mostpopular-checkbox">Most Popular</label>
                </div>
                <!-- END Most Popular -->
    
                <!-- START Featured -->
                <div class="featured-filter filter-item clickable-checkbox" data-type="featured">
                    <div class="degrees-icon"></div>
                    <input class="fg-checkbox" id="featured-checkbox" name="featured" type="checkbox">
                    <label class="filter-label" for="featured-checkbox">Featured</label>
                </div>
                <!-- END Featured -->
    
                <div class="btn-wrapper">
                    <div class="filter-btn btn">Filter results</div>
                </div>
            </div>
        </div>
        <div class="span50 left left-panel default-doc-list">
            <div class="doctor-results search-results" style="display: none;"></div>
            <div class="doctor-results suggest-doctors">
                <div class="result-title">Suggested for you</div>
            </div>
        </div>
    </div>
</div>
