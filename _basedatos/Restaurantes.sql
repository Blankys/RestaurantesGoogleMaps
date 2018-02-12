DROP DATABASE IF EXISTS RESTAURANTES;
CREATE DATABASE IF NOT EXISTS RESTAURANTES DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE RESTAURANTES;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


drop table if exists CATALOGOCATEGORIA;
drop table if exists CATEGORIA;
drop table if exists RESTAURANTE;

/*==============================================================*/
/* Table: CATALOGOCATEGORIA                                     */
/*==============================================================*/
create table CATALOGOCATEGORIA
(
   IDCATALOGOCATEGORIA  int not null AUTO_INCREMENT,
   NOMBRECATEGORIA 		varchar(50) not null,
   primary key (IDCATALOGOCATEGORIA)
);

/*==============================================================*/
/* Table: CATEGORIA                                             */
/*==============================================================*/
create table CATEGORIA
(
   IDCATEGORIA          int not null AUTO_INCREMENT,
   IDRESTAURANTE        int not null,
   IDCATALOGOCATEGORIA  int not null,
   DETALLECATEGORIA     varchar(60) not null,
   primary key (IDCATEGORIA)
);

/*==============================================================*/
/* Table: RESTAURANTES                                          */
/*==============================================================*/
create table RESTAURANTE
(
   IDRESTAURANTE        int not null AUTO_INCREMENT,
   NOMRESTAURANTE       varchar(50) not null,
   DESCRESTAURANTE      varchar(200),
   DIRECCIONRESTAURANTE varchar(100) not null,
   HORARIORESTAURANTE   varchar(50),
   NUMRESTAURANTE       varchar(9),
   LONGITUD             float(10,6),
   LATITUD              float(10,6),
   primary key (IDRESTAURANTE)
);

alter table CATEGORIA add constraint FK_CORRESPONDE foreign key (IDRESTAURANTE)
      references RESTAURANTE (IDRESTAURANTE) on delete restrict on update restrict;

alter table CATEGORIA add constraint FK_PERTENECE foreign key (IDCATALOGOCATEGORIA)
      references CATALOGOCATEGORIA (IDCATALOGOCATEGORIA) on delete restrict on update restrict;

