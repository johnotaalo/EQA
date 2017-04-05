ALTER TABLE `eqa`.`pt_data_submission` 
ADD COLUMN `status` INT NULL DEFAULT 0 AFTER `equipment_id`;

ALTER TABLE `eqa`.`pt_data_submission` 
CHANGE COLUMN `status` `status` INT(11) NOT NULL DEFAULT '0' ;
