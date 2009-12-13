<?php
class Command_GetNote extends Command_Abstract 
{
  public function executeCommand()
  {
	$note = $this->_receiver;
	$params = $this->_param;

	if (array_key_exists('user_id',$params)) {
	  $result =  $note->getAllByUserId($params['user_id']);
	  //var_dump($result);
	  return $result;
	}
  }
}
