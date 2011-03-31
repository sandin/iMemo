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

	  //预处理post数据
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

	/** 
	  * Note所有操作的处理中心,根据URL来分派命令
	  * 
	  * @return 
	 */
	public function indexAction()
	{
	  //根据路由器规定来获取command变量,格式: note/:command
	  $request = $this->getRequest();
	  //预处理command格式
	  $requsetCommand = $request->getParam('command');
	  $requsetCommand = Lds_Helper_MixedCaseToUnderscore::inflector($requsetCommand);
	  $requsetCommand = 'Command_' . $requsetCommand;
	 
	  $notes = new Database_Notes($this->db);

	  //user_id由服务器分配,确保身份
	  $this->post['user_id'] = $this->db_user->getId();
	  $param = $this->post;

	  //初始化command
	  $command = Command_Factory::factory($requsetCommand);
	  //确保请求的命令存在
	  if ($command && $command != null) {
		$command->setReceiver($notes);
	    $command->setParam($param);

		//执行command,并返回结果
		$this->db_user->setCommand($command);
		$status = 'success';
		$response =  $this->db_user->executeCommand();
	  } else {
		$status = 'failure';
		$response = $command;
	  }

	  //将结果打包,编码并发送
	  $result = array('states' => $status,'data' => $response);
	  $json = Zend_Json::encode($result);
	  echo $json;
	}

	public function delAction()
	{
	  //不需要视图
	  $this->_helper->viewRenderer->setNoRender();	  

	  $notes = new Database_Notes($this->db);
	  $param = $this->post;

	  $command = new Command_DelNoteCommand($notes,$param);
	  $this->db_user->setCommand($command);
	  $notes =  $this->db_user->executeCommand();
/*
	  $history = Command_ModificationHistory::getInstance($notes);
	  $myNamespace = new Zend_Session_Namespace('history');
	  $myNamespace->instance = serialize($history);
	  //var_dump($history);
*/
	  $result = array('states' => 'success');
	  $json = Zend_Json::encode($result);
	  echo $json;
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
	}
	


	public function postDispatch()
	{
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

