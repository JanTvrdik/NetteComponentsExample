-- Adminer 3.3.0 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `articleId` int(10) unsigned NOT NULL,
  `date` datetime NOT NULL COMMENT 'datum a čas vložení komentáře',
  `author` varchar(50) DEFAULT NULL COMMENT 'jméno autora',
  `text` varchar(1000) NOT NULL COMMENT 'text komentáře',
  PRIMARY KEY (`id`),
  KEY `articleId` (`articleId`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`articleId`) REFERENCES `articles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- 2012-01-28 11:21:40
