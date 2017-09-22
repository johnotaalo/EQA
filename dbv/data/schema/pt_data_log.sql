CREATE TABLE `pt_data_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `round_id` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL,
  `equipment_id` int(11) NOT NULL,
  `verdict` varchar(45) NOT NULL,
  `comments` text,
  `date_of_log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1