<?php

class ErrorController extends Zend_Controller_Action
{

    public function errorAction()
    {
        $errors = $this->_getParam('error_handler');
        $front  = Zend_Controller_Front::getInstance();
        
        switch ($errors->type) { 
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
        
                // 404 error -- controller or action not found
                // TODO 太多页面尚未完成，故不发送404,今后需打开
                //$this->getResponse()->setHttpResponseCode(404);
                $this->view->message = 'Page not found';
                $this->_forward('nopage');
                break;
            default:
                // application error 
                $this->getResponse()->setHttpResponseCode(500);
                $this->view->message = 'Application error';
                break;
        }
        
        $this->view->exception = $errors->exception;
        $this->view->request   = $errors->request;
    }

    public function nopageAction()
    {
	  $http = new Zend_Controller_Request_Http();
	  if ($http->isXmlHttpRequest()) {
	    $this->view->noLayout = true;
	  }
    }

}

