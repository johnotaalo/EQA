ALTER TABLE `eqa`.`pt_equipment_results` 
DROP PRIMARY KEY;

ALTER TABLE `eqa`.`pt_data_submission` 
CHANGE COLUMN `id` `id` INT(11) NOT NULL AUTO_INCREMENT ;
