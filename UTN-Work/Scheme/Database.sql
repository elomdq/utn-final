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

create table if not exists careers(
	id_career int AUTO_INCREMENT not null,
    desciprtion varchar(100),
    CONSTRAINT `pk_id_career` PRIMARY KEY(id_career)
) ENGINE=INNODB;

create table if not exists companies(
	id_company int AUTO_INCREMENT not null,
	companyName varchar(50) not null,
	id_user int not null,
    direccion varchar(100),
	cuit varchar(100),
	active int not null,
    CONSTRAINT `pk_id_company` PRIMARY KEY(id_company),
    CONSTRAINT `fk_id_user` FOREIGN KEY(id_user) REFERENCES users(id_user)
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
    CONSTRAINT `fk_id_company` FOREIGN KEY(id_company) REFERENCES companies(id_company)
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

/*
CREATE TABLE `admins` (
 `id_admin` int(11) NOT NULL AUTO_INCREMENT,
 `firstName` varchar(40) DEFAULT NULL,
 `lastName` varchar(40) DEFAULT NULL,
 `id_user` int(11) NOT NULL,
 PRIMARY KEY (`id_admin`),
 KEY `fk_userAdmin` (`id_user`),
 CONSTRAINT `fk_userAdmin` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB

CREATE TABLE `careers` (
 `id_career` int(11) NOT NULL AUTO_INCREMENT,
 `desciprtion` varchar(100) DEFAULT NULL,
 PRIMARY KEY (`id_career`)
) ENGINE=InnoDB

CREATE TABLE `companies` (
 `id_company` int(11) NOT NULL AUTO_INCREMENT,
 `companyName` varchar(50) NOT NULL,
 `id_user` int(11) NOT NULL,
 `direccion` varchar(100) DEFAULT NULL,
 `cuit` varchar(100) DEFAULT NULL,
 `active` int(11) NOT NULL,
 PRIMARY KEY (`id_company`),
 KEY `fk_userCompany` (`id_user`),
 CONSTRAINT `fk_userCompany` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB

CREATE TABLE `offers` (
 `id_jobOffer` int(11) NOT NULL AUTO_INCREMENT,
 `id_company` int(11) NOT NULL,
 `jobPosition` varchar(50) NOT NULL,
 `career` varchar(50) NOT NULL,
 `title` varchar(50) NOT NULL,
 `active` int(11) NOT NULL,
 `publicationDate` date NOT NULL,
 `offerDescription` varchar(5000) DEFAULT NULL,
 PRIMARY KEY (`id_jobOffer`),
 KEY `fk_company` (`id_company`),
 CONSTRAINT `fk_company` FOREIGN KEY (`id_company`) REFERENCES `companies` (`id_company`)
) ENGINE=InnoDB

CREATE TABLE `students` (
 `id_student` int(11) NOT NULL AUTO_INCREMENT,
 `firstName` varchar(40) DEFAULT NULL,
 `lastName` varchar(40) DEFAULT NULL,
 `dni` varchar(10) DEFAULT NULL,
 `birthDate` date DEFAULT NULL,
 `gender` char(1) DEFAULT NULL,
 `id_user` int(11) DEFAULT NULL,
 `id_telephone` int(11) DEFAULT NULL,
 `fileNumber` varchar(50) DEFAULT NULL,
 `id_career` int(11) DEFAULT NULL,
 PRIMARY KEY (`id_student`),
 UNIQUE KEY `unq_student` (`dni`),
 KEY `fk_user_student` (`id_user`),
 KEY `fk_career` (`id_career`),
 KEY `fk_telephone` (`id_telephone`),
 CONSTRAINT `fk_career` FOREIGN KEY (`id_career`) REFERENCES `careers` (`id_career`),
 CONSTRAINT `fk_telephone` FOREIGN KEY (`id_telephone`) REFERENCES `telephones` (`id_telephone`),
 CONSTRAINT `fk_user_student` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB

CREATE TABLE `students_x_offers` (
 `id_student_x_offer` int(11) NOT NULL AUTO_INCREMENT,
 `id_offer` int(11) NOT NULL,
 `id_student` int(11) NOT NULL,
 PRIMARY KEY (`id_student_x_offer`),
 KEY `fk_jobOffer` (`id_offer`),
 KEY `fk_student` (`id_student`),
 CONSTRAINT `fk_jobOffer` FOREIGN KEY (`id_offer`) REFERENCES `offers` (`id_jobOffer`),
 CONSTRAINT `fk_student` FOREIGN KEY (`id_student`) REFERENCES `students` (`id_student`)
) ENGINE=InnoDB

CREATE TABLE `telephones` (
 `id_telephone` int(11) NOT NULL AUTO_INCREMENT,
 `phoneNumber` varchar(50) NOT NULL,
 `id_user` int(11) NOT NULL,
 PRIMARY KEY (`id_telephone`),
 KEY `fk_userTelephone` (`id_user`),
 CONSTRAINT `fk_userTelephone` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB

CREATE TABLE `users` (
 `id_user` int(11) NOT NULL AUTO_INCREMENT,
 `email` varchar(50) NOT NULL,
 `pass` varchar(10) NOT NULL,
 `active` tinyint(1) NOT NULL,
 PRIMARY KEY (`id_user`),
 UNIQUE KEY `unq_email` (`email`)
) ENGINE=InnoDB
*/