<!DOCTYPE> 
<html>
    <head>               

        <meta http-equiv="Content-type" content="text/html; charset=iso-8859-1" />
        <meta http-equiv="Content-Language" content="it" /> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

        <title>Videoteca Online</title>
        <link href="style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>

        <div id="telaio">
            <div id="testata"><center><h1>Videoteca Online</h1> </div> 
            <div id="sinistro"> <center>
                    <h2>- <a href="index.php">Home</a><br>
                        - <a href="film.php">Lista Film</h2></a><br> </center>
                <br>
                <?php
                $livello = 0;
                $user2 = 0;

                if (isset($_SESSION['ID'])) {
                    $livello = $_SESSION['LIV'];
                    $user2 = $_SESSION['ID'];
                    $nomeu = $_SESSION['USER'];
                    if ($livello > 1) {
                        print("<H3>Admin loggato</H3>");
                        print("<a href=\"aggiungi_film.php\">Aggiungi FILM</a><br>");
                        print("<a href=\"prenotazioni.php\">Lista prenotazioni</a><br>");
                        print("<a href=\"utenti.php\">Lista utenti</a><br>");
                    } else {
                        print("<H3>$nomeu loggato</H3>");
                        print("<a href=\"prenotazioni.php\">Le mie prenotazioni</a><br>");
                    }
                    print("<A href=\"logout.php\">Esci</a>");
                } ELSE {
                    ?>
                    <form action="login.php" method="post">
                        <table align="center"><tr>
                            <tr align="right"><td><font size="4">User</font></td><td> <input type="text" name="user" size="10"></td>
                            <tr><td><font size="4">Password</font></td><td> <input type="password" name="password" size="10"> </td>
                        </table><center><button type="submit"> ACCEDI  </button> </center>
                    </form>
                    <br> Oppure <a href="registrazione.php">Registrati</a>
                <?php }
                ?>
            </div>
            <div id="centrale">

