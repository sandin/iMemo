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
}
