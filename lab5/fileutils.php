<?php

$xmlFile = new DOMDocument();
$rc = $xmlFile->load('bundle.xml');
if (!$rc) {
    echo '<h1>Can not open file';
    exit();
}

$bundle = $xmlFile->getElementsByTagName('candle');

function createElement($name, $price, $desc) {
    global $xmlFile, $bundle;

    $element = $xmlFile->createElement('candle');

    $id_at = $xmlFile->createAttribute('id');
    $lastIdx = 0;
    if ($bundle->count()) {
        $lastIdx = $bundle->item($bundle->count() - 1)->getAttribute('id');
    }
    $id_at->value = $lastIdx + 1;

    $name_at = $xmlFile->createAttribute('name');
    $name_at->value = $name;

    $price_at = $xmlFile->createAttribute('price');
    $price_at->value = $price;

    $desc_at = $xmlFile->createAttribute('desc');
    $desc_at->value = $desc;

    $element->appendChild($id_at);
    $element->appendChild($name_at);
    $element->appendChild($price_at);
    $element->appendChild($desc_at);

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