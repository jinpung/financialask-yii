<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	public $email;

	public $user;

	const ERROR_STATUS = 3;

	public function __construct($email,$password)
	{
		$this->email=$email;
		$this->password=$password;
	}
	/**
	 * Authenticates a user.
	 */
	public function authenticate()
	{

		$user = User::model()->findByAttributes(array('email'=>$this->email));
		$this->user = $user;
		if(!isset($user))
			 return self::ERROR_USERNAME_INVALID;
		elseif(!CPasswordHelper::verifyPassword($this->password,$user->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		if($user->userTypeID == User::TYPE_ADVISER && !$user->adviserProfile->active)
			$this->errorCode = self::ERROR_STATUS;
		if(!$this->errorCode)
		{
			$user->logintime = new CDbExpression('NOW()');
			$user->save();
		}
		return $this->errorCode;
	}
	/**
	 * Returns the unique identifier for the identity.
	 * The default implementation simply returns {@link username}.
	 * This method is required by {@link IUserIdentity}.
	 * @return string the unique identifier for the identity.
	 */
	public function getId()
	{
		return $this->user->id;
	}

	/**
	 * Returns the display name for the identity.
	 * The default implementation simply returns {@link username}.
	 * This method is required by {@link IUserIdentity}.
	 * @return string the display name for the identity.
	 */
	public function getName()
	{
		return $this->email;
	}
}