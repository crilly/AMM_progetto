<?php
session_start();
include("config.php");


include("header.php");

if (isset($_SESSION['ID'])) {
    print("<script> location.replace('index.php'); </script>");
} else {


    $user = $_POST['user'];
    $password = $_POST['password'];

    if ($password == "" || $user == "") {
        print("ERRORE, Dati mancanti:<br>");
    } else {
        $query = "SELECT * FROM utente WHERE username='$user' and password='$password'";
        $risultato = mysqli_query($conn, $query);
        if ($risultato) {
            $count = mysqli_num_rows($risultato);
        } else {
            $count = 0;
        }

        if ($count == 0) {
            print("Dati errati");
        } else {
            while ($utente = mysqli_fetch_array($risultato)) {
                $id = $utente['ID'];
                $user2 = $utente['username'];
                $livello = $utente['livello'];
            }
            $_SESSION['ID'] = $id;
            $_SESSION['USER'] = $user2;
            $_SESSION['LIV'] = $livello;
            print("<script>location.replace('index.php'); </script>");
        }
    }
}
?> 
<BR>      
</body>
</html> 


