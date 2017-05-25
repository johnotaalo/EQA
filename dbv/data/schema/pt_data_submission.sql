CREATE TABLE `pt_data_submission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `round_id` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL,
  `equipment_id` int(11) NOT NULL,
  `lot_number` varchar(255) NOT NULL,
  `reagent_name` varchar(255) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `verdict` int(11) DEFAULT '2',
  `date_entered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `doc_path` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1