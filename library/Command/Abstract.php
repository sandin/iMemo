<?php
abstract class Command_Abstract 
{
  protected $_mHistory;
  protected $_receiver;
  protected $_param;

  public function __construct($receiver = null, $param = null) {
	$this->_receiver = $receiver;
	$this->_param = $param;
	$this->_mHistory = Command_ModificationHistory::getInstance($receiver);
  }
	  
  abstract function executeCommand();

  public function unExecuteCommand(){}

  public function setReceiver($receiver) 
  {
	$this->_receiver = $receiver;
  }
  public function setParam($param)
  {
	$this->_param = $param;
  }

  public function getParam($name = null)
  {
	if ($name && $name != null)	{
	  return $this->_param[$name];
	} else {
	  return $this->_param;
	}
  }

  /** 
	* 执行命名前检查相关的权限
	* 
	* @param $user_id
	* @param $compare
	* 
	* @return 
   */
  public function checkPermission($user_id,$compareType,$compare)
  {
	$db = Zend_Registry::get('db');

	switch ($compareType)
	{
	case 'note_id': 
	  $note = New Database_Notes($db);
	  $note->load($compare);
	  return ($user_id == $note->user_id) ? true : false;
	  break;

	case 'tag_name': 
	  break;

	case 'category_name': 
	  break;

	case 'category_name': 
	  break;

	default:
	  return false;
	}
  }

}
