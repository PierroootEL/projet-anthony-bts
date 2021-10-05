<?php

    if(session_status() == PHP_SESSION_ACTIVE){
        /** Déclenchement de la déconnexion */
        session_start();
        unset($_SESSION['username']);
        session_destroy();
        header('Location: login.php');
    }else{
        session_start();
        $_SESSION['username'] = 'default';
        unset($_SESSION['username']);
        session_destroy();
        header('Location: login.php');
    }

?>