<?php
require_once "others/appcont.php";

$id = $_GET['id'];
$candle = $repos->getRecordById($id);

if (isset($_POST['submit'])) {
    $candle->name = $_POST['name'];
    $candle->price = $_POST['price'];
    $candle->description = $_POST['description'];
    $repos->update($candle);
    header('location: index.php');
}

?>

<form action="" method="post">
    <p><input type="text" name="name" placeholder="Наименование" value="<?= $candle->name ?>"/></p>
    <p><input type="text" name="price" placeholder="Цена" value="<?= $candle->price ?>"/></p>
    <p><input type="text" name="description" placeholder="Описание" value="<?= $candle->description ?>"/></p>
    <p><input type="submit" name="submit" /></p>
</form>