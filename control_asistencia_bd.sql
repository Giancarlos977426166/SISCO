-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-05-2020 a las 09:15:44
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `control_asistencia_bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `idasistencia` int(11) NOT NULL,
  `dni` varchar(8) NOT NULL,
  `codigo_asistencia` varchar(8) NOT NULL,
  `fecha` date NOT NULL,
  `hora_entrada` time NOT NULL,
  `contEnt` tinyint(1) DEFAULT NULL,
  `hora_salida` time DEFAULT NULL,
  `contSal` tinyint(1) DEFAULT NULL,
  `controlador` char(1) NOT NULL,
  `turno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `idcargos` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `idDepartamento` int(11) NOT NULL,
  `fecha_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_create` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`idcargos`, `nombre`, `descripcion`, `idDepartamento`, `fecha_create`, `user_create`) VALUES
(1, 'ESPECIALISTA  RECURSOS HUMANOS', 'MDT', 1, '2020-05-21 02:24:51', '11111111'),
(2, 'JEFE DE AREA ADQUISICIONES', 'MDT', 1, '2020-05-21 02:28:28', '31181093'),
(3, 'JEFE DEL DEPARTAMENTO DE DESARROLLO HUMANO', 'MDT', 1, '2020-05-21 02:28:47', '31181093'),
(4, 'JEFE DE LA OFICINA DE PROGRAMACION MULTIANUAL DE INVERSIONES-OPMI', 'MDT', 1, '2020-05-21 02:34:14', '31181093'),
(5, 'GERENTE DE SEGURIDAD CIUDADANA, SERENAZGO Y POLICIA MUNICIPAL', 'MDT', 1, '2020-05-21 02:34:48', '31181093'),
(6, 'JEFE DEL DEPARTAMENTO DE DESARROLLO AMBIENTAL', 'MDT', 1, '2020-05-21 02:34:58', '31181093'),
(7, 'MESA DE PARTES', 'MDT', 1, '2020-05-21 02:35:15', '31181093'),
(8, 'SECRETARIO GENERAL', 'MDT', 1, '2020-05-21 02:35:41', '31181093'),
(9, 'RESP. DE DIVISION DE AREA TECNICA MUNICIPAL DE AGUA Y SANEAMIENTO-ATM', 'MDT', 1, '2020-05-21 02:35:49', '31181093'),
(10, 'JEFE DE DEPARTAMENTO DE ESTUDIOS Y PROYECTOS', 'MDT', 1, '2020-05-21 02:36:02', '31181093'),
(11, 'RESPONSABLE DE LA UNIDAD LOCAL DE EMPADRONAMIENTO (ULE) Y SISFOH', 'MDT', 1, '2020-05-21 02:36:12', '31181093'),
(12, 'JEFE DEL DEPARTAMENTO DE CAMAL MUNICIPAL', 'MDT', 1, '2020-05-21 02:36:25', '31181093'),
(13, 'RESPONSABLE DEL AREA DE ALMACEN', 'MDT', 1, '2020-05-21 02:36:34', '31181093'),
(14, 'RESPONSABLE DEL AREA DE RELACIONES PUBLICAS E IMAGEN INSTITUCIONAL', 'MDT', 1, '2020-05-21 02:36:43', '31181093'),
(15, 'OPERADOR DE EQUIPO MECANICO PESADO', 'MDT', 1, '2020-05-21 02:37:12', '31181093'),
(16, 'ASESOR LEGAL', 'MDT', 1, '2020-05-21 02:42:21', '31181093'),
(17, 'CHOFER DEL VEHICULO OFICIAL DE ALCALDIA', 'MDT', 1, '2020-05-21 02:42:31', '31181093'),
(18, 'JEFE DE LA OFICINA DE ADMINISTRACION TRIBUTARIA Y RENTAS', 'MDT', 1, '2020-05-21 02:44:49', '31181093'),
(19, 'GERENTE DE ADMINISTRACION Y FINANZAS', 'MDT', 1, '2020-05-21 02:42:50', '31181093'),
(20, 'GERENTE DE DESARROLLO SOSTENIBLE', 'MDT', 1, '2020-05-21 02:43:00', '31181093'),
(21, 'GERENTE DE INFRAESTRUCTURA,DESARROLLO URBANO  RURAL CATASTRO Y TRANSPORTE', 'MDT', 1, '2020-05-21 02:43:14', '31181093'),
(22, 'GERENTE DE SERVICIOS PUBLICOS', 'MDT', 1, '2020-05-21 02:43:25', '31181093'),
(23, 'GERENTE MUNICIPAL', 'MDT', 1, '2020-05-21 02:43:36', '31181093'),
(24, 'JEFE DE LA OFICINA DE  RECURSOS HUMANOS', 'MDT', 1, '2020-05-21 02:43:49', '31181093'),
(25, 'JEFE DE LA OFICINA DE CONTABILIDAD', 'MDT', 1, '2020-05-21 02:45:00', '31181093'),
(26, 'JEFE DE LA OFICINA DE LOGISTICA Y PATRIMONIO', 'MDT', 1, '2020-05-21 02:45:10', '31181093'),
(27, 'JEFE DE LA OFICINA DE TESORERIA', 'MDT', 1, '2020-05-21 02:45:23', '31181093'),
(28, 'JEFE DE OFICINA DE PLANEAMIENTO Y PRESUPUESTO', 'MDT', 1, '2020-05-21 02:45:35', '31181093'),
(29, 'JEFE DEL  DEPARTAMENTO DE DESARROLLO  URBANO RURAL ACONDICIONAMIENTO TERRITORIAL Y CATASTRO', 'MDT', 1, '2020-05-21 02:45:49', '31181093'),
(30, 'JEFE DEL DEPARTAMENTO DE DESARROLLO ECONOMICO', 'MDT', 1, '2020-05-21 02:46:09', '31181093'),
(31, 'JEFE DEL DEPARTAMENTO DE MAQUINARIA Y EQUIPO PESADO', 'MDT', 1, '2020-05-21 02:46:22', '31181093'),
(32, 'JEFE DEL DEPARTAMENTO DE PARQUES Y JARDINES', 'MDT', 1, '2020-05-21 02:46:33', '31181093'),
(33, 'JEFE DEL DEPARTAMENTO DE TRANSPORTE Y CIRCULACION  VIAL', 'MDT', 1, '2020-05-21 02:46:43', '31181093'),
(34, 'LIMPIEZA PUBLICA', 'MDT', 1, '2020-05-21 02:46:55', '31181093'),
(35, 'RESP.  DE LA DIVICION DE FISCALIZACION AMBIENTAL', 'MDT', 1, '2020-05-21 02:47:04', '31181093'),
(36, 'RESP. CEMENTERIO', 'MDT', 1, '2020-05-21 02:47:15', '31181093'),
(37, 'RESP. DE  ARCHIVO', 'MDT', 1, '2020-05-21 02:47:30', '31181093'),
(38, 'RESP. DE DIVISION DE GESTION DE RIESGOS Y DESASTRES', 'MDT', 1, '2020-05-21 02:47:39', '31181093'),
(39, 'RESP. DE DIVISIÓN DE PARTICIPACION CIUDADANA, EDUCACION, CULTURA, DEPORTE Y CIAM', 'MDT', 1, '2020-05-21 02:47:48', '31181093'),
(40, 'RESP. DE LA DIVISION DEL PROGRAMA ALIMENTARIO Y VASO DE LECHE', 'MDT', 1, '2020-05-21 02:47:58', '31181093'),
(41, 'RESP. VIGILANCIA SANITARIA - MERCADO MUNICIPAL', 'MDT', 1, '2020-05-21 02:48:07', '31181093'),
(42, 'RESPONSABLE DE CAJA', 'MDT', 1, '2020-05-21 02:48:18', '31181093'),
(43, 'RESPONSABLE DE LA GERENCIA DE PLANEAMIENTO Y PRESUPUESTO', 'MDT', 1, '2020-05-21 02:48:30', '31181093'),
(44, 'RESPONSABLE DEL COMEDOR MUNICIPAL', 'MDT', 1, '2020-05-21 02:48:39', '31181093'),
(45, 'SECRETARIA DE ALCALDIA', 'MDT', 1, '2020-05-21 02:48:49', '31181093'),
(46, 'SECRETARIA DE GERENCIA MUNICIPAL', 'MDT', 1, '2020-05-21 02:49:00', '31181093'),
(47, 'SERENAZGO', 'MDT', 1, '2020-05-21 02:49:11', '31181093'),
(48, 'SIAFISTA - CONTADOR', 'MDT', 1, '2020-05-21 02:49:21', '31181093'),
(49, 'CHOFER', 'MDT', 1, '2020-05-21 04:38:33', '31181093'),
(50, 'AREA DE RELACIONES PÚBLICAS', 'MDT', 1, '2020-05-21 04:38:57', '31181093'),
(51, 'TRABAJADOR DE SERVICIOS', 'MDT', 1, '2020-05-21 04:39:17', '31181093'),
(52, 'DIV. PROG. VASO DE LECHE', 'MDT', 1, '2020-05-21 04:39:40', '31181093'),
(53, 'TESORERIA Y FINANZAS', 'MDT', 1, '2020-05-21 04:40:01', '31181093'),
(54, 'POLICIA MUNICIPAL', 'MDT', 1, '2020-05-21 04:40:18', '31181093'),
(55, 'APOYO SERVICIO ATARSAC', 'MDT', 1, '2020-05-21 04:40:31', '31181093'),
(56, 'PERSONAL DE LIMPIEZA PUBLICA', 'MDT', 1, '2020-05-21 04:40:52', '31181093'),
(57, 'DEPARTAMENTO DE COMERCIO', 'MDT', 1, '2020-05-21 04:41:14', '31181093'),
(58, 'JEFE DE REGISTRO CIVIL', 'MDT', 1, '2020-05-21 04:41:34', '31181093'),
(59, 'ESPECIALISTA EN TRIBUTACION', 'MDT', 1, '2020-05-21 04:41:54', '31181093'),
(60, 'DEFENSORIA DEL NIÑO Y DEL ADOLESCENTE', 'MDT', 1, '2020-05-21 04:42:09', '31181093'),
(61, 'AUXILIAR SISTEMA ADMINISTRATIVO', 'MDT', 1, '2020-05-21 04:42:23', '31181093'),
(62, 'CAMAL MUNICIPAL', 'MDT', 1, '2020-05-21 04:43:10', '31181093'),
(63, 'OBRERO', 'MDT', 1, '2020-05-21 04:43:23', '31181093'),
(64, 'ADMINISTRATIVO', 'MDT', 1, '2020-05-21 04:43:42', '31181093'),
(65, 'CONDUCTOR DE MAQUINARIA PESADA', 'MDT', 1, '2020-05-21 04:43:53', '31181093'),
(66, 'PERSONAL DE LIMPIEZA (COMPACTADOR)', 'MDT', 1, '2020-05-21 04:44:27', '31181093');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunicados`
--

CREATE TABLE `comunicados` (
  `idcomunicados` int(11) NOT NULL,
  `idUsuariocomu` varchar(8) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `iddepartamento` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `fecha_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_create` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`iddepartamento`, `nombre`, `descripcion`, `fecha_create`, `user_create`) VALUES
(1, 'MUNICIPALIDAD DISTRITAL DE TALAVERA', 'MDT', '2020-05-21 01:52:55', '99999999');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugar_papeleta`
--

CREATE TABLE `lugar_papeleta` (
  `idlugares` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `fecha_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_create` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lugar_papeleta`
--

INSERT INTO `lugar_papeleta` (`idlugares`, `nombre`, `descripcion`, `fecha_create`, `user_create`) VALUES
(1, 'ANDAHUAYLAS', 'PROVINCIA DE ANDAHUAYLAS', '2020-05-21 05:06:53', '31181093');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivos_papeleta`
--

CREATE TABLE `motivos_papeleta` (
  `idmotivos` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `fecha_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_create` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `motivos_papeleta`
--

INSERT INTO `motivos_papeleta` (`idmotivos`, `nombre`, `descripcion`, `fecha_create`, `user_create`) VALUES
(1, 'COMISION DE SERVICIOS', 'Adscripción temporal de un funcionario a un puesto de trabajo vacante distinto del propio para subvenir a necesidades urgentes e inaplazables', '2020-05-21 05:12:14', '31181093'),
(2, 'PERMISO PARTICULAR', 'Permiso por motivos personales', '2020-05-21 05:13:07', '31181093'),
(3, 'PERMISO POR SALUD', 'Permiso por motivos de salud', '2020-05-21 05:13:40', '31181093');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `papeletas`
--

CREATE TABLE `papeletas` (
  `idpapeletas` int(11) NOT NULL,
  `idUsuario` varchar(8) NOT NULL,
  `idMotivo` int(11) NOT NULL,
  `idLugar` int(11) NOT NULL,
  `fecha_salida` date NOT NULL,
  `hora_salida` time NOT NULL,
  `fecha_retorno` date DEFAULT NULL,
  `hora_retorno` time DEFAULT NULL,
  `retorno` tinyint(1) NOT NULL,
  `fundamento` varchar(200) NOT NULL,
  `aprobado` tinyint(1) NOT NULL,
  `fecha_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

CREATE TABLE `tipousuario` (
  `idtipousuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `fecha_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_create` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`idtipousuario`, `nombre`, `descripcion`, `fecha_create`, `user_create`) VALUES
(1, 'Administrador', 'Usuario con todos los privilegios (RRHH)', '2020-05-21 02:03:21', '11111111'),
(2, 'Trabajador', 'Usuario con privilegios básicos', '2020-05-21 02:51:41', '31181093');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `idturnos` int(11) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `hora_entrada` time NOT NULL,
  `hora_salida` time NOT NULL,
  `tolerancia` time NOT NULL,
  `fecha_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_create` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`idturnos`, `nombre`, `descripcion`, `hora_entrada`, `hora_salida`, `tolerancia`, `fecha_create`, `user_create`) VALUES
(1, 'Turno Mañana', 'Turno Predeterminado de 8:00 a 13:00', '08:00:00', '13:00:00', '08:05:00', '2020-05-21 02:03:07', '11111111');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuarios` varchar(8) NOT NULL,
  `codigo_asistencia` varchar(8) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `apellido` varchar(80) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(64) NOT NULL,
  `imagen` varchar(50) NOT NULL DEFAULT 'default.jpg',
  `estado` tinyint(4) NOT NULL,
  `fecha_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_create` varchar(8) NOT NULL,
  `idTipousuario` int(11) NOT NULL,
  `idCargo` int(11) NOT NULL,
  `idTurno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuarios`, `codigo_asistencia`, `nombre`, `apellido`, `email`, `password`, `imagen`, `estado`, `fecha_create`, `user_create`, `idTipousuario`, `idCargo`, `idTurno`) VALUES
('10092174', '10092174', 'GUILLERMO VIDAL', 'OBREGON CAMPOS', '', 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855', '1590033975.jpg', 1, '2020-05-21 04:06:15', '31181093', 2, 3, 1),
('10308136', '10308136', 'EDWIN', 'FERNANDEZ MAÑUICO', '', 'eb4194e2e5bb8a3f8816781cba4fc1067e8ee6c75642ff49edeaf115c585a785', '1590032156.jpg', 1, '2020-05-21 03:35:55', '31181093', 2, 17, 1),
('20064824', '20064824', 'CLEVER', 'CHAMBERGO LOZANO', '', 'd3adddb247f403970f68feacd1a4ac625cbb5d6b53290533b3a60304406fa7d7', '1590032005.jpg', 1, '2020-05-21 03:33:25', '31181093', 2, 14, 1),
('23819634', '23819634', 'EDUARDO', 'QUISPE QUISPITUPA', '', '7e5d54de21556751285bf2627294683969b10023a81e4c9f5fecaf2d89118afb', '1590033392.jpg', 1, '2020-05-21 03:56:32', '31181093', 2, 19, 1),
('23852989', '23852989', 'DARWIN', 'ALTAMIRANO ALDAZABAL', '', 'aa4e57efc43e8807d8e1789b4009ca2e32cf32b7d8b3cbc2fd7585443ef1a587', '1590031487.jpg', 1, '2020-05-21 03:24:46', '31181093', 2, 5, 1),
('28294932', '28294932', 'EDGAR', 'PAUCAR CASTILLO', '', 'c16c8e112a28e750b95e949c6db9a4a853dc0f935fd44f17bbe3d228ccf4a0d7', '1590033101.jpg', 1, '2020-05-21 03:51:41', '31181093', 2, 20, 1),
('31001954', '31001954', 'WILDO', 'CAITUIRO AGRADA', '', '780f110a87fc2adf13009810d7da652da504c8977afbe121d216cb3f1d11386b', '1590031709.jpg', 1, '2020-05-21 03:28:28', '31181093', 2, 9, 1),
('31033082', '31033082', 'NATALIE', 'MARCA DURAND', '', 'c5144f39882dac47943ec0e442e21dbf70040ad094dcb4df60d565de9713107b', '1590036974.jpg', 1, '2020-05-21 04:56:14', '31181093', 2, 59, 1),
('31152782', '31152782', 'TEODOSIO', 'SALAZAR SEDANO', '', '687cec7597141561a431faecae6680de9da124435767fb358a5f5c4126266c5e', '1590037253.jpg', 1, '2020-05-21 05:00:52', '31181093', 2, 62, 1),
('31155261', '31155261', 'FLORENCIA', 'ROMERO CHOCCETAY', '', 'f50fce034a6bd766e8600412e34b52c0cee208c0ed49e38faa79660456f377ee', '1590037212.jpg', 1, '2020-05-21 05:00:11', '31181093', 2, 53, 1),
('31155743', '31155743', 'GREGORIO', 'VELASQUE AGUILA', '', 'c35ac51930db843b559a99f8c0fdc3196105b43d284bfb50bc7688344075a324', '1590037319.jpg', 1, '2020-05-21 05:01:59', '31181093', 2, 63, 1),
('31156642', '31156642', 'DONATO', 'GUTIERREZ CASTILLO', '', '92e204d5db471be2112c8eacee4a27084d8cfd8933b8d6f7e6083bc8a85862ea', '1590036742.jpg', 1, '2020-05-21 04:52:21', '31181093', 2, 56, 1),
('31157497', '31157497', 'CARLOS', 'GUTIERREZ GUTIERREZ', '', '51f3796b96a8d0ccfbdc5fd2c724126f434c3ba29b5101a65e660a9ff97ab5d4', '1590036779.jpg', 1, '2020-05-21 04:52:59', '31181093', 2, 57, 1),
('31157603', '31157603', 'DEMETRIO', 'LOPEZ RIVERA', '', '09ece2e253c29ccd662fc7fb37e3707f60060088b166a93e449b62e43b948baa', '1590036938.jpg', 1, '2020-05-21 04:55:38', '31181093', 2, 54, 1),
('31157840', '31157840', 'ALBINO', 'HUAMAN TELLO', '', '1f6d6c70d764ebb3fe71a66c20933ff2fc4b1517fb1199d53b86db90744c3056', '1590036817.jpg', 1, '2020-05-21 04:53:37', '31181093', 2, 56, 1),
('31158613', '31158613', 'ROBERTO', 'GUSMAN PERALTA', '', '3751e9addff70efb1e265217d73df8a636e7ed64f32d190aceee83713409702f', '1590037454.jpg', 1, '2020-05-21 05:04:13', '31181093', 2, 66, 1),
('31164183', '31164183', 'TEÓFILO', 'SALAZAR SERRANO', '', '83653293e49dbe4c3db1865139e55e5429dbc30d9b88447db5f25cb30b17e484', '1590037287.jpg', 1, '2020-05-21 05:01:26', '31181093', 2, 63, 1),
('31165550', '31165550', 'EPIFANIA', 'ORTEGA GUTIERREZ', '', 'de058f1be0421338176985bdfa8b8d5d2bdb59f387d7fa8ef22c623896a45a23', '1590037048.jpg', 1, '2020-05-21 04:57:28', '31181093', 2, 61, 1),
('31165551', '31165551', 'GAVINO', 'ALARCON RIVAS', '', 'cd600c4d2c2c242ec6c727539edf9af5914d25484b9c89a558a0579a0d2130d1', '1590036356.jpg', 1, '2020-05-21 04:45:55', '31181093', 2, 49, 1),
('31170863', '31170863', 'MARIO', 'CORDOVA CEVALLOS', '', '9e0b4b147895bb7bd2b8ae1c372fe4aa21c603c8a8b26f26152293c56a50fd0c', '1590032058.jpg', 1, '2020-05-21 03:34:18', '31181093', 2, 15, 1),
('31170943', '31170943', 'SILVERIO', 'PALOMINO MORALES', '', '82b2768dee34c9ccb7eeb916a497ecb67301701379947f3014aa69ff5afe9891', '1590037129.jpg', 1, '2020-05-21 04:58:49', '31181093', 2, 51, 1),
('31171382', '31171382', 'OSCAR', 'CARDENAS ANDIA', '', '462900d12296d9e1e0d78f02af83ca73ae26d172372e7c055de3f8aa93f3e1cb', '1590036616.jpg', 1, '2020-05-21 04:50:15', '31181093', 2, 54, 1),
('31171430', '31171430', 'SAMUEL', 'CENTENO ORTIZ', '', 'acf14996b6a620c86a4e6ad303b57da91fb1b4b4b5faf1e59e0684f510ee8e72', '1590031935.jpg', 1, '2020-05-21 03:32:15', '31181093', 2, 13, 1),
('31171719', '31171719', 'EDWIN', 'CABRERA ORIHUELA', '', '89fa1abb3dca499aec436f0ab5f8e4a2834ee91191540157a452b42136c2e974', '1590036579.jpg', 1, '2020-05-21 04:49:38', '31181093', 2, 53, 1),
('31172061', '31172061', 'EMILIANO ANGEL', 'BORDA CHIPANA', '', '85be181410c9309196c4cc9d3d01903b732bda33e6e424b49f63d838bec808a2', '1590036499.jpg', 1, '2020-05-21 04:48:18', '31181093', 2, 52, 1),
('31175077', '31175077', 'AMADEO', 'ORTEGA PEREZ', '', '166fcc70390573de0850614d80ab820c9db55e9f484c13553ea5b9584dfe66c2', '1590037082.jpg', 1, '2020-05-21 04:58:02', '31181093', 2, 54, 1),
('31175139', '31175139', 'JOSÉ ANTONIO', 'RAMÍREZ MENDOZA', '', '5220eca3c1a174194cf03055de426341af9bc294deea3c3980a8d402e9973baa', '1590037169.jpg', 1, '2020-05-21 04:59:28', '31181093', 2, 56, 1),
('31175221', '31175221', 'NELIDA', 'GUIZADO TELLO', '', '9c7f115d85d923d2ad359aad4d52ac2daadeeae974acdf6ce78b5e437951582a', '1590032350.jpg', 1, '2020-05-21 03:39:09', '31181093', 2, 44, 1),
('31175288', '31175288', 'EILBERTO', 'ENCISO HUARACA', '', 'a701a578f8b828fd0d5e0eb405bc04499e51581d07456239d170988ef08116e7', '1590037415.jpg', 1, '2020-05-21 05:03:34', '31181093', 2, 65, 1),
('31175487', '31175487', 'LAZARO', 'HUALLPAR ORTEGA', '', 'd7f5a898926c8d8812c8faca5ed3128f978918325357e4ccd4d917475fc4f046', '1590036857.jpg', 1, '2020-05-21 04:54:17', '31181093', 2, 56, 1),
('31178359', '31178359', 'GREGORIO', 'BERROCAL LASTRERA', '', '9e1faf409a5b7a8a0fd90f8a8ed527857778f564394ba7b0be893f269128e75a', '1590036452.jpg', 1, '2020-05-21 04:47:31', '31181093', 2, 51, 1),
('31180578', '31180578', 'YUVER MARCELINO', 'BORDA PAREDES', '', '615905f75dfe64fe470052e73c52cfa9f1d45a7d0ebe2cb061bc51ad7142fbe0', '1590031659.jpg', 1, '2020-05-21 03:27:39', '31181093', 2, 8, 1),
('31181093', '31181093', 'ENITH LISBETH', 'NAVARRO FLORES', 'enithlis@hotmail.com', '14b546a9359559c6f29d47ed084a48b58562441f1a4fe7d3ca53dce0355a1775', 'default.jpg', 1, '2020-05-21 03:17:49', '11111111', 1, 1, 1),
('31182125', '31182125', 'HERACLIO', 'QUISPE ALTAMIRANO', '', 'c5dfd5298e38141e0802e43b3317fa78c844a3205dc0196521e8b8e012169174', '1590033238.jpg', 1, '2020-05-21 03:53:58', '31181093', 2, 36, 1),
('31183099', '31183099', 'EULOGIA', 'LIZARME BERROCAL', '', '9e9cc01f68251cde100b1ae187b49ce397b15c10e7090f1e258fd655b069436e', '1590036896.jpg', 1, '2020-05-21 04:54:56', '31181093', 2, 58, 1),
('31183331', '31183331', 'WILLBER', 'LAGO SERNA', '', '45e555de6ab38c442e6f694f79e11968fd4ec90091dd31c6c1e2650fddd78b39', '1590037368.jpg', 1, '2020-05-21 05:02:48', '31181093', 2, 64, 1),
('31185349', '31185349', 'ABELARDO', 'FLORES ANAYA', '', '90e2140e22749b5a0a6fc3e6194cc5f2abbf447b07f0512b9296a4ff8ad76a4e', '1590036706.jpg', 1, '2020-05-21 04:51:46', '31181093', 2, 56, 1),
('31185395', '31185395', 'MAXIMILIANA', 'BARBARAN GALINDO', '', '592b6edc74f052b952b441fe5473ba2119659c2149ebabcefed673eabc829146', '1590036407.jpg', 1, '2020-05-21 04:46:47', '31181093', 2, 50, 1),
('31187867', '31187867', 'JOSE ALBERTO', 'CARDENAS GONZALES', '', '5c0f90776544b26d832c30bd75aea52190ecae502a946a606656cf2afa7a17a1', '1590036651.jpg', 1, '2020-05-21 04:50:50', '31181093', 2, 55, 1),
('31189278', '31189278', 'RONY BEQUEREL', 'MENDEZ SOTO', '', '70f38e407895f0af1a4d48c42720f398b6683b37bb91be497de587eb4dd64f89', '1590032686.jpg', 1, '2020-05-21 03:44:46', '31181093', 2, 16, 1),
('31192898', '31192898', 'VICTOR RAUL', 'QUISPE PALOMINO', '', '87a5e870077cf45f7a96bece536f5648af8d4e4a0d6b9465fde37c92786a0821', '1590033345.jpg', 1, '2020-05-21 03:55:44', '31181093', 2, 48, 1),
('31616499', '31616499', 'JULIO MANUEL', 'TAMARA MAUTINO', '', 'ded00c2e5036855047f9b30efae516c8d36bd2803fdf17cfb16563427ee10279', '', 1, '2020-05-21 04:05:15', '31181093', 1, 41, 1),
('40476775', '40476775', 'ROCIO', 'LEGUIA REYNAGA', '', '6ee721650fea49c066d5e4917fe386921575bf28a352a0c4fce0176d8c2b696b', '1590032489.jpg', 1, '2020-05-21 03:41:29', '31181093', 2, 39, 1),
('40670994', '40670994', 'CARLA ELENA', 'LOA RIVERA', '', 'caafd27ca11829204edb32f98bffba608c6f8d5b011852bbde60f364b5e629bc', '1590032529.jpg', 1, '2020-05-21 03:42:09', '31181093', 2, 46, 1),
('41169888', '41169888', 'ANTONIO YUNIOR', 'PALOMINO CAMPOS', '', '571068497ee560d5d1208a4393c1cae669adcc01e639bf11d13d4281a0799e51', '1590032941.jpg', 1, '2020-05-21 03:49:00', '31181093', 2, 35, 1),
('42250943', '42250943', 'VIRGILIO', 'PALOMINO MENDOZA', '', '9cfe31d047c462a9d93b64faddfb979a29b8b9d89f34810c5b37a595a74540c2', '1590033057.jpg', 1, '2020-05-21 03:50:57', '31181093', 2, 34, 1),
('42771978', '42771978', 'JOSE LUIS', 'GARCIA DIAZ', '', '7bccf06f5b6ff3604970643ebe980526ff4d15ab045115f968e5df3aa0312ba2', '1590032203.jpg', 1, '2020-05-21 03:36:42', '31181093', 2, 26, 1),
('42883587', '42883587', 'LUIS ALBERTO', 'VARGAS HUAMANTUMBA', '', '6c84142725ad395b3f33a91cbf4dd06ef5decff76de9e60ed021759b064e1495', '1590034011.jpg', 1, '2020-05-21 04:06:51', '31181093', 2, 21, 1),
('43018604', '43018604', 'RONALD ENRIQUE', 'QUINTANA ZUÑIGA', '', '74a1d5ce1f4052000536d56d7da4e6abe88f7d822479b80719aa656407d0ec8a', '1590033194.jpg', 1, '2020-05-21 03:53:13', '31181093', 2, 22, 1),
('43218444', '43218444', 'WILDER', 'VARGAS OLIVERA', '', 'bc23e51b77dceaf73597e26764da8302c670fc8aa1dc6d204bf810f7865a2285', '1590031757.jpg', 1, '2020-05-21 03:29:17', '31181093', 2, 10, 1),
('4323802', '4323802', 'JAVIER', 'SARAVIA ALANYA', '', '63cc2a16af6dac64068c556637467ae83d689ccdecd19d26b242f9c493ae5ec5', '1590031224.jpg', 1, '2020-05-21 04:02:47', '31181093', 1, 24, 1),
('43312684', '43312684', 'NICOLAS', 'ORTIZ MAUCAYLLE', '', '79f5db64acdef07b2ad7c475e73e290c372d590f4410d8e55ecaeecb2bc3f6fe', '1590032895.jpg', 1, '2020-05-21 03:48:15', '31181093', 2, 32, 1),
('43606785', '43606785', 'XAVIER ELIAS', 'LOPINTA LEON', '', '3b9d4bd2416607422b69946885698f17dbcb9786a2808525d05ebca2934b6a7a', '1590032596.jpg', 1, '2020-05-21 03:43:15', '31181093', 2, 29, 1),
('44005482', '44005482', 'CARINA', 'ROMERO MORENO', '', '1ba22dc5ee0eb84f91fb885d041e490b47c2cf18c2d298e3f9630251f3e1bff2', '1590033435.jpg', 1, '2020-05-21 03:57:15', '31181093', 2, 18, 1),
('44776801', '44776801', 'KARIN MARILU', 'BARRIENTOS DOMINGUEZ', '', '77134020f9ac7d57bc17420afd496da8fb66762e5551ca76624c840ad3dcc1c2', '1590031589.jpg', 1, '2020-05-21 03:26:28', '31181093', 2, 7, 1),
('44872985', '44872985', 'JHONATAN ANTONY', 'HUAMAN ROMANI', '', '34b8d192ebaca3bcf720d5257c4ee9a4ae042061c850956dd2b40bc534fd77ab', '1590032394.jpg', 1, '2020-05-21 03:39:53', '31181093', 2, 31, 1),
('45591663', '45591663', 'YOAN KATHERINE', 'ARESTEGUI FLORES', '', '8e577f141776fc35f6b19d9234771967e904cffbec62516fb8214c6e334d5f48', '1590031537.jpg', 1, '2020-05-21 03:25:37', '31181093', 2, 6, 1),
('45980492', '45980492', 'JAVIER', 'CCEÑUA ANCCO', '', 'aa11c36c337ff5f0e30d0385c3976cea9e72171e1bf44c6a311a8c0badee1857', '1590031860.jpg', 1, '2020-05-21 03:30:59', '31181093', 2, 12, 1),
('46711828', '46711828', 'YULISA', 'TALAVERANO CASAS', '', 'fbc8d138152f58fc09050e5a936f24579f64139b3751c40eeca65d64e501d446', '', 1, '2020-05-21 04:04:21', '31181093', 1, 37, 1),
('47387158', '47387158', 'YURY DACKARI', 'URRUTIA JIMENEZ', '', '7c1cbb9e15c5f4fef66a8846a84de6a90430641b57d7d335130a1299e3375719', '', 1, '2020-05-21 04:05:51', '31181093', 1, 43, 1),
('47588322', '47588322', 'FIORELA', 'PALOMINO CHOQUE', '', '54450545cf61646471c7b1f401282eb8748d59d7e76d46c3908004beac599185', '1590033003.jpg', 1, '2020-05-21 03:50:03', '31181093', 2, 45, 1),
('47724015', '47724015', 'CHRISTHIAN WUILY', 'CARDENAS LEGUIA', '', '97c34ae9423d356245c2e697bab2320693f725f4f973a7ce3693f49bc395b1ec', '1590031811.jpg', 1, '2020-05-21 03:30:10', '31181093', 2, 11, 1),
('47822385', '47822385', 'JOSE GABRIEL', 'GOMEZ CACERES', '', 'f0829e528ce06c53662afffdd3164b2d8e5f3af89f8b847aa5664d4f1756dce8', '1590032300.jpg', 1, '2020-05-21 03:38:19', '31181093', 2, 40, 1),
('48214776', '48214776', 'JOSELIN CRISTINA', 'SILVERA AMABLE', '', '70c712fb497d622c57f432c6dc70a906022d344fa066979b565ca23d93d8f919', '', 1, '2020-05-21 04:03:40', '31181093', 1, 42, 1),
('70220841', '70220841', 'MERCIA ASCHIRA', 'ORTIZ GALVAN', '', '0b5a6b22a6785777144c8982d39184d46d1bfdfdf2094b1154f926fc9e253147', '1590032844.jpg', 1, '2020-05-21 03:47:24', '31181093', 2, 38, 1),
('70378802', '70378802', 'HEIDI LAURA', 'ALARCON GARCIA', '', 'bc0ac8afdca4bdb5c694b5849327f1264839d57027a7422c02de9440afcb4386', 'default.jpg', 1, '2020-05-21 03:15:55', '31181093', 2, 2, 1),
('70402277', '70402277', 'JUAN MARIO', 'CORDOVA MIRANDA', '', '4bc14a0c1ed65505b934b9b7f9fa14fb067eada8ffb4556cf6796e63a7942914', '1590032104.jpg', 1, '2020-05-21 03:35:03', '31181093', 2, 15, 1),
('70662792', '70662792', 'EVELYN', 'MARCATOMA HERMOSA', '', 'adcf58584f827ecc3b951f50f14ca9fb972aa2ca159896f025aa68f35ec82a63', '1590032643.jpg', 1, '2020-05-21 03:44:02', '31181093', 2, 25, 1),
('71087727', '71087727', 'RAQUEL', 'GODOY RAMIREZ', '', '8a9dca9e2742a6c34b4390ae39bd151f5475a0c9308e1ea2a64b0b402170714a', '1590032254.jpg', 1, '2020-05-21 03:37:33', '31181093', 2, 28, 1),
('72260014', '72260014', 'FREDY', 'ALLCCA RUPAILLA', '', 'c7e11688afe230a68678323ad694cc151d1f86d90617919b735578dc373471d5', '1590031382.jpg', 1, '2020-05-21 03:23:02', '31181093', 2, 4, 1),
('75320169', '75320169', 'MELISSA', 'QUISPE AQUISE', '', '209f27afbac83180ed3c3e5c275868ab7fe5d7079f3a7be11278dfd86e1737b8', '1590033295.jpg', 1, '2020-05-21 03:54:54', '31181093', 2, 27, 1),
('80068315', '80068315', 'FRANCISCO', 'PORTILLO QUISPE', '', 'e2421e511e7c3ba56bada9defa5ae65faf51d2020b1e353051c8e7b118ae68de', '1590033152.jpg', 1, '2020-05-21 03:52:31', '31181093', 2, 30, 1),
('80084286', '80084286', 'ISMAEL GERARDO', 'JIMENEZ LAGO', '', 'f9f59a06c313b60b7ee7a46b2e81e57ebc49c44617d73624d37d24b71ac00f41', '1590032442.jpg', 1, '2020-05-21 03:40:42', '31181093', 2, 33, 1),
('80144952', '80144952', 'MAGDALENA', 'MORENO HUAMAN', '', '9e426bd59cace7c13ca45df788d4622ce04fa7ea25b5777dbe362ac58e580704', '1590037010.jpg', 1, '2020-05-21 04:56:49', '31181093', 2, 60, 1),
('9179396', '9179396', 'ALIBAR', 'SERRANO MUÑOZ', '', '8bec38b6f6ce1b34679ca722a25f149c30e4ebcaf805bfc0345f2848f5225c8c', '1590033533.jpg', 1, '2020-05-21 04:02:01', '31181093', 2, 23, 1),
('9349827', '9349827', 'MIGUEL ARZEDIO', 'CABEZAS FLORES', '', '6cf6a27068d8ac83cd417d52f3908b08ce36d652c735bbff4b57b14ab19aaa21', '1590036537.jpg', 1, '2020-05-21 04:48:57', '31181093', 2, 49, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`idasistencia`),
  ADD KEY `dni_idx` (`dni`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`idcargos`),
  ADD KEY `idDepartamento_idx` (`idDepartamento`);

--
-- Indices de la tabla `comunicados`
--
ALTER TABLE `comunicados`
  ADD PRIMARY KEY (`idcomunicados`),
  ADD KEY `idUsuario_idx` (`idUsuariocomu`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`iddepartamento`);

--
-- Indices de la tabla `lugar_papeleta`
--
ALTER TABLE `lugar_papeleta`
  ADD PRIMARY KEY (`idlugares`);

--
-- Indices de la tabla `motivos_papeleta`
--
ALTER TABLE `motivos_papeleta`
  ADD PRIMARY KEY (`idmotivos`);

--
-- Indices de la tabla `papeletas`
--
ALTER TABLE `papeletas`
  ADD PRIMARY KEY (`idpapeletas`),
  ADD KEY `idMotivo_idx` (`idMotivo`),
  ADD KEY `idUsuario_idx` (`idUsuario`),
  ADD KEY `idLugar_idx` (`idLugar`);

--
-- Indices de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  ADD PRIMARY KEY (`idtipousuario`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`idturnos`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuarios`),
  ADD KEY `idTipousuario_idx` (`idTipousuario`),
  ADD KEY `idCargo_idx` (`idCargo`),
  ADD KEY `idTurno_idx` (`idTurno`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `idasistencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `idcargos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de la tabla `comunicados`
--
ALTER TABLE `comunicados`
  MODIFY `idcomunicados` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `iddepartamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `lugar_papeleta`
--
ALTER TABLE `lugar_papeleta`
  MODIFY `idlugares` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `motivos_papeleta`
--
ALTER TABLE `motivos_papeleta`
  MODIFY `idmotivos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `papeletas`
--
ALTER TABLE `papeletas`
  MODIFY `idpapeletas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  MODIFY `idtipousuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `idturnos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `dni` FOREIGN KEY (`dni`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD CONSTRAINT `idDepartamento` FOREIGN KEY (`idDepartamento`) REFERENCES `departamento` (`iddepartamento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `comunicados`
--
ALTER TABLE `comunicados`
  ADD CONSTRAINT `idUsuariocomu` FOREIGN KEY (`idUsuariocomu`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `papeletas`
--
ALTER TABLE `papeletas`
  ADD CONSTRAINT `idLugar` FOREIGN KEY (`idLugar`) REFERENCES `lugar_papeleta` (`idlugares`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idMotivo` FOREIGN KEY (`idMotivo`) REFERENCES `motivos_papeleta` (`idmotivos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idUsuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `idCargo` FOREIGN KEY (`idCargo`) REFERENCES `cargos` (`idcargos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idTipousuario` FOREIGN KEY (`idTipousuario`) REFERENCES `tipousuario` (`idtipousuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idTurno` FOREIGN KEY (`idTurno`) REFERENCES `turnos` (`idturnos`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
