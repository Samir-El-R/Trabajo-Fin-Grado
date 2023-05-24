
-- creamos la base de datos
CREATE DATABASE IF NOT EXISTS app;

-- usamos la base de dat
USE app;

-- seleccionamos la base de datos 
SELECT DATABASE();

-- creamos la tabla registro
CREATE TABLE IF NOT EXISTS profesores (
  id INT UNSIGNED AUTO_INCREMENT,
  nombre varchar(255) not null,
  apellido varchar(255) not null,
  contrasena varchar(255),
  email varchar(255) not null unique,
  dias_disponibles INT DEFAULT 4,
  dias_seleccionados varchar(255),
  PRIMARY KEY (id)
);

-- ususario anonimo para asiganrle los posts mas tarde
INSERT INTO registro (usuario,nombre,apellido,fecha_creacion,email,contrasena,imagen_perfil) values ('admin','admin','admin','admin@gmail.com',4,'admin');

