CREATE TABLE users (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NULL,
  `password` VARCHAR(255) NULL,
  PRIMARY KEY (`id`));

CREATE TABLE pages (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `title_sr` VARCHAR(255),
  `title_en` VARCHAR(255),
  `permalink_sr` VARCHAR(255),
  `permalink_en` VARCHAR(255),
  `body_sr` TEXT,
  `body_en` TEXT,
  `date_created` DATETIME,
  `published` BOOLEAN DEFAULT FALSE ,
  `order` INT(3)
);

CREATE TABLE services (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `title_sr` VARCHAR(255),
  `title_en` VARCHAR(255),
  `body_sr` TEXT,
  `body_en` TEXT,
  `date_created` DATETIME,
  `published` BOOLEAN DEFAULT FALSE ,
  `order` INT(3)
);

CREATE TABLE clients (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name_sr` VARCHAR(255),
  `name_en` VARCHAR(255),
  `logo_path` VARCHAR(255),
  `date_created` DATETIME,
  `published` BOOLEAN DEFAULT FALSE ,
  `order` INT(3)
);

/*
ALTER TABLE attorney.pages ADD `permalink_sr` VARCHAR(255) NULL AFTER `body_en`;
ALTER TABLE attorney.pages ADD `permalink_en` VARCHAR(255) NULL AFTER `permalink_sr`;
*/
