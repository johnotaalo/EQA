CREATE TABLE `pt_data_submission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `round_id` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL,
  `equipment_id` int(11) NOT NULL,
  `status` int(11) DEFAULT '0',
  `verdict` int(11) DEFAULT '2',
  `date_entered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `doc_path` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1