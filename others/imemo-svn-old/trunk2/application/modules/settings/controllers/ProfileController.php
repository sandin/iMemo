<?php

class Settings_ProfileController extends Zend_Controller_Action
{

    public function init()
    {
	  $this->_db = Zend_Registry::get('db');
	  $this->_user = Zend_Registry::get('user');
	  
	  $this->_db_user = new Database_User($this->_db);	

	  // only by user
	  if  (!isset($this->_user)) {
		$this->_redirect('/login');
	  };
	}

	public function preDispatch()
	{
	 // Zend_Debug::dump( $this->getRequest());
	}

    public function indexAction()
    {
	  $user_id    = $this->_user->user_id;
      if ($this->_db_user->load($user_id)) {
          $username      = $this->_db_user->username;
          $signUpTime    = date('Y-m-d H:i:s',$this->_db_user->ts_created);
          $lastLoginTime = (isset($this->_db_user->ts_last_login)) 
              ? date('Y-m-d H:i:s',$this->_db_user->ts_last_login)
              : date('Y-m-d H:i:s');

          $userBaseInfo = array(
              array(
                  'key'   => 'user name',
                  'value' => $username
              ),
              array(
                  'key'   => 'sign up time',
                  'value' => $signUpTime
              ),
              array(
                  'key'   => 'last login time',
                  'value' => $lastLoginTime
              ));

          $userInfo = array();//end userInfo
          $this->view->userInfo     = $userInfo;
          $this->view->userBaseInfo = $userBaseInfo;
      }
	}

    public function passwordAction()
    {
    }

}


