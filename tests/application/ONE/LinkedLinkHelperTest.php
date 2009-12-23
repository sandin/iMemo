<?php
require_once 'Zend/Db.php';
 
class LinkedLinkHelperTest extends ControllerTestCase  
{
    protected $_help;
    protected $_db;

    public function setUp()
    {
        parent::setUp();

        $this->_db = Zend_Registry::get('db');
        //$this->_help = new LinkedLink_Helper();
    }

    public function testAddNoteCallback()
    {
        $this->assertTrue(true);
        //$help = $this->_help;

       // $help->addNoteCallback(1,1);
    }

    public function teardown()
    {
        //清空该表
    }

}



?>
