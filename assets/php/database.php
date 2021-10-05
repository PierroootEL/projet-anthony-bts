<?php

    @ini_set('display_errors', 'ON');

    class Database{
        const DB_HOST = 'localhost';
        const DB_NAME = 'arduino';
        const DB_USERNAME = 'admin';
        const DB_PASSWORD = 'admin';

        public $_conn;

        private function TestConnection(){
            try{
                new \PDO('mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME . ';charset=utf8mb4', self::DB_USERNAME, self::DB_PASSWORD);
                return true;
            }catch(PDOException $e){
                throw new PDOException($e->getMessage(), $e->getCode());
                return false;
            }
        }

        protected function DBConnection(){
            $this->_conn = new \PDO('mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME . ';charset=utf8mb4', self::DB_USERNAME, self::DB_PASSWORD);
        }

        public function DBStart(){
            if($this->TestConnection()){
                if($_SERVER['REQUEST_URI'] == '/arduino/assets/php/database.php'){
                    echo "Connection valide";
                }
                $this->DBConnection();
            }
        }

        public function DBStop(){
            $this->_conn = null;
        }

    }

?>