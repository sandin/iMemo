<?php
require_once('ldslibs/DatabaseObject.php'); 

class Database_Notes extends DatabaseObject
{
  protected $_style = null;
  protected $_content = null;
  protected $_db = null;
  protected $_join = array();

  public function __construct($db)
  {
	parent::__construct($db, 'lds0019_notes', 'note_id');

	$this->add('user_id');
	$this->add('dueDate',null);
	$this->add('star',0);
	$this->add('style',null);
	$this->add('ts_created', time());
	$this->join('tag','lds0019_notes_link_tags','note_id','note_id','tag_id');
	$this->join('content','lds0019_notes_content','note_id','note_id','content');

	//$this->profile = new Profile_User($db);
	$this->_db = $db;
  }

  public function join($join_id,$joinTable,$joinField,$selfField,$joinTargetField)
  {
	$this->_join[$join_id] = (object) array(
	  'joinTable' => $joinTable,
	  'joinField' => $joinField,
	  'selfField' => $selfField,
	  'joinTargetField' => $joinTargetField
	);
  }

  public function postLoad()
  {
	foreach ($this->_join as $join_id => $v) {
	  $this->loadJoin($join_id);
	}
	//var_dump($this->_join);
  }

  public function LoadJoin($join_id)
  {
	$join = $this->_join[$join_id];

	$query = sprintf('SELECT %s FROM %s INNER JOIN %s 
					  ON %s = %s
					  where %s = ?',
					  $join->joinTargetField,  //tag_id
					  $this->_table,  //lds0019_notes
					  $join->joinTable,	  //lds0019_notes_link_tags
					  //lds0019_notes.note_id
					  $this->_table . '.' . $join->selfField, 
					  //lds0019_notes_link_tags.note_id
					  $join->joinTable . '.' . $join->joinField,
					  $this->_table . '.' . $this->_idField
					  );

    $query = $this->_db->quoteInto($query, $this->getId());
	//var_dump($query);
	$result = $this->_db->fetchCol($query);
	$join->rows = $result;
  }

  public function getJoinRow($join_id)
  {
	return $this->_join[$join_id]->rows;
  }

  public function addJoinRow($join_id)
  {
  	// code...
  }

  /** 
	* only for $this->createNote
	* 
	* @param $key
	*
	* @param & $array
	* @param array & $saveto 
	* 
	* @return 
   */
  public function filterData($key,& $array,& $saveto)
  {
	if (array_key_exists($key,$array)) {
	  $saveto[$key] = $array[$key];
	  unset($array[$key]);
	}
  }

  public function createNote($params)
  {
	$save = array();
	$this->filterData('content',$params,$save);

	foreach ($params as $param => $value) {
	  $this->$param = $value;
	  $save[$param] = $value;
	}
	$this->save();
	$save['note_id'] = $this->getId();

	if (isset($save['content'])) {
	  $this->setContent($this->getId(),$save['content']);
	}

	return $save;
	
  }
  public function delNote($note_id = null ,$user_id = null)
  {
	if ($this->load($note_id)) {
	  $this->user_id = $user_id;
	  $this->delContent($note_id);
	  $this->delTag($tag_id);
	  $this->delete();
	}
  }

  public function getContent($note_id = null)
  {
	$content = new Database_NotesContent($this->_db);
	$content->loadByNotesId($note_id);
 	return $content->content;
  }

  public function setContent($note_id,$text)
  {
	$content = new Database_NotesContent($this->_db);
	if (!$content->loadByNotesId($note_id)) {
	  $content->note_id = $note_id;
	} 
	$content->content = $text;
	$content->ts_modified = time();
	$content->save();
  }

  public function delContent($note_id = null)
  {
	$note_id = (isset($note_id)) ? $note_id : $this->getId();
	$content = new Database_NotesContent($this->_db);
	$content->loadByNotesId($note_id);
	$content->delete();
  }

  public function getTags($note_id = null)
  {
	$note_id = (isset($note_id)) ? $note_id : $this->getId();
	$query = sprintf('select %s from %s as t_l, %s as t_t
						  where t_l.tag_id = t_t.tag_id
						  and t_l.note_id = ?',
					  '*',
					  'lds0019_notes_link_tags',
					  'lds0019_notes_tags');

    $query = $this->_db->quoteInto($query, $note_id);
	$result = $this->_db->fetchAll($query);
	//var_dump($result);
	return $result;
  }

  public function delTag($tag_id)
  {
	$this_note_tags = $this->getJoinRow('tag');
	if (!in_array($tag_id,$this_note_tags)) {
	  
	}
	
  }

  public function createTag($tag_name)
  {
	if ($this->user_id) {
	  $tag = new Database_NotesTags($this->_db);
	  $tag->tag_name = $tag_name;	
	  $tag->user_id = $this->user_id;	
	  $tag->save();
	  return $tag->getId();
	}
  }

  public function makeTagLink($tag_id)
  {
	if ($this->getId()) {
	  $taglink = new Database_NotesLinkTags($this->_db);
	  $taglink->tag_id = $tag_id;
	  $taglink->note_id = $this->getid();
	  $taglink->save();
	}
  }

  public function addTag($tag_name)
  {
	//确定该note没有此tag
	if (!$this->tagIsExistInThisNote($tag_name)) {
	  if (!($tag_id = $this->tagNameToId($tag_name)) ) {
		$tag_id = $this->createTag($tag_name);
	  }
	  $this->makeTagLink($tag_id);
	}
  }

  /** 
	* 检查note是否已经被标记了某tag名
	* 
	* @param $tag_name
	* 
	* @return boolean
   */
  public function tagIsExistInThisNote($tag_name)
  {
	// 如果该用户拥有此名字的tag，则检查此tag是否已经赋予该note
	if ($tag_id = $this->tagNameToId($tag_name)) {
	  $this_note_tags = $this->getJoinRow('tag');
	  if (in_array($tag_id,$this_note_tags)) {
		return true;    
	  } else 	{
		return false;
	  }
	} else {
	  // 如果用户都不拥有这个tag，则无需查询，直接可认定此note没有该tag
	  return false;
	}
  }


  public function tagIsExistInthisUser()
  {

  }

  /** 
	* tag_id 转换成 tag_name
	* 
	* @param $tag_id
	* 
	* @return 
   */
  public function tagIdToName($tag_id)
  {
	$tag_db = new Database_NotesTags($this->_db);
	if ($tag_db->load($tag_id)) {
	  return $tag_db->tag_name;
	} else {
	  return false;
	}
  }

  /** 
	* tag name 转换成 tag id
	* 只在该用户的名下查找tag_name,
	* 也就是说如果该函数返回false，则可说明该用户没有此名字的tag
	* 
	* @param $tag_name
	* 
	* @return 
   */
 public function tagNameToId($tag_name)
  {
	if ($this->user_id) {
	$result = $this->_db->fetchOne(
		"SELECT tag_id FROM lds0019_notes_tags WHERE user_id = :user_id AND tag_name = :tag_name",
		array('user_id' => $this->user_id,
			  'tag_name' => $tag_name)
	);

	  return $result;
	}
  }


   public function tagIsExist($note_id,$tag_name)
   {
	$myTags = $this->getTags($note_id);
	foreach ($myTags as $tag) {
	  if (in_array($tag_name, $tag)) {
		return true;
	  }
	}
	return false;
  }


  public function getCategorys($category_id)
  {
	$categorys = new Database_NotesCategorys($this->_db);
	$categorys->load($category_id);
	return $categorys->categorys_name;
  }

  /** 
	* It's not _load function,just return a array with all result
	* 
	* @param $user_id
	* 
	* @return 
   */
  public function getAllByUserId($user_id)
  {
	$query = sprintf('select %s from %s where user_id = ?',
                     '*',
                     $this->_table);

    $query = $this->_db->quoteInto($query, $user_id);
	$result = $this->_db->fetchAll($query);
	$new_result = array();
	foreach ($result as $item) {
	  $item['content']  = $this->getContent($item['note_id']) ;
	  $item['categorys'] = $this->getCategorys($item['category_id']) ;
	  $item['tags'] = $this->getTags($item['note_id']);
	  
	  $new_result[] = $item;
	}
	//Zend_Debug::dump($new_result);
	return $new_result;
  }

  public function getOneNote($note_id)
  {
	$note_info = array();
	$this->load($note_id);
	$this->_properties['content'] = $this->getContent($note_id);
	$this->getTags($note_id);
	$this->getCategorys($this->category_id);

	return $this->_param;

  }
/*
  protected function preInsert(){}
  protected function postLoad(){}
  protected function postInsert(){}
  protected function postUpdate(){}
  protected function preDelete(){}
 */

}
