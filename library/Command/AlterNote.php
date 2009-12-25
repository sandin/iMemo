<?php
class Command_AlterNote extends Command_Abstract 
{
  protected $_data;

  public function executeCommand()
  {
      //确保传递了note_id，并有其他值(需要修嘎的内容)
    if (isset($this->_param['note_id']) && count($this->_param) > 2 ) {

    	$note    = $this->_receiver;
        $note_id = $this->_param['note_id'];
	    $user_id = $this->_param['user_id'];
        unset($this->_param['user_id']);

	    if ( $this->checkPermission($user_id,'note_id',$note_id) )
	    {
            if ($note->load($note_id)) {
                $result = $note->alterNote($this->_param);
            }
        }

	return $result;
    }
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
