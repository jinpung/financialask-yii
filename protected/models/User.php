<?php

/**
 * This is the model class for table "Users".
 *
 * The followings are the available columns in table 'Users':
 * @property string $id
 * @property string $password
 * @property string $displayname
 * @property string $userTypeID
 * @property string $name
 * @property string $email
 * @property integer $gender
 * @property string $phone
 * @property string $created
 * @property string $logintime
 * @property string $suburb
 * @property float  $credit
 */
class User extends CActiveRecord {

    const TYPE_USER = 1;
    const TYPE_ADVISER = 2;
    const TYPE_ADMIN = 3;

    /**
     * @var array
     */
    public $genderList = array(-1 => 'Select Your Gender', 1 => 'Male', 0 => 'Female');

    /**
     * Needed only for registration and profile update
     * @var string
     */
    public $passwordRepeat;

    /*
     * Needed for password change
     * @var string
     */
    public $oldPassword;
    public $newPassword;

    public function getTypeList() {
        return array(
            self::TYPE_USER => 'User',
            self::TYPE_ADVISER => 'Adviser',
            self::TYPE_ADMIN => 'Administrator'
        );
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'Users';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('email, password', 'required'),
            array('password,passwordRepeat', 'required', 'on' => 'register'),
            array('passwordRepeat', 'compare', 'compareAttribute' => 'password', 'on' => 'register'),
            array('logintime', 'default', 'value' => new CDbExpression('NOW()'),),
            array('passwordRepeat', 'compare', 'compareAttribute' => 'newPassword', 'on' => 'updateProfile'),
            array('oldPassword', 'checkPassword', 'on' => 'updateProfile'),
            array('email', 'email'),
            array('email,displayname', 'unique'),
            array('gender', 'numerical', 'integerOnly' => true),
            array('credit', 'numerical', 'min' => 0, 'max' => 99999),
            array('password, displayname, suburb,name, email,passwordRepeat,newPassword,avatarUrl', 'length', 'max' => 255),
            array('userTypeID', 'length', 'max' => 10),
            array('phone', 'length', 'max' => 20),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, password, displayname, userTypeID, name, email, gender, phone', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'adviserProfile' => array(self::HAS_ONE, 'Adviser', 'userId'),
            'advisersList' => array(self::MANY_MANY, 'Adviser', 'AdviceRelation(userID, adviserID)'),
            'activeEvents' => array(self::HAS_MANY, 'NotificationEvent', 'userId',
                'condition' => 'status=' . NotificationEvent::STATUS_ACTIVE
            ),
            'rating' => array(self::HAS_MANY, 'QuestionResponseRating', 'adviserId')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'password' => 'Password',
            'displayname' => 'Display Name',
            'userTypeID' => 'User Type',
            'name' => 'Name',
            'email' => 'Email',
            'gender' => 'Gender',
            'phone' => 'Phone',
            'avatarUrl' => 'Avatar',
        );
    }

    public function checkPassword($attribute, $params) {
        if (isset($this->oldPassword) && !CPasswordHelper::verifyPassword($this->oldPassword, $this->password))
            $this->addError($attribute, 'Old password is incorrect.');
    }

    public function beforeSave() {
        if ($this->newPassword) {
            $this->password = CPasswordHelper::hashPassword($this->newPassword);
        }
        return parent::beforeSave();
    }

    public function isFollowing(Adviser $adviser) {
        return AdviceRelation::model()->countByAttributes(array(
                    'userID' => $this->id,
                    'adviserID' => $adviser->id
        ));
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

        $criteria->compare('id', $this->id, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('displayname', $this->displayname, true);
        $criteria->compare('userTypeID', $this->userTypeID, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('gender', $this->gender);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('suburb', $this->phone, true);
        $criteria->compare('avatarUrl', $this->avatarUrl, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function getList() {
        return CHtml::listData(self::model()->findAll(), 'id', 'displayname');
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
