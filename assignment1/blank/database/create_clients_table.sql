drop table if exists clients;
create table clients (    
    id integer not null primary key autoincrement,    
    clientname varchar(40) not null,
    clientage int not null,
    clientlicense varchar(40) not null,
    clientlicensetype varchar(10) not null,
    clientstate varchar(40) not null
); 

insert into clients values (null, "Justin Bieber",  27, "111 222 333", "P1", "Queensland");
insert into clients values (null, "Kanye West", 44, "321 456 789", "P2", "New South Wales");
insert into clients values (null, "Kobe Bryant", 42, "246 999 876", "O", "Victoria");
insert into clients values (null, "Chris Hemsworth", 38, "444 543 789", "O", "West Australia");
insert into clients values (null, "SpiderMan", 16, "232 435 676", "L", "South Australia");