<?php
    session_start();

    $id = $_GET["id"];

    $db = pg_connect("host=localhost port=5432 dbname=ecommerce user=simone password=biar") or die("Errore di connessione" . pg_last_error());
    $sql = "SELECT * from prodotti where id = $1";
    $query = pg_query_params($db, $sql, array($id));
    $result = pg_fetch_assoc($query);
    
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
    <title>Prodotto</title>
</head>

<style>
    
</style>
<body>
<div class="wrapper">
        <div class="header">
            <img class="header_icon" src="../img/star.png">
            <b style="font-size: 15px;">L'E-COMMERCE CHE SOGNAVI</b>
            <img class="header_icon" src="../img/star.png">
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

            if(isset($_SESSION["id"])){
                $sql_utenti = "SELECT * from utenti where id = $1";
                $query_utenti = pg_query_params($db, $sql_utenti, array($_SESSION["id"]));
                $result_utenti = pg_fetch_assoc($query_utenti);

        ?>

        <div align="center" class="first-grid-item">
        
            <div align="left" class="dropdown">
                <div style="margin: 15px;">
                    <a style="text-decoration: none; color: black;" href="#">
                        <img class="icon" src="./img/user.png">
                        <b>Ciao <span style="color: #fa5f5a;"><?php echo ucfirst($result_utenti["nome"]) ?></span> <img class=icon src="./img/down.png"></b>
                    </a>
                </div>
                <div class="dropdown-content">
                    <a href="#">
                        <div>
                            <img class="dropdown-icon" src="./img/love.png">
                            Preferiti
                        </div>
                    </a>
                    <a href="#">
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

        <div align="right" class="first-grid-item">
            <a href="./login/login.php"><img class="icon" src="./img/login.png"></a>
            <a class="login_link" href="./login/login.php"><b>Accedi</b></a>
            <a class="reg_link" href="./register/register.php"><b>Registrati</b></a>
        </div>

        <?php

            }

        ?>
    </div>
    <br>
    <div class="product-grid">
        <div class="produt-grid-item" align="center">
            <div id="carouselExampleIndicators" class="carousel slide" >
              <div class="carousel-indicators">
                <?php
                    if($result["picture2"]){
                ?>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <?php
                    }
                    if($result["picture3"]){
                ?>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <?php
                    }
                    if($result["picture4"]){
                ?>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 4"></button>
                <?php
                    }
                    if($result["picture5"]){
                ?>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 5"></button>
                <?php
                    }
                ?>
              </div>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src='./Annunci/<?php echo $result["utente"] . "/" . $result["id"] . "/" . $result["picture1"] ?>' class="d-block w-100" alt="Immagine 1">
                </div>
                <?php
                    if($result["picture2"]){
                ?>
                <div class="carousel-item">
                  <img src='./Annunci/<?php echo $result["utente"] . "/" . $result["id"] . "/" . $result["picture2"] ?>' class="d-block w-100" alt="Immagine 2">
                </div>
                <?php
                    }
                    if($result["picture3"]){
                ?>
                <div class="carousel-item">
                  <img src='./Annunci/<?php echo $result["utente"] . "/" . $result["id"] . "/" . $result["picture3"] ?>' class="d-block w-100" alt="Immagine 2">
                </div>
                <?php
                    }
                    if($result["picture4"]){
                ?>
                <div class="carousel-item">
                  <img src='./Annunci/<?php echo $result["utente"] . "/" . $result["id"] . "/" . $result["picture4"] ?>' class="d-block w-100" alt="Immagine 2">
                </div>
                <?php
                    }
                    if($result["picture5"]){
                ?>
                <div class="carousel-item">
                  <img src='./Annunci/<?php echo $result["utente"] . "/" . $result["id"] . "/" . $result["picture5"] ?>' class="d-block w-100" alt="Immagine 2">
                </div>
                <?php
                    }
                ?>
              </div>
                <?php
                    if($result["picture2"] || $result["picture3"] || $result["picture4"] || $result["picture5"]){
                ?>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
                <?php
                    }
                ?>
            </div>
        </div>
        
        <div class="product-grid-item" >
            <div class="insert_Ad">
                <div class="product-grid">
                    <div class="product-grid-item" align="left">
                        <b style="background-color: #e8e8e8; padding: 6px;"><?php echo strtoupper($result["categoria"]) ?></b>
                    </div>
                    <div class="product-grid-item" align="right">
                        <img id="preferito" style="margin-right: 30%; width: 35px;" onclick="cambiaImmagine(id)" src="./img/hearth.png">
                    </div>
                </div>
            
                <hr style=" margin-right: 15%">               
                <div class="product-grid">
                    <div class="product-grid-item">    
                        <h2 style="text-align: left"><?php echo $result["nome"] ?></h2>
                        <br>
                        <b style="font-size: 20px"><img style="width: 25px; vertical-align: top;" src="./img/maps.png"> <?php echo strtoupper($result["comune"]) ?></b>
                        <br><br>
                        <h2 style="color: #fa5f5a;"><?php echo $result["prezzo"] ?> €</h2>
                        <br>
                        <div style="max-width: 40vh">
                            <p><?php echo $result["descrizione"] ?></p>
                        </div>
                    </div>

                    <div class="product-grid-item" align="center" style="margin-right: 30%">
                        <div class="user-product">
                            <img class="icon" src="./img/user (1).png">
                            <b><?php echo ucfirst($result_utenti["nome"]) . ' ' . ucfirst($result_utenti["cognome"]) ?></b>
                            <br><br>
                            <b>N.Tel: <?php echo $result_utenti["num_tel"] ?></b>
                        </div>
                        <br>
                        <a class="ins_annuncio_text" href="#">
                            <button class="ins_annuncio">
                                <b style="font-size: 20px;">Acquista</b>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<br>
<footer>
    <br>
    <div class="div_footer grid-container">  
        <div class="grid-item">
            <b>Servizio Clienti</b>
            <ul style="list-style-type: none; padding: 0; margin: 0;">
                <li>Centro Assistenza</li>
                <li>Contattaci</li>
                <li>FAQ</li>
                <li>Condizioni Generali</li>
                <li>Privacy</li>
            </ul>
        </div>
        <div class="grid-item">
            <b>Paga Con</b><br><br>
            <img src="https://img.alicdn.com/tfs/TB1xcMWdEKF3KVjSZFEXXXExFXa-68-48.png" class="pay_icon">
            <img src="https://ae01.alicdn.com/kf/S7b20ce778ba44e60a062008c35e98b57M/216x144.png" class="pay_icon">
            <img src="https://ae01.alicdn.com/kf/S91ee3e0f4fde4535aad35f7c30f6bacfh/216x144.png" class="pay_icon">
            <img src="https://ae01.alicdn.com/kf/S173da9e53a234dcb9795cebd1856c4d7J/216x144.png" class="pay_icon">
            <img src="https://ae01.alicdn.com/kf/S8df1a1d99c8049d1b1a86c9a144719b6W/216x144.png" class="pay_icon"><br>
            <img style="margin-top: 5px;" src="https://ae01.alicdn.com/kf/S0321450614244c4dafba2517560de3b8s/216x144.png" class="pay_icon">
            <img src="https://ae01.alicdn.com/kf/S2a5881f5906b4fb58a0c6da600ddf7bf1/216x144.png" class="pay_icon">
        </div>
        <div class="grid-item">
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