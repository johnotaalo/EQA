ALTER TABLE `sample_conditions` 
ADD COLUMN `sample_name` VARCHAR(255) NOT NULL AFTER `pt_round_uuid`;