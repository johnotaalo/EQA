CREATE TABLE `faqs` (
  `id` INT NOT NULL,
  `title` VARCHAR(255) NULL,
  `question` VARCHAR(255) NULL,
  `answer` VARCHAR(255) NULL,
  `status` INT NULL DEFAULT 1
  PRIMARY KEY (`id`));
