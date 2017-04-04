CREATE DEFINER=`homestead`@`%` TRIGGER `beforeInsertParticipant` BEFORE INSERT ON `participants` FOR EACH ROW BEGIN
	SET new.uuid := (SELECT UUID());
END