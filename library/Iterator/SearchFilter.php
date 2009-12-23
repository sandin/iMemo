<?php

/** 
 * class SearchFilterIterator 
 * 在二维数组中搜索指定的键值对
 */
class Iterator_SearchFilter extends FilterIterator {
    
    /** 
     * @var String $_key
     */
    protected $_key;

    /** 
     * @var String $_value
     */
    protected $_value;

    /** 
        * 构造函数
        * 
        * @param $iterator 迭代器
        * @param $key 搜索key
        * @param $value 搜索value
        * 
        * @return 
     */
    public function __construct(Iterator $iterator, $key, $value)
    {
        $this->_key = $key;
        $this->_value = $value;
        parent::__construct($iterator);
    }

    public function accept() {
        $curr = $this->current();
        //var_dump($curr);
        return ($curr[$this->_key] === $this->_value);  // T/F
    }
}

?>
