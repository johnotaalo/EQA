CREATE TABLE `equipment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `equipment_name` varchar(255) NOT NULL,
  `kit_name` varchar(255) NOT NULL,
  `lysis_method` varchar(255) DEFAULT 'N/A',
  `absolute_count_beads` varchar(255) DEFAULT 'N/A',
  `analytes_absolute` int(11) DEFAULT '0',
  `analytes_absolute_cd3` int(11) DEFAULT '0',
  `analytes_absolute_cd4` int(11) DEFAULT '0',
  `analytes_percent` int(11) DEFAULT '0',
  `analytes_percent_cd3` int(11) DEFAULT '0',
  `analytes_percent_cd4` int(11) DEFAULT '0',
  `equipment_status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1