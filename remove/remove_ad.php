<?php
    $id = $_GET["id"];
    
    $db = pg_connect("host=localhost port=5432 dbname=ecommerce user=simone password=biar") or die("Errore di connessione");
    $sql = 'DELETE from prodotti where id = $1';
    $query = pg_query_params($db, $sql, array($id));

    if($query){
        header("Location: successRemove.html");
    } else header("Location: errorRemove.html");
?>