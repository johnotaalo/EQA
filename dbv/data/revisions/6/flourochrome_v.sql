USE `eqa`;
CREATE 
     OR REPLACE ALGORITHM = UNDEFINED 
    DEFINER = `homestead`@`%` 
    SQL SECURITY DEFINER
VIEW `flourochromes_v` AS
    SELECT 
        `fl`.`fl_id` AS `id`,
        `fl`.`fl_name` AS `fl_name`,
        `fl`.`equipment_id` AS `equipment_id`,
        `fl`.`fl_status` AS `fl_status`
    FROM
        (`flourochromes` `fl`
    LEFT JOIN `equipment` `e` ON ((`e`.`id` = `fl`.`fl_id`)))

