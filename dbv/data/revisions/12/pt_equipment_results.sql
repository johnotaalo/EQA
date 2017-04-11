ALTER TABLE `eqa`.`pt_equipment_results` 
CHANGE COLUMN `cd3_absolute` `cd3_absolute` VARCHAR(255) NULL DEFAULT 0 ,
CHANGE COLUMN `cd3_percent` `cd3_percent` VARCHAR(255) NULL DEFAULT 0 ,
CHANGE COLUMN `cd4_absolute` `cd4_absolute` VARCHAR(255) NULL DEFAULT 0 ,
CHANGE COLUMN `cd4_percent` `cd4_percent` VARCHAR(255) NULL DEFAULT 0 ,
CHANGE COLUMN `other_absolute` `other_absolute` VARCHAR(255) NULL DEFAULT 0 ,
CHANGE COLUMN `other_percent` `other_percent` VARCHAR(255) NULL DEFAULT 0 ;
