CREATE DEFINER=`homestead`@`%` TRIGGER `eqa`.`participants_BEFORE_INSERT` BEFORE INSERT ON `participants` FOR EACH ROW
BEGIN
	SET new.uuid := (SELECT UUID());
END