<?php

class Admin_SetupController extends Zend_Controller_Action {

	public function init() {
		/* Initialize action controller here */
		//$this->_forward('index','index');
	}

	public function indexAction()
	{
		//没有指定step,则默认从1开始
		$_GET['step'] = (isset($_GET['step'])) ? $_GET['step'] : 1;
	}


}

