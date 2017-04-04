CREATE TABLE `county` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `county_name` varchar(200) NOT NULL,
  `county_dhis_code` varchar(50) NOT NULL,
  `county_mfl_code` int(11) NOT NULL,
  `county_coordinates` text NOT NULL,
  `county_letter` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `county_dhis_code` (`county_dhis_code`),
  UNIQUE KEY `county_mfl_code` (`county_mfl_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1