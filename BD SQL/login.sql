-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 20-07-2023 a las 00:48:37
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `login`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_turno`
--

CREATE TABLE IF NOT EXISTS `estado_turno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `estado_turno`
--

INSERT INTO `estado_turno` (`id`, `estado_descripcion`) VALUES
(1, 'asistido'),
(2, 'no asistido'),
(3, 'guardado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

CREATE TABLE IF NOT EXISTS `medicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`id`, `nombre`, `apellido`) VALUES
(1, 'Jose', 'Gonzalez'),
(2, 'Mauricio', 'Saude'),
(3, 'Trinidad', 'Moreno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obra_social`
--

CREATE TABLE IF NOT EXISTS `obra_social` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `obra_social` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `obra_social`
--

INSERT INTO `obra_social` (`id`, `obra_social`) VALUES
(1, 'Prevencion Salud'),
(2, 'OSDE'),
(3, 'SWISS MEDICAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE IF NOT EXISTS `paciente` (
  `Id_p` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_p` varchar(50) NOT NULL,
  `Apellido_p` varchar(50) NOT NULL,
  `DNI_p` int(10) NOT NULL,
  `id_obra_social` int(11) NOT NULL,
  PRIMARY KEY (`Id_p`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`Id_p`, `Nombre_p`, `Apellido_p`, `DNI_p`, `id_obra_social`) VALUES
(1, 'Esteban ', 'Dominguez', 30666777, 1),
(2, 'Juliana', 'Echeverri ', 30777888, 2),
(3, 'Gerardo', 'Martinez', 30888999, 1),
(4, 'Gloria', 'Navarro', 31222333, 3),
(5, 'Cristina', 'Zapata', 31333222, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestaciones`
--

CREATE TABLE IF NOT EXISTS `prestaciones` (
  `id_s` int(11) NOT NULL AUTO_INCREMENT,
  `sesiones` varchar(100) NOT NULL,
  `precio` int(11) DEFAULT NULL,
  `porcentaje` int(11) NOT NULL,
  `es_compleja` tinyint(1) NOT NULL,
  `activa` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_s`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=23 ;

--
-- Volcado de datos para la tabla `prestaciones`
--

INSERT INTO `prestaciones` (`id_s`, `sesiones`, `precio`, `porcentaje`, `es_compleja`, `activa`) VALUES
(1, 'Sesiones de Fisioterapia', NULL, 0, 0, 0),
(2, 'Sesiones de Psicología', NULL, 0, 0, 0),
(3, 'Tomografía (TAC)', 1500, 10, 0, 0),
(4, 'Resonancia Magnética', 2500, 20, 0, 0),
(5, 'Fisioterapia', 0, 0, 0, 1),
(6, 'Cardiologia', 10000, 10, 1, 1),
(7, 'Fisioterapia', 0, 0, 0, 0),
(8, 'Fisioterapia2', 0, 0, 0, 0),
(9, 'Fisioterapia3', 0, 0, 0, 0),
(10, 'Fisioterapia4', 0, 0, 0, 0),
(11, 'Cardiologia2', 0, 0, 0, 0),
(12, 'Cardiologia3', 0, 0, 0, 0),
(13, 'Cardiologia5', 0, 0, 0, 0),
(14, 'Fisioterapia6', 0, 0, 0, 0),
(15, 'Fisioterapia6', 0, 0, 0, 0),
(16, 'Fisioterapia7', 0, 0, 0, 0),
(17, 'Fisioterapia8', 0, 0, 0, 0),
(18, 'Fisioterapia14', 0, 0, 0, 0),
(19, 'Fisioterapia15', 0, 0, 0, 1),
(20, 'Fisioterapia16', 0, 0, 0, 0),
(21, 'Fisioterapia18', 0, 0, 0, 0),
(22, 'Diabetologia', 100000, 50, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rango`
--

CREATE TABLE IF NOT EXISTS `rango` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rango` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `rango`
--

INSERT INTO `rango` (`id`, `rango`) VALUES
(1, 'Administrador'),
(2, 'Medico'),
(3, 'Paciente'),
(4, 'Secretaria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnero`
--

CREATE TABLE IF NOT EXISTS `turnero` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_obra_social` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `id_prestacion` int(11) NOT NULL,
  `id_estado_turno` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `turnero`
--

INSERT INTO `turnero` (`id`, `fecha`, `id_paciente`, `id_obra_social`, `id_medico`, `id_prestacion`, `id_estado_turno`, `id_usuario`) VALUES
(1, '2023-06-05 08:00:00', 1, 1, 1, 1, 2, 0),
(2, '2023-06-05 08:30:00', 2, 2, 2, 2, 1, 4),
(3, '2023-06-05 08:00:00', 4, 3, 3, 3, 1, 5),
(4, '2023-06-06 09:00:00', 5, 2, 3, 3, 3, 0),
(5, '2023-06-06 09:00:00', 2, 2, 2, 4, 3, 4),
(6, '2023-06-06 10:00:00', 4, 3, 1, 4, 3, 5),
(10, '2023-07-30 00:00:00', 5, 2, 3, 22, 2, 2),
(11, '2023-07-23 00:00:00', 1, 1, 3, 1, 3, 2),
(12, '2023-07-05 00:00:00', 2, 2, 2, 2, 3, 2),
(13, '2023-07-04 00:00:00', 3, 1, 2, 2, 3, 2),
(14, '2023-07-12 00:00:00', 3, 1, 2, 3, 3, 2),
(15, '2023-07-12 00:00:00', 1, 1, 3, 1, 3, 2),
(16, '2023-07-18 00:00:00', 5, 2, 3, 6, 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) NOT NULL,
  `Apellido` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Clave` varchar(32) NOT NULL,
  `id_rango` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `Nombre`, `Apellido`, `Email`, `Clave`, `id_rango`, `foto`) VALUES
(1, 'Sue', 'Palacios', 'sue@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'sue.jpg'),
(2, 'Trinidad', 'Moreno', 'tmoreno@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 2, 'tmoreno.jpg'),
(3, 'Mauricio', 'Saude', 'msaude@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 2, 'msaude.jpg'),
(4, 'Juliana', 'Echeverri', 'jecheverry@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 3, 'jecheverri.jpg'),
(5, 'Gloria', 'Navarro', 'gnavarro@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 3, 'gnavarro.jpg'),
(6, 'Jorgelina', 'Perez', 'jperez@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 4, 'jperez.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_medico`
--

CREATE TABLE IF NOT EXISTS `usuario_medico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_medico` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `usuario_medico`
--

INSERT INTO `usuario_medico` (`id`, `id_medico`, `id_usuario`) VALUES
(1, 3, 2),
(2, 2, 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
