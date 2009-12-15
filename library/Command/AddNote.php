<?php
class Command_AddNote extends Command_Abstract 
{
  protected $_data;

  public function executeCommand()
  {
	$note = $this->_receiver;
	
	//解析post数据
	$params = array();
	$params['content']   = $this->_param['note-data'];
	$params['user_id']   = $this->_param['user_id'];
	if (isset($this->_param['categorys'])) {
	  $params['categorys'] = $this->_param['categorys'];  
	}

	if ($params['content'] != null) {
	  $data = $note->createNote($params);
	} else {
	  $data = 'content can not be null.';
	}
	
	return $data;
  }

  public function unExecuteCommand()
  {
	return false;
  }

  public function getData()
  {
	return $this->_data;
  }

  public function setData($data)
  {
	$this->_data = $data;
  }

}
