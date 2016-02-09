CREATE TABLE `attorney`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NULL,
  `password` VARCHAR(255) NULL,
  PRIMARY KEY (`id`));

CREATE TABLE attorney.pages (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `title_sr` VARCHAR(255),
  `title_en` VARCHAR(255),
  `body_sr` TEXT,
  `body_en` TEXT,
  `date_created` DATETIME,
  `published` BOOLEAN DEFAULT FALSE ,
  `order` INT(3)
);