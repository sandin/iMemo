<?php

/** 
 * 将带有双指针的数组转换为双向链式结构
 *
 * 基数组格式如下：
 * $arr = array(
 *  'id'    => 2,
 *  'front' => 1,
 *  'back'  => 3
 *  );
 *  也可直接提供顺序数组如： $order = array(2,1,3);
 *  使用fillIndexOrderArray方法将其自动生成基数组。。
 *
 * 该类提供查找首/尾元素,插入元素到任意位置，以及根据指针,还原链式顺序
 *
 */
class LinkedList_DoubleArray
{
    /** 
     * Linked List 
     * @var Array $_list 
     */
    protected $_list;

    /** 
     * Linked List Iterator
     * @var Iterator $_listIterator
     */
    protected $_listIterator;

    /** 
     * 前向指针
     * @var String $_fronthandKey
     */
    protected $_fronthandKey;

    /** 
     * 后向指针
     * @var String $_backhandKey
     */
    protected $_backhandKey;

    /** 
     * 索引键
     * @var String $_indexKey
     */
    protected $_indexKey;

    /** 
     * 构造函数
     * 
     * @param $array 带有双指针的数组
     * @param $index_key 索引key
     * @param $fronthand_key 前向指针
     * @param $backhand_key 后向指针
     * 
     * @return 
     */
    public function __construct($array = null,
                                $index_key = null,
                                $fronthand_key = null,
                                $backhand_key = null,
                                $table_name = null)
    {
        $this->_list         =  $array;
        $this->_fronthandKey =  $fronthand_key;
        $this->_backhandKey  =  $backhand_key;
        $this->_indexKey     =  $index_key;
        $this->_tableName    =  $table_name;

        if ($array) {
            $this->_listIterator =  new ArrayIterator($array); 
        }
    }

    /** 
     * 设置base array
     * 
     * @param $array
     * 
     * @return 
     */
    public function setBaseArray($array)
    {
        $this->_list = $array;
        $this->_listIterator =  new ArrayIterator($array); 
        return $this;
    }

    /** 
     * 设置fronthand key 
     * 
     * @param String $fronthand_key
     * 
     * @return 
     */
    public function setFronthandKey($fronthand_key)
    {
        $this->_fronthandKey = $fronthand_key;
        return $this;
    }
    
    /** 
     * 设置backhand key
     * 
     * @param String #fronthand_key
     * 
     * @return 
     */
    public function setBackhandKey($backhand_key)
    {
        $this->_backhandKey = $backhand_key;
        return $this;
    }

    /** 
     * 设置index key
     * 
     * @param String $index_key
     * 
     * @return 
     */
    public function setIndexKey($index_key)
    {
        $this->_indexKey = $index_key;
        return $this;
    }

    /** 
     * 获取前向指针
     * 
     * @return String $_fronthandKey
     */
    public function getFronthandKey()
    {
        return $this->_fronthandKey;
    }

    /** 
     * 获取后向指针
     * 
     * @return String $_backhandKey
     */
    public function getBackhandKey()
    {
        return $this->_backhandKey;
    }

    /** 
     * 获取索引键
     * 
     * @return String $_indexKey
     */
    public function getIndexKey()
    {
        return $this->_indexKey;
    }

    public function getList()
    {
        return $this->_list;
    }

    /** 
     * 更新list后需要刷新迭代器
     * 
     * @return 
     */
    public function flashIterator()
    {
        $this->_listIterator = new ArrayIterator($this->_list); 
    }

    /** 
     * 按链表结构查找首元素
     * 
     * @param Boolean $getId 是否只返回首元素的索引键
     * 
     * @return Array/Int
     */
    public function findFirstNode($getId = false)
    {
        $iterator = new Iterator_SearchFilter($this->_listIterator,
                                             $this->_fronthandKey,0);
       //var_dump($iterator);
        $first  = iterator_to_array($iterator,false);
        //var_dump($first);
        return ($getId == true) ? $first[0][$this->_indexKey] : $first[0];
    }

    /** 
     * 按链表结构查找末首元素
     * 
     * @param Boolean $getId 是否只返回首元素的索引键
     * 
     * @return Array/Int
     */
    public function findLastNode($getId = false)
    {
        $iterator = new Iterator_SearchFilter($this->_listIterator,
                                             $this->_backhandKey,0);
        $last  = iterator_to_array($iterator,false);
        return ($getId == true) ? $last[0][$this->_indexKey] : $last[0];
    }

    /** 
     * 根据链式结构排序数组
     * 
     * @return Array $new_list
     */
    public function orderList()
    {
        $new_list = array();

        $firstNote  = $this->findFirstNode();
        $this->iterateNodes($firstNote,$new_list);
        return ($this->_list = $new_list);
    }

    /** 
     * orderList时需要迭代node
     * 
     * @param Array $node 
     * @param Array $array 寄存结果的数组
     * 
     * @return void
     */
    public function iterateNodes($node, &$array)
    {
        $array[] = $node;
        $nextNoteId = $node[$this->_backhandKey];
       //var_dump($node);
       //var_dump($this->_backhandKey);
        
        $iterator = new Iterator_SearchFilter($this->_listIterator,
                                             $this->_indexKey,$nextNoteId);
       //var_dump($iterator);
        $temp = iterator_to_array($iterator,false);

        if (count($temp) > 0) {
            $nextNote = $temp[0];
            $this->iterateNodes($nextNote,&$array);
        }
    }

    /** 
     * load data by index_key
     * useKey为iterator_to_array中的参数
     * 加之useKey则返回带有key(node在list中的index)的多维数组,否则返回一维数组
     * 
     * @param int $index index_value
     * @param Boolean $useKey 
     * 
     * @return Array
     */
    public function loadByIndex($index, $useKey = true)
    {
        $iterator = new Iterator_SearchFilter($this->_listIterator,
                                             $this->_indexKey,$index);
        $node  = iterator_to_array($iterator,$useKey);
        return ($useKey == true) ? $node : $node[0];
    }

    /** 
     * 查找前后原书的index
     * 
     * @param $index
     * 
     * @return Array 
     */
    public function findSiblings($index)
    {
        $self = $this->loadByIndex($index,false);
        $front_id  = $self[$this->_fronthandKey];
        $behind_id = $self[$this->_backhandKey];
        return array($this->_fronthandKey => $front_id,
                     $this->_backhandKey  => $behind_id);
    }

    /** 
     * 更新一个node的数组
     * update a row with new data
     * 
     * @param $index
     * @param $new_front_id
     * @param $new_behind_id
     * 
     * @return 
     */
    public function updateOneNode($index,
                                  $new_front_id = NULL,
                                  $new_behind_id = NULL)
    {

        $nodeWithOldKey = $this->loadByIndex($index);
        foreach ($nodeWithOldKey as $key => $value) {
            $realNote = &$this->_list[$key];
            if (isset($new_front_id)) 
                $realNote[$this->_fronthandKey] = $new_front_id;
            if (isset($new_behind_id))
                $realNote[$this->_backhandKey]  = $new_behind_id;
        }
        $this->flashIterator();
        return true;
    }

    public function outList($index, $emtpyPointer = true) 
    {
        $result      = array();
        $mySiblings  = $this->findSiblings($index);
        $self        = $index;
        $self_front  = $mySiblings[$this->_fronthandKey];
        $self_behind = $mySiblings[$this->_backhandKey];

        if ($emtpyPointer == true)
            $result[] = $this->updateOneNode($index,0,0);
        $result[] = $this->updateOneNode($self_front,NULL,$self_behind);
        $result[] = $this->updateOneNode($self_behind,$self_front,NULL);

        return $result;
    }

    /** 
     * 根据一个正常顺序的index array构造一个双链结构,并填充到$this->_list中
     * 例如根据array(4,5,1,2,6,3,7,8,9,0);
     * [0]=>
     *  array(3) {
     *   ["note_id"]=> int(4)
     *   ["fronthand"]=> NULL
     *   ["backhand"]=> int(5)
     *   }
     * [1]=>
     *  array(3) {
     *   ["note_id"]=> int(5)
     *   ["fronthand"]=>  int(4)
     *   ["backhand"]=>  int(1)
     * }
     * 
     * @param $array
     * 
     * @return 
     */
    public function fillIndexOrderArray($array)
    {
        $iterator = new ArrayIterator($array);
        $new_array = array();

        $this->iterateIndexArray($iterator,$new_array);
        $this->setBaseArray($new_array);

        return $new_array;
    }

    /** 
     * fillIndexOrderArray所需的迭代器
     * 
     * @param $iterator
     * @param $new_array
     * 
     * @return 
     */
    public function iterateIndexArray($iterator, &$new_array)
    {
        if (count($new_array) > 0) {
            $front_node = end($new_array);
            $front_node_id = $front_node[$this->_indexKey];
        } else {
            $front_node_id = NULL;
        }
        $curr_node_id = $iterator->current();
        //指针下移
        $iterator->next();
        $next_node_id = $iterator->current();
        //var_dump($iterator);

        $new_array[] = array($this->_indexKey     => $curr_node_id,
                             $this->_fronthandKey => $front_node_id,
                             $this->_backhandKey  => $next_node_id);
        if ($iterator->valid())
            $this->iterateIndexArray($iterator, &$new_array);
    }

}




?>
