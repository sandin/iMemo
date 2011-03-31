<?php

class Database_NotesLinkCategorys extends Database_DatabaseObject
{

  public function __construct($db)
  {
	parent::__construct($db, 'lds0019_notes_link_categorys','link_id' );

	$this->add('note_id');
	$this->add('category_id');
  }


  public function loadByNoteId($note_id)
  {
	$result = $this->_db->fetchRow(
	  "SELECT * FROM $this->_table 
		  WHERE note_id = :note_id", 
	  array('note_id' => $note_id)
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

    /** 
	* 删除note category link
	* 
	* @param $category_id
	* 
	* @return 
   */
  public function removeNoteCategoryLink($category_id)
  {
      $db = $this->_db;

      $query = sprintf('DELETE FROM %s ',$this->_table);
      $query .= $db->quoteInto('where note_id = ? ',$this->note_id);	
      $query .= $db->quoteInto('and category_id = ? ',$category_id);	
      //var_dump($query);

      $result = $this->_db->query($query);	
	  return ($result->rowCount() > 0) ? true : false;
  }

  public function changeCategoryFormTo($note_id,$old_category_id,$new_category_id)
  {
	$db = $this->_db;

	$query = sprintf('UPDATE %s SET ',$this->_table);
	$query .= $db->quoteInto('category_id = ? ',$new_category_id);	
	$query .= $db->quoteInto('where note_id = ? ',$note_id);	
	$query .= $db->quoteInto('and category_id = ? ',$old_category_id);	
	//var_dump($query);

	$result = $this->_db->query($query);	

	return ($result->rowCount() > 0) ? true : false;
  }




/*
  protected function preInsert(){}
  protected function postLoad(){}
  protected function postInsert(){}
  protected function postUpdate(){}
  protected function preDelete(){}
 */

}
