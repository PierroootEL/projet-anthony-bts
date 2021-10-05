<?php

    class Arduino{

        public function ArduinoRowCount(){
            include_once $_SERVER['DOCUMENT_ROOT'] . '/arduino/assets/php/database.php';
            $dbh = new Database();
            $dbh->DBStart();
            $sql = $dbh->_conn->prepare('SELECT id FROM arduino');
            $sql->execute();
            $row = $sql->rowCount();
            return $row;
        }

        public function ArduinoLastRefresh(){
            include_once $_SERVER['DOCUMENT_ROOT'] . '/arduino/assets/php/database.php';
            $dbh = new Database();
            $dbh->DBStart();
            $sql = $dbh->_conn->prepare('SELECT last_modif FROM  arduino ORDER BY last_modif DESC LIMIT 1');
            $sql->execute();
            $last = $sql->fetch();
            return $last;
        }
    }

?>