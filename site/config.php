<?php

$Host = "localhost"; 
$User = "sannaCristin"; 
$Password = "criceto846"; 
$db = "amm14_sannaCristin";


$conn = mysqli_connect($Host, $User, $Password); //Effettua la connessione.
$r = mysqli_select_db($conn, $db); //Seleziona il database.
?>