<?php
require_once('ldslibs/DatabaseObject.php'); 

class Database_NotesCategorys extends DatabaseObject
{

  public function __construct($db)
  {
	parent::__construct($db, 'lds0019_notes_categorys','category_id' );

	$this->add('category_name');
	$this->add('ts_created', time());
  }



/*
  protected function preInsert(){}
  protected function postLoad(){}
  protected function postInsert(){}
  protected function postUpdate(){}
  protected function preDelete(){}
 */

}
