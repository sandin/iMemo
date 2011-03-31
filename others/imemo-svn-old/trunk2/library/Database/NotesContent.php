<?php
require_once('ldslibs/DatabaseObject.php'); 

class Database_NotesContent extends DatabaseObject
{

  public function __construct($db)
  {
	parent::__construct($db, 'lds0019_notes_content','content_id' );

	$this->add('note_id');
	$this->add('content',null);
	$this->add('ts_modified', time());
  }

  public function loadByNotesId($note_id)
  {
	 $note_id = trim($note_id);
	  if (strlen($note_id) == 0)
		  return false;

	  $query = sprintf('select %s from %s where note_id = ?',
					   join(', ', $this->getSelectFields()),
					   $this->_table);
	  $query = $this->_db->quoteInto($query, $note_id);
	  return $this->_load($query);
  }

/*
  protected function preInsert(){}
  protected function postLoad(){}
  protected function postInsert(){}
  protected function postUpdate(){}
  protected function preDelete(){}
 */

}
