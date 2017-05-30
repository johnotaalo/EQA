CREATE DEFINER=`homestead`@`%` TRIGGER `equipment_before_insert` BEFORE INSERT ON `equipment` FOR EACH ROW BEGIN
	SET new.uuid := (SELECT UUID());
END