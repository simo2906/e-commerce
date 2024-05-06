<?php
if ($_SERVER["REQUEST_METHOD"]!="POST"){
    header("Location: /");
}
else{
    $dbconn = pg_connect("host=localhost port=5432 dbname=Users user=postgres password=password") or die("Could not connect: " . pg_last_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head></head>
<body>
    <?php
        if($dbconn){
            $email = $_POST["inputEmail"];
            $q1 = "select * from utente where email=$1";
            $result = pg_query_params($dbconn, $q1, array($email));
            if(!($tuple = pg_fetch_array($result, null, PGSQL_ASSOC))){
                echo "<h1>Sembra che tu non sia registrato/a<h1>
                    <a href=../register/index.html> Clicca qui se vuoi farlo </a>";
            }
            else{
                $password = password_hash($_POST["inputPassword"], PASSWORD_DEFAULT);
                $q2 = "select * from utente where email = $1 and password = $2";
                $result = pg_query_params($dbconn, $q2, array($email, $password));
                if (!($tuple = pg_fetch_array($result, null, PGSQL_ASSOC))){
                    echo "<h1>La password non è corretta <h1>
                        <a href=login.html>Clicca qui per accedere </a>";
                }
                else{
                    header("Location: ../index.html");
                }
            }
        }
    ?>
</body>
</html>