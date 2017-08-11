CREATE 
    ALGORITHM = UNDEFINED  
    SQL SECURITY DEFINER
VIEW `pt_participant_review_v` AS
    SELECT 
        `pds`.`round_id` AS `round_id`,
        `pds`.`participant_id` AS `participant_id`,
        `pds`.`equipment_id` AS `equipment_id`,
        `per`.`sample_id` AS `sample_id`,
        `per`.`cd3_absolute` AS `cd3_absolute`,
        `per`.`cd3_percent` AS `cd3_percent`,
        `per`.`cd4_absolute` AS `cd4_absolute`,
        `per`.`cd4_percent` AS `cd4_percent`,
        `per`.`other_absolute` AS `other_absolute`,
        `per`.`other_percent` AS `other_percent`,
        `pds`.`date_entered` AS `date_entered`,
        `pds`.`doc_path` AS `doc_path`
    FROM
        (`pt_data_submission` `pds`
        JOIN `pt_equipment_results` `per` ON ((`pds`.`id` = `per`.`equip_result_id`)))