<?php
    session_start();

    if(strtolower($_SERVER['REQUEST_METHOD'])=='post'){

        $db = pg_connect("host=localhost port=5432 dbname=ecommerce user=simone password=biar") or die("Errore di connessione");
        $nome = strtolower($_POST['nome']);
        $cognome = strtolower($_POST['cognome']);
        $telefono = $_POST['telefono'];
        $email = strtolower($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $sql = "SELECT * FROM utenti where email = $1";
        $query = pg_query_params($db, $sql, array($email));
        if(pg_num_rows($query) > 0) die(header("Location: register.php?id=error"));
        
        $sql = "INSERT INTO utenti (nome, cognome, email, password, telefono) VALUES ($1, $2, $3, $4, $5)";
        $result = pg_query_params($db, $sql, array($nome, $cognome, $email, $password, $telefono));
        if ($result) {
            $sql = "SELECT * FROM utenti where email = $1";            
            $query = pg_query_params($db, $sql, array($email));
            $result = pg_fetch_assoc($query);
            $_SESSION["id"] = $result["id"];
            header("Location: success.html");
        } else {
            echo "Errore durante l'inserimento dei dati: " . pg_last_error();
        }

    } else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/mobile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="../js/script.js"></script>
    <title>Registrati</title>
   
</head>
<body>
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
    <div  align="center">
        <form action="register.php" method="post" name="register" class="register" onsubmit="return valida_registrazione();">
            <br>
            <h3>Registrati</h3>

            <hr style="margin-top: 20px; margin-left: 3%; margin-right: 3%">
            
            <?php
                if(isset($_GET["id"]) && $_GET["id"] == 'error'){
                    
                    echo '<br><b>Utente già registrato</b>';
                }
            ?>
            <br>
            <input type="text" name="nome" class="input_log" placeholder="Nome*">
            <br><br>
            <input type="text" name="cognome" class="input_log" placeholder="Cognome*">
            <br><br>
            <input type="tel" name="telefono" class="input_log" placeholder="Telefono*">
            <br><br>
            <input type="email" name="email" class="input_log" placeholder="Email*">
            <br><br>
            <input type="password" name="password" class="input_log" placeholder="Password*">
            <br><br>
            <input type="checkbox" name="checkbox"> Accetto termini e condizioni
            <br><br>
            <button type="submit" class="ins_annuncio"><b>Registrati</b></button>
            <br><br>
            Già registrato?
            <a href="../login/login.php" class="link_log">Effettua il login</a>
            <br><br>
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
<?php
    }
?>
</html>