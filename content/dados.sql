CREATE DATABASE trabalho;

CREATE TABLE usuarios (id INTEGER AUTO_INCREMENT PRIMARY KEY, nome VARCHAR(50), status CHAR(1));

INSERT INTO usuarios (nome,status) VALUES ('Carlos' , 'i'),('Pedro' , 'a'),('João' , 'a'),('Afonso' , 'a'),('Rafaela' , 'a'),('Maria' , 'i');