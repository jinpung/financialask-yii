<?php

class ActivityController extends FrontController {

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow authenticated user
                'actions' => array('index', 'json', 'page'),
                'users' => array('*'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function actions() {
        return array(
            // page action renders "static" pages stored under 'protected/views/activity/pages'
            // They can be accessed via: index.php?r=activity/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
                'layout' => false,
            ),
        );
    }

    public function actionJson() {
        $t1 = microtime(true);
        $criteria = new CDbCriteria();
        $criteria->limit = 10;
        $criteria->with = array(
            'feedType' => array(
            ),
            'question' => array(
            // Only display owned questions
            //'condition'=>'question.userId is null or question.userId = :userId'
            ),
            'answer' => array(
                //'condition'=>'question_answer.userId is null or question_answer.userId = :userId',
                'with' => array(
                    'question' => array(
                        'alias' => 'question_answer'
                    ),
                    'thanks' => array(
                        'alias' => 'thanks',
                        'with' => array("user" => array(
                                'alias' => 'user'
                                
                            )
                        )
                    ),
                    'agreements' => array(
                        'alias' => 'agreements',
                        'with' => array("adviser" => array(
                                'alias' => 'adviser'
                                
                            )
                        )
                    )
                )
            ),
        );
//		$criteria->params[':userId']=Yii::app()->user->id;
        // Recent items first
        $criteria->order = 't.feedItemID DESC';

        // Get options
        $request = Yii::app()->request;
        $before_id = $request->getQuery('before_id');
        $since_id = $request->getQuery('since_id');
        if (is_numeric($before_id)) {
            $criteria->addCondition('feedItemID < :before_id');
            $criteria->params[':before_id'] = $before_id;
        }
        if (is_numeric($since_id)) {
            $criteria->addCondition('feedItemID > :since_id');
            $criteria->params[':since_id'] = $since_id;
        }
        $criteria->addCondition('t.feedTypeID = :type_id');
        $criteria->params[':type_id'] = '2';

        $items = array();
        $isGuest = Yii::app()->user->isGuest;
        if(!$isGuest) $loggedUser = Yii::app()->user->userModel;

        foreach (FeedItem::model()->findAll($criteria) as $item) {
            $row = array(
                'id' => $item->feedItemID,
                'type' => strtolower($item->feedType->name),
            );

            switch ($item->feedTypeID) {
              case FeedItemType::TYPE_QUESTION:
                  $row['question'] = $item->question->getAttributes(array('id', 'content', 'datetime'));
                  $row['question']['user'] = $item->question->user->getAttributes(array('id', 'name', 'avatarUrl'));
                  break;
              case FeedItemType::TYPE_ANSWER:
                  $row['question'] = $item->answer->question->getAttributes(array('id', 'content', 'datetime'));
                  $row['question']['user'] = $item->answer->question->user->getAttributes(array('id', 'displayName', 'name'));
                  $row['answer'] = $item->answer->getAttributes(array('id', 'content', 'datetime', 'brief', 'summary', 'imgUrl', 'refURL'));
                  $row['answer']['user'] = $item->answer->user->getAttributes(array('id', 'name', 'avatarUrl'));
                  $row['answer']['agreement'] = array();
                  
                  if (sizeof($item->answer->agreements) > 0) {
                      $ary = array();
                      foreach ($item->answer->agreements as $agreement) 
                          $ary[] = $agreement->adviser->user->getAttributes(array('id', 'name', 'avatarUrl'));
                      $row['answer']['agreement'] = $ary;
                  }

                  $thankObj = array();
                  $thankObj['thankCount'] = count($item->answer->thanks);
                  $thankObj['userThanked'] = false;
                  
                  if(!$isGuest) foreach ($item->answer->thanks as $thank) {
                    if($thank->userId == $loggedUser->id){
                      $thankObj['userThanked'] = true;
                      break;
                    }
                  }
                  $row['answer']['thanks'] = $thankObj;
                  break;
            }
            $items[] = $row;
        }
        $t2 = microtime(true);
//		error_log(sprintf('Activities JSON generated in %.5f seconds', $t2-$t1));
        header('Content-type: application/json');

        /* TODO: hash the uID + uTypeID with salt for verification */
        $userData = array();
        $userData['isGuest'] = $isGuest;
        if(!$isGuest) $userData = array_merge($userData, array('id'=>$loggedUser->id, 'type'=>$loggedUser->userTypeID, 'avatarUrl'=>$loggedUser->avatarUrl));

        echo json_encode(array('user'=>$userData, 'activities'=>$items));
    }

}
