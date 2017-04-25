ALTER TABLE `eqa`.`messages` 
CHANGE COLUMN `message` `message` TEXT NOT NULL ,
ADD COLUMN `from` VARCHAR(255) NOT NULL AFTER `uuid`;

ALTER TABLE `eqa`.`messages` 
ADD COLUMN `email` VARCHAR(255) NULL DEFAULT 'No email' AFTER `from`;

ALTER TABLE `eqa`.`messages` 
ADD COLUMN `deleted` INT NOT NULL DEFAULT 0 AFTER `date_sent`;

ALTER TABLE `eqa`.`messages` 
CHANGE COLUMN `from` `from` VARCHAR(255) NOT NULL DEFAULT 'No Name' ;



CREATE 
     OR REPLACE ALGORITHM = UNDEFINED 
    DEFINER = `homestead`@`%` 
    SQL SECURITY DEFINER
VIEW `messages_v` AS
    SELECT 
        `m`.`id` AS `id`,
        `m`.`uuid` AS `uuid`,
        `m`.`from` AS `from`,
        `m`.`email` AS `email`,
        `m`.`participant_uuid` AS `participant_uuid`,
        `m`.`subject` AS `subject`,
        `m`.`message` AS `message`,
        `m`.`status` AS `status`,
        `m`.`date_sent` AS `date_sent`,
        `m`.`deleted` AS `deleted`
    FROM
        `messages` `m`;



