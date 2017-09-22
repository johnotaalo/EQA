ALTER TABLE `eqa`.`participants` 
ADD COLUMN `participant_sex` VARCHAR(255) NULL DEFAULT 'No entry' AFTER `participant_email`,
ADD COLUMN `participant_age` VARCHAR(255) NULL DEFAULT 'No entry' AFTER `participant_sex`,
ADD COLUMN `participant_education` VARCHAR(255) NULL DEFAULT 'No entry' AFTER `participant_age`,
ADD COLUMN `participant_experience` VARCHAR(45) NULL DEFAULT 'No entry' AFTER `participant_education`;
