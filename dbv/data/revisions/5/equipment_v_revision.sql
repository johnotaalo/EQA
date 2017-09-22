CREATE OR REPLACE
    ALGORITHM = UNDEFINED 
    DEFINER = `homestead`@`%` 
    SQL SECURITY DEFINER
VIEW `equipments_v` AS
    SELECT 
        `e`.`id` AS `id`,
        `e`.`uuid` AS `uuid`,
        `e`.`equipment_name` AS `equipment_name`,
        `e`.`kit_name` AS `kit`,
        `e`.`lysis_method` AS `lysis`,
        `e`.`absolute_count_beads` AS `acb`,
        `e`.`analytes_absolute` AS `absolute`,
        `e`.`analytes_absolute_cd3` AS `absolute_cd3`,
        `e`.`analytes_absolute_cd4` AS `absolute_cd4`,
        `e`.`analytes_percent` AS `percent`,
        `e`.`analytes_percent_cd3` AS `percent_cd3`,
        `e`.`analytes_percent_cd4` AS `percent_cd4`,
        `e`.`equipment_status` AS `equipment_status`,
        COUNT(`f`.`id`) AS `facilities`
    FROM
        ((`equipment` `e`
        LEFT JOIN `facility_equipment_mapping` `fem` ON ((`fem`.`equipment_id` = `e`.`id`)))
        LEFT JOIN `facility` `f` ON ((`f`.`facility_code` = `fem`.`facility_code`)))
    GROUP BY `e`.`id`