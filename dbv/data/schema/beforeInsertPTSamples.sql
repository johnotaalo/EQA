CREATE DEFINER=`homestead`@`%` TRIGGER `beforeInsertPTSamples` BEFORE INSERT ON `pt_samples` FOR EACH ROW BEGIN
	SET new.uuid := (SELECT UUID());
END