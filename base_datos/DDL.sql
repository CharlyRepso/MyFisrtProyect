CREATE DATABASE TiendaPro;
Use TiendaP;

CREATE TABLE Usuario (
    Id_Usuario INT NOT NULL AUTO_INCREMENT,
    Nombre VARCHAR(40) NOT NULL,
    Usuario VARCHAR (20) NOT NULL,
    Contra VARCHAR(40) NOT NULL,  
    Activo BOOLEAN,
    PRIMARY KEY (Id_Usuario)
);

CREATE TABLE ROL(
    Id_Rol INT NOT NULL,
    Nombre VARCHAR(15) NOT NULL,
    ACTIVO BOOLEAN NOT NULL
);

CREATE TABLE Usuario_Rol(
    Id_Usuario INT NOT NULL,
    Id_Rol INT NOT NULL
);


CREATE TABLE Producto(
    Id_Producto INT NOT NULL AUTO_INCREMENT,
    Nombre VARCHAR (40) NOT NULL,
    Precio INT NOT NULL,
    PRIMARY KEY (Id_Producto)
);

CREATE TABLE Venta(
    Id_Venta INT NOT NULL,
    Id_Producto INT NOT NULL,
    Id_Usuario INT NOT NULL,
    Cantidad INT NOT NULL,
    Precio INT NOT NULL
);

Alter table Usuario add constraint Un_Usuario Unique(Usuario);

Alter table ROL add constraint PK_Rol Primary Key (Id_Rol);

Alter table Usuario_Rol add constraint PK_usuarioRol Primary Key (Id_Usuario, Id_Rol);

Alter table Usuario_Rol add constraint FK_UR_U Foreign key (Id_Usuario) references Usuario (Id_Usuario);
Alter table Usuario_Rol add constraint FK_UR_R Foreign key (Id_Rol) references ROL (Id_Rol);

Alter table Producto add constraint UK_Producto Unique(Nombre);

Alter table Venta add constraint PK_Venta Primary Key (Id_Venta);
Alter table Venta add constraint FK_V_P Foreign key (Id_Producto) references Producto (Id_Producto);
Alter table Venta add constraint FK_V_U Foreign key (Id_Usuario) references Usuario (Id_Usuario);

Insert into ROL  values 
(1, 'Vendedor', true),
(2, 'Supervisor', true),
(3, 'Administrador', true);


INSERT INTO Usuario(Nombre, Usuario, Contra, Activo) VALUES ('Carlos Doniz', 'admin', '1234', true);
INSERT INTO Usuario_Rol VALUES(1,3);
