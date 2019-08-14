CREATE SCHEMA Blog;
USE Blog;

CREATE TABLE User (
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(128) NOT NULL,
    password VARCHAR(128) NOT NULL,
    email VARCHAR(128) NOT NULL
);

INSERT INTO User (username, password, email) VALUES ('adm', '123456', 'adm.test@example.com');

SELECT * from User;

CREATE TABLE Categoria (
	id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL
);

INSERT INTO Categoria (name) VALUES ('Integrações');
INSERT INTO Categoria (name) VALUES ('Serviços');
INSERT INTO Categoria (name) VALUES ('Financeiro');
INSERT INTO Categoria (name) VALUES ('Agenda');
INSERT INTO Categoria (name) VALUES ('Parceiros');
INSERT INTO Categoria (name) VALUES ('Outros');

SELECT * FROM Categoria;

CREATE TABLE Post (
	id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    texto VARCHAR(500) NOT NULL,
    autor VARCHAR(128) NOT NULL,
    titulo VARCHAR(128) NOT NULL,
    dataPost DATETIME NOT NULL,
    idUser INT NOT NULL,
    idCategoria INT NOT NULL,
    
    CONSTRAINT idUserFKPost FOREIGN KEY (idUser) REFERENCES User(id),
    CONSTRAINT idCategoriaFKPost FOREIGN KEY (idCategoria) REFERENCES Categoria(id)
);

insert into Post (texto, autor, titulo, dataPost, idUser, idCategoria) values ('1Lorem ipsum felis ut rhoncus eu non turpis potenti id quam et aliquam adipiscing ad, est class nam interdum conubia porttitor pellentesque litora mattis in taciti aenean adipiscing','yasuo','titulo do texto','2019-08-13','2','1');
insert into Post (texto, autor, titulo, dataPost, idUser, idCategoria) values ('2Lorem ipsum felis ut rhoncus eu non turpis potenti id quam et aliquam adipiscing ad, est class nam interdum conubia porttitor pellentesque litora mattis in taciti aenean adipiscing','seju','titulo do texto 2','2019-08-13 22:09:15','2','2');
insert into Post (texto, autor, titulo, dataPost, idUser, idCategoria) values ('3Lorem ipsum felis ut rhoncus eu non turpis potenti id quam et aliquam adipiscing ad, est class nam interdum conubia porttitor pellentesque litora mattis in taciti aenean adipiscing','ekko','titulo do texto 3','2019-08-13 22:10:36','2','4');
insert into Post (texto, autor, titulo, dataPost, idUser, idCategoria) values ('4Lorem ipsum felis ut rhoncus eu non turpis potenti id quam ','yasuo','titulo do texto 4','2019-08-13 22:11:47','3','6');

select * from Post;

CREATE TABLE Comentario (
	id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    texto VARCHAR(250) NOT NULL,
    idUser INT NOT NULL,
    idPost INT NOT NULL,
    
    CONSTRAINT idUserFKCom FOREIGN KEY (idUser) REFERENCES User(id),
    CONSTRAINT idPostFKCom FOREIGN KEY (idPost) REFERENCES Post(id)
);

insert into Comentario (texto, idUser, idPost) values ('um mito',2,1);
insert into Comentario (texto, idUser, idPost) values ('sou naaada',3,1);
insert into Comentario (texto, idUser, idPost) values ('Lorem ipsum felis ut rhoncus eu non ',3,2);

select * from Comentario;