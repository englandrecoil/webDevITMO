<?php
require_once "fileutils.php";

$id = $_GET['id'];
$element = null;
foreach ($bundle as $candle) {
    if($candle->getAttribute('id') == $id) {
        $element = $candle;
        break;
    }
}

if (isset($_POST['submit'])) {
    updateRecordToXML(
        $element,
        $_POST['name'],
        $_POST['price'],
        $_POST['description']
    );
    header('location: index.php');
}

?>

<form action="" method="post">
    <p><input type="text" name="name" placeholder="Наименование" value="<?= $element->getAttribute('name') ?>"/></p>
    <p><input type="text" name="price" placeholder="Цена" value="<?= $element->getAttribute('price') ?>"/></p>
    <p><input type="text" name="description" placeholder="Описание" value="<?= $element->getAttribute('description') ?>"/></p>
    <p><input type="submit" name="submit" /></p>
</form>