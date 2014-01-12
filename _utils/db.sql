drop table holidays; 

create table holidays (
	holiday_date date primary key,
	holiday_name varchar(50),
	holiday_dow varchar(10)
);

insert into holidays(holiday_date, holiday_name) values ('2014-01-01', 'Año Nuevo');
insert into holidays(holiday_date, holiday_name) values ('2014-01-06', 'Día de los Reyes Magos');
insert into holidays(holiday_date, holiday_name) values ('2014-03-24', 'Día de San José');
insert into holidays(holiday_date, holiday_name) values ('2014-04-17', 'Jueves Santo (Semana Santa)');
insert into holidays(holiday_date, holiday_name) values ('2014-04-18', 'Viernes Santo (Semana Santa)');
insert into holidays(holiday_date, holiday_name) values ('2014-05-01', 'Día del Trabajo');
insert into holidays(holiday_date, holiday_name) values ('2014-06-02', 'Día de la Ascencion');
insert into holidays(holiday_date, holiday_name) values ('2014-06-23', 'Corpus Christi');
insert into holidays(holiday_date, holiday_name) values ('2014-06-30', 'Sagrado Corazón');
insert into holidays(holiday_date, holiday_name) values ('2014-06-30', 'San Pedro y San Pablo');
insert into holidays(holiday_date, holiday_name) values ('2014-06-20', 'Día de la Independencia');
insert into holidays(holiday_date, holiday_name) values ('2014-08-07', 'Batalla de Boyaca');
insert into holidays(holiday_date, holiday_name) values ('2014-08-18', 'Día de la Ascensión');
insert into holidays(holiday_date, holiday_name) values ('2014-10-13', 'Día de la raza');
insert into holidays(holiday_date, holiday_name) values ('2014-11-03', 'Día de Todos los Santos');
insert into holidays(holiday_date, holiday_name) values ('2014-11-17', 'Independencia de Cartagena');
insert into holidays(holiday_date, holiday_name) values ('2014-12-08', 'Día de la Inmaculada Concepción');
insert into holidays(holiday_date, holiday_name) values ('2014-12-25', 'Navidad');