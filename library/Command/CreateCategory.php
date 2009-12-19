<?php
class Command_CreateCategory extends Command_Abstract 
{
  protected $_data;

  public function executeCommand()
  {
	$note = $this->_receiver;
	
	//解析post数据
	$category_name = $this->_param['category_name'];
	$user_id = $this->_param['user_id'];
	$note->load($user_id);
	$result = $note->createCategoryToUser($category_name, $user_id);

	return $result;
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
