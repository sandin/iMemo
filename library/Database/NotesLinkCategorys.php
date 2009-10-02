<?php
require_once('ldslibs/DatabaseObject.php'); 

class Database_NotesLinkCategorys extends DatabaseObject
{

  public function __construct($db)
  {
	parent::__construct($db, 'lds0019_notes_link_categorys','link_id' );

	$this->add('note_id');
	$this->add('category_id');
  }

  public function loadByCategoryIdAndNoteId($category_id,$note_id)
  {
	$result = $this->_db->fetchRow(
	  "SELECT * FROM $this->_table 
		  WHERE note_id = :note_id 
		  AND category_id = :category_id",
	  array(
		  'note_id' => $note_id,
		  'category_id'	=> $category_id)
	);
	$link_id = $result['link_id'];

	return $this->load($link_id);
  }

  public function categoryHasLink($category_id)
  {
	$result = $this->_db->fetchAll(
	  "SELECT * FROM $this->_table 
		  WHERE category_id = :category_id",
	  array(
		  'category_id'	=> $category_id)
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
