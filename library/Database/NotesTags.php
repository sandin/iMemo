<?php
require_once('ldslibs/DatabaseObject.php'); 

class Database_NotesTags extends DatabaseObject
{

  public function __construct($db)
  {
	parent::__construct($db, 'lds0019_notes_tags','tag_id' );

	$this->add('tag_name');
	$this->add('user_id');
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
