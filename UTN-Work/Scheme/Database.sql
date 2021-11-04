create database if not exists tp_final;

use tp_final;

create table if not exists users(
	id_user int AUTO_INCREMENT not null,
	email varchar(50) not null,
	pass varchar(10) not null,
	active boolean not null,
	constraint `pk_user` primary key(id_user),
	CONSTRAINT `unq_email` UNIQUE(email)
) ENGINE=INNODB;

create table if not exists students(
	id_student int AUTO_INCREMENT not null,
	firstName varchar(40),
	lastName varchar(40),
	dni varchar(10) not null,
    birthDate date not null,
    gender char,
    id_user int not null,
    CONSTRAINT `pk_student` PRIMARY KEY(id_student),
    CONSTRAINT `fk_user_student` FOREIGN KEY(id_user) REFERENCES users(id_user),
    CONSTRAINT `unq_student` UNIQUE(dni)
) ENGINE=INNODB;

