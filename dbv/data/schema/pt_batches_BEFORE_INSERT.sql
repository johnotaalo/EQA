CREATE DEFINER=`homestead`@`%` TRIGGER `eqa`.`pt_batches_BEFORE_INSERT` BEFORE INSERT ON `pt_batches` FOR EACH ROW
BEGIN
	SET new.uuid := (SELECT UUID());
END