<?php
require_once 'Zend/Db.php';

class IndexControllerTest extends ControllerTestCase  
{

  public function testAddNote()
  {
	$db = Zend_Registry::get('db');
	$note = new Database_Notes($db);

	$post = array('user_id' => 1 ,'content' => 'liudingsan');
	//创建一个新note,以post数组为参数
	$new_note = $note->createNote($post);
	
	//断言刚添加的note内容
	$this->assertEquals( 'liudingsan', $new_note['content']);
	  
	$new_note_id = $new_note['note_id'];
	$note->load($new_note_id);
	//断言刚添加的note->user_id
	$this->assertEquals(1, $note->user_id);

	//保存，待用
	Zend_Registry::set('new_note_id', $new_note_id);
  }

  public function testAddTag()
  {
	$db = Zend_Registry::get('db');
	$new_note_id =  Zend_Registry::get('new_note_id');
	
	$note = new Database_Notes($db);
	$note->load($new_note_id);

//	$tag_id = $note->createTag('new tag');
	
	$tag_name = 'new new tag';
	Zend_Registry::set('tag_name',$tag_name);

	//创建一个新tag
	$new_tag_id = $note->addTag($tag_name);

	//为调用tagIsExistInThisNote ,需要 reload
	$note->load($new_note_id);
	//断言刚添加tag的name
	$this->assertTrue($note->tagIsExistInThisNote($tag_name));

	//检查tagNameToId和tagIdToname是否运转正确
	$this->assertEquals($new_tag_id,$note->tagNameToId($tag_name));
	$this->assertEquals($tag_name,$note->tagIdToname($new_tag_id));

	$this->dispatch("/");

	Zend_Registry::set('new_tag_id',$new_tag_id);
  }

  /** 
	* 测试 Database_NotesLinkTags 中的 loadByTagIdAndNoteId 方法
	*
	* 
	* @return 
   */
  public function testLoadByTagIdAndNoteId()
  {
	$db = Zend_Registry::get('db');
	$new_tag_id = Zend_Registry::get('new_tag_id');
	$new_note_id = Zend_Registry::get('new_note_id');

	$tag_link = new Database_NotesLinkTags($db);
	$tag_link->loadByTagIdAndNoteId($new_tag_id,$new_note_id);
	$this->assertEquals($new_tag_id,$tag_link->tag_id);
  }

  public function testNotesRemoveTagLink()
  {
	$db = Zend_Registry::get('db');
	$new_tag_id = Zend_Registry::get('new_tag_id');
	$new_note_id = Zend_Registry::get('new_note_id');

	$note = new Database_Notes($db);
	$note->load($new_note_id);
	$this->assertEquals(1,$note->user_id);

	$tag_link = new Database_NotesLinkTags($db);

	//检查 tagHasLink 是否运行正常
	$tag_has_link =  $tag_link->tagHasLink($new_tag_id);
	$tag_has_no_link =  $tag_link->tagHasLink(322342431321);
	$this->assertFalse($tag_has_no_link);
	$this->assertTrue($tag_has_link);

	// 去除 $new_tag_id 与 $new_note_id 之间的link
	$note->removeTagLink($new_tag_id);

	//确认刚才的删除完全
	$noThisLink = $tag_link->loadByTagIdAndNoteId($new_tag_id,$new_note_id);
	$this->assertFalse( $noThisLink );
  }

  /** 
	* 为下一个delTag测试，必须还原上一个单元测试中破坏的tag与note之间的link
	* 
	* @return 
   */
  public function testMakeTagLink()
  {
	$db = Zend_Registry::get('db');
	$new_tag_id = Zend_Registry::get('new_tag_id');
	$new_note_id = Zend_Registry::get('new_note_id');

	$note = new Database_Notes($db);
	$note->load($new_note_id);

	//创建新link
	$tag_link_id = $note->makeTagLink($new_tag_id);

	//确保刚才正确的创建的新link
	$tag_link_db = new Database_NotesLinkTags($db);
	$load_ready = $tag_link_db->load($tag_link_id);
	$this->assertTrue($load_ready);

	//检查 tagHasLink 运行正常
	$hasLink = $tag_link_db->tagHasLink($new_tag_id);
	$this->assertTrue($hasLink);
  }

  public function testDelTag()
  {
	$db = Zend_Registry::get('db');
	$new_tag_id = Zend_Registry::get('new_tag_id');
	$new_note_id = Zend_Registry::get('new_note_id');
	$tag_name = Zend_Registry::get('tag_name');
  	
	$note = new Database_Notes($db);
	$note->load($new_note_id);

	//删除由之前单元中创建个tag
	$note->delTag($tag_name);

	//reload,以确保刚才的删除正常
	$note->load($new_note_id);
	$my_tags = $note->getJoinRow('tag');
	$tag_is_gone = in_array($new_tag_id, $my_tags);
	$this->assertFalse($tag_is_gone);

  }

  /** 
	* 测试 categorys 
	* 
	* @return 
   */
  public function testCategorys()
  {
	$db = Zend_Registry::get('db');
	$new_note_id = Zend_Registry::get('new_note_id');

	$note = new Database_Notes($db);
	$note->load($new_note_id);

	$category_name = 'new category1';
	//新建一个category
	$note->addCategory($category_name);

	//重载用于确认add成功
	$note->load($new_note_id);
	$this->assertEquals($note->getId(),$new_note_id);

	/*
	//测试 createCategory
	$category_id =  $note->createCategory($category_name);
	$c_id = $note->categoryNameToId($category_name);
	$this->assertEquals($c_id,$category_id);
	*/

	//测试 makeCategoryLink
	//$category_link_id = $note->makeCategoryLink($category_id);

	$note->load($new_note_id);
	$new_category_is_added = $note->CategoryIsExistInThisNote($category_name);
	$this->assertTrue($new_category_is_added);

	//删除刚才新建的category	
	$note->delCategory($category_name);

	//重载用于确认del成功
	$note->load($new_note_id);
	$new_category_is_gone = $note->CategoryIsExistInThisNote($category_name);
	$this->assertFalse($new_category_is_gone);

	//cleanup
	$note->delNote($new_note_id);
  }

  /** 
	* 测试 delNote
	* 
	* @return 
   */
  public function testDelNote()
  {
	$db = Zend_Registry::get('db');
	$note = new Database_Notes($db);


	$post = array(
	  'user_id' => 1,
	  'content' => 'liudingsan',
	  'tags' => 'tag_when_addNote',
	  'categorys' => array('cate1','cate2')
	);
	//创建一个新note,以post数组为参数
	$new_note = $note->createNote($post);
	$new_note_id = $new_note['note_id'];

	$note->load($new_note_id);
	$tag = $note->tagIsExistInThisNote('tag_when_addNote');
	$this->assertTrue($tag);
	
	$this->assertTrue($note->categoryIsExistInThisNote('cate1'));
	$this->assertTrue($note->categoryIsExistInThisNote('cate2'));

	$note_all = $note->getOneNote();
//	var_dump($note_all);

	//新建一个tag，用于判断delNote是否能删除其归属的tag
	$tag_name = 'new_tag_12_18';
	$note->addTag($tag_name);

	//重载，检查addTag正常
	$note->load($new_note_id);
	$tag_is_added = $note->tagIsExistInThisNote($tag_name);
	$this->assertTrue($tag_is_added);

	//测试delNote
	$result = $note->delNote();
	$this->assertTrue($result);

	//重载，测试tag是否删除
	$note_is_gone = $note->load($new_note_id);
	$this->assertFalse($note_is_gone);
	//$tag_is_gone = $note->tagIsExistInThisNote($tag_name);
	//$this->assertFalse($tag_is_gone);

  }


}
