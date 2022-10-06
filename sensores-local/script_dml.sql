INSERT INTO sensores.sensor
(id_sensor, code, name, description, active, created_at)
VALUES(1, 'S-HUM', 'HUMEDAD', 'SENSOR DE HUMEDAD', 1, '2022-09-19 09:15:33');
INSERT INTO sensores.sensor
(id_sensor, code, name, description, active, created_at)
VALUES(2, 'S-TEMP', 'TEMPERATURA', 'SENSOR DE TEMPERATURA', 1, '2022-09-19 09:15:33');
INSERT INTO sensores.sensor
(id_sensor, code, name, description, active, created_at)
VALUES(3, 'S-CLP', 'CONDENSACION', 'SENSOR DE CONDENSACION EN LINEA DE PRESION', 1, '2022-09-19 09:15:33');


INSERT INTO sensores.device
(id_device, code, serial, name, ip_address, geolocation, description, tag, created_at)
VALUES(1, 'D-HAP', '45645645', 'Equipo RayoX', '', '', '', '', '2022-09-22 00:38:44');
INSERT INTO sensores.device
(id_device, code, serial, name, ip_address, geolocation, description, tag, created_at)
VALUES(2, 'D-HRAEB', '234345345', 'TomoTheraphy', NULL, NULL, NULL, NULL, '2022-09-22 00:38:44');
INSERT INTO sensores.device
(id_device, code, serial, name, ip_address, geolocation, description, tag, created_at)
VALUES(3, 'D-HS21', '456456453', 'Equipo RayoX', '', '', '', '', '2022-09-22 00:38:44');
INSERT INTO sensores.device
(id_device, code, serial, name, ip_address, geolocation, description, tag, created_at)
VALUES(4, 'D-004', '000004', 'Equipo 00004', '', '', '', '', '2022-09-22 00:38:44');
INSERT INTO sensores.device
(id_device, code, serial, name, ip_address, geolocation, description, tag, created_at)
VALUES(5, 'D-005', '000005', 'Equipo 00005', '', '', '', '', '2022-09-22 00:38:44');
INSERT INTO sensores.device
(id_device, code, serial, name, ip_address, geolocation, description, tag, created_at)
VALUES(6, 'D-006', '000006', 'Equipo 00006', '', '', '', '', '2022-09-22 00:38:44');
INSERT INTO sensores.device
(id_device, code, serial, name, ip_address, geolocation, description, tag, created_at)
VALUES(7, 'D-007', '000007', 'Equipo 00007', '', '', '', '', '2022-09-22 00:38:44');
INSERT INTO sensores.device
(id_device, code, serial, name, ip_address, geolocation, description, tag, created_at)
VALUES(8, 'D-008', '000008', 'Equipo 00008', '', '', '', '', '2022-09-22 00:38:44');
INSERT INTO sensores.device
(id_device, code, serial, name, ip_address, geolocation, description, tag, created_at)
VALUES(9, 'D-009', '000009', 'Equipo 00009', '', '', '', '', '2022-09-22 00:38:44');
INSERT INTO sensores.device
(id_device, code, serial, name, ip_address, geolocation, description, tag, created_at)
VALUES(10, 'D-010', '000010', 'Equipo 00010', '', '', '', '', '2022-09-22 00:38:44');


INSERT INTO sensores.device_sensor
(id_device, id_sensor, min, max, active, created_at, correction_factor)
VALUES(1, 1, 10, 20, 1, '2022-09-22 00:38:52', -5.00000);
INSERT INTO sensores.device_sensor
(id_device, id_sensor, min, max, active, created_at, correction_factor)
VALUES(2, 1, 1, 1, 1, '2022-09-22 20:09:59', 0.00000);
INSERT INTO sensores.device_sensor
(id_device, id_sensor, min, max, active, created_at, correction_factor)
VALUES(3, 1, 1, 1, 1, '2022-09-23 01:09:59', 0.00000);
INSERT INTO sensores.device_sensor
(id_device, id_sensor, min, max, active, created_at, correction_factor)
VALUES(4, 1, 0, 0, 1, '2022-09-23 01:09:59', 0.00000);
INSERT INTO sensores.device_sensor
(id_device, id_sensor, min, max, active, created_at, correction_factor)
VALUES(5, 1, 0, 0, 1, '2022-09-23 01:09:59', 0.00000);
INSERT INTO sensores.device_sensor
(id_device, id_sensor, min, max, active, created_at, correction_factor)
VALUES(6, 1, 0, 0, 1, '2022-09-23 01:09:59', 0.00000);
INSERT INTO sensores.device_sensor
(id_device, id_sensor, min, max, active, created_at, correction_factor)
VALUES(7, 1, 0, 0, 1, '2022-09-23 01:09:59', 0.00000);
INSERT INTO sensores.device_sensor
(id_device, id_sensor, min, max, active, created_at, correction_factor)
VALUES(8, 1, 0, 0, 1, '2022-09-23 01:09:59', 0.00000);
INSERT INTO sensores.device_sensor
(id_device, id_sensor, min, max, active, created_at, correction_factor)
VALUES(9, 1, 0, 0, 1, '2022-09-23 01:09:59', 0.00000);
INSERT INTO sensores.device_sensor
(id_device, id_sensor, min, max, active, created_at, correction_factor)
VALUES(10, 1, 0, 0, 1, '2022-09-23 01:09:59', 0.00000);
INSERT INTO sensores.device_sensor
(id_device, id_sensor, min, max, active, created_at, correction_factor)
VALUES(1, 2, 10, 10, 1, '2022-09-22 01:15:19', -2.00000);
INSERT INTO sensores.device_sensor
(id_device, id_sensor, min, max, active, created_at, correction_factor)
VALUES(2, 2, 10, 20, 1, '2022-09-22 00:38:52', 0.00000);
INSERT INTO sensores.device_sensor
(id_device, id_sensor, min, max, active, created_at, correction_factor)
VALUES(3, 2, 10, 20, 1, '2022-09-22 05:38:52', 0.00000);
INSERT INTO sensores.device_sensor
(id_device, id_sensor, min, max, active, created_at, correction_factor)
VALUES(4, 2, 0, 0, 1, '2022-09-22 05:38:52', 0.00000);
INSERT INTO sensores.device_sensor
(id_device, id_sensor, min, max, active, created_at, correction_factor)
VALUES(5, 2, 0, 0, 1, '2022-09-22 05:38:52', 0.00000);
INSERT INTO sensores.device_sensor
(id_device, id_sensor, min, max, active, created_at, correction_factor)
VALUES(6, 2, 0, 0, 1, '2022-09-22 05:38:52', 0.00000);
INSERT INTO sensores.device_sensor
(id_device, id_sensor, min, max, active, created_at, correction_factor)
VALUES(7, 2, 0, 0, 1, '2022-09-22 05:38:52', 0.00000);
INSERT INTO sensores.device_sensor
(id_device, id_sensor, min, max, active, created_at, correction_factor)
VALUES(8, 2, 0, 0, 1, '2022-09-22 05:38:52', 0.00000);
INSERT INTO sensores.device_sensor
(id_device, id_sensor, min, max, active, created_at, correction_factor)
VALUES(9, 2, 0, 0, 1, '2022-09-22 05:38:52', 0.00000);
INSERT INTO sensores.device_sensor
(id_device, id_sensor, min, max, active, created_at, correction_factor)
VALUES(10, 2, 0, 0, 1, '2022-09-22 05:38:52', 0.00000);
INSERT INTO sensores.device_sensor
(id_device, id_sensor, min, max, active, created_at, correction_factor)
VALUES(1, 3, 10, 20, 1, '2022-09-22 00:38:52', 0.00000);
INSERT INTO sensores.device_sensor
(id_device, id_sensor, min, max, active, created_at, correction_factor)
VALUES(2, 3, 10, 20, 1, '2022-09-22 00:38:52', 0.00000);
INSERT INTO sensores.device_sensor
(id_device, id_sensor, min, max, active, created_at, correction_factor)
VALUES(3, 3, 10, 20, 1, '2022-09-22 05:38:52', 0.00000);
INSERT INTO sensores.device_sensor
(id_device, id_sensor, min, max, active, created_at, correction_factor)
VALUES(4, 3, 0, 0, 1, '2022-09-22 05:38:52', 0.00000);
INSERT INTO sensores.device_sensor
(id_device, id_sensor, min, max, active, created_at, correction_factor)
VALUES(5, 3, 0, 0, 1, '2022-09-22 05:38:52', 0.00000);
INSERT INTO sensores.device_sensor
(id_device, id_sensor, min, max, active, created_at, correction_factor)
VALUES(6, 3, 0, 0, 1, '2022-09-22 05:38:52', 0.00000);
INSERT INTO sensores.device_sensor
(id_device, id_sensor, min, max, active, created_at, correction_factor)
VALUES(7, 3, 0, 0, 1, '2022-09-22 05:38:52', 0.00000);
INSERT INTO sensores.device_sensor
(id_device, id_sensor, min, max, active, created_at, correction_factor)
VALUES(8, 3, 0, 0, 1, '2022-09-22 05:38:52', 0.00000);
INSERT INTO sensores.device_sensor
(id_device, id_sensor, min, max, active, created_at, correction_factor)
VALUES(9, 3, 0, 0, 1, '2022-09-22 05:38:52', 0.00000);
INSERT INTO sensores.device_sensor
(id_device, id_sensor, min, max, active, created_at, correction_factor)
VALUES(10, 3, 0, 0, 1, '2022-09-22 05:38:52', 0.00000);


INSERT INTO sensores.client
(id_client, id_device, name, code, email, phone, created_at)
VALUES(1, 1, 'Hospital Angeles Pedregal', 'C-HAP', 'dmiles@roboticsol.com', '5518877745', '2022-09-20 00:35:40');
INSERT INTO sensores.client
(id_client, id_device, name, code, email, phone, created_at)
VALUES(2, 2, 'HRAEB', 'C-HRAEB', 'dmiles@roboticsol.com', '5518877745', '2022-09-20 00:35:40');
INSERT INTO sensores.client
(id_client, id_device, name, code, email, phone, created_at)
VALUES(3, 3, 'Hospital Siglo 21', 'C-HS21', 'dmiles@roboticsol.com', '5518877745', '2022-09-20 00:35:40');
INSERT INTO sensores.client
(id_client, id_device, name, code, email, phone, created_at)
VALUES(4, 4, 'Cliente 004', 'C-004', 'dmiles@roboticsol.com', '5518877745', '2022-09-20 00:35:40');
INSERT INTO sensores.client
(id_client, id_device, name, code, email, phone, created_at)
VALUES(5, 5, 'Cliente 005', 'C-005', 'dmiles@roboticsol.com', '5518877745', '2022-09-20 00:35:40');
INSERT INTO sensores.client
(id_client, id_device, name, code, email, phone, created_at)
VALUES(6, 6, 'Cliente 006', 'C-006', 'dmiles@roboticsol.com', '5518877745', '2022-09-20 00:35:40');
INSERT INTO sensores.client
(id_client, id_device, name, code, email, phone, created_at)
VALUES(7, 7, 'Cliente 007', 'C-007', 'dmiles@roboticsol.com', '5518877745', '2022-09-20 00:35:40');
INSERT INTO sensores.client
(id_client, id_device, name, code, email, phone, created_at)
VALUES(8, 8, 'Cliente 008', 'C-008', 'dmiles@roboticsol.com', '5518877745', '2022-09-20 00:35:40');
INSERT INTO sensores.client
(id_client, id_device, name, code, email, phone, created_at)
VALUES(9, 9, 'Cliente 009', 'C-009', 'dmiles@roboticsol.com', '5518877745', '2022-09-20 00:35:40');
INSERT INTO sensores.client
(id_client, id_device, name, code, email, phone, created_at)
VALUES(10, 10, 'Cliente 010', 'C-010', 'dmiles@roboticsol.com', '5518877745', '2022-09-20 00:35:40');



INSERT INTO sensores.client_device
(id_client, id_device, created_at)
VALUES(1, 1, '2022-09-25 22:33:28');
INSERT INTO sensores.client_device
(id_client, id_device, created_at)
VALUES(2, 2, '2022-09-27 04:18:47');
INSERT INTO sensores.client_device
(id_client, id_device, created_at)
VALUES(3, 3, '2022-09-27 04:18:47');
INSERT INTO sensores.client_device
(id_client, id_device, created_at)
VALUES(4, 4, '2022-09-25 22:33:28');
INSERT INTO sensores.client_device
(id_client, id_device, created_at)
VALUES(5, 5, '2022-09-27 04:18:47');
INSERT INTO sensores.client_device
(id_client, id_device, created_at)
VALUES(6, 6, '2022-09-27 04:18:47');
INSERT INTO sensores.client_device
(id_client, id_device, created_at)
VALUES(7, 7, '2022-09-27 04:18:47');
INSERT INTO sensores.client_device
(id_client, id_device, created_at)
VALUES(8, 8, '2022-09-27 04:18:47');
INSERT INTO sensores.client_device
(id_client, id_device, created_at)
VALUES(9, 9, '2022-09-27 04:18:47');
INSERT INTO sensores.client_device
(id_client, id_device, created_at)
VALUES(10, 10, '2022-09-27 04:18:47');
