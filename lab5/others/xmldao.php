<?php
include_once "model.php";
include_once "interface.php";

    class XMLFile {
        public ?DOMDocument $doc = null;
        private $fileName;

        function __construct($fileName) {
            $this->doc = new DOMDocument();
            $rc = $this->doc->load($fileName);

            if (!$rc) {
                echo "Can't open this file";
                exit();
            }

            $this->fileName = $fileName;
        }

        function save() {
            $this->doc->save($this->fileName);
        }
    }

    //////////////////////////////////////////////////
    class XMLFileDao implements InterfaceDao {
        private ?XMLFile $xmlFile = null;
        private ?DOMDocument $xmlDoc = null;
        private $rootNode;

        function __construct($xmlFile) {
            $this->xmlFile = $xmlFile;
            $this->xmlDoc = $xmlFile->doc;
            $this->rootNode = $this->xmlDoc->getElementsByTagName('bundle')->item(0);
            $this->xmlFile->formatOutput = true;
        }

        public function getAll() {
            $array_for_func = array();

            $candles = $this->xmlDoc->getElementsByTagName('candle');
            foreach ($candles as $candle) {
                 $array_for_func[] = new Candle(
                    $candle->getAttribute('id'),
                    $candle->getAttribute('name'),
                    $candle->getAttribute('price'),
                    $candle->getAttribute('description')
                 );
            }
            return $array_for_func;
        }

        function getRecordById($id) {
            $element = $this->getElementById($id);
            if ($element) {
                return new Candle(
                    $element->getAttribute('id'),
                    $element->getAttribute('name'),
                    $element->getAttribute('price'),
                    $element->getAttribute('description')
                );
            }
            return null;
        }

        function insert($record) {
            $element = $this->createElement(
                $record->name,
                $record->price,
                $record->description,
            );

            $this->rootNode->appendChild($element);
            $this->xmlFile->save();
        }

        function update($record) {
            $oldElement = $this->getElementById($record->id);
            $newElement = $this->createElement($record->name, $record->price, $record->description);

            $this->rootNode->replaceChild($newElement, $oldElement);
            $this->xmlFile->save();
        }

        function delete($id) {
            $element = $this->getElementById($id);
            $this->rootNode->removeChild($element);
            $this->xmlFile->save();
        }

        //////////////////////////////////////////////////////////////////////////
        private function createElement($name, $price, $description) {
            $candles = $this->xmlDoc->getElementsByTagName('candle');
            $element = $this->xmlDoc->createElement('candle');

            $id_at = $this->xmlDoc->createAttribute('id');
            $lastIdx = 0;
            if ($candles->count()) {
             $lastIdx = $candles->item($candles->count() - 1)->getAttribute('id');
            }
            $id_at->value = $lastIdx + 1;

            $name_at = $this->xmlDoc->createAttribute('name');
            $name_at->value = $name;

            $price_at = $this->xmlDoc->createAttribute('price');
            $price_at->value = $price;

            $desc_at = $this->xmlDoc->createAttribute('description');
            $desc_at->value = $description;

            $element->appendChild($id_at);
            $element->appendChild($name_at);
            $element->appendChild($price_at);
            $element->appendChild($desc_at);

            $element->setIdAttribute('id', true);
            return $element;
         }

         private function getElementById($id) {
             $root = $this->xmlFile->doc->getElementsByTagName('bundle');
             $candles = $this->xmlFile->doc->getElementsByTagName('candle');

             $retRecord = null;
             foreach ($candles as $candle) {
                 if($candle->getAttribute('id') == $id) {
                     $retRecord = $candle;
                     break;
                 }
             }
             return $retRecord;
         }
    }
?>