DROP DATABASE IF EXISTS juego2;
CREATE DATABASE juego2;

USE juego2;

CREATE TABLE usuario(
    usuario_id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    PRIMARY KEY(usuario_id)
);

CREATE TABLE nivel(
    nivel_id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    PRIMARY KEY(nivel_id)
);

CREATE TABLE ranking(
    ranking_id INT NOT NULL AUTO_INCREMENT,
    usuario_id INT NOT NULL,
    nivel_id INT NOT NULL,
    puntuaje INT NOT NULL,
    PRIMARY KEY(ranking_id),
    FOREIGN KEY (usuario_id) REFERENCES usuario(usuario_id),
    FOREIGN KEY (nivel_id) REFERENCES nivel(nivel_id)
);