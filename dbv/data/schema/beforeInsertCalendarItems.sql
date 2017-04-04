CREATE DEFINER=`homestead`@`%` TRIGGER `beforeInsertCalendarItems` BEFORE INSERT ON `calendar_items` FOR EACH ROW BEGIN
	SET new.uuid := (SELECT UUID());
END