CREATE TABLE `pt_round` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) NOT NULL,
  `pt_round_no` varchar(255) NOT NULL,
  `tag` int(11) NOT NULL,
  `blood_lab_unit_id` varchar(255) NOT NULL,
  `from` date NOT NULL,
  `to` date NOT NULL,
  `date_of_entry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pt_status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1