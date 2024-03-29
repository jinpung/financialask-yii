<?php

/**
 * This is the model class for table "FeedItems".
 *
 * The followings are the available columns in table 'FeedItems':
 * @property string $feedItemID
 * @property string $feedTypeID
 * @property integer $instID
 * @property string $datetime
 */
class FeedItem extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'FeedItems';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('feedTypeID, instID, datetime', 'required'),
			array('instID', 'numerical', 'integerOnly'=>true),
			array('feedTypeID', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('feedItemID, feedTypeID, instID, datetime', 'safe', 'on'=>'search'),
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
			'feedType'=>array(self::BELONGS_TO, 'FeedItemType', 'feedTypeID'),
			'question'=>array(
				self::BELONGS_TO,
				'Question',
				'instID',
				'on'=>'t.feedTypeID = 1'
			),
			'answer'=>array(
				self::BELONGS_TO,
				'QuestionResponse',
				'instID',
				'on'=>'t.feedTypeID = 2'
			)
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'feedItemID' => 'Feed Item',
			'feedTypeID' => 'Feed Type',
			'instID' => 'Inst',
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

		$criteria->compare('feedItemID',$this->feedItemID,true);
		$criteria->compare('feedTypeID',$this->feedTypeID,true);
		$criteria->compare('instID',$this->instID);
		$criteria->compare('datetime',$this->datetime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FeedItem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getObject()
	{
		$obj=null;
		switch($this->feedTypeID)
		{
			case 1:
				$class='Question';
				break;
			case 2:
				$class='QuestionResponse';
				break;
		}
		if(isset($class) && class_exists($class))
		{
			$obj=$class::model()->findByPk($this->instID);
		}
		return $obj;
	}
}
