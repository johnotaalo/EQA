ALTER TABLE `participant_readiness_responses`
	ALTER `response` DROP DEFAULT;
ALTER TABLE `participant_readiness_responses`
	CHANGE COLUMN `response` `response` INT(11) NULL AFTER `questionnaire_id`;