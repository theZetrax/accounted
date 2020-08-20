DROP DATABASE IF EXISTS accounted;
CREATE DATABASE IF NOT EXISTS accounted DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

use accounted;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
	`id` INT(11) UNSIGNED AUTO_INCREMENT,
	`username` VARCHAR(20) NOT NULL,
	`firstname` VARCHAR(50) NULL,
	`lastname` VARCHAR(50) NULL,
	`password` VARCHAR(255) NOT NULL,
	`active` TINYINT(1) NOT NULL,
	`active_hash` VARCHAR(255) NULL,
	`recover_hash` VARCHAR(255) NULL,
	`remember_hash` VARCHAR(255) NULL,
	`remember_token` VARCHAR(255) NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_at` TIMESTAMP NULL,
	PRIMARY KEY (`id`),
	UNIQUE (`username`)
);