drop procedure if exists saturday;
delimiter //
create procedure saturday(IN user_id int(11), IN start_date date,  IN end_date date, IN type_vacation varchar(11))

begin
DECLARE Counter INT;
DECLARE TotalCount INT;
DECLARE DateValue DATE;

SET Counter = 0;
SET TotalCount = DateDiff(end_date, start_date);
SET start_date = DATE_SUB(start_date, INTERVAL 1 DAY);
 
WHILE (Counter <=TotalCount) DO


  SET  DateValue = DATE_ADD(start_date, INTERVAL 1 DAY);
  if (dayofweek(DateValue) != "1" && DateValue != "2023-01-01" && DateValue != "2023-01-06" && DateValue != "2023-04-09" && DateValue != "2023-04-10" && DateValue != "2023-05-01" && DateValue != "2023-05-03" && DateValue != "2023-06-08" && DateValue != "2023-08-15" && DateValue != "2023-11-01" && DateValue != "2023-11-11" && DateValue != "2023-12-25" && DateValue != "2023-12-26" && DateValue != "2024-01-01" && DateValue != "2024-01-06" && DateValue != "2024-03-31" && DateValue != "2024-04-01" && DateValue != "2024-05-01" && DateValue != "2024-05-03" && DateValue != "2024-05-30" && DateValue != "2024-08-15" && DateValue != "2024-11-01" && DateValue != "2024-11-11" && DateValue != "2024-12-25" && DateValue != "2024-12-26") then
    INSERT INTO vacations (user_id, vacation_date, type_vacation) values (user_id, DateValue, type_vacation);

 end if;
    SET Counter = Counter + 1;
    SET start_date = DateValue;
END WHILE;


end //

delimiter ;