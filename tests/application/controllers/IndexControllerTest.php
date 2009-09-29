<?php

class IndexControllerTest extends ControllerTestCase  
{
/*   
	public function testIndexWithMessageAction()
	{
        $this->getRequest()
        	 ->setParams(array("m" => "test message"))
        	 ->setMethod('GET');
        $this->dispatch('/');
        $this->assertAction("index");
		$this->assertController("index");
		$this->assertXpathContentContains("id('message')", "test message");
		
	}
	public function testIndexNoMessageAction()
	{
        $this->dispatch('/');
        $this->assertAction("index");
		$this->assertController("index");
        $this->assertResponseCode(200);
		$this->assertXpathContentContains("id('message')", "no message");	
	}
	public function testAboutAction()
	{
        $this->dispatch("/index/about");
        $this->assertController("index");
        $this->assertAction("about");	
		$this->assertResponseCode(200);
	}
 */
  public function testDelNote()
  {
	$this->dispatch("/");
        //$this->assertController("index");
        //$this->assertAction("index");
    $this->assertTrue(true);
	$this->db = Zend_Registry::get('db');
	$this->user = Zend_Registry::get('user');
	$this->assertNotNull($this->user);
	$this->db_user = new Database_User($this->db);
	$this->db_user->load($this->user->user_id);
	
	$note = new Database_Notes($this->_db);
	$this->assertType('class',$note);

  }
}
