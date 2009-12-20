<?php
require_once 'Zend/Db.php';

class DatabaseTest extends ControllerTestCase  
{
  protected $db;
  protected $note_db;
  protected $temp = array();

  public function setUp()
  {
	parent::setUp();

	$this->db = Zend_Registry::get('db');
	$this->note_db = new Database_Notes($this->db);
	$this->cate_db = new Database_NotesCategorys($this->db);
	$this->note_ln_cate_db = new Database_NotesLinkCategorys($this->db);
	$this->user_ln_cate_db = new Database_UserLinkCategory($this->db);

  }

  public function testAddNote()
  { 

	//新建一个note
	$post = array(
	  'content'=>'note 1 by ' . __FUNCTION__,
	  'categorys'=>'cate 1 by ' . __FUNCTION__,
	  'user_id'=>1);
	$new_note_data = $this->note_db->createNote($post);

	//确定新建的各元素成功	
	$this->assertEquals($new_note_data['content'],$post['content']);
	$this->assertEquals($new_note_data['categorys'],$post['categorys']);

	Zend_Registry::set('note_id',$new_note_data['note_id']);
	Zend_Registry::set('cate_name',$new_note_data['categorys']);
  }

  public function testDelNote()
  {
	//删除刚才新建的note
	$note_id = Zend_Registry::get('note_id');
	//确认删除成功
	$this->note_db->load($note_id);
	$this->assertTrue($this->note_db->delNote());
  }

  public function testDelCategorys()
  {
	//删除刚才新建note后,又删除note后,以后下来的category
	//因为删除note时,并不删除category,确保有空category的存在
	$cate_name = Zend_Registry::get('cate_name');
	$cate_id = $this->note_db->categoryNameToId(1,$cate_name);

	$this->delCateHelper($cate_id);

  }

  public function delCateHelper($cate_id)
  { 
	//删除category分两步
	//
	//第一步,破坏user和category之间的连接
	$this->assertTrue(
	  $this->user_ln_cate_db->removeUserCategoryLink($cate_id)
	);
	//第二步,删除category本身
	$this->assertTrue(
	  $this->cate_db->delCategoryById($cate_id)
	); 

  }

  public function testCreateCategory()
  {
	//新建一个空category给用户1
	$cate2_name = 'cate2 by' . __FUNCTION__;
	$cate2_id = $this->note_db->createCategoryToUser($cate2_name, 1);

	//确认新建成功
	$hasThisCate = $this->note_db->checkThisUserHasThisCategory(1,$cate2_id);
	$this->assertTrue($hasThisCate);

	$this->delCateHelper($cate2_id);


	//重复确认,确实这个用户已经没有这个category了
	$hasNotThisCate = $this->note_db->checkThisUserHasThisCategory(1,$cate2_id);
	$this->assertFalse($hasNotThisCate);

	//TODO:这里并没有确认数据库中的category字典表中已经没有了这个category

  }

  public function testChangeCategory()
  {
	//新建一个note
	$this->testAddNote();

	$note_id = Zend_Registry::get('note_id');
	$cate_name = Zend_Registry::get('cate_name');
	$cate_id = $this->note_db->categoryNameToId(1,$cate_name);

	//用作form_category,新建一个空category给用户1
	$cate3_name = 'cate3 by ' . __FUNCTION__;
	$to_cate_id = $this->note_db->createCategoryToUser($cate3_name, 1);

	var_dump($cate_id);
	var_dump($to_cate_id);

	//将note的category从一个变为另一个
	$result = $this->note_ln_cate_db->changeCategoryFormTo($note_id,$cate_id,$to_cate_id);
	$this->assertTrue($result);

	//检查change是否成功
	$this->note_ln_cate_db->loadByNoteId($note_id);
    $this->assertEquals(
  	  $this->note_ln_cate_db->category_id,$to_cate_id);
	$this->assertFalse(
	  ($this->note_ln_cate_db->category_id == $cate_id)
	);

	//清理
	$this->testDelNote();
	$this->delCateHelper($to_cate_id);
	$this->delCateHelper($cate_id);
  }

}
