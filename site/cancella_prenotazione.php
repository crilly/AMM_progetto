<?php
session_start(); 
include("config.php"); 

                 
include("header.php");  
   
   $codice=$_GET['codice'];
    
              
                  $q_film2="DELETE from noleggio where ID=$codice";
 $risultato2=mysqli_query($conn,$q_film2);
           print("<script> location.replace('prenotazioni.php'); </script> ");  
             

                 
include("down.php");   
 

            