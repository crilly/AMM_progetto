<?php

session_start();
include("config.php");


include("header.php");


print("<font size=5 color=\"red\" style=\"bold\"> <br>Controllo dati inseriti: </font><br><br>");

$nome = $_POST['username'];
$password = $_POST['password'];



if ($nome == "" || $password == "") {
    print("Dati mancanti");
} else {


    $q_registrazione = "INSERT INTO utente(username,password,livello)
     VALUES ('$nome','$password',1)";
    $ris = mysqli_query($conn, $q_registrazione);



    if ($ris) {

        print("<font size=4 color=\"green\"> REGISTRATO, ora puoi loggare<br><br><br></font>");
    } else {
        print("<font size=4 color=\"red\">Errore, dati inseriti in maniera errata, riprovare.</font>");
    }
}

include("down.php");

