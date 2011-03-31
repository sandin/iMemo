<?php

class Command_PropertyValue
{
  protected $_propName;
  protected $_propValue;

  public function __construct($propName,$propValue)
  {
	$this->_propName = $propName;
	$this->_propValue = $propValue;
  }

  public function __get($name)
  {
	return $this->$name;
  }

}

