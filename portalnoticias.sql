-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-05-2024 a las 19:56:46
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
-- Base de datos: `portalnoticias`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `finalizar_noticias` ()   BEGIN
    DECLARE done INT DEFAULT FALSE;
    DECLARE ultima_noticia INT;
    DECLARE ultima_fecha DATE;
    
    DECLARE cur CURSOR FOR SELECT ID, fecha FROM noticias WHERE estado != 'finalizada';
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
    
    OPEN cur;
    read_loop: LOOP
        FETCH cur INTO ultima_noticia, ultima_fecha;
        IF done THEN
            LEAVE read_loop;
        END IF;
        
        -- Verificar si la fecha de la noticia es hace más de 1 mes
        IF ultima_fecha < DATE_SUB(NOW(), INTERVAL 1 MONTH) THEN
            -- Crear una nueva fila en historial con el estado 'finalizada'
            INSERT INTO historial (IDnoticia,  titulo, descripcion, fecha, estado, IDcategoria, urlImagen, activo, fechaFin, IDuser, fechaCambio)
            SELECT ID, titulo, descripcion, fecha, 'finalizada', IDcategoria, urlImagen, activo, fechaFin, 1, NOW()
            FROM noticias
            WHERE ID = ultima_noticia;

            -- Actualizar el estado de la noticia correspondiente en la tabla noticias a 'finalizada'
            UPDATE noticias SET estado = 'finalizada' WHERE ID = ultima_noticia;
        END IF;
    END LOOP;
    CLOSE cur;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procesar_historial` ()   BEGIN
    DECLARE done INT DEFAULT FALSE;
    DECLARE ultima_noticia INT;
    DECLARE ultimo_cambio INT;
    DECLARE ultimo_estado VARCHAR(50);
    DECLARE fecha_cambio DATE;

    DECLARE cur CURSOR FOR SELECT DISTINCT IDnoticia FROM historial;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
    
    OPEN cur;
    read_loop: LOOP
        FETCH cur INTO ultima_noticia;
        IF done THEN
            LEAVE read_loop;
        END IF;
        
        -- Obtener los datos de la última fila de historial para la noticia actual
        SELECT IDnoticia, numCambio, estado, fechaCambio INTO ultima_noticia, ultimo_cambio, ultimo_estado, fecha_cambio
        FROM historial
        WHERE IDnoticia = ultima_noticia
        ORDER BY numCambio DESC
        LIMIT 1;

        -- Verificar si el estado es 'validar' y la fecha de cambio es hace más de 5 días
        IF ultimo_estado = 'validar' AND fecha_cambio < DATE_SUB(NOW(), INTERVAL 5 DAY) THEN
            -- Crear una nueva fila en historial con el mismo contenido pero con el estado 'publicada'
            INSERT INTO historial (IDnoticia, titulo, descripcion, fecha, estado, IDcategoria, urlImagen, activo, fechaFin, IDuser, fechaCambio)
            SELECT IDnoticia, titulo, descripcion, fecha, 'publicada', IDcategoria, urlImagen, activo, fechaFin, 1, NOW()
            FROM historial
            WHERE IDnoticia = ultima_noticia AND numCambio = ultimo_cambio;

            -- Actualizar el estado de la noticia correspondiente en la tabla noticias a 'publicada'
            UPDATE noticias SET estado = 'publicada' WHERE ID = ultima_noticia;
        END IF;
    END LOOP;
    CLOSE cur;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `ID` int(11) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`ID`, `nombre`, `descripcion`) VALUES
(1, 'Organizacionales', NULL),
(2, 'Eventos', NULL),
(3, 'Reconocimientos', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `IDnoticia` int(11) NOT NULL,
  `numCambio` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha` date NOT NULL,
  `estado` varchar(50) NOT NULL,
  `IDcategoria` int(11) NOT NULL,
  `urlImagen` varchar(255) DEFAULT NULL,
  `activo` bit(1) NOT NULL,
  `fechaFin` datetime NOT NULL,
  `IDuser` int(11) NOT NULL,
  `fechaCambio` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`IDnoticia`, `numCambio`, `titulo`, `descripcion`, `fecha`, `estado`, `IDcategoria`, `urlImagen`, `activo`, `fechaFin`, `IDuser`, `fechaCambio`) VALUES
(48, 1, 'Nuevo Programa de Capacitación para el Desarrollo Profesional', 'Nos complace anunciar el lanzamiento de nuestro nuevo Programa de Capacitación para el Desarrollo Profesional, diseñado para fomentar el crecimiento y desarrollo de todos nuestros empleados. Este programa incluirá talleres de habilidades blandas, cursos técnicos y sesiones de mentoría individual. Invitamos a todos los interesados a inscribirse a través del portal de empleados antes del 1 de junio. ¡Aprovecha esta oportunidad para crecer y avanzar en tu carrera profesional!', '2024-05-17', 'validar', 1, '/uploads/imagenesNoticias/1715967141_c3a6fdd4dc3acd5b37bc.png', b'1', '2024-06-17 14:32:21', 5, '2024-05-17'),
(48, 2, 'Nuevo Programa de Capacitación para el Desarrollo Profesional', 'Nos complace anunciar el lanzamiento de nuestro nuevo Programa de Capacitación para el Desarrollo Profesional, diseñado para fomentar el crecimiento y desarrollo de todos nuestros empleados. Este programa incluirá talleres de habilidades blandas, cursos técnicos y sesiones de mentoría individual. Invitamos a todos los interesados a inscribirse a través del portal de empleados antes del 1 de junio. ¡Aprovecha esta oportunidad para crecer y avanzar en tu carrera profesional!', '2024-05-17', 'publicada', 1, '/uploads/imagenesNoticias/1715967141_c3a6fdd4dc3acd5b37bc.png', b'1', '2024-06-17 14:32:21', 5, '2024-05-17'),
(49, 1, 'Actualización de la Política de Trabajo Remoto', 'En respuesta a los comentarios de nuestros empleados y las tendencias globales, hemos actualizado nuestra política de trabajo remoto. A partir del 1 de julio, los empleados tendrán la opción de trabajar desde casa hasta tres días a la semana. Esta actualización busca ofrecer mayor flexibilidad y mejorar el equilibrio entre la vida laboral y personal. Para más detalles sobre cómo esto puede afectar a tu equipo y las normas específicas, por favor consulta la nueva política en la intranet.', '2024-05-17', 'validar', 1, '/uploads/imagenesNoticias/1715967165_78c96a549849d7a6419a.jpg', b'1', '2024-06-17 14:32:45', 5, '2024-05-17'),
(49, 2, 'Actualización de la Política de Trabajo Remoto', 'En respuesta a los comentarios de nuestros empleados y las tendencias globales, hemos actualizado nuestra política de trabajo remoto. A partir del 1 de julio, los empleados tendrán la opción de trabajar desde casa hasta tres días a la semana. Esta actualización busca ofrecer mayor flexibilidad y mejorar el equilibrio entre la vida laboral y personal. Para más detalles sobre cómo esto puede afectar a tu equipo y las normas específicas, por favor consulta la nueva política en la intranet.', '2024-05-17', 'publicada', 1, '/uploads/imagenesNoticias/1715967165_78c96a549849d7a6419a.jpg', b'1', '2024-06-17 14:32:45', 5, '2024-05-17'),
(50, 1, 'Celebración del Aniversario de la Empresa con Evento Especial', 'Este año, nuestra empresa celebra su 25º aniversario y queremos conmemorar esta ocasión especial con un evento único para todos nuestros empleados. El evento se llevará a cabo el 15 de agosto en el salón principal de nuestro edificio corporativo y contará con actividades de equipo, discursos de los fundadores y una cena de gala. Es una excelente oportunidad para celebrar nuestros logros y fortalecer los lazos entre todos los miembros de nuestra comunidad. ¡No te lo pierdas!', '2024-05-17', 'validar', 2, '/uploads/imagenesNoticias/1715967192_e57841d58877f0d3b3e7.jpg', b'1', '2024-06-17 14:33:12', 5, '2024-05-17'),
(50, 2, 'Celebración del Aniversario de la Empresa con Evento Especial', 'Este año, nuestra empresa celebra su 25º aniversario y queremos conmemorar esta ocasión especial con un evento único para todos nuestros empleados. El evento se llevará a cabo el 15 de agosto en el salón principal de nuestro edificio corporativo y contará con actividades de equipo, discursos de los fundadores y una cena de gala. Es una excelente oportunidad para celebrar nuestros logros y fortalecer los lazos entre todos los miembros de nuestra comunidad. ¡No te lo pierdas!', '2024-05-17', 'publicada', 2, '/uploads/imagenesNoticias/1715967192_e57841d58877f0d3b3e7.jpg', b'1', '2024-06-17 14:33:12', 5, '2024-05-17');

--
-- Disparadores `historial`
--
DELIMITER $$
CREATE TRIGGER `before_insert_HistorialCambios` BEFORE INSERT ON `historial` FOR EACH ROW BEGIN
    DECLARE maxNumeroCambio INT;
    SELECT MAX(numCambio) INTO maxNumeroCambio FROM Historial WHERE IDnoticia = NEW.IDnoticia;
    IF maxNumeroCambio IS NULL THEN
        SET NEW.numCambio = 1;
    ELSE
        SET NEW.numCambio = maxNumeroCambio + 1;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `ID` int(11) NOT NULL,
  `IDusuario` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha` date NOT NULL DEFAULT curdate(),
  `estado` varchar(50) NOT NULL DEFAULT 'borrador',
  `IDcategoria` int(11) NOT NULL,
  `urlImagen` varchar(255) DEFAULT NULL,
  `activo` bit(1) NOT NULL DEFAULT b'0',
  `fechaFin` datetime NOT NULL,
  `retroceder` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`ID`, `IDusuario`, `titulo`, `descripcion`, `fecha`, `estado`, `IDcategoria`, `urlImagen`, `activo`, `fechaFin`, `retroceder`) VALUES
(48, 5, 'Nuevo Programa de Capacitación para el Desarrollo Profesional', 'Nos complace anunciar el lanzamiento de nuestro nuevo Programa de Capacitación para el Desarrollo Profesional, diseñado para fomentar el crecimiento y desarrollo de todos nuestros empleados. Este programa incluirá talleres de habilidades blandas, cursos técnicos y sesiones de mentoría individual. Invitamos a todos los interesados a inscribirse a través del portal de empleados antes del 1 de junio. ¡Aprovecha esta oportunidad para crecer y avanzar en tu carrera profesional!', '2024-05-17', 'publicada', 1, '/uploads/imagenesNoticias/1715967141_c3a6fdd4dc3acd5b37bc.png', b'1', '2024-06-17 14:32:21', 1),
(49, 5, 'Actualización de la Política de Trabajo Remoto', 'En respuesta a los comentarios de nuestros empleados y las tendencias globales, hemos actualizado nuestra política de trabajo remoto. A partir del 1 de julio, los empleados tendrán la opción de trabajar desde casa hasta tres días a la semana. Esta actualización busca ofrecer mayor flexibilidad y mejorar el equilibrio entre la vida laboral y personal. Para más detalles sobre cómo esto puede afectar a tu equipo y las normas específicas, por favor consulta la nueva política en la intranet.', '2024-05-17', 'publicada', 1, '/uploads/imagenesNoticias/1715967165_78c96a549849d7a6419a.jpg', b'1', '2024-06-17 14:32:45', 1),
(50, 5, 'Celebración del Aniversario de la Empresa con Evento Especial', 'Este año, nuestra empresa celebra su 25º aniversario y queremos conmemorar esta ocasión especial con un evento único para todos nuestros empleados. El evento se llevará a cabo el 15 de agosto en el salón principal de nuestro edificio corporativo y contará con actividades de equipo, discursos de los fundadores y una cena de gala. Es una excelente oportunidad para celebrar nuestros logros y fortalecer los lazos entre todos los miembros de nuestra comunidad. ¡No te lo pierdas!', '2024-05-17', 'publicada', 2, '/uploads/imagenesNoticias/1715967192_e57841d58877f0d3b3e7.jpg', b'1', '2024-06-17 14:33:12', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rechazos`
--

CREATE TABLE `rechazos` (
  `ID` int(11) NOT NULL,
  `IDnoticia` int(11) NOT NULL,
  `motivo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `passw` varchar(255) NOT NULL,
  `email` varchar(60) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `rol` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `nickname`, `passw`, `email`, `fullname`, `rol`) VALUES
(1, 'Sistema', 'sistema', 'sistema@sistema.com', 'Sistema', 3),
(4, 'fulanito', '$2y$10$0Vw.0u5jLsL/DkrYWt.zNOcb.swbRx4sqepxkbCzBoPYwuoYHUJKC', 'fulanito@hotmail.com', 'Fulanito Fulanoso', 1),
(5, 'fulanito2', '$2y$10$weiy4sMJuE6n0tUgfWfUCu3DbpoImphNLCDnwCYtiXTkkPnoQ2GLG', 'fulanito2@gmail.com', 'fulanito fulanoso', 3),
(7, 'fulanito3', '$2y$10$5ob39Pze8DF/z487ZEC4o.58uTYRhpgr5RZUfzTKdmZ.xbj9UDSUW', 'fulanito3@gmail.com', 'Fulanito Fulanoso', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`IDnoticia`,`numCambio`),
  ADD KEY `IDcategoria` (`IDcategoria`),
  ADD KEY `IDuser` (`IDuser`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDusuario` (`IDusuario`),
  ADD KEY `IDcategoria` (`IDcategoria`);

--
-- Indices de la tabla `rechazos`
--
ALTER TABLE `rechazos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDnoticia` (`IDnoticia`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `nickname` (`nickname`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `rechazos`
--
ALTER TABLE `rechazos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `historial_ibfk_1` FOREIGN KEY (`IDnoticia`) REFERENCES `noticias` (`ID`),
  ADD CONSTRAINT `historial_ibfk_2` FOREIGN KEY (`IDcategoria`) REFERENCES `categorias` (`ID`),
  ADD CONSTRAINT `historial_ibfk_3` FOREIGN KEY (`IDuser`) REFERENCES `usuarios` (`ID`);

--
-- Filtros para la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `noticias_ibfk_1` FOREIGN KEY (`IDusuario`) REFERENCES `usuarios` (`ID`),
  ADD CONSTRAINT `noticias_ibfk_2` FOREIGN KEY (`IDcategoria`) REFERENCES `categorias` (`ID`);

--
-- Filtros para la tabla `rechazos`
--
ALTER TABLE `rechazos`
  ADD CONSTRAINT `rechazos_ibfk_1` FOREIGN KEY (`IDnoticia`) REFERENCES `noticias` (`ID`);

DELIMITER $$
--
-- Eventos
--
CREATE DEFINER=`root`@`localhost` EVENT `procesar_historial_evento` ON SCHEDULE EVERY 1 HOUR STARTS '2024-05-16 09:39:57' ON COMPLETION NOT PRESERVE ENABLE DO CALL procesar_historial()$$

CREATE DEFINER=`root`@`localhost` EVENT `finalizar_noticias_evento` ON SCHEDULE EVERY 1 HOUR STARTS '2024-05-16 16:11:41' ON COMPLETION NOT PRESERVE ENABLE DO CALL finalizar_noticias()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
