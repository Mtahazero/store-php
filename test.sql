CREATE TABLE users( 
    id INT AUTO_INCREMENT PRIMARY KEY ,
    fullname varchar(50) NOT NULL ,
    email varchar(50) UNIQUE ,
    password varchar(255) NOT NULL ,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP ,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP 
);

ALTER TABLE `users` ADD `role` ENUM('user','admin') NOT NULL DEFAULT 'user' AFTER `updated_at`;


CREATE TABLE product(
id int AUTO_INCREMENT PRIMARY KEY ,
title varchar(50) NOT NULL,
description TEXT ,
price int(9) NOT NULL,
quantity int(9)NOT NULL ,
image varchar(255),
created_at DATETIME DEFAULT CURRENT_TIMESTAMP 
);