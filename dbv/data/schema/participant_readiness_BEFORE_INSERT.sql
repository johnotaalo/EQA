CREATE DEFINER=`homestead`@`%` TRIGGER `eqa`.`participant_readiness_BEFORE_INSERT` BEFORE INSERT ON `participant_readiness` FOR EACH ROW
BEGIN
	SET new.uuid := (SELECT UUID());
END