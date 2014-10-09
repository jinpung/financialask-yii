<?php
Yii::import('system.web.widgets.CWidget');

class AdviserRatings extends CWidget{
    public $rating, $responseId;
    public function init() {
        
    }
    
    public function run() {
        $this->render('rating', array('rating' => $this->rating));
    }
}