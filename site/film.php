<?php
session_start(); 
include("config.php");


include("header.php");  
   
 $q_film="SELECT * from film order by titolo";
 $risultato=mysqli_query($conn,$q_film);
      
     
                                                  
   print("<h2>Lista Film</h2> ");
   if ($livello>1)
   {print("Cliccare sul codice per cancellare il film");}
   else
   {
    if($livello==0) 
    {   print("Per prenotare � necessario registrarsi");}
    else { print("Cliccare sul codice per prenotare il film");}  }
   
   print("<table align=\"center\" cellpadding=2> ") ;
   
  print("<tr><td>Codice</td><td>Titolo</td><td>Regista</td><td>Anno</td><td>Genere</td><td>Prezzo</td> ") ; 
  while ($q_film=mysqli_fetch_array($risultato))
  {   $ID=$q_film['ID'];
      $titolo=$q_film['titolo'];
      $regista=$q_film['regista'];
      $anno=$q_film['anno'];
      $genere=$q_film['genere'];
      $prezzo=$q_film['prezzo'];
  
  
    // print(" <tr><td><a href=\"cancella_film.php?id=$ID\"><img src=\"images\cancella.png\"></a></td> ");
     print(" <tr> ");
     print(" <td><a href=\"prenota.php?codice=$ID\">$ID</A></td> "); 
     print(" <td>$titolo</td> "); 
      print(" <td>$regista</td> "); 
       print(" <td>$genere</td> "); 
        print(" <td>$anno</td> "); 
         print(" <td>$prezzo �</td></tr> ");  
  }
        print("</table>");     
                 
include("down.php");   
 

               ?>