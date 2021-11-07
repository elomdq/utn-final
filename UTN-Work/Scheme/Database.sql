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

create table if not exists admins(
	id_admin int AUTO_INCREMENT not null,
	firstName varchar(40),
	lastName varchar(40),
    id_user int not null,
    CONSTRAINT `pk_id_admin` PRIMARY KEY(id_admin),
    CONSTRAINT `fk_user` FOREIGN KEY(id_user) REFERENCES users(id_user)
) ENGINE=INNODB;

create table if not exists students(
	id_student int AUTO_INCREMENT not null,
	firstName varchar(40),
	lastName varchar(40),
	dni varchar(10),
    birthDate date,
    gender char(1),
    id_user int,
	id_telephone int,
	fileNumber varchar(50),
	id_career int,
    CONSTRAINT `pk_student` PRIMARY KEY(id_student),
    CONSTRAINT `fk_user_student` FOREIGN KEY(id_user) REFERENCES users(id_user),
	CONSTRAINT `fk_id_career` FOREIGN KEY(id_career) REFERENCES careers(id_career),
	CONSTRAINT `fk_id_telephone` FOREIGN KEY(id_telephone) REFERENCES telephones(id_telephone),
    CONSTRAINT `unq_student` UNIQUE(dni)
) ENGINE=INNODB;

create table if not exists students(
	id_student int AUTO_INCREMENT not null,
	firstName varchar(40),
	lastName varchar(40),
	dni varchar(20),
    birthDate varchar(50),
    gender varchar(30),
    id_user int,
    CONSTRAINT `pk_student` PRIMARY KEY(id_student),
    CONSTRAINT `fk_user_student` FOREIGN KEY(id_user) REFERENCES users(id_user),
    CONSTRAINT `unq_student` UNIQUE(dni)
) ENGINE=INNODB;

create table if not exists careers(
	id_career int AUTO_INCREMENT not null,
    desciprtion varchar(100),
    CONSTRAINT `pk_id_career` PRIMARY KEY(id_career)
) ENGINE=INNODB;

create table if not exists offers(
	id_jobOffer int AUTO_INCREMENT not null,
	id_company int not null,
	jobPosition varchar(50) not null,
	career varchar(50) not null,
	title varchar(50) not null,
	active int not null,
	publicationDate date not null,
    offerDescription varchar(5000),
    CONSTRAINT `pk_job_offer` PRIMARY KEY(id_jobOffer),
    CONSTRAINT `fk_id_company` FOREIGN KEY(id_company) REFERENCES companies(id_company),
) ENGINE=INNODB;

create table if not exists companies(
	id_compnay int AUTO_INCREMENT not null,
	companyName varchar(50) not null,
	id_user int not null,
    direccion varchar(100),
	cuit varchar(100),
	active int not null,
    CONSTRAINT `pk_id_company` PRIMARY KEY(id_company),
    CONSTRAINT `fk_id_user` FOREIGN KEY(id_user) REFERENCES users(id_user)
) ENGINE=INNODB;

create table if not exists students_x_offers(
	id_student_x_offer int AUTO_INCREMENT not null,
	id_offer int not null,
	id_student int not null,
    CONSTRAINT `pk_id_student_x_offer` PRIMARY KEY(id_student_x_offer),
    CONSTRAINT `fk_id_offer` FOREIGN KEY(id_offer) REFERENCES offers(id_offer),
    CONSTRAINT `fk_id_student` FOREIGN KEY(id_student) REFERENCES students(id_student)
) ENGINE=INNODB;

create table if not exists telephones(
	id_telephone int AUTO_INCREMENT not null,
	phoneNumber varchar(50) not null,
	id_user int not null,
    CONSTRAINT `pk_id_telephone` PRIMARY KEY(id_telephone),
    CONSTRAINT `fk_id_user` FOREIGN KEY(id_user) REFERENCES users(id_user)
) ENGINE=INNODB;

