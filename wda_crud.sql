SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

SET NAMES utf8;

CREATE DATABASE wda_crud;
USE wda_crud;

CREATE TABLE IF NOT EXISTS customers (
  Id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Modelo varchar(50),
  Marca varchar(30),
  Motor varchar(20),
  DataCad datetime NOT NULL,
  Imagem varchar(30)
) DEFAULT CHARSET=utf8 AUTO_INCREMENT=6;

INSERT INTO `customers` (`Modelo`, `Marca`, `Motor`, `DataCad`, `Imagem`)
VALUES ('CB 500', 'Honda', '471cc', '2026-05-24 00:00:00', NULL);   