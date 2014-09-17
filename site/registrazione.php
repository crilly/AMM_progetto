<?php
session_start();
include("config.php");


include("header.php");
?>


<form action="verifica_registrazione.php" method="post">

    <font size="6">Registrazione</font> 
    <br> 
    <br>

    <table border=0 cellpadding=2" align="center">
        <tr><td>Username :</td><td><input type="text" name="username"></td>  
        <tr><td>Password :</td><td><input type="password" name="password"></td>

    </table>



    <button type="submit">
        REGISTRATI
    </button> 
</form>  
<?php
include("down.php");
