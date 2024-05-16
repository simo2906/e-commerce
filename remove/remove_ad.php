<?php
    $id = $_POST["id"];
    
    $db = pg_connect("host=localhost port=5432 dbname=ecommerce user=simone password=biar") or die("Errore di connessione");
    $sql = 'UPDATE prodotti SET quantita = 0 where id = $1';
    $query = pg_query_params($db, $sql, array($id));

    if($query){
        header("Location: successRemove.html");
    } else header("Location: errorRemove.html");
?>