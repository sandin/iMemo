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
	$this->join('category','lds0019_notes_link_categorys','note_id','note_id','category_id');
	$this->join('content','lds0019_notes_content','note_id','note_id','content');

	//$this->profile = new Profile_User($db);
	$this->_db = $db;
  }

  /** 
	* 添加外链到此表的table
	*
	* @todo 移到抽象类中
	* 
	* @param $join_id       join的标识符
	* @param $joinTable     外链table
	* @param $joinField		 
	* @param $selfField		  
	* @param $joinTargetField  外链table中的目标
	* 
	* @return 
   */
  public function join($join_id,$joinTable,$joinField,$selfField,$joinTargetField)
  {
	$this->_join[$join_id] = (object) array(
	  'joinTable' => $joinTable,
	  'joinField' => $joinField,
	  'selfField' => $selfField,
	  'joinTargetField' => $joinTargetField
	);
  }

  /** 
	* 为了方便，load时自动加载join table中的目标值，
	* 
	* @return 
   */
  public function postLoad()
  {
	foreach ($this->_join as $join_id => $v) {
	  $this->loadJoin($join_id);
	}
	//var_dump($this->_join);
  }

  /** 
	* 载入外链table的目标值，并以数组形式存入$this->_join['join_id']->rows
	* 
	* @param $join_id
	* 
	* @return 
   */
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

  /** 
	* 取出一条指定join_id的目标值数组
	* 
	* @param $join_id
	* 
	* @return 
   */
  public function getJoinRow($join_id)
  {
	return $this->_join[$join_id]->rows;
  }

  public function addJoinRow($join_id)
  {
  	// code...
  }

  /** 
	* $this->createNote需要过滤一些不能直接添加的数据
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

  /** 
    * 新建note	
    * [used]
	* 	 
	* @param $params
	* 
	* @return array 返回新增（修改）note的细节

   */
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

	if (isset($save['tags'])) {
	  $tags = $save['tags'];
	  if (is_array($tags)) {
		foreach ($tags as $tagname) {
		  $this->addTag($tagname);
		}
	  } else {
		$this->addTag($tags);
	  }
	}

	if (isset($save['categorys'])) {
	  $categorys = $save['categorys'];
	  $user_id = $save['user_id'];
	  if (is_array($categorys)) {
          //设计不支持多category,此处暂无用
		foreach ($categorys as $category_name) {
		  $cate_id = $this->addCategory($category_name, $user_id);
		}
	  } else {
		$cate_id = $this->addCategory($categorys, $user_id);
        $save['category_id'] = $cate_id;
	  }
	}

	return $save;
  }

  /** 
	* 必须先load
	* [used]
	* 
	* @return 
   */
  public function delNote()
  {
	if ($tags = $this->getJoinRow('tag')) {
	  foreach ($tags as $tag_id) {
		$tag_name = $this->tagIdToName($tag_id);
		$this->delTag($tag_name);
	  }
	}
	$note_id = $this->getId();
	$this->delContent($note_id);
	$noteLinkCate = new Database_NotesLinkCategorys($this->_db);
	$noteLinkCate->loadByNoteId($note_id);
	$cate_id = $noteLinkCate->category_id;
	$result = $noteLinkCate->removeNoteCategoryLink($cate_id);

	return ($this->delete() && $result);
  }

  /** 
	* createNote时需要设置note content
    * [used]
	* 
	* @param $note_id
	* @param $text
	* 
	* @return 
   */
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

  /** 
	* delNote时需要删除note content
	* 
	* @param $note_id
	* 
	* @return 
   */
  public function delContent($note_id = null)
  {
	$note_id = (isset($note_id)) ? $note_id : $this->getId();
	$content = new Database_NotesContent($this->_db);
	$content->loadByNotesId($note_id);
	$content->delete();
  }

  /** 
	* 为note addTag时可能需要create a new tag
	* 
	* @param $tag_name
	* 
	* @return 
   */
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

  /** 
    * 为用户创建一个全新的category
    * 此时只操作了category和userLinkCategory,
    * 也就是新建时不和任何一个note做链接
    * 换言之,该category在新建时,没有任何所属的note
	* 
	* @todo 测试内部的两个if
	*
	* @param $category_name
	* @param $user_id
	* 
	* @return 
   */
  public function createCategoryToUser($category_name, $user_id)
  {
	//看字典表中是否存在
	if (!($cate_id = $this->categoryNameToId($user_id,$category_name)) )
	{
	  $cate = new Database_NotesCategorys($this->_db);
	  $cate->category_name = $category_name;	
	  $cate->save();
	  $cate_id = $cate->getId();
	}

	$userLinkCate = new Database_UserLinkCategory($this->_db);

	//确认链接不存在
	if (!$userLinkCate->thisUserHasThisCategory($user_id, $cate_id)) {
	  $userLinkCate->user_id = $user_id;
	  $userLinkCate->category_id = $cate_id;
	  $userLinkCate->save();
	}
	//var_dump($cate_id);
	return (($cate_id) ? $cate_id : false);
  }
  /** 
	* addTag时，需要创造新的note与tag之间的link
	* 需Database_NotesLinkTags支持 
	* 
	* 
	* @param $tag_id
	* 
	* @return 
   */
  public function makeTagLink($tag_id)
  {
	if ($this->getId()) {
	  $taglink = new Database_NotesLinkTags($this->_db);
	  $taglink->tag_id = $tag_id;
	  $taglink->note_id = $this->getid();
	  $taglink->save();
	  return $taglink->getId();
	}
  }

  /** 
	* addCategory时需要为note和category创建链接
	* 
	* @param $category_id
	* 
	* @return 
   */
  public function makeCategoryLink($category_id)
  {
	if ($this->getId()) {
	  $taglink = new Database_NotesLinkCategorys($this->_db);
	  $taglink->category_id = $category_id;
	  $taglink->note_id = $this->getid();
	  $taglink->save();
	  return $taglink->getId();
	}
  }

  /** 
	* createCategoryToUser时需要为user和category创建链接 
	* 
	* @param $user_id
	* @param $category_id
	* 
	* @return 
   */
  public function makeUserLinkCategory($user_id, $category_id)
  {
	$categoryLinkUser = new Database_UserLinkCategory($this->_db);
	$categoryLinkUser->category_id = $category_id;
	$categoryLinkUser->user_id = $user_id();
	$categoryLinkUser->save();
	return $categoryLinkUser->getId();
  }

  public function removeTagLink($tag_id)
  {
	$taglink = new Database_NotesLinkTags($this->_db);
	$taglink->loadByTagIdAndNoteId($tag_id,$this->getId());
	$taglink->delete();
  }

  
  /** 
    *  createNote时需要addTag 
	* 为note增加一个tag
	* 增加时判断该用户是否已经拥有这个tag，没有则创建一个
	* 最终都是创建一个tag与note的link
	* 
	* @param $tag_name
	* 
	* @return 
   */
  public function addTag($tag_name)
  {
	//确定该note没有此tag
	if (!$this->tagIsExistInThisNote($tag_name)) {
	  if (!($tag_id = $this->tagNameToId($tag_name)) ) {
		$tag_id = $this->createTag($tag_name);
	  }
	  $this->makeTagLink($tag_id);
	  return $tag_id;
	}
  }

  /** 
	* createNote时需要为note指定一个category
	* 
	* @param $category_name
	* @param $user_id
	* 
	* @return 
   */
 public function addCategory($category_name,$user_id)
  {
	//检查note是否已经有了这个category
	if (!$this->categoryIsExistInThisNote($user_id, $category_name)) {
	  //检查category本身是否存在
	  if (!($category_id = $this->categoryNameToId($user_id, $category_name)) ) {
		$category_id = $this->createCategoryToUser($category_name,$user_id);
	  }
	  $this->makeCategoryLink($category_id);
	  return $category_id;
	}
  }

    /** 
	* 删除tag
	* 
	* @param $tag_name
	* 
	* @return 
   */
  public function delTag($tag_name)
  {
	//确认Tag存在于该note里，避免不必要的错误删除(例如删除掉其他用户的tag)
	if ($this->tagIsExistInThisNote($tag_name)) {
	  $tag_id = $this->tagNameToId($tag_name);
	  $this->removeTagLink($tag_id);
	  $tag_link_db = new Database_NotesLinkTags($this->_db);
	  //如果该tag还有其他连接，则只删除此条连接，而不删除tag本身
	  if (!$tag_link_db->tagHasLink($tag_id)) {
		$tag_db = new Database_NotesTags($this->_db);
		$tag_db->load($tag_id);
		$tag_db->delete();		
	  }
	}
  }

  /** 
	* 删除一个category By name
	* [unused]
	* 
	* @param $category_name
	* 
	* @return 
   */
  public function delCategory($category_name)
  {
	if ($category_id = $this->categoryNameToId($category_name)) 
	{
	  $this->removeCategoryLink($category_id);
	  $user_link_category = new Database_UserLinkCategory($this->_db);
	  //如果该category还有其他连接，则只删除此条连接，而不删除category本身
	  $category_db = new Database_NotesCategorys($this->_db);
	  $category_db->load($category_id);
	  return $category_db->delete();		
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
	$this->postLoad();
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

 public function categoryIsExistInThisNote($user_id, $category_name)
  {
	$this->postLoad();
	// 如果该用户拥有此名字的category，则检查此category是否已经赋予该note
	if ($category_id = $this->categoryNameToId($user_id,$category_name)) {
	  $this_note_categorys = $this->getJoinRow('category');
	  if (in_array($category_id,$this_note_categorys)) {
		return true;    
	  } else 	{
		return false;
	  }
	} else {
	  // 如果用户都不拥有这个category，则无需查询，直接可认定此note没有该category
	  return false;
	}
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
	  "SELECT tag_id FROM lds0019_notes_tags 
		  WHERE user_id = :user_id 
	      AND tag_name = :tag_name",
	  array('user_id' => $this->user_id,
		  'tag_name' => $tag_name)
	);

	  return $result;
	}
  }

 /** 
	* tag_id 转换成 tag_name
	* 
	* @param $tag_id
	* 
	* @return 
   */
  public function categoryIdToName($category_id)
  {
	$category_db = new Database_NotesCategorys($this->_db);
	if ($category_db->load($category_id)) {
	  return $category_db->category_name;
	} else {
	  return false;
	}
  }

  /** 
	* category name 转换成 category id
	* 只在该用户的名下查找category_name,
	* 也就是说如果该函数返回false，则可说明该用户没有此名字的category
	* 
	* @param $category_name
	* 
	* @return 
   */
 public function categoryNameToId($user_id, $category_name)
  {
	if ($user_id) {
	  $query =  "SELECT cate.category_id
		 FROM lds0019_notes_categorys AS cate
		 LEFT JOIN lds0019_users_link_categorys AS user_ln_cate 
		 ON cate.category_id=user_ln_cate.category_id " 
		 . $this->_db->quoteInto(
			'WHERE cate.category_name = ? ',
			$category_name)
		 . $this->_db->quoteInto(
			'AND user_ln_cate.user_id = ? ',
			$user_id)
	  ;//end query
	  $result = $this->_db->fetchOne($query);

	  //var_dump($result);
	  return (int) $result;
	}//fi
  }

  /** 
	* 读取属于一个用户(user_id)所拥有的一个category名下的所有note
	* 
	* @param $category_id
	* @param $user_id
	* 
	* @return 
   */
  public function getAllNoteByCategoryIdAndUserId($category_id,$user_id)
  {
	$query = 'CALL getAllNoteByCategoryIdAndUserId(?)';
    $query = $this->_db->quoteInto($query, array($category_id,$user_id));
	$result = $this->_db->fetchAll($query);

	//Zend_Debug::dump($result);
	return $this->sqlResultToNewArray($result);
  }



  /** 
    * 为getAllNoteByCategoryIdAndUserId提供数据输出处理,
	* 将sql请求中含有逗号分隔符的列转换为数组,
	* 例如: categorys_name字段中取出的是'cate1,cate2',
	* 此函数将起分割为数组 categorys_name = array('cate1','cate2'); 
	* 
	* @return 
   */
  public function sqlResultToNewArray($result)
  {

	$new_result = array();

	//复制其他内容
	foreach ($result as $item) {
	  //解析categorys字符结果为数组,以逗号为分隔符
	  if ($item['categorys_name'] != null) {
		$categorys = $item['categorys_name'];
		$new_categorys = split(',',$categorys);
		$item['categorys_name'] = $new_categorys;
	  }
	  //解析tags字符结果为数组,以逗号为分隔符
	  if ($result['tags_name'] != null) {
		$tags = $result['tags_name'];
		$new_tags = split(',',$tags);
		$item['tags_name'] = $new_tags;
	  }
      //转换数据类型
      if (isset($item['fronthand'])) 
          $item['fronthand'] = (int) $item['fronthand'];
      if (isset($item['backhand']))
          $item['backhand']  = (int) $item['backhand'];
      if (isset($item['note_id']))
          $item['note_id']   = (int) $item['note_id'];

	  $new_result[] = $item;
	}

	return $new_result;
  }

  /** 
    * 用于读取一个用户(user_id)所拥有的所有categorys信息
    * 包含category_name,category_id,以数组形式返回
	* 
    * 控制器有直接使用
	*
	* @param $user_id
	* 
	* @return Array
   */
  public function getMyCategorysByUserId($user_id)
  {
	$query = 'CALL getMyCategorysByUserId(?)';
    $query = $this->_db->quoteInto($query, $user_id);
	$result = $this->_db->fetchAll($query);
	return $result;
  }

  /** 
	* 检查一个用户是否拥有一个category
	*
	* 控制器中有使用
	* 
	* @param $user_id
	* @param $category_id
	* 
	* @return Boolean
   */
  public function checkThisUserHasThisCategory($user_id, $category_id)
  {
	$query = 'CALL getMyCategorysByUserId(?)';
    $query = $this->_db->quoteInto($query, $user_id);
	$result = $this->_db->fetchCol($query);
	
	return in_array((string)$category_id, $result);
  }

  /** 
	* 删除一个category名下的所有notes
	*
	* @todo 需单元测试
	* 
	* @param $category_id
	* 
	* @return 
   */
  public function delNotesByCategoryId($category_id)
  {
	$query = 'CALL delNotesByCategoryId(?)';
    $query = $this->_db->quoteInto($query, $category_id);
	$result = $this->_db->query($query);
	//var_dump($result);
  }


/*
  protected function preInsert(){}
  protected function postLoad(){}
  protected function postInsert(){}
  protected function postUpdate(){}
  protected function preDelete(){}
 */

}



