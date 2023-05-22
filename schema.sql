Create DATABASE Hillel_db;

USE Hillel_db;	 

CREATE TABLE author(
  id INT PRIMARY KEY,
  date_reg DATETIME NOT NULL,
  email VARCHAR(100) NOT NULL,
  name VARCHAR(100) NOT NULL,
  password VARCHAR(255)  NOT NULL
);

CREATE TABLE project(
  id INT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  author_id INT NOT NULL,
  FOREIGN KEY (author_id ) REFERENCES author(id) 
);

CREATE TABLE task(
  id INT PRIMARY KEY,
  date_create DATETIME NOT NULL,
  status ENUM('backlog', 'to-do', 'in-progress', 'done') DEFAULT 'backlog',
  title VARCHAR(255) NOT NULL,
  description TEXT,
  file VARCHAR(255) NOT NULL,
  deadline DATETIME, 
  author_id INT NOT NULL,
  project_id INT NOT NULL,
  FOREIGN KEY (author_id) REFERENCES author(id),
  FOREIGN KEY (project_id) REFERENCES project(id)
);