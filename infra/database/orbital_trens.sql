create database orbital_trens;
use orbital_trens;

create table usuarios (
    id int primary key auto_increment,
    nome varchar(100) not null,
    email varchar(100) not null,
    senha varchar(100) not null
);

create table sensor (
    id int primary key auto_increment,
    nome varchar(100) not null,
    rota varchar(100) not null,
    id_usuario int,
    unidade enum('celcius', 'km/h', 'kg') not null,
    status enum('funcionando', 'em funcionamento', 'defeituoso') not null,
    foreign key (id_usuario) references usuarios(id)
);

insert into usuarios (nome, email, senha) values
('Arthur', 'arthur@email.com', '123456'),
('Rafael', 'rafael@email.com', '654321'),
('Daniel', 'daniel@email.com', '654321'),
('Ignacio', 'ignacio@email.com', '987654');
