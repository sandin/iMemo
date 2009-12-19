<?php
require_once 'Zend/Db.php';

class DBTest extends ControllerTestCase  
{
  protected $db;
  protected $note_db;
  protected $temp = array();

  public function setUp()
  {
	parent::setUp();

	$this->db = Zend_Registry::get('db');
	$this->note_db = new Database_Notes($this->db);

  }

  public function testAddNote()
  { 

	$post = array('content'=>'note 1','categorys'=>'cate1','user_id'=>1);
	$new_note_data = $this->note_db->createNote($post);
	  
	$this->assertEquals($new_note_data['content'],$post['content']);
	$this->assertEquals($new_note_data['categorys'],$post['categorys']);

	Zend_Registry::set('note_id',$new_note_data['note_id']);
	Zend_Registry::set('cate_name',$new_note_data['categorys']);
  }

  public function testDelNote()
  {
	$note_id = Zend_Registry::get('note_id');

	$this->note_db->load($note_id);
	$this->assertTrue($this->note_db->delNote());
  }

  public function testDelCategorys()
  {
	$cate_name = Zend_Registry::get('cate_name');
	$cate_id = $this->note_db->categoryNameToId(1,$cate_name);

	$cate_db = new Database_NotesCategorys($this->db);
	$result = $cate_db->delCategoryById($cate_id);

	$this->assertTrue($result);
  }

}
