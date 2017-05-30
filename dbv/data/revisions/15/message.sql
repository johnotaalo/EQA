CREATE TABLE `eqa`.`messages` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `uuid` VARCHAR(255) NOT NULL,
  `participant_uuid` VARCHAR(255) NOT NULL,
  `subject` VARCHAR(255) NULL,
  `message` TEXT NULL,
  `status` INT NULL DEFAULT 0,
  `date_sent` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`));

DROP TRIGGER IF EXISTS `eqa`.`beforeInsertMessage`;

DELIMITER $$
CREATE DEFINER=`homestead`@`%` TRIGGER `beforeInsertMessage` BEFORE INSERT ON `messages` FOR EACH ROW BEGIN
	SET new.uuid := (SELECT UUID());
END$$
DELIMITER ;

