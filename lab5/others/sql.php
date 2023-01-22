<?php

include_once "interface.php";

    class Candledb{

        public $connection = null;

        function __construct($userName = 'Nick', $password = '12345', $dataBase = 'Candles'){

            $this->connection = mysqli_connect('127.0.0.1', $userName, $password, $dataBase);

            if(!$this->connection){
                echo 'Failed to connect! <br>';
                echo mysqli_connect_error();
                exit();
            }
        }
    }


    class sql_access implements InterfaceDao {

        public $database = null;

        function __construct(Candledb $dataBase){
            $this->dataBase = $dataBase->connection;
        }

        function getAll(){
            $array_for_func = array();
            $sql = "SELECT * FROM `bundles`";
            $cursor = mysqli_query($this->dataBase, $sql);
            while(($record = mysqli_fetch_assoc($cursor))) {
                $array_for_func[] = new Candle( $record['id'], $record['name'], $record['price'], $record['description'] );
            }
            return $array_for_func;
        }

        function getRecordById($id){
            $sql = "SELECT * FROM `bundles` WHERE id = $id";
            $cursor = mysqli_query($this->dataBase, $sql);
            if(mysqli_num_rows($cursor) == 0){
                echo "Not found record with id = $id";
                return null;
            }
            $record = mysqli_fetch_assoc($cursor);
            return new Candle( $record['id'], $record['name'], $record['price'], $record['description'] );
        }

        function insert($record){
            $sql = "INSERT INTO `bundles`(`name`, `price`, `description`) VALUES ('$record->name','$record->price','$record->description')";
            $cursor = mysqli_query($this->dataBase, $sql);
        }

        function update($record){
            $sql = "UPDATE `bundles` SET `name`='$record->name',`price`='$record->price',`description`='$record->description' WHERE id = $record->id";
            $cursor = mysqli_query($this->dataBase, $sql);
        }

        function delete($id){
            $sql = "DELETE FROM `bundles` WHERE id = $id";
            $cursor = mysqli_query($this->dataBase, $sql);
        }
    }
?>