CREATE DATABASE IF NOT EXISTS `BD`;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET NAMES utf8mb4;
USE `BD`;


CREATE TABLE IF NOT EXISTS motos (
  Id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Modelo varchar(50),
  Marca varchar(30),
  Motor varchar(20),
  DataCad datetime NOT NULL,
  Imagem varchar(30)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO motos (Modelo, Marca, Motor, DataCad, Imagem)
VALUES ('CB 500', 'Honda', '471cc', '2026-05-24 00:00:00', NULL);

CREATE TABLE IF NOT EXISTS Permi (
  Id_Permi        INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Nome_Permi      VARCHAR(50)  NOT NULL UNIQUE,
  Descricao_Permi VARCHAR(255) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS Cliente (
  Id_Cli       INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Nome_Cli     VARCHAR(100) NOT NULL,
  Tel_Cli      VARCHAR(20)  NULL,
  CPF_Cli      VARCHAR(14)  NOT NULL UNIQUE,
  Email_Cli    VARCHAR(100) NULL,
  Endereco_Cli VARCHAR(200) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS Usuarios (
  Id_Usu     INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Id_Permi   INT NOT NULL,
  Login_usu  VARCHAR(50)  NOT NULL UNIQUE,
  Senha_usu  VARCHAR(255) NOT NULL,
  Foto_usu   VARCHAR(30)  NULL,
  Ativo_usu  TINYINT(1) NOT NULL DEFAULT 1,
  CONSTRAINT FK_Usuarios_Permi FOREIGN KEY (Id_Permi) REFERENCES Permi(Id_Permi)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO Permi (Nome_Permi, Descricao_Permi) VALUES
  ('Admin', 'Acesso total, incluindo usuários'),
  ('Comum', 'CRUD de clientes e motos');

INSERT INTO Usuarios (Id_Permi, Login_usu, Senha_usu) VALUES
  (1, 'admin',   '1234'),
  (2, 'usuario', '123');

UPDATE Usuarios SET Senha_usu = '$2y$10$u8bMgvzFnp5PhNNH7BTlvuX2eQI9pOv7ePThg3IlLPuPh4KLLCDrq', Ativo_usu = 1 WHERE Login_usu = 'admin';
UPDATE Usuarios SET Senha_usu = '$2y$10$ldGuxBa1dxjOa8959QNoROa9KRRwj1LdCtd1qYLznCacJgMacsMC6', Ativo_usu = 1 WHERE Login_usu = 'usuario';
