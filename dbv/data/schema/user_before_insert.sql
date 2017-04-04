CREATE DEFINER=`homestead`@`%` TRIGGER `user_before_insert` BEFORE INSERT ON `user` FOR EACH ROW BEGIN
	SET new.uuid := (SELECT UUID());
END