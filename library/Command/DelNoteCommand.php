<?php
class Command_AddNoteCommand extends Command_Abstract 
{

  public function executeCommand()
  {
	$note = $this->_receiver;
	$params = $this->_param;

	$data =	$note->createNote($params);

	$old_data = $data;
	//var_dump($this->_mHistory);
//	$this->_mHistory->store(__CLASS__,$old_data,'undo');
	$this->_mHistory->store($this,$old_data,'undo');
  }

  public function unExecuteCommand()
  {
	$this->_mHistory->store($this,$old_data,'redo');

	$note = $this->_receiver;
	$note->load($this->note_id);
	$note->delete();
  }

  protected function addHistory()
  {
  }


}
