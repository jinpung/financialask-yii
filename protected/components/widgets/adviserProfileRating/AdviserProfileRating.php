<?php

Yii::import('system.web.widgets.CWidget');

class AdviserProfileRating extends CWidget {

    public $rating, $user;

    public function init() {
        
    }

    public function run() {
        $rating = 0;
        foreach ($this->user->rating as $adviserRating) {
            $rating += $adviserRating->rating;
        }
        if ($rating) {
            $rating = $rating / count($this->user->rating);
        }
        $this->render('rating', array('rating' => $rating));
    }

}