<?php
class Profile_Model_RegisterFormCheck extends Lds_Models_FormCheck 
{
  public function preCheck()
  {
	// 验证码检查
  }

  public function userCheck()
  {
	$username = $this->_data['user'];

	$this->_db = Zend_Registry::get('db');
	$db_user = new Database_User($this->_db);	
	$db_user->usernameIsExist('liu');


	
  }

  public function postCheck()
  {
      //    create a new user
	 // $db_user->username = 'liu';
	 // $db_user->password = md5(123);
	 // $db_user->save();

  }
}
