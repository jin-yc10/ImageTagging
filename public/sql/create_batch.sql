USE photo;
drop PROCEDURE if EXISTS create_batch;

DELIMITER $$

CREATE PROCEDURE create_batch ()
BEGIN

 DECLARE v_finished INTEGER DEFAULT 0;
 DECLARE remain_count INTEGER;
 DECLARE sid INTEGER;

 -- declare cursor for employee email
 DEClARE cursors CURSOR FOR
 SELECT standard_item_id,count(*) as remain_count FROM items group by standard_item_id;

 -- declare NOT FOUND handler
 DECLARE CONTINUE HANDLER
        FOR NOT FOUND SET v_finished = 1;



 OPEN cursors;

 batches: LOOP

 FETCH cursors INTO sid,remain_count;

 IF v_finished = 1 THEN
 LEAVE batches;
 END IF;

 INSERT INTO batches(standard_item_id,user_id,remain_count,created_at,updated_at) VALUES(sid,0,remain_count,NOW(),NOW());
 INSERT INTO batches(standard_item_id,user_id,remain_count,created_at,updated_at) VALUES(sid,0,remain_count,NOW(),NOW());
 INSERT INTO batches(standard_item_id,user_id,remain_count,created_at,updated_at) VALUES(sid,0,remain_count,NOW(),NOW());

 END LOOP batches;

 CLOSE cursors;

END$$

DELIMITER ;
