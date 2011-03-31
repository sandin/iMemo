<?php

/*
 * NetBeansProjects
 *
 * @encoding   UTF-8
 * @author     lds <lds2012@gmail.com>
 * @copyright  Copyright (c) 2010 , lds
 * @license    default
 *
 */

/**
 * Description of SetUp
 *
 * @author lds
 */
class Lds_Models_SetUp {

	private $_app;

	//put your code here
	public function __construct($app) {
		$this->_app = $app;
	}

	public static function setUpTheApp($app) {
		
	}

	private function createDatabaseTables() {
		require './sql2string.php';
	}

}
?>
