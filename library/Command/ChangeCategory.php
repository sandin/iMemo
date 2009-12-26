<?php
class Command_ChangeCategory extends Command_Abstract 
{
  protected $_data;
  protected $_db;

  public function executeCommand()
  {
	$note = $this->_receiver;
	$this->_db = Zend_Registry::get('db');
	
	//解析post数据
	$user_id      = $this->_param['user_id'];
	$old_cate_id  = $this->_param['old_category_id'];
	$new_cate_id  = $this->_param['new_category_id'];
    $note_id      = $this->_param['note_id'];

	if ( $this->checkPermission($user_id,'note_id',$note_id) )
    {
        $ln_cate = new Database_NotesLinkCategorys($this->_db);
        return $ln_cate->changeCategoryFormTo($note_id,$old_cate_id,$new_cate_id);
    } else {
	  Lds_Helper_Log::writeLog('This user delete note which not belong to him' . $user_id);
	  return 'permission denied';
	}//fi
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
