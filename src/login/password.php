<?php
    if(strtolower($_SERVER['REQUEST_METHOD'])=='post'){
        $email = $_POST["email"];

        $db = pg_connect("host=localhost port=5432 dbname=ecommerce user=simone password=biar") or die("Errore di connessione" . pg_last_error());

        $sql = "SELECT * from utenti where email = $1";
        $query = pg_query_params($db, $sql, array($email));

        if(pg_num_rows($query) == 1){
            header("Location: password.php?id=success");
        } else header("Location: password.php?id=error");


    }
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/mobile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="../js/script.js"></script>
    <title>Registrazione avvenuta</title>
</head>
<body >
<div class="wrapper">
    <div class="header">
        <img class="header_icon" src="../img/star.png">
        <b style="font-size: 15px;">L'E-COMMERCE CHE SOGNAVI</b>
        <img class="header_icon" src="../img/star.png">
    </div>
    <div align="center">
        <br>
        <a href="../index.php"><img class="logo_img" src="../img/2_new.png"></a>
    </div>
    <br>
    <div align="center">
        <form action="password.php" method="post"class="register">
            <br><br>
            <h3>Inserire email</h3>
            <br>
            <input type="email" name="email" placeholder="Inserisci la tua mail" class="input_log">
            <br><br>
            <button type="submit" class="ins_annuncio"><b>Invia</b></button>
            <br><br>
            <?php
                if(isset($_GET["id"])){
                    if($_GET["id"] == 'success') echo '<b>Controlla l\'email per il reset password</b><br><br>';
                    else if($_GET["id"] == 'error') echo '<b>Email non presente nel sistema</b><br><br>';
                }

            ?>  
        </form>
    </div>
    <br><br>
</div>
<footer>
    <div class="div_footer">
        <br>
        <div class="row">
        <div class="col-lg-4 custom-auto-width">
            <b>Servizio Clienti</b>
            <ul style="list-style-type: none; padding: 0; margin: 0;">
                <li>Centro Assistenza</li>
                <li>Contattaci</li>
                <li>FAQ</li>
                <li>Condizioni Generali</li>
                <li>Privacy</li>
            </ul>
        </div>
        <div class="col-lg-4 custom-auto-width">
            <b>Paga Con</b><br><br>
            <img src="https://img.alicdn.com/tfs/TB1xcMWdEKF3KVjSZFEXXXExFXa-68-48.png" class="pay_icon">
            <img src="https://ae01.alicdn.com/kf/S7b20ce778ba44e60a062008c35e98b57M/216x144.png" class="pay_icon">
            <img src="https://ae01.alicdn.com/kf/S91ee3e0f4fde4535aad35f7c30f6bacfh/216x144.png" class="pay_icon">
        </div>
        <div class="col-lg-4 custom-auto-width ">
            <b>Scoprici sui Social</b><br><br>
            <img class="icon" src="../img/social/facebook.png">
            <img class="icon" src="../img/social/instagram.png">
            <img class="icon" src="../img/social/twitter.png">
            <img class="icon" src="../img/social/whatsapp.png">
            <img class="icon" src="../img/social/messenger.png"><br>
            <img style="margin-top: 5px;" class="icon" src="../img/social/tiktok.png">
            <img class="icon" src="../img/social/youtube.png">

        </div>
        </div>
    </div>
    <br>
</footer>
</body>
</html>