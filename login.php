<?php

    @ini_set('display_errors', 'ON');

    if(isset($_POST['login'])){
        include $_SERVER['DOCUMENT_ROOT'] . '/arduino/assets/php/users.php';
        $login = new Users();
        $login->Login();
    }

?>
<html lang="fr">
<head>
    <title>
        Se connecter | Arduino Dingo
    </title>
    <meta name="viewport" content="initial-scale=1.0, width=device-width">
    <meta charset="UTF8">
    <link rel="stylesheet" type="text/css" href="assets/css/acc.css">
</head>
<body>
    <div class="cont">
        <div class="demo">
            <div class="login">
                <div class="login__check"></div>
                <div class="login__form">
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="login__row">
                            <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                                <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
                            </svg>
                            <input type="text" class="login__input name" name="username" placeholder="Username"/>
                        </div>
                        <div class="login__row">
                            <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
                                <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
                            </svg>
                            <input type="password" class="login__input pass" name="password" placeholder="Password"/>
                        </div>
                        <button type="submit" name="login" class="login__submit">Se connecter</button>
                        <p class="login__signup">Vous n'avez pas de compte ? &nbsp;<a href="register.php">Créer le maintenant</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
