<?php

require_once 'PHPUnit/Framework.php';
require_once 'User.php';

class UserTest extends PHPUnit_Framework_TestCase
{
  public function testBase()
  {
	$user = new DatabaseObject_User();
  }

}
