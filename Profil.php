<?php

    session_start();

    if(!isset($_SESSION['username'])){
        header('Location: index.php');
    }

    include $_SERVER['DOCUMENT_ROOT'] . '/arduino/assets/php/database.php';

    $dbh = new Database();
    $dbh->DBStart();
    $sql = $dbh->_conn->prepare('SELECT id, prenom, nom, perm, created_at FROM users WHERE username = ?');
    $sql->bindValue(1, $_SESSION['username']);
    $sql->execute();
    $fetch = $sql->fetch();
    $dbh->DBStop();

?>
<html>
    <head>
        <title>
            Profil | Arduino Dingo
        </title>
        <meta name="viewport" content="initial-scale=1.0, width=device-width">
        <meta charset="UTF8">
        <link rel="stylesheet" type="text/css" href="assets/css/profil.css">
        <link rel="stylesheet" href="assets/css/index.css">

    </head>

    <body>

    <section class="side-bar">
        <nav>
            <li><a href="index.php" >Accueil</a></li>
            <li><a href="pagearduino.php" >Voir les Arduinos </a></li>
            <li><a href="Profil.php">Profil</a></li>
            <li><a href="apropo.php">A propos</a></li>
            <li><a href="index.php#contact">Nous Contacter</a></li>
            <li><a href="disconnect.php">Se déconnecter</a></li>
        </nav>

        <div class="center">
            <div class="card">
                <div class="additional">
                    <div class="user-card">
                        <div class="points center">
                            <?php echo $fetch['id']; ?>
                        </div>
                        <img src="assets/img/arduino-logo.png" style="width: 80px; height: 80px; margin-top: 90px; margin-left: 35px; ">
                    </div>
                    <div class="more-info">
                        <h1><?php if($fetch['perm'] == 0){ echo 'Utilisateur'; }else{ echo 'Administrateur'; } ?></h1>
                        <div class="coords">
                            <span><?php echo $fetch['prenom']; ?></span>
                            <span><?php echo $fetch['nom']; ?></span>
                        </div>
                        <div class="coords">
                            <span><?php echo $_SESSION['username']; ?></span>
                            <span>St Etienne</span>
                        </div>
                        <div class="coords">
                            <span><a href="password.php">Changer le mot de passe</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>