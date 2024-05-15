<?php
    session_start();

    $_SESSION['previous_url'] = $_SERVER['REQUEST_URI'];

    $db = pg_connect("host=localhost port=5432 dbname=ecommerce user=simone password=biar") or die("Errore di connessione");
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/script.js"></script>
    <title>Babazon.it</title>

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

            if(isset($_SESSION["id"])){
                $sql = "SELECT * from utenti where id = $1";
                $query = pg_query_params($db, $sql, array($_SESSION["id"]));
                $result = pg_fetch_assoc($query);

        ?>

        <div align="center" class="first-grid-item">
        
            <div align="left" class="dropdown">
                <div style="margin: 15px;">
                    <a style="text-decoration: none; color: black;" href="#">
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
    <form action="" method="post" name="ricerca" id="ricerca" style="margin-top: 1%;">
        <div class="mycontainer second-grid" align="center">
            <div class="search second-grid-item">
                <label><b>Cerchi qualcosa?</b></label>
                <div class="search_bar">
                    <img class="category_img" src="./img/search-simbol.png">
                    <input class="input_text" type="text" name="cosaCerchi" placeholder="Vespa, motorino..">
                </div>
            </div>
            <div class="search second-grid-item">
                <label><b>Cosa cerchi?</b></label>
                <div class="search_bar">
                    <img class="category_img" src="./img/menu.png">
                    <input class="input_text" type="text" name="categoria" placeholder="Categoria">
                </div>
            </div>
            <div class="search second-grid-item">
                <label><b>Dove la cerchi?</b></label>
                <div class="search_bar">
                    <img class="category_img" src="./img/maps.png">
                    <input class="input_text" type="text" name="doveCerchi" placeholder="Comune, Provincia o Regione">
                </div>
            </div>
            <div class="second-grid-item">
                <input type="image" class="search_ico" src="./img/search2.png" id="imgSubmit">
            </div>
        </div> 
    </form>
    <div align="center" style="margin-top: 1%;">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" style="margin-top: 1%">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner" style="border-radius:0.375rem">
              <div class="carousel-item active" data-bs-interval="3000">
                <img src="./img/prova1.jpg" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="./img/prova2.jpg" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="./img/prova1.jpg" class="d-block w-100" alt="...">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
    </div>
    <div align="center" style="margin-top: 2%; margin-left: 10%; margin-right: 10%;">
        <b style="font-family: SuisseIntl-Medium, sans-serif; color: #fb9354; font-size: 30px">Ultimi Annunci</b>
    </div>
    <div align="center" style="margin-top: 2%;">
        <div class="product third-grid-container">
        <?php
            $sql = "SELECT * FROM prodotti ORDER BY id LIMIT 10";
            $query = pg_query_params($db, $sql, array());
            $counter=0;
            while($counter < 6 && $result = pg_fetch_assoc($query)){
                $counter++;
        ?>
            <div class="single_product third-grid-item">
                <div class="img_product">
                    <a href='single-product.php?id=<?php echo $result["id"]?>'><img width="100%" height="100%" style="border-radius: 2rem; padding: 5%;" src='./Annunci/<?php echo $result["utente"] . "/" . $result["id"] . "/" . $result["picture1"] ?>'></a>
                    <div class="overlay-container">
                        <?php
                            if(!isset($_SESSION["id"])){
                        ?>
                        <button class="overlay_button"><img id="preferito" data-id-prod='<?php echo $result["id"] ?>' class="icon" style="background-color: white; border-radius: 0.4rem" onclick="redirectToLogin()" src="./img/hearth.png"></button>
                        <?php
                            } else {
                                $sql_hearth = 'SELECT * from preferiti where utente = $1 and prodotto = $2';
                                $query_hearth = pg_query_params($db, $sql_hearth, array($_SESSION["id"], $result["id"]));
                                if(!pg_fetch_assoc($query_hearth)){
                        ?>
                        <button class="overlay_button"><img id="preferito" data-id-prod='<?php echo $result["id"] ?>' class="icon" style="background-color: white; border-radius: 3rem" onclick="cambiaImmagine(this)" src="./img/hearth.png"></button>
                        <?php
                                } else {
                        ?>
                        <button class="overlay_button"><img id="preferito" data-id-prod='<?php echo $result["id"] ?>' class="icon" style="background-color: white; border-radius: 3rem" onclick="cambiaImmagine(this)" src="./img/hearth_black.png"></button>
                        <?php
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="description_product" >
                    <a href="single-product.php?id=<?php echo $result["id"]?>" class="login_link">
                        <p class="product-title"><?php echo ucwords($result["nome"]) ?></p>
                        <p class="product-category"><?php echo ucwords($result["categoria"]) ?></p>
                        <p class="product-price"><?php echo "€" . $result["prezzo"] ?></p>
                    </a>
                </div>
            </div>
        <?php
        }
        ?>
        </div>
    </div>
    <div align="center" style="margin-top: 2%;">
        <div class="product third-grid-container">
        <?php
            while($counter < 12 && $result = pg_fetch_assoc($query)){
                $counter++;
        ?>
            <div class="single_product third-grid-item">
                <div class="img_product">
                    <a href='single-product.php?id=<?php echo $result["id"]?>'><img width="100%" height="100%" style="border-radius: 2rem; padding: 5%;" src='./Annunci/<?php echo $result["utente"] . "/" . $result["id"] . "/" . $result["picture1"] ?>'></a>
                    <div class="overlay-container">
                        <?php
                            if(!isset($_SESSION["id"])){
                        ?>
                        <button class="overlay_button"><img id="preferito" data-id-prod='<?php echo $result["id"] ?>' class="icon" style="background-color: white; border-radius: 3rem" onclick="redirectToLogin()" src="./img/hearth.png"></button>
                        <?php
                            } else {
                                $sql_hearth = 'SELECT * from preferiti where utente = $1 and prodotto = $2';
                                $query_hearth = pg_query_params($db, $sql_hearth, array($_SESSION["id"], $result["id"]));
                                if(!pg_fetch_assoc($query_hearth)){
                        ?>
                        <button class="overlay_button"><img id="preferito" data-id-prod='<?php echo $result["id"] ?>' class="icon" style="background-color: white; border-radius: 3rem" onclick="cambiaImmagine(this)" src="./img/hearth.png"></button>
                        <?php
                                } else {
                        ?>
                        <button class="overlay_button"><img id="preferito" data-id-prod='<?php echo $result["id"] ?>' class="icon" style="background-color: white; border-radius: 3rem" onclick="cambiaImmagine(this)" src="./img/hearth_black.png"></button>
                        <?php
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="description_product" >
                    <a href="single-product.php?id=<?php echo $result["id"]?>" class="login_link">
                        <p class="product-title"><?php echo ucwords($result["nome"]) ?></p>
                        <p class="product-category"><?php echo ucwords($result["categoria"]) ?></p>
                        <p class="product-price"><?php echo "€" . $result["prezzo"] ?></p>
                    </a>
                </div>
            </div>
        <?php
        }
        ?>
        </div>
    </div>
    <div align="center" style="margin-top: 2%">
        <div class="container-item">
            <img srcset="./img/prova3.webp" type="image/webp">
            <img srcset="./img/prova4.webp" type="image/webp">
        </div>
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