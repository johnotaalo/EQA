CREATE DEFINER=`homestead`@`%` TRIGGER `beforeInsertMessage` BEFORE INSERT ON `messages` FOR EACH ROW BEGIN
	SET new.uuid := (SELECT UUID());
END