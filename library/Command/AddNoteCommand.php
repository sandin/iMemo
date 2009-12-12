<?php
class Command_AddNoteCommand extends Command_Abstract 
{
  protected $_data;

  public function executeCommand()
  {
	$note = $this->_receiver;
	$params = $this->_param;

	$data =	$note->createNote($params);

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
