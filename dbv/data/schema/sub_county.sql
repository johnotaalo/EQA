CREATE TABLE `sub_county` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_county_name` varchar(200) NOT NULL,
  `sub_county_dhis_code` varchar(50) NOT NULL,
  `sub_county_mfl_code` int(11) DEFAULT NULL,
  `county_id` int(11) NOT NULL,
  `sub_county_coordinates` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1