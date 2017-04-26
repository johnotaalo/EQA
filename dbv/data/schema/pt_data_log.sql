CREATE TABLE `pt_data_log` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `uuid` VARCHAR(255) NOT NULL,
  `round_id` INT NOT NULL,
  `participant_id` INT NOT NULL,
  `equipment_id` INT NOT NULL,
  `verdict` VARCHAR(45) NOT NULL,
  `comments` TEXT NULL,
  `date_of_log` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`));
