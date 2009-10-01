<?php

class NoteController extends Zend_Controller_Action
{

    public function init()
    {
	  /* Initialize action controller here */
	  $this->db = Zend_Registry::get('db');
	  $this->user = Zend_Registry::get('user');
	  // only by user
	  if  (!isset($this->user)) {
		$this->_redirect('/login');
	  };
	  
	  $this->db_user = new Database_User($this->db);
	  $this->db_user->load($this->user->user_id);

	  $this->post_filter = new Zend_Filter();
	  $this->post_filter//->addFilter(new Zend_Filter_HtmlSpecialChars())
						->addFilter(new Zend_Filter_StringTrim());
	  
	  $this->post = array();
	  foreach ($_POST as $key => $value)
	  {
		$this->post[$key] = htmlspecialchars($this->post_filter->filter($value));
	  }

    }

	public function preDispatch() 
	{
	
	
	}

	public function indexAction()
	{
	}

    public function addAction()
	{
	  //var_dump($this->post);
	  /*
	  foreach ($this->post as $key => $value)
	  {
		var_dump($value);
	  }
	   */
	  $notes = new Database_Notes($this->db);


	  $this->post['user_id'] = $this->db_user->getId();
	  $this->post['content'] = $this->post['data'];
	  unset($this->post['data']);
	  $param = $this->post;
	  //var_dump($param);

	  $command = new Command_AddNoteCommand($notes,$param);

	  $this->db_user->setCommand($command);
	  $notes =  $this->db_user->executeCommand();
	  $old_data = $this->db_user->getCommand()->getData();
	  $this->view->notes = $notes; 

	  $history = Command_ModificationHistory::getInstance($notes);

	  $logger = Zend_Registry::get('logger');
	  $myNamespace = new Zend_Session_Namespace('history');

	  $logger->info('per namespan history' . $_SESSION);
	  $myNamespace->instance = serialize($history);
	  $logger->info('post namespan history' . $_SESSION);
	  //var_dump($history);
	}

	public function delAction()
	{
	  //var_dump($this->post);
	  /*
	  foreach ($this->post as $key => $value)
	  {
		var_dump($value);
	  }
	   */
	  $notes = new Database_Notes($this->db);


	  $this->post['user_id'] = $this->db_user->getId();
	  $this->post['content'] = $this->post['data'];
	  unset($this->post['data']);
	  $param = $this->post;
	  //var_dump($param);

	  $command = new Command_DelNoteCommand($notes,$param);

	  $this->db_user->setCommand($command);
	  $notes =  $this->db_user->executeCommand();
	  $old_data = $this->db_user->getCommand()->getData();
	  $this->view->notes = $notes; 

	  $history = Command_ModificationHistory::getInstance($notes);

	  $myNamespace = new Zend_Session_Namespace('history');

	  $myNamespace->instance = serialize($history);
	  //var_dump($history);
	}

	public function undoAction()
	{
	 $this->_helper->viewRenderer->setNoRender();	  

	 $history = Command_ModificationHistory::getInstance($notes);
	// $myNamespace = new Zend_Session_Namespace('history');
	 //$history =  unserialize($myNamespace->instance);	 
	 $history->undo();
	 //var_dump($history);
	}

    public function aAction()
	{
	  $notes = new Database_Notes($this->db);
	  $this->_helper->viewRenderer->setNoRender();	  

	  $myNamespace = new Zend_Session_Namespace('myNamespace');
	  $old = $myNamespace->old_data ;
	 
	  $command = new Command_AddNoteCommand($notes,null);
	  $this->db_user->setCommand($command);
	  $this->db_user->getCommand()->setData($old);
	  $this->db_user->unExecuteCommand();
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

