ALTER TABLE `eqa`.`pt_data_submission` 
DROP COLUMN `expiry_date`,
DROP COLUMN `reagent_name`,
DROP COLUMN `lot_number`;

CREATE 
     OR REPLACE ALGORITHM = UNDEFINED 
    DEFINER = `homestead`@`%` 
    SQL SECURITY DEFINER
VIEW `data_entry_v` AS
    SELECT 
        `pds`.`round_id` AS `round_id`,
        `pr`.`uuid` AS `round_uuid`,
        `pds`.`participant_id` AS `participant_id`,
        `pds`.`equipment_id` AS `equipment_id`,
        `pds`.`status` AS `eq_status`,
        `pds`.`verdict` AS `verdict`,
        `pds`.`doc_path` AS `doc_path`,
        `per`.`sample_id` AS `sample_id`,
        `per`.`cd3_absolute` AS `cd3_absolute`,
        `per`.`cd3_percent` AS `cd3_percent`,
        `per`.`cd4_absolute` AS `cd4_absolute`,
        `per`.`cd4_percent` AS `cd4_percent`,
        `per`.`other_absolute` AS `other_absolute`,
        `per`.`other_percent` AS `other_percent`,
        `per`.`last_modified` AS `last_modified`
    FROM
        ((`pt_equipment_results` `per`
        LEFT JOIN `pt_data_submission` `pds` ON ((`pds`.`id` = `per`.`sample_id`)))
        LEFT JOIN `pt_round` `pr` ON ((`pr`.`id` = `pds`.`round_id`)));

