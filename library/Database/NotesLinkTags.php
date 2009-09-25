<?php
require_once('ldslibs/DatabaseObject.php'); 

class Database_NotesLinkTags extends DatabaseObject
{

  public function __construct($db)
  {
	parent::__construct($db, 'lds0019_notes_link_tags','tag_id' );

	$this->add('note_id');
  }

 



/*
  protected function preInsert(){}
  protected function postLoad(){}
  protected function postInsert(){}
  protected function postUpdate(){}
  protected function preDelete(){}
 */

}
