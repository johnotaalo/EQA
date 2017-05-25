CREATE DEFINER=`homestead`@`%` TRIGGER `beforeInsertPTTesters` BEFORE INSERT ON `pt_testers` FOR EACH ROW BEGIN
	SET new.uuid := (SELECT UUID());
END