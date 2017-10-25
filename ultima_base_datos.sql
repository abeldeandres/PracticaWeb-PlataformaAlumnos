-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-01-2014 a las 10:28:25
-- Versión del servidor: 5.5.34
-- Versión de PHP: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `bd_abel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tgrupo`
--

CREATE TABLE IF NOT EXISTS `tgrupo` (
  `idGrupo` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `idJefe` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idGrupo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10002 ;

--
-- Volcado de datos para la tabla `tgrupo`
--

INSERT INTO `tgrupo` (`idGrupo`, `nombre`, `descripcion`, `idJefe`) VALUES
(10000, 'Algo', 'asdasdasd asdasdasd', 'responsable'),
(10001, 'Grupo guay', 'Este es un super grupo guay etc etc...', 'responsable');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmiembro`
--

CREATE TABLE IF NOT EXISTS `tmiembro` (
  `idUsuario` varchar(20) NOT NULL,
  `idGrupo` int(10) NOT NULL,
  PRIMARY KEY (`idUsuario`,`idGrupo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tmiembro`
--

INSERT INTO `tmiembro` (`idUsuario`, `idGrupo`) VALUES
('admin', 10000),
('admin', 10001),
('anastasio99', 10001),
('franck_cl', 10000),
('franck_cl', 10001),
('jaimito_99', 10000),
('jaimito_99', 10001),
('miembro', 10000),
('responsable', 10000),
('responsable', 10001);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trecursos`
--

CREATE TABLE IF NOT EXISTS `trecursos` (
  `idRecursos` int(10) NOT NULL AUTO_INCREMENT,
  `ruta` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `esPublico` tinyint(1) NOT NULL DEFAULT '0',
  `idReuniones` int(10) NOT NULL,
  PRIMARY KEY (`idRecursos`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `trecursos`
--

INSERT INTO `trecursos` (`idRecursos`, `ruta`, `nombre`, `descripcion`, `esPublico`, `idReuniones`) VALUES
(4, '../archivos/disponibilidad_joven.sql', 'Contenido MySQL', 'hola gasasasas', 1, 100),
(7, '../archivos/ambrellaDisponibilidad.sql', 'dasdasd', 'asdasdasdasd', 0, 100),
(8, '../archivos/ambrella 23-01-14.sql', 'Reunion para recuperar el mundo', 'Vamos chicos a recuperar el planeta!!!!', 0, 104),
(9, '../archivos/script_disponibilidad.php', 'Algun contenido ', 'Yo que sÃ© yo que sÃ©', 1, 102);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `treuniones`
--

CREATE TABLE IF NOT EXISTS `treuniones` (
  `idReuniones` int(10) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `idGrupo` int(10) NOT NULL,
  PRIMARY KEY (`idReuniones`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=105 ;

--
-- Volcado de datos para la tabla `treuniones`
--

INSERT INTO `treuniones` (`idReuniones`, `fecha`, `descripcion`, `idGrupo`) VALUES
(100, '2014-01-09', 'Holaaaa dsaddasdas', 10000),
(102, '2014-01-18', 'dasdasdsad', 10001),
(104, '2014-01-22', 'Es una reunion super guay\r\n', 10001);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tusuario`
--

CREATE TABLE IF NOT EXISTS `tusuario` (
  `idUsuario` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `esAdmin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tusuario`
--

INSERT INTO `tusuario` (`idUsuario`, `nombre`, `pass`, `correo`, `esAdmin`) VALUES
('admin', 'Franck', 'admin', 'admin1_algo@algo.com', 1),
('anastasio99', 'Anastasio', '148240', 'anastasio_99@gmail.com', 0),
('franck_cl', 'Elvis Frank Canchari Lapa', '148240', 'franck_cl@practica.com', 0),
('jaimito_99', 'Jaime', '148240', 'jaime@algo.com', 0),
('miembro', 'Jaime Miembro', 'miembro', 'miembro@pruebas.com', 0),
('responsable', 'Pedro responsable', 'responsable', 'responsable@prueba.com', 0),
('usuario', 'usuario asdasd', 'usuario', '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
