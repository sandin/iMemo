<?php

require_once 'Zend/Session.php';

//Zend_Session::start();
// Define path to application directory
defined('APPLICATION_PATH')
	|| define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
	|| define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

//root
defined('BOOT_PATH')
	|| define('BOOT_PATH', realpath(dirname(__FILE__) . '/../'));

//root/public
//为测试需要，临时允许app存在于任意子目录
//defined('PUBLIC_URL')
//	|| define('PUBLIC_URL', 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']));
defined('PUBLIC_URL')
	|| define('PUBLIC_URL', '/');

//var_dump($_SERVER['PHP_SELF']);
//var_dump(dirname($_SERVER['PHP_SELF']));
//var_dump(PUBLIC_URL);
// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
	    realpath(APPLICATION_PATH . '/../library'),
	    get_include_path(),
	)));

/** Zend_Application */
require_once 'Zend/Application.php';
// Create application, bootstrap, and run
$application = new Zend_Application(
		APPLICATION_ENV,
		//APPLICATION_PATH . '/configs/application.ini'
		APPLICATION_PATH . '/configs/application.xml'
);

$application->bootstrap();
//->run();
//
// 检查应用程序是否安装
if (Zend_Registry::isRegistered('isSetUp')) {
	$isSetUp = Zend_Registry::get('isSetUp');
} else {
	$config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/setup.ini', 'website');
	$isSetUp = (boolean) $config->isSetUp;
	Zend_Registry::set('isSetUp', $isSetUp);
}


// 没有安装并且没有正在安装，则进入安装程序
if ( !isset($_GET['setting']) && TRUE !== $isSetUp ) {
	header('location: /admin/setup?setting=1');
}


//如果不是开发环境，则隐藏部分严重的错误信息
if ('production' === APPLICATION_ENV) {
	try {
		$application->run();
	} catch (Zend_Db_Adapter_Exception $e) {
		$_SESSION['setUp'] = false;

		//细分错误类别
		$msg = strtolower($e->getMessage());
		if (strstr($msg, 'access')) {
			//用户名或密码错误
			$_GET['case'] = 'userPassWrong';
			require('./setup.php');
		} elseif (strstr($msg, 'unknown database')) {
			//数据库不存在
			$_GET['case'] = 'databaseNotExist';
			require('./setup.php');
		} else {
			
		}
		//Zend_Registry::set('app',$application);
	} catch (Zend_Db_Statement_Exception $e) {
		//数据库DML中出现严重错误，直接带用户离开
		Imemo_Center::im_die('数据库-SQL错误');
	}
} else {
	//开发环境，直接运行，有异常则直接显示出来
	//(是否显示还依赖前端控制器是否允许显示异常)
	$application->run();
}



/*
  echo $front->getModuleDirectory();
  $URL = $front->getBaseUrl();
  $ctlname = $front->getRequest()->getControllerName();
  echo $URL;

  $request = new Zend_Controller_Request_Http();
  $get	= $request->getQuery('new');
  $get2 = $request->getActionName();
  echo $get . ' ' . $get2 . ' ' . $ctlname . "<br />";
  echo "new line";

  $router     = new Zend_Controller_Router_Rewrite();
  print_r($router);
  $front->dispatch();
 */