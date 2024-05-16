<?php
session_start();

    
    $id=$_GET["id"];
    $scorte = $_POST["scorteAggiunte"];

    $db = pg_connect("host=localhost port=5432 dbname=ecommerce user=simone password=biar") or die("Errore di connessione");
    $sql = 'SELECT * FROM prodotti WHERE id = $1';
    $query = pg_query_params($db, $sql, array($id));
    $result = pg_fetch_assoc($query);
?>
<!DOCTYPE html>
<meta charset="UTF-8">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/mobile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/script.js"></script>
    <title>Conferma Reinserisci</title>
</head>
<body>
<div class="wrapper">
    <div class="header">
        <img class="header_icon" src="../img/star.png">
        <b style="font-size: 15px;">L'E-COMMERCE CHE SOGNAVI</b>
        <img class="header_icon" src="../img/star.png">
    </div>
    <br>
    <div align="center">
        <a href="../index.php"><img class="logo_img" src="../img/2_new.png"></a>
    </div>
    <br>
    <div align="center">
        <form action="reinsert.php" method="post" class="register">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <input type="hidden" name="scorteAggiunte" value="<?php echo $scorte ?>">
            <br><br>
            <p style="font-size: 20px">Sicuro di voler aggiungere <b><?php echo $scorte ?></b> prodotti?</p>
            <br><br><br>
            <button class="ins_annuncio"><b>Aggiungi</b></button>
            <br><br>
        </form>
        <br><br>
    </div>
</div>
<footer>
    <div class="div_footer footer-grid-container">  
        <div class="footer-grid-item">
            <b>Servizio Clienti</b>
            <ul style="list-style-type: none; padding: 0; margin: 0;">
                <li>Centro Assistenza</li>
                <li>Contattaci</li>
                <li>FAQ</li>
                <li>Condizioni Generali</li>
                <li>Privacy</li>
            </ul>
        </div>
        <div class="footer-grid-item">
            <b>Paga Con</b><br><br>
            <img src="https://img.alicdn.com/tfs/TB1xcMWdEKF3KVjSZFEXXXExFXa-68-48.png" class="pay_icon">
            <img src="https://ae01.alicdn.com/kf/S7b20ce778ba44e60a062008c35e98b57M/216x144.png" class="pay_icon">
            <img src="https://ae01.alicdn.com/kf/S91ee3e0f4fde4535aad35f7c30f6bacfh/216x144.png" class="pay_icon">
            <img src="https://ae01.alicdn.com/kf/S173da9e53a234dcb9795cebd1856c4d7J/216x144.png" class="pay_icon">
            <img src="https://ae01.alicdn.com/kf/S8df1a1d99c8049d1b1a86c9a144719b6W/216x144.png" class="pay_icon"><br>
            <img style="margin-top: 5px;" src="https://ae01.alicdn.com/kf/S0321450614244c4dafba2517560de3b8s/216x144.png" class="pay_icon">
            <img src="https://ae01.alicdn.com/kf/S2a5881f5906b4fb58a0c6da600ddf7bf1/216x144.png" class="pay_icon">
        </div>
        <div class="footer-grid-item">
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
</footer>
</body>
</html>