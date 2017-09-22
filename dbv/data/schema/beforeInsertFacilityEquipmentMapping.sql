CREATE DEFINER=`homestead`@`%` TRIGGER `beforeInsertFacilityEquipmentMapping` BEFORE INSERT ON `facility_equipment_mapping` FOR EACH ROW BEGIN
	SET new.uuid := (SELECT UUID());
END