-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generato il: Set 17, 2014 alle 16:33
-- Versione del server: 5.5.32
-- Versione PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `videoteca`
--
CREATE DATABASE IF NOT EXISTS `videoteca` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `videoteca`;

-- --------------------------------------------------------

--
-- Struttura della tabella `film`
--

CREATE TABLE IF NOT EXISTS `film` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `titolo` varchar(100) NOT NULL,
  `regista` varchar(100) NOT NULL,
  `anno` varchar(100) NOT NULL,
  `genere` varchar(100) NOT NULL,
  `prezzo` float NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dump dei dati per la tabella `film`
--

INSERT INTO `film` (`ID`, `titolo`, `regista`, `anno`, `genere`, `prezzo`) VALUES
(1, 'Max Payne', 'John Moore', '2008', 'Azione', 4),
(2, 'Twilight', 'Catherine Hardwicke', '2008', 'Romantico', 4),
(3, 'Il signore degli anelli', 'Peter Jackson', '2001', 'avventura', 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `noleggio`
--

CREATE TABLE IF NOT EXISTS `noleggio` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `id_film` int(11) NOT NULL,
  `inizio_noleggio` date NOT NULL,
  `fine_noleggio` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `noleggio`
--

INSERT INTO `noleggio` (`ID`, `id_cliente`, `id_film`, `inizio_noleggio`, `fine_noleggio`) VALUES
(2, 3, 3, '2014-09-17', '2014-09-17'),
(3, 3, 2, '2014-09-17', '2014-09-17');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE IF NOT EXISTS `utente` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `livello` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`ID`, `username`, `password`, `livello`) VALUES
(1, 'admin', 'admin', 2),
(2, 'user', 'user', 1),
(3, 'Cristin', '0000', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
