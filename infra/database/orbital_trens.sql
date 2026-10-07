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
    status enum('funcionando', 'em funcionamento', 'defeituoso') not null,
    id_usuario int,
    foreign key (id_usuario) references usuarios(id)
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
    status enum('funcionando', 'em funcionamento', 'defeituoso') not null,
    id_usuario int,
    foreign key (id_usuario) references usuarios(id)
);

insert into usuarios (nome, email, telefone, senha, cargo, status) values
('Arthur', 'arthur@email.com', '1234567890', '123456', 'administrador', 'ativo'),
('Rafael', 'rafael@email.com', '0987654321', '654321', 'administrador', 'ativo'),
('Daniel', 'daniel@email.com', '1111111111', '654321', 'administrador', 'ativo'),
('Ignacio', 'ignacio@email.com', '2222222222', '987654', 'usuario', 'ativo');
