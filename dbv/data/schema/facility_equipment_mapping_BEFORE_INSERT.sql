CREATE DEFINER=`homestead`@`%` TRIGGER `eqa`.`facility_equipment_mapping_BEFORE_INSERT` BEFORE INSERT ON `facility_equipment_mapping` FOR EACH ROW
BEGIN
	SET new.uuid := (SELECT UUID());
END