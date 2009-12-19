<?php
class Settings_Model_RegisterFormCheck extends Lds_Models_FormCheck 
{

 // public function __construct()
  //{

  //}

  public function preCheck()
  {
	// 验证码检查
	$this->_db = Zend_Registry::get('db');
	$this->_db_user = new Database_User($this->_db);	
	$this->_t = Zend_Registry::get('translate');
	$this->_db_user = new Database_User($this->_db);	
  }

  public function emailCheck()
  {
	$email = $this->_data['email'];
	
	if ($this->_db_user->usernameIsExist($email)) {
	  $this->addMessage('email',$this->_t->_('This user is exist.'));
	}

	$validator = new Zend_Validate_EmailAddress();
	if (!$validator->isValid($email)) {
	  // email is invalid; print the reasons
	  foreach ($validator->getMessages() as $message) {
		$this->addMessage('email',$this->_t->_($message));
	  }
	}
  }

  public function passwordCheck()
  {
	if (strlen($this->password) < 8) {
	  $this->addMessage('password',$this->_t->_('password is too short,8 chars min.')); 
	}
  }

  public function repasswordCheck()
  {
	$t = Zend_Registry::get('translate');

	$password = $this->_data['password'];
	if ($this->_data['repassword'] != $password) {
	  $this->addMessage('repassword',$t->_('Confirm password should be same as password.'));
	}
  }

  public function postCheck()
  {
	//ccreate a new user
	
	$username = $this->email;
	$password = $this->password;
	
	$this->_db_user = new Database_User($this->_db);	
	$this->_db_user->username = $this->_data['email'];
	$this->_db_user->password = md5($this->_data['password']);
	$this->_db_user->save();

	// auto login with new user's name and password
	$login_helper = new Lds_Helper_Login($username,$password);
	if (!$login_helper->login()) {
	  foreach ($login_helper->getMessages() as $message) {
		$this->addMessage('login',$message);
	  }
	}

  }
}
