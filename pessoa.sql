#create database chat_2019;
#use chat_2019;

create database pessoa;
use pessoa;

create table usuario(
id integer primary key auto_increment,
nome varchar(60),
email varchar(60),
idade int);

insert into usuario (nome,email,idade) values ('Samuel Souza Santos','samuelsss2016@gmail.com',20);

select * from usuario;

