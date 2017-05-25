CREATE 
     OR REPLACE ALGORITHM = UNDEFINED 
    DEFINER = `homestead`@`%` 
    SQL SECURITY DEFINER
VIEW `pt_ready_participants` AS
    SELECT 
        `pr`.`readiness_id` AS `readiness_id`,
        `pr`.`uuid` AS `readiness_uuid`,
        `pr`.`verdict` AS `verdict`,
        `pr`.`pt_round_no` AS `pt_round_uuid`,
        p.participant_id,
        `p`.`participant_fname` AS `participant_fname`,
        `p`.`participant_lname` AS `participant_lname`,
        `p`.`participant_phonenumber` AS `participant_phonenumber`,
        `f`.`facility_code` AS `facility_code`,
        `f`.`facility_name` AS `facility_name`,
        `f`.`G4S_branch_name` AS `G4S_branch_name`,
        `f`.`G4S_location` AS `G4S_location`,
        IF(ISNULL(`ptb`.`batch_name`),
            'No batch assigned',
            `ptb`.`batch_name`) AS `batch`,
        `ppt`.`id` AS `panel_tracking_id`,
        `ppt`.`uuid` AS `panel_tracking_uuid`,
        `ppt`.`panel_preparation_date` AS `panel_preparation_date`,
        `ppt`.`courier_collection_date` AS `courier_collection_date`,
        `ppt`.`participant_received_date` AS `participant_received_date`,
        (CASE
            WHEN ISNULL(`ppt`.`panel_preparation_date`) THEN 'Awaiting Preparation'
            WHEN
                ((`ppt`.`panel_preparation_date` IS NOT NULL)
                    AND ISNULL(`ppt`.`courier_collection_date`))
            THEN
                'Awaiting Courier Dispatch'
            WHEN
                ((`ppt`.`panel_preparation_date` IS NOT NULL)
                    AND (`ppt`.`courier_collection_date` IS NOT NULL)
                    AND ISNULL(`ppt`.`participant_received_date`))
            THEN
                'Awaiting Participant Reception'
            WHEN
                ((`ppt`.`panel_preparation_date` IS NOT NULL)
                    AND (`ppt`.`courier_collection_date` IS NOT NULL)
                    AND (`ppt`.`participant_received_date` IS NOT NULL))
            THEN
                'Panel Received'
            ELSE 'Nothing Yet'
        END) AS `status`,
        (CASE
            WHEN ISNULL(`ppt`.`panel_preparation_date`) THEN 0
            WHEN
                ((`ppt`.`panel_preparation_date` IS NOT NULL)
                    AND ISNULL(`ppt`.`courier_collection_date`))
            THEN
                1
            WHEN
                ((`ppt`.`panel_preparation_date` IS NOT NULL)
                    AND (`ppt`.`courier_collection_date` IS NOT NULL)
                    AND ISNULL(`ppt`.`participant_received_date`))
            THEN
                2
            WHEN
                ((`ppt`.`panel_preparation_date` IS NOT NULL)
                    AND (`ppt`.`courier_collection_date` IS NOT NULL)
                    AND (`ppt`.`participant_received_date` IS NOT NULL))
            THEN
                3
            ELSE 4
        END) AS `status_code`
    FROM
        (((`participants` `p`
        LEFT JOIN (`participant_readiness` `pr`
        LEFT JOIN `pt_panel_tracking` `ppt` ON ((`pr`.`readiness_id` = `ppt`.`pt_readiness_id`))) ON ((`p`.`uuid` = `pr`.`participant_id`)))
        LEFT JOIN `pt_batches` `ptb` ON ((`ptb`.`id` = `ppt`.`pt_batch_id`)))
        JOIN `facility` `f` ON ((`f`.`id` = `p`.`participant_facility`)))
    WHERE
        (`pr`.`verdict` = 1);
