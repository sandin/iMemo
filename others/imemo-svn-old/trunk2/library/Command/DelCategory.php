<?php
class Command_DelCategory extends Command_Abstract 
{
  protected $_data;
  protected $_db;

  public function executeCommand()
  {
	$note = $this->_receiver;
	$this->_db = Zend_Registry::get('db');
	
	//解析post数据
	$categorys_id = $this->_param['categorys_id'];
	$user_id = $this->_param['user_id'];
	$delAllNote = (int) $this->_param['delAllNote'];

	if (is_array($categorys_id)) {
	  foreach ($categorys_id as $cate_id) {
		$result = $this->delHelper($user_id, $cate_id,$delAllNote);
	  }
	} else {
	  $result = $this->delHelper($user_id, $categorys_id,$delAllNote);
	}	

	return $result;
  }

  public function delHelper($user_id, $cate_id ,$delAllNote)
  {
	if ( $this->checkPermission($user_id,'category_id',$cate_id) )
	{

	  $noteLinkCate = new Database_NotesLinkCategorys($this->_db);
	  //删除该category所拥有的所有note
	  if ($delAllNote == 1) {
		$this->_receiver->delNotesByCategoryId($cate_id);

		//删除连接
		$noteLinkCate->removeNoteCategoryLink($cate_id);
		var_dump('del note');
	  } else {
		var_dump('just del cate');
		//把所有该名下的note转移到inbox下
		$notes = $this->_receiver;
		//$notes = new Database_Notes($this->_db);
		$myNotes = $notes->getAllNoteByCategoryIdAndUserId($cate_id, $user_id);
		$new_cate_id = $notes->createCategoryToUser('Inbox',$user_id);
		foreach ($myNotes as $note) {
		  $noteLinkCate->changeCategoryFormTo($note['note_id'],$cate_id,$new_cate_id);
		}
	  }
	  //如果不是系统所用则可以直接删除category本身
	  if ($cate_id > 10) {
		$cate_db = new Database_NotesCategorys($this->_db);
		$cate_db->delCategoryById($cate_id);
	  }

	  //删除连接
	  $userLinkCate = new Database_UserLinkCategory($this->_db);
	  $userLinkCate->removeUserCategoryLink($cate_id);


	  return true;

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
