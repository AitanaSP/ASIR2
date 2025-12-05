CREATE DATABASE aplicaciones;

USE aplicaciones;

CREATE TABLE logins (id_usuario INT PRIMARY KEY AUTO_INCREMENT, usuario VARCHAR(50) NOT NULL, passwd VARCHAR(32) NOT NULL);

CREATE TABLE roles (id_rol INT PRIMARY KEY AUTO_INCREMENT, rol VARCHAR(50) NOT NULL, usuario_id INT NOT NULL, FOREIGN KEY (usuario_id) REFERENCES logins(id_usuario));

CREATE TABLE aplicaciones (id_aplicacion INT PRIMARY KEY AUTO_INCREMENT, nombre VARCHAR(50) NOT NULL, descripcion VARCHAR(300) NOT NULL);

INSERT INTO logins (usuario, passwd) VALUES ('desarrollador', 'desarrollador'), ('visitante', 'visitante');

INSERT INTO roles (rol, usuario_id) VALUES ('desarrollador', '1'), ('visitante', '2');

INSERT INTO aplicaciones (nombre, descripcion) VALUES ('Visual Studio Code', 'Desarrollo de codigo'), ('Word', 'Editor de texto');