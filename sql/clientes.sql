drop table if exists estancias;
drop table if exists hoteles;
drop table if exists clientes;
create table clientes(
    id int auto_increment primary key,
    apellidos varchar(90) not null,
    nombre varchar(20) not null,
    email varchar(90) UNIQUE not null
);

create table hoteles(
    id int AUTO_INCREMENT primary key,
    nombre varchar(80) unique not null,
    localidad varchar(100) not null,
    direccion varchar(100) not null
);

create table estancias(
    id int AUTO_INCREMENT primary key,
    cliente_id int,
    hotel_id int,
    fecha_entrada datetime default CURRENT_TIMESTAMP,
    fecha_salida date,
    CONSTRAINT estancia_cliente FOREIGN KEY(cliente_id) REFERENCES clientes(id) 
    on DELETE CASCADE ON UPDATE CASCADE,
    
    CONSTRAINT estancia_hotel FOREIGN KEY(hotel_id ) REFERENCES hoteles(id)
    ON DELETE CASCADE ON UPDATE CASCADE
);