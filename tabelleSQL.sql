CREATE TABLE IF NOT EXISTS `clienti` (
`id` int(10) NOT NULL AUTO_INCREMENT,
`nome` varchar(20) DEFAULT NULL,
`cognome` varchar(20) DEFAULT NULL,
`username` varchar(15) DEFAULT NULL,
`password` varchar(15) DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
