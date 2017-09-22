CREATE DEFINER=`homestead`@`%` TRIGGER `eqa`.`equipment_BEFORE_INSERT` BEFORE INSERT ON `equipment` FOR EACH ROW
BEGIN
	SET new.uuid := (SELECT UUID());
END