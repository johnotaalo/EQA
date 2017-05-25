CREATE TABLE `participant_readiness_responses` (
  `response_id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) DEFAULT NULL,
  `readiness_id` int(11) NOT NULL,
  `questionnaire_id` int(11) NOT NULL,
  `response` int(11) DEFAULT NULL,
  `extra_comments` text,
  PRIMARY KEY (`response_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1