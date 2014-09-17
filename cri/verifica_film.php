<?php
session_start(); 
include("config.php"); 


include("header.php");  
   

 
       print("<center><font size=5 color=\"red\" style=\"bold\"> <br>Controllo dati: </font><br><br><BR>"); 
$titolo=$_POST["titolo"];
$genere=$_POST["genere"];
$anno=$_POST["anno"];    
$regista=$_POST["regista"];
$prezzo=$_POST["prezzo"];
   
   
    if($titolo!=""&&$genere!=""&&$anno!=""&&$regista!=""&&$prezzo!="")
          {
                    
$q_="INSERT INTO film (titolo,genere,anno,regista,prezzo)
     values ('$titolo','$genere','$anno','$regista',$prezzo);";
   $ris2=mysqli_query($conn,$q_);
            

        if($ris2)
        {
         print("<font size=4 color=\"green\"><script> location.replace('film.php'); </script> <br></font>");
        }
        else
        {
         print("Errore durante l'inserimento, formato sbagliato, reinserire dati.");
        }          
       
        
        
         }
         
             else{ print("<FONT size=\"4\" color=\"red\">Completa tutti i campi</font><br><br>");}
                            
                                 
                                                                     
                                  
                                 
                                  
                                  
             
                             
             
        include("down.php");   
 
       