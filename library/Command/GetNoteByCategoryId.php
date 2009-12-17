<?php
class Command_GetNoteByCategoryId extends Command_Abstract 
{
  public function executeCommand()
  {
	$note = $this->_receiver;
	$params = $this->_param;

	if (array_key_exists('user_id',$params)) {
	  $category_id = $this->_param['category_id'];
	  //var_dump($category_id);
	  $notes = $note->getAllNoteByCategoryId($category_id);
	  //var_dump($notes);
	  return $notes;
	}
  }
}
