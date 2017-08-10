CREATE 
    ALGORITHM = UNDEFINED 
    SQL SECURITY DEFINER
VIEW `pt_participant_result_v` AS
    SELECT 
        `pds`.`participant_id` AS `participant_id`,
        `pds`.`equipment_id` AS `equipment_id`,
        ROUND(AVG(`per`.`cd4_absolute`), 0) AS `cd4_absolute_mean`
    FROM
        (`pt_data_submission` `pds`
        JOIN `pt_equipment_results` `per` ON ((`pds`.`id` = `per`.`equip_result_id`)))
    GROUP BY `pds`.`equipment_id`