USE `eqa`;
CREATE 
     OR REPLACE ALGORITHM = UNDEFINED 
    DEFINER = `homestead`@`%` 
    SQL SECURITY DEFINER
VIEW `equipment_facilities_v` AS
    SELECT 
        `e`.`id` AS `e_id`,
        `e`.`equipment_name` AS `e_name`,
        `e`.`uuid` AS `e_uuid`,
        `f`.`facility_code` AS `facility_code`,
        `f`.`facility_name` AS `facility_name`,
        `c`.`county_name` AS `county_name`,
        `sc`.`sub_county_name` AS `sub_county_name`
    FROM
        ((((`facility` `f`
        LEFT JOIN `sub_county` `sc` ON ((`sc`.`id` = `f`.`sub_county_id`)))
        LEFT JOIN `county` `c` ON ((`c`.`id` = `sc`.`county_id`)))
        JOIN `facility_equipment_mapping` `fem` ON ((`fem`.`facility_code` = `f`.`facility_code`)))
        JOIN `equipment` `e` ON ((`fem`.`equipment_id` = `e`.`id`)))
    ORDER BY `e`.`id`;
