create database orbital_trens;
use orbital_trens;

create table usuarios (
    id int primary key auto_increment,
    nome varchar(100) not null,
    email varchar(100) not null,
    telefone varchar(15) not null,
    senha varchar(100) not null,
    cargo enum('administrador', 'usuario') not null,
    status enum('ativo', 'inativo') not null
);

create table sensor (
    id int primary key auto_increment,
    nome varchar(100) not null,
    descricao varchar(100) not null,
    unidade_de_medida enum('celcius', 'km/h', 'kg') not null,
    valor int not null,
    tipo_de_area enum('plano', 'aclive', 'declive') not null,
    localizacao varchar(100) not null,
    rota varchar(100) not null,
    status enum('funcionando', 'defeituoso') not null,
    id_usuario int,
    foreign key (id_usuario) references usuarios(id)
);

create table rota(
    id int primary key auto_increment,
    nome varchar(100) not null,
    destino varchar(100) not null,
    partida varchar(100) not null,
    descricao varchar(100) not null
);

create table trem (
    id int primary key auto_increment,
    nome varchar(100) not null,
    rota varchar(100) not null,
    velocidade int not null,
    peso int not null,
    temperatura int not null,
    tempo int not null,
    descricao varchar(100) not null,
    status enum('funcionando', 'defeituoso') not null,
    id_usuario int,
    foreign key (id_usuario) references usuarios(id)
);

insert into usuarios (nome, email, telefone, senha, cargo, status) values
('Arthur', 'arthur@email.com', '1234567890', '$2y$10$XarJthdWKNeMXTAP6uo26uQzJpdrXlkh6Y4Zq3/BXKFkvDR.XqC9O', 'administrador', 'ativo'),
('Rafael', 'rafael@email.com', '0987654321', '$2y$10$tVrF4VbArS0y8sRryiagNO1aJ26INmTXt8MSX7mBgYATZlHQ6hqkC', 'administrador', 'ativo'),
<<<<<<< HEAD
('Daniel', 'daniel@email.com', '1111111111', '$2y$10$LfEu.BPjjDqJEZiGr8D3.urvGEXli8XUhbHXWLANM5jpfaTPQFwx', 'administrador', 'ativo'),
=======
('Daniel', 'daniel@email.com', '1111111111', '$2y$10$iMMDvw1KmR8hHuuMgLpOTeu9HLQ0VHBWun6rftnYv7lc0VghqYDIO', 'administrador', 'ativo'),
>>>>>>> 26d5eba616b2193ea55cc69f0c5c325020f765cc
('Ignacio', 'ignacio@email.com', '2222222222', '$2y$10$AYapbRkm8itkNxJUWmCMcezVSPVuIm.gSKohP6dPm6RX/qAwhc1G2', 'usuario', 'ativo');
