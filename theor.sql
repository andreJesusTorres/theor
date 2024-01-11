-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-01-2024 a las 15:29:00
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `theor`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `usuario` varchar(25) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `clave` varchar(25) NOT NULL,
  `admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`id`, `usuario`, `correo`, `clave`, `admin`) VALUES
(4, 'Ignacio Quiroga', 'ignacioq@gmail.com', '12345', 0),
(5, 'André Torres', 'andre.torres@outlook.com.ar', '12345', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `codigo` int(10) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `fechaAlta` date NOT NULL DEFAULT current_timestamp(),
  `nombre` varchar(255) NOT NULL,
  `precio` float NOT NULL,
  `cantidad` int(255) NOT NULL,
  `estado` int(11) NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`codigo`, `marca`, `fechaAlta`, `nombre`, `precio`, `cantidad`, `estado`, `imagen`) VALUES
(1, 'Wurth', '2023-06-16', 'Llave inglesa', 5, 4, 1, 'img/productos/wurth_llaveinglesa.png'),
(2, 'Bosch', '2023-06-16', 'Nivel laser', 100, 2, 1, 'img/productos/bosch-nivellaser.png'),
(3, 'Knipex', '2023-11-04', 'Alicates universales', 20, 7, 1, 'img/productos/knipex-alicate.png'),
(4, 'Dewalt', '2023-11-04', 'Sierra circular', 100, 1, 1, 'img/productos/dewalt-cierracircular.png'),
(5, 'Makita', '2023-11-10', 'Taladro percutor', 2.8, 2, 1, 'img/productos/makita-taladropercutor.png'),
(10, 'Bosch', '2023-11-15', 'Martillo', 10, 3, 1, 'img/productos/bosch-martillo.png'),
(11, 'Bosch', '2023-11-15', 'Lijadora excéntrica ', 50, 2, 1, 'img/productos/bosch-lijadora.png'),
(12, 'Stanley', '2023-11-15', 'Cinta métrica', 5, 6, 1, 'img/productos/stanley-cinta.png'),
(13, 'Irwin', '2023-11-16', 'Cizallas para chapa', 30, 2, 1, 'img/productos/irwin-cizalla.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`codigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `codigo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
