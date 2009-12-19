<?php

class Settings_IndexController extends Zend_Controller_Action
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
	}

	public function preDispatch()
	{
	 // Zend_Debug::dump( $this->getRequest());
	}

    public function indexAction()
    {
	//	Zend_Session::start();
		$auth = Zend_Auth::getInstance(); 
		$user = $auth->getIdentity();
		//Zend_Debug::dump($auth->getIdentity(),'id-info');
		//Zend_Debug::dump($auth);
		//Zend_Debug::dump($auth->getStorage()->read());
		//Zend_Debug::dump($auth->hasIdentity(),'login?');
		//Zend_Debug::dump($_SESSION);
		//$this->view->user = $user;
	}

	public function registerAction()
	{
	  $post = $this->getRequest()->getPost();
	  
	  if ( count($post) > 0 ) {
		$formCheck = new Settings_Model_RegisterFormCheck($post);
		//var_dump($post);
	//	$formCheck->setRequired('captcha');
		$formCheck->setRequired($post);
		$formCheck->check();
		//var_dump($formCheck);
		if ( !$formCheck->isSucceed() ) {
		  $this->view->message =  $formCheck->getMessage();
		} else {
		  $this->_redirect('/');
		}	
	  }
	}

	public function loginAction()
	{
	 // var_dump($this->getFrontController()->getBaseUrl());
	 // var_dump($this->getRequest()->getBaseUrl());
	   /*
     $this->_helper->actionStack('index',
                                 'index',
                                 'default',
                                 array('bar' => 'baz'));
		*/
	  $this->_flashMessenger =
            $this->_helper->getHelper('FlashMessenger');
	  //var_dump($this->_flashMessenger->getMessages());

	  $captcha_all = $this->makeCaptcha();
	  $this->view->captcha =  $captcha_all['captcha_html'];
	  $this->view->captcha_id =  $captcha_all['captcha_id'];

	  //Zend_Debug::dump($this->getRequest()->getPost());
	  $post = $this->getRequest()->getPost();
	  //Zend_Debug::dump($post,'post');
	  //Zend_Debug::dump($this->getRequest()->getParam('username'),'auth-username');

	  if ( count($post) > 0 ) {
		$formCheck = new Settings_Model_LoginFormCheck($post);
		//var_dump($post);
	//	$formCheck->setRequired('captcha');
		$formCheck->setRequired($post);
		$formCheck->check();
		//var_dump($formCheck);
		if ( !$formCheck->isSucceed() ) {
		  $this->view->message =  $formCheck->getMessage();
		} else {
		  $this->_redirect('/');
		}	
		
	  }
	}


	public function logoutAction()
	{
	  $this->_helper->viewRenderer->setNoRender();
	  //$auth = Zend_Auth::getInstance(); 
	  Zend_Auth::getInstance()->clearIdentity();
	  $this->_redirect('/');
	}

	/** 
	  * 制作验证图片
	  * 
	  * @return arrya $captcha_all
	 */
	public function makeCaptcha() {
	  $captcha_all = array();
	  // Originating request:


	  $captcha = new Zend_Captcha_Image(array(
		'session' => new Zend_Session_Namespace(),
		'wordLen' => 4,
		'width'	  => 155,
		'height'  => 50,
		'timeout' => 300,
		'font' =>  BOOT_PATH . '/others/fonts/MONACO.TTF', 
		'fontsize' => 24,
		'imgDir' =>  BOOT_PATH	. '/public/temp/',
		'imgUrl' =>  PUBLIC_URL . '/temp/',
	   ));
	  $captcha_id = $captcha->generate();
	  $captcha_session = $captcha->getSession();

	  $captcha_all['captcha_html'] =(string) $captcha->render();
	  $captcha_all['captcha_id'] = $captcha_id;
	  return $captcha_all;
	}

	public function fetchCaptchaAction()
	{
	  $array = $this->makeCaptcha();
	  $captcha_json = json_encode($array);
	  $this->_helper->json->sendJson($captcha_json);
	}

  
}


