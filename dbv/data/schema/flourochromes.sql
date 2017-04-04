CREATE TABLE `flourochromes` (
  `fl_id` int(11) NOT NULL AUTO_INCREMENT,
  `fl_name` varchar(255) NOT NULL,
  `fl_status` int(11) DEFAULT '1',
  PRIMARY KEY (`fl_id`),
  UNIQUE KEY `fl_name_UNIQUE` (`fl_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1