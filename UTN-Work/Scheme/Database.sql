create database if not exists tp_final;

use tp_final;

CREATE TABLE `users` (
 `id_user` int(11) NOT NULL AUTO_INCREMENT,
 `email` varchar(50) NOT NULL,
 `pass` varchar(10) NOT NULL,
 `active` tinyint(1) NOT NULL,
 `userType` tinyint(1) NOT NULL,
 PRIMARY KEY (`id_user`),
 UNIQUE KEY `unq_email` (`email`)
) ENGINE=InnoDB;

CREATE TABLE `admins` (
 `id_admin` int(11) NOT NULL AUTO_INCREMENT,
 `firstName` varchar(40) DEFAULT NULL,
 `lastName` varchar(40) DEFAULT NULL,
 `id_user` int(2) NOT NULL,
 PRIMARY KEY (`id_admin`),
 KEY `fk_userAdmin` (`id_user`),
 CONSTRAINT `fk_userAdmin` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB;

INSERT INTO `users`(email, pass, active, userType) VALUES('admin@admin', '123456', 1, 1);
INSERT INTO `admins`(id_user) VALUES(1);

/*
CREATE TABLE `careers` (
 `id_career` int(11) NOT NULL AUTO_INCREMENT,
 `description` varchar(100) DEFAULT NULL,
 `active` tinyint(1) not null,
 PRIMARY KEY (`id_career`)
) ENGINE=InnoDB;*/

/*CREATE TABLE `telephones` (
 `id_telephone` int(11) NOT NULL AUTO_INCREMENT,
 `phoneNumber` varchar(50) NOT NULL,
 `id_user` int(11) NOT NULL,
 PRIMARY KEY (`id_telephone`),
 KEY `fk_userTelephone` (`id_user`),
 CONSTRAINT `fk_userTelephone` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB;*/

CREATE TABLE `companies` (
 `id_company` int(11) NOT NULL AUTO_INCREMENT,
 `companyName` varchar(50) NOT NULL,
 `id_user` int(11) NOT NULL,
 `adress` varchar(100) DEFAULT NULL,
 `city` varchar(50) DEFAULT NULL,
 `cuit` varchar(100) DEFAULT NULL,
 `phoneNumber` int DEFAULT NULL,
 PRIMARY KEY (`id_company`),
 KEY `fk_userCompany` (`id_user`),
 CONSTRAINT `fk_userCompany` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB;

CREATE TABLE `offers` (
 `id_jobOffer` int(11) NOT NULL AUTO_INCREMENT,
 `id_company` int(11) NOT NULL,
 `jobPosition` varchar(50) NOT NULL,
 `career` varchar(50) NOT NULL,
 `title` varchar(50) NOT NULL,
 `active` tinyint(1) NOT NULL,
 `publicationDate` date NOT NULL,
 `dueDays` int(11) NOT NULL,
 `offerDescription` varchar(5000) DEFAULT NULL,
 PRIMARY KEY (`id_jobOffer`),
 KEY `fk_company` (`id_company`),
 CONSTRAINT `fk_company` FOREIGN KEY (`id_company`) REFERENCES `companies` (`id_company`)
) ENGINE=InnoDB;

CREATE TABLE `students` (
 `id_student` int(11) NOT NULL AUTO_INCREMENT,
 `firstName` varchar(40) DEFAULT NULL,
 `lastName` varchar(40) DEFAULT NULL,
 `dni` varchar(10) DEFAULT NULL,
 `birthDate` date DEFAULT NULL,
 `gender` varchar(20) DEFAULT NULL,
 `id_user` int(11) DEFAULT NULL,
 `phoneNumber` varchar(20) DEFAULT NULL,
 `fileNumber` varchar(50) DEFAULT NULL,
 `id_career` int(11) DEFAULT NULL,
 PRIMARY KEY (`id_student`),
 UNIQUE KEY `unq_student` (`dni`),
 KEY `fk_user_student` (`id_user`),
 /*KEY `fk_career` (`id_career`),
 CONSTRAINT `fk_career` FOREIGN KEY (`id_career`) REFERENCES `careers` (`id_career`),*/
 CONSTRAINT `fk_user_student` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB;

CREATE TABLE `students_x_offers` (
 `id_student_x_offer` int(11) NOT NULL AUTO_INCREMENT,
 `id_offer` int(11) NOT NULL,
 `id_student` int(11) NOT NULL,
 PRIMARY KEY (`id_student_x_offer`),
 KEY `fk_jobOffer` (`id_offer`),
 KEY `fk_student` (`id_student`),
 CONSTRAINT `fk_jobOffer` FOREIGN KEY (`id_offer`) REFERENCES `offers` (`id_jobOffer`),
 CONSTRAINT `fk_student` FOREIGN KEY (`id_student`) REFERENCES `students` (`id_student`)
) ENGINE=InnoDB;

CREATE TABLE `images` (
 `id_images` int(11) NOT NULL AUTO_INCREMENT,
 `id_offer` int(11) NOT NULL,
 `url` varchar(100) NOT NULL,
 PRIMARY KEY (`id_images`),
 KEY `fk_jobOffer_images` (`id_offer`),
 CONSTRAINT `fk_jobOffer_images` FOREIGN KEY (`id_offer`) REFERENCES `offers` (`id_jobOffer`)
) ENGINE=InnoDB;

CREATE TABLE `curriculums` (
 `id_curriculum` int(11) NOT NULL AUTO_INCREMENT,
 `id_student` int(11) NOT NULL,
 `url` varchar(100) NOT NULL,
 PRIMARY KEY (`id_curriculum`),
 KEY `fk_student_cv` (`id_student`),
 CONSTRAINT `fk_student_cv` FOREIGN KEY (`id_student`) REFERENCES `students` (`id_student`)
) ENGINE=InnoDB;

CREATE TABLE `profile_pictures` (
 `id_profile` int(11) NOT NULL AUTO_INCREMENT,
 `id_user` int(11) NOT NULL,
 `url` varchar(100) NOT NULL,
 PRIMARY KEY (`id_profile`),
 KEY `fk_user_picture` (`id_user`),
 CONSTRAINT `fk_user_picture` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB;