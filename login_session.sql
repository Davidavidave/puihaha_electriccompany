CREATE DATABASE IF NOT EXISTS `login_session` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `login_session`;

DROP TABLE IF EXISTS `user_accounts`;
CREATE TABLE `user_accounts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Demo account for testing. Change this password after the first successful login.
INSERT INTO `user_accounts` (`username`, `password`) VALUES ('admin', 'admin123');
