-- tabella clienti --

CREATE TABLE IF NOT EXISTS `clienti` (
`id` int(10) NOT NULL AUTO_INCREMENT,
`nome` varchar(20) DEFAULT NULL,
`cognome` varchar(20) DEFAULT NULL,
`username` varchar(15) DEFAULT NULL,
`password` varchar(15) DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- tabella film -- 

CREATE TABLE IF NOT EXISTS `film` (
`id` int(10) NOT NULL AUTO_INCREMENT,
`titolo` varchar(20) DEFAULT NULL,
`regista` varchar(20) DEFAULT NULL,
`anno` int(4) DEFAULT NULL,
`genere` varchar(20) DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- tabella noleggi --

CREATE TABLE IF NOT EXISTS `noleggi` (
`id` int(10) NOT NULL AUTO_INCREMENT,
`idfilm` int(10) DEFAULT NULL,
`idcliente` int(11) DEFAULT NULL,
`datainizio` datetime DEFAULT NULL,
`datafine` date DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `film_fk` (`idfilm`),
KEY `cliente_fk` (`idcliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

