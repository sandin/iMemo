<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
	  $this->_db = Zend_Registry::get('db');
	  $this->_user = Zend_Registry::get('user');
	  
	  $this->_db_user = new Database_User($this->_db);	
    }

	public function preDispatch() 
	{
	
	}

    public function indexAction()
	{



	  // create a new user
	 /* 
	  $db_user->username = 'liu';
	  $db_user->password = md5(123);
	  $db_user->save();
	  */
	  $this->_db_user->load($this->_user->user_id);
	  // create a new notes
	  $notes = new Database_Notes($this->_db);
	  $notes->load(1);
	  //var_dump($notes);
	  $notes->addTag('tag1');
	  $a = $notes->tagIsExist(1,'tag1');
	  //var_dump($a);
	  /*
	  $param =  array(
		'user_id' => $db_user->getId(),
		'category' => 'cat',
		'star' => 3,
		'content' => 'liudingsansansan'
	  );
	   */
	  //$command = new Command_AddNoteCommand($notes,$param);
	  $param =  array(
		'user_id' => $this->_db_user->getId(),
	  );
	  $command = new Command_GetNoteCommand($notes,$param);

	  $this->_db_user->setCommand($command);
	  $notes =  $this->_db_user->executeCommand();

	  $this->view->notes = $notes; 
     
	}



    public function aAction()
	{
	  $this->_db_user->unExecuteCommand();

	}
	
	public function bAction()
	{
	   $dom_str =  <<<EOF
<div>
    <table>
        <tr>
            <td class="foo">
                <div>
                    Lorem ipsum <span class="bar">
                        <a href="/foo/bar" id="one">One</a>
                        <a href="/foo/baz" id="two">Two</a>
                        <a href="/foo/bat" id="three">Three</a>
                        <a href="/foo/bla" id="four">Four</a>
                    </span>
                </div>
            </td>
        </tr>
    </table>
</div>
EOF;

	  $dom = new Zend_Dom_Query($dom_str);
	  $results = $dom->query('table .foo');
	  //Zend_Debug::dump($results);
	  $newdom = $results->getDocument();
	  //Zend_Debug::dump($newdom);
	  $span =	$newdom->getElementsByTagName("span")->item(0)->nodeName ;
	  //Zend_Debug::dump($span); 
	  foreach ($results as $result) {
		//  Zend_Debug::dump($result);	  
		// $result is a DOMElement
	  }
	  
	  // 取得最新的 Slashdot 头条新闻
	  try {
		  $slashdotRss = Zend_Feed::import('http://www.sudono.cn/blog/feed');
		  //print $slashdotRss->savaXML();
		  //$slashdotRss->send();
	  } catch (Zend_Feed_Exception $e) {
		  // feed 导入失败
		  echo "Exception caught importing feed: {$e->getMessage()}\n";
		  exit;
	  }

	  //Zend_Debug::dump($slashdotRss);
	  // 初始化保存 channel 数据的数组
	  $channel = array(
		  'title'       => $slashdotRss->title(),
		  'link'        => $slashdotRss->link(),
		  'description' => $slashdotRss->description(),
		  'items'       => array()
		  );

	  // 循环获得channel的item并存储到相关数组中
	  foreach ($slashdotRss as $item) {
		  $channel['items'][] = array(
			  'title'       => $item->title(),
			  'link'        => $item->link(),
			  'description' => $item->description()
			  );
	  }
	  //Zend_Debug::dump( $channel ) ;

	}

	public function postDispatch()
	{
	  //echo '<br />end of file<br />';
	}

	public function __call($method, $args)
	{
	    if ('Action' == substr($method, -6)) {
            // If the action method was not found, forward to the
            // index action
			return $this->_forward('index');
        }

        // all other methods throw an exception
        throw new Exception('Invalid method "'
                            . $method
                            . '" called',
                            500);
	}
}

