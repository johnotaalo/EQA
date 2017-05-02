ALTER TABLE `pt_data_submission` 
CHANGE COLUMN `equipment_id` `equipment_id` INT(11) NOT NULL AFTER `participant_id`,
ADD COLUMN `reagent_name` VARCHAR(255) NULL AFTER `equipment_id`,
ADD COLUMN `expiry_date` DATE NULL AFTER `reagent_name`;

