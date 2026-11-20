-- Execute uma única vez em um banco criado com a versão anterior do BD.sql.
USE `BD`;

ALTER TABLE Usuarios
  ADD COLUMN Perfil_Usu ENUM('Funcionario', 'Admin') NOT NULL DEFAULT 'Funcionario'
  AFTER Id_Usu;

UPDATE Usuarios u
LEFT JOIN Permi p ON p.Id_Permi = u.Id_Permi
SET u.Perfil_Usu = CASE
  WHEN p.Nome_Permi = 'Admin' THEN 'Admin'
  ELSE 'Funcionario'
END;

ALTER TABLE Usuarios
  DROP FOREIGN KEY FK_Usuarios_Permi,
  DROP COLUMN Id_Permi;

DROP TABLE Permi;
