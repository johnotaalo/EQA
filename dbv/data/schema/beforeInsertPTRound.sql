CREATE DEFINER=`homestead`@`%` TRIGGER `beforeInsertPTRound` BEFORE INSERT ON `pt_round` FOR EACH ROW BEGIN
	SET new.uuid := (SELECT UUID());
END