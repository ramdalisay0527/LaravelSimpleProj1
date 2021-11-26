drop table if exists bookings;
create table bookings (    
    booking_id integer not null primary key autoincrement,   
    vehiclebooking_id integer,
    clientbooking_id integer,
    bookingdate date,
    bookingtime time,
    returndate date,
    returntime time,
    bookingreturned int, 
    FOREIGN KEY (vehiclebooking_id)
        REFERENCES vehicles(id),
    FOREIGN KEY (clientbooking_id) 
        REFERENCES clients(id)
); 

insert into bookings values (null, 1, 1, "2021-09-08","10:00:00","2021-09-08","12:00:00", 0);
insert into bookings values (null, 2, 2, "2021-09-09","10:00:00","2021-09-00","12:00:00", 0);
insert into bookings values (null, 3, 3, "2021-09-10","10:00:00","2021-09-10","12:00:00", 0);
insert into bookings values (null, 4, 4, "2021-09-11","10:00:00","2021-09-11","12:00:00", 0);
insert into bookings values (null, 5, 5, "2021-09-12","10:00:00","2021-09-12","12:00:00", 0);