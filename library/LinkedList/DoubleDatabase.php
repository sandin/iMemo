<?php

/** 
 * 将带有双指针的数组转换为双向链式结构
 * 提供查找第一元素,查找最后元素,以及根据指针,还原链式顺序
 *
 */
class LinkedList_DoubleDatabase extends LinkedList_DoubleArray
{

    /** 
     * 用于输入sql命令时的table name
     * @var String $_tableName
     */
    protected $_dbObject;
    protected $_db;

    public function __construct(DatabaseObject $databaseObject = null,
                                $index_key = null,
                                $fronthand_key = null,
                                $backhand_key = null
                                )
    {
        $this->_dbObject  =  $databaseObject;
        if (isset($databaseObject)) {
            $this->_db    = $databaseObject->getDb();
            $this->_table = $databaseObject->getTable();
        }
        parent::__construct(null,$index_key,$fronthand_key,$backhand_key); 
    }

    public function setDatabaseObject(DatabaseObject $object)
    {
        $this->_dbObject = $object;
        $this->_db       = $object->getDb();
        $this->_table    = $object->getTable();
        return $this;
    }

    public function getDb()
    {
        return $this->_db;
    }

    public function getDatabaseObject()
    {
        return $this->_dbObject;
    }

    /** 
     * 按链表结构查找首元素,直接从数据库中读取
     * @todo join_table
     * 
     * @param Boolean $getId 是否只返回首元素的索引键
     * 
     * @return Array/Int
     */
    public function findFirstNodeInBatabase($getId = false, $join_table)
    {
       if (isset($this->_list) && count($this->_list) > 0) 
           $parent_result = parent::findFirstNodeInBatabase($getId);

       $root = $this->loadByIndex(NULL,true,$this->_fronthandKey);
       return ($getId == true) ? $root[$this->_indexKey] : $root;
    }

    /** 
     * 按链表结构查找末首元素,支持从数据库中读取
     * 
     * @todo join_table
     * @param Boolean $getId 是否只返回首元素的索引键
     * 
     * @return Array/Int
     */
    public function findLastNodeInBatabase($getId = false, $join_table)
    {
       if (isset($this->_list) && count($this->_list) > 0) 
           $parent_result = parent::findLastNodeInBatabase($getId);

       $root = $this->loadByIndex(NULL,true,$this->_backhandKey);
       return ($getId == true) ? $root[$this->_indexKey] : $root;
    }

    /** 
     * load data by index_key,支持从数据库中读取
     * useKey为iterator_to_array中的参数
     * 加之useKey则返回带有key(node在list中的index)的多维数组,否则返回一维数组
     * 
     * @param int $index index_value
     * @param Boolean $useKey 
     * 
     * @return Array
     */
    public function loadByIndex($index, $useKey = true, $byOther = null)
    {
       if (isset($this->_list) && count($this->_list) > 0) 
           $parent_result = parent::loadByIndex($index,$useKey);

       $where = (isset($byOther)) ? $byOther : $this->_indexKey; 

       $db = $this->_db;
       $select = $db->select();

       $select->from($this->_table, '*')
              ->where($where . ' = ?', $index);

       $sql = $select->__toString();
       //var_dump($sql);
       $result = $db->fetchRow($sql);
      // var_dump($result);
       return $result;       

    }

    /** 
     * 查找前后原书的index,支持从数据库中读取
     * 
     * @param $index
     * 
     * @return Array 
     */
    public function findSiblings($index)
    {
       if (isset($this->_list) && count($this->_list) > 0) 
           $parent_result = parent::findSiblings($index);

       $mySiblings = array();
       $node       = $this->loadByIndex($index);
       $mySiblings = array( 
           $this->_fronthandKey => $node[$this->_fronthandKey], 
           $this->_backhandKey  => $node[$this->_backhandKey]
       ); 

       return $mySiblings;
    }

    /** 
     * 更新一个node的数组,存入数据库
     * update a row with new data
     * 
     * @param $index
     * @param $new_front_id
     * @param $new_behind_id
     * @param Boolean $output 是否输出sql语句
     * 
     * @return 
     */
    public function updateOneNode($index,
                                  $new_front_id = NULL,
                                  $new_behind_id = NULL)
    {
        //parent::updateOneNode($index,$new_front_id,$new_behind_id);

        if (isset($new_front_id))
            $new_front_id  = $this->_db->quote((int)$new_front_id);
        if (isset($new_behind_id))
            $new_behind_id = $this->_db->quote((int)$new_behind_id);

        //不指定则跳过
        $set_1 = (isset($new_front_id) && $new_front_id != NULL) ?
            array($this->_fronthandKey => $new_front_id) : array();
        $set_2 = (isset($new_behind_id) && $new_behind_id != NULL) ?
            array($this->_backhandKey  => $new_behind_id) : array();
        $set = array_merge($set_1,$set_2);

        $table = $this->_dbObject->getTable();
        $where = $this->_db->quoteInto($this->_indexKey . ' = ?', $index);

        //var_dump($set);var_dump($table);var_dump($where);

        $rows_affected = $this->_db->update($table,$set,$where);
        //var_dump($rows_affected);
        return $rows_affected;
    }

    public function deleleOneNodeBy($byKey,$value) 
    {
        $db    = $this->_db;
        $table = $this->_table;
        $where = $db->quoteInto($byKey . ' = ?', $value);
        return $rows_affected = $db->delete($table, $where);
    }

    /** 
     * 向数据库中插入一条数据
     * 
     * @param $index
     * @param $front
     * @param $behind
     * 
     * @return 
     */
    public function insertOneNode($index,$front,$behind)
    {
        $row = array (
            $this->_indexKey      => $this->_db->quote($index),
            $this->_fronthandKey  => $this->_db->quote($front),
            $this->_backhandKey   => $this->_db->quote($behind),
        );
        $table = $this->_table;
        $rows_affected = $this->_db->insert($table, $row);
        return  $this->_db->lastInsertId();
    }

    /** 
     * 出表,直接操作数据库
     * 
     * @param $index
     * @param $output
     * @param $emtpyPointer
     * 
     * @return 
     */
    public function outList($index, $emtpyPointer = true , $delIt = true) 
    {
        $result      = array();
        $mySiblings  = $this->findSiblings($index);

        $n1 = $self        = $index;
        $n3 = $self_front  = $mySiblings[$this->_fronthandKey];
        $n4 = $self_behind = $mySiblings[$this->_backhandKey];

        if ($delIt) {
            $this->deleleOneNodeBy($this->_indexKey,$index);
        } else {
            if ($emtpyPointer == true)
                $result[] = $this->updateOneNode($n1, 0, 0);
        }
        $result[] = $this->updateOneNode($n3,  NULL, $n4);
        $result[] = $this->updateOneNode($n4,  $n3,  NULL);

        return $result;
    }

    public function inList($index, $front)
    {
        $result      = array();

        $frSiblings = $this->findSiblings($front);

        $n1 = $self          = $index;
        $n2 = $target        = $front;
        $n5 = $target_behind = $frSiblings[$this->_backhandKey];

        $result[] = $this->insertOneNode($n1,  $n2,  $n5);
        $result[] = $this->updateOneNode($n2,  NULL, $n1);
        $result[] = $this->updateOneNode($n5,  $n1,  NUll);

        return $result;
    }

    public function placeBefore($index, $front)
    {
        $result      = array();
        $mySiblings  = $this->findSiblings($index);
        $frSiblings = $this->findSiblings($front);

        $n1 = $self          = $index;
        $n2 = $target        = $front;
        $n3 = $self_front    = $mySiblings[$this->_fronthandKey];
        $n4 = $self_behind   = $mySiblings[$this->_backhandKey];
        $n5 = $target_front  = $frSiblings[$this->_fronthandKey];
         
        $this->updateOneNode( $n1,  $n2,   $n5 );  
        $this->updateOneNode( $n2,  NULL,  $n1 );  
        $this->updateOneNode( $n3,  NULL,  $n4 );  
        $this->updateOneNode( $n4,  $n3,   NULL );  
        $this->updateOneNode( $n5,  $n1,   NULL );  

        return $result;
    }

    /** 
     * 将$this->_list数组中的数组存入数据库
     * 
     * @return 
     */
    public function saveListIntoDatabase()
    {
        //sort name
        $f     = $this->_fronthandKey;
        $b     = $this->_backhandKey;
        $i     = $this->_indexKey;

        if (isset($this->_list) && count($this->_list) > 0) {
            foreach ($this->_list as &$node) {
                $this->insertOneNode($node[$i],$node[$f],$node[$b]);
            }
        }//fi
    }

}



?>
