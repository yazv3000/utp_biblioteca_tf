-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-01-2021 a las 13:19:38
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


-- Base de datos: `db_biblioteca`

-- =========================================================

-- Estructura de tabla para la tabla `usuarios`
CREATE TABLE `usuarios` (
  `id_user` int(11) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `nombres` varchar(80) NOT NULL,
  `apellidos` varchar(80) NOT NULL,
  `dni` char(8) NOT NULL,
  `clave` varchar(200) NOT NULL,
  `rol` int(11) NOT NULL,             -- 1 => Administrador       2 => Supervisor
  `estado` int(11) NOT NULL DEFAULT 1,

  CONSTRAINT PRIMARY KEY (`id_user`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcado de datos para la tabla `usuarios`, por defecto usuario = clave
INSERT INTO `usuarios` (`id_user`, `usuario`, `nombres`, `apellidos`,`dni`, `clave`, `rol`, `estado`) VALUES
(1, 'admin', 'Jhon', 'Smith', '24568752', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 1, 1),
(2, 'admin2', 'Margaret', 'Gump', '45269147', '1c142b2d01aa34e9a36bde480645a57fd69e14155dacfab5a3f9257b77fdc8d8', 1, 1),
(3, 's001', 'Natalia', 'Dussan', '49687523', '7e3bc81f04b2f13aef95a3b0362396c7d8cb1a829be247e0b0c6319714abc366', 2, 1),
(4, 's002', 'Richard', 'Montejo', '28759648', 'fbac39b97daa29ee278055344460ac4349fdf85f8004c13cf37688e0faac3f26', 2, 0),
(5, 's003', 'Eduardo', 'Vallejo', '24537759', '15817969c26b134b8e13ad1da04d81dcd87df1fc7fef478b2acd85d5978ccfb3', 2, 1);

-- AUTO_INCREMENT de la tabla `usuarios`
ALTER TABLE `usuarios`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

-- =========================================================

-- Estructura de tabla para la tabla `estudiante`
CREATE TABLE `carrera` (
  `id_carrera` int(11) NOT NULL,
  `nom_carrera` varchar(200) NOT NULL,
  CONSTRAINT PRIMARY KEY (`id_carrera`)
);

-- Volcado de datos para la tabla `carrera`
INSERT INTO `carrera` (`id_carrera`, `nom_carrera`) VALUES
(1, 'Ingeniería de Sistemas'),
(2, 'Ingeniería Industrial'),
(3, 'Ingeniería Mecatrónica'),
(4, 'Ingeniería Civil'),
(5, 'Arquitectura'),
(6, 'Derecho'),
(7, 'Psicología');

-- AUTO_INCREMENT de la tabla `carrera`
ALTER TABLE `carrera`
  MODIFY `id_carrera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

CREATE TABLE `estudiante` (
  `codigo` varchar(9) NOT NULL,
  `dni` char(8) NOT NULL,
  `nombres` varchar(80) NOT NULL,
  `apellidos` varchar(80) NOT NULL,
  `id_carrera` int(11) NOT NULL,
  `direccion` text NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `clave` varchar(200) NOT NULL,

  CONSTRAINT PRIMARY KEY (`codigo`),
  CONSTRAINT FOREIGN KEY (`id_carrera`) REFERENCES `carrera`(`id_carrera`) ON DELETE CASCADE

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcado de datos para la tabla `estudiante`
INSERT INTO `estudiante` (`codigo`, `dni`,  `nombres`, `apellidos`, `id_carrera`, `direccion`, `telefono`, `estado`) VALUES
('u001', '76485165', 'Joel', 'Benavides Guillén', 1, 'Av. Argentina, 256', '999777888', 1),
('u002', '74892135', 'Ana María', 'Torres Salas', 2, 'Calle Amatura, 138', '978458272', 1),
('u003', '76484568', 'Guido', 'Martinez Carrión', 6, 'Calle 28 de julio, 503', '975257512', 1),
('u004', '72481957', 'Samir', 'Salas Rodriguez', 5, 'Av. Rio Blanco, 29', '900555666', 0);

-- =========================================================

-- Estructura de tabla para la tabla `autor`
CREATE TABLE `autor` (
  `id_autor` int(11) NOT NULL,
  `nom_autor` varchar(80) NOT NULL,
  `ape_autor` varchar(80) NOT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,

  CONSTRAINT PRIMARY KEY (`id_autor`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcado de datos para la tabla `autor`
INSERT INTO `autor` (`id_autor`, `nom_autor`, `ape_autor`, `imagen`, `estado`) VALUES
(1, 'Raymond', 'Serway', 'default-avatar.png', 1),
(2, 'Carlos', 'Contreras', 'default-avatar.png', 1),
(3, 'Erich', 'Gamma', 'default-avatar.png', 1),
(4, 'Renato', 'Valverde Málaga', 'default-avatar.png', 1),
(5, 'Ignacio', 'Satizaba Lopez', 'default-avatar.png', 1),
(6, 'Wigberto', 'Mamani', 'default-avatar.png', 1),
(7, 'Aurona', 'Cano Garcia', 'default-avatar.png', 0);

-- AUTO_INCREMENT de la tabla `autor`
ALTER TABLE `autor`
  MODIFY `id_autor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

-- =========================================================

-- Estructura de tabla para la tabla `tipo_recurso`
CREATE TABLE `tipo_recurso` (
  `id_tipo` int(11) NOT NULL,
  `nom_tipo` varchar(40) NOT NULL,
  `lugar_prestamo` varchar(60) NOT NULL,

  CONSTRAINT PRIMARY KEY (`id_tipo`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcado de datos para la tabla `tipo_recurso`
INSERT INTO `tipo_recurso` (`id_tipo`, `nom_tipo`, `lugar_prestamo`) VALUES
(1, 'Libro', 'A domicilio'),
(2, 'Artículo de Revista', 'Lectura en sala'),
(3, 'Tesis', 'Lectura en sala');

-- AUTO_INCREMENT de la tabla `tipo_recurso`
ALTER TABLE `tipo_recurso`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

-- =========================================================

-- Estructura de tabla para la tabla `editorial`
CREATE TABLE `editorial` (
  `id_editorial` int(11) NOT NULL,
  `nom_editorial` varchar(150) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,

  CONSTRAINT PRIMARY KEY (`id_editorial`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcado de datos para la tabla `editorial`
INSERT INTO `editorial` (`id_editorial`, `nom_editorial`) VALUES
(1, 'Fondo Editorial'),
(2, 'Cengage Lerning'),
(3, 'Pearson Education');

-- AUTO_INCREMENT de la tabla `editorial`
ALTER TABLE `editorial`
  MODIFY `id_editorial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

-- =========================================================
-- Estructura de tabla para la tabla `materia`

CREATE TABLE `materia` (
  `id_materia` int(11) NOT NULL,
  `nom_materia` text NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,

  CONSTRAINT PRIMARY KEY (`id_materia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcado de datos para la tabla `materia`
INSERT INTO `materia` (`id_materia`, `nom_materia`) VALUES
(1, 'Programación'),
(2, 'Ciencias'),
(3, 'Física'),
(4, 'Matemáticas'),
(5, 'Historia'),
(6, 'Derecho'),
(7, 'Sociales'),
(8, 'Ingeniería');

-- AUTO_INCREMENT de la tabla `materia`

ALTER TABLE `materia`
  MODIFY `id_materia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

-- =========================================================
-- Estructura de tabla para la tabla `recurso`
CREATE TABLE `recurso` (
  `id_recurso` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `cant_disponible` int(11) NOT NULL,
  `id_autor` int(11) NOT NULL,
  `id_editorial` int(11) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `volumen` varchar(5) DEFAULT NULL,
  `revista` varchar(100) DEFAULT NULL,
  `anio` date NOT NULL,
  `id_materia` int(11) NOT NULL,
  `paginas` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,

  CONSTRAINT PRIMARY KEY (`id_recurso`),
  FOREIGN KEY (`id_tipo`) REFERENCES `tipo_recurso` (`id_tipo`) ON DELETE CASCADE,
  FOREIGN KEY (`id_autor`) REFERENCES `autor` (`id_autor`) ON DELETE CASCADE,
  FOREIGN KEY (`id_editorial`) REFERENCES `editorial` (`id_editorial`) ON DELETE CASCADE,
  FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcado de datos para la tabla `materia`
INSERT INTO `recurso` 
(`id_recurso`,`id_tipo`,`titulo`,`cant_disponible`,`id_autor`,`id_editorial`,`numero`,`volumen`,`revista`,`anio`,`id_materia`,`paginas`,`descripcion`,`imagen`,`estado`) VALUES
(1, 1, 'Historia del Perú Contemporáneo',    50,        2,        1,          null,     null,     null, '2007-11-23',     4,      424, 'Libro histórico', 'default-avatar.png', 1),
(2, 1, 'Física Para Ciencias e Ingeniería',  19,        1,        2,          null,     null,     null, '2014-05-06',     3,      896, '', 'default-avatar.png', 1),
(3, 1, 'Patrones de diseño',                 24,        3,        3,          null,     null,     null, '2002-07-24',     1,      384, '', 'default-avatar.png', 1),
(4, 2, 'La crisis demográfica del siglo XVI en los Andes', 10, 2, null,         4,      'III',   'Diálogo Andino', '2020-08-11', 5, 26, '', null, 1),
(5, 2, 'La Bioinformática como estrategia de mejora en el desarrollo agrícola', 15, 5, null, 7, 'VII', 'Scielo', '2019-02-03',   2, 13, '', null, 1),
(6, 3, 'Control y adquisición de datos de máquinas industriales basados en RS485', 12, 6, null, null, null, null, '2015-09-09',  8, 136, '', null, 1),
(7, 3, 'Análisis de la pluralidad de instancia, como afectaron al derecho de defensa del absuelto', 4, 4, null, null, null, null, '2019-07-04', 6, 188, '', null, 1);

-- AUTO_INCREMENT de la tabla `recurso`
ALTER TABLE `recurso`
  MODIFY `id_recurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

-- =========================================================

-- Estructura de tabla para la tabla `prestamo`
CREATE TABLE `prestamo` (
  `id_prestamo` int(11) NOT NULL,
  `cod_estudiante` varchar(9) NOT NULL,
  `id_recurso` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_solicitud` date NOT NULL,
  `estado_solicitud` int(11) NOT NULL DEFAULT 0,
  `fecha_prestamo` date DEFAULT NULL,
  `fecha_lim_dev` date DEFAULT NULL,
  `fecha_real_dev` date DEFAULT NULL,
  `estado_prestamo` int(11) DEFAULT NULL,
  `observacion` text DEFAULT NULL,

  CONSTRAINT PRIMARY KEY (`id_prestamo`),
  FOREIGN KEY (`cod_estudiante`) REFERENCES `estudiante` (`codigo`) ON DELETE CASCADE,
  FOREIGN KEY (`id_recurso`) REFERENCES `recurso` (`id_recurso`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcado de datos para la tabla `prestamo`
INSERT INTO `prestamo` (`id_prestamo`, `cod_estudiante`, `id_recurso`,`cantidad`,`fecha_solicitud`,`estado_solicitud`, `fecha_prestamo`, `fecha_lim_dev`, `fecha_real_dev`,`estado_prestamo`,`observacion`)
VALUES
(1, 'u001', 2, 1, '2021-12-06', 1, '2021-12-07', '2021-12-09', null, 1, ''),
(2, 'u003', 4, 2, '2021-12-07', 1, '2021-12-07', '2021-12-07', null, 1, '');

-- AUTO_INCREMENT de la tabla `prestamo`
ALTER TABLE `prestamo`
  MODIFY `id_prestamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

-- =========================================================
-- Estructura de tabla para la tabla `configuracion`

CREATE TABLE `configuracion` (
  `id_config` int(11) NOT NULL,
  `empresa` varchar(150) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `direccion` text NOT NULL,
  `correo` varchar(100) NOT NULL,

  CONSTRAINT PRIMARY KEY (`id_config`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcado de datos para la tabla `configuracion`
INSERT INTO `configuracion` (`id_config`, `empresa`, `telefono`, `direccion`, `correo`) VALUES
(1, 'Biblioteca UTP', '960252970', 'Av. Tacna y Arica 160 - Arequipa', 'biblioteca_aqp@utp.edu.pe');

-- AUTO_INCREMENT de la tabla `configuracion`

ALTER TABLE `configuracion`
  MODIFY `id_config` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;