CREATE TABLE `yii2basic`.`users` (
	`id` INT AUTO_INCREMENT PRIMARY KEY,
	`username` VARCHAR(63) NOT NULL,
	`password` VARCHAR(63) NOT NULL,
	`password_reset_token` VARCHAR(255) NULL,
	`auth_key` VARCHAR(32) NOT NULL DEFAULT '',
	`first_name` VARCHAR(32) NOT NULL,
	`last_name` VARCHAR(32) NOT NULL,
	`is_admin` TINYINT(1) NOT NULL DEFAULT 0,
	`is_waiter` TINYINT(1) NOT NULL DEFAULT 0,
	`is_cook` TINYINT(1) NOT NULL DEFAULT 0);

INSERT INTO `yii2basic`.`users` (
	`username`, `password`, `first_name`, `last_name`,
	`is_admin`, `is_waiter`, `is_cook`)
VALUES
	('admin',  'admin', 'Admin',  'Test', 1, 0, 0),
	('waiter', 'pass',  'Waiter', 'Test', 0, 1, 0),
	('cook',   'pass',  'Cook',   'Test', 0, 0, 1);


CREATE TABLE `yii2basic`.`orders` (
	`id` INT AUTO_INCREMENT PRIMARY KEY,
	`title` VARCHAR(63) NOT NULL,
	`table_number` INT(3) NOT NULL,
	`estimated_time` DATETIME NULL,
	`condition` ENUM('new', 'pending', 'ready') NOT NULL,
	`owner_id` INT NOT NULL REFERENCES `yii2basic`.`users` (`id`),
	`created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP);
