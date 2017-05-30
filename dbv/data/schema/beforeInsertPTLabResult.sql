CREATE DEFINER=`homestead`@`%` TRIGGER `beforeInsertPTLabResult` BEFORE INSERT ON `pt_labs_results` FOR EACH ROW BEGIN
	SET new.uuid := (SELECT UUID());
END