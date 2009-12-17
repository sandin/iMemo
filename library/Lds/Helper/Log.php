<?php

class Lds_Helper_Log
{

  public function __construct()
  {
  
  }

  public function writeLog($content, $lv = null)
  {
	//EMERG   = 0;  // Emergency: 系统不可用
	//ALERT   = 1;  // Alert: 报警
	//CRIT    = 2;  // Critical: 紧要
	//ERR     = 3;  // Error: 错误
	//WARN    = 4;  // Warning: 警告
	//NOTICE  = 5;  // Notice: 通知
	//INFO    = 6;  // Informational: 一般信息
	//DEBUG   = 7;  // Debug: 小时消息

	$logger = Zend_Registry::get('logger');
	$user = Zend_Registry::get('user');

	if ($content instanceof Exception) {
	  $msg = $content->getMessage() . ' user_id: ' . $user->user_id;
	} 
	elseif ($content instanceof String)
	{
	  $msg = $content . ' user_id: ' . $user->user_id;
	} else {
	  $msg = 'something wrong';
	}


	$lv = (isset($lv)) ? $lv : Zend_Log::INFO;

	$logger->log($msg,$lv);
  }

}
