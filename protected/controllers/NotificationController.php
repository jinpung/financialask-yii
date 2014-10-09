<?php

class NotificationController extends FrontController {

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl'
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform these actions
                'actions' => array('index', 'events', 'eventUpdate', 'viewEvent'),
                'users' => array('@'),
            ),
            array('allow', // allow authenticated user to perform these actions
                'actions' => array('events'),
                'users' => array('*'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array(
            'userId' => Yii::app()->user->id
        ));
        $criteria->order = 'datetime desc';
        $criteria->limit = 10;
        $data = NotificationEvent::model()->with('type')->findAll($criteria);
        $this->render('index', compact('data'));
    }

    public function actionEvents() {
      if(Yii::app()->user->isGuest) {
        echo CJSON::encode(array('notViews'=>array(), 'notCount'=>0));
        return;
      }

      $criteria = new CDbCriteria();
      $criteria->addColumnCondition(array(
          'userId' => Yii::app()->user->id,
          'status' => NotificationEvent::STATUS_ACTIVE
        ));

      $criteria->order = 'status desc';
      $criteria->limit = 5;
      $list = NotificationEvent::model()->findAll($criteria);
      $result = $this->renderPartial('_eventsList', compact('list'), true);
      $unreadCount = count($list);
      if (AdminNotification::checkUser(Yii::app()->user->userModel)) {
          $adminNotification = AdminNotification::model()->find(
                  array(
                      'order' => 'id Desc'
                  )
                );
          if($adminNotification){
            $result .= $this->renderPartial('_adminEvent', array('adminNotification' => $adminNotification), true) . $result;
            $notificationStatus = new AdminNotificationStatus();
            $notificationStatus->attributes = array(
                'notificationId' => $adminNotification->id,
                'userId' => Yii::app()->user->id
            );
            $notificationStatus->save();
          }
      }
      $ret = array('notViews' => $result, 'notCount' => $unreadCount);
      echo CJSON::encode($ret);
    }

    public function actionEventUpdate() {
      $data = $_POST['eIDs'];
      $criteria = new CDbCriteria();
      $rows = array();
      foreach ($data as $eID)
          array_push($rows, $eID);
      $newVals = array('status' => NotificationEvent::STATUS_INACTIVE);
      NotificationEvent::model()->updateByPk($rows, $newVals, 'userId=' . Yii::app()->user->id);
    }

}
