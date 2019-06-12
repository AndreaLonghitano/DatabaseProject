/* I modified the DB given by the teacher because there was something wrong */

CREATE TABLE `account` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `activation_date` date NOT NULL,
  `passw` varchar(60) NOT NULL,
  `username` varchar(20) NOT NULL,
  `token` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `birth` date NOT NULL,
  `email` varchar(40) NOT NULL,
  `photo` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `newUser` (`user_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `account` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `meeting` (
  `meeting_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `place` varchar(300) NOT NULL,
  `date` datetime DEFAULT NULL,
  `topic` varchar(300) DEFAULT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `card_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`meeting_id`),
  UNIQUE KEY `meeting_id` (`meeting_id`),
  KEY `newMEETING` (`user_id`),
  KEY `card_idfk_2_idx` (`card_id`),
  CONSTRAINT `card_idfk_2` FOREIGN KEY (`card_id`) REFERENCES `cards` (`card_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `meeting_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

CREATE TABLE `education_experience` (
  `education_experience_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `year` int(11) NOT NULL,
  `place` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`education_experience_id`),
  UNIQUE KEY `education_experience_id` (`education_experience_id`),
  KEY `user_idx` (`user_id`),
  CONSTRAINT `education_experience_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;


CREATE TABLE `company` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `place` varchar(40) NOT NULL,
  `web` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `note` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`company_id`),
  UNIQUE KEY `company_id` (`company_id`),
  UNIQUE KEY `name` (`name`,`place`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;


CREATE TABLE `work_experience` (
  `work_experience_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role` varchar(20) NOT NULL,
  `year` int(11) NOT NULL,
  PRIMARY KEY (`work_experience_id`),
  UNIQUE KEY `work_experience_id` (`work_experience_id`),
  UNIQUE KEY `company_id` (`company_id`,`user_id`,`year`),
  KEY `user_idx` (`user_id`),
  KEY `company_idx` (`company_id`),
  CONSTRAINT `work_experience_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `work_experience_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

CREATE TABLE `invite` (
  `user_id` int(11) NOT NULL,
  `meeting_id` int(11) NOT NULL,
  `reply` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`meeting_id`),
  KEY `newID` (`user_id`),
  KEY `newINVITE` (`meeting_id`),
  CONSTRAINT `invite_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `invite_ibfk_2` FOREIGN KEY (`meeting_id`) REFERENCES `meeting` (`meeting_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `cards` (
  `card_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `photo` varchar(300) DEFAULT NULL,
  `note` varchar(300) DEFAULT NULL,
  `education_experience_id` int(11) NOT NULL,
  `work_experience_id` int(11) NOT NULL,
  PRIMARY KEY (`card_id`),
  UNIQUE KEY `card_id` (`card_id`),
  KEY `education_experience_idx` (`education_experience_id`),
  KEY `work_experience_idx` (`work_experience_id`),
  KEY `newCARD` (`user_id`),
  CONSTRAINT `cards_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cards_ibfk_2` FOREIGN KEY (`education_experience_id`) REFERENCES `education_experience` (`education_experience_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cards_ibfk_3` FOREIGN KEY (`work_experience_id`) REFERENCES `work_experience` (`work_experience_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;


CREATE TABLE `partecipate` (
  `user_id` int(11) NOT NULL,
  `meeting_id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`meeting_id`),
  KEY `new_ID` (`user_id`),
  KEY `newPARTECIPATE` (`meeting_id`),
  KEY `card_idx` (`card_id`),
  CONSTRAINT `partecipate_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `partecipate_ibfk_2` FOREIGN KEY (`meeting_id`) REFERENCES `meeting` (`meeting_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `partecipate_ibfk_3` FOREIGN KEY (`card_id`) REFERENCES `cards` (`card_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `partecipate` (
  `user_id` int(11) NOT NULL,
  `meeting_id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`meeting_id`),
  KEY `new_ID` (`user_id`),
  KEY `newPARTECIPATE` (`meeting_id`),
  KEY `card_idx` (`card_id`),
  CONSTRAINT `partecipate_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `partecipate_ibfk_2` FOREIGN KEY (`meeting_id`) REFERENCES `meeting` (`meeting_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `partecipate_ibfk_3` FOREIGN KEY (`card_id`) REFERENCES `cards` (`card_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






CREATE TABLE `wallet` (
  `user_id` int(11) NOT NULL,
  `meeting_id` int(11) NOT NULL,
  `note` varchar(300) DEFAULT NULL,
  `useful` tinyint(4) DEFAULT NULL,
  `importance` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`meeting_id`),
  KEY `new_USER` (`user_id`),
  KEY `new_MEETING` (`meeting_id`),
  CONSTRAINT `wallet_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `wallet_ibfk_2` FOREIGN KEY (`meeting_id`) REFERENCES `meeting` (`meeting_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `user_rating` (
  `user_id` int(11) NOT NULL,
  `meeting_id` int(11) NOT NULL,
  `rated_user` int(11) NOT NULL,
  `note` varchar(300) DEFAULT NULL,
  `professionality` tinyint(4) DEFAULT NULL,
  `availability` tinyint(4) DEFAULT NULL,
  `impression` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`meeting_id`,`rated_user`),
  KEY `new_USER` (`user_id`),
  KEY `new_RatedUser` (`rated_user`),
  KEY `new_Meeting` (`meeting_id`),
  CONSTRAINT `user_rating_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_rating_ibfk_2` FOREIGN KEY (`meeting_id`) REFERENCES `meeting` (`meeting_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_rating_ibfk_3` FOREIGN KEY (`rated_user`) REFERENCES `cards` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;





/* TRIGGER */

Delimiter //
CREATE trigger insertinvite after insert on partecipate  
for each row
begin
update invite set reply=1 where user_id=NEW.user_id and meeting_id=NEW.meeting_id;
end //

delimiter ;




