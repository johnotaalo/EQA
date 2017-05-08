CREATE TABLE `participant_readiness` (
  `readiness_id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `pt_round_no` varchar(255) NOT NULL,
  `participant_id` varchar(255) NOT NULL,
  `participant_facility` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `verdict` int(11) DEFAULT NULL,
  `comment` text,
  `date_of_submission` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lab_result` int(11) DEFAULT '0',
  PRIMARY KEY (`readiness_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1