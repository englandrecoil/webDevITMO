<?php
require_once "fileutils.php";

$idToDelete = $_GET['id'];
$element = $xmlFile->getElementById('one');

$b = $xmlFile->getElementsByTagName('bundle');
foreach ($bundle as $candle) {
    if($candle->getAttribute('id') == $idToDelete) {
        $b->item(0)->removeChild($candle);
        break;
    }
}

$xmlFile->save('bundle.xml');
header('location: index.php');
?>