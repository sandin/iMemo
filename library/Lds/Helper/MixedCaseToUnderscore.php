<?php

class Lds_Helper_MixedCaseToUnderscore
{
	
	public function __construct()
	{
	}

	public static function inflector($string)
	{
	  $string = trim($string);
	  $string = str_replace('_',' ',$string);
	  $string = ucwords($string);
	  $string = str_replace(' ','',$string);

	  return $string;

	}
}
