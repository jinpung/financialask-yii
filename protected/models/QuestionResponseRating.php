<?php

/**
 * This is the model class for table "QuestionResponseRating".
 *
 * The followings are the available columns in table 'QuestionResponseRating':
 * @property integer $id
 * @property integer $adviserId
 * @property integer $responseId
 * @property string $rating
 * @property string $feedback
 * @property integer $userId
 * @property string $datetime
 */
class QuestionResponseRating extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'QuestionResponseRating';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('adviserId, responseId, rating, userId', 'required'),
            array('adviserId, responseId, userId', 'numerical', 'integerOnly'=>true),
            array('rating', 'length', 'max'=>45),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, adviserId, responseId, rating, feedback, userId, datetime', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'adviserId' => 'Adviser',
            'responseId' => 'Response',
            'rating' => 'Rating',
            'feedback' => 'Feedback',
            'userId' => 'User',
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
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('adviserId',$this->adviserId);
        $criteria->compare('responseId',$this->responseId);
        $criteria->compare('rating',$this->rating,true);
        $criteria->compare('feedback',$this->feedback,true);
        $criteria->compare('userId',$this->userId);
        $criteria->compare('datetime',$this->datetime,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return QuestionResponseRating the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
