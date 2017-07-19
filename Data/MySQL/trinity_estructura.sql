/*
SQLyog Community v12.2.4 (64 bit)
MySQL - 5.5.39 : Database - trinity
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`trinity` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `trinity`;

/*Table structure for table `alumnos` */

DROP TABLE IF EXISTS `alumnos`;

CREATE TABLE `alumnos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `matricula` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `apellido_paterno` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `apellido_materno` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `curp` varchar(18) COLLATE utf8_unicode_ci NOT NULL,
  `genero` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `ciudad` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `carrera_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_alumnos_carrera_id` (`carrera_id`),
  CONSTRAINT `fk_alumnos_carrera_id` FOREIGN KEY (`carrera_id`) REFERENCES `carreras` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=837 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `alumnos_grupos` */

DROP TABLE IF EXISTS `alumnos_grupos`;

CREATE TABLE `alumnos_grupos` (
  `alumno_id` int(10) unsigned NOT NULL,
  `grupo_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`alumno_id`,`grupo_id`),
  KEY `fk_alumnos_grupos_grupo_id` (`grupo_id`),
  CONSTRAINT `fk_alumnos_grupos_alumno_id` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`id`),
  CONSTRAINT `fk_alumnos_grupos_grupo_id` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `asignaturas` */

DROP TABLE IF EXISTS `asignaturas`;

CREATE TABLE `asignaturas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=404 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `asignaturas_carreras` */

DROP TABLE IF EXISTS `asignaturas_carreras`;

CREATE TABLE `asignaturas_carreras` (
  `asignatura_id` int(10) unsigned NOT NULL,
  `carrera_id` int(10) unsigned NOT NULL,
  `cuatrimestre` int(10) unsigned NOT NULL,
  `horas_semana` int(11) NOT NULL,
  PRIMARY KEY (`carrera_id`,`asignatura_id`),
  KEY `fk_asignaturas_carreras_asignatura_id` (`asignatura_id`),
  CONSTRAINT `fk_asignaturas_carreras_asignatura_id` FOREIGN KEY (`asignatura_id`) REFERENCES `asignaturas` (`id`),
  CONSTRAINT `fk_asignaturas_carreras_carrera_id` FOREIGN KEY (`carrera_id`) REFERENCES `carreras` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `asignaturas_profesores` */

DROP TABLE IF EXISTS `asignaturas_profesores`;

CREATE TABLE `asignaturas_profesores` (
  `asignatura_id` int(10) unsigned NOT NULL,
  `profesor_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`asignatura_id`,`profesor_id`),
  KEY `fk_asignaturas_profesores_profesor_id` (`profesor_id`),
  CONSTRAINT `fk_asignaturas_profesores_asignatura_id` FOREIGN KEY (`asignatura_id`) REFERENCES `asignaturas` (`id`),
  CONSTRAINT `fk_asignaturas_profesores_profesor_id` FOREIGN KEY (`profesor_id`) REFERENCES `profesores` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `aulas` */

DROP TABLE IF EXISTS `aulas`;

CREATE TABLE `aulas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `calificaciones` */

DROP TABLE IF EXISTS `calificaciones`;

CREATE TABLE `calificaciones` (
  `alumno_id` int(10) unsigned NOT NULL,
  `asignatura_id` int(10) unsigned NOT NULL,
  `corte_1` float DEFAULT NULL,
  `corte_2` float DEFAULT NULL,
  `corte_3` float DEFAULT NULL,
  PRIMARY KEY (`alumno_id`,`asignatura_id`),
  KEY `fk_calificaciones_asignatura_id` (`asignatura_id`),
  CONSTRAINT `fk_calificaciones_alumno_id` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`id`),
  CONSTRAINT `fk_calificaciones_asignatura_id` FOREIGN KEY (`asignatura_id`) REFERENCES `asignaturas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `carreras` */

DROP TABLE IF EXISTS `carreras`;

CREATE TABLE `carreras` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `clave` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `ciclos` */

DROP TABLE IF EXISTS `ciclos`;

CREATE TABLE `ciclos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `clases` */

DROP TABLE IF EXISTS `clases`;

CREATE TABLE `clases` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `profesor_id` int(10) unsigned NOT NULL,
  `grupo_id` int(10) unsigned NOT NULL,
  `asignatura_id` int(10) unsigned NOT NULL,
  `aula_id` int(10) unsigned NOT NULL,
  `horario_id` int(10) unsigned NOT NULL,
  `ciclo_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_clases_profesor_id` (`profesor_id`),
  KEY `fk_clases_grupo_id` (`grupo_id`),
  KEY `fk_clases_asignatura_id` (`asignatura_id`),
  KEY `fk_clases_aula_id` (`aula_id`),
  KEY `fk_clases_horario_id` (`horario_id`),
  KEY `fk_clases_ciclo_id` (`ciclo_id`),
  CONSTRAINT `fk_clases_asignatura_id` FOREIGN KEY (`asignatura_id`) REFERENCES `asignaturas` (`id`),
  CONSTRAINT `fk_clases_aula_id` FOREIGN KEY (`aula_id`) REFERENCES `aulas` (`id`),
  CONSTRAINT `fk_clases_ciclo_id` FOREIGN KEY (`ciclo_id`) REFERENCES `ciclos` (`id`),
  CONSTRAINT `fk_clases_grupo_id` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`),
  CONSTRAINT `fk_clases_horario_id` FOREIGN KEY (`horario_id`) REFERENCES `horarios` (`id`),
  CONSTRAINT `fk_clases_profesor_id` FOREIGN KEY (`profesor_id`) REFERENCES `profesores` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1201 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `grupos` */

DROP TABLE IF EXISTS `grupos`;

CREATE TABLE `grupos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `carrera_id` int(10) unsigned NOT NULL,
  `ciclo_id` int(10) unsigned NOT NULL,
  `cuatrimestre` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_grupos_carrera_id` (`carrera_id`),
  KEY `fk_grupos_ciclo_id` (`ciclo_id`),
  CONSTRAINT `fk_grupos_carrera_id` FOREIGN KEY (`carrera_id`) REFERENCES `carreras` (`id`),
  CONSTRAINT `fk_grupos_ciclo_id` FOREIGN KEY (`ciclo_id`) REFERENCES `ciclos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `horarios` */

DROP TABLE IF EXISTS `horarios`;

CREATE TABLE `horarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `dia` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `profesores` */

DROP TABLE IF EXISTS `profesores`;

CREATE TABLE `profesores` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `apellido_paterno` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `apellido_materno` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `curp` varchar(18) COLLATE utf8_unicode_ci NOT NULL,
  `genero` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `ciudad` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `horario_clases` */

DROP TABLE IF EXISTS `horario_clases`;

/*!50001 DROP VIEW IF EXISTS `horario_clases` */;
/*!50001 DROP TABLE IF EXISTS `horario_clases` */;

/*!50001 CREATE TABLE  `horario_clases`(
 `profesor_id` int(10) unsigned ,
 `profesor_nombre` varchar(50) ,
 `grupo_id` int(10) unsigned ,
 `grupo_nombre` varchar(20) ,
 `asignatura_id` int(10) unsigned ,
 `asignatura_nombre` varchar(100) ,
 `aula_id` int(10) unsigned ,
 `aula_nombre` varchar(20) ,
 `horario_id` int(10) unsigned ,
 `dia` int(10) ,
 `hora_inicio` time ,
 `hora_fin` time 
)*/;

/*View structure for view horario_clases */

/*!50001 DROP TABLE IF EXISTS `horario_clases` */;
/*!50001 DROP VIEW IF EXISTS `horario_clases` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `horario_clases` AS (select `profesores`.`id` AS `profesor_id`,`profesores`.`nombre` AS `profesor_nombre`,`grupos`.`id` AS `grupo_id`,`grupos`.`nombre` AS `grupo_nombre`,`asignaturas`.`id` AS `asignatura_id`,`asignaturas`.`nombre` AS `asignatura_nombre`,`aulas`.`id` AS `aula_id`,`aulas`.`nombre` AS `aula_nombre`,`horarios`.`id` AS `horario_id`,`horarios`.`dia` AS `dia`,`horarios`.`hora_inicio` AS `hora_inicio`,`horarios`.`hora_fin` AS `hora_fin` from (((((`clases` join `profesores` on((`profesores`.`id` = `clases`.`profesor_id`))) join `grupos` on((`grupos`.`id` = `clases`.`grupo_id`))) join `asignaturas` on((`asignaturas`.`id` = `clases`.`asignatura_id`))) join `aulas` on((`aulas`.`id` = `clases`.`aula_id`))) join `horarios` on((`horarios`.`id` = `clases`.`horario_id`)))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
