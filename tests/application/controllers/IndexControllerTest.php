<?php
require_once 'Zend/Db.php';

class IndexControllerTest extends ControllerTestCase  
{

  public function testAddTag()
  {

	$db = Zend_Registry::get('db');
	
	$note = new Database_Notes($db);
	$note->load(1);

	$post = array('user_id' => 1 ,'content' => 'liudingsan');
	//$note->createNote($post);
	//$note->createTag('tag0');
	$tag_name = '1609';
	$note->addTag($tag_name);
	$note->load(1);
	$this->assertTrue($note->tagIsExistInThisNote('1609'));

	$this->assertSame('1',$note->tagNameToId('tag1'));
	$this->assertSame('tag0',$note->tagIdToname('9'));

	$this->dispatch("/");
  }

  public function testDelNote()
  {
	$db = Zend_Registry::get('db');
  }

}
