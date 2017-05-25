CREATE DEFINER=`homestead`@`%` TRIGGER `beforeInsertPTTestersResult` BEFORE INSERT ON `pt_testers_result` FOR EACH ROW BEGIN
	SET new.uuid := (SELECT UUID());
END