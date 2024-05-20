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
    <div class="container header_container" align="center">
        <div class="login_bar row">
            <div class="col-12 col-lg-4">
                <a class="login_link" href="index.php"><img class="logo_img" style="size: 80%" src="./img/2_new.png"></a>
            </div>
            <div class="col-12 col-lg-4">
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

            <div align="center" class="col-12 col-lg-4">

                <div align="left" class="dropdown">
                    <div id="dropdown">
                            <a style="text-decoration: none; color: black;">
                                <img class="icon" src="./img/user.png">
                                <b>Ciao <span style="color: #fa5f5a;"><?php echo ucfirst($result["nome"]) ?></span> <img class=icon src="./img/down.png"></b>
                            </a>
                    </div>
                    <div class="dropdown-content">
                        <a href="myaccount.php">
                                <div>
                                    <img class="dropdown-icon" src="./img/user-dropdown.png">
                                    My Account
                                </div>
                            </a>
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
                        <a href="myad.php">
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
    </div>
    <b style="font-family: SuisseIntl-Medium, sans-serif; color: #fb9354; font-size: 30px; text-align: center; margin-top: 1%">I Miei Annunci</b><br>
    <div align="center">
        <div class="list-product">
            <?php

                $sql_prodotto='SELECT * from prodotti where utente = $1 order by id desc';
                $query_prodotto = pg_query_params($db, $sql_prodotto, array($_SESSION["id"]));
                while($result_prodotto = pg_fetch_assoc($query_prodotto)){
            ?>
            <div class="row" style="border-radius: 1rem; border: 2px solid #fb9354;">
                <div class="col custom-auto-width" align="center">
                    <a href='single-product.php?id=<?php echo $result_prodotto["id"]?>'><img style="border-radius: 2rem; padding: 5%; object-fit: cover" class="img-fluid" src='./Annunci/<?php echo $result_prodotto["utente"] . "/" . $result_prodotto["id"] . "/" . $result_prodotto["picture1"] ?>'></a>
                </div>
                <div class="col" style="margin-top: 2%">
                    <div class="row">
                        <div class="col align_product">
                            <a href='single-product.php?id=<?php echo $result_prodotto["id"]?>' class="login_link">
                                <b class="titolo" style="font-family: SuisseIntl-Medium, sans-serif;"><?php echo ucwords($result_prodotto["nome"]) ?></b><br>
                            </a>
                            <b class="categoria"><?php echo strtoupper($result_prodotto["categoria"]) ?></b><br>
                            <b class="comune"><img style="width: 20px; vertical-align: sub;" src="./img/maps.png"> <?php echo strtoupper($result_prodotto["comune"]) ?></b>
                            <br><br>
                            <b class="prezzo"><?php echo $result_prodotto["prezzo"] ?> €</b>
                        </div>
                        <div class="col custom-auto-width">

                            <?php

                                if($result_prodotto["quantita"] > 0){

                            ?>
                            
                                <div class="col custom-auto-width">
                                    <form action="./refill/confirmRefill.php?id=<?php echo $result_prodotto["id"]?>" method="post" name="addForm" id="addForm">    
                                        <input type="number" placeholder="Quantità da aggiungere:" name="scorteDaAggiungere" min="0" class="input_log" style="margin-bottom: 2%; width: 75%" required>
                                        <a class="ins_annuncio_text button_annuncio" href="#">
                                            <button class="ins_annuncio button_annuncio_2" style="width: 100%;">
                                                <b style="font-size: 20px;">Aggiungi scorte</b>
                                            </button>
                                        </a>
                                    </form>
                                
                                    <a class="ins_annuncio_text button_annuncio" href="./remove/confirmRemove.php?id=<?php echo $result_prodotto["id"] ?>">
                                        <button class="ins_annuncio button_annuncio_2 myad_button" style="width: 100%;">
                                            <b style="font-size: 20px;">Elimina</b>
                                        </button>
                                    </a>
                                </div>
                            
                                <?php
                                    } else {
                                ?>

                                <div align="bottom">
                                    <div class="col-12">
                                        <form action="./reinsert/confirmReinsert.php?id=<?php echo $result_prodotto["id"]?>" method="post" name="reinsertForm" id="reinsertForm">
                                            <input type="number" placeholder="Quantità da aggiungere:" min="0" name="scorteAggiunte" class="input_log" style="margin-bottom: 2%; width:75%"/>
                                            <a class="ins_annuncio_text button_annuncio" href="#">
                                                <button class="ins_annuncio button_annuncio_2" style="width:80%">
                                                    <b style="font-size: 20px;">Reinserisci annuncio</b>
                                                </button>
                                            </a>
                                        </form>
                                    </div>
                                </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>  
            </div>
            <br>
            <?php
                }
            ?>
        </div>
    </div>
</div>
<br>
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
            <img class="icon" src="./img/social/facebook.png">
            <img class="icon" src="./img/social/instagram.png">
            <img class="icon" src="./img/social/twitter.png">
            <img class="icon" src="./img/social/whatsapp.png">
            <img class="icon" src="./img/social/messenger.png"><br>
            <img style="margin-top: 5px;" class="icon" src="./img/social/tiktok.png">
            <img class="icon" src="./img/social/youtube.png">

        </div>
        </div>
    </div>
    <br>
</footer>
</body>
</html>