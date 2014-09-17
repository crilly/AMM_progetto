<?php

session_start();
include("config.php");


include("header.php");

$codice = $_GET['codice'];


$q_film2 = "DELETE from utente where ID=$codice";
$risultato2 = mysqli_query($conn, $q_film2);
print("<script> location.replace('utenti.php'); </script> ");



include("down.php");


