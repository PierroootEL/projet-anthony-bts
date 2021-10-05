<?php

    @ini_set('display_errors', 'ON');

    if(isset($_GET['user'], $_GET['name_card'], $_GET['uuid'], $_GET['last_modif'], $_GET['type'], $_GET['value'])) {

        include_once $_SERVER['DOCUMENT_ROOT'] . '/arduino/assets/php/database.php';

        $dbh = new Database();
        $dbh->DBStart();
        $sql = $dbh->_conn->prepare('INSERT INTO arduino(user, name_card, uuid, last_modif, type, value) VALUES (?, ?, ?, ?, ?, ?)');
        $sql->bindValue(1, $_GET['user']);
        $sql->bindValue(2, $_GET['name_card']);
        $sql->bindValue(3, $_GET['uuid']);
        $sql->bindValue(4, $_GET['last_modif']);
        $sql->bindValue(5, $_GET['type']);
        $sql->bindValue(6, $_GET['value']);
        $sql->execute();

        echo "API executer avec succès";

    }else{
        die('Merci de remplir tous les champs');
    }


?>