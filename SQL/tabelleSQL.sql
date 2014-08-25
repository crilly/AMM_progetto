-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Ago 25, 2014 alle 14:49
-- Versione del server: 5.6.15-log
-- PHP Version: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `videoteca`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `film`
--

CREATE TABLE IF NOT EXISTS `film` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `titolo` text NOT NULL,
  `regista` varchar(16) NOT NULL,
  `anno` int(4) NOT NULL,
  `genere` varchar(15) NOT NULL,
  `prezzo` double NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dump dei dati per la tabella `film`
--

INSERT INTO `film` (`ID`, `titolo`, `regista`, `anno`, `genere`, `prezzo`) VALUES
(1, 'Il Gladiatore', 'Ridley Scott', 2000, 'Azione', 5),
(2, 'Apollo 13', 'Ron Howard', 1995, 'Drammatico', 4.5),
(3, 'E.T. L''extra-terrestre', 'Steven Spielberg', 1982, 'Fantascienza', 4),
(4, 'Cars - Motori Ruggenti', ' John Alan Lasse', 2006, 'Animazione', 6.5);

-- --------------------------------------------------------

--
-- Struttura della tabella `noleggi`
--

CREATE TABLE IF NOT EXISTS `noleggi` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_utenti` varchar(15) NOT NULL,
  `id_film` varchar(20) NOT NULL,
  `scadenza` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE IF NOT EXISTS `utenti` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(9) NOT NULL,
  `password` varchar(16) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`ID`, `user`, `password`) VALUES
(1, 'cliente', 'sanna'),
(2, 'venditore', 'sanna');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
