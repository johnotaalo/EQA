CREATE TABLE `pt_equipment_results` (
  `sample_id` int(11) NOT NULL,
  `cd3_absolute` varchar(255) DEFAULT NULL,
  `cd3_percent` varchar(255) DEFAULT NULL,
  `cd4_absolute` varchar(255) DEFAULT NULL,
  `cd4_percent` varchar(255) DEFAULT NULL,
  `other_absolute` varchar(255) DEFAULT NULL,
  `other_percent` varchar(255) DEFAULT NULL,
  `last_modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`sample_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1