<?php
include_once "model.php";
include_once "xmldao.php";
include_once "repository.php";
include_once "sql.php";

$xmlFile = new XMLFile('bundle.xml');
$xmlCandleDao = new XMLFileDao($xmlFile);
$repos = new Repository($xmlCandleDao);

// $testCandledb = new Candledb();
// $sql_access = new sql_access($testCandlerdb);
// $repos = new Repository($sql_access);
?>