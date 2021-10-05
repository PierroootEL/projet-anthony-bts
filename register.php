<?php

    if(isset($_POST['register'])){
        include $_SERVER['DOCUMENT_ROOT'] . '/arduino/assets/php/users.php';
        $register = new Users();
        $register->Register();
    }

?>
<html lang="fr">
<head>
    <title>
        Créer son compte | Arduino Dingo
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
                        <button type="submit" name="register" class="login__submit">Créer son compte</button>
                        <p class="login__signup">Vous avez déjà un compte ? &nbsp;<a href="login.php">Connectez-vous</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

