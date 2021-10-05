<?php

    session_start();

    include_once $_SERVER['DOCUMENT_ROOT'] . '/arduino/assets/php/database.php';

    $dbh = new Database();
    $dbh->DBStart();
    $sql = $dbh->_conn->prepare('SELECT * FROM arduino WHERE user = ?');
    $sql->bindValue(1, $_SESSION['username']);
    $sql->execute();
    $fetchAll = $sql->fetchAll();

?>
<html>
<head>
    <title>
        Vos arduinos | Arduino Dingo
    </title>
    <meta name="viewport" content="initial-scale=1.0, width=device-width">
    <meta charset="UTF8">
    <link rel="stylesheet" type="text/css" href="assets/css/arduino.css">
</head>
<body>
        <nav>
            <li><a href="index.php" >Accueil</a></li>
            <li><a href="pagearduino.php" >Voir les Arduinos </a></li>
            <li><a href="Profil.php">Profil</a></li>
            <li><a href="apropo.php">A propos</a></li>
            <li><a href="index.php#contact">Nous Contacter</a></li>
            <li><a href="disconnect.php">Se déconnecter</a></li>
        </nav>
    <div class="content">
        <div class="content-card">
            <?php foreach($fetchAll as $arduino){ ?>
                <div class="card">
                    <a>Nom de la carte : <?php echo $arduino['name_card']; ?></a>
                    <br>
                    <br>
                    <a>UUID : <?php echo $arduino['uuid']; ?></a>
                    <br>
                    <br>
                    <a>Date d'ajout : <?php echo $arduino['date_add']; ?></a>
                    <br>
                    <br>
                    <a>Dernière modif : <?php echo $arduino['last_modif']; ?></a>
                    <br>
                    <br>
                    <a>Type : <?php echo $arduino['type']; ?></a>
                    <br>
                    <br>
                    <a>Valeur : <?php echo $arduino['value']; ?></a>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>