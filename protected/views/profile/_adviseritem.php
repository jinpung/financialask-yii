<?php
   Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/style/css/default/advisorItem.css');
?>
<div class="advisor-result feed-item">
    <div class="clearfix">
        <a class="avatar left" href="<?php echo Yii::app()->createUrl('/profile/' . $row->user->id); ?>" style="background-image: url(<?php if($row->user->avatarUrl){echo Yii::app()->createUrl($row->user->avatarUrl);}else{ echo Yii::app()->createUrl('/img/default-avatar.png');}?>);"></a>
        <div class="caduceus left"></div>
        <div class="advisor-info left" itemprop="url">
            <a class="advisor-name emphasis" href="<?php echo Yii::app()->createUrl('/profile/' . $row->user->id); ?>"><?php echo $row->user->name?></a>
            <div class="specialty">
                <?php 
                    
                    if(sizeof($row->specialties)){
                        $ary = array();
                        $specialtyList = Specialties::getList();
                        foreach($row->specialties as $item){                            
                            $ary[] = $specialtyList[$item['specId']];
                        }
                        echo implode(',', $ary);
                    }
                ?>
            </div>
            <div class="rating">
                <span class="star_wrap">
                    <div class="star filled-star"></div>
                    <div class="star filled-star"></div>
                    <div class="star filled-star"></div>
                    <div class="star filled-star"></div>
                    <div class="star filled-star"></div>
                </span>
            </div>

            <div class="location"><?php echo $row->address;?></div>
        </div>
    </div>
</div>