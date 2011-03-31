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
	$this->add('safecode');
	$this->add('ts_created', time());
	$this->add('ts_last_login', null, self::TYPE_TIMESTAMP);

	//$this->_profile = new Profile_User($db);
  }

  public function usernameIsExist($username)
  {
	$query = sprintf('SELECT %s FROM %s
					  where %s = ?',
					  $this->_idField,					  
					  $this->_table,  //lds0019_notes
					  'username'
					  );

    $query = $this->_db->quoteInto($query, $username);
	//var_dump($query);
	$result = $this->_db->fetchOne($query);

	return ($result == false) ? false : true;
  }

  public function createUser($username,$password)
  {
      $safeCode = self::makeToken($username);
      $this->username = $username;
      $this->password = self::makePassword($password,$safeCode);
      $this->safecode = $safeCode;
      $this->save();
      return $this->getId();
  }

  /** 
   * 密码加密算法
   * 谨慎：修改后旧用户将无法登录
   * 
   * @param $password
   * @param $keyword
   * 
   * @return 
   */
  public static function makePassword($password,$keyword)
  { 
      return md5($password . $keyword . 'LDS');
  }

  /** 
   * 根据用户名，寻找用户的安全码，然后根据安全码和提供的密码生成加密后的密码
   * 用于验证身份
   * 
   * @return 
   */
  public function getSafePassword($password,$username)
  {
      $safeCode = $this->getSafeCodeByUserName($username);
      return self::makePassword($password,$safeCode);
  }

  /** 
   * 根据提供的用户名，取回安全码
   * 
   * @param $username
   * 
   * @return 
   */
  public function getSafeCodeByUserName($username)
  {
      $query = sprintf('SELECT %s FROM %s
          where %s = ?',
					  'safecode',					  
					  $this->_table,  //lds0019_notes
					  'username'
					  );

    $query = $this->_db->quoteInto($query, $username);
	//var_dump($query);
	$result = $this->_db->fetchOne($query);

	return $result;
  }

  /** 
   * token制作
   * 
   * @param $keyword
   * 
   * @return 
   */
  public static function makeToken($keyword)
  {
      return md5(md5($keyword) . md5(microtime()) . md5(rand(0,99)) . 'LDS'); 
  }


  //command模式的执行者，所有command依赖
  public function setCommand(Command_Abstract $command)
  {
	$this->_command = $command;
  }

  public function getCommand()
  {
	return $this->_command;
  }

  public function executeCommand()
  {
	return $this->_command->executeCommand();
  }

  public function unExecuteCommand()
  {
	return $this->_command->unExecuteCommand();
  }
/*
  protected function preInsert(){}
  protected function postLoad(){}
  protected function postInsert(){}
  protected function postUpdate(){}
  protected function preDelete(){}
 */
}
