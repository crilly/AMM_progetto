<?php
session_start(); 
include("config.php"); 

                 
include("header.php");  

        if($livello>1) {  

     print("<h2>Lista prenotazioni</h2> ");
  
   print("Cliccare sul codice per cancellare la prenotazione");
   
    print("<table align=\"center\" cellpadding=2> ") ;
  print("<tr><td>Codice</td><td>Film</td><td>Utente</td><td>Inizio</td><td>Fine</td><td>Prezzo</td> ") ;   
   
 $q_noleggio="SELECT * from noleggio order by inizio_noleggio desc";
 $risultato1=mysqli_query($conn,$q_noleggio);
   while ($q_noleggio=mysqli_fetch_array($risultato1))
  {    $id_prenotazione=$q_noleggio['ID'];
     $id_film=$q_noleggio['id_film'];
      $id_cliente=$q_noleggio['id_cliente'];
      $data1=$q_noleggio['inizio_noleggio'];
      $data2=$q_noleggio['fine_noleggio'];    
     
            $q_film="SELECT * from film where ID=$id_film ";
             $risultato2=mysqli_query($conn,$q_film);
   while ($q_film=mysqli_fetch_array($risultato2))
  {   $titolofilm=$q_film['titolo']; 
       $prezzofilm=$q_film['prezzo'];                                      
   }
   
       $q_utente="SELECT * from utente where ID=$id_cliente ";
             $risultato3=mysqli_query($conn,$q_utente);
   while ($q_utente=mysqli_fetch_array($risultato3))
  {   $nomeutente=$q_utente['username'];                                     
   }
  

     print(" <tr> ");
     print(" <td><a href=\"cancella_prenotazione.php?codice=$id_prenotazione\">$id_prenotazione</A></td> "); 
     print(" <td>$titolofilm</td> "); 
      print(" <td>$nomeutente</td> "); 
       print(" <td>$data1</td> "); 
        print(" <td>$data2</td> "); 
         print(" <td>$prezzofilm €</td></tr> ");  
  }
        print("</table>");     
                               }
       
        else {   
        
        
            print("<h2>Le mie prenotazioni</h2> ");
  
   
    print("<table align=\"center\" cellpadding=2> ") ;
  print("<tr><td>Film</td><td>Inizio</td><td>Fine</td><td>Prezzo</td> ") ;   
   
 $q_noleggio="SELECT * from noleggio where id_cliente=$user2 order by inizio_noleggio desc";
 $risultato1=mysqli_query($conn,$q_noleggio);
   while ($q_noleggio=mysqli_fetch_array($risultato1))
  {    $id_prenotazione=$q_noleggio['ID'];
     $id_film=$q_noleggio['id_film'];
      $id_cliente=$q_noleggio['id_cliente'];
      $data1=$q_noleggio['inizio_noleggio'];
      $data2=$q_noleggio['fine_noleggio'];    
     
            $q_film="SELECT * from film where ID=$id_film ";
             $risultato2=mysqli_query($conn,$q_film);
   while ($q_film=mysqli_fetch_array($risultato2))
  {   $titolofilm=$q_film['titolo']; 
       $prezzofilm=$q_film['prezzo'];                                      
   }
   
       $q_utente="SELECT * from utente where ID=$user2 ";
             $risultato3=mysqli_query($conn,$q_utente);
   while ($q_utente=mysqli_fetch_array($risultato3))
  {   $nomeutente=$q_utente['username'];                                     
   }
  

     print(" <tr> ");
     print(" <td>$titolofilm</td> "); 
       print(" <td>$data1</td> "); 
        print(" <td>$data2</td> "); 
         print(" <td>$prezzofilm €</td></tr> ");  
  }
        print("</table>");   
        
        
        
        
        
        
        
        
        
        
          }
          
include("down.php");   
 

               ?>