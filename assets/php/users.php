<?php

    class Users{
        public $_username;
        private $_password;

        private function GetInfos(){
            $this->_username = htmlspecialchars($_POST['username']);
            $this->_password = htmlspecialchars($_POST['password']);
        }

        /** PARTIE REGISTER */

        private function CheckAccountForRegistration(){
            $this->GetInfos();
            include_once $_SERVER['DOCUMENT_ROOT'] . '/arduino/assets/php/database.php';
            $dbh = new Database();
            $dbh->DBStart();
            /** Vérification que le compte n'existe pas */
            $sql = $dbh->_conn->prepare('SELECT username FROM users WHERE username = ?');
            $sql->bindValue(1, $this->_username);
            $sql->execute();
            if($sql->rowCount() == 0){
                return true;
            }else{
                return false;
            }
            $dbh->DBClose();
        }

        private function CreateAccountForRegistration(){
            if($this->CheckAccountForRegistration()){
                include_once $_SERVER['DOCUMENT_ROOT'] . '/arduino/assets/php/database.php';
                $dbh = new Database();
                $dbh->DBStart();
                /** Insertion du compte dans la base de donnée */
                $sql = $dbh->_conn->prepare('INSERT INTO users(username, password, perm) VALUES (?, ?, ?)');
                $sql->bindValue(1, $this->_username);
                include_once $_SERVER['DOCUMENT_ROOT'] . '/arduino/assets/lib/password.php';
                $hashed_password = password_hash($this->_password, PASSWORD_BCRYPT, array("cost" => 12));
                $sql->bindValue(2, $hashed_password);
                $sql->bindValue(3, 0);
                if($sql->execute()){
                    header('Location: login.php');
                }else{
                    header('Location: register.php?info=2');
                }
                $dbh->DBClose();
            }
        }

        public function Register(){
            $this->CreateAccountForRegistration();
        }


        /** PARTIE LOGIN */

        private function SessionStartForLogin($fetch){
            session_start();
            $_SESSION['username'] = $fetch['username'];
            $_SESSION['perm'] = $fetch['perm'];
            header('Location: index.php');
        }

        private function CheckAccountForLogin(){
            $this->GetInfos();
            include_once $_SERVER['DOCUMENT_ROOT'] . '/arduino/assets/php/database.php';
            $dbh = new Database();
            $dbh->DBStart();
            $sql = $dbh->_conn->prepare('SELECT username FROM users WHERE username = ?');
            $sql->bindValue(1, $this->_username);
            if($sql->execute()){
                if($sql->rowCount() == 1){
                    /** Login Vérif MDP */
                    $sql = $dbh->_conn->prepare('SELECT username, password, perm FROM users WHERE username = ?');
                    $sql->bindValue(1, $this->_username);
                    $sql->execute();
                    $fetch = $sql->fetch();
                    if(password_verify($this->_password, $fetch['password'])){
                        /** Démarrage de session et redirection */
                        $this->SessionStartForLogin($fetch);
                    }else{
                        header('Location: login.php?info=1');
                    }
                }else{
                    header('Location: login.php?info=2');
                }
            }else{
                die('Erreur tierse');
            }

        }

        public function Login(){
            $this->CheckAccountForLogin();
        }

    }

?>