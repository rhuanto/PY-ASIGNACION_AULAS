-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-08-2024 a las 20:20:36
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `trabajo`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_AsignarAula` (IN `Id_Docente` INT, IN `Id_Curso` INT, IN `Id_Aula` INT, IN `Dia` VARCHAR(10), IN `Hora_Inicio` TIME, IN `Hora_Fin` TIME, IN `Grupo` VARCHAR(10), IN `Cantidad_Alumnos` INT)   BEGIN
    INSERT INTO `asignaciones` (`Id_Docente`, `Id_Curso`, `Id_Aula`, `Dia`, `Hora_Inicio`, `Hora_Fin`, `Grupo`, `Cantidad_Alumnos`)
    VALUES (`Id_Docente`, `Id_Curso`, `Id_Aula`, `Dia`, `Hora_Inicio`, `Hora_Fin`, `Grupo`, `Cantidad_Alumnos`);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_RegistrarCurso` (IN `p_Nombre` VARCHAR(100), IN `p_Ciclo` INT, IN `p_Id_Escuela` INT)   BEGIN
    INSERT INTO Cursos (Nombre, Ciclo, Id_Escuela) VALUES (p_Nombre, p_Ciclo, p_Id_Escuela);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_RegistrarDocente` (IN `p_Nombre` VARCHAR(100))   BEGIN
    INSERT INTO Docentes (Nombre) VALUES (p_Nombre);
END$$

DELIMITER ;

--
-- Estructura de tabla para la tabla `usuarios`
--


CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    reset_token VARCHAR(100) NULL,
    reset_expira DATETIME NULL
);



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaciones`
--

CREATE TABLE `asignaciones` (
  `Id_Asignacion` int(11) NOT NULL,
  `Id_Docente` int(11) DEFAULT NULL,
  `Id_Curso` int(11) DEFAULT NULL,
  `Id_Aula` int(11) DEFAULT NULL,
  `Dia` varchar(20) NOT NULL,
  `Hora_Inicio` time NOT NULL,
  `Hora_Fin` time NOT NULL,
  `Grupo` varchar(10) DEFAULT NULL,
  `Cantidad_Alumnos` int(11) DEFAULT NULL,
  `tipo_dictado` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asignaciones`
--

INSERT INTO `asignaciones` (`Id_Asignacion`, `Id_Docente`, `Id_Curso`, `Id_Aula`, `Dia`, `Hora_Inicio`, `Hora_Fin`, `Grupo`, `Cantidad_Alumnos`, `tipo_dictado`) VALUES
(1, 5, 5, 10, 'Lunes', '08:00:00', '12:00:00', '1', 30, NULL),
(2, 7, 5, 7, 'Lunes', '08:00:00', '12:00:00', '3', 25, NULL),
(3, 14, 7, 7, 'Lunes', '14:00:00', '18:00:00', '1', 25, NULL),
(4, 16, 7, 6, 'Lunes', '14:00:00', '18:00:00', '3', 20, NULL),
(5, 12, 10, 10, 'Lunes', '14:00:00', '17:00:00', '2', 30, NULL),
(6, 9, 10, 13, 'Lunes', '14:00:00', '17:00:00', '4', 20, NULL),
(7, 21, 13, 20, 'Lunes', '08:00:00', '13:00:00', '1', 45, NULL),
(8, 23, 16, 9, 'Lunes', '08:00:00', '14:00:00', '2', 25, NULL),
(9, 28, 20, 20, 'Lunes', '14:00:00', '16:00:00', '1', 45, NULL),
(10, 28, 20, 20, 'Lunes', '16:00:00', '18:00:00', '2', 45, NULL),
(11, 29, 20, 21, 'Lunes', '08:00:00', '14:00:00', '3', 45, NULL),
(12, 26, 23, 27, 'Lunes', '08:00:00', '12:00:00', '1', 50, NULL),
(13, 36, 23, 23, 'Lunes', '08:00:00', '12:00:00', '2', 45, NULL),
(14, 38, 24, 25, 'Lunes', '08:00:00', '13:00:00', '3', 45, NULL),
(15, 41, 26, 27, 'Lunes', '14:00:00', '18:00:00', '1', 50, NULL),
(16, 42, 26, 4, 'Lunes', '14:00:00', '18:00:00', '2', 40, NULL),
(17, 44, 27, 26, 'Lunes', '08:00:00', '13:00:00', '1', 45, NULL),
(18, 46, 28, 21, 'Lunes', '14:00:00', '18:00:00', '2', 45, NULL),
(19, 51, 35, 9, 'Lunes', '14:00:00', '18:00:00', '1', 20, NULL),
(20, 50, 35, 11, 'Lunes', '14:00:00', '18:00:00', '2', 20, NULL),
(21, 54, 38, 20, 'Lunes', '18:00:00', '22:00:00', '1', 45, NULL),
(22, 55, 38, 21, 'Lunes', '18:00:00', '22:00:00', '2', 45, NULL),
(23, 68, 47, 23, 'Lunes', '16:00:00', '20:00:00', '1', 45, NULL),
(24, 70, 48, 27, 'Lunes', '18:00:00', '22:00:00', '1', 50, NULL),
(25, 8, 51, 5, 'Lunes', '14:00:00', '18:00:00', '1', 40, NULL),
(26, 80, 53, 16, 'Lunes', '17:00:00', '22:00:00', '4', 40, NULL),
(27, 81, 54, 7, 'Lunes', '19:00:00', '22:00:00', '2', 13, NULL),
(28, 98, 54, 6, 'Lunes', '19:00:00', '22:00:00', '4', 13, NULL),
(29, 53, 54, 9, 'Lunes', '19:00:00', '22:00:00', '10', 13, NULL),
(30, 84, 56, 4, 'Lunes', '19:00:00', '22:00:00', '1', 40, NULL),
(31, 75, 56, 16, 'Lunes', '14:00:00', '17:00:00', '4', 40, NULL),
(32, 85, 57, 19, 'Lunes', '17:00:00', '22:00:00', '1', 40, NULL),
(33, 75, 57, 22, 'Lunes', '17:00:00', '22:00:00', '3', 40, NULL),
(34, 73, 58, 5, 'Lunes', '18:00:00', '22:00:00', '3', 40, NULL),
(35, 87, 60, 11, 'Lunes', '19:00:00', '22:00:00', '1', 20, NULL),
(36, 91, 63, 15, 'Lunes', '19:00:00', '22:00:00', '4', 18, NULL),
(37, 98, 67, 29, 'Lunes', '14:00:00', '18:00:00', '1', 50, NULL),
(38, 78, 70, 1, 'Lunes', '15:00:00', '18:00:00', '1', 37, NULL),
(39, 94, 71, 12, 'Lunes', '18:00:00', '21:00:00', '1', 18, NULL),
(40, 78, 71, 1, 'Lunes', '19:00:00', '22:00:00', '6', 37, NULL),
(41, 1, 1, 7, 'Martes', '16:00:00', '18:00:00', '1', 25, NULL),
(42, 3, 2, 7, 'Martes', '14:00:00', '16:00:00', '1', 25, NULL),
(43, 5, 4, 7, 'Martes', '08:00:00', '12:00:00', '5', 20, NULL),
(44, 6, 4, 6, 'Martes', '08:00:00', '12:00:00', '6', 20, NULL),
(45, 10, 6, 9, 'Martes', '10:00:00', '13:00:00', '2', 20, NULL),
(46, 12, 6, 11, 'Martes', '10:00:00', '13:00:00', '4', 20, NULL),
(47, 13, 7, 9, 'Martes', '08:00:00', '10:00:00', '2', 20, NULL),
(48, 17, 7, 11, 'Martes', '08:00:00', '10:00:00', '4', 20, NULL),
(49, 8, 11, 17, 'Martes', '14:00:00', '17:00:00', '5', 31, NULL),
(50, 19, 11, 9, 'Martes', '14:00:00', '17:00:00', '6', 20, NULL),
(51, 20, 12, 20, 'Martes', '08:00:00', '13:00:00', '1', 45, NULL),
(52, 22, 21, 4, 'Martes', '08:00:00', '13:00:00', '1', 40, NULL),
(53, 33, 22, 21, 'Martes', '08:00:00', '12:00:00', '2', 45, NULL),
(54, 34, 22, 23, 'Martes', '08:00:00', '12:00:00', '3', 45, NULL),
(55, 35, 22, 5, 'Martes', '08:00:00', '12:00:00', '4', 40, NULL),
(56, 39, 24, 4, 'Martes', '14:00:00', '17:00:00', '2', 40, NULL),
(57, 40, 25, 27, 'Martes', '08:00:00', '13:00:00', '1', 50, NULL),
(58, 44, 27, 5, 'Martes', '14:00:00', '17:00:00', '2', 40, NULL),
(59, 49, 33, 16, 'Martes', '08:00:00', '12:00:00', '1', 40, NULL),
(60, 46, 33, 19, 'Martes', '08:00:00', '10:00:00', '2', 40, NULL),
(61, 50, 34, 16, 'Martes', '14:00:00', '19:00:00', '1', 40, NULL),
(62, 36, 39, 20, 'Martes', '14:00:00', '18:00:00', '3', 45, NULL),
(63, 56, 39, 21, 'Martes', '14:00:00', '18:00:00', '4', 45, NULL),
(64, 60, 41, 27, 'Martes', '18:00:00', '22:00:00', '1', 50, NULL),
(65, 57, 41, 20, 'Martes', '18:00:00', '22:00:00', '2', 45, NULL),
(66, 62, 42, 21, 'Martes', '18:00:00', '22:00:00', '3', 45, NULL),
(67, 53, 43, 23, 'Martes', '14:00:00', '18:00:00', '2', 45, NULL),
(68, 72, 49, 8, 'Martes', '14:00:00', '19:00:00', '1', 40, NULL),
(69, 73, 53, 4, 'Martes', '17:00:00', '22:00:00', '3', 40, NULL),
(70, 82, 54, 11, 'Martes', '14:00:00', '17:00:00', '5', 13, NULL),
(71, 72, 54, 7, 'Martes', '19:00:00', '22:00:00', '7', 13, NULL),
(72, 49, 54, 6, 'Martes', '19:00:00', '22:00:00', '8', 13, NULL),
(73, 71, 54, 9, 'Martes', '19:00:00', '22:00:00', '9', 13, NULL),
(74, 83, 55, 15, 'Martes', '14:00:00', '18:00:00', '1', 20, NULL),
(75, 82, 58, 5, 'Martes', '18:00:00', '22:00:00', '1', 40, NULL),
(76, 99, 58, 19, 'Martes', '18:00:00', '22:00:00', '2', 40, NULL),
(77, 65, 59, 19, 'Martes', '14:00:00', '18:00:00', '2', 40, NULL),
(78, 88, 61, 23, 'Martes', '18:00:00', '20:00:00', '1', 45, NULL),
(79, 89, 62, 11, 'Martes', '18:00:00', '21:00:00', '1', 20, NULL),
(80, 92, 63, 15, 'Martes', '19:00:00', '22:00:00', '7', 18, NULL),
(81, 69, 65, 22, 'Martes', '18:00:00', '22:00:00', '1', 40, NULL),
(82, 30, 71, 12, 'Martes', '19:00:00', '22:00:00', '3', 18, NULL),
(83, 25, 71, 13, 'Martes', '19:00:00', '22:00:00', '5', 18, NULL),
(84, 93, 74, 10, 'Martes', '16:00:00', '22:00:00', '3', 30, NULL),
(85, 5, 4, 7, 'Miércoles', '08:00:00', '12:00:00', '2', 20, NULL),
(86, 6, 4, 6, 'Miércoles', '08:00:00', '12:00:00', '4', 20, NULL),
(87, 12, 10, 7, 'Miércoles', '14:00:00', '17:00:00', '5', 20, NULL),
(88, 9, 10, 6, 'Miércoles', '14:00:00', '17:00:00', '6', 20, NULL),
(89, 18, 11, 9, 'Miércoles', '10:00:00', '13:00:00', '1', 25, NULL),
(90, 18, 11, 9, 'Miércoles', '14:00:00', '17:00:00', '2', 20, NULL),
(91, 8, 11, 11, 'Miércoles', '10:00:00', '13:00:00', '3', 20, NULL),
(92, 8, 11, 11, 'Miércoles', '14:00:00', '17:00:00', '4', 20, NULL),
(93, 26, 18, 20, 'Miércoles', '08:00:00', '14:00:00', '1', 45, NULL),
(94, 27, 19, 10, 'Miércoles', '08:00:00', '12:00:00', '1', 30, NULL),
(95, 28, 20, 20, 'Miércoles', '14:00:00', '18:00:00', '2', 45, NULL),
(96, 42, 26, 4, 'Miércoles', '14:00:00', '18:00:00', '3', 40, NULL),
(97, 43, 26, 21, 'Miércoles', '14:00:00', '18:00:00', '4', 45, NULL),
(98, 48, 31, 21, 'Miércoles', '08:00:00', '12:00:00', '1', 45, NULL),
(99, 45, 37, 23, 'Miércoles', '08:00:00', '12:00:00', '1', 45, NULL),
(100, 53, 37, 25, 'Miércoles', '08:00:00', '12:00:00', '2', 45, NULL),
(101, 10, 42, 23, 'Miércoles', '14:00:00', '18:00:00', '4', 45, NULL),
(102, 63, 43, 12, 'Miércoles', '14:00:00', '18:00:00', '3', 30, NULL),
(103, 64, 44, 26, 'Miércoles', '08:00:00', '12:00:00', '1', 45, NULL),
(104, 65, 44, 27, 'Miércoles', '08:00:00', '12:00:00', '2', 45, NULL),
(105, 71, 48, 4, 'Miércoles', '18:00:00', '22:00:00', '2', 40, NULL),
(106, 76, 52, 5, 'Miércoles', '19:00:00', '22:00:00', '1', 40, NULL),
(107, 77, 52, 5, 'Miércoles', '14:00:00', '17:00:00', '3', 40, NULL),
(108, 78, 53, 8, 'Miércoles', '13:00:00', '18:00:00', '1', 40, NULL),
(109, 76, 54, 15, 'Miércoles', '14:00:00', '17:00:00', '3', 13, NULL),
(110, 51, 54, 7, 'Miércoles', '19:00:00', '22:00:00', '6', 13, NULL),
(111, 84, 56, 8, 'Miércoles', '19:00:00', '22:00:00', '2', 40, NULL),
(112, 90, 63, 6, 'Miércoles', '19:00:00', '22:00:00', '1', 18, NULL),
(113, 29, 63, 15, 'Miércoles', '19:00:00', '22:00:00', '5', 18, NULL),
(114, 68, 64, 13, 'Miércoles', '16:00:00', '20:00:00', '1', 20, NULL),
(115, 93, 66, 27, 'Miércoles', '14:00:00', '18:00:00', '1', 50, NULL),
(116, 91, 70, 20, 'Miércoles', '19:00:00', '22:00:00', '2', 45, NULL),
(117, 70, 71, 9, 'Miércoles', '19:00:00', '22:00:00', '4', 18, NULL),
(118, 95, 71, 15, 'Miércoles', '08:00:00', '11:00:00', '8', 18, NULL),
(119, 96, 72, 21, 'Miércoles', '18:00:00', '22:00:00', '1', 45, NULL),
(120, 87, 76, 11, 'Miércoles', '18:00:00', '22:00:00', '1', 20, NULL),
(121, 77, 77, 27, 'Miércoles', '18:00:00', '22:00:00', '3', 50, NULL),
(122, 3, 2, 7, 'Jueves', '14:00:00', '18:00:00', '1', 25, NULL),
(123, 5, 4, 7, 'Jueves', '08:00:00', '12:00:00', '1', 25, NULL),
(124, 6, 4, 6, 'Jueves', '08:00:00', '12:00:00', '3', 20, NULL),
(125, 7, 5, 9, 'Jueves', '08:00:00', '12:00:00', '2', 20, NULL),
(126, 8, 5, 11, 'Jueves', '08:00:00', '12:00:00', '4', 20, NULL),
(127, 15, 7, 6, 'Jueves', '14:00:00', '18:00:00', '2', 20, NULL),
(128, 17, 7, 9, 'Jueves', '14:00:00', '18:00:00', '4', 20, NULL),
(129, 16, 7, 15, 'Jueves', '08:00:00', '14:00:00', '5', 20, NULL),
(130, 13, 7, 13, 'Jueves', '08:00:00', '10:00:00', '6', 20, NULL),
(131, 16, 7, 13, 'Jueves', '10:00:00', '14:00:00', '6', 20, NULL),
(132, 22, 15, 10, 'Jueves', '08:00:00', '13:00:00', '1', 25, NULL),
(133, 20, 16, 12, 'Jueves', '08:00:00', '12:00:00', '1', 25, NULL),
(134, 24, 16, 17, 'Jueves', '08:00:00', '12:00:00', '3', 25, NULL),
(135, 25, 17, 10, 'Jueves', '14:00:00', '17:00:00', '2', 25, NULL),
(136, 32, 22, 27, 'Jueves', '14:00:00', '18:00:00', '1', 50, NULL),
(137, 36, 23, 20, 'Jueves', '14:00:00', '18:00:00', '3', 45, NULL),
(138, 45, 28, 4, 'Jueves', '08:00:00', '10:00:00', '1', 40, NULL),
(139, 32, 32, 5, 'Jueves', '08:00:00', '10:00:00', '1', 40, NULL),
(140, 35, 32, 8, 'Jueves', '08:00:00', '10:00:00', '2', 40, NULL),
(141, 52, 36, 4, 'Jueves', '14:00:00', '16:00:00', '1', 40, NULL),
(142, 54, 38, 4, 'Jueves', '18:00:00', '20:00:00', '3', 40, NULL),
(143, 55, 38, 20, 'Jueves', '18:00:00', '20:00:00', '4', 45, NULL),
(144, 57, 41, 21, 'Jueves', '14:00:00', '16:00:00', '3', 45, NULL),
(145, 61, 41, 21, 'Jueves', '18:00:00', '20:00:00', '4', 45, NULL),
(146, 63, 43, 12, 'Jueves', '14:00:00', '18:00:00', '1', 30, NULL),
(147, 60, 49, 23, 'Jueves', '17:00:00', '19:00:00', '2', 45, NULL),
(148, 73, 50, 25, 'Jueves', '18:00:00', '22:00:00', '1', 45, NULL),
(149, 74, 50, 26, 'Jueves', '18:00:00', '22:00:00', '2', 45, NULL),
(150, 75, 51, 23, 'Jueves', '14:00:00', '16:00:00', '2', 45, NULL),
(151, 77, 52, 5, 'Jueves', '19:00:00', '22:00:00', '2', 40, NULL),
(152, 77, 52, 5, 'Jueves', '14:00:00', '17:00:00', '4', 40, NULL),
(153, 79, 54, 7, 'Jueves', '19:00:00', '22:00:00', '11', 13, NULL),
(154, 65, 59, 17, 'Jueves', '14:00:00', '18:00:00', '1', 35, NULL),
(155, 86, 59, 9, 'Jueves', '18:00:00', '22:00:00', '3', 30, NULL),
(156, 87, 60, 6, 'Jueves', '20:00:00', '22:00:00', '1', 20, NULL),
(157, 22, 63, 11, 'Jueves', '14:00:00', '17:00:00', '3', 18, NULL),
(158, 26, 63, 11, 'Jueves', '19:00:00', '22:00:00', '6', 18, NULL),
(159, 72, 63, 15, 'Jueves', '19:00:00', '22:00:00', '8', 18, NULL),
(160, 92, 69, 8, 'Jueves', '17:00:00', '22:00:00', '1', 40, NULL),
(161, 71, 71, 1, 'Jueves', '19:00:00', '22:00:00', '7', 18, NULL),
(162, 47, 75, 13, 'Jueves', '18:00:00', '22:00:00', '1', 20, NULL),
(163, 23, 77, 27, 'Jueves', '18:00:00', '22:00:00', '2', 50, NULL),
(164, 99, 79, 16, 'Jueves', '16:00:00', '20:00:00', '1', 40, NULL),
(165, 2, 1, 7, 'Viernes', '14:00:00', '18:00:00', '1', 25, NULL),
(166, 4, 3, 7, 'Viernes', '08:00:00', '11:00:00', '1', 25, NULL),
(167, 4, 3, 7, 'Viernes', '11:00:00', '14:00:00', '2', 25, NULL),
(168, 9, 5, 6, 'Viernes', '08:00:00', '12:00:00', '5', 20, NULL),
(169, 7, 5, 9, 'Viernes', '08:00:00', '12:00:00', '6', 20, NULL),
(170, 11, 6, 6, 'Viernes', '14:00:00', '17:00:00', '5', 20, NULL),
(171, 7, 6, 9, 'Viernes', '14:00:00', '17:00:00', '6', 20, NULL),
(172, 13, 7, 10, 'Viernes', '08:00:00', '10:00:00', '1', 25, NULL),
(173, 16, 7, 11, 'Viernes', '08:00:00', '10:00:00', '3', 20, NULL),
(174, 12, 10, 10, 'Viernes', '14:00:00', '17:00:00', '1', 25, NULL),
(175, 9, 10, 11, 'Viernes', '14:00:00', '17:00:00', '3', 20, NULL),
(176, 25, 17, 13, 'Viernes', '14:00:00', '17:00:00', '1', 25, NULL),
(177, 28, 20, 20, 'Viernes', '14:00:00', '16:00:00', '1', 45, NULL),
(178, 30, 20, 4, 'Viernes', '08:00:00', '12:00:00', '4', 40, NULL),
(179, 37, 23, 21, 'Viernes', '14:00:00', '16:00:00', '4', 45, NULL),
(180, 38, 24, 27, 'Viernes', '08:00:00', '13:00:00', '1', 50, NULL),
(181, 27, 29, 23, 'Viernes', '14:00:00', '17:00:00', '1', 45, NULL),
(182, 47, 29, 25, 'Viernes', '14:00:00', '17:00:00', '2', 45, NULL),
(183, 34, 34, 5, 'Viernes', '08:00:00', '11:00:00', '2', 40, NULL),
(184, 52, 36, 4, 'Viernes', '14:00:00', '16:00:00', '2', 40, NULL),
(185, 57, 40, 20, 'Viernes', '08:00:00', '10:00:00', '1', 45, NULL),
(186, 59, 40, 21, 'Viernes', '08:00:00', '10:00:00', '3', 45, NULL),
(187, 10, 42, 26, 'Viernes', '18:00:00', '22:00:00', '1', 45, NULL),
(188, 10, 42, 26, 'Viernes', '14:00:00', '18:00:00', '2', 45, NULL),
(189, 63, 43, 12, 'Viernes', '14:00:00', '18:00:00', '4', 30, NULL),
(190, 32, 45, 5, 'Viernes', '14:00:00', '16:00:00', '1', 40, NULL),
(191, 67, 45, 4, 'Viernes', '18:00:00', '20:00:00', '2', 40, NULL),
(192, 79, 53, 5, 'Viernes', '17:00:00', '22:00:00', '2', 40, NULL),
(193, 46, 54, 6, 'Viernes', '17:00:00', '20:00:00', '1', 13, NULL),
(194, 84, 56, 8, 'Viernes', '19:00:00', '22:00:00', '3', 40, NULL),
(195, 85, 57, 16, 'Viernes', '17:00:00', '22:00:00', '2', 40, NULL),
(196, 55, 57, 19, 'Viernes', '17:00:00', '22:00:00', '4', 40, NULL),
(197, 54, 61, 20, 'Viernes', '18:00:00', '20:00:00', '2', 45, NULL),
(198, 88, 61, 21, 'Viernes', '18:00:00', '20:00:00', '3', 45, NULL),
(199, 47, 68, 22, 'Viernes', '18:00:00', '20:00:00', '1', 40, NULL),
(200, 27, 71, 7, 'Viernes', '18:00:00', '21:00:00', '2', 18, NULL),
(201, 96, 72, 23, 'Viernes', '18:00:00', '22:00:00', '2', 45, NULL),
(202, 86, 72, 25, 'Viernes', '18:00:00', '22:00:00', '3', 45, NULL),
(203, 60, 73, 15, 'Viernes', '14:00:00', '16:00:00', '1', 20, NULL),
(204, 68, 74, 15, 'Viernes', '16:00:00', '16:00:00', '1', 30, NULL),
(205, 40, 25, 23, 'Viernes', '08:00:00', '13:00:00', '3', 45, NULL),
(206, 6, 6, 7, 'Sábado', '08:00:00', '11:00:00', '1', 25, NULL),
(207, 11, 6, 6, 'Sábado', '08:00:00', '11:00:00', '3', 20, NULL),
(208, 39, 24, 4, 'Sábado', '08:00:00', '13:00:00', '4', 40, NULL),
(209, 37, 39, 20, 'Sábado', '08:00:00', '10:00:00', '1', 45, NULL),
(210, 56, 39, 21, 'Sábado', '08:00:00', '10:00:00', '2', 45, NULL),
(211, 59, 40, 23, 'Sábado', '08:00:00', '10:00:00', '4', 45, NULL),
(212, 64, 44, 20, 'Sábado', '14:00:00', '16:00:00', '3', 45, NULL),
(213, 66, 44, 3, 'Sábado', '14:00:00', '16:00:00', '4', 55, NULL),
(214, 69, 47, 25, 'Sábado', '08:00:00', '10:00:00', '2', 45, NULL),
(215, 64, 63, 9, 'Sábado', '08:00:00', '11:00:00', '2', 18, NULL),
(216, 89, 74, 10, 'Sábado', '08:00:00', '14:00:00', '2', 30, NULL),
(217, 4, 74, 11, 'Sábado', '08:00:00', '14:00:00', '4', 30, NULL),
(218, 67, 77, 2, 'Sábado', '08:00:00', '10:00:00', '1', 60, NULL),
(219, 66, 78, 5, 'Sábado', '08:00:00', '10:00:00', '1', 40, NULL),
(220, 100, 83, 1, 'Lunes', '08:00:00', '10:00:00', '1', 37, NULL),
(221, 83, 83, 15, 'Lunes', '14:00:00', '17:00:00', '2', 10, NULL),
(222, 33, 83, 6, 'Lunes', '08:00:00', '10:00:00', '3', 10, NULL),
(223, 101, 83, 11, 'Lunes', '08:00:00', '10:00:00', '4', 10, NULL),
(224, 102, 84, 8, 'Lunes', '13:00:00', '16:00:00', '2', 40, NULL),
(225, 70, 85, 13, 'Lunes', '18:00:00', '22:00:00', '1', 15, NULL),
(226, 103, 86, 8, 'Lunes', '18:00:00', '20:00:00', '1', 40, NULL),
(227, 104, 86, 24, 'Lunes', '18:00:00', '20:00:00', '2', 40, NULL),
(228, 105, 88, 25, 'Lunes', '18:00:00', '20:00:00', '1', 40, NULL),
(229, 90, 89, 27, 'Martes', '14:00:00', '18:00:00', '3', 50, NULL),
(230, 51, 89, 27, 'Martes', '08:00:00', '00:00:00', '4', 50, NULL),
(231, 102, 90, 8, 'Martes', '08:00:00', '10:00:00', '1', 37, NULL),
(232, 94, 91, 22, 'Martes', '13:00:00', '18:00:00', '1', 40, NULL),
(233, 61, 91, 24, 'Martes', '13:00:00', '18:00:00', '3', 40, NULL),
(234, 107, 92, 24, 'Martes', '18:00:00', '20:00:00', '1', 40, NULL),
(235, 103, 92, 25, 'Martes', '14:00:00', '16:00:00', '2', 40, NULL),
(236, 95, 92, 26, 'Martes', '14:00:00', '16:00:00', '3', 40, NULL),
(237, 103, 93, 25, 'Martes', '18:00:00', '20:00:00', '1', 40, NULL),
(238, 108, 93, 2, 'Martes', '18:00:00', '22:00:00', '2', 60, NULL),
(239, 109, 89, 10, 'Miércoles', '14:00:00', '18:00:00', '1', 15, NULL),
(240, 109, 89, 13, 'Miércoles', '08:00:00', '12:00:00', '2', 15, NULL),
(241, 102, 94, 17, 'Miércoles', '08:00:00', '11:00:00', '1', 10, NULL),
(242, 110, 95, 16, 'Miércoles', '18:00:00', '20:00:00', '1', 40, NULL),
(243, 104, 95, 19, 'Miércoles', '18:00:00', '20:00:00', '2', 40, NULL),
(244, 92, 95, 22, 'Miércoles', '18:00:00', '22:00:00', '3', 40, NULL),
(245, 38, 96, 16, 'Miércoles', '14:00:00', '18:00:00', '1', 40, NULL),
(246, 111, 96, 19, 'Miércoles', '14:00:00', '16:00:00', '2', 40, NULL),
(248, 112, 97, 24, 'Miércoles', '18:00:00', '22:00:00', '1', 40, NULL),
(249, 113, 97, 16, 'Miércoles', '20:00:00', '22:00:00', '2', 40, NULL),
(250, 81, 98, 17, 'Miércoles', '14:00:00', '17:00:00', '1', 15, NULL),
(251, 114, 98, 1, 'Miércoles', '14:00:00', '17:00:00', '2', 20, NULL),
(252, 109, 99, 10, 'Miércoles', '18:00:00', '20:00:00', '1', 15, NULL),
(253, 109, 99, 10, 'Miércoles', '20:00:00', '22:00:00', '1', 15, NULL),
(254, 107, 100, 17, 'Miércoles', '19:00:00', '22:00:00', '1', 20, NULL),
(255, 115, 100, 1, 'Miércoles', '19:00:00', '22:00:00', '2', 20, NULL),
(256, 108, 100, 25, 'Miércoles', '19:00:00', '22:00:00', '3', 20, NULL),
(257, 10, 100, 23, 'Miércoles', '19:00:00', '22:00:00', '4', 20, NULL),
(258, 25, 100, 26, 'Miércoles', '19:00:00', '22:00:00', '5', 10, NULL),
(259, 95, 100, 12, 'Miércoles', '08:00:00', '11:00:00', '7', 5, NULL),
(260, 116, 88, 2, 'Miércoles', '08:00:00', '12:00:00', '2', 60, NULL),
(261, 117, 101, 19, 'Jueves', '13:00:00', '17:00:00', '1', 40, NULL),
(262, 34, 103, 1, 'Jueves', '08:00:00', '11:00:00', '1', 30, NULL),
(263, 117, 107, 19, 'Jueves', '18:00:00', '22:00:00', '2', 40, NULL),
(264, 114, 104, 22, 'Jueves', '13:00:00', '18:00:00', '1', 37, NULL),
(265, 118, 105, 22, 'Jueves', '18:00:00', '20:00:00', '1', 40, NULL),
(266, 119, 105, 2, 'Jueves', '18:00:00', '20:00:00', '2', 60, NULL),
(267, 70, 100, 10, 'Jueves', '19:00:00', '22:00:00', '6', 5, NULL),
(268, 108, 106, 14, 'Jueves', '18:00:00', '22:00:00', '1', 60, NULL),
(269, 104, 106, 24, 'Jueves', '18:00:00', '20:00:00', '2', 38, NULL),
(270, 120, 108, 1, 'Viernes', '08:00:00', '12:00:00', '2', 10, NULL),
(271, 121, 108, 17, 'Viernes', '13:00:00', '17:00:00', '3', 10, NULL),
(272, 120, 108, 1, 'Viernes', '13:00:00', '17:00:00', '4', 10, NULL),
(273, 119, 109, 24, 'Viernes', '18:00:00', '20:00:00', '3', 40, NULL),
(274, 115, 110, 27, 'Viernes', '18:00:00', '20:00:00', '1', 40, NULL),
(275, 110, 110, 29, 'Viernes', '18:00:00', '20:00:00', '2', 40, NULL),
(276, 105, 111, 8, 'Viernes', '14:00:00', '16:00:00', '1', 40, NULL),
(277, 111, 112, 16, 'Viernes', '14:00:00', '16:00:00', '1', 40, NULL),
(278, 118, 113, 15, 'Sábado', '08:00:00', '11:00:00', '1', 10, NULL),
(279, 10, 113, 12, 'Sábado', '08:00:00', '11:00:00', '2', 10, NULL),
(280, 122, 84, 4, 'Sábado', '17:00:00', '22:00:00', '1', 40, NULL),
(281, 94, 91, 8, 'Sábado', '08:00:00', '13:00:00', '2', 40, NULL),
(282, 123, 107, 17, 'Sábado', '13:00:00', '15:00:00', '1', 35, NULL),
(284, 113, 97, 16, 'Sábado', '08:00:00', '10:00:00', '1', 40, NULL),
(285, 122, 117, 24, 'Sábado', '08:00:00', '14:00:00', '1', 40, NULL),
(286, 115, 117, 22, 'Sábado', '08:00:00', '14:00:00', '2', 40, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aulas`
--

CREATE TABLE `aulas` (
  `Id_Aula` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Capacidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `aulas`
--

INSERT INTO `aulas` (`Id_Aula`, `Nombre`, `Capacidad`) VALUES
(1, '101', 37),
(2, '102', 60),
(3, '103', 59),
(4, '105', 40),
(5, '106', 40),
(6, '107', 26),
(7, '108', 25),
(8, '109', 40),
(9, '201', 30),
(10, '202', 30),
(11, '203', 30),
(12, '204', 30),
(13, '205', 30),
(14, '209', 60),
(15, '210', 30),
(16, '211', 40),
(17, '212', 35),
(18, 'magna', 75),
(19, 'NP-101', 40),
(20, 'NP-102', 45),
(21, 'NP-103', 45),
(22, 'NP-105', 40),
(23, 'NP-106', 45),
(24, 'NP-107', 44),
(25, 'NP-108', 45),
(26, 'NP-109', 49),
(27, 'NP-201', 53),
(28, 'NP-203', 60),
(29, 'NP-205', 53);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `Id_Curso` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Ciclo` int(11) NOT NULL,
  `Id_Escuela` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`Id_Curso`, `Nombre`, `Ciclo`, `Id_Escuela`) VALUES
(1, '(2023) (2018) CÁLCULO I', 1, 1),
(2, '(2023) (2018) ÁLGEBRA Y GEOMETRÍA ANALÍTICA', 1, 1),
(3, '(2023) (2018) PROGRAMACIÓN Y COMPUTACIÓN', 1, 1),
(4, '(2023) (2018) REDACCIÓN Y TÉCNICAS DE COMUNICACIÓN EFECTIVA II', 2, 1),
(5, '(2023) (2018) INVESTIGACIÓN FORMATIVA', 2, 1),
(6, '(2023) (2018) REALIDAD NACIONAL Y MUNDIAL', 2, 1),
(7, '(2023) (2018) CÁLCULO II', 2, 1),
(8, '(2023) (2018) FÍSICA I', 2, 1),
(9, '(2023) (2018) QUÍMICA GENERAL', 2, 1),
(10, '(2023) (2018) INTRODUCCIÓN A LAS CIENCIAS E INGENIERÍA', 2, 1),
(11, '(2023)(2018) EMPRENDIMIENTO E INNOVACIÓN ', 2, 1),
(12, '(2023) INTRODUCCION A LA COMPUTACION', 3, 1),
(13, '(2023) SERIES Y ECUACIONES DIFERENCIALES  (2018) ', 3, 1),
(14, '(2023) ELECTROMAGNETISMO Y OPTICA', 3, 1),
(15, '(2018) PROGRAMACION Y FUNDAMENTOS DE ALGORITMICA ', 3, 1),
(16, '(2023) PROGRAMACION DE COMPUTADORAS I ', 3, 1),
(17, '(2023) FUNDAMENTOS DE SISTEMAS DE INFORMACION (2018) TEORÍA GENERAL DE SISTEMAS ', 3, 1),
(18, '(2023) MATEMATICAS DISCRETAS (2018) MATEMATICAS DISCRETAS', 3, 1),
(19, '(2018) ORGANIZACIÓN Y ADMINISTRACIÓN', 3, 1),
(20, '(2023) ORGANIZACION EMPRESARIAL  ', 4, 1),
(21, ' (2018) ALGORÍTMICA Y PROGRAMACIÓN ORIENTADA A OBJETOS', 4, 1),
(22, '(2023) PROGRAMACION DE COMPUTADORAS II ', 4, 1),
(23, '(2023) METODOS NUMERICOS (2018) MÉTODOS NUMÉRICOS', 4, 1),
(24, '(2023) (2018)ARQUITECTURA DE COMPUTADORAS', 5, 1),
(25, '(2023) ESTADISTICA I (2018) ESTADÍSTICA', 4, 1),
(26, '(2023) (2018) INGENIER. ECONOMICA', 3, 1),
(27, '(2018) FÍSICA ELECTRÓNICA Y SISTEMAS DIGITALES ', 4, 1),
(28, '(2018) PROCESOS DE NEGOCIOS ', 4, 1),
(29, '(2018) MARKETING ', 4, 1),
(30, '(2018) PROBABILIDADES Y MUESTREO ', 4, 1),
(31, '(2018)  CONTABILIDAD GENERAL', 4, 1),
(32, '(2018) DISEÑO Y ANÁLISIS DE ALGORITMOS ', 5, 1),
(33, '(2018) ANÁLISIS DE SISTEMAS DE INFORMACIÓN ', 5, 1),
(34, '(2018) BASE DE DATOS ', 5, 1),
(35, '(2018) ESTRUCTURA DE DATOS  ', 5, 1),
(36, '(2018) LENGUAJES Y COMPILADORES ', 5, 1),
(37, '(2018) MODELOS Y SIMULACIÓN ', 5, 1),
(38, '(2018) BIG DATA', 6, 1),
(39, '(2018) COMPUTACIÓN VISUAL ', 6, 1),
(40, '(2018) SISTEMAS OPERATIVOS ', 6, 1),
(41, '(2018) DISEÑO DE SISTEMAS DE INFORMACIÓN ', 6, 1),
(42, '(2018)FINANZAS PARA LA GESTIÓN ', 6, 1),
(43, '(2018) INVESTIGACION OPERATIVA', 6, 1),
(44, '(2018) REDES, TRANSMISIÓN Y AUTOMATIZACIÓN Y CONTROL ', 6, 1),
(45, '(2018) INTERACCIÓN HOMBRE COMPUTADOR', 7, 1),
(46, '(2018) PROGRAMACIÓN PARALELA ', 7, 1),
(47, '(2018) INTELIGENCIA DE NEGOCIOS ', 7, 1),
(48, '(2018) INTELIGENCIA ARTIFICIAL ', 7, 1),
(49, '(2018) DESARROLLO DE SISTEMAS WEB', 7, 1),
(50, '(2018) FORMULACIÓN Y EVALUACIÓN DE PROYECTOS  ', 7, 1),
(51, '(2018) INTERNET DE LAS COSAS', 7, 1),
(52, '(2018) GESTIÓN DE PROYECTOS DE TECNOLOGÍAS DE LA INFORMACIÓN ', 8, 1),
(53, '(2018) INGENIERÍA DE INFORMACIÓN  ', 8, 1),
(54, '(2018) METODOLOGÍA DE LA ELABORACIÓN DE TESIS', 8, 1),
(55, '(2014) TALLER DE CONSTRUCCIÓN DE SISTEMAS', 8, 1),
(56, '(2018)SISTEMAS DISTRIBUIDOS', 8, 1),
(57, '(2018) DESARROLLO DE SISTEMAS MÓVILES', 8, 1),
(58, '(2018) SISTEMAS INTELIGENTES ', 8, 1),
(59, '(2018) AUDITORÍA Y SEGURIDAD DE TECNOLOGÍAS DE INFORMACIÓN', 8, 1),
(60, '(2014) SISTEMAS DISTRIBUIDOS ', 9, 1),
(61, '(2018) MINERÍA DE DATOS', 9, 1),
(62, '(2014) AUDITORÍA Y CONTROL DE TECNOLOGÍA DE INFORMÁTICA', 9, 1),
(63, '(2018) DESARROLLO DE PROYECTO DE DE TESISI I  (2014) DESARROLLO DE TESIS I ', 9, 1),
(64, '(2014) CALIDAD Y PRUEBA DE SOFTWARE', 9, 1),
(65, '(2018) TENDENCIAS EN SISTEMAS DE INFORMACIÓN / (2014) TENDENCIAS EN SISTEMAS DE INFORMACIÓN', 10, 1),
(66, '(2018) TALLER DE APLICACIONES DISTRIBUIDAS / (2014) DESARROLLO DE APLICACIONES DISTRIBUIDAS', 10, 1),
(67, '(2018) (2014) ARQUITECTURA EMPRESARIAL', 9, 1),
(68, '(2018) ÉTICA Y DERECHO INFORMÁTICO / (2014) DERECHO INFORMÁTICO', 9, 1),
(69, '(2018) INNOVACION, CAMBIO ORGANIZACIONAL Y EMPRENDIMIENTO', 9, 1),
(70, '(2018)GERENCIA INFORMATICA (2014)  GERENCIA INFORMÁTICA', 10, 1),
(71, '(2018) DESARROLLO DE PROYECTO DE TESIS II (2014) DESARROLLO DE TESIS II ', 10, 1),
(72, '(2018)PLANEAMIENTO DE RECURSOS EMPRESARIALES ', 10, 1),
(73, '(2014) INGENIERÍA WEB ', 10, 1),
(74, '(2018)  PRACTICA PREPROFESIONAL', 10, 1),
(75, '(2014) SISTEMAS EMPRESARIALES', 10, 1),
(76, '(2014) INTEGRACIÓN DE SISTEMAS', 10, 1),
(77, '(2018) GESTION DEL CONOCIMIENTO ', 10, 1),
(78, '(2014) INGENIERÍA DE CONTROL', 8, 1),
(79, '(2014) REDES NEURONALES', 8, 1),
(80, '(2014) APLICACIÓN DE ARQUITECTURA EMPRESARIAL', 8, 1),
(81, '(2014) ORATORIA I', 8, 1),
(82, '(2014) ORATORIA II', 8, 1),
(83, 'ALGORÍTMICA II', 4, 2),
(84, 'BASE DE DATOS I', 6, 2),
(85, 'INTELIGENCIA ARTIFICIAL', 7, 2),
(86, 'INTELIGENCIA DE NEGOCIOS', 8, 2),
(87, 'VERIFICACIÓN Y VALIDACIÓN DE SOFTWARE', 8, 2),
(88, 'TENDENCIAS DE ARQUITECTURA DE SOFTWARE', 10, 2),
(89, 'MATEMÁTICA DISCRETA', 4, 2),
(90, 'PROCESOS DE SOFTWARE', 4, 2),
(91, 'DISEÑO DE SOFTWARE', 6, 2),
(92, 'MINERÍA DE DATOS', 8, 2),
(93, 'ANALÍTICA DE DATOS', 10, 2),
(94, 'ESTRUCTURA DE DATOS', 5, 2),
(95, 'ASEGURAMIENTO DE LA CALIDAD DEL SOFTWARE', 6, 2),
(96, 'SISTEMAS OPERATIVOS', 6, 2),
(97, 'AUTOMATIZACIÓN Y CONTROL DE SOFTWARE', 8, 2),
(98, 'METODOLOGÍA DE LA INVESTIGACIÓN', 8, 2),
(99, 'DESARROLLO DE TESIS I', 9, 2),
(100, 'DESARROLLO DE TESIS II', 10, 2),
(101, 'INNOVACIÓN, TECNOLOGÍA Y EMPRENDIMIENTO', 4, 2),
(102, 'PROBABILIDADES', 4, 2),
(103, 'ANÁLISIS Y DISEÑO DE ALGORITMOS', 5, 2),
(104, 'GESTIÓN DE LA CONFIGURACIÓN DEL SOFTWARE', 6, 2),
(105, 'PROGRAMACIÓN CONCURRENTE Y PARALELA', 8, 2),
(106, 'TENDENCIAS EN INGENIERÍA DE SOFTWARE Y GESTIÓN', 10, 2),
(107, 'FORMACIÓN DE EMPRESAS DE SOFTWARE', 6, 2),
(108, 'CONTABILIDAD PARA LA GESTIÓN', 4, 2),
(109, 'INTERACCIÓN HOMBRE COMPUTADOR', 6, 2),
(110, 'SEGURIDAD DEL SOFTWARE', 8, 2),
(111, 'TALLER DE CONSTRUCCIÓN DE SOFTWARE WEB', 8, 2),
(112, 'TALLER DE APLICACIONES SOCIALES', 10, 2),
(113, 'SISTEMAS DIGITALES', 4, 2),
(116, 'REDES Y TRANSMISIÓN DE DATOS', 7, 2),
(117, 'PRÁCTICA PRE PROFESIONAL', 10, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `Id_Docente` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`Id_Docente`, `Nombre`) VALUES
(1, 'DURAN QUIÑONES SOFIA'),
(2, 'ACHALLMA PARIONA FELIX'),
(3, 'MENDOZA QUISPE WILFREDO'),
(4, 'RUIZ RIVERA MARÍA ELENA'),
(5, 'RIOS DELGADO JHOANNA'),
(6, 'DIONICIO MEJIA CARMEN'),
(7, 'FERNANDEZ ORTIZ JACQUELIN LIZETH'),
(8, 'COLCA GARCÍA HEDDY LILIANA'),
(9, 'INGA ALVA ALEXANDER'),
(10, 'AGUILAR CORONEL JHONATAN'),
(11, 'ORELLANA MANRIQUE YOLANDA OLIVIA'),
(12, 'VALDERRAMA CAMPOS OMAR BORIS'),
(13, 'CARRERA BARRANTES VICTOR'),
(14, 'LUNA VALDEZ JUAN'),
(15, 'COLLANTEZ SANCHEZ FRANK'),
(16, 'CARHUAMACA TICSE GREGORIO'),
(17, 'LLERENA LUCERO TEODORO'),
(18, 'COSME FELIX MIRIAM MILAGROS'),
(19, 'LOPEZ CORDOVA FRIDA MEREYDA  '),
(20, 'ROMERO NAUPARI, PABLO JESUS'),
(21, 'FLORES CRUZ JESUS RULE'),
(22, 'CABRERA DÍAZ, JAVIER ELMER'),
(23, 'VERA POMALAZA, VIRGINIA'),
(24, 'DAMASO RIOS MARIA ROSA'),
(25, 'PRÓ CONCEPCIÓN, LUZMILA ELISA'),
(26, 'QUINTO PAZCE, DANIEL ALFONSO'),
(27, 'ANGULO CALDERÓN, CÉSAR AUGUSTO'),
(28, 'ALCÁNTARA LOAYZA, CÉSAR  AUGUSTO '),
(29, 'HUAYNA DUEÑAS, ANA MARÍA '),
(30, 'ESCOBEDO BAILÓN, FRANK EDMUNDO'),
(32, 'ESPINOZA DOMÍNGUEZ, ROBERT ELÍAS'),
(33, 'SALINAS AZAÑA, GILBERTO ANIBAL'),
(34, 'CHAVEZ SOTO, JORGE LUIS'),
(35, 'GUERRA GRADOS, LUIS ANGEL'),
(36, 'TRUJILLO TREJO, JOHN LEDGARD'),
(37, 'AVENDAÑO QUIROZ, JOHNNY ROBERT '),
(38, 'PARIONA QUISPE, JAIME RUBEN'),
(39, 'CONTRERAS FLORES, WALTER PEDRO'),
(40, 'HUAROTO'),
(41, 'CARDENAS YACTAYO URCISINIO'),
(42, 'REATEGUI SANCHEZ LLEYNI'),
(43, 'CHUMACERO CALLE JOSE ANTONIO'),
(44, 'FERMÍN PÉREZ, FÉLIX ARMANDO'),
(45, 'RIVAS PEÑA, MARCOS HERNAN'),
(46, 'LUZA MONTERO, CÉSAR'),
(47, 'CAMARA FIGUEROA, ADEGUNDO MARIO'),
(48, 'TORRES RODRIGUEZ AGUSTINA'),
(49, 'SOTO SOTO, LUIS'),
(50, 'DEL PINO RODRÍGUEZ, LUZ  CORINA'),
(51, 'CORTEZ VÁSQUEZ, AUGUSTO PARCEMON'),
(52, 'RUIZ DE LA CRUZ MELO, CARLOS AUGUSTO'),
(53, 'PUELLES BULNES, MARIA ELIZABETH'),
(54, 'ROMÁN CONCHA, NORBERTO ULISES'),
(55, 'USCUCHAGUA FLORES  GELBERT'),
(56, 'CUBAS  BECERRE RICHARD'),
(57, 'CORAL YGNACIO, MARCO ANTONIO'),
(58, 'BUSTAMANTE OLIVERA, VÍCTOR HUGO'),
(59, 'DÍAZ MUÑANTE, JORGE RAUL '),
(60, 'ESPINOZA ROBLES, ARMANDO DAVID'),
(61, 'MUÑOZ CASILDO, NEHIL INDALICIO'),
(62, 'LAMA MORE MANUEL'),
(63, 'VALVERDE AYALA GIOVANA MELVA'),
(64, 'GONZALES SUÁREZ, JUAN CARLOS'),
(65, 'CARRASCO ORÉ, NILO ELOY'),
(66, ' ARMAS CALDERON, RAUL MARCELO'),
(67, 'VALCARCEL ASCENCIOS, SERGIO PAULO'),
(68, 'ALARCÓN LOAYZA, LUIS ALBERTO'),
(69, 'ENRIQUEZ MAGUIÑA, WILLIAM MARTIN'),
(70, 'MAURICIO SÁNCHEZ, DAVID SANTOS'),
(71, 'VEGA HUERTA, HUGO FROILAN'),
(72, 'LA SERNA PALOMINO, NORA BERTHA'),
(73, 'LÓPEZ VILLANUEVA, PABLO EDWIN'),
(74, 'CORONADO MESTANZA ALBERTO'),
(75, 'GUERRA GUERRA, JORGE LEONCIO'),
(76, 'LEON FERNANDEZ, CAYO VICTOR'),
(77, 'OSORIO BELTRAN, NORBERTO ANTONIO'),
(78, 'PIEDRA ISUSQUI, JOSÉ CESAR '),
(79, 'QUIÑONES NIETO, YAMIL ALEXANDER '),
(80, 'ANDRADE MOGOLLON, TEODORO MANUEL'),
(81, 'GAMBOA CRUZADO, JAVIER ARTURO'),
(82, 'DELGADILLO AVILA DE MAURICIO, ROSA SUMACTIKA'),
(83, 'LAM, ZHING FONG'),
(84, 'GIL CALVO, RUBÉN ALEXANDER'),
(85, 'MAMANI RODRÍGUEZ, ZORAIDA EMPERATRIZ'),
(86, 'MOLINA NEYRA, CÉSAR ALBERTO'),
(87, 'MAC DOWALL REYNOSO, ERWIN'),
(88, 'LEZAMA GONZALES, PEDRO MARTIN'),
(89, 'PANTOJA COLLANTES, Jorge Santiago '),
(90, 'MOQUILLAZA HENRÍQUEZ, SANTIAGO DOMINGO'),
(91, 'GUZMAN MONTEZA, YUDI LUCERO'),
(92, 'SOBERO RODRÍGUEZ, FANY YEXENIA'),
(93, 'SOTELO BEDÓN, ADOLFO MARCOS'),
(94, 'MENÉNDEZ MUERAS ROSA'),
(95, 'HERRERA QUISPE JOSE'),
(96, 'GALINDO HUAYLLANI, JOSÉ LUIS'),
(98, 'DE LA CRUZ VÉLEZ DE VILLA, PERCY EDWIN'),
(99, 'MAGUIÑA PÉREZ, ROLANDO ALBERTO'),
(100, 'TAPIA CARBAJAL, JUAN RICARDO'),
(101, 'ZAVALETA CAMPOS, JORGE LUIS'),
(102, 'ARREDONDO   CASTILLO, GUSTAVO'),
(103, 'GAMARRA  MORENO, JUAN'),
(104, 'BARTRA  MORE, ARTURO ALEJANDRO'),
(105, 'CORDERO   SÁNCHEZ, HUGO RAFAEL'),
(107, 'CALDERON   VILCA, HUGO DAVID'),
(108, 'MACHADO  VICENTE, JOEL FERNANDO'),
(109, 'RODRÍGUEZ  RODRÍGUEZ , CIRO'),
(110, 'HUAPAYA  CHUMPITAZ, MARIO AGUSTÍN'),
(111, 'TICONA ZEGARRA, EDSON ARIEL'),
(112, 'ROSAS CUEVA, YESSICA'),
(113, 'TUPAC VALDIVIA, YVAN JESUS'),
(114, 'WONG  PORTILLO , LENIS ROSSI'),
(115, 'UGAZ  CACHAY , WINSTON IGNACIO'),
(116, 'CANCHO   RODRÍGUEZ, ERNESTO DAVID'),
(117, 'BAYONA   ORÉ, LUZ SUSSY'),
(118, 'PRUDENCIO   VIDAL, JAVIER ANTONIO'),
(119, 'PETRLIK AZABACHE, IVAN CARLO'),
(120, 'MERCADO PHILCO, FAUSTO FRANKLIN'),
(121, 'ASENCIOS ESPINOZA, ENCARNACIÓN MALECIO'),
(122, 'MURAKAMI  DE LA CRUZ , SUMIKO ELIZABETH'),
(123, 'CHÁVEZ  HERRERA , CARLOS ERNESTO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escuelas`
--

CREATE TABLE `escuelas` (
  `Id_Escuela` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `escuelas`
--

INSERT INTO `escuelas` (`Id_Escuela`, `Nombre`) VALUES
(1, 'EPIS'),
(2, 'EPISW');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_dictado`
--

CREATE TABLE `tipo_dictado` (
  `id_tipo_dictado` int(11) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_dictado`
--

INSERT INTO `tipo_dictado` (`id_tipo_dictado`, `tipo`) VALUES
(1, 'Teoría'),
(2, 'Práctica');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD PRIMARY KEY (`Id_Asignacion`),
  ADD KEY `Id_Docente` (`Id_Docente`),
  ADD KEY `Id_Curso` (`Id_Curso`),
  ADD KEY `Id_Aula` (`Id_Aula`);

--
-- Indices de la tabla `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`Id_Aula`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`Id_Curso`),
  ADD KEY `Id_Escuela` (`Id_Escuela`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`Id_Docente`);

--
-- Indices de la tabla `escuelas`
--
ALTER TABLE `escuelas`
  ADD PRIMARY KEY (`Id_Escuela`);

--
-- Indices de la tabla `tipo_dictado`
--
ALTER TABLE `tipo_dictado`
  ADD PRIMARY KEY (`id_tipo_dictado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  MODIFY `Id_Asignacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=287;

--
-- AUTO_INCREMENT de la tabla `aulas`
--
ALTER TABLE `aulas`
  MODIFY `Id_Aula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `Id_Curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `Id_Docente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT de la tabla `escuelas`
--
ALTER TABLE `escuelas`
  MODIFY `Id_Escuela` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD CONSTRAINT `asignaciones_ibfk_1` FOREIGN KEY (`Id_Docente`) REFERENCES `docentes` (`Id_Docente`),
  ADD CONSTRAINT `asignaciones_ibfk_2` FOREIGN KEY (`Id_Curso`) REFERENCES `cursos` (`Id_Curso`),
  ADD CONSTRAINT `asignaciones_ibfk_3` FOREIGN KEY (`Id_Aula`) REFERENCES `aulas` (`Id_Aula`);

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_ibfk_1` FOREIGN KEY (`Id_Escuela`) REFERENCES `escuelas` (`Id_Escuela`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
