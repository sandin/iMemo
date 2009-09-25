<?php
/**
 * Zend_Controller_Plugin_Abstract
 */
require_once 'Zend/Controller/Plugin/Abstract.php';

class Lds_Controller_Plugin_Smarty extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $module_name = $request->getModuleName();  
		$module_path = APPLICATION_PATH . '/modules/' . $module_name;
        $view = Zend_Registry::get('view');
		$smarty = $view->getEngine();
		$smarty->compile_dir = $module_path . '/templates_c';
		$smarty->assign('module',$module_name);

    }
}
