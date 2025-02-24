-- EFFACEMENT DES TABLES

DROP TABLE IF EXISTS avatar;
DROP TABLE IF EXISTS image;
DROP TABLE IF EXISTS item;
DROP TABLE IF EXISTS user;

-- Création table USER

CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

-- Création de la table QUIZ
CREATE TABLE item(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    id_user INT NOT NULL,
    FOREIGN KEY (id_user) REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Création de la table IMAGE
CREATE TABLE image (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    taille INT,
    type VARCHAR(20),
    bin LONGBLOB,
    id_item INT NOT NULL,
    FOREIGN KEY (id_item) REFERENCES item(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Création de la table AVATAR
CREATE TABLE avatar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    taille INT,
    type VARCHAR(20),
    bin LONGBLOB,
    id_user INT NOT NULL,
    FOREIGN KEY (id_user) REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;