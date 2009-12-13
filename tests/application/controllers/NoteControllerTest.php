<?php
require_once 'Zend/Db.php';

class IndexControllerTest extends ControllerTestCase  
{
  public function testTrueAddNote()
  {

  }

 public function testTrueDelNote()
 {
	$db = Zend_Registry::get('db');
	$note = new Database_Notes($db);
 }
  
}
