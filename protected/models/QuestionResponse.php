<?php

/**
 * This is the model class for table "QuestionResponses".
 *
 * The followings are the available columns in table 'QuestionResponses':
 * @property integer $id
 * @property integer $questionID
 * @property integer $userId
 * @property string $brief
 * @property string $summary
 * @property string $content
 * @property string $datetime
 * @property integer $rate
 */
class QuestionResponse extends CActiveRecord {
    public $arId;
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'QuestionResponses';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
      // will receive user inputs.
      // /* REMOVED TEMPORARILY - SUMMARY */
        return array(
            array('questionID, userId, content, brief, content', 'required'),
            array('questionID, userId, rate', 'numerical', 'integerOnly' => true),
            array('brief', 'length', 'max' => 25),
            array('summary', 'length', 'max' => 50),
            array('content', 'length', 'min' => 20, 'max' => 2560),
            array('imgUrl', 'length', 'min' => 0, 'max' => 250),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, questionID, userId, content, datetime', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'userId'),
            'question' => array(self::BELONGS_TO, 'Question', 'questionID'),
            'agreements' => array(self::HAS_MANY, 'QuestionAgree', 'responseID'),
            'responseRating' => array(self::HAS_ONE, 'QuestionResponseRating', 'responseId'),
            'thanks' => array(self::HAS_MANY, 'QuestionResponseThank', 'responseId')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'questionID' => 'Question',
            'userId' => 'User',
            'imgUrl' => 'Image',
            'brief' => 'Brief',
            'content' => 'Content',
            'datetime' => 'Datetime',
        );
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
        $criteria->compare('questionID', $this->questionID);
        $criteria->compare('userId', $this->userId);
        $criteria->compare('imgUrl', $this->brief, true);
        $criteria->compare('brief', $this->brief, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('datetime', $this->datetime, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return QuestionResponse the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function afterSave() {
        if (!$this->isNewRecord)
            return true;
        $event = new NotificationEvent();
        $event->attributes = array(
            'userId' => $this->question->userId,
            'typeId' => NotificationEventType::QUESTION_RESPONSE,
            'objectId' => $this->question->id,
            'status' => NotificationEvent::STATUS_ACTIVE
        );
        $event->save();
        return parent::afterSave();
    }

    public function prepareAnswer(NotificationEvent $event) {
        return strtr($event->type->description, array(
            '{advisers_name}' => $this->user->displayname
        ));
    }

}
