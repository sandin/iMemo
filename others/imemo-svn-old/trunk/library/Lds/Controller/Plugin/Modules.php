<?php
/**
 * Zend_Controller_Plugin_Abstract
 */
require_once 'Zend/Controller/Plugin/Abstract.php';

class Lds_Controller_Plugin_Modules extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $module_name = $request->getModuleName();  
		$module_path = APPLICATION_PATH . '/modules/' . $module_name;
		//Zend_Debug::dump($module_name,'1');
		//Zend_Debug::dump($module_path,'2');
		$autoloader = new Zend_Application_Module_Autoloader(array(
            'namespace' => ucfirst($module_name),
			'basePath'  => $module_path,
        ));


    }
}
