<?php

// language
$t = Zend_Registry::get('translate');
define('NOT_NULL',$t->_('It\'s required'));

/** 
 * Lds_Models_FormCheck
 *
 * Abstract class 
 * 检查表单的抽象类，对$_post数组依次进行检查，继承者只需加入someCheck
 * 形式的方法即可，例如$_post['username'],则加入usernameCheck方法，
 * 在方法中调用addMessage方法添加消息（错误提示）到消息盒中
 * 则之后调用getMessage可返回信息内容
 * 检验是否成功，可调用isSucceed方法查询
 * 
 */
abstract class Lds_Models_FormCheck 
{

  /** 
   * 需要处理的数据
   * @var array $_data
	* 
	* @return 
   */
  protected $_data = array();
  /** 
   * 消息数组 message array
   * @var array $_message
	* 
	* 
   */
  protected $_message = array();


  /** 
	* 必需项（not null）
	* @var array $_required
   */
  protected $_required = array();

  /** 
	* 检查是否全部成功
	* @var boolean $_succeed
   */
  protected $_succeed;

  /** 
	* Constructor 
	* 
	* @param array $post
	* 
	* @return void
   */
  public function __construct($post = null)
  {
	$this->_data = $post;
  }

  public function check()
  {
	if (is_array($this->_data)) {
	  $this->preCheck();
	  foreach ($this->_data as $name => $value)
	  {
		if (isset($value) && strlen($value) > 0) {
		  $name = strtolower($name);
		  $value = $this->trimValue($value);
		  $this->checkAll($name,$value);
		  if (method_exists($this, $name . 'Check')) {
			eval('$this->' . $name . 'Check("' . $name . '","' . $value . '");'); 
		  }
		} else {
		  if (in_array($name,$this->_required)) {
			$this->addMessage($name,NOT_NULL);			
		  }
		}
	  }
	}
	if ($this->isSucceed()) {
	  $this->postCheck();
	}
	return $this->_succeed;
  }

  /** 
	* 检查之前整理数据
	* 
	* @param $value
	* 
	* @return 
   */
  public function trimValue($value)
  {
	return trim($value);
  }

  /** 
	* 对数据检查之前 
	* 
	* @return 
   */
  public function preCheck()
  {
  }

  /** 
	* 对数据检查之后,若全部成功需要处理的内容
	* 
	* @return 
   */
  public function postCheck()
  {
  }

  /** 
	* 检查每个数据
	* 
	* @param $name
	* @param $value
	* 
	* @return 
   */
  public function checkAll($name, $value)
  {
  }

  /** 
	* 添加信息（错误提示）
	* 
	* @param $name
	* @param $message
	* 
	* @return 
   */
  public function addMessage($name, $message)
  {
	$this->_message[$name] = $message;
	return $this;
  }

  /** 
	* 获取指定信息（错误提示）,无参数时以数组形式返回所有信息
	* 
	* @param $name
	* 
	* @return string or array
   */
  public function getMessage($name = null)
  {
	if ($name == null) {
	  return $this->_message;
	} else {
	  return $this->_message[$name];
	}
  }

  /** 
	* 设置必须项
	* 
	* @param string/array $name
	* 
	* @return 
   */
  public function setRequired($name)
  {
	if (is_array($name)) {
	  foreach ($name as $item => $value)
	  {
		$this->_required[] = $item;
	  }
	} else {
	  $this->_required[] = $name;
	}
	return $this;
  }

  /** 
	* 所有检查是否成功
	* 
	* @return boolean false/true
   */
  public function isSucceed()
  {
	$this->_succeed = (count($this->_message) > 0) ? false : true; 
	return $this->_succeed;
  }

  public function __get($name)
  {
	return $this->_data[$name];
  }

}
