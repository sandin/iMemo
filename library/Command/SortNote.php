<?php
class Command_SortNote extends Command_Abstract 
{

  public function executeCommand()
  {
	$note    = $this->_receiver;
	$user_id = $this->_param['user_id'];
    $index   = $note_id = $this->_param['index'];
    $front   = $this->_param['front'];
    $cate    = $this->_param['categorys'];


	if ( $this->checkPermission($user_id,'note_id',$note_id) )
	{
        $list = LinkedList_Factory::factory('database');
        //如果没有发送来前元素,则默认为是将该元素置顶
        if (isset($front) && $front != null && $front != 'null') {
            $data  = $list->placeAfter($index,$front);
        } else {
            $first = $list->findFirstNodeInDatabase(true,$cate);
            $data  = $list->placeBefore($index,$first);
        }
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
