-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 03-07-2022 a las 01:27:15
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sifcoweb`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_precio_producto` (`n_cantidad` INT, `n_precio` DECIMAL(10,2), `codigo` INT)   BEGIN
    	DECLARE nueva_existencia int;
        DECLARE nuevo_total  decimal(10,2);
        DECLARE nuevo_precio decimal(10,2);
        
        DECLARE cant_actual int;
        DECLARE pre_actual decimal(10,2);
        
        DECLARE actual_existencia int;
        DECLARE actual_precio decimal(10,2);
                
        SELECT precio,cantidad INTO actual_precio,actual_existencia FROM producto WHERE codproducto = codigo;
        SET nueva_existencia = actual_existencia + n_cantidad;
        SET nuevo_total = (actual_existencia * actual_precio) + (n_cantidad * n_precio);
        SET nuevo_precio = nuevo_total / nueva_existencia;
        
        UPDATE producto SET cantidad = nueva_existencia, precio = nuevo_precio WHERE codproducto = codigo;
        
        SELECT nueva_existencia,nuevo_precio;
        
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_detalle_temp` (IN `codigo` INT, IN `cantidad` INT, IN `token_user` VARCHAR(50))   BEGIN
		DECLARE precio_actual decimal(10,2);
		SELECT precio INTO precio_actual FROM producto WHERE codproducto = codigo;
        
      	INSERT INTO detalle_temp(token_user, codproducto, cantidad, precio_venta) VALUES(token_user, codigo, cantidad, precio_actual);
    	
        SELECT tmp.correlativo,p.nombre,p.codproducto,p.descripcion,tmp.cantidad,tmp.precio_venta FROM detalle_temp tmp
        INNER JOIN producto p
        ON tmp.codproducto = p.codproducto
        WHERE tmp.token_user = token_user;
	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `del_detalle_temp` (IN `id_detalle` INT, IN `token` VARCHAR(50))   BEGIN
    	DELETE FROM detalle_temp WHERE correlativo = id_detalle;
        
        SELECT tmp.correlativo, tmp.codproducto, p.nombre, p.descripcion, tmp.cantidad,tmp.precio_venta FROM detalle_temp tmp
        INNER JOIN producto p
        ON tmp.codproducto = p.codproducto
        WHERE tmp.token_user = token;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procesar_venta` (`cod_usuario` INT, `cod_cliente` INT, `token` VARCHAR(50))   BEGIN
    	
        DECLARE factura INT;
        DECLARE registros INT;
        DECLARE total DECIMAL(10,2);
        DECLARE nueva_existencia int;
        DECLARE existencia_actual int;
        DECLARE tmp_cod_producto int;
        DECLARE tmp_cant_producto int;
        DECLARE a int;
        
        SET a = 1;
        
        CREATE TEMPORARY TABLE tbl_tmp_tokenuser (
            id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            cod_prod BIGINT,
            cant_prod INT);
            
        SET registros = (SELECT COUNT(*) FROM detalle_temp WHERE token_user = token);
        IF registros > 0 THEN
        	INSERT INTO tbl_tmp_tokenuser(cod_prod,cant_prod) SELECT codproducto,cantidad FROM detalle_temp WHERE 					token_user = token;
            
            INSERT INTO factura(usuario,codcliente) VALUES(cod_usuario,cod_cliente);
            SET factura = LAST_INSERT_ID();
            
            INSERT INTO detallefactura(nofactura,codproducto,cantidad,precio_venta) SELECT (factura) as nofactura, 				codproducto,cantidad,precio_venta FROM detalle_temp WHERE token_user = token;
            
            WHILE a <= registros DO
            
            	SELECT cod_prod, cant_prod INTO tmp_cod_producto,tmp_cant_producto  FROM tbl_tmp_tokenuser WHERE id = 					a;
                SELECT cantidad INTO existencia_actual FROM producto WHERE codproducto = tmp_cod_producto;
                
                SET nueva_existencia = existencia_actual - tmp_cant_producto;
                UPDATE producto SET cantidad = nueva_existencia WHERE codproducto = tmp_cod_producto;
                
                SET a=a+1;
            
            END WHILE;
            
            SET total = (SELECT SUM(cantidad*precio_venta) FROM detalle_temp WHERE token_user = token);
            UPDATE factura SET totalfactura = total WHERE nofactura = factura;
            
            DELETE FROM detalle_temp WHERE token_user = token;
            TRUNCATE TABLE tbl_tmp_tokenuser;
            SELECT * FROM factura WHERE nofactura = factura;
                         
        ELSE
        	SELECT 0;
        END IF;
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `codCliente` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `correo` varchar(100) NOT NULL,
  `tipoId` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`codCliente`, `id`, `nombre`, `telefono`, `direccion`, `correo`, `tipoId`) VALUES
(1, 0, 'CF', '11111111', 'Colombia, Colombia', 'a@a', '1'),
(2, 1023374510, 'Maira Lizeth Perez', '3002656511', 'calle 40 sur # 77 a 97', 'wilfranr@gmail.com', 'CC'),
(4, 123, 'Yoseth Rivera', '+573137038949', 'tv 70D bis # 68-75 sur', 'wilfranr@gmail.com', 'NIT'),
(14, 1234, 'Samatha Rivera', '344433', 'Transversal 70 D Bis # 68-75 Sur', 'sammy@email.com', 'CC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(3) NOT NULL,
  `nit` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `razon_social` varchar(250) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `direccion` varchar(250) NOT NULL,
  `iva` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `nit`, `nombre`, `razon_social`, `telefono`, `email`, `direccion`, `iva`) VALUES
(1, 123456789, 'Trapiche Panelero', 'Trapiche Panelero', '2222222', 'trapiche@panlero.com', 'Ave Siempre viva 123', 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallefactura`
--

CREATE TABLE `detallefactura` (
  `correlativo` bigint(11) NOT NULL,
  `nofactura` bigint(11) DEFAULT NULL,
  `codproducto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio_venta` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detallefactura`
--

INSERT INTO `detallefactura` (`correlativo`, `nofactura`, `codproducto`, `cantidad`, `precio_venta`) VALUES
(1, 1, 2, 1, '35000'),
(2, 1, 1, 1, '2500'),
(3, 1, 3, 1, '35000'),
(4, 1, 4, 1, '1200'),
(8, 2, 1, 1, '2500'),
(9, 2, 2, 1, '35000'),
(10, 2, 1, 1, '2500'),
(11, 3, 1, 1, '2500'),
(12, 11, 2, 1, '35000'),
(13, 11, 1, 1, '2500'),
(15, 12, 2, 1, '35000'),
(16, 13, 2, 1, '35000'),
(17, 14, 2, 1, '35000'),
(18, 15, 1, 1, '2500'),
(19, 16, 2, 1, '35000'),
(20, 17, 2, 1, '35000'),
(21, 17, 1, 1, '2500'),
(23, 18, 2, 1, '35000'),
(24, 18, 2, 1, '35000'),
(26, 19, 2, 1, '35000'),
(27, 20, 2, 1, '35000'),
(28, 21, 2, 1, '35000'),
(29, 22, 4, 1, '1200'),
(30, 23, 2, 1, '35000'),
(31, 24, 1, 1, '2500'),
(32, 25, 2, 1, '35000'),
(33, 26, 2, 1, '35000'),
(34, 27, 2, 1, '35000'),
(35, 28, 1, 1, '2500'),
(36, 29, 2, 1, '35000'),
(37, 29, 1, 1, '2500'),
(38, 29, 2, 3, '35000'),
(39, 30, 2, 1, '35000'),
(40, 31, 5, 4, '1500'),
(41, 32, 4, 4, '1200'),
(42, 33, 5, 8, '1500'),
(43, 34, 2, 1, '35000'),
(44, 35, 6, 24, '1800'),
(45, 36, 1, 1, '2500'),
(46, 37, 4, 2, '1200'),
(47, 38, 2, 1, '35000'),
(48, 39, 4, 5, '1200'),
(49, 40, 4, 1, '1200'),
(50, 41, 6, 6, '1800'),
(51, 42, 2, 1, '35000'),
(52, 43, 1, 1, '2500'),
(53, 44, 1, 1, '2500'),
(54, 45, 1, 1, '2500'),
(55, 46, 1, 1, '2500'),
(58, 48, 1, 10, '2500'),
(59, 49, 1, 1, '2500'),
(60, 50, 1, 1, '2500'),
(61, 51, 1, 1, '2552'),
(62, 52, 1, 1, '2552'),
(63, 53, 1, 1, '2549');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_temp`
--

CREATE TABLE `detalle_temp` (
  `correlativo` int(11) NOT NULL,
  `codproducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` int(10) NOT NULL,
  `token_user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_temp`
--

INSERT INTO `detalle_temp` (`correlativo`, `codproducto`, `cantidad`, `precio_venta`, `token_user`) VALUES
(4, 4, 2, 1200, 'qwqwe3e3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `correlativo` int(11) NOT NULL,
  `codproducto` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `usuario_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`correlativo`, `codproducto`, `fecha`, `cantidad`, `precio`, `usuario_id`) VALUES
(8, 2, '2021-10-23 13:55:26', 50, '35000.00', 7),
(9, 3, '2021-10-23 13:55:35', 50, '35000.00', 7),
(10, 4, '2021-11-25 11:33:06', 5, '1200.00', 7),
(11, 5, '2022-01-12 06:05:36', 5, '1500.00', 7),
(30, 5, '2022-01-18 18:59:37', 15, '1000.00', 7),
(31, 4, '2022-01-18 19:04:24', 15, '500.00', 7),
(32, 4, '2022-01-18 19:04:45', 20, '800.00', 7),
(33, 1, '2022-01-29 12:29:39', 100, '2500.00', 7),
(34, 1, '2022-02-02 19:45:09', 5, '2000.00', 7),
(35, 6, '2022-02-04 20:42:21', 100, '1800.00', 7),
(36, 6, '2022-02-04 20:45:23', 100, '1300.00', 7),
(38, 14, '2022-02-12 21:34:43', 1000, '2000.00', 7),
(39, 15, '2022-02-12 21:39:14', 100, '50000.00', 7),
(40, 1, '2022-03-01 20:28:21', 9, '1810.00', 7),
(41, 1, '2022-07-01 17:20:14', 9, '3000.00', 7),
(42, 1, '2022-07-01 17:41:50', 5, '2500.00', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `nofactura` bigint(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `usuario` int(11) DEFAULT NULL,
  `codcliente` int(11) DEFAULT NULL,
  `totalfactura` decimal(10,0) DEFAULT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`nofactura`, `fecha`, `usuario`, `codcliente`, `totalfactura`, `estatus`) VALUES
(1, '2022-05-03 18:38:54', 7, 2, '73700', 1),
(2, '2022-05-03 20:12:12', 7, 4, '40000', 1),
(3, '2022-05-03 20:21:12', 7, 4, '2500', 1),
(11, '2022-05-03 20:46:29', 7, 4, '37500', 1),
(12, '2022-05-03 20:47:29', 7, 4, '35000', 1),
(13, '2022-05-03 20:47:43', 7, 4, '35000', 1),
(14, '2022-05-03 20:50:16', 7, 1, '35000', 1),
(15, '2022-05-06 18:35:14', 7, 4, '2500', 1),
(16, '2022-05-06 18:35:33', 7, 4, '35000', 1),
(17, '2022-05-06 18:49:00', 7, 4, '37500', 1),
(18, '2022-05-06 18:58:02', 7, 1, '70000', 1),
(19, '2022-05-06 19:39:33', 7, 4, '35000', 1),
(20, '2022-05-06 19:42:46', 7, 4, '35000', 1),
(21, '2022-05-06 19:45:52', 7, 4, '35000', 1),
(22, '2022-05-06 19:53:38', 7, 4, '1200', 1),
(23, '2022-05-06 20:51:08', 7, 4, '35000', 1),
(24, '2022-05-06 21:12:14', 7, 4, '2500', 1),
(25, '2022-05-06 21:13:17', 7, 4, '35000', 1),
(26, '2022-05-07 18:30:21', 7, 4, '35000', 1),
(27, '2022-05-07 18:43:09', 7, 1, '35000', 1),
(28, '2022-05-13 12:30:45', 7, 4, '2500', 1),
(29, '2022-05-13 13:39:37', 7, 1, '142500', 1),
(30, '2022-05-13 14:04:44', 7, 4, '35000', 1),
(31, '2022-05-13 14:22:34', 7, 4, '6000', 1),
(32, '2022-05-13 14:44:33', 7, 4, '4800', 1),
(33, '2022-05-13 14:53:42', 37, 14, '12000', 1),
(34, '2022-05-14 13:41:36', 7, 1, '35000', 1),
(35, '2022-05-14 13:45:25', 7, 4, '43200', 1),
(36, '2022-05-14 13:52:41', 7, 1, '2500', 1),
(37, '2022-05-14 13:55:29', 7, 14, '2400', 1),
(38, '2022-05-16 16:51:01', 7, 4, '35000', 1),
(39, '2022-05-16 17:02:01', 7, 1, '6000', 1),
(40, '2022-05-16 17:25:59', 7, 1, '1200', 1),
(41, '2022-05-16 17:27:34', 7, 14, '10800', 1),
(42, '2022-05-16 17:39:13', 7, 1, '35000', 1),
(43, '2022-05-16 17:43:00', 7, 1, '2500', 1),
(44, '2022-05-16 17:46:03', 7, 1, '2500', 1),
(45, '2022-05-16 17:49:14', 7, 1, '2500', 1),
(46, '2022-05-16 17:51:04', 7, 1, '2500', 1),
(48, '2022-05-29 11:17:10', 45, 14, '25000', 1),
(49, '2022-06-30 20:19:44', 44, 4, '2500', 1),
(50, '2022-07-01 17:15:49', 7, 4, '2500', 1),
(51, '2022-07-01 17:39:37', 7, 4, '2552', 1),
(52, '2022-07-01 17:40:43', 7, 1, '2552', 1),
(53, '2022-07-01 17:44:03', 7, 1, '2549', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `codproducto` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `proveedor` int(11) DEFAULT NULL,
  `costo` decimal(11,0) DEFAULT NULL,
  `precio` decimal(11,0) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `date_add` datetime NOT NULL DEFAULT current_timestamp(),
  `fechaVencimiento` date NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1,
  `foto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`codproducto`, `nombre`, `descripcion`, `proveedor`, `costo`, `precio`, `cantidad`, `date_add`, `fechaVencimiento`, `usuario_id`, `estatus`, `foto`) VALUES
(1, 'Panela', 'Panela 500gr', 19, '1810', '2549', 89, '2022-01-29 12:28:16', '2023-02-07', 7, 1, 'panela.jpg'),
(2, 'aceite', 'aceite 1litro', 1, '25000', '35000', 25, '2021-10-23 13:55:26', '2022-10-28', 7, 1, 'aceite.jpg'),
(3, 'aceite', 'aceite 1litro', 4, '25000', '35000', 41, '2021-10-23 13:55:35', '2022-10-28', 7, 1, 'aceite.jpg'),
(4, 'cajas', 'cajas 10*20', 5, '650', '1200', 26, '2021-11-25 11:33:06', '2021-11-25', 7, 1, 'img_producto.png'),
(5, 'azucar', 'azucar 500gr', 4, '1000', '1500', 8, '2022-01-12 06:05:36', '2022-01-13', 7, 1, 'img_producto.png'),
(6, 'Panela 250gr', 'panela 250gr', 4, '1300', '1800', 170, '2022-02-04 20:42:21', '2023-01-01', 7, 1, 'img_2bd775092e0a7bf80307195905879b62.jpg'),
(14, 'miel', 'miel 250gr', 19, '1200', '2000', 1000, '2022-02-12 21:34:43', '2023-04-05', 7, 1, 'img_61e1e65ed10523c9f039106c7b6e8221.jpg'),
(15, 'cañas', 'caña bulto', 19, '10000', '50000', 100, '2022-02-12 21:39:14', '2022-02-19', 7, 1, 'img_11f0f62f185f1696d9cc83300ab46d4a.jpg');

--
-- Disparadores `producto`
--
DELIMITER $$
CREATE TRIGGER `entradas_A_I` AFTER INSERT ON `producto` FOR EACH ROW BEGIN
    	INSERT INTO entradas(codproducto,cantidad,precio,usuario_id)
        VALUES(new.codproducto,new.cantidad,new.precio,new.usuario_id);
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `codproveedor` int(11) NOT NULL,
  `id` varchar(20) DEFAULT NULL,
  `tipoIdProveedor` varchar(3) DEFAULT NULL,
  `proveedor` varchar(100) DEFAULT NULL,
  `contacto` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `correo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`codproveedor`, `id`, `tipoIdProveedor`, `proveedor`, `contacto`, `telefono`, `direccion`, `correo`) VALUES
(1, '3333333', 'NIT', 'BIC', 'Claudia Rosales', '+573137038949', 'tv 70D bis # 68-75 sur', 'wilfranr@gmail.com'),
(2, '444444', 'NIT', 'FEDEPANELA', 'Jorge Herrera', '3002656511', 'calle 40 sur # 77 a 97', 'wilfranr@gmail.com'),
(3, '34564554', 'NIT', 'Omega', 'Julio Estrada', '982877489', 'Avenida Elena Zona 4, Guatemala', 'a@a'),
(4, '123', 'NIT', 'CARTONES SAS', 'Roberto Estrada', '2147483647', '1700 Convention Center Drive', 'wilfranr@gmail.com'),
(5, '99999', 'NIT', 'Olimpia S.A', 'Elena Franco Morales', '564535676', '5ta. Avenida Zona 4 Ciudad', 'maira@gmail.com'),
(8, '234232', 'NIT', 'Sony', 'Julieta Contreras', '89476787', 'Antigua Guatemala', 'q@q'),
(9, '56565', 'NIT', 'VAIO', 'Felix Arnoldo Rojas', '476378276', 'Avenida las Americas Zona 13', 'w@w'),
(10, '9898', 'CC', 'SUMAR', 'Oscar Maldonado', '788376787', 'Colonia San Jose, Zona 5 Guatemala', 'w@w'),
(11, '111111', 'NIT', 'HP', 'Angel Cardona', '3002656511', 'calle 40 sur # 77 a 97', 'wilfranr@gmail.com'),
(13, '222222', 'NIT', 'kingston', 'yos', '3002656511', 'calle 40 sur # 77 a 97', 'wilfranr@gmail.com'),
(14, '888888', 'NIT', 'bytte', 'paola', '3002656511', '1700 Convention Center Drive', 'wilfranr@gmail.com'),
(15, '555', 'NIT', 'minu', 'yos', '3002656511', '1700 Convention Center Drive', 'wilfranr@gmail.com'),
(19, '666666', 'NIT', 'caña sas', 'yoseth -rivera', '+573137038949', 'tv 70D bis # 68-75 sur', 'wilfranr@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` int(11) NOT NULL,
  `rol` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `rol`) VALUES
(1, 'Administrador'),
(3, 'Superusuario'),
(2, 'Vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `codUsuario` int(11) NOT NULL,
  `id` varchar(20) DEFAULT NULL,
  `tipoId` varchar(11) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `direccion` text NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `usuario` varchar(15) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `rol` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`codUsuario`, `id`, `tipoId`, `nombre`, `direccion`, `telefono`, `correo`, `usuario`, `clave`, `rol`) VALUES
(7, '80896995', 'CC', 'Yoseth Rivera', 'tv 70D bis # 68-75 sur', '+573137038949', 'wilfranr@gmail.com', 'wilfranr', '6a7e0c5e58f73f506b9514c0f4a5e015', 'Superusuario'),
(37, '1024481734', 'CC', 'Maira Lizeth Perez', 'calle 40 sur # 77 a 97', '3002656511', 'wilfranr@gmail.com', 'maira1', '827ccb0eea8a706c4c34a16891f84e7b', 'Vendedor'),
(43, '654321', 'CE', 'alejo', 'tas', '6565', '6565@6565', 'alejo01', '827ccb0eea8a706c4c34a16891f84e7b', 'Vendedor'),
(44, '12345', 'CC', 'adsi1', '1234qwery', '12345', 'adsi@adsi', 'adsi1', '5b888244daa65df950ebee697673ddab', 'Superusuario'),
(45, '3434', 'CC', 'adsi2', '1234qwery', 'asdasd', 'wilfran@r', 'adsi2', '00f151647386626a9ba09ff87416ac54', 'Administrador'),
(46, '444', 'CC', 'adsi3', 'direccion', '324', 'adsi@adsi', 'adsi3', '1c76c805da921f5e16ecf27d953dbc94', 'Vendedor');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`codCliente`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD PRIMARY KEY (`correlativo`),
  ADD KEY `codproducto` (`codproducto`),
  ADD KEY `nofactura` (`nofactura`);

--
-- Indices de la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  ADD PRIMARY KEY (`correlativo`),
  ADD KEY `codproducto` (`codproducto`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`correlativo`),
  ADD KEY `codproducto` (`codproducto`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`nofactura`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `codcliente` (`codcliente`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`codproducto`),
  ADD KEY `proveedor` (`proveedor`),
  ADD KEY `usuarios_id` (`usuario_id`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`codproveedor`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`),
  ADD KEY `rol` (`rol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`codUsuario`),
  ADD KEY `rol` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `codCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  MODIFY `correlativo` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  MODIFY `correlativo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `correlativo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `nofactura` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `codproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `codproveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `codUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD CONSTRAINT `detallefactura_ibfk_1` FOREIGN KEY (`nofactura`) REFERENCES `factura` (`nofactura`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detallefactura_ibfk_2` FOREIGN KEY (`codproducto`) REFERENCES `producto` (`codproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  ADD CONSTRAINT `detalle_temp_ibfk_2` FOREIGN KEY (`codproducto`) REFERENCES `producto` (`codproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD CONSTRAINT `entradas_ibfk_1` FOREIGN KEY (`codproducto`) REFERENCES `producto` (`codproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`codUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`codcliente`) REFERENCES `cliente` (`codCliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`proveedor`) REFERENCES `proveedor` (`codproveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`codUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_rol_rol` FOREIGN KEY (`rol`) REFERENCES `rol` (`rol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
