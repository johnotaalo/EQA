CREATE DEFINER=`homestead`@`%` TRIGGER `eqa`.`pt_labs_results_BEFORE_INSERT` BEFORE INSERT ON `pt_labs_results` FOR EACH ROW
BEGIN
	SET new.uuid := (SELECT UUID());
END