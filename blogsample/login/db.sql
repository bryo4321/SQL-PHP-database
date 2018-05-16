CREATE TABLE `members` (
  `memberID` int(12) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `active` varchar(255) NOT NULL,
  `resetToken` varchar(255) DEFAULT NULL,
  `resetComplete` varchar(3) DEFAULT 'No',
  `Zip` varchar(5) NOT NULL,
  PRIMARY KEY (`memberID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `restaurants` (
  
  `restaurantID` varchar(255) NOT NULL,
  `restaurantName` varchar(255) NOT NULL,
  `restaurantURL` varchar(255) NOT NULL,
  `restaurantzip` varchar(255) NOT NULL,
  `restaurantaddress` varchar(255) DEFAULT NULL,
  `resetComplete` varchar(3) DEFAULT 'No',
  `Zip` varchar(5) NOT NULL,
  PRIMARY KEY (`memberID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
