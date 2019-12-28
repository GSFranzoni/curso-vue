drop database if exists knowledge;
create database knowledge;
use knowledge;
create table if not exists User (
    id INT AUTO_INCREMENT,
    email VARCHAR(200) NOT NULL,
    password VARCHAR(50) NOT NULL,
    name VARCHAR(300) NOT NULL,
    admin BOOLEAN NOT NULL,
    constraint pk_user PRIMARY KEY (id)
);

create table if not exists Category (
    id INT AUTO_INCREMENT,
    name VARCHAR(300) NOT NULL,
    parent INT,
    constraint pk_category PRIMARY KEY (id),
    constraint fk_category FOREIGN KEY (parent) references Category(id)
);

create table if not exists Article (
    id INT AUTO_INCREMENT,
    name VARCHAR(300) NOT NULL,
    category INT NOT NULL,
    user INT NOT NULL,
    description varchar(2000) NOT NULL,
    content NVARCHAR(10000) NOT NULL,
    image varchar(1000) NOT NULL,
    constraint pk_article PRIMARY KEY (id),
    constraint fk_article_to_user foreign key(user) references User(id),
    constraint fk_article_to_category foreign key(category) references Category(id)
);
