<?php
class Command_DelNoteCommand extends Command_Abstract 
{

  public function executeCommand()
  {
	$note = $this->_receiver;
	$note_id = $this->getParam('note_id');
	$note->load($note_id);

	$data =	$note->delNote();
	var_dump($data);

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
