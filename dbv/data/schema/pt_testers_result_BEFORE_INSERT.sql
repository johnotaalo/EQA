CREATE DEFINER=`homestead`@`%` TRIGGER `eqa`.`pt_testers_result_BEFORE_INSERT` BEFORE INSERT ON `pt_testers_result` FOR EACH ROW
BEGIN
	SET new.uuid := (SELECT UUID());
END