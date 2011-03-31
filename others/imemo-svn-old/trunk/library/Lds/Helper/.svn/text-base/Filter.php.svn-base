<?php

class Lds_Helper_Filter
{

  public function __construct()
  {
  
  }

  public static function filter(& $data)
  {
	$filter = new Zend_Filter();
	$filter->addFilter(new Zend_Filter_StringTrim())
		   //->addFilter(new Zend_Filter_StripTags())
	       ->addFilter(new Lds_Filter_Htmlspecialchars());

	if (is_array($data)) {
	  foreach ($data as $key => $value) {
	  	$data[$key] = $filter->filter($value);
	  }
	} else {
	  $data = $filter->filter($data);
	}
  }


}
