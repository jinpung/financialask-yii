<?php
/* @var $this SearchController */
/* @var $cs CClientScript */
$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;
$cs->registerCssFile($baseUrl . '/style/css/default/search.css');
?>
<div id="content-wrap">
    <div id="content">
        <div class="search-nav search_nav search_wrap">
            <div class="search-inner search_inner">
                <div class="input-wrap input_wrap">
                    <?php 
                        echo CHtml::beginForm('/search/','GET'); 
                        echo CHtml::textField('query', '', array('class'=>'search-input search_input', 'placeholder' => 'Search answers, topics, advicers'));
                        echo CHtml::endForm();
                    ?>
                </div>
            </div>
        </div>
        <div class="search_options">
            <a href="<?php echo $this->createUrl('/search',array('query' => 'budgeting')) ?>" class="search_container budgeting clearfix">
                <div class="content_left">
                    <div class="inner_left">
                        &nbsp;
                    </div>
                    <div class="inner_right">
                        <i class="icon budgeting-icon"></i>
                        Budgeting
                    </div>
                </div>
                <div class="content_right" style = "background: url('/img/searchimages/fasite_searchimage_budget.png'); background-size:100%;" ></div>
            </a>
            <a href="<?php echo $this->createUrl('/search',array('query' => 'investments')) ?>" class="search_container investments clearfix">
                <div class="content_left">
                    <div class="inner_left">
                        &nbsp;
                    </div>
                    <div class="inner_right">
                        <i class="icon investments-icon"></i>
                        Investments
                    </div>
                </div>
                <div class="content_right" style = "background: url('/img/searchimages/fasite_searchimage_investment.png'); background-size:100%;"></div>
            </a>
            <a href="<?php echo $this->createUrl('/search',array('query' => 'retirement')) ?>" class="search_container retirement clearfix">
                <div class="content_left">
                    <div class="inner_left">
                        &nbsp;
                    </div>
                    <div class="inner_right">
                        <i class="icon retirement-icon"></i>
                        Retirement
                    </div>
                </div>
                <div class="content_right" style = "background: url('/img/searchimages/fasite_searchimage_retirement.png'); background-size:100%;"></div>
            </a>
            <a href="<?php echo $this->createUrl('/search',array('query' => 'smsf')) ?>" class="search_container smsf clearfix">
                <div class="content_left">
                    <div class="inner_left">
                        &nbsp;
                    </div>
                    <div class="inner_right">
                        <i class="icon smsf-icon"></i>
                        SMSF
                    </div>
                </div>
                <div class="content_right" style = "background: url('/img/searchimages/fasite_searchimage_smsf.png'); background-size:100%;"></div>
            </a>
            <a href="<?php echo $this->createUrl('/search',array('query' => 'superannuation')) ?>" class="search_container superannuation clearfix">
                <div class="content_left">
                    <div class="inner_left">
                        &nbsp;
                    </div>
                    <div class="inner_right">
                        <i class="icon superannuation-icon"></i>
                        Superannuation
                    </div>
                </div>
                <div class="content_right" style = "background: url('/img/searchimages/fasite_searchimage_superannuation.png'); background-size:100%;"></div>
            </a>
        </div>
    </div>
</div>