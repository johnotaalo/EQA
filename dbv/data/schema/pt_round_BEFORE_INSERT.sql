CREATE DEFINER=`homestead`@`%` TRIGGER `eqa`.`pt_round_BEFORE_INSERT` BEFORE INSERT ON `pt_round` FOR EACH ROW
BEGIN
	SET new.uuid := (SELECT UUID());
END