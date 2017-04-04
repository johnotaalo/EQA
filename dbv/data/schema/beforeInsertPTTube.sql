CREATE DEFINER=`homestead`@`%` TRIGGER `beforeInsertPTTube` BEFORE INSERT ON `pt_tubes` FOR EACH ROW BEGIN
	SET new.uuid := (SELECT UUID());
END