CREATE TABLE `eqa`.`pt_data_submission` (
  `id` INT NOT NULL,
  `round_id` INT NOT NULL,
  `participant_id` INT NOT NULL,
  `equipment_id` INT NOT NULL,
  `date_entered` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`));

