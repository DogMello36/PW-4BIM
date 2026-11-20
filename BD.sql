CREATE DATABASE IF NOT EXISTS `BD`;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET NAMES utf8mb4;
USE `BD`;


CREATE TABLE IF NOT EXISTS funcionarios (
  Id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Nome varchar(50) NOT NULL,
  Endereco varchar(50) NOT NULL,
  Idade int NOT NULL,
  DataNasc datetime NOT NULL,
  Foto varchar(30) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO funcionarios (Nome, Endereco, Idade, DataNasc, Foto)
VALUES ('Ana Souza', 'Rua das Flores, 120', 29, '1997-04-15 00:00:00', NULL);

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
  -- ENUM positions are Funcionario=1 and Admin=2; application code stores labels.
  Perfil_Usu ENUM('Funcionario', 'Admin') NOT NULL DEFAULT 'Funcionario',
  Login_usu  VARCHAR(50)  NOT NULL UNIQUE,
  Senha_usu  VARCHAR(255) NOT NULL,
  Foto_usu   VARCHAR(30)  NULL,
  Ativo_usu  TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO Usuarios (Perfil_Usu, Login_usu, Senha_usu) VALUES
  ('Admin', 'admin', '$2y$10$u8bMgvzFnp5PhNNH7BTlvuX2eQI9pOv7ePThg3IlLPuPh4KLLCDrq'),
  ('Funcionario', 'usuario', '$2y$10$ldGuxBa1dxjOa8959QNoROa9KRRwj1LdCtd1qYLznCacJgMacsMC6');
