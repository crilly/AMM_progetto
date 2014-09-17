<?php

session_start();
include("config.php");


include("header.php");

print("<center><font size=5 color=\"red\" style=\"bold\"> <br>Controllo dati inseriti: </font><br><br><BR>");

$codicefilm = $_POST['Codice2'];

$giorno_n = $_POST["giorno_n"];
$mese_n = $_POST["mese_n"];
$anno_n = $_POST["anno_n"];
$data_n = "$anno_n-$mese_n-$giorno_n";

$giorno_a = $_POST["giorno_a"];
$mese_a = $_POST["mese_a"];
$anno_a = $_POST["anno_a"];
$data_a = "$anno_a-$mese_a-$giorno_a";


//  print("$codicefilm,$user2");

$q_2 = "INSERT INTO noleggio (id_film,id_cliente,inizio_noleggio,fine_noleggio)      
      values ($codicefilm,$user2,'$data_n','$data_a');";
$ris2 = mysqli_query($conn, $q_2);

if ($ris2) {
    Print("Prenotazione effettuata");
} else {
    print("errore");
}






include("down.php");
