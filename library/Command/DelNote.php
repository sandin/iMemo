<?php
class Command_DelNote extends Command_Abstract 
{

  public function executeCommand()
  {
	$note = $this->_receiver;
	$note_id = $this->_param['n_id'];
	$user_id = $this->_param['user_id'];

	if ( $this->checkPermission($user_id,'note_id',$note_id) )
	{

	//解析post来的数据
	$params = array();

	$note->load($note_id);

	$data =	$note->delNote();

	$old_data = $data;
	//var_dump($this->_mHistory);
//	$this->_mHistory->store(__CLASS__,$old_data,'undo');
	$this->_mHistory->store($this,$old_data,'undo');
	} else {
	  $data = 'permission denied';
	  Lds_Helper_Log::writeLog('This user delete note which not belong to him');
	}

	return $data;
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
