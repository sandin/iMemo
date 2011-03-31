<?php
class Settings_Model_LoginFormCheck extends Lds_Models_FormCheck 
{
  public function preCheck()
  {
	// 验证码检查
	
	 $logger = Zend_Registry::get('logger');

	 $captcha_input = $this->_data['captcha'];
	 $captcha_id = $this->_data['captcha_id'];
	 $logger->info('pre Zend_form_captcha' . $_SESSION);
	 $captcha_session = new Zend_Session_Namespace('Zend_Form_Captcha_' . $captcha_id);
	 $captcha_word = $captcha_session->word;
	 $logger->info('post Zend_form_captcha' . $_SESSION);
	 if ($captcha_input != $captcha_word) {
		$this->addMessage('captcha','captcha wrong.');
	 }
  }

  public function postCheck()
  {
	$username = $this->_data['user'];
	$password = $this->_data['password'];
	$login_helper = new Lds_Helper_Login($username,$password);
	if (!$login_helper->login()) {
	  foreach ($login_helper->getMessage() as $message) {
		$this->addMessage('login',$message);
	  }
	}


  
  }
}
