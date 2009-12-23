<?php

class LinkedList_Factory
{
    public function __construct()
    {
    }

    public static function factory($type)
    {
       $db = Zend_Registry::get('db');

       $listDB = new LinkedList_DoubleDatabase();
       $listDB->setFronthandKey('fronthand')
              ->setBackhandKey('backhand')
              ->setIndexKey('note_id');

       switch ($type)
       {
        case 'database':
            $order_table_object = new Database_NotesOrder($db);
            $listDB->setDatabaseObject($order_table_object);
            break;
        case 'array':
            break;

        default:
       }

       return $listDB;
    }




}

?>
