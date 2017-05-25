ALTER TABLE `eqa`.`equipment` 
CHANGE COLUMN `kit_name` `kit_name` VARCHAR(255) NOT NULL AFTER `equipment_name`,
CHANGE COLUMN `equipment_status` `equipment_status` TINYINT(1) NOT NULL DEFAULT 0 ,
ADD COLUMN `lysis_method` VARCHAR(255) NULL DEFAULT 'N/A' AFTER `kit_name`,
ADD COLUMN `absolute_count_beads` VARCHAR(255) NULL DEFAULT 'N/A' AFTER `lysis_method`;

ALTER TABLE `eqa`.`flourochromes` 
ADD COLUMN `equipment_id` INT NULL AFTER `fl_name`;

ALTER TABLE `eqa`.`equipment` 
ADD COLUMN `analytes_absolute` INT NULL DEFAULT 0 AFTER `absolute_count_beads`,
ADD COLUMN `analytes_absolute_cd3` INT NULL DEFAULT 0 AFTER `analytes_absolute`,
ADD COLUMN `analytes_absolute_cd4` INT NULL DEFAULT 0 AFTER `analytes_absolute_cd3`,
ADD COLUMN `analytes_percent` INT NULL DEFAULT 0 AFTER `analytes_absolute_cd4`,
ADD COLUMN `analytes_percent_cd3` INT NULL DEFAULT 0 AFTER `analytes_percent`,
ADD COLUMN `analytes_percent_cd4` INT NULL DEFAULT 0 AFTER `analytes_percent_cd3`;


