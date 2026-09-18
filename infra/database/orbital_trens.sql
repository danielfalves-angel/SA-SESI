create database orbital_trens;
use orbital_trens;

create table usuarios (
    id int primary key auto_increment,
    nome varchar(100) not null,
    email varchar(100) not null,
    senha varchar(100) not null,
    cargo enum('administrador', 'usuario') not null,
    status enum('ativo', 'inativo') not null
);

create table sensor (
    id int primary key auto_increment,
    nome varchar(100) not null,
    unidade_de_medida enum('celcius', 'km/h', 'kg') not null,
    valor varchar(100) not null,
    tipo_de_sensor enum('Temperatura', 'Velocidade', 'Peso') not null,
    intervalo_de_leitura varchar(100) not null,
    tipo_de_area enum('plano', 'aclive', 'declive') not null,
    descricao varchar(100) not null,
    localizacao varchar(100) not null,
    rota varchar(100) not null,
    status enum('funcionando', 'em funcionamento', 'defeituoso') not null,
    id_usuario int,
    foreign key (id_usuario) references usuarios(id)
);

insert into usuarios (nome, email, senha) values
('Arthur', 'arthur@email.com', '123456'),
('Rafael', 'rafael@email.com', '654321'),
('Daniel', 'daniel@email.com', '654321'),
('Ignacio', 'ignacio@email.com', '987654');
