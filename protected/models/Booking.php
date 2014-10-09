<?php

/**
 * This is the model class for table "Booking".
 *
 * The followings are the available columns in table 'Booking':
 * @property integer $id
 * @property integer $userId
 * @property integer $adviserId
 * @property integer $callId
 * @property string $reason
 * @property string $datetime
 * @property string $calltime
 * @property integer $status
 * @property string $start
 * @property string $end
 */
class Booking extends CActiveRecord
{
	const STATUS_NA = 0;
	const STATUS_CREATED =1;
	const STATUS_ACCEPTED= 2;
	const STATUS_DECLINED = 3;
	const STATUS_CANCELED = 4;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Booking';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userId, adviserId, reason', 'required'),
			array('userId, adviserId, callId,status', 'numerical', 'integerOnly'=>true),
			array('start,end','date','format'=>'yyyy-M-d H:m:s'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, userId, adviserId, callId, reason, datetime', 'safe', 'on'=>'search'),
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
			'user'=>array(self::BELONGS_TO,'User','userId'),
			'adviser'=>array(self::BELONGS_TO,'Adviser','adviserId'),
			'call'=>array(self::BELONGS_TO,'Call','callId')
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
			'callId' => 'Call',
			'reason' => 'Reason',
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
		$criteria->compare('userId',$this->userId);
		$criteria->compare('adviserId',$this->adviserId);
		$criteria->compare('callId',$this->callId);
		$criteria->compare('reason',$this->reason,true);
		$criteria->compare('datetime',$this->datetime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getCallStatus()
	{
		if(!$this->callId)
			return 'N/A';
		else
			return CHtml::link($this->call->getCallStatus(),array('call/update','id'=>$this->callId));
	}

	public function getStatusList()
	{
		return array(
			self::STATUS_NA => 'N/A',
			self::STATUS_CREATED =>'Created',
			self::STATUS_ACCEPTED=>'Accepted',
			self::STATUS_DECLINED=>'Declined',
			self::STATUS_CANCELED=>'Canceled'
		);
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Booking the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
