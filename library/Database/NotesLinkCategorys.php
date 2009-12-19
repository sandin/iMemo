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
	$table = $this->_table;
	$where = $this->_db->quoteInto('category_id = ?', $category_id);
	$rows_affected = $this->_db->delete($table, $where);
	return ($rows_affected > 0) ? true : false;
  }

  public function changeCategoryFormTo($note_id,$old_category_id,$new_category_id)
  {
	$query = sprintf('UPDATE %s SET
					  category_id = ?
					  where note_id = ?
					  and category_id = ?',
                     $this->_table);

	$query = $this->_db->quoteInto($query,array(
								  $new_category_id,
								  $note_id,
								  $old_category_id)); 
	$result = $this->_db->query($query);	

	return $result;
  }




/*
  protected function preInsert(){}
  protected function postLoad(){}
  protected function postInsert(){}
  protected function postUpdate(){}
  protected function preDelete(){}
 */

}
