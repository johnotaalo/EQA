CREATE TABLE `pt_data_submission` (
  `id` int(11) NOT NULL,
  `round_id` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL,
  `equipment_id` int(11) NOT NULL,
  `date_entered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1