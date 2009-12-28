<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	protected function _initDatebase()
	{
	  $resources = $this->getPluginResource('db');
	  $db = $resources->getDbAdapter();
	  Zend_Registry::set('db',$db);
	  $options = $this->getOption('resources');	
	  $db_prefix = $options['db']['prefix'];
	  Zend_Registry::set('db_prefix',$db_prefix);
	}

	protected function _initLog()
	{
	  $logger = new Zend_Log();
	  $writer = new Zend_Log_Writer_Stream( APPLICATION_PATH . '/data/logs/log.txt' );
	  //$writer_firebug = new Zend_Log_Writer_Firebug();
	  //$writer = new Zend_Log_Writer_Firebug();

	  $logger->addWriter($writer);
	  //$logger->addWriter($writer_firebug);
	  //Zend_Debug::dump($logger);
      Zend_Registry::set('logger',$logger);
	}

/*
    protected function _initSession()
	{
	  $db = Zend_Registry::get('db');
	  Zend_Db_Table_Abstract::setDefaultAdapter($db);
	  //配置SessionDB字段  

	  $config = array(
		'name'           => 'lds0019_sessions',
		'primary'        => 'id',
		'modifiedColumn' => 'modified',
		'dataColumn'     => 'data',
		'lifetimeColumn' => 'lifetime'
	  );
	  // must before setSaveHandler,don't kown why.
	  Zend_Session::setOptions(array('gc_maxlifetime' => '2592000' ));
	  //new Zend_Session_SaveHandler_DbTable  
	  Zend_Session::setSaveHandler(new Zend_Session_SaveHandler_DbTable($config));
	  if(!isset($_SESSION)){
		Zend_Session::start();
	  }
	  var_dump(Zend_Session::getOptions());
	}
*/
	
    protected function _initAcl()
	{
	}

	protected function _initTranslate()
	{
	  
	  $translate = new Zend_Translate('gettext', APPLICATION_PATH . '/data/languages/zh.mo', 'zh');
	  $translate->addTranslation(APPLICATION_PATH . '/data/languages/en.mo', 'en');
	  //$translate->setLocale('zh');
	  $translate->setLocale('en');

	  Zend_Registry::set('translate', $translate );
	}

    protected function _initView()
    {
	  $auth = Zend_Auth::getInstance(); 
	  $storage = new Zend_Auth_Storage_Session();
	  $auth->setStorage($storage);
	  $user = $auth->getIdentity();
	  Zend_Registry::set('user',$user);
	  $options = $this->getOptions();
      $viewOptions = $options['resources']['view'];
       // Initialize view
	  Zend_Loader_Autoloader::getInstance()->setFallbackAutoloader(true); 

	  $view = new Lds_View_Smarty();
	  $smarty = $view->getEngine();
	  //$view->setScriptPath(APPLICATION_PATH . '/templates');
	  $smarty->compile_dir = APPLICATION_PATH . '/templates_c';
	  $smarty->plugins_dir[] = BOOT_PATH . '/library/smarty/plugins'; 
	  //$smarty->register_prefilter("smarty_prefilter_pre01");
	  $smarty->load_filter('pre','smarty_prefilter_gettext');
	  $smarty->left_delimiter = '<{';
	  $smarty->right_delimiter = '}>';
	  //var_dump($smarty->plugins_dir);
	  $smarty->force_compile = true;
	  $smarty->clear_all_cache();
	  $smarty->clear_compiled_tpl();
	  $smarty->debugging = true;
	  $smarty->assign('PUBLIC_URL',PUBLIC_URL);
	  $smarty->assign('APPLICATION_PATH',APPLICATION_PATH);
	  $smarty->assign('user',$user);
		$translate = Zend_Registry::get('translate');
	  $smarty->assign('t',$translate);
	  //$view->getEngine()->clear_compiled_tpl();
	  //$view->render('index.tpl');
	  //Zend_Debug::dump($view);

	  Zend_Registry::set('view',$view);
       // $view = new Zend_View($viewOptions);
       // $view->doctype('XHTML1_STRICT');
       // $view->headTitle('My First Zend Framework Application');

        // Add it to the ViewRenderer
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->setView($view)
					 ->setViewSuffix('tpl')
					 ->setViewBasePathSpec(':moduleDir/views/scripts');
					 //->setviewBasePathSpec(APPLICATION_PATH . '/templates');
		//Zend_Debug::dump($viewRenderer);

        // Return it, so that it can be stored by the bootstrap
        //return $view;
        return $view;
	}



	protected function _initControllers()
    {
	   $acl = new Zend_Acl();
	  $roleGuest = new Zend_Acl_Role('guest');
	  $acl->addRole($roleGuest);
	  $acl->addRole(new Zend_Acl_Role('editor'), 'guest');
	  $acl->addRole(new Zend_Acl_Role('administrator'));
  
	  $acl->add(new Zend_Acl_Resource('blog'));

	  $acl->allow('editor', 'blog', array('index', 'archive', 'delete'));
	  //Zend_Debug::dump($acl->isAllowed('editor', 'blog', 'index'));
	  //Zend_Debug::dump($acl);

		// FrontController 
        $this->bootstrap('FrontController');

        //$this->frontController->setControllerDirectory(APPLICATION_PATH . '/controllers', 'default');

		$front = $this->frontController;
		$front//->addModuleDirectory(APPLICATION_PATH . '/modules')
			  ->setParam('Zend_Acl', $acl)
			  ->throwExceptions(true)
			  ->registerPlugin(new Lds_Controller_Plugin_Smarty())
			  ->registerPlugin(new Lds_Controller_Plugin_Modules())
		//	  ->registerPlugin(new Lds_Controller_Plugin_Filter())
		;
		
		$router = $front->getRouter(); 

		//login
		$router->addRoute(
		  'login',
		  new Zend_Controller_Router_Route(
			'login/*',
			  array(
				'module' => 'settings',
				'controller' => 'index',
				'action' => 'login',
			  )
		  )
		);

			//login
		$router->addRoute(
		  'logout',
		  new Zend_Controller_Router_Route(
			'logout/*',
			  array(
				'module' => 'settings',
				'controller' => 'index',
				'action' => 'logout',
			  )
		  )
		);

		//register
		$router->addRoute(
		  'register',
		  new Zend_Controller_Router_Route(
			'register/*',
			  array(
				'module' => 'settings',
				'controller' => 'index',
				'action' => 'register',
			  )
		  )
		);

		//各种操作note的command,都有此控制器此动作分配,命令单入口
		$router->addRoute(
		  'note',
		  new Zend_Controller_Router_Route(
			'note/:command',
			  array(
				'module' => 'default',
				'controller' => 'note',
				'action' => 'index',
			  )
		  )
		);

		//按category读取所拥有的note
		$router->addRoute(
		  'category',
		  new Zend_Controller_Router_Route(
			'category/:category_id',
			  array(
				'module' => 'default',
				'controller' => 'category',
				'action' => 'index',
			  )
		  )
		);

	
/*
        $this->frontController->throwExceptions(true);  
		$this->frontController->setControllerDirectory(array(
		  'default' => APPLICATION_PATH . '/controllers',
		  'blog'    => APPLICATION_PATH . '/modules/blog/controllers'
		));
 */
        //Zend_Registry::set('baseUrl',$this->frontController->getBaseUrl());

        //Zend_Session::start();

        /*$router = $this -> _front -> getRouter();

        $config = new Zend_Config_Ini($this->_root . '/application/config/route.ini','route');

        $router -> addConfig($config, 'routes');*/
		
		//$options = $this->getOption('resources');	
	}
	



	protected function _initAutoload()
    {
        $autoloader = new Zend_Application_Module_Autoloader(array(
            'namespace' => 'Default',
			'basePath'  => APPLICATION_PATH ,
        ));
        return $autoloader;
	}


}
