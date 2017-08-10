ALTER TABLE `eqa`.`pt_equipment_results` 
CHANGE COLUMN `sample_id` `equip_result_id` INT(11) NOT NULL ;

ALTER TABLE `eqa`.`pt_equipment_results` 
ADD COLUMN `sample_id` INT NOT NULL AFTER `equip_result_id`;



CREATE 
     OR REPLACE ALGORITHM = UNDEFINED 
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
        `per`.`equip_result_id` AS `equip_result_id`,
        `per`.`cd3_absolute` AS `cd3_absolute`,
        `per`.`cd3_percent` AS `cd3_percent`,
        `per`.`cd4_absolute` AS `cd4_absolute`,
        `per`.`cd4_percent` AS `cd4_percent`,
        `per`.`other_absolute` AS `other_absolute`,
        `per`.`other_percent` AS `other_percent`,
        `per`.`last_modified` AS `last_modified`
    FROM
        ((`pt_equipment_results` `per`
        LEFT JOIN `pt_data_submission` `pds` ON ((`pds`.`id` = `per`.`equip_result_id`)))
        LEFT JOIN `pt_round` `pr` ON ((`pr`.`id` = `pds`.`round_id`)));


