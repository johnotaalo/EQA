CREATE DEFINER=`homestead`@`%` TRIGGER `beforeInsertDataLog` BEFORE INSERT ON `pt_data_log` FOR EACH ROW
BEGIN
	SET new.uuid := (SELECT UUID());
END;
