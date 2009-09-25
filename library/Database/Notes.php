<?php
require_once('ldslibs/DatabaseObject.php'); 

class Database_Notes extends DatabaseObject
{
  protected $_style = null;
  protected $_content = null;
  protected $_db = null;

  public function __construct($db)
  {
	parent::__construct($db, 'lds0019_notes', 'note_id');

	$this->add('user_id');
	$this->add('category_id','0');
	$this->add('dueDate',null);
	$this->add('star',0);
	$this->add('style',null);
	$this->add('ts_created', time());

	//$this->profile = new Profile_User($db);
	$this->_db = $db;
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

  public function getTags($note_id)
  {
	$note_id = (isset($note_id)) ? $note_id : $this->note_id;
	$query = sprintf('select %s from %s as t_l, %s as t_t
						  where t_l.tag_id = t_t.tag_id
						  and t_l.note_id = ?',
					  'tag_name',
					  'lds0019_notes_link_tags',
					  'lds0019_notes_tags');

    $query = $this->_db->quoteInto($query, $note_id);
	$result = $this->_db->fetchAll($query);
	//var_dump($result);
	return $result;
  }

  public function createTag($tag_name)
  {
	$tag = new Database_NotesTags($this->_db);
	$tag->tag_name = $tag_name;	
	$tag->save();
  }

  public function addTag($tag_name)
  {
	$tag = new Database_NotesTags($this->_db);
	$tag->tag_name = $tag_name;	
	$tag->save();
  }

   public function tagIsExist($note_id,$tag_name)
   {
	$myTags = $this->getTags($note_id);
	$tagId = 312; 


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
	$this->addTag('tag_test');
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
/*
  protected function preInsert(){}
  protected function postLoad(){}
  protected function postInsert(){}
  protected function postUpdate(){}
  protected function preDelete(){}
 */

}
