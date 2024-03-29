<?php

/**
 * This is the model class for table "Feedback".
 *
 * The followings are the available columns in table 'Feedback':
 * @property integer $id
 * @property integer $userId
 * @property integer $adviserId
 * @property string $title
 * @property string $content
 * @property string $datetime
 * @property integer $type
 */
class Feedback extends CActiveRecord
{
	const TYPE_NEGATIVE = -1;
	const TYPE_NEUTRAL = 0;
	const TYPE_POSITIVE = 1;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Feedback';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userId, adviserId, title, content, type', 'required'),
			array('userId, adviserId, type', 'numerical', 'integerOnly' => true),
			array('title', 'length', 'max' => 255),
			array('userId,adviserId', 'ECompositeUniqueValidator',
				'attributesToAddError' => 'userId',
				'message' => 'Feedback already exists for this adviser.'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, userId, adviserId, title, content, datetime, type', 'safe', 'on' => 'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'userId'),
			'adviser' => array(self::BELONGS_TO, 'Adviser', 'adviserId')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'userId' => 'User',
			'adviserId' => 'Adviser',
			'title' => 'Title',
			'content' => 'Content',
			'datetime' => 'Datetime',
			'type' => 'Type',
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

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('userId', $this->userId);
		$criteria->compare('adviserId', $this->adviserId);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('content', $this->content, true);
		$criteria->compare('datetime', $this->datetime, true);
		$criteria->compare('type', $this->type);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	public function getTypeList()
	{
		return array(
			self::TYPE_NEGATIVE => 'Negative',
			self::TYPE_NEUTRAL => 'Neutral',
			self::TYPE_POSITIVE => 'Positive'
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Feedback the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
}
