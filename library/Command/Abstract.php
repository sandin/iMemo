<?php
abstract class Command_Abstract 
{
  protected $_receiver;
  protected $_param;

  public function __construct($receiver, $param = null) {
	$this->_receiver = $receiver;
	$this->_param = $param;
  }
	  
  abstract function executeCommand();
}
