CREATE DEFINER=`homestead`@`%` PROCEDURE `get_pt_facility_statistics`(
	IN `v_pt_uuid` VARCHAR(36)









)
BEGIN
	SELECT 
	(SELECT COUNT(f.id) FROM facility f
	WHERE f.id IN (SELECT participant_facility FROM participants)) as with_participants,
	(SELECT COUNT(readiness_id) FROM participant_readiness
	WHERE pt_round_no = v_pt_uuid) as responded,
	(SELECT COUNT(readiness_id) FROM participant_readiness
	WHERE verdict = 1) as `ready`,
	(SELECT COUNT(readiness_id) FROM participant_readiness
	WHERE verdict = 0) as `not_ready`,
	(SELECT COUNT(id) FROM facility WHERE cd4 = 1) as total_sites;
END