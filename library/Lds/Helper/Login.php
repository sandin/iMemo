<?php

class Lds_Helper_Login
{

  protected $_message;
  protected $_result;

  protected $_user;
  protected $_password;

  public function __construct($user,$password)
  {
	$this->_user = $user;
	$this->_password = $password;

  }

  public function login()
  {

	$auth = Zend_Auth::getInstance(); 
	// 设了namespace,获取时也需使用同样的new一遍
	//$storage = new Zend_Auth_Storage_Session('lds-namespace');
  
	$storage = new Zend_Auth_Storage_Session();
	$namespace = $storage->getNamespace(); 
	//$storage->setExpirationHops(5);
	//$storage->setExpirationSeconds(3);
	//$storage->write('123');
	$auth->setStorage($storage);
	//Zend_Debug::dump($storage,'s');
	//$s = $auth->getStorage($storage);
	//$abs = $s->read();
	//Zend_Debug::dump($abs,'abs');
	
	$db = Zend_Registry::get('db');

	$authAdapter = new Zend_Auth_Adapter_DbTable($db);

	// ::todo::
	$authAdapter
	  ->setTableName('lds0019_users')
	  ->setIdentityColumn('username')
	  ->setCredentialColumn('password')
	;
	

	$user     = $this->_user;
    $userDB   = new Database_User($db);
	$password = $userDB->getSafePassword($this->_password,$user);

	$authAdapter
	  ->setIdentity($user)
	  ->setCredential($password)
	;

	// 执行认证查询，并保存结果
	//$result = $authAdapter->authenticate();
	$result = $auth->authenticate($authAdapter);

	if (!$result->isValid()) {
	   // Authentication failed; print the reasons why
	  $this->_message = $result->getMessages() ;
	  $this->_result =  false;
	} else {
	  $identity = $result->getIdentity();
	  //Zend_Debug::dump($identity);

	  $storage = $auth->getStorage();
	  $storage->write($authAdapter->getResultRowObject());

	  // set a cookie to save user info
	  setcookie('ue', $user, time() + 2592000, '/', false);  
	  // ::todo::
	  Zend_Session::rememberMe(2592000);
	  $this->_result = true;
	  }	

	return $this->_result;
  }

  public function getMessage()
  {
  	return $this->_message;
  }


}
