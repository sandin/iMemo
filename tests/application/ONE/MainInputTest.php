<?php
require_once 'PHPUnit/Framework.php';
 
class MainInputTest extends ControllerTestCase  
{
    protected $_str; 
    protected $_db;
    protected $_input;

    public function setUp()
    {
        parent::setUp();

        $this->_db   = Zend_Registry::get('db');
        $this->_str  = 'notes @content 12:01 dfsa 1:00 df 10:01 badtime12:01 num1234';
        $this->_input = new Lds_Helper_MainInput($this->_str);
    }

    public function testGetTime()
    {
        //sort name
        $input = $this->_input;
        $str   = $this->_str;

        //getString
        $this->assertEquals(
            $input->getString(),$str);

        //getPatterns
        $this->assertTrue(
            is_array($input->getPatterns()));

        $result = $input->parse();
        //var_dump($result);

        $time  = $input->getMatchs('time');
        $time0 = $time[0];

        $this->assertEquals(
            $time0 , '12:01');
        
        $date = $input->makeDate();
        var_dump($date);
        var_dump($input->getString());
    }

    public function testDate()
    {
        //$date = new Zend_Date('12:01',Zend_Date::TIME_SHORT);
        $date = new Zend_Date();

        $time  = '12:01';

        $date->set($time,Zend_Date::TIME_SHORT);

    }

    public function testA()
    {
    }
}
