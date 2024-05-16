<?php
session_start();

$_SESSION['previous_url'] = '../index.php';

if(!isset($_SESSION["id"])) header("Location: ./login/login.php");
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
    <title>I Miei Annunci</title>
</head>
<body>
<div class="wrapper">
    <div class="header" align="center">
        <img class="header_icon" src="./img/star.png">
        <b style="font-size: 15px;">L'E-COMMERCE CHE SOGNAVI</b>
        <img class="header_icon" src="./img/star.png">
    </div>
    <div class="login_bar first-grid">
        <div align="center" class="first-grid-item">
            <a class="login_link" href="index.php"><img class="logo_img" style="size: 80%" src="./img/2_new.png"></a>
        </div>
        <div align="center" class="first-grid-item">
            <a class="ins_annuncio_text" href="insert_ad.php">
                <button class="ins_annuncio">
                    <img class="icon" style="vertical-align: center;" src="./img/plus.png">
                    <b style="font-size: 20px;">Inserisci annuncio</b>
                </button>
            </a>
        </div>

        <?php
            $db = pg_connect("host=localhost port=5432 dbname=ecommerce user=simone password=biar") or die("Errore di connessione");
            $sql = "SELECT * from utenti where id = $1";
            $query = pg_query_params($db, $sql, array($_SESSION["id"]));
            $result = pg_fetch_assoc($query);
        ?>

        <div align="center" class="first-grid-item">
        
            <div align="left" class="dropdown">
                <div style="margin: 15px;">
                    <a style="text-decoration: none; color: black;" href="myaccount.php">
                        <img class="icon" src="./img/user.png">
                        <b>Ciao <span style="color: #fa5f5a;"><?php echo ucfirst($result["nome"]) ?></span> <img class=icon src="./img/down.png"></b>
                    </a>
                </div>
                <div class="dropdown-content">
                    <a href="favourites-product.php">
                        <div>
                            <img class="dropdown-icon" src="./img/love.png">
                            Preferiti
                        </div>
                    </a>
                    <a href="mypurchase.php">
                        <div>
                            <img class="dropdown-icon" src="./img/carrello.png">
                            I Miei Acquisti
                        </div>
                    </a>
                    <a href="shop.php">
                        <div>
                            <img class="dropdown-icon" src="./img/message.png">
                            I Miei Annunci
                        </div>
                    </a>
                    <a href="./logout/logout.php">
                        <div>
                            <img class="dropdown-icon" src="./img/logout.png">
                            Esci
                        </div>
                    </a>
                </div>                
            </div>
        </div>
    </div>
    <b style="font-family: SuisseIntl-Medium, sans-serif; color: #fb9354; font-size: 30px; text-align: center; margin-top: 1%">I Miei Annunci</b>
    <div class="list-product">
        <?php

            $sql_prodotto='SELECT * from prodotti where utente = $1 order by id desc';
            $query_prodotto = pg_query_params($db, $sql_prodotto, array($_SESSION["id"]));
            while($result_prodotto = pg_fetch_assoc($query_prodotto)){
        ?>
        <div class="favourite-grid" style="border-radius: 1rem; border: 2px solid #fb9354">
            <div class="favourite-grid-item">
                <a href='single-product.php?id=<?php echo $result_prodotto["id"]?>'><img style="width: 25vh; height: 25vh; border-radius: 2rem; padding: 5%; object-fit: cover" src='./Annunci/<?php echo $result_prodotto["utente"] . "/" . $result_prodotto["id"] . "/" . $result_prodotto["picture1"] ?>'></a>
            </div>
            <div class="favourite-grid-item" style="margin-top: 2%">
                <div class="product-grid">
                    <div class="product-grid-item" align="left">
                        <a href='single-product.php?id=<?php echo $result_prodotto["id"]?>' class="login_link">
                            <b style="font-family: SuisseIntl-Medium, sans-serif; font-size: 25px"><?php echo ucwords($result_prodotto["nome"]) ?></b><br>
                        </a>
                        <b style="color: #A0A0A0; font-size: 16px; margin-bottom: 10px"><?php echo strtoupper($result_prodotto["categoria"]) ?></b><br>
                        <b style="font-size: 16px; margin-top: 10px"><img style="width: 20px; vertical-align: sub;" src="./img/maps.png"> <?php echo strtoupper($result_prodotto["comune"]) ?></b>
                        <br><br>
                        <b style="font-size: 25px; color: #fa5f5a;"><?php echo $result_prodotto["prezzo"] ?> €</b>
                    </div>
                    <div class="product-grid-item" align="right">
                        
                        <?php

                            if($result_prodotto["quantita"] > 0){

                        ?>
                        <form action="./refill/confirmRefill.php?id=<?php echo $result_prodotto["id"]?>" method="post" name="addForm" id="addForm">
                            <input type="number" placeholder="Quantità da aggiungere:" name="scorteDaAggiungere" min="0" class="input_log" style="margin-bottom: 2%; margin-right:15%; width: 80%"/>
                            <a class="ins_annuncio_text" style="margin-right: 15%;" href="#">
                                <button class="ins_annuncio" style="width: 80%; margin-bottom: 3%; background: linear-gradient(to right, #5170ff, #37b629);">
                                    <b style="font-size: 20px;">Aggiungi scorte</b>
                                </button>
                            </a>
                        </form>
                        <a class="ins_annuncio_text" style="margin-right: 15%; width: 30%" href="./remove/confirmRemove.php?id=<?php echo $result_prodotto["id"] ?>">
                            <button class="ins_annuncio" style="width: 80%;">
                                <b style="font-size: 20px;">Elimina annuncio</b>
                            </button>
                        </a>

                        <?php
                            } else {
                        ?>
                        
                        <div>
                        <br><br><br>
                            <form action="./reinsert/confirmReinsert.php?id=<?php echo $result_prodotto["id"]?>" method="post" name="reinsertForm" id="reinsertForm">
                                <input type="number" placeholder="Quantità da aggiungere:" min="0" name="scorteAggiunte" class="input_log" style="margin-bottom: 2%; margin-right:15%; width:80%"/>
                                <a class="ins_annuncio_text" style="margin-right: 15%;" href="#">
                                    <button class="ins_annuncio" style="width:80%">
                                        <b style="font-size: 20px;">Reinserisci annuncio</b>
                                    </button>
                                </a>
                            </form>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>  
        </div>
        <?php
            }
        ?>
        
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
            <img class="icon" src="./img/social/facebook.png">
            <img class="icon" src="./img/social/instagram.png">
            <img class="icon" src="./img/social/twitter.png">
            <img class="icon" src="./img/social/whatsapp.png">
            <img class="icon" src="./img/social/messenger.png"><br>
            <img style="margin-top: 5px;" class="icon" src="./img/social/tiktok.png">
            <img class="icon" src="./img/social/youtube.png">

        </div>
    </div>
</footer>
</body>
</html>