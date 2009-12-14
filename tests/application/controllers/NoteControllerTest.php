<?php
require_once 'Zend/Db.php';

class UserControllerTest extends ControllerTestCase  
{

    public function testCallWithoutActionShouldPullFromIndexAction()
    {



		$this->dispatch('/default/index/index');
		$this->assertModule('default');
        $this->assertController('index');
        $this->assertAction('index');

		 // Set POST variables:
        $this->request->setPost(array(
            'baz'  => 'bat',
            'lame' => 'bogus',
        ));
    }

}
