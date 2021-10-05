<?php

    session_start();

    if(!isset($_SESSION['username'])){
        header('Location: login.php');
    }

    if(isset($_SESSION['username'])){
?>
        <audio controls autoplay hidden style="visibility: hidden">
            <source src="arduino.mp3" type="audio/mp3">
        </audio>
<?php
    }

    include $_SERVER['DOCUMENT_ROOT'] . '/arduino/assets/php/arduino.php';

    $arduino = new Arduino();
    $nb_arduino = $arduino->ArduinoRowCount();
    $last_modif = $arduino->ArduinoLastRefresh();
    
?>
 <!DOCTYPE html>
<html lang="fr">

<head>
    <title>Accueil | Arduino Dingo</title>
    <meta charset="UTF-8">
    <title>Arduino Dingo</title>
    <link rel="stylesheet" href="assets/css/index.css">
</head>
<body>
    <header>
        <div class="main">
            <h1>Arduino Dingo</h1>
            <div class="trait">
            <h3>Devenez dingue de vos arduinos </h3>
            </div>
        </div>
    </header>
        <section class="side-bar">
            <nav>

                    <li><a href="pagearduino.php" >Voir les Arduinos </a></li>
                    <li><a href="Profil.php">Profil</a></li>
                    <li><a href="apropo.php">A propos</a></li>
                    <li><a href="#contact">Nous Contacter</a></li>
                    <li><a href="disconnect.php">Se déconnecter</a></li>
            </nav>
                <div class="info">
                    <div onclick="location.href='pagearduino.php'" id="nombre"><a> Nombre d'arduinos : <?php echo $nb_arduino; ?></a></div>
                    <div id="derniere"><p>Dernière remontée :<br> <?php echo $last_modif['last_modif']; ?><p></div>
                </div>

        </section>

    <footer>
        <h2 id="contact">Contactez-nous</h2>
        <form action="mailto:info@pierre-blanchard.fr" method="get" enctype="text/plain">
            <input type="text" name="name" placeholder="Nom">
            <input type="email" name="email" placeholder="Email">
            <textarea name="comments" placeholder="Votre message ici..."></textarea>
            <button type="submit" name="submit">Envoyer</button>
        </form>
    </footer>
</body>
</html>