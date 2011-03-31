<?php
class Command_Factory
{
  public function __construct()
  {
  }

  public static function factory($commandType)
  {
	$filename = str_replace('Command_','',$commandType);
	$file = BOOT_PATH . '/library/Command/' . $filename . '.php';

	try 
	{
	  if (file_exists($file)) {
		eval('$command = new ' . $commandType . '();');
		return $command;
	  } else {
		throw new RuntimeException("Can\' find class to $filename",0x0001);
	  }
	}
	catch(Exception $e)
	{
	  echo $e->getMessage() . ' ';
	}

  }


}

