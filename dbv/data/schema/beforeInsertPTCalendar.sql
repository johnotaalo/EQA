CREATE DEFINER=`homestead`@`%` TRIGGER `beforeInsertPTCalendar` BEFORE INSERT ON `pt_calendar` FOR EACH ROW BEGIN
	SET new.uuid := (SELECT UUID());
END