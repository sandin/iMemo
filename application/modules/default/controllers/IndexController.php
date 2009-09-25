<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
	
	 
    }

	public function preDispatch() 
	{
	
	}

    public function indexAction()
	{

	  $db = Zend_Registry::get('db');
	  $user = Zend_Registry::get('user');
	  
	  $db_user = new Database_User($db);
	  // create a new user
	 /* 
	  $db_user->username = 'liu';
	  $db_user->password = md5(123);
	  $db_user->save();
	  */
	  $db_user->load($user->user_id);
	  // create a new notes
	  $notes = new Database_Notes($db);
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
		'user_id' => $db_user->getId(),
	  );
	  $command = new Command_GetNoteCommand($notes,$param);

	  $db_user->setCommand($command);
	  $notes =  $db_user->executeCommand();
	  $this->view->notes = $notes; 
     
	}

    public function aAction()
	{
	  //echo "here aAction<br />";
	  $table = new Default_Model_Persons();
	  $db = $table->getAdapter();
	  //$where = $db->quoteInto('name = ?' ,'lds');	  
	  //$ru = $db->fetchAll();
	  //Zend_Debug::dump( $ru );
	  /*
	  $data = array(
	    'name' => 'King',
		 'age'  => '200',
		);
	   */
	  // $id = $table->insert($data); 
	   $set = array(
		  'name' => 'yellow',
		);

	  $where = $db->quoteInto('name = ?', 'yellow');

	  $all = $table->fetchAll();
	  foreach ($all as $row) {
		//echo $row->name . "<br />";
	  }
	  

	  $row = $table->fetchRow($where);
	  //echo $row->age;
	  $row->age = 300;
	  $row->save();

	  //Zend_Debug::dump($where, $label='where', $echo=true);
	  //Zend_Debug::dump($row, $label='row', $echo=true);
	  
	  $filters = array(
		'month'   => 'Digits',
	   'account' => 'StringTrim'
	  );

	  $validators = array(
		'month'   => 'Digits',
		'account' => 'Alpha'
	  );

	  $validators2 = array(
		   'password' => array(
			  'Digits',
			  'fields' => 'mo',
			  'presence' => 'required'
		  )
		);
	  $input2 = new Zend_Filter_Input(null,$validators2);
	  $data2 = array (
		'mo' => '456',
		'password' => '123',
	  );

	  $input2->setData($data2);
	  //echo $input2->password;
	  //echo $input2->mo;

	  //$input = new Zend_Filter_Input($filters, $validators);
	  $input = new Zend_Filter_Input($filters,null);
	  $data = array( 'month' => 'l12', 'account' => ' d<script>alert(312);</script>fadf ');
	  $input->setData($data);
	  if ($input->isValid()) {
		//  echo $input->account . '<br />';
		//  echo $input->month;
		//  echo $input->getEscaped('account'); 
		  //echo $input->getUnescaped('account'); 
	  }
	  //echo $input->getEscaped('month');   
	  //Zend_Debug::dump($input);

	  if ($input->hasInvalid() || $input->hasMissing()) {
		// echo $messages = $input->getMessages();
		}

		// getMessages() simply returns the merge of getInvalid() and getMissing()

		if ($input->hasInvalid()) {
		//echo  $invalidFields = $input->getInvalid();
		}

		if ($input->hasMissing()) {
		//echo  $missingFields = $input->getMissing();
		}

		if ($input->hasUnknown()) {
		//echo  $unknownFields = $input->getUnknown();
		//Zend_Debug::dump($unknownFields);
		}

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

