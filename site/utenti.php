<?php
session_start(); 
include("config.php"); 

                 
include("header.php");  

       
     print("<h2>Lista Utenti</h2> ");
  
   print("Cliccare sul codice per cancellare il cliente");
   
    print("<table align=\"center\" cellpadding=2> ") ;
  print("<tr><td>Codice</td><td>User</td>") ;   
   
   
       $q_utente="SELECT * from utente where livello<2 order by username";
             $risultato3=mysqli_query($conn,$q_utente);
   while ($q_utente=mysqli_fetch_array($risultato3))
  {   $nomeutente=$q_utente['username'];
  $codiceutente=$q_utente['ID'];                                     
   
  

     print(" <tr> ");
     print(" <td><a href=\"cancella_utente.php?codice=$codiceutente\">$codiceutente</A></td> "); 
    
      print(" <td>$nomeutente</td> </tr> ");  
   }
        print("</table>");     
                               
      
          
include("down.php");   
 

               ?>