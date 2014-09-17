<?php
session_start();
include("config.php");


include("header.php");

$codice = $_GET['codice'];
$q_film = "SELECT * from film where ID=$codice";
$risultato = mysqli_query($conn, $q_film);


if ($livello > 1) {

    $q_film2 = "DELETE from film where ID=$codice";
    $risultato2 = mysqli_query($conn, $q_film2);
    print("<script> location.replace('film.php'); </script> ");
} else {

    print("<h2>Prenota Film</h2> ");
    ?>

    <form action="verifica_prenotazione.php" method="post">
        <center>
            <table align="center">

                <?php print("<input type=\"HIDDEN\" value=$codice name=\"Codice2\">"); ?>


                <tr> <td>inizio prenotazione:</td>       
                    <td><select name="giorno_n">
                            <?php $dg = (date("d"));
                            echo("<option value=\"$dg\">$dg</option>");
                            for ($i = 1; $i <= 31; $i++) {
                                echo("<option value=\"$i\">$i</option>");
                            } ?>
                        </select>
                        <select name="mese_n">
    <?php $d2 = (date("m"));
    echo("<option value=\"$d2\">$d2</option>");
    for ($i = 1; $i <= 12; $i++) {
        echo("<option value=\"$i\">$i</option>");
    } ?>       
                        </select> 
                        <select name="anno_n">
                            <?php $d3 = (date("Y"));
                            echo("<option value=\"$d3\">$d3</option>");
                            for ($i = 2013; $i >= 1900; $i--) {
;
                                echo("<option value=\"$i\">$i</option>");
                            } ?>
                        </select></td>

                <tr> <td>fine prenotazione:</td>       
                    <td><select name="giorno_a">
    <?php $dg = (date("d"));
    echo("<option value=\"$dg\">$dg</option>");
    for ($i = 1; $i <= 31; $i++) {
        echo("<option value=\"$i\">$i</option>");
    } ?>
                        </select>
                        <select name="mese_a">
    <?php $d2 = (date("m"));
    echo("<option value=\"$d2\">$d2</option>");
    for ($i = 1; $i <= 12; $i++) {
        echo("<option value=\"$i\">$i</option>");
    } ?>       
                        </select> 
                        <select name="anno_a">
    <?php $d3 = (date("Y"));
    echo("<option value=\"$d3\">$d3</option>");
    for ($i = 2013; $i >= 1900; $i--) {
;
        echo("<option value=\"$i\">$i</option>");
    } ?>
                        </select></td>
            </table>  <button type="submit">
                Prenota
            </button>
    </form> 

<?php
}

include("down.php");


