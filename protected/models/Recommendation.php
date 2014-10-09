<?php

/**
 * This is the model class for table "Recommendations".
 *
 * The followings are the available columns in table 'Recommendations':
 * @property integer $id
 * @property integer $adviserId
 * @property integer $authorId
 * @property string $content
 * @property string $datetime
 */
class Recommendation extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Recommendations';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('adviserId, authorId, content', 'required'),
			array('adviserId, authorId', 'numerical', 'integerOnly'=>true),
			array('content', 'length', 'max'=>255),
			array('adviserId,authorId', 'ECompositeUniqueValidator',
				'attributesToAddError' => 'content',
				'message' => 'You have already recommended this adviser'),
			array('authorId','checkAuthor'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, adviserId, authorId, content, datetime', 'safe', 'on'=>'search'),
		);
	}

	public function checkAuthor($attribute,$params)
	{
		if($this->authorId == $this->adviserId)
			$this->addError($attribute, 'You can not recommend yourself');
	}
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'adviser'=>array(self::BELONGS_TO,'Adviser','adviserId'),
			'author'=>array(self::BELONGS_TO,'Adviser','adviserId')
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
			'authorId' => 'Author',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('adviserId',$this->adviserId);
		$criteria->compare('authorId',$this->authorId);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('datetime',$this->datetime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Recommendation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
