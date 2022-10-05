  
update data_report set created_at =DATE_ADD(created_at, INTERVAL 10 HOUR)
  
select count(*) from data_report


DROP EVENT IF EXISTS clean_old_records;
DELIMITER $$ 
CREATE EVENT clean_old_records
  ON SCHEDULE EVERY 1 MINUTE STARTS NOW()
  ON COMPLETION PRESERVE
DO
BEGIN
	
	delete from data_report where  created_at<= DATE_ADD(CURDATE() , INTERVAL -8 hour);
 commit; 
END $$
DELIMITER ;

show variables where variable_name='event_scheduler'; -- OFF currently
SET GLOBAL event_scheduler = ON; -- turn her on
SHOW EVENTS in so_gibberish; -- confirm

 
select count(*) from data_report where  created_at<= DATE_ADD(CURDATE() , INTERVAL -8 hour)