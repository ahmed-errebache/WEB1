-- Créer la base et l'utilisateur (à exécuter dans PhpMyAdmin ou MySQL)
-- Remplace les mots de passe selon vos besoins

CREATE DATABASE IF NOT EXISTS myband CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

CREATE USER IF NOT EXISTS 'myband_user'@'localhost' IDENTIFIED BY 'myband_pass';
GRANT ALL PRIVILEGES ON myband.* TO 'myband_user'@'localhost';
FLUSH PRIVILEGES;

USE myband;

-- Table admins
DROP TABLE IF EXISTS admins;
CREATE TABLE admins (
  login    VARCHAR(100) NOT NULL PRIMARY KEY,
  password VARCHAR(255) NOT NULL,
  email    VARCHAR(255) NOT NULL,
  contact  BOOLEAN NOT NULL DEFAULT TRUE
);

INSERT INTO admins (login, password, email, contact)
VALUES ('admin', SHA2('admin123', 256), 'admin@example.com', TRUE);

-- Table setlist
DROP TABLE IF EXISTS setlist;
CREATE TABLE setlist (
  id     BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  title  VARCHAR(255) NOT NULL,
  artist VARCHAR(255) NOT NULL,
  style  VARCHAR(255) NOT NULL
);