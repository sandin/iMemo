<?php

class Settings_CategorysController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
		/*
	    $ajaxContext = $this->_helper->getHelper('AjaxContext');
        $ajaxContext->addActionContext('view', 'html')
                    ->addActionContext('form', 'html')
                    ->addActionContext('process', 'json')
                    ->initContext();
		  */
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
	  //$auth = Zend_Auth::getInstance(); 
	  //$user = $auth->getIdentity();
	  //$this->view->user = $user;

	  $user_id = $this->_user->user_id;
	  $this->_db_user->load($user_id);
	  // create a new notes
	  $notes = new Database_Notes($this->_db);
	  $categorys = $notes->getMyCategorysByUserId($user_id);
	
	  $this->view->categorys = $categorys; 
	  var_dump($categorys);
	}

}


