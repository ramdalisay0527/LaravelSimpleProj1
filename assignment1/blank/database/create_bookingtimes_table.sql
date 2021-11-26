drop table if exists bookingtimes;
create table bookingtimes (    
    bookingtime_id integer not null primary key autoincrement,   
    rego varchar,
    hoursbooking int
    -- booking_id integer,
    -- bookingdatetime datetime,
    -- returndatetime datetime, 
    -- FOREIGN KEY (vehiclebooking_id)
    --     REFERENCES bookings(vehiclebooking_id),
    -- FOREIGN KEY (booking_id) 
    --     REFERENCES bookings(booking_id)
); 

insert into bookingtimes values (null, "457AI2", 2);