<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
	  $this->_db = Zend_Registry::get('db');
	  $this->_user = Zend_Registry::get('user');
	  
	  $this->_db_user = new Database_User($this->_db);	
    }

	public function preDispatch() 
	{
	}

    public function indexAction()
	{
	  $this->_db_user->load($this->_user->user_id);
	  // create a new notes
	  $notes = new Database_Notes($this->_db);
	  $notes->load(1);

	  $param =  array(
		'user_id' => $this->_db_user->getId(),
	  );

	  $command = new Command_GetNoteCommand($notes,$param);
	  $this->_db_user->setCommand($command);
	  $notes =  $this->_db_user->executeCommand();
	  
	  $this->view->notes = $notes; 
	  var_dump($notes);
	}



    public function aAction()
	{
	}
	
	public function bAction()
	{
	}

	public function postDispatch()
	{
	  //echo '<br />end of file<br />';
	}

	public function __call($method, $args)
	{
	    if ('Action' == substr($method, -6)) {
            // If the action method was not found, forward to the
            // index action
			return $this->_forward('index');
        }

        // all other methods throw an exception
        throw new Exception('Invalid method "'
                            . $method
                            . '" called',
                            500);
	}
}

