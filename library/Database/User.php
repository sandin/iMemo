<?php
require_once('ldslibs/DatabaseObject.php'); 

class Database_User extends DatabaseObject
{
  protected $_profile = null;
  protected $_command = null;

  public function __construct($db)
  {
	parent::__construct($db, 'lds0019_users', 'user_id');

	$this->add('username');
	$this->add('password');
	$this->add('ts_created', time());
	$this->add('ts_last_login', null, self::TYPE_TIMESTAMP);

	//$this->_profile = new Profile_User($db);
  }
/*
  protected function preInsert(){}
  protected function postLoad(){}
  protected function postInsert(){}
  protected function postUpdate(){}
  protected function preDelete(){}
 */
  public function setCommand(Command_Abstract $command)
  {
	$this->_command = $command;
  }

  public function executeCommand()
  {
	return $this->_command->executeCommand();
  }

}
