CREATE DEFINER=`homestead`@`%` TRIGGER `beforeInsertPTLabs` BEFORE INSERT ON `pt_labs` FOR EACH ROW BEGIN
	SET new.uuid := (SELECT UUID());
END