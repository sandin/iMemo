<?php

class CategoryController extends Zend_Controller_Action
{
  public function init()
  {
   /* Initialize action controller here */
	$this->_db = Zend_Registry::get('db');
	$this->_user = Zend_Registry::get('user');
	$this->_db_user = new Database_User($this->_db);	
  }

  public function indexAction(){
	//从URL中获取请求的category_id
	$request = $this->getRequest();
	$category_id = $request->getParam('category_id');

	$user_id = $this->_user->user_id;
	$this->_db_user->load($user_id);

	$notes = new Database_Notes($this->_db);
	$category_name = $notes->categoryIdToName($category_id);
	try 
	{
	  if (!$notes->checkThisUserHasThisCategory($user_id, $category_id)) {
		throw new RuntimeException('This category is not belong to you.','0x0002'); 
	  }
	} 
	catch (RuntimeException $e)
	{
	  Lds_Helper_Log::writeLog($e);
	  Lds_Helper_Redirect::goTo('/','You Have not right to access this page',3);
	}

	$param =  array(
	  'user_id' => $this->_db_user->getId(),
	  'category_id' => $category_id
	);

	$command = new Command_GetNoteByCategoryId($notes,$param);
	$this->_db_user->setCommand($command);
	$notes =  $this->_db_user->executeCommand();
	
	$this->view->notes = $notes; 
	$this->view->category_name = $category_name; 
	$this->view->category_id = $category_id; 
	var_dump($notes); 
  }


}
