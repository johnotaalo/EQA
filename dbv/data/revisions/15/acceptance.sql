ALTER TABLE `eqa`.`pt_panel_tracking` 
ADD COLUMN `acceptance` INT NULL AFTER `panel_received_entered`;

ALTER TABLE `eqa`.`pt_panel_tracking` 
CHANGE COLUMN `acceptance` `acceptance` INT(11) NULL DEFAULT 0 ;