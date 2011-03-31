<?php
class Command_GetNote extends Command_Abstract 
{
  public function executeCommand()
  {
	$note = $this->_receiver;
	$params = $this->_param;

	if (array_key_exists('user_id',$params)) {
	  $result = array();

	  //根据user_id,取得该用户所拥有的categorys信息
	  $categorys =  $note->getMyCategorysByUserId($params['user_id']);
	  //var_dump($categorys);

	  //根据categorys_id去查询所拥有的note,然后返回新数组结果
	  //形式如下:
	  //array(
	  //  'category_name' => 
	  //	  array(
	  //		0 => array(
	  //		  'note_id' => 1
	  //		  'user_id' => 1
	  //		  ),
	  //		1 => array(
	  //		  'note_id' => 2
	  //		  'user_id' => 2
	  //		  )
	  //	  ),
	  //  'category_name' => 
	  //	  array(
	  //		0 => array(
	  //		  'note_id' => 1
	  //		  'user_id' => 1
	  //		  )
	  //	  )
	  //)
	  foreach ($categorys as $category) {
		$c_notes = $note->getAllNoteByCategoryId($category['category_id']);
		$cate_name = $category['category_name'];
		$result[$cate_name] = $c_notes;
	  }

	  //var_dump($result);
	  return $result;
	}
  }
}
