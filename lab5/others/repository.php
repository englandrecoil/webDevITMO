<?php
include_once "interface.php";

    class Repository {
        private ?InterfaceDao $dao = null;

        function __construct(InterfaceDao $candleDao) {
            $this->dao = $candleDao;
        }

        public function getAll() {
            return $this->dao->getAll();
        }

        function getRecordById($id) {
            return $this->dao->getRecordById($id);
        }

        function insert($record) {
            $this->dao->insert($record);
        }

        function update($record) {
            $this->dao->update($record);
        }

        function delete($id) {
            $this->dao->delete($id);
        }
    }
?>