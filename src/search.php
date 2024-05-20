<?php
session_start();

$_SESSION['previous_url'] = '../index.php';
$db = pg_connect("host=localhost port=5432 dbname=ecommerce user=simone password=biar") or die("Errore di connessione" . pg_last_error());

$cosa_cerchi = strtolower($_POST["cosaCerchi"]);
$categoria = strtolower($_POST["categoria"]);
$dove_cerchi = strtolower($_POST["doveCerchi"]);

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
    <title>Search</title>
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
                <a class="login_link" href="index.php"><img class="logo_img" src="./img/2_new.png"></a>
            </div>
            <div class="col-12 col-lg-4">
                <a class="ins_annuncio_text" href="insert_ad.php">
                    <button class="ins_annuncio_header">
                        <img class="icon" style="vertical-align: center;" src="./img/plus.png">
                        <b style="font-size: 20px;">Inserisci annuncio</b>
                    </button>
                </a>
            </div>

            <?php

                if(isset($_SESSION["id"])){
                $sql_utenti = "SELECT * from utenti where id = $1";
                $query_utenti = pg_query_params($db, $sql_utenti, array($_SESSION["id"]));
                $result_utenti = pg_fetch_assoc($query_utenti);

            ?>

            <div align="center" id="accedi" class="col-12 col-lg-4">
                
                <div align="left" class="dropdown">
                    <div id="dropdown">
                        <a style="text-decoration: none; color: black;">
                            <img class="icon" src="./img/user.png">
                            <b>Ciao <span style="color: #fa5f5a;"><?php echo ucfirst($result_utenti["nome"]) ?></span> <img class=icon src="./img/down.png"></b>
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

            <?php

                } else {

            ?>  

            <div align="center" id="accedi" class="col-12 col-lg-4">
                <a href="./login/login.php"><img class="icon" src="./img/login.png"></a>
                <a class="login_link" href="./login/login.php"><b>Accedi</b></a>
                <a class="reg_link" href="./register/register.php"><b>Registrati</b></a>
            </div>

            <?php

                }

            ?>
        </div>
    </div>
    <b style="font-family: SuisseIntl-Medium, sans-serif; color: #fb9354; font-size: 30px; text-align: center; margin-top: 1%">Risultati</b>
    <div align="center">    
        <div class="list-product">
            <?php

                $sql_prodotto="SELECT * from prodotti where quantita > 0 and nome LIKE '%" . $cosa_cerchi ."%' and categoria LIKE '%" . $categoria ."%' and comune LIKE '%" . $dove_cerchi ."%' order by id desc";
                $query_prodotto = pg_query($db, $sql_prodotto);
                while($result_prodotto = pg_fetch_assoc($query_prodotto)){
            ?>
            <div class="row" style="border-radius: 1rem; border: 2px solid #fb9354">
                <div class="col custom-auto-width" style="position: relative">
                    <a href='single-product.php?id=<?php echo $result_prodotto["id"]?>'><img style="border-radius: 2rem; padding: 5%; object-fit: cover" class="img-fluid" src='./Annunci/<?php echo $result_prodotto["utente"] . "/" . $result_prodotto["id"] . "/" . $result_prodotto["picture1"] ?>'></a>
                    <?php
                        if(!isset($_SESSION["id"])){
                    ?>
                    <button class="overlay_button_pref"><img id="preferito" data-id-prod='<?php echo $result["id"] ?>' class="icon" style="background-color: white; border-radius: 3rem" onclick="redirectToLogin()" src="./img/hearth.png"></button>
                    <?php
                        } else if($_SESSION["id"] == $result_prodotto["utente"]){
                        } else {
                            $sql_hearth = 'SELECT * from preferiti where utente = $1 and prodotto = $2';
                            $query_hearth = pg_query_params($db, $sql_hearth, array($_SESSION["id"], $result_prodotto["id"]));
                            if(!pg_fetch_assoc($query_hearth)){
                    ?>
                    <button class="overlay_button_pref"><img id="preferito" data-id-prod='<?php echo $result["id"] ?>' class="icon" style="background-color: white; border-radius: 3rem" onclick="cambiaImmagine(this)" src="./img/hearth.png"></button>
                    <?php
                            } else {
                    ?>
                    <button class="overlay_button_pref"><img id="preferito" data-id-prod='<?php echo $result["id"] ?>' class="icon" style="background-color: white; border-radius: 3rem" onclick="cambiaImmagine(this)" src="./img/hearth_black.png"></button>
                    <?php
                            }
                        }
                    ?>
                </div>
                <div class="col" style="margin-top: 2%">
                    <div class="row">
                        <div class="col-12 custom-auto-width align_product">
                            <a href='single-product.php?id=<?php echo $result_prodotto["id"]?>' class="login_link">
                                <b style="font-family: SuisseIntl-Medium, sans-serif; font-size: 25px"><?php echo ucwords($result_prodotto["nome"]) ?></b><br>
                            </a>
                            <b style="color: #A0A0A0; font-size: 16px; margin-bottom: 10px"><?php echo strtoupper($result_prodotto["categoria"]) ?></b><br>
                            <b style="font-size: 16px; margin-top: 10px"><img style="width: 20px; vertical-align: sub;" src="./img/maps.png"> <?php echo strtoupper($result_prodotto["comune"]) ?></b>
                            <br><br>
                            <b style="font-size: 25px; color: #fa5f5a;"><?php echo $result_prodotto["prezzo"] ?> €</b>
                        </div>
                        <div class="col-12 custom-auto-width">
                        
                            <?php
                                if(!isset($_SESSION["id"])){ 
                                    
                            ?>
                                <a class="ins_annuncio_text button_annuncio" href="./login/login.php">
                                    <button class="ins_annuncio button_annuncio_2 acquista_button">
                                        <b style="font-size: 20px;">Acquista</b>
                                    </button>
                                </a>
                            <?php } else { ?>
                                <a class="ins_annuncio_text button_annuncio" href="#">
                                    <button class="ins_annuncio button_annuncio_2 acquista_button" data-id-prod="<?php echo $result['id']?>" data-id-costoArtic="<?php echo $result["prezzo"]?>" data-id-costoSped="0" onclick="apriPopup(this);">
                                        <b style="font-size: 20px;">Acquista</b>
                                    </button>
                                </a>
                            
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
<div class="transparent_layer" id="transparentDiv">
    <div align="center" class="buyPopup" id="acquistaPopup">
        <div class="popupHeader">
            <div class="popupHeader-item" align="left"><h2>Acquista subito!</h2></div>
            <div class="popupHeader-item" align="right"><img class="icon" src="./img/icons8-close-30.png" onclick=chiudiPopup()></div>
        </div>
        <div class="riepilogoOrdine">
            <div align="left"><h4>Riepilogo dell'ordine</h4></div>
            <div class="riepilogoBox">
                <br>
                <div class="riepilogo-grid-item">
                    <div align="left"><h6>Costo articolo</h6></div>
                    <div align="right"><h6 id="costoOggetto"></h6></div>
                </div>
                <div class="riepilogo-grid-item">
                    <div align="left"><h6>Costo spedizione</h6></div>
                    <div align="right"><h6 id="costoSpedizione"></h6></div>
                </div>
                <hr style="margin-top: 0px">
                <div class="riepilogo-grid-item">
                    <div align="left"><h6>Costo totale</h6></div>
                    <div align="right"><h6 id="costoTotale"></h6></div>
                </div>
            </div>
            <br>
        <div class="riepilogoBox">
            <br>
            <form action="#" method="post" name="confermaOrdine" id="confermaOrdine">
                <div>
                    <input type="text" style="width: 70%" id="indirizzoSped" placeholder="Inserisci il tuo indirizzo (Via/V.le/P.za)" class="input_log">
                    <input type="text" style="width: 20%" id="nCivSped" placeholder="N. Civico" class="input_log">
                </div>
                <div>
                    <input type="text" style="width: 20%" id="cittaSped" placeholder="Città" class="input_log">
                    <input type="text" style="width: 15%" id="provinciaSped" placeholder="Provincia" size=2 class="input_log">
                    <input type="text" style="width: 30%" id="paeseSped" placeholder="Nazione" class="input_log">
                    <input type="text" style="width: 25%" id="zipCodeSped" placeholder="Cod. Postale" class="input_log" size=5>
                </div>
                <br>
            </div>
            <br>
            <div class="riepilogoBox">
                <br>
                <form action="#" method="post" name="carteForm" id="pagamentoCarte">
                    <div>
                        <input type="text" style="width: 60%" id="numeroCarta" placeholder="Numero della carta" class="input_log">
                        <input type="text" style="width: 30%" id="dataScadenza" placeholder="MM/YY" class="input_log">
                    </div>
                    <div>
                        <input type="text" style="width: 60%" id="nomeTitolare" placeholder="Nome titolare" class="input_log">
                        <input type="password" style="width: 30%" id="CVV" placeholder="CVV" class="input_log">
                    </div>
                </form>
                <br>
            </div>
            <br>
            <button  onclick="controllaOrdine()" id="acquistaButton" class="ins_annuncio"><b>Acquista</b></button>
        </form>
        </div>
    </div>
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