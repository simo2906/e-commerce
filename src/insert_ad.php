<?php
session_start();

$_SESSION['previous_url'] = $_SERVER['REQUEST_URI'];

if(!isset($_SESSION["id"])){
    header("Location: ./login/login.php");
} 

if(strtolower($_SERVER['REQUEST_METHOD'])=='post'){
    $db = pg_connect("host=localhost port=5432 dbname=ecommerce user=simone password=biar") or die("Errore di connessione" . pg_last_error());
    $nome = pg_escape_string($db, strtolower($_POST["productTitle"]));
    $categoria = pg_escape_string($db, strtolower($_POST["productCategory"]));
    $prezzo = $_POST["productPrice"];
    $comune = pg_escape_string($db, strtolower($_POST["productMunicipality"]));
    $descrizione = pg_escape_string($db, strtolower($_POST["productDescription"]));
    $quantita = $_POST["productQuantity"];
    $tempFile1Path = $_FILES['fileToUpload1']['tmp_name'];
    $File1Name = pg_escape_string($_FILES['fileToUpload1']['name']);
    $tempFile2Path = $_FILES['fileToUpload2']['tmp_name'];
    $File2Name = pg_escape_string($_FILES['fileToUpload2']['name']);
    $tempFile3Path = $_FILES['fileToUpload3']['tmp_name'];
    $File3Name = pg_escape_string($_FILES['fileToUpload3']['name']);
    $tempFile4Path = $_FILES['fileToUpload4']['tmp_name'];
    $File4Name = pg_escape_string($_FILES['fileToUpload4']['name']);
    $tempFile5Path = $_FILES['fileToUpload5']['tmp_name'];
    $File5Name = pg_escape_string($_FILES['fileToUpload5']['name']);

    if(file_exists($tempFile1Path)) $File1 = '1-'. $File1Name;
    if(file_exists($tempFile2Path)) $File2 = '2-'. $File2Name;
    if(file_exists($tempFile3Path)) $File3 = '3-'. $File3Name;
    if(file_exists($tempFile4Path)) $File4 = '4-'. $File4Name;
    if(file_exists($tempFile5Path)) $File5 = '5-'. $File5Name;

    
    
    $sql = "INSERT INTO prodotti (utente, nome, categoria, prezzo, comune, descrizione, picture1, picture2, picture3, picture4, picture5, quantita) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12) returning *";
    $query = pg_query_params($db, $sql, array($_SESSION["id"], $nome, $categoria, $prezzo, $comune, $descrizione, $File1, $File2, $File3, $File4, $File5, $quantita)) or die(pg_last_error());
    if($query){
        $result = pg_fetch_assoc($query);

        $path = './Annunci/';

        if(!file_exists($path . $result["utente"])){
            mkdir($path . $result["utente"], 0777);
        }

        if(!file_exists($path . $result["utente"] . '/' . $result["id"])){
            mkdir($path . $result["utente"] . '/' . $result["id"], 0777);
        }

        if(file_exists($tempFile1Path)){
            move_uploaded_file($tempFile1Path, $path . $result["utente"] . '/' . $result["id"] . '/' . $File1);
        }

        if(file_exists($tempFile2Path)){
            move_uploaded_file($tempFile2Path, $path . $result["utente"] . '/' . $result["id"] . '/' . $File2);
        }

        if(file_exists($tempFile3Path)){
            move_uploaded_file($tempFile3Path, $path . $result["utente"] . '/' . $result["id"] . '/' . $File3);
        }

        if(file_exists($tempFile4Path)){
            move_uploaded_file($tempFile4Path, $path . $result["utente"] . '/' . $result["id"] . '/' . $File4);
        }

        if(file_exists($tempFile5Path)){
            move_uploaded_file($tempFile5Path, $path . $result["utente"] . '/' . $result["id"] . '/' . $File5);
        }

        header("Location: successInsert.html");
    }else{
        header("Location: insert_ad.php?id=error");
    }

    

}else{
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
<title>Inserisci annuncio</title>
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
            <form action="insert_ad.php" method="post" name="insertAd_form" class="insertAd" enctype="multipart/form-data" onsubmit="return valida_annuncio();">
                <br>
                <h3>Inserisci il tuo annuncio!</h3>
                <hr style="margin-top: 20px; margin-left: 3%; margin-right: 3%">
                <?php
                if(isset($_GET["id"]) && $_GET["id"] == 'error'){
                    
                    echo '<br><b>Errore inserimento annuncio</b>';
                }
                ?>
                <br><br>
                
                <input type="text" name="productTitle" placeholder="Titolo*" class="input_log">
                <br><br>
                <input type="text" name="productCategory" placeholder="Categoria*" class="input_log">
                <br><br>
                <input type="number" name="productPrice" placeholder="€ Prezzo*" class="input_log">
                <br><br>
                <input type="text" name="productMunicipality" placeholder="Comune*" class="input_log">
                <br><br>
                <input type="number" name="productquantity" placeholder="Quantità*" class="input_log">
                <br><br><br>
                <textarea name="productDescription" class="textarea_input" placeholder="Scrivi una breve descrizione del prodotto" ></textarea>
                <br><br><br>
                <b>Inserisci le immagini del prodotto</b>
                <br><br>
                <div align="center"class="container photo">
                    <div class="row" style="justify-content: center">                        
                         <div class="upload-container col-3 custom-auto-width-photo">
                             <div id="preview1"><b class="photo-icon">1</b></div>
                             <input type="file" name="fileToUpload1" id="fileToUpload1" accept="image/*" onchange="previewImage('preview1','fileToUpload1', 1)">
                        </div>
                        <div class="upload-container col-3 custom-auto-width-photo">
                            <div id="preview2"><b class="photo-icon">2</b></div>
                            <input type="file" name="fileToUpload2" id="fileToUpload2" accept="image/*" onchange="previewImage('preview2','fileToUpload2', 2)">
                        </div>
                        <div class="upload-container col-3 custom-auto-width-photo">
                            <div id="preview3"><b class="photo-icon">3</b></div>
                            <input type="file" name="fileToUpload3" id="fileToUpload3" accept="image/*" onchange="previewImage('preview3','fileToUpload3', 3)">
                        </div>
                    </div>
                </div>
                
                <div class="container">
                    <div class="row" style="justify-content: center">
                        <div class="col-3 custom-auto-width-photo upload-container">
                            <div id="preview4"><b class="photo-icon">4</b></div>
                            <input type="file" name="fileToUpload4" id="fileToUpload4" accept="image/*" onchange="previewImage('preview4','fileToUpload4', 4)">
                        </div>
                        <div class="col-3 custom-auto-width-photo upload-container">
                            <div id="preview5"><b class="photo-icon">5</b></div>
                            <input type="file" name="fileToUpload5" id="fileToUpload5" accept="image/*" onchange="previewImage('preview5','fileToUpload5', 5)">
                        </div>
                    </div>
                </div>
                <br><br>

                <button name="loginButton" type="submit" class="log_button"><b>Metti in vendita</b></button>
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
<?php

}

?>