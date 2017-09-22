ALTER TABLE `eqa`.`pt_data_submission` 
CHANGE COLUMN `status` `status` INT(11) NULL DEFAULT '0' COMMENT 'This shows that the participant\'s data has been sent to NHRL. 1 = Sent, 0 = Not Sent' ;

ALTER TABLE `eqa`.`pt_data_submission` 
CHANGE COLUMN `verdict` `verdict` INT(11) NULL DEFAULT '2' COMMENT 'This shows that the QA has either accepted, rejected or still to judge. 1 = Accepted, 0 = Rejected, \n2 = Awaiting Verdict' ;
