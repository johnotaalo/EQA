CREATE TABLE `test_result` (
  `tester_id` int(11) NOT NULL,
  `sample_id` int(11) NOT NULL,
  `results` varchar(255) NOT NULL,
  `eq_id` int(11) NOT NULL,
  `date_of_submission` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1