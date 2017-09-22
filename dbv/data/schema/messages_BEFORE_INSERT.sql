CREATE DEFINER=`homestead`@`%` TRIGGER `eqa`.`messages_BEFORE_INSERT` BEFORE INSERT ON `messages` FOR EACH ROW
BEGIN
	SET new.uuid := (SELECT UUID());
END