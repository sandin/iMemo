<?php
require_once('ldslibs/DatabaseObject.php'); 

class Database_NotesLinkTags extends DatabaseObject
{

  public function __construct($db)
  {
	parent::__construct($db, 'lds0019_notes_link_tags','link_id' );

	$this->add('note_id');
	$this->add('tag_id');
  }

  public function loadByTagIdAndNoteId($tag_id,$note_id)
  {
	$result = $this->_db->fetchRow(
	  "SELECT * FROM $this->_table 
		  WHERE note_id = :note_id 
		  AND tag_id = :tag_id",
	  array(
		  'note_id' => $note_id,
		  'tag_id'	=> $tag_id)
	);
	$link_id = $result['link_id'];

	return $this->load($link_id);
  }

  public function tagHasLink($tag_id)
  {
	$result = $this->_db->fetchAll(
	  "SELECT * FROM $this->_table 
		  WHERE tag_id = :tag_id",
	  array(
		  'tag_id'	=> $tag_id)
	);

	return ( count($result) > 0 ) ? true : false;

  }

 



/*
  protected function preInsert(){}
  protected function postLoad(){}
  protected function postInsert(){}
  protected function postUpdate(){}
  protected function preDelete(){}
 */

}
