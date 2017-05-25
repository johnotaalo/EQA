ALTER TABLE `eqa`.`pt_data_submission` 
ADD COLUMN `lot_numbers` VARCHAR(255) NOT NULL AFTER `date_entered`;


ALTER TABLE `eqa`.`pt_data_submission` 
CHANGE COLUMN `lot_numbers` `lot_number` VARCHAR(255) NOT NULL AFTER `participant_id`;

CREATE 
     OR REPLACE ALGORITHM = UNDEFINED 
    DEFINER = `homestead`@`%` 
    SQL SECURITY DEFINER
VIEW `eqa`.`data_entry_v` AS
    SELECT 
        `pds`.`round_id` AS `round_id`,
        `pr`.`uuid` AS `round_uuid`,
        `pds`.`participant_id` AS `participant_id`,
        `pds`.`lot_number` AS `lot_number`,
        `pds`.`equipment_id` AS `equipment_id`,
        `pds`.`status` AS `eq_status`,
        `per`.`sample_id` AS `sample_id`,
        `per`.`cd3_absolute` AS `cd3_absolute`,
        `per`.`cd3_percent` AS `cd3_percent`,
        `per`.`cd4_absolute` AS `cd4_absolute`,
        `per`.`cd4_percent` AS `cd4_percent`,
        `per`.`other_absolute` AS `other_absolute`,
        `per`.`other_percent` AS `other_percent`,
        `per`.`last_modified` AS `last_modified`
    FROM
        ((`eqa`.`pt_equipment_results` `per`
        LEFT JOIN `eqa`.`pt_data_submission` `pds` ON ((`pds`.`id` = `per`.`sample_id`)))
        LEFT JOIN `eqa`.`pt_round` `pr` ON ((`pr`.`id` = `pds`.`round_id`)));


