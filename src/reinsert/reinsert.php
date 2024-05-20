<?php
    $id = $_POST["id"];
    
    $db = pg_connect("host=localhost port=5432 dbname=ecommerce user=simone password=biar") or die("Errore di connessione");

    $sql = 'SELECT max(id) from prodotti';
    $query = pg_query($db, $sql);
    $result = pg_fetch_assoc($query);

    $id_max = $result["max"];
    $new_id = $id_max + 1;

    $sql = 'SELECT utente from prodotti where id = $1';
    $query = pg_query_params($db, $sql, array($id));
    $result = pg_fetch_assoc($query);

    rename('../Annunci/' . $result["utente"] . '/' . $id, '../Annunci/' . $result["utente"] . '/' . $new_id);

    $sql2 = 'UPDATE preferiti SET prodotto = $1 where prodotto = $2';
    $query2 = pg_query_params($db, $sql2, array($new_id, $id));

    $sql3 = 'UPDATE acquisti SET acquisto = $1 where acquisto = $2';
    $query3 = pg_query_params($db, $sql3, array($new_id, $id));
    

    $sql = 'UPDATE prodotti SET id = $1, quantita = $2 where id = $3';
    $query = pg_query_params($db, $sql, array($new_id, $_POST["scorteAggiunte"], $id));

    if($query){
        header("Location: successReinsert.html");
    } else header("Location: errorReinsert.html");
?>