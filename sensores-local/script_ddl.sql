-- sensores.device definition

CREATE TABLE `device` (
  `id_device` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL,
  `serial` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `ip_address` varchar(20) DEFAULT NULL,
  `geolocation` varchar(20) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `tag` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_device`),
  UNIQUE KEY `serial` (`serial`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;


-- sensores.sensor definition

CREATE TABLE `sensor` (
  `id_sensor` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_sensor`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;


-- sensores.client definition

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL AUTO_INCREMENT,
  `id_device` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_client`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `code` (`code`),
  KEY `fk_client_device` (`id_device`),
  CONSTRAINT `fk_client_device` FOREIGN KEY (`id_device`) REFERENCES `device` (`id_device`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

 
-- sensores.data_report definition
 
CREATE TABLE `data_report` (
  `id_data_report` int(11) NOT NULL AUTO_INCREMENT,
  `id_device` int(11) NOT NULL,
  `id_sensor` int(11) NOT NULL,
  `valor` decimal(10,5) NOT NULL,
  `alert` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_data_report`),
  KEY `fk_sensor_data_report` (`id_sensor`),
  KEY `fk_device_data_report` (`id_device`),
  CONSTRAINT `fk_device_data_report` FOREIGN KEY (`id_device`) REFERENCES `device` (`id_device`),
  CONSTRAINT `fk_sensor_data_report` FOREIGN KEY (`id_sensor`) REFERENCES `sensor` (`id_sensor`)
) ENGINE=InnoDB AUTO_INCREMENT=1911 DEFAULT CHARSET=utf8mb4;

-- sensores.device_sensor definition


CREATE TABLE `device_sensor` (
  `id_device` int(11) NOT NULL,
  `id_sensor` int(11) NOT NULL,
  `correction_factor` decimal(10,5) DEFAULT 0,
  `min` decimal(10,0) DEFAULT NULL,
  `max` decimal(10,0) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_sensor`,`id_device`),
  KEY `fk_device_sensor_device` (`id_device`),
  CONSTRAINT `fk_device_sensor_device` FOREIGN KEY (`id_device`) REFERENCES `device` (`id_device`),
  CONSTRAINT `fk_device_sensor_sensor` FOREIGN KEY (`id_sensor`) REFERENCES `sensor` (`id_sensor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
 
-- sensores.client_device definition
 
CREATE TABLE `client_device` (
  `id_client` int(11) NOT NULL,
  `id_device` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_client`,`id_device`),
  KEY `fk_client_device_device` (`id_device`),
  CONSTRAINT `fk_client_device_client` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`),
  CONSTRAINT `fk_client_device_device` FOREIGN KEY (`id_device`) REFERENCES `device` (`id_device`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
