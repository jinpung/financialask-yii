<?php

class SearchController extends FrontController {

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create'),
                'users' => array('@')
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Show the search page
     */
    public function actionIndex($query = '') {
        if (empty($_GET['query'])) {
            $this->render('index');
        } else {
            $defaultTopics = array('budgeting','investments','retirement','smsf','superannuation');
            if(in_array($query, $defaultTopics)) {
                $topicBg = '/img/searchimages/fasite_searchimage_searchresultspage.png'; // Topic specific image
            } else {
                $topicBg = '/img/searchimages/fasite_searchimage_searchresultspage.png'; // Default topic image
            }
            
            $criteria = new CDbCriteria();
            $criteria->alias = 'q';
            $criteria->join = ' JOIN QuestionResponses qr ON q.id = qr.questionID';
            $criteria->condition = "q.title like :query OR q.content like :query OR qr.brief like :query OR qr.content like :query";
            $criteria->params = array(':query' => '%'.$query.'%');
            $questions = Question::model()->findAll($criteria);
            
            $data['questions'] = $questions;
            $data['topicBg'] = $topicBg;
            $data['topic'] = ucfirst($query);
            $this->render('result', $data);
        }
    }
}
