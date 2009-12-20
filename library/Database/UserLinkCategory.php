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


   /** 
	* 删除note category link
	* 
	* @param $category_id
	* 
	* @return 
   */
  public function removeUserCategoryLink($category_id)
  {
	$table = $this->_table;
	$where = $this->_db->quoteInto('category_id = ?', $category_id);
	$rows_affected = $this->_db->delete($table, $where);

	return ($rows_affected > 0) ? true : false;
  }

  public function thisUserHasThisCategory($user_id, $category_id)
  {
	$select = $this->_db->select();
	$select->from($this->_table, '*')
		   ->where('user_id = ?', $user_id)
		   ->where('category_id = ?', $category_id);

	// 但是，读取数据的方法相同
	$sql = $select->__toString();
	//var_dump($sql);
	$result = $this->_db->fetchAll($sql);
	//var_dump($result);
	return (count($result) > 0) ? true : false;
  }
 



/*
  protected function preInsert(){}
  protected function postLoad(){}
  protected function postInsert(){}
  protected function postUpdate(){}
  protected function preDelete(){}
 */

}
