<?php

class Command_ModificationHistory
{
  private static $instance; 

  protected $_redoStack;
  protected $_undoStack;
  protected $_objParent;

  public function __construct($parent)
  {
	$this->_redoStack = array();
	$this->_undoStack = array();
	$this->_objParent = $parent;
  }

  public static function getInstance($parent)
  {
	if(self::$instance == null) {
		self::$instance = new Command_ModificationHistory($parent);
	}
	return self::$instance;
  }

  public function canUndo()
  {
	return ($this->_undoStack > 0 ? true : false);
  }

  public function canRedo()
  {
	return ($this->_redoStack > 0 ? true : false);
  }

  public function store($propName, $propVal,$stack)
  {
	$pVal = new Command_PropertyValue($propName, $propVal);
	switch ($stack) {
	  case 'undo':
		$this->_undoStack[] = $pVal;
		break;
	  case 'redo':
		$this->_redoStack[] = $pVal;
		break;
	}
  }

  public function undo()
  {
    if (count($this->_undoStack) > 0)
	{
	  $lastCommand = array_pop($this->_undoStack);
	  $command = $lastCommand->_propName ;
	  $value = $lastCommand->_propVal ;

	//  var_dump('new ' . $command . '(' . $this->_objParent . ',null)');
	 // $command = eval('new' . $command . '(' . $this->_objParent . ',null)');

	  $command->setParam($value);
	  $command->unExecuteCommand();
	}
  }


  public function redo()
  {
    if (count($this->_undoStack) > 0)
	{
	  $lastCommand = array_pop($this->_undoStack);
	  $command = $lastCommand->_propName ;
	  $value = $lastCommand->_propVal ;

	//  var_dump('new ' . $command . '(' . $this->_objParent . ',null)');
	 // $command = eval('new' . $command . '(' . $this->_objParent . ',null)');

	  $command->setParam($value);
	  $command->unExecuteCommand();
	}
  }
}
