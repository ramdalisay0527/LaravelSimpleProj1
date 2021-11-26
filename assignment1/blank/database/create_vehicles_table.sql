drop table if exists vehicles;
create table vehicles (    
    id integer not null primary key autoincrement,    
    rego varchar(6) not null,
    model varchar(40) not null,
    modelyear int not null,
    odometer int not null,
    color varchar not null,
    bookingcount int not null
); 

insert into vehicles values (null, "457AI2",  "Holden Cruze", 2010, 89000, "white", 1);
insert into vehicles values (null, "123AAB", "Mazda 3", 2019, 54000, "black", 1);
insert into vehicles values (null, "PET127",  "Holden Commodore", 2006, 200000, "green", 1);
insert into vehicles values (null, "ZRD589", "Toyota Hilux", 2021, 2000, "grey", 1);
insert into vehicles values (null, "LEX316", "Mitsubishi Lancer", 2017, 35000, "silver", 1);
