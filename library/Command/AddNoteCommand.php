<?php
class Command_AddNoteCommand extends Command_Abstract 
{
  public function executeCommand()
  {
	$note = $this->_receiver;
	$params = $this->_param;
	foreach ($params as $param => $value) {
	  if ($param != 'content') {
		$note->$param = $value;
	  }
	}
	$note->save();
	if (array_key_exists('content',$params)) {
	  $note->setContent($note->getId(),$params['content']);
	}
  }
}
