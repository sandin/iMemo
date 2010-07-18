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
defined('PUBLIC_URL')
	|| define('PUBLIC_URL', 'http://' . $_SERVER['HTTP_HOST'] .dirname($_SERVER['PHP_SELF']) );

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

$application->bootstrap()
	->run();




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