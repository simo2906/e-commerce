<?php
    $id = $_POST["id"];
    
    $db = pg_connect("host=localhost port=5432 dbname=ecommerce user=simone password=biar") or die("Errore di connessione");

    $sql = 'UPDATE prodotti SET quantita = quantita + $1 where id = $2';
    $query = pg_query_params($db, $sql, array($_POST["scorteDaAggiungere"], $id));

    if($query){
        header("Location: successRefill.html");
    } else header("Location: errorRefill.html");
?>