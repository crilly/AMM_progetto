<?php
session_start();
include("config.php");


include("header.php");
?>
<H1>INSERIMENTO FILM</H1> 
<form action="verifica_film.php" method="post">

    <center>
        <table align="center">
            <tr><td>Titolo :</td><td><input type="text" name="titolo"></td>
            <tr><td>Regista :</td><td><input type="text" name="regista"> </td>
            <tr><td>Anno :</td><td><input type="text" name="anno"> </td>
            <tr><td>Genere :</td><td><input type="text" name="genere"> </td>
            <tr><td>Prezzo :</td><td><input type="text" name="prezzo"> </td> 

        </table>


        <br>
        <button type="submit">
            Inserisci
        </button>
</form> 



<?php
include("down.php");

