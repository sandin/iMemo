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
      $user_id = $this->getId();

      //为新用户分配其他数据，如附赠系统分类
	  //$query = 'CALL register(?)';
      //$query = $this->_db->quoteInto($query,$user_id);
      //$this->_db->query($query);

      //附赠系统分类
      //TODO : 应该order表中读取分类时依赖于category_id
      //所以目前category表无法作为字典表，用户不能复用相同id的category
      //今后可以改进，避免每注册一个用户就无谓的为category表添加相同的系统分类
      $userDB = new Database_Notes($this->_db);
      $system_categories = array(
          'Inbox',
          'Today',
          'Next',
          'Maybe',
          'Projects',
          'Areas');
     foreach ($system_categories as $category_name) {
          $userDB->addCategory($category_name,$user_id);
      }

      return $user_id;
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
