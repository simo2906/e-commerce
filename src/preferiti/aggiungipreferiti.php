<?php
    session_start();

    if(isset($_POST["id_prod"])) {
        $id_prodotto = $_POST["id_prod"];
        
        $db = pg_connect("host=localhost port=5432 dbname=ecommerce user=simone password=biar") or die("Errore di connessione" . pg_last_error());
    
        $sql = 'INSERT INTO preferiti(utente, prodotto) VALUES ($1, $2)';
        $query = pg_query_params($db, $sql, array($_SESSION["id"], $id_prodotto));
    
        if($query) {
            echo "Prodotto aggiunto ai preferiti con successo!";
        } else {
            echo "Si è verificato un errore durante l'aggiunta del prodotto ai preferiti.";
        }
    
        pg_close($db);
    } else {
        echo "ID del prodotto non ricevuto.";
    }
?>