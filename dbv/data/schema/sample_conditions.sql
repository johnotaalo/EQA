CREATE TABLE `sample_conditions` (
  `id` INT NOT NULL,
  `participant_uuid` VARCHAR(255) NULL,
  `pt_round_uuid` VARCHAR(255) NULL,
  `acceptance` INT NULL DEFAULT 0,
  `tubes_broken` INT NULL DEFAULT 0,
  `tubes_leaking` INT NULL DEFAULT 0,
  `tubes_cracked` INT NULL DEFAULT 0,
  `insufficient_volume` INT NULL DEFAULT 0,
  `haemolysed_sample` INT NULL DEFAULT 0,
  `clotted_sample` INT NULL DEFAULT 0,
  `duplicate_sample` INT NULL DEFAULT 0,
  `missing_sample` INT NULL DEFAULT 0,
  `mismatch` INT NULL DEFAULT 0,
  `condition_comment` TEXT NULL);



