<?php
require_once('ldslibs/DatabaseObject.php'); 

class Database_UserLinkCategory extends DatabaseObject
{

  public function __construct($db)
  {
	parent::__construct($db, 'lds0019_users_link_categorys','link_id' );

	$this->add('user_id');
	$this->add('category_id');
  }



 



/*
  protected function preInsert(){}
  protected function postLoad(){}
  protected function postInsert(){}
  protected function postUpdate(){}
  protected function preDelete(){}
 */

}
