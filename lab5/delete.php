<?php
require_once "others/appcont.php";

$idToDelete = $_GET['id'];
$repos->delete($idToDelete);
header('location: index.php');
?>