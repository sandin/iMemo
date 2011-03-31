<?php

class IndexController extends Zend_Controller_Action {

	public function init() {
		/* Initialize action controller here */
		$this->_db      = Zend_Registry::get('db');
		$this->_user    = Zend_Registry::get('user');
		$this->_db_user = new Database_User($this->_db);
	}

	public function preDispatch() {

	}

	public function indexAction() {
		if (isset($this->user)) {
			$user_id = $this->_user->user_id;
			$this->_db_user->load($user_id);
			// create a new notes
			$notes = new Database_Notes($this->_db);


			$categorys = $notes->getMyCategorysByUserId($user_id);

			$this->view->categorys = $categorys;
			var_dump($categorys);
		}
	}

	public function postDispatch() {
		//echo '<br />end of file<br />';
	}

	public function __call($method, $args) {
		if ('Action' == substr($method, -6)) {
			// If the action method was not found, forward to the
			// index action
			return $this->_forward('index');
		}

		// all other methods throw an exception
		throw new Exception('Invalid method "'
			. $method
			. '" called',
			500);
	}

}

