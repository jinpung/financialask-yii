<?php
class FaWebUser extends CWebUser {

	private $_userModel;

	public function init(){
		parent::init();
		if(!$this->getIsGuest()){
			$this->_userModel = User::model()->findByPk($this->getId());
		}
	}
	public function getUserModel(){
		return $this->_userModel;
	}

}