<?php

class Blog_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
	  //$this->_forward('index','index');

    }

    public function indexAction()
    {
	  // action body
	  //echo "blog-index-index";
	//$table = new Default_Model_Persons();
	$table = new Blog_Model_Test();
	 
	  $db = $table->getAdapter();
	   $all = $table->fetchAll();
	  foreach ($all as $row) {
		//echo $row->name . "<br />";
	  }
	  //$test = new Blog_Model_Test();
	  //Zend_Debug::dump($test);
	  //echo $table->hi;
	//$view = new Zend_View_Smarty();
	//	$view->setScriptPath('/path/to/templates');
	//	$view->book = 'Zend PHP 5 Certification Study Guide';
	//	$view->author = 'Davey Shafik and Ben Ramsey'
	//	$rendered = $view->render('bookinfo.tpl');	

	  $logger = Zend_Registry::get('logger');
	 // Zend_Debug::dump($logger);
	 // $logger->log('This is a log message!', Zend_Log::INFO);
		
	
	  
	}




}

