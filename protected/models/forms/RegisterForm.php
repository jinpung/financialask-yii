<?php


class RegisterForm extends CFormModel {

	const MAX_STEP = 4;

	public $email;
	public $password;
	public $passwordRepeat;
	public $name;
	public $displayname;
	public $phone;
	public $gender;
	public $suburb;
	public $file;
	public $avatarUrl;

	/**
	 * @var array
	 */

	/**
	 * @return array Declares validation rules for registration
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('password, email', 'required','on'=>'step1,step2,step3,step4'),
			array('passwordRepeat', 'compare', 'compareAttribute'=>'password', 'on'=>'step1'),
			array('email','email','on'=>'step1,step2,step3,step4'),
			array('email','unique', 'className' => 'User','on'=>'step1,step2,step3,step4'),
			array('displayname','unique','className' =>'User','on'=>'step2,step3,step4'),
			array('displayname,name','required','on'=>'step2,step3,step4'),
			array('file', 'file','types'=>'jpg, gif, png', 'allowEmpty'=>true,'on'=>'step2,step3,step4'),
			array('gender', 'numerical', 'integerOnly'=>true, 'on'=>'step3,step4'),
			array('password, displayname, name, email,suburb,avatarUrl', 'length', 'max'=>255),
			array('phone', 'length', 'max'=>20, 'on'=>'step3,step4'),
			array('suburb', 'length', 'max'=>255, 'on'=>'step3,step4'),
		);
	}

	public function attributeLabels(){

		return array(
			'email'=>'Your email',
			'password'=>'Password(6+characters)',
			'passwordRepeat'=>'Repeat your password',
			'name'=>'Full Name',
			'displayname'=>'Display name',
			'phone'=>'Phone Number'
		);
	}

	public function register()
	{
		$user = new User();
		$user->attributes = $this->attributes;
		$user->userTypeID = User::TYPE_USER;
		$user->password = CPasswordHelper::hashPassword($this->password);
		return $user->save() ? $user->id : false;
	}

} 