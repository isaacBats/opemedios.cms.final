<?php

class OpmDBConf
{
    private $databaseURL = 'localhost';
    private $databaseUName;
    private $databasePWord;
    private $databaseName;

    function __construct()
	{
        $properties = parse_ini_file(__DIR__ . '/../../../config.ini');
        $this->databaseUName = $properties["userDB"]; 
        $this->databasePWord = $properties["passwordDB"]; 
        $this->databaseName = $properties["database"];
	}

    function get_databaseURL()
    {
        return $this->databaseURL;
    }
    function get_databaseUName()
    {
        return $this->databaseUName;
    }
    function get_databasePWord()
    {
        return $this->databasePWord;
    }
    function get_databaseName()
    {
        return $this->databaseName;
    }


    function  __destruct()
    {

    }
}
?>