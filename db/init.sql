CREATE DATABASE IF NOT EXISTS appDB;
CREATE USER 'user'@'app' IDENTIFIED BY 'password';
GRANT SELECT,UPDATE,INSERT,DELETE ON appDB.* TO 'user'@'app';
FLUSH PRIVILEGES;

USE appDB;

CREATE TABLE Classes(
  id INT PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(15) NOT NULL,
  course INT NOT NULL
);

CREATE TABLE Students(
  id INT PRIMARY KEY AUTO_INCREMENT,
  first_name VARCHAR(30) NOT NULL,
  last_name VARCHAR(30) NOT NULL,
  Class_id INT NOT NULL,
  FOREIGN KEY (Class_id) REFERENCES Classes (id) ON DELETE CASCADE
);

INSERT INTO Classes (title, course) VALUES
("IKBO-10-21", 3);

INSERT INTO Classes (title, course) VALUES
("INBO-05-22", 4);

INSERT INTO Students (first_name, last_name, Class_id) VALUES
("Ivan", "Ivanov", 1);

INSERT INTO Students (first_name, last_name, Class_id) VALUES
("Sergey", "Bikov", 1);

INSERT INTO Students (first_name, last_name, Class_id) VALUES
("Oleg", "Sidorov", 2);

INSERT INTO Students (first_name, last_name, Class_id) VALUES
("Nikolay", "Petrov", 2);