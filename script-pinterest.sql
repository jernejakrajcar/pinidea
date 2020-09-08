
CREATE TABLE `users`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `nickname` Varchar(40) NOT NULL,
  `first_name` Varchar(20),
  `last_name` Varchar(30),
  `email` Varchar(100) NOT NULL,
  `pass` Varchar(255) NOT NULL,
  `avatar` Char(255),
  `phone` Varchar(50),
  `bio` Varchar(200),
  `language_id` Int,
  `country_id` Int,
  PRIMARY KEY (`id`)
)
;

CREATE INDEX `IX_Relationship1` ON `users` (`language_id`)
;

CREATE INDEX `IX_Relationship2` ON `users` (`country_id`)
;


CREATE TABLE `pins`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `url` Varchar(255) NOT NULL,
  `title` Varchar(255),
  `picture` Varchar(255) NOT NULL,
  `description` Varchar(500),
  `user_id` Int,
  PRIMARY KEY (`id`)
)
;

CREATE INDEX `IX_Relationship5` ON `pins` (`user_id`)
;


CREATE TABLE `countries`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `name` Varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
)
;



CREATE TABLE `languages`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `title` Varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
)
;



CREATE TABLE `categories`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `name` Varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
)
;



CREATE TABLE `boards`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `name` Varchar(200) NOT NULL,
  `private` Bool DEFAULT 0,
  PRIMARY KEY (`id`)
)
;



CREATE TABLE `categories_pins`
(
  `id` Int NOT NULL AUTO_INCREMENT,
  `pin_id` Int,
  `category_id` Int,
  PRIMARY KEY (`id`)
)
;

CREATE INDEX `IX_Relationship3` ON `categories_pins` (`pin_id`)
;

CREATE INDEX `IX_Relationship4` ON `categories_pins` (`category_id`)
;



CREATE TABLE `boards_pins`
(
  `id` Int NOT NULL,
  `pin_id` Int,
  `board_id` Int
)
;

CREATE INDEX `IX_Relationship6` ON `boards_pins` (`pin_id`)
;

CREATE INDEX `IX_Relationship7` ON `boards_pins` (`board_id`)
;

ALTER TABLE `boards_pins` ADD PRIMARY KEY (`id`)
;



ALTER TABLE `users` ADD CONSTRAINT `Relationship1` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `users` ADD CONSTRAINT `Relationship2` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `categories_pins` ADD CONSTRAINT `Relationship3` FOREIGN KEY (`pin_id`) REFERENCES `pins` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `categories_pins` ADD CONSTRAINT `Relationship4` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `pins` ADD CONSTRAINT `Relationship5` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `boards_pins` ADD CONSTRAINT `Relationship6` FOREIGN KEY (`pin_id`) REFERENCES `pins` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `boards_pins` ADD CONSTRAINT `Relationship7` FOREIGN KEY (`board_id`) REFERENCES `boards` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
;
