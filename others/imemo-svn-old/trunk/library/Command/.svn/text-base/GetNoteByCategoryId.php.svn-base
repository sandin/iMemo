<?php
class Command_GetNoteByCategoryId extends Command_Abstract 
{
  public function executeCommand()
  {
	$note = $this->_receiver;
	$params = $this->_param;

	if (array_key_exists('user_id',$params)) {
	  $user_id = $this->_param['user_id'];
	  $category_id = (Int) $this->_param['category_id'];
	  //var_dump($user_id);
	  //var_dump($category_id);
	  //var_dump($category_id);
	  $notes = $note->getAllNoteByCategoryIdAndUserId($category_id,$user_id );
	  //预处理输出数据格式
	  foreach ($notes as &$note) {
        //去转义符  
        $note['content'] = stripslashes($note['content']);
        //格式化时间日期
        if (isset($note['dueDate'])) {
            try
            {
            $note['dueDate'] = Lds_Helper_MainInput::dateFormater($note['dueDate']);
            } 
            catch (Exception $e)
            {
                Lds_Helper_Log::writeLog($e);
            }
        }
      }

      if (count($notes) > 0) {
          //根据双链表对notes排序显示
          $list = LinkedList_Factory::factory('array');
          $list->setBaseArray($notes);
          $ordered_notes = $list->orderList(); 
          var_dump('note');
          var_dump($note);
          var_dump('noteorder');
          var_dump($ordered_notes);
          //排序表出错，记录到日志并直接返回未排序的结果
          if (count($notes) > count($ordered_notes)) {
              Lds_Helper_Log::writeLog('order wrong.category_id: '. $category_id);
              return $notes; 
          } else {
              return $ordered_notes;
          }
      }

      return null;
	}
  }
}
