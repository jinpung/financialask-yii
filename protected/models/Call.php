<?php

/**
 * This is the model class for table "Calls".
 *
 * The followings are the available columns in table 'Calls':
 * @property integer $id
 * @property integer $userId
 * @property integer $adviserId
 * @property string $sessionId
 * @property string $datatime
 * @property integer $status
 */
class Call extends CActiveRecord
{
	const STATUS_DECLINED = 1;
	const STATUS_ACCEPTED = 2;
	const STATUS_IGNORED = 3;
	const STATUS_BUSY = 4;
	const STATUS_IN_PROGRESS = 5;
	const STATUS_CALLING = 6;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Calls';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userId, adviserId, status', 'required'),
			array('userId, adviserId, status', 'numerical', 'integerOnly' => true),
			array('sessionId', 'length', 'max' => 255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, userId, adviserId, sessionId, datatime, status', 'safe', 'on' => 'search'),
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
			'sessionId' => 'Session',
			'datatime' => 'Datatime',
			'status' => 'Status',
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
		$criteria->compare('sessionId', $this->sessionId, true);
		$criteria->compare('datatime', $this->datatime, true);
		if($this->status)
			$criteria->compare('status', $this->status);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	public function getStatusList()
	{
		return array(
			0=>'All',
			self::STATUS_DECLINED => 'Declined',
			self::STATUS_ACCEPTED => 'Accepted',
			self::STATUS_IGNORED => 'Ignored',
			self::STATUS_BUSY => 'Busy',
			self::STATUS_IN_PROGRESS=>'In progress',
			self::STATUS_CALLING =>'Calling'
		);
	}

	public function getCallStatus()
  {
    $statusList = $this->getStatusList();
		return $statusList[$this->status];
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Call the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
}
