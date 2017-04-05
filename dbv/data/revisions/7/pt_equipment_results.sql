CREATE TABLE `eqa`.`pt_equipment_results` (
  `sample_id` INT NOT NULL,
  `cd3_absolute` VARCHAR(255) NULL,
  `cd3_percent` VARCHAR(255) NULL,
  `cd4_absolute` VARCHAR(255) NULL,
  `cd4_percent` VARCHAR(255) NULL,
  `other_absolute` VARCHAR(255) NULL,
  `other_percent` VARCHAR(255) NULL,
  `last_modified` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`sample_id`));