USE photo;

drop VIEW if EXISTS complete_items,correct_label,wrong_info;
CREATE VIEW complete_items AS select items.id,COUNT(label) as count_label from items,item_users 
where items.id = item_users.item_id 
and items.flag = 0 GROUP BY items.id HAVING count(label)>=3;

CREATE VIEW correct_label AS select item_users.item_id,label as right_label,complete_items.count_label,
count(label) as count_maxlabel 
from complete_items,item_users 
where complete_items.id = item_users.item_id GROUP BY item_users.item_id,label 
having count(label)>=(complete_items.count_label+1)/2 order by item_users.item_id;

CREATE VIEW wrong_info AS select id as item_user_id,item_users.item_id,user_id,label,right_label 
from item_users, correct_label 
where item_users.item_id = correct_label.item_id and label <> right_label order by item_users.id;

drop PROCEDURE if EXISTS checklabel;
delimiter //
CREATE PROCEDURE checklabel()
BEGIN
insert into wrong_item_user_labels(item_user_id,user_id,created_at,updated_at) select item_user_id,user_id,NOW(),NOW() from  wrong_info;
update users,(select user_id,count(user_id) as count_user from wrong_info GROUP BY user_id) as user_wrong 
set users.points = users.points-user_wrong.count_user where users.id = user_wrong.user_id; 
update items set items.flag = 1 where items.id IN (select complete_items.id from complete_items );
END
//
delimiter ;

SET GLOBAL event_scheduler = 1;
drop EVENT if EXISTS checkevent;
create event if not exists checkevent
on schedule every 60 second starts NOW() /*1 day/hour/minute/second   | starts :'2016-01-01 03:00:00' */
on completion preserve
do call checklabel();

ALTER EVENT checkevent ON
COMPLETION PRESERVE ENABLE;
/*
ALTER EVENT checkevent ON
COMPLETION PRESERVE DISABLE;
*/