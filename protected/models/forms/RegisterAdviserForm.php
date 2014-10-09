<?php
/**
 * This is the model class for Advisers advanced search form
 *
 * The followings are the available fields at form:
 * @property string $address
 * @property string $suburb
 * @property string $postcode
 * @property string $bio
 * @property array  $specialtiesList
 */

class RegisterAdviserForm extends RegisterForm{

	const MAX_STEP = 4;
	public $step;
	public $address;
	public $postcode;
	public $bio;
	public $yearStartPractice;
	public $specialtiesList = array();

	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('password, email', 'required','on'=>'step1,step2,step3,step4'),
			array('password','length','min'=>6,'on'=>'step1'),
			array('passwordRepeat', 'compare', 'compareAttribute'=>'password', 'on'=>'step1'),
			array('email','email','on'=>'step1,step2,step3,step4'),
			array('email','unique', 'className' => 'User','on'=>'step1'),
			array('displayname','unique','className' =>'User','on'=>'step2,step3,step4'),        
			array('gender', 'numerical', 'integerOnly'=>true,'on'=>'step2,step3,step4'),
			array('name','required','on'=>'step2,step3,step4'),
			array('displayname','required','on'=>'step2,step3,step4'),
			array('file', 'file','types'=>'jpg, gif, png', 'allowEmpty'=>true),
			array('postcode', 'length', 'max' => 10,'on'=>'step3,step4'),
			array('phone', 'length', 'max'=>20,'on'=>'step3,step4'),
			array('address', 'length', 'max' => 1024,'on'=>'step3,step4'),
			array('suburb', 'length', 'max' => 200,'on'=>'step3,step4'),
            array('yearStartPractice', 'length', 'max' => 4,'on'=>'step3,step4'),
			array('bio', 'length', 'max' => 10000,'on'=>'step3,step4'),
			array('specialtiesList', 'type', 'type' => 'array', 'allowEmpty' => true,'on'=>'step3,step4'),
			array('avatarUrl','length','max'=>250, 'on'=>'step3,step4'),
			array('step', 'numerical', 'integerOnly'=>true)
		);
	}
	public function attributeLabels()
	{
		return array_merge(parent::attributeLabels(),array(
			'address'=>'Your Address'
		));
	}
	public function register()
	{
		$user = new User();        
		$user->attributes = array(
			'password'=> CPasswordHelper::hashPassword($this->password),
			'displayname'=>$this->displayname,
			'userTypeID'=>User::TYPE_ADVISER,
			'name'=>$this->name,
			'email'=>$this->email,
			'gender'=>$this->gender,
			'phone'=>$this->phone,
			'suburb'=>$this->suburb,
			'avatarUrl'=>$this->avatarUrl
		);
        if(!$user->save()){
            var_dump($user->getErrors()); 
            die("USER Create Error");
            return false;
        }
	
		$adviser = new Adviser();
		$adviser->attributes = array(
			'userId'=>$user->id,
			'address'=>$this->address,
			'postcode'=>$this->postcode,
			'bio'=>$this->bio,
			'yearStartPractice'=>$this->yearStartPractice
		);
        if(!$adviser->save()){
            echo $user->id;
            die("Adviser Create Error");
            return false;
        }		
       
		foreach($this->specialtiesList as $item)
		{
			if($item){
				$spec = new Specialties();
				$spec->specId = $item;
				$spec->adviserId = $adviser->id;
				$spec->save();
			}
		}
		return true;
	}
} 