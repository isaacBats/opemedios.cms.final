<?php
include("db_config.php");

function genera_arreglo_BD()
{
    $dbconf = new OpmDBConf();
    $arreglo = array("databaseURL"=>$dbconf->get_databaseURL(),
                     "databaseUname"=>$dbconf->get_databaseUName(),
                     "databasePword"=>$dbconf->get_databasePWord(),
                     "databaseName"=>$dbconf->get_databaseName());

    return $arreglo;
}

?>
