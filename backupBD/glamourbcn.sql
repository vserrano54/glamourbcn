-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-11-2024 a las 23:12:49
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
-- Base de datos: `glamourbcn`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favorito`
--

CREATE TABLE `favorito` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `servicio_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `favorito`
--

INSERT INTO `favorito` (`id`, `usuario_id`, `servicio_id`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id` int(11) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `duracion` int(11) NOT NULL,
  `dificultad` varchar(100) NOT NULL,
  `destacado` int(11) NOT NULL,
  `foto` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id`, `nombre`, `descripcion`, `duracion`, `dificultad`, `destacado`, `foto`) VALUES
(1, 'Manicura Clásica', 'Dale a tus manos el cuidado que merecen con nuestra manicura clásica, un tratamiento esencial que incluye limado, hidratación de cutículas y esmaltado en el color que elijas. Ideal para un look limpio y pulido que refleja tu estilo personal.', 45, 'media', 1, 'assets/img/foto1.jfif'),
(2, 'Pedicura Clásica', 'Disfruta de una pedicura completa que relaja y embellece tus pies. Nuestro servicio incluye exfoliación, masaje, cuidado de cutículas y esmaltado en el tono que prefieras, dejándote con unos pies suaves y perfectos para cualquier ocasión.', 40, 'media', 1, 'assets/img/foto2.jfif'),
(3, 'Manicura de Gel', 'Consigue uñas impecables y de larga duración con nuestra manicura en gel, que ofrece un acabado brillante y resistente al desgaste. Perfecta para quienes buscan color vibrante y durabilidad sin comprometer la elegancia.', 45, 'media', 1, 'assets/img/foto3.jfif'),
(4, 'Pedicura de Gel', 'Experimenta el confort de una pedicura duradera y brillante con nuestro servicio de gel. Mantén el color y la suavidad de tus pies por semanas, ideal para estilos de vida activos o para unas vacaciones sin preocupaciones.', 45, 'media', 1, 'assets/img/foto4.jfif'),
(5, 'Manicura y Pedicura Spa', 'Mima tus manos y pies con este lujoso tratamiento de spa que incluye exfoliación, mascarillas y masaje. Nuestro servicio Spa te dejará con una sensación de suavidad y bienestar, además de unas uñas impecables.', 60, 'media', 1, 'assets/img/foto5.jfif'),
(6, 'Diseño de Uñas Artísticas (Nail Art)', 'Expresa tu estilo con nuestros diseños personalizados de nail art, donde transformamos tus uñas en pequeñas obras de arte. Desde detalles minimalistas hasta creaciones elaboradas, damos vida a tus ideas con precisión y creatividad.', 45, 'media', 1, 'assets/img/foto6.jfif'),
(7, 'Extensiones de Uñas', 'Alarga y estiliza tus uñas con nuestras extensiones personalizadas. Utilizamos materiales de alta calidad para crear una apariencia natural y duradera, perfectas para una ocasión especial o para un look sofisticado diario.', 30, 'media', 1, 'assets/img/foto7.jfif'),
(8, 'Uñas Acrílicas', 'Disfruta de uñas resistentes y elegantes con nuestras uñas acrílicas. Diseñadas para adaptarse a tus gustos y estilo, las uñas acrílicas ofrecen la longitud y forma que prefieras, con un acabado pulido y duradero.', 45, 'media', 1, 'assets/img/foto8.jfif'),
(9, 'Reparación de Uñas', 'No dejes que una uña rota arruine tu look. Nuestro servicio de reparación de uñas restaura su apariencia y fuerza de forma rápida y discreta, para que vuelvas a lucir manos perfectas sin preocupaciones.', 40, 'media', 1, 'assets/img/foto9.jfif'),
(10, 'Esmaltado Semi Permanente', 'Disfruta de un color duradero y brillo intenso sin el compromiso del gel, con nuestro servicio de esmaltado semi permanente. Ideal para quienes buscan una opción resistente y de acabado natural que dure hasta dos semanas.', 55, 'media', 1, 'assets/img/foto10.jfif');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `edad` int(3) NOT NULL,
  `password` varchar(500) NOT NULL,
  `email` varchar(100) NOT NULL,
  `foto_perfil` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `edad`, `password`, `email`, `foto_perfil`) VALUES
(1, 'Alicia García', 25, '123456789', 'agarcia@gmail.com', 'assets/img/user1'),
(2, 'Emma Martines', 27, '123456789', 'emartinez@gmail.com', 'assets/img/user2');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `favorito`
--
ALTER TABLE `favorito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id_favorito` (`servicio_id`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `favorito`
--
ALTER TABLE `favorito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `favorito`
--
ALTER TABLE `favorito`
  ADD CONSTRAINT `sevicio_id_favorito` FOREIGN KEY (`servicio_id`) REFERENCES `servicio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuario_id_favorito` FOREIGN KEY (`servicio_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
