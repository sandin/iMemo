<?php
require_once 'Zend/Db.php';

class UserControllerTest1 extends ControllerTestCase  
{

    public function testCallWithoutActionShouldPullFromIndexAction()
    {

		$f = $this->frontController;
		$f->addModuleDirectory(APPLICATION_PATH . '/modules');
		$m = $f->getModuleDirectory();
		$url = $f->getBaseUrl();
		var_dump($url);
		var_dump($m);

		$this->dispatch('/');
        $this->assertController('index');
        $this->assertAction('index');

		 // Set POST variables:
        $this->request->setPost(array(
            'baz'  => 'bat',
            'lame' => 'bogus',
        ));
    }

}
