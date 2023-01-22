<?php


$xmlFile = new DOMDocument();
$rc = $xmlFile->load('bundle.xml');
if (!$rc) {
    echo '<h1>Can not open file';
    exit();
}


$bundle = $xmlFile->getElementsByTagName('candle');


function createElement($name, $price, $description) {
    global $xmlFile, $bundle;
    $element = $xmlFile->createElement('candle');

    $idAttr = $xmlFile->createAttribute('id');
    $lastIdx = 0;
    if ($bundle->count()) {
        $lastIdx = $bundle->item($bundle->count() - 1)->getAttribute('id');
    }
    $idAttr->value = $lastIdx + 1;

    $nameAttr = $xmlFile->createAttribute('name');
    $nameAttr->value = $name;

    $priceAttr = $xmlFile->createAttribute('price');
    $priceAttr->value = $price;

    $descAttr = $xmlFile->createAttribute('description');
    $descAttr->value = $description;

    $element->appendChild($idAttr);
    $element->appendChild($nameAttr);
    $element->appendChild($priceAttr);
    $element->appendChild($descAttr);

    $element->setIdAttribute('id', true);
    return $element;
}


function addRecordToXML($name, $price, $description) {
    global $xmlFile;

    $xmlFile->formatOutput = true;
    $root = $xmlFile->getElementsByTagName('bundle')->item(0);
    $element = createElement($name, $price, $description);

    $root->appendChild($element);
    $xmlFile->save('bundle.xml');
    return true;
}


function updateRecordToXML($oldNode, $name, $price, $description) {
    global $xmlFile;

    $xmlFile->formatOutput = true;
    $root = $xmlFile->getElementsByTagName('bundle')->item(0);
    $element = createElement($name, $price, $description);

    $root->replaceChild($element, $oldNode);
    $xmlFile->save('bundle.xml');
    return true;
}
?>