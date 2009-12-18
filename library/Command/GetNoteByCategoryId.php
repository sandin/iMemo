<?php
class Command_GetNoteByCategoryId extends Command_Abstract 
{
  public function executeCommand()
  {
	$note = $this->_receiver;
	$params = $this->_param;

	if (array_key_exists('user_id',$params)) {
	  $user_id = $this->_param['user_id'];
	  $category_id = (Int) $this->_param['category_id'];
	  //var_dump($user_id);
	  //var_dump($category_id);
	  //var_dump($category_id);
	  $notes = $note->getAllNoteByCategoryIdAndUserId($category_id,$user_id );
	  //去除转义符
	  foreach ($notes as &$note) {
		$note['content'] = stripslashes($note['content']);
	  }
	  //var_dump($notes);
	  return $notes;
	}
  }
}
