 
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(20) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `role` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_role`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) DEFAULT NULL,
  `name_es` varchar(50) NOT NULL,
  `name_en` varchar(50) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_menu`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

  
CREATE TABLE `menu_role` (
  `id_role` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_role`,`id_menu`),
  CONSTRAINT `fk_menu_role_role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`),
  CONSTRAINT `fk_menu_role_menu` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`)
 ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;
  

  
CREATE TABLE `user_role` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_user`,`id_role`),
  CONSTRAINT `fk_user_role_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  CONSTRAINT `fk_user_role_role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`)

 ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;


CREATE TABLE `client` (
  `id_client` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_client`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB   DEFAULT CHARSET=utf8mb4;


 CREATE TABLE `location` (
  `id_location` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_location`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

 
 CREATE TABLE `department` (
  `id_department` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_department`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;
 
 
CREATE TABLE `medical_device` (
  `id_medical_device` int(11) NOT NULL AUTO_INCREMENT,
  `no_serial` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(20) DEFAULT NULL,
  `geolocation` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_medical_device`),
  UNIQUE KEY `no_serial` (`no_serial`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

   
CREATE TABLE `client_device_location` (
  `id_client` int(11) NOT NULL,
  `id_medical_device` int(11) NOT NULL,
  `id_location` int(11) NOT NULL,
  `id_department` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_client`,`id_medical_device`,`id_location`,`id_department`),
  CONSTRAINT `fk_cdld_client` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`),
  CONSTRAINT `fk_cdld_medical_device` FOREIGN KEY (`id_medical_device`) REFERENCES `medical_device` (`id_medical_device`),
  CONSTRAINT `fk_cdld_location` FOREIGN KEY (`id_location`) REFERENCES `location` (`id_location`),
  CONSTRAINT `fk_cdld_department` FOREIGN KEY (`id_department`) REFERENCES `department` (`id_department`)
 
 ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;


CREATE TABLE `user_client` (
  `id_user` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_user`,`id_client`),
  CONSTRAINT `fk_user_client_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  CONSTRAINT `fk_user_client_client` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`)
 ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;


CREATE TABLE `priority` (
  `id_priority` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_priority`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;
  

 CREATE TABLE `category` (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;
 
  

 CREATE TABLE `status` (
  `id_status` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;
  
 
 CREATE TABLE `ticket_mode` (
  `id_ticket_mode` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_ticket_mode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;
 
  
 CREATE TABLE `ticket_service` (
  `id_ticket_service` int(11) NOT NULL AUTO_INCREMENT,
  `id_priority` int(11) NOT NULL,  
  `id_category` int(11) NOT NULL, 
  `id_status` int(11) NOT NULL,   
  `id_ticket_mode` int(11) NOT NULL,  
  `id_user_generate` int(11) NOT NULL,  
  `id_user_assigned` int(11) NOT NULL,   
  `subject` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_ticket_service`),
  CONSTRAINT `fk_ticket_service_priority` FOREIGN KEY (`id_priority`) REFERENCES `priority` (`id_priority`),
  CONSTRAINT `fk_ticket_service_category` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`),
  CONSTRAINT `fk_ticket_service_status` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`),
  CONSTRAINT `fk_ticket_service_ticket_mode` FOREIGN KEY (`id_ticket_mode`) REFERENCES `ticket_mode` (`id_ticket_mode`),
  CONSTRAINT `fk_ticket_service_user_gen` FOREIGN KEY (`id_user_generate`) REFERENCES `user` (`id_user`),
  CONSTRAINT `fk_ticket_service_user_assig` FOREIGN KEY (`id_user_assigned`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

 
 CREATE TABLE `ticket_detail` (
  `id_ticket_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_ticket_service` int(11) NOT NULL,
  `serial_device` varchar(20) NOT NULL,
  `contact_name` varchar(100) DEFAULT NULL,
  `contact_email` varchar(20) DEFAULT NULL,
  `contact_phone` varchar(15) DEFAULT NULL,
  `folio_sheet` varchar(30) DEFAULT NULL,
  `e_down` varchar(10) DEFAULT NULL,
  `external_register` varchar(20) DEFAULT NULL,
  `activities` varchar(300) DEFAULT NULL,
  `digital_file` tinyint(1) NOT NULL DEFAULT 0,
  `phisycal_file` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_ticket_detail`),
  CONSTRAINT `fk_ticket_detail_ticket_service` FOREIGN KEY (`id_ticket_service`) REFERENCES `ticket_service` (`id_ticket_service`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
 
 
 CREATE TABLE `ticket_comment` (
  `id_ticket_comment` int(11) NOT NULL AUTO_INCREMENT,
  `id_ticket_comment_parent` int(11) DEFAULT NULL ,
  `id_user` int(11) NOT NULL,
  `id_ticket_service` int(11) NOT NULL,  
  `content` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_ticket_comment`),
  CONSTRAINT `fk_ticket_comment_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  CONSTRAINT `fk_ticket_comment_ticket` FOREIGN KEY (`id_ticket_service`) REFERENCES `ticket_service` (`id_ticket_service`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;
 

 CREATE TABLE `ticket_attachment` (
  `id_attachment` int(11) NOT NULL AUTO_INCREMENT,
  `id_ticket_service` int(11) NOT NULL ,
  `name` varchar(100) NOT NULL,
  `url` varchar(100) DEFAULT NULL,
  `extension` varchar(100) NOT NULL,
  `blob_file` blob,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_attachment`),
  CONSTRAINT `fk_ticket_attachment_ticket` FOREIGN KEY (`id_ticket_service`) REFERENCES `ticket_service` (`id_ticket_service`)
 
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;
 