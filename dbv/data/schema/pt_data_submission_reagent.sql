CREATE TABLE `pt_data_submission_reagent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `submission_id` int(11) NOT NULL,
  `equipment_id` int(11) NOT NULL,
  `lot_number` varchar(50) NOT NULL,
  `reagent_name` varchar(150) NOT NULL,
  `expiry_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1