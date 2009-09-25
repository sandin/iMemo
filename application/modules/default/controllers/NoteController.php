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

	  $param =  array(
		'user_id' => $this->db_user->getId(),
		'category_id' => '1',
		'star' => 3,
		'content' => 'liudingsansansan'
	  );
	  $this->post['user_id'] = $this->db_user->getId();
	  $this->post['content'] = $this->post['data'];
	  $param = $this->post;
	  var_dump($param);

	  $command = new Command_AddNoteCommand($notes,$param);

	  $this->db_user->setCommand($command);
	  $notes =  $this->db_user->executeCommand();
	  $this->view->notes = $notes; 
 
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

