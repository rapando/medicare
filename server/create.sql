-- MySQL Statements for creating the Database Tables

CREATE TABLE counties (
	id int primary key auto_increment,
	name varchar(100) not null unique
);

INSERT INTO counties (id, name) 
VALUES
 ('1', 'Nairobi County'),
 ('2', 'Mombasa County'),
 ('3', 'Turkana County'),
 ('4', 'Kiambu County'),
 ('5', 'Machakos County'),
 ('6', 'Kakamega County');

 CREATE TABLE hospitals (
 	id int primary key auto_increment,
 	name varchar(100) not null unique,
 	location  text not null,
 	county int,

 	foreign key (county) references counties(id)
 );

 CREATE TABLE diseases (
 	id int primary key auto_increment,
 	name varchar(100) not null unique
 );

 CREATE TABLE doctors (
 	id int primary key auto_increment,
 	name varchar(100) not null,
 	specialization int,
 	hospital int,
 	username varchar(100) not null unique,
 	pass text not null,
 	salt text not null,
 	otherDetails  text,
 	image varchar(250) null unique,

 	foreign key (hospital) references hospitals(id),
 	foreign key (specialization) references diseases(id)
 );

 CREATE TABLE patients (
 	id int primary key auto_increment,
 	name varchar(100) not null,
 	username varchar(100) not null unique,
 	diseases varchar(100) not null,
 	pass text not null,
 	salt text not null
 );

 CREATE TABLE pharmacies (
 	id int primary key auto_increment,
 	phoneNumber varchar(30) not null unique,
 	location text not null,
 	county int,

 	foreign key (county) references counties(id)
 );

 CREATE TABLE medicine (
 	id int primary key auto_increment,
 	disease int,
 	foreign key (disease) references diseases (id)
 );

 CREATE TABLE pharmacyMedicine (
 	id int primary key auto_increment,
 	medicine int,
 	pharmacy int,

 	foreign key (medicine) references medicine(id),
 	foreign key (pharmacy) references pharmacies(id)
 );

 CREATE TABLE appointments(
 	id int primary key auto_increment,
 	doctor int,
 	patient int,
 	moment bigint(30) not null,

 	foreign key (doctor) references doctors(id),
 	foreign key (patient) references patients(id)
 );

 CREATE TABLE prescription (
 	id int primary key auto_increment,
 	doctor int,
 	patient int, 
 	startTime bigint(30) not null,
 	tabletNo int,
 	frequency int,
 	days int,

 	foreign key (doctor) references doctors(id),
 	foreign key (patient) references patients(id)
 );

 CREATE TABLE  admin (
 	id int primary key auto_increment,
 	username varchar(100) not null unique,
 	pass text not null,
 	salt text not null
 );