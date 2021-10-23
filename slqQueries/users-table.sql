CREATE TABLE users(
    usersId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    usersFirst varchar(128) NOT NULL,
    usersLast varchar(128) NOT NULL,
    usersEmail varchar(128) NOT NULL,
    usersName varchar(128) NOT NULL,
    usersPwd varchar(128) NOT NULL
);