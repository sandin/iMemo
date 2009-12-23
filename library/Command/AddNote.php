<?php
class Command_AddNote extends Command_Abstract 
{
  protected $_data;

  public function executeCommand()
  {
	$note = $this->_receiver;
	
	//解析post数据
	$params = array();
	$params['content']   = $this->_param['note-data'];
	$params['user_id']   = $this->_param['user_id'];
	if (isset($this->_param['categorys']) && $this->_param['categorys'] != '') {
	  $params['categorys'] = $this->_param['categorys'];  
	} else {
	  $params['categorys'] = 'Inbox';
	}

    //确保内容不为空
	if ($params['content'] != null || $params['content'] != '') {
      //在数据库中新建note
	  $data = $note->createNote($params);
      //为加入双链表中准备数据
      $note_id = $data['note_id'];
      $cate_id = $data['category_id'];

      $list = LinkedList_Factory::factory('database');
      $list->pushInto($note_id,$cate_id);
	} else {
	  $data = 'content can not be null.';
	}

	
	return $data;
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
