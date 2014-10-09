<?php

/**
 * This is the model class for table "Specialties".
 *
 * The followings are the available columns in table 'Specialties':
 * @property integer $id
 * @property integer $adviserId
 * @property integer $specId
 */
class Specialties extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Specialties';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('adviserId, specId', 'required'),
			array('adviserId, specId', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id,adviserId, specId', 'safe', 'on'=>'search'),
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
			'adviserId' => 'Adviser',
			'specId' => 'Specialty',
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
		$criteria->compare('specId',$this->specId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Specialties the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getList()
	{
		return array(
			1=>'Retirement',
			2=>'Investment',
			3=>'Superannuation',
			4=>'Budgeting',
			5=>'Trusts',
			6=>'Insurance',
			7=>'Wealth',
			8=>'Building',
			9=>'Property',
			10=>'SMSF',
			11=>'Tax'
		);
	}
	public function getTitle()
	{
		$list = self::getList();
		return $list[$this->specId];
	}
}
