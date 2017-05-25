CREATE TABLE `sops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sop_name` varchar(255) DEFAULT NULL,
  `sop_path` text,
  `date_of_entry` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `current` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1