<?php


       $a1="
     CREATE TABLE IF NOT EXISTS `film` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `titolo` varchar(100) NOT NULL,
  `regista` varchar(100) NOT NULL,
  `anno` varchar(100) NOT NULL,
  `genere` varchar(100) NOT NULL,
  `prezzo` float NOT NULL,
  PRIMARY KEY (`ID`)
)       ;";

 $ris1=mysqli_query($conn,$a1);


$a2="INSERT INTO `film` (`ID`, `titolo`, `regista`, `anno`, `genere`, `prezzo`) VALUES
(1, 'Max Payne', 'John Moore', '2008', 'Azione', 4),
(2, 'Twilight', 'Catherine Hardwicke', '2008', 'Romantico', 4),
(3, 'Il signore degli anelli', 'Peter Jackson', '2001', 'avventura', 3);  ;";
     $ris2=mysqli_query($conn,$a2);

               if($ris1) {print("V");} ELSE {print("X");}
              if($ris2) {print("V");}  ELSE {print("X");}
   
     /*
CREATE TABLE IF NOT EXISTS `noleggio` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `id_film` int(11) NOT NULL,
  `inizio_noleggio` date NOT NULL,
  `fine_noleggio` date NOT NULL,
  PRIMARY KEY (`ID`)
) 


INSERT INTO `noleggio` (`ID`, `id_cliente`, `id_film`, `inizio_noleggio`, `fine_noleggio`) VALUES
(2, 3, 3, '2014-09-17', '2014-09-17'),
(3, 3, 2, '2014-09-17', '2014-09-17'),
(5, 3, 1, '2014-09-17', '2014-10-17');


CREATE TABLE IF NOT EXISTS `utente` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `livello` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;


INSERT INTO `utente` (`ID`, `username`, `password`, `livello`) VALUES
(1, 'admin', 'admin', 2),
(3, 'Cristin', '0000', 1),
(5, 'lau', 'lau', 1);

?>                      */