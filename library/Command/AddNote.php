<?php
class Command_AddNote extends Command_Abstract 
{
  protected $_data;

  public function executeCommand()
  {
	$note = $this->_receiver;
	
	//解析post数据
	$params = array();
    //解析main input的内容
    $i_helper = new Lds_Helper_MainInput($this->_param['note-data']);
    $i_helper->parse();
    $dueDate = $i_helper->makeDate();
    $content = $i_helper->getString();

    $params['content']  = $content;
    if ($dueDate !== null)
        $params['dueDate']  = $dueDate;
	$params['user_id']  = $this->_param['user_id'];

    //必须设置category,未指定则放置于系统分类Inbox中
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
      //存入双链顺序表
      $list = LinkedList_Factory::factory('database');
      $list->pushInto($note_id,$cate_id);
      //数据库需要时间戳
      //TODO : 添加时解析时间和日期尚为解决
      if (isset($data['dueDate']) && $data['dueDate'] !== null) {
          $data['dueDate'] = Lds_Helper_MainInput::dateFormater($data['dueDate']);

      }//fi
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
