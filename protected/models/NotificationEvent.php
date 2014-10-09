<?php

/**
 * This is the model class for table "NotificationEvent".
 *
 * The followings are the available columns in table 'NotificationEvent':
 * @property integer $id
 * @property integer $userId
 * @property integer $typeId
 * @property integer $objectId
 * @property integer $status
 * @property string $datetime
 */
class NotificationEvent extends CActiveRecord {

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'NotificationEvent';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('userId, typeId, objectId', 'required'),
            array('userId, typeId, objectId, status', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, userId, typeId, objectId, status, datetime', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'type' => array(self::BELONGS_TO, 'NotificationEventType', 'typeId')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'userId' => 'User',
            'typeId' => 'Type',
            'objectId' => 'Object',
            'status' => 'Status',
            'datetime' => 'Datetime',
        );
    }

    public function beforeSave() {
        if (!isset($this->status))
            $this->status = self::STATUS_ACTIVE;
        return parent::beforeSave();
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('userId', $this->userId);
        $criteria->compare('typeId', $this->typeId);
        $criteria->compare('objectId', $this->objectId);
        $criteria->compare('status', $this->status);
        $criteria->compare('datetime', $this->datetime, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return NotificationEvent the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function afterSave() {
        if (!$this->isNewRecord)
            return true;
        $user = User::model()->findByPk($this->userId);
        if ($user->gcm_regid && $this->userId && function_exists("curl_init")) {
            $event = NotificationEvent::model()->findByPk($this->id);
            $message = CActiveRecord::model($event->type->modelClass)->findByPk($event->objectId)->prepareAnswer($event);
            $apiKey = GOOGLE_API_KEY;
            // Replace with real client registration IDs
            $registrationIDs = array($user->gcm_regid);           
            
            // Set POST variables
            $url = 'https://android.googleapis.com/gcm/send';

            $fields = array(
                'registration_ids' => $registrationIDs,
                'data' => array("message" => $message),
            );

            $headers = array(
                'Authorization: key=' . $apiKey,
                'Content-Type: application/json'
            );

            // Open connection
            $ch = curl_init();

            // Set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            //curl_setopt($ch, CURLOPT_POST, true);
            //curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

            // Execute post
            $result = curl_exec($ch);

            // Close connection
            curl_close($ch);
        }
        return parent::afterSave();
    }

}
