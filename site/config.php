<?php 
    
    
   $Host="localhost"; //Nome Host.
$User="sannaCristin"; //Username PHP-MyAdmin.
$Password="criceto846"; //PassWord.
$db="amm14_sannaCristin"; //Nome DataBase.

/* $Host="localhost"; //Nome Host.
$User="admin"; //Username PHP-MyAdmin.
$Password="admin"; //PassWord.
$db="videoteca"; //Nome DataBase. */

$conn=mysqli_connect($Host,$User,$Password); //Effettua la connessione.
$r=mysqli_select_db($conn,$db); //Seleziona il database.
   
?>