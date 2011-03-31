<?php
/**
 * Zend_Controller_Plugin_Abstract
 */
require_once 'Zend/Controller/Plugin/Abstract.php';

class Lds_Controller_Plugin_Permission extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $module_name = $request->getModuleName();  
		$isAllowed = $this->getInvokeArg('Zend_Acl')->isAllowed('editor', $module_name, 'index');
		Zend_Debug::dump($isAllowed);

    }
}
