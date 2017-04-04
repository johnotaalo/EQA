CREATE TABLE `participant_equipment` (
  `pe_id` int(11) NOT NULL AUTO_INCREMENT,
  `participant_id` int(11) NOT NULL,
  `equipment_id` int(11) NOT NULL,
  `date_entered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1