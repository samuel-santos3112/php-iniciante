create database crudsimples default collate utf8_general_ci;

use crudsimples;

create table contatos (
id int auto_increment,
nome varchar(45) ,
email varchar(45) ,
celular varchar(15),
primary key(id)


);

drop table contatos;
select * from contatos;