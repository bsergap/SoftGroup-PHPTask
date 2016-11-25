CREATE TABLE `yii2basic`.`users` (
	`id` INT AUTO_INCREMENT PRIMARY KEY,
	`username` VARCHAR(63) NOT NULL,
	`password` VARCHAR(63) NOT NULL,
	`password_reset_token` VARCHAR(255) NULL,
	`auth_key` VARCHAR(32) NOT NULL DEFAULT '',
	`is_admin` TINYINT(1) NOT NULL DEFAULT 0,
	`is_waiter` TINYINT(1) NOT NULL DEFAULT 0,
	`is_cook` TINYINT(1) NOT NULL DEFAULT 0);
INSERT INTO `yii2basic`.`users` (`username`, `password`, `is_admin`) VALUES ('admin', 'admin', 1);
INSERT INTO `yii2basic`.`users` (`username`, `password`, `is_waiter`) VALUES ('waiter', 'pass', 1);
INSERT INTO `yii2basic`.`users` (`username`, `password`, `is_cook`) VALUES ('cook', 'pass', 1);

CREATE TABLE `yii2basic`.`orders` (
	`id` INT AUTO_INCREMENT PRIMARY KEY,
	`title` VARCHAR(63) NOT NULL,
	`table_number` INT(3) NOT NULL,
	`estimated_time` DATETIME NULL,
	`condition` ENUM('new', 'pending', 'ready') NOT NULL,
	`owner` INT NOT NULL REFERENCES `yii2basic`.`users` (`id`),
	`created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP);

