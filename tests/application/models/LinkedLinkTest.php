<?php
require_once 'PHPUnit/Framework.php';
 
class LinkedListTest extends ControllerTestCase  
{
    protected $_arr;
    protected $_list;
    protected $_db;
    protected $_listDB;

    public function setUp()
    {
       $this->_db = Zend_Registry::get('db');

        //database版本的测试数据(后面有硬编码,不能修改).index不允许有0
        $this->_array = $array = array(4,5,1,6,3,7,8,9);

        //基础array类型的测试数据
       $this->_arr = array(
         array('front'   => 2,
               'note_id' => 1,
               'behind'  => 3)
        ,array('front'   => null,
               'note_id' => 2,
               'behind'  => 1)
        ,array('front'   => 1,
               'note_id' => 3,
               'behind'  => null)
        );

       $this->order = array(2,1,3);

     //  $list = $this->_list = new LinkedList($this->_arr,
     //                           'note_id','front','behind');
       $list = $this->_list     = new LinkedList_DoubleArray();
       $list->setBaseArray($this->_arr)
            ->setFronthandKey('front')
            ->setBackhandKey('behind')
            ->setIndexKey('note_id');

       $this->_fronthandKey =  $list->getFronthandKey();
       $this->_backhandKey  =  $list->getBackhandKey();
       $this->_indexKey     =  $list->getIndexKey();
       //

       $order_table_object = new Database_NotesOrder($this->_db);

       $listDB = $this->_listDB = new LinkedList_DoubleDatabase();
       $listDB->setDatabaseObject($order_table_object)
              ->setFronthandKey('fronthand')
              ->setBackhandKey('backhand')
              ->setIndexKey('note_id');

    }

    public function testBaseFunction()
    {
        $list = $this->_list; 

        //测试一些基本功能
        $firstNode =  $list->findFirstNode();
        $lastNode  =  $list->findLastNode();
        $lastNodeId=  $list->findLastNode(true);

        $fronthand =  $list->getFronthandKey();
        $backhand  =  $list->getBackhandKey();
        $indexKey  =  $list->getIndexKey();

        //检查
        $this->assertEquals(
            $fronthand, 'front');
        $this->assertEquals(
            $backhand, 'behind');
        $this->assertEquals(
            $indexKey, 'note_id');

        //重复检查
        $this->assertEquals(
        $firstNode[$indexKey] ,$this->order[0]);
        $this->assertEquals(
        $lastNode[$indexKey]  ,end($this->order));
        $this->assertEquals(
        $lastNode[$indexKey]  ,end($this->order));
    }

    public function testOrderList()
    {
        //测试重新排序
        $list = $this->_list;
        $new_list = $list->orderList();

        $this->assertEquals(
            $new_list[0]['note_id'], $this->order[0]);
    }

    public function testUpdateAndFindSiblingsAndLoadByIndex()
    {
        //测试高级功能
        $list = $this->_list;
        //load功能
        $node = $list->loadByIndex(1,false);
        //检查load成功
        $this->assertEquals(
            $node[$this->_fronthandKey] ,2 );
        $this->assertEquals(
            $node[$this->_backhandKey]  ,3 );

        //load另一种模式
        $nodeWithOldKey = $list->loadByIndex(1,true);

        //测试查找前后元素功能
        $mySiblings = $list->findSiblings(1);
        $this->assertContains(2,$mySiblings);
        $this->assertContains(3,$mySiblings);

        //测试更新一条node功能,人工检查输出结果,此函数已可以不返回结果
        $query = $list->updateOneNode(2,5,6);
        //var_dump($query);

        //检查update是否成功
        $new_node = $list->loadByIndex(2,false);
        $this->assertEquals(
            $new_node[$this->_fronthandKey] ,5 );
        $this->assertEquals(
            $new_node[$this->_backhandKey]  ,6 );
    }

    public function testInAndOut()
    {
        //array层面的只完成inlist,outlist因为现用不到,没完成
        //in/out在database版本中完善
        $list = $this->_list;

        $this->assertEquals(
            count($list->getList()),3);
        $querys = $list->outList(1);

        $mySiblings = $list->findSiblings(1);
        $this->assertEquals(
            $mySiblings[$this->_fronthandKey] ,0 );
        $this->assertEquals(
            $mySiblings[$this->_backhandKey]  ,0 );

        $mySiblings = $list->findSiblings(2);
        $this->assertEquals(
            $mySiblings[$this->_fronthandKey] ,NULL );
        $this->assertEquals(
            $mySiblings[$this->_backhandKey]  ,3 );
    }

    /** 
     * 测试LinkedList_DoubleDatabase
     * 数据库版
     * 
     * @return 
     */
    public function testListDbBaseFunction()
    {
        $listDB = $this->_listDB;

        //测试基本功能,继承而来的一些
        $this->assertEquals( 
            $listDB->getFronthandKey(),'fronthand');
        $databaseObject = $listDB->getDatabaseObject();

        //测试本身重载的函数

        
        //从数组构建双链结构
        $new_array = $listDB->fillIndexOrderArray($this->_array);
        //存储到数据库
        $listDB->saveListIntoDatabase();

        //测试更新一条node,在数据库中操作
        $first = $this->_array[0];
        $this->_listDB->loadByIndex(4);

        //检测出队 4,1,6,3,7,8,9
        $listDB->outList(5);
        $this->assertFalse(
            $listDB->loadByIndex(5));
        //再检测 4,1,6,3,7,9
        $listDB->outList(8);
        $this->assertFalse(
            $listDB->loadByIndex(8));
        //通过检查前后元素确定干净出对
        $temp = $listDB->findSiblings(4);
        $this->assertEquals(
            $temp[$listDB->getBackhandKey()] , 1);
        
        //检查入队,插入到note_id = 1的后面,插入后4,1,2,6,3,7,9
        $listDB->inList(2,1);
        $newSil = $listDB->findSiblings(2);
        $this->assertEquals(
            $newSil[$listDB->getFronthandKey()], 1);
        $this->assertEquals(
            $newSil[$listDB->getBackhandKey()], 6);
    }

    public function testPlace()
    {
        $listDB = $this->_listDB;
        //从数组构建双链结构
        $new_array = $listDB->fillIndexOrderArray($this->_array);
        //存储到数据库
        $listDB->saveListIntoDatabase();

        //测试放置功能,将9放到4后面  放置后的顺序为 4,7,1,2,6,3,9
        //从array(4,5,1,6,3,7,8,9);
        //到array(4,7,5,1,6,3,8,9);
        $listDB->placeBefore(7,4);
        //检查
        $newSil = $listDB->findSiblings(7);
        $this->assertEquals(
            $newSil[$listDB->getFronthandKey()], 4);
        $this->assertEquals(
            $newSil[$listDB->getBackhandKey()], 5);
       
        //从array(4,7,5,1,6,3,8,9);
        //到array(4,7,5,9,1,6,3,8);
        $listDB->placeBefore(9,5);
        //检查
        $newSil = $listDB->findSiblings(9);
        $this->assertEquals(
            $newSil[$listDB->getFronthandKey()], 5);
        $this->assertEquals(
            $newSil[$listDB->getBackhandKey()],  1);

        $newSil = $listDB->findSiblings(8);
        $this->assertEquals(
            $newSil[$listDB->getFronthandKey()], 3);
        $this->assertEquals(
            $newSil[$listDB->getBackhandKey()],  0);

        //重新检查load和查找首末元素
        $n = $this->_listDB->loadByIndex(5);
        $f_id = $listDB->findFirstNode(true,null);
        $l_id = $listDB->findLastNode(true,null);
        $this->assertEquals(
            $f_id , $this->_array[0]);
        $this->assertEquals(
            $l_id , end($this->_array));
    }

    public function testDBFindFirstNode()
    {
        $listDB = $this->_listDB;
        $new_array = $listDB->fillIndexOrderArray($this->_array);
        //存储到数据库
        $listDB->saveListIntoDatabase();

        $fKey = $listDB->getFronthandKey();
        $result = $listDB->findNodeInBatabase(false,
            'lds0019_notes_link_categorys',1,$fKey,0);
        var_dump($result);
    }


    public function teardown()
    {
        //清空该表
        $dbObject = $this->_listDB->getDatabaseObject();
        $table    = $dbObject->getTable();
        $result   = $this->_db->delete($table);
    }

}



?>
