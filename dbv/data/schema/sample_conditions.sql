CREATE TABLE `sample_conditions` (
  `id` int(11) NOT NULL,
  `participant_uuid` varchar(255) DEFAULT NULL,
  `pt_round_uuid` varchar(255) DEFAULT NULL,
  `acceptance` int(11) DEFAULT '0',
  `tubes_broken` int(11) DEFAULT '0',
  `tubes_leaking` int(11) DEFAULT '0',
  `tubes_cracked` int(11) DEFAULT '0',
  `insufficient_volume` int(11) DEFAULT '0',
  `haemolysed_sample` int(11) DEFAULT '0',
  `clotted_sample` int(11) DEFAULT '0',
  `duplicate_sample` int(11) DEFAULT '0',
  `missing_sample` int(11) DEFAULT '0',
  `mismatch` int(11) DEFAULT '0',
  `condition_comment` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1