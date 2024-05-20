<?php

    session_start();

    unset($_SESSION["id"]);
    session_destroy();
    if (isset($_SESSION['previous_url'])) {
        header('Location: ' . $_SESSION['previous_url']);
    } else {
        header('Location: index.php');
    }
    
?>