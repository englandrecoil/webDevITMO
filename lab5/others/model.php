<?php
    class Candle {
        public $id;
        public $name;
        public $price;
        public $description;

        function __construct($id = 0, $name = "", $price = "", $description = "") {
            $this->id = $id;
            $this->name = $name;
            $this->price = $price;
            $this->description = $description;
        }
    }
?>