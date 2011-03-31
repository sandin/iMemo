<?php
/**
 * Zend_Controller_Plugin_Abstract
 */
require_once 'Zend/Controller/Plugin/Abstract.php';

class Lds_Controller_Plugin_Filter extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
	  if (count($_POST)) {
		Lds_Helper_Filter::filter($_POST);
	  }
    }
}
