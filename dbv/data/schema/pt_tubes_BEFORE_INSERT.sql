CREATE DEFINER=`homestead`@`%` TRIGGER `eqa`.`pt_tubes_BEFORE_INSERT` BEFORE INSERT ON `pt_tubes` FOR EACH ROW
BEGIN
	SET new.uuid := (SELECT UUID());
END