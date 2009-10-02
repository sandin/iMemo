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

  public function testNotesLinkTags()
  {
	$db = Zend_Registry::get('db');
	$tag_link = new Database_NotesLinkTags($db);
	$tag_link->loadByTagIdAndNoteId(28,1);
	$this->assertEquals(1,$tag_link->getId());
	$this->assertEquals(28,$tag_link->tag_id);
  }

  public function testNotesRemoveTagLink()
  {
	$db = Zend_Registry::get('db');
	$note = new Database_Notes($db);
	$note->load(1);
	$this->assertEquals(1,$note->user_id);
  }

  public function testDelNote()
  {
	$db = Zend_Registry::get('db');
  }

}
