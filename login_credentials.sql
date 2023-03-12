SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE loginDB;

CREATE TABLE loginDB.`login_credentials` (
  `fullname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` enum('admin','faculty', 'student') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE loginDB.`login_credentials`
  ADD PRIMARY KEY (`email`);

INSERT INTO loginDB.`login_credentials` (`fullname`, `username`, `email`, `password`, `role`) VALUES
('russel', 'russel', 'russel@gmail.com', 'password', 'admin'),
('lenard', 'lenard', 'lenard@gmail.com', 'password', 'student');