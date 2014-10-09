<?php

/**
 * This is the model class for table "Advisers".
 *
 * The followings are the available columns in table 'Advisers':
 * @property string $id
 * @property integer $userId
 * @property string $address
 * @property string $postcode
 * @property string $bio
 * @property integer $pointSum
 * @property integer $pointCount
 * @property integer $reviewCount
 * @property integer $reviewSum
 * @property integer $answerCount
 * @property string $actiontime
 * @property string $yearStartPractice
 * @property integer $active
 * @property float $rate
 * @property boolean $directCalls
 */
class Adviser extends CActiveRecord
{

	/* @var integer the maximum period of time without action after which the user becomes offline */
	const TIME_LIMIT = 180;
	/**
	 * @var array needed for editing list of specialties
	 */
	public $specialtiesList;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Advisers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userId', 'required'),
			array('userId, pointSum, pointCount, reviewCount, reviewSum, answerCount, yearStartPractice', 'numerical', 'integerOnly' => true),
            array('rate','numerical','min'=>0,'max'=>999, 'allowEmpty' => true),
			array('directCalls','boolean'),
			array('yearStartPractice', 'length', 'max' => '4'),
			array('id, postcode', 'length', 'max' => 10),
			array('address', 'length', 'max' => 1024),
			array('bio', 'length', 'max' => 10000),
			array('active','default','value'=>0,'setOnEmpty'=>'true'),
			array('actiontime', 'safe'),
			array('specialtiesList', 'type', 'type' => 'array', 'allowEmpty' => true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, userId, address, postcode, bio, pointSum, pointCount, reviewCount, reviewSum, answerCount,yearStartPractice', 'safe', 'on' => 'search'),
		);
	}

	public function scopes()
	{
		return array(
			'online' => array(
				'condition' => 'TIME_TO_SEC(TIMEDIFF(NOW(),actiontime)) < ' . Adviser::TIME_LIMIT
			));
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
			'specialties' => array(self::HAS_MANY, 'Specialties', 'adviserId'),
			'awards' => array(self::HAS_MANY, 'Award', 'adviserId'),
			'educations' => array(self::HAS_MANY, 'Education', 'adviserId'),
			'publications' => array(self::HAS_MANY, 'Publication', 'adviserId'),
			'answers' => array(self::HAS_MANY, 'QuestionResponse', array('userId' => 'userId')),
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
			'address' => 'Address',
			'postcode' => 'Postcode',
			'bio' => 'Bio',
			'pointSum' => 'Points Sum',
			'pointCount' => 'Points Count',
			'reviewCount' => 'Reviews Count',
			'reviewSum' => 'Reviews Sum',
			'answerCount' => 'Answer Count',
			'specialtiesList' => 'Specialties',
			'yearStartPractice' => 'Year attained licence'
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

		$criteria->compare('id', $this->id, true);
		$criteria->compare('userId', $this->userId);
		$criteria->compare('address', $this->address, true);
		$criteria->compare('postcode', $this->postcode, true);
		$criteria->compare('bio', $this->bio, true);
		$criteria->compare('yearStartPractice', $this->yearStartPractice, true);
		$criteria->compare('pointSum', $this->pointSum);
		$criteria->compare('pointCount', $this->pointCount);
		$criteria->compare('reviewCount', $this->reviewCount);
		$criteria->compare('reviewSum', $this->reviewSum);
		$criteria->compare('answerCount', $this->answerCount);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Adviser the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function simpleSearch()
	{
		$criteria = new CDbCriteria;
		$criteria->with = array('user');
		$criteria->compare('user.displayname', $this->userId, true, 'OR');
		$criteria->compare('address', $this->address, true, 'OR');		
		$criteria->compare('bio', $this->bio, true, 'OR');
		$criteria->compare('yearStartPractice', $this->yearStartPractice, true, 'OR');
		$criteria->compare('bio', $this->bio, true, 'OR');

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	public function getRating()
	{
		return Yii::app()->db->createCommand()
			->select('avg(rate)')
			->from(QuestionResponse::model()->tableName())
			->where('userId=:userId', array('userId' => $this->userId))
			->queryScalar();
	}

	public function getSpecialtiesIdx()
	{
		$result = array();
		foreach ($this->specialties as $spec) {
			$result[] = $spec->specId;
		}
		return $result;
	}

	public function isOnline()
	{
		return Yii::app()->db->createCommand()
			->select('TIME_TO_SEC(TIMEDIFF(NOW(),actiontime))')
			->from(self::tableName())
			->where('id = :id', array('id' => $this->id))
			->queryScalar() < self::TIME_LIMIT;
	}

	public function find_advisers_list($offset, $limit)
	{

		$advisers = Yii::app()->db->createCommand()->
		select('*')->
		from('advisers a')->
		join('users u', 'a.userId=u.id')->
		order('a.id DESC')->
		limit($limit)->
		offset($offset)->
		queryAll();

		return $advisers;
	}

	public function getStatusList()
	{
		return array(
			0=>'Off',
			1=>'On'
		);
	}
}
