create database crud;

use crud;

create table s_pessoa(
	id int(8) AUTO_INCREMENT,
	cpf varchar(11) not null,
	nome varchar(100) not null,
	idade tinyint(3) unsigned not null,
	dataNascimento date not null,
	rg varchar(20) not null,
	telefone varchar(14) not null,
	email varchar(100) not null,
	primary key (id)
);

