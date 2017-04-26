CREATE TABLE `flourochromes` (
  `fl_id` int(11) NOT NULL AUTO_INCREMENT,
  `fl_name` varchar(255) NOT NULL,
  `equipment_id` int(11) DEFAULT NULL,
  `fl_status` int(11) DEFAULT '1',
  PRIMARY KEY (`fl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1