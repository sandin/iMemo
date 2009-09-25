<?php

class Bootstrap extends Zend_Application_Module_Bootstrap
{
	protected function _initAutoload()
    {
        $autoloader = new Zend_Application_Module_Autoloader(array(
            'namespace' => 'Blog_',
			'basePath'  => APPLICATION_PATH . '/modules/blog',
        ));
        return $autoloader;
    } 
}
