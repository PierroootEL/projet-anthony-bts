<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    /**  session_start();

    if(!isset($_SESSION['username'])){
        header('Location: login.php');
    } **/

    if(isset($_POST['password'])){
        $name = $_POST['username'];
        $email = $_POST['email'];

        include $_SERVER['DOCUMENT_ROOT'] . '/arduino/assets/php/database.php';

        $dbh = new Database();
        $dbh->DBStart();
        $sql = $dbh->_conn->prepare('SELECT * FROM users WHERE username = ?');
        $sql->bindValue(1, $name);
        $sql->execute();
        if($sql->rowCount() == 1){

        }else{
            header('Location: disconnect.php');
        }

        $rand = rand(11111111111111111, 99999999999999999);
        $sql = $dbh->_conn->prepare('INSERT INTO password(token, username, emailed_for) VALUES (?, ?, ?)');
        $sql->bindValue(1, $rand);
        $sql->bindValue(2, $name);
        $sql->bindValue(3, $email);
        $sql->execute();

        require 'vendor/autoload.php';

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = 'pro2.mail.ovh.net';                     //Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   //Enable SMTP authentication
            $mail->Username = 'info@pierre-blanchard.fr';                     //SMTP username
            $mail->Password = 'Vatorea9nsoncerodall!';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $mail->Port = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('info@pierre-blanchard.fr', 'No-Reply');
            $mail->addAddress($email, 'Utilisateur');     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Mot de passe oublié';
            $mail->Body = 'Changement de mot de passe <a href="http://176.174.178.73:44/arduino/password.php?token=' . $rand . '">cliquez-ici</a>';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }


?>
<html lang="fr">
<head>
    <title>
        Changer de mot de passe | Arduino Dingo
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
                        <input type="email" class="login__input name" name="email" placeholder="Email"/>
                    </div>
                    <button type="submit" name="password" class="login__submit">Créer son compte</button>
                    <p class="login__signup">Vous avez déjà un compte ? &nbsp;<a href="login.php">Connectez-vous</a></p>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
