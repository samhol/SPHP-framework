CREATE TABLE IF NOT EXISTS `users` (
  `dbID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(320) DEFAULT NULL,
  `allowsMailing` tinyint(1) unsigned DEFAULT '0',
  `phonenumber` varchar(12) DEFAULT '',
  `streetaddress` varchar(50) DEFAULT NULL,
  `zipcode` varchar(5) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `password` varchar(32) NOT NULL DEFAULT '',
  `permissions` int(6) unsigned zerofill NOT NULL DEFAULT '000000',
  PRIMARY KEY (`dbID`),
  UNIQUE KEY `uniqueUsername` (`username`),
  UNIQUE KEY `uniquePersonName` (`fname`,`lname`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1;
