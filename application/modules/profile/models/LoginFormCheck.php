<?php
class Profile_Model_LoginFormCheck extends Lds_Models_FormCheck 
{
  public function preCheck()
  {
	// 验证码检查
	 $captcha_input = $this->_data['captcha'];
	 $captcha_id = $this->_data['captcha_id'];
	 $captcha_session = new Zend_Session_Namespace('Zend_Form_Captcha_' . $captcha_id);
	 $captcha_word = $captcha_session->word;
	 if ($captcha_input != $captcha_word) {
		$this->addMessage('captcha','captcha wrong');
	 }
  }

  public function postCheck()
  {
		// 验证用户
		/*
		$authAdapter = new Zend_Auth_Adapter_DbTable(
		  $db,
		  'persons',
		  'name',
		  'password'
		);
		 */
		$username = $this->_data['user'];
		$password = $this->_data['password'];
		//$password = MD5($post['password']);

		$auth = Zend_Auth::getInstance(); 
		// 设了namespace,获取时也需使用同样的new一遍
		//$storage = new Zend_Auth_Storage_Session('lds-namespace');
		$storage = new Zend_Auth_Storage_Session();
		//$storage->write('123');
		$auth->setStorage($storage);
		//Zend_Debug::dump($storage,'s');
		//$s = $auth->getStorage($storage);
		//$abs = $s->read();
		//Zend_Debug::dump($abs,'abs');
		
		$db = Zend_Registry::get('db');
		$authAdapter = new Zend_Auth_Adapter_DbTable($db);

		$authAdapter
		  ->setTableName('lds0019_users')
		  ->setIdentityColumn('username')
		  ->setCredentialColumn('password')
		;

		$authAdapter
		  ->setIdentity($username)
	      ->setCredential(md5($password))
		;

		// 执行认证查询，并保存结果
		//$result = $authAdapter->authenticate();
		$result = $auth->authenticate($authAdapter);
		//var_dump($result);

		/*
		$file =  APPLICATION_PATH . '/data/psw/user_password.txt';
		$realm = 'myzone';
		$username = $post['user'];
		$password = MD5($post['password']);
		Zend_Debug::dump(MD5((string)$post['password']));
		Zend_Debug::dump(MD5('123456789'));
		$adapter = new Zend_Auth_Adapter_Digest($file,
											    $realm,
												$username,
												$password);
		Zend_Debug::dump($adapter);

		$result = $adapter->authenticate();

		 */
		if (!$result->isValid()) {
		   // Authentication failed; print the reasons why
		  foreach ($result->getMessages() as $message) {
		   $this->addMessage('username/password',$message);
		  }
		} else {
		  $identity = $result->getIdentity();
		  //Zend_Debug::dump($identity);
		//  $this->_helper->viewRenderer->setNoRender();
		  //$this->_forward('index');

		  $storage = $auth->getStorage();
		  //	  $storage->write('ads');
		  $storage->write($authAdapter->getResultRowObject());
		 // $namespace = new Zend_Session_Namespace('lds-namespace');
		 // Zend_Debug::dump($namespace->name);
		  
		 //Zend_Debug::dump($storage,'storage');
		 //Zend_Debug::dump($storage->read(),'read');
		  
		  //$_SESSION = '';
		 //session_unset() ;
		  //Zend_Session::destroy();
		  //Zend_Debug::dump($_SESSION);
		  //  Zend_Debug::dump($namespace);
		 // Zend_Debug::dump($storage->read(),'storage-read');
		 // Zend_Debug::dump($authAdapter->getResultRowObject(),'Row');
		 // Zend_Debug::dump($storage);
		 //	Zend_Debug::dump($auth,'auth');
		  //  $this->_redirect('/');
		  }	
  }
}
