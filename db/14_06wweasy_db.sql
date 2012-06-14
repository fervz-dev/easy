/*
Navicat MySQL Data Transfer

Source Server         : easy
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : wwweasy_db

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2012-06-14 12:03:34
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `almacen_entrada`
-- ----------------------------
DROP TABLE IF EXISTS `almacen_entrada`;
CREATE TABLE `almacen_entrada` (
  `id_almacen_entrada` int(11) NOT NULL AUTO_INCREMENT,
  `observaciones` varchar(140) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_entrega` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` varchar(2) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pedido_proveedor_id_pedido` int(11) DEFAULT NULL,
  `oficina_id_oficina` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_almacen_entrada`),
  KEY `fk_almacen_entrada_pedido_proveedor1` (`pedido_proveedor_id_pedido`),
  KEY `fk_almacen_entrada_oficina1` (`oficina_id_oficina`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of almacen_entrada
-- ----------------------------

-- ----------------------------
-- Table structure for `almacen_salida`
-- ----------------------------
DROP TABLE IF EXISTS `almacen_salida`;
CREATE TABLE `almacen_salida` (
  `id_almacen_salida` int(11) NOT NULL AUTO_INCREMENT,
  `comentario` varchar(140) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` varchar(2) COLLATE utf8_spanish_ci DEFAULT NULL,
  `lugar_entrega_id_lugar_entrega` int(11) DEFAULT NULL,
  `orden_id_orden` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_almacen_salida`),
  KEY `fk_almacen_salida_lugar_entrega1` (`lugar_entrega_id_lugar_entrega`),
  KEY `fk_almacen_salida_orden1` (`orden_id_orden`),
  CONSTRAINT `fk_almacen_salida_lugar_entrega1` FOREIGN KEY (`lugar_entrega_id_lugar_entrega`) REFERENCES `lugar_entrega` (`id_lugar_entrega`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_almacen_salida_orden1` FOREIGN KEY (`orden_id_orden`) REFERENCES `orden` (`id_orden`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of almacen_salida
-- ----------------------------

-- ----------------------------
-- Table structure for `almacen_stock`
-- ----------------------------
DROP TABLE IF EXISTS `almacen_stock`;
CREATE TABLE `almacen_stock` (
  `id_almacen` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_ingreso` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `producto_terminado_id_producto_terminado` int(11) DEFAULT NULL,
  `cat_mprima_id_cat_mprima` int(11) DEFAULT NULL,
  `pedido_proveedor_id_pedido` int(11) DEFAULT NULL,
  `codigo` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_almacen`),
  KEY `fk_almacen_stock_producto_terminado1` (`producto_terminado_id_producto_terminado`),
  KEY `fk_almacen_stock_cat_mprima1` (`cat_mprima_id_cat_mprima`),
  KEY `fk_almacen_stock_pedido_proveedor1` (`pedido_proveedor_id_pedido`),
  CONSTRAINT `fk_almacen_stock_cat_mprima1` FOREIGN KEY (`cat_mprima_id_cat_mprima`) REFERENCES `cat_mprima` (`id_cat_mprima`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_almacen_stock_pedido_proveedor1` FOREIGN KEY (`pedido_proveedor_id_pedido`) REFERENCES `pedido_proveedor` (`id_pedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_almacen_stock_producto_terminado1` FOREIGN KEY (`producto_terminado_id_producto_terminado`) REFERENCES `producto_terminado` (`id_producto_terminado`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of almacen_stock
-- ----------------------------

-- ----------------------------
-- Table structure for `cantidad_pedido`
-- ----------------------------
DROP TABLE IF EXISTS `cantidad_pedido`;
CREATE TABLE `cantidad_pedido` (
  `id_cantidad_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `catalogo_producto` int(11) DEFAULT NULL,
  `cantidad` varchar(11) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `verificacion` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `observaciones` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `codigo` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_cantidad_pedido`),
  KEY `fk_cantidad_pedido` (`catalogo_producto`),
  KEY `fk_cantidad_pedido_pedido` (`id_pedido`),
  CONSTRAINT `fk_cantidad_pedido` FOREIGN KEY (`catalogo_producto`) REFERENCES `cat_mprima` (`id_cat_mprima`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cantidad_pedido_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `pedido_proveedor` (`id_pedido`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of cantidad_pedido
-- ----------------------------
INSERT INTO `cantidad_pedido` VALUES ('1', '1', '300', '33', null, null, null);
INSERT INTO `cantidad_pedido` VALUES ('2', '1', '20', '33', null, null, null);
INSERT INTO `cantidad_pedido` VALUES ('3', '1', '20', '33', null, null, null);
INSERT INTO `cantidad_pedido` VALUES ('4', '19', '20', '36', null, null, null);
INSERT INTO `cantidad_pedido` VALUES ('5', '1', '30', '37', null, null, null);
INSERT INTO `cantidad_pedido` VALUES ('6', '1', '2000', '33', null, null, null);

-- ----------------------------
-- Table structure for `caracteriticas_producto`
-- ----------------------------
DROP TABLE IF EXISTS `caracteriticas_producto`;
CREATE TABLE `caracteriticas_producto` (
  `id_caracteriticas_producto` int(11) NOT NULL AUTO_INCREMENT,
  `largo` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ancho` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `alto` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_caracteriticas_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of caracteriticas_producto
-- ----------------------------

-- ----------------------------
-- Table structure for `catalogo_producto`
-- ----------------------------
DROP TABLE IF EXISTS `catalogo_producto`;
CREATE TABLE `catalogo_producto` (
  `id_catalogo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` varchar(140) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `caracteriticas_producto_id_caracteriticas_producto` int(11) DEFAULT NULL,
  `activo` varchar(2) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_catalogo`),
  KEY `fk_catalogo_producto_caracteriticas_producto1` (`caracteriticas_producto_id_caracteriticas_producto`),
  CONSTRAINT `fk_catalogo_producto_caracteriticas_producto1` FOREIGN KEY (`caracteriticas_producto_id_caracteriticas_producto`) REFERENCES `caracteriticas_producto` (`id_caracteriticas_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of catalogo_producto
-- ----------------------------

-- ----------------------------
-- Table structure for `cat_mprima`
-- ----------------------------
DROP TABLE IF EXISTS `cat_mprima`;
CREATE TABLE `cat_mprima` (
  `id_cat_mprima` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `caracteristica` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ancho` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `largo` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `resistencia_mprima_id_resistencia_mprima` int(11) DEFAULT NULL,
  `activo` varchar(2) COLLATE utf8_spanish_ci DEFAULT '1',
  `tipo` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo_m` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_cat_mprima`),
  KEY `fk_cat_mprima_resistencia_mprima1` (`resistencia_mprima_id_resistencia_mprima`),
  CONSTRAINT `fk_cat_mprima_resistencia_mprima1` FOREIGN KEY (`resistencia_mprima_id_resistencia_mprima`) REFERENCES `resistencia_mprima` (`id_resistencia_mprima`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='					';

-- ----------------------------
-- Records of cat_mprima
-- ----------------------------
INSERT INTO `cat_mprima` VALUES ('1', 'CORRUGADO', null, '80', '90', '4', '0', 'LINEA', null);
INSERT INTO `cat_mprima` VALUES ('2', 'CORRUGADO', null, '80', '80', '3', '0', 'LINEA', null);
INSERT INTO `cat_mprima` VALUES ('3', 'CORRUGADO DOBLE', null, '80', '80', '3', '0', 'LINEA', null);
INSERT INTO `cat_mprima` VALUES ('4', 'CORRUGADO', null, '80', '12', '5', '0', 'LINEA', null);
INSERT INTO `cat_mprima` VALUES ('5', 'corrugado', null, '23', '45', '4', '0', 'LINEA', null);
INSERT INTO `cat_mprima` VALUES ('6', 'lamina', null, '240', '320', '1', '0', 'LINEA', null);
INSERT INTO `cat_mprima` VALUES ('7', 'corrugado dble', null, '120', '120', '1', '0', 'LINEA', null);
INSERT INTO `cat_mprima` VALUES ('8', 'sadfsa', null, '12', '12', '2', '0', 'REUTILIZABLE', null);
INSERT INTO `cat_mprima` VALUES ('11', 'LAMINA', null, '', '13', '2', '0', 'LINEA', null);
INSERT INTO `cat_mprima` VALUES ('12', 'Lamina', '0', '240', '240', '2', '0', 'LINEA', null);
INSERT INTO `cat_mprima` VALUES ('13', 'lamina', '0', '140', '140', '3', '0', 'LINEA', null);
INSERT INTO `cat_mprima` VALUES ('14', 'lamina', '0', '40', '40', '4', '0', 'LINEA', null);
INSERT INTO `cat_mprima` VALUES ('15', 'laminita', 'SG', '20', '20', '5', '0', 'LINEA', null);
INSERT INTO `cat_mprima` VALUES ('16', 'Lamina', 'SG', '240', '320', '2', '0', 'LINEA', null);
INSERT INTO `cat_mprima` VALUES ('17', 'celdado 123', 'SG', '120', '350', '2', '0', 'LINEA', null);
INSERT INTO `cat_mprima` VALUES ('18', 'lamina', 'CORRUGADO', '120', '300', '2', '1', 'REUTILIZABLE', 'sencillo');
INSERT INTO `cat_mprima` VALUES ('19', 'LAMINA', 'CORRUGADO', '120', '120', '2', '0', 'LINEA', 'doble');
INSERT INTO `cat_mprima` VALUES ('20', 'ceparador guibo', 'SG', '78', '120', '1', '0', 'LINEA', 'sencillo');
INSERT INTO `cat_mprima` VALUES ('21', '', 'CORRUGADO', '100', '100', '3', '0', 'LINEA', 'sencillo');
INSERT INTO `cat_mprima` VALUES ('22', 'adsa', 'SG', '100', '100', '8', '0', 'LINEA', 'sencillo');
INSERT INTO `cat_mprima` VALUES ('23', 'asdasd', 'SG', '12', '12', '7', '1', 'REUTILIZABLE', 'sencillo');
INSERT INTO `cat_mprima` VALUES ('24', 'asdasd', 'CORRUGADO', '12', '12', '4', '1', 'LINEA', 'sencillo');

-- ----------------------------
-- Table structure for `cat_mprima_reutilizable`
-- ----------------------------
DROP TABLE IF EXISTS `cat_mprima_reutilizable`;
CREATE TABLE `cat_mprima_reutilizable` (
  `id_cat_mprima` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `caracteristica` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ancho` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `largo` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `resistencia_mprima_id_resistencia_mprima` int(11) DEFAULT NULL,
  `tipo` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo_m` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `peso` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cantidad` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `peso_total` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `restan` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` varchar(2) COLLATE utf8_spanish_ci DEFAULT '1',
  PRIMARY KEY (`id_cat_mprima`),
  KEY `fk_cat_mprima_resistencia_mprima1` (`resistencia_mprima_id_resistencia_mprima`),
  CONSTRAINT `cat_mprima_reutilizable_ibfk_1` FOREIGN KEY (`resistencia_mprima_id_resistencia_mprima`) REFERENCES `resistencia_mprima` (`id_resistencia_mprima`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='					';

-- ----------------------------
-- Records of cat_mprima_reutilizable
-- ----------------------------
INSERT INTO `cat_mprima_reutilizable` VALUES ('1', 'celdado', 'SG', '100', '100', '1', 'REUTILIZABLE', 'sencillo', 'undefined', null, null, null, '0');
INSERT INTO `cat_mprima_reutilizable` VALUES ('2', 'celdado', 'CORRUGADO', '100', '1000', '2', 'reutilizable', 'sencillo', '2.75', null, null, null, '0');
INSERT INTO `cat_mprima_reutilizable` VALUES ('3', 'lamina', 'SG', '100', '100', '2', 'reutilizable', '0', '1300', null, null, null, '0');
INSERT INTO `cat_mprima_reutilizable` VALUES ('4', 'caldado 2', 'SG', '100', '100', '2', 'reutilizable', 'sencillo', '', null, null, null, '0');
INSERT INTO `cat_mprima_reutilizable` VALUES ('5', 'celdado 3', 'CORRUGADO', '200', '200', '2', 'reutilizable', 'sencillo', '', null, null, null, '0');
INSERT INTO `cat_mprima_reutilizable` VALUES ('6', 'celdado 3', 'SG', '500', '500', '2', 'reutilizable', '0', '', null, null, null, '0');
INSERT INTO `cat_mprima_reutilizable` VALUES ('7', 'celdado 3', 'SG', '40', '40', '1', 'reutilizable', 'doble', '', null, null, null, '0');
INSERT INTO `cat_mprima_reutilizable` VALUES ('8', 'celdado', 'CORRUGADO', '100', '100', '2', 'reutilizable', 'sencillo', '0.500', null, null, null, '0');
INSERT INTO `cat_mprima_reutilizable` VALUES ('9', 'celdado', 'SG', '1000', '1000', '2', 'reutilizable', 'sencillo', '', null, null, null, '0');
INSERT INTO `cat_mprima_reutilizable` VALUES ('10', 'celdado', 'CORRUGADO', '500', '500', '2', 'reutilizable', 'sencillo', '', null, null, null, '0');
INSERT INTO `cat_mprima_reutilizable` VALUES ('11', 'celdado', 'SG', '100', '100', '2', 'reutilizable', 'doble', '300', null, null, null, '0');
INSERT INTO `cat_mprima_reutilizable` VALUES ('13', 'celdado', 'CORRUGADO', '300', '300', '3', 'reutilizable', 'doble', '2,300', null, null, null, '0');
INSERT INTO `cat_mprima_reutilizable` VALUES ('14', 'celdado12', 'SG', '100', '100', '4', 'reutilizable', 'sencillo', '2.39', null, null, null, '0');
INSERT INTO `cat_mprima_reutilizable` VALUES ('15', 'celdado435', 'CORRUGADO', '100', '100', '3', 'reutilizable', '0', '6.200', '0', '0', '0', '0');
INSERT INTO `cat_mprima_reutilizable` VALUES ('16', 'asdasd', 'SG', '100', '100', '4', 'reutilizable', 'doble', '3.6', '0', '0', '0', '0');
INSERT INTO `cat_mprima_reutilizable` VALUES ('17', 'asdasd', 'SG', '100', '100', '1', 'reutilizable', 'sencillo', '2.30', '0', '0', '0', '0');
INSERT INTO `cat_mprima_reutilizable` VALUES ('18', 'dasdasd', 'CORRUGADO', '100', '100', '2', 'reutilizable', 'sencillo', '4.10', '0', '8.20', '0', '0');
INSERT INTO `cat_mprima_reutilizable` VALUES ('19', 'asdasd', 'CORRUGADO', '12', '12', '2', 'reutilizable', 'sencillo', '2.12', '12', '25.44', '12', '0');
INSERT INTO `cat_mprima_reutilizable` VALUES ('20', 'as', 'SG', '500', '20', '2', 'reutilizable', 'sencillo', '4.50', '50', '225.00', '50', '0');
INSERT INTO `cat_mprima_reutilizable` VALUES ('21', 'CELDADO', 'SG', '100', '100', '3', 'reutilizable', 'sencillo', '2.500', '300', '750.00', '300', '1');
INSERT INTO `cat_mprima_reutilizable` VALUES ('22', 'prueba 1', 'SG', '100', '100', '5', 'reutilizable', 'sencillo', '10.850', '300', '', '300', '0');
INSERT INTO `cat_mprima_reutilizable` VALUES ('23', 'prueba 2', 'CORRUGADO', '200', '200', '3', 'reutilizable', 'sencillo', '4.300', '300', '1290.00', '300', '0');
INSERT INTO `cat_mprima_reutilizable` VALUES ('24', 'celdado', 'SG', '100', '100', '1', 'reutilizable', 'sencillo', '1.0', '300', '300.00', '300', '1');
INSERT INTO `cat_mprima_reutilizable` VALUES ('25', 'lamina', 'CORRUGADO', '35', '114', '2', 'reutilizable', 'doble', '0.500', '500', '250.00', '500', '1');

-- ----------------------------
-- Table structure for `cat_productos_asoc`
-- ----------------------------
DROP TABLE IF EXISTS `cat_productos_asoc`;
CREATE TABLE `cat_productos_asoc` (
  `id_cat_productos_asoc` int(11) NOT NULL,
  `catalogo_producto_id_catalogo` int(11) DEFAULT NULL,
  `producto_terminado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cat_productos_asoc`),
  KEY `fk_cat_productos_asoc_catalogo_producto1` (`catalogo_producto_id_catalogo`),
  KEY `fk_producto_asoc_producto_terminado` (`producto_terminado`),
  CONSTRAINT `fk_cat_productos_asoc_catalogo_producto1` FOREIGN KEY (`catalogo_producto_id_catalogo`) REFERENCES `catalogo_producto` (`id_catalogo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_asoc_producto_terminado` FOREIGN KEY (`producto_terminado`) REFERENCES `producto_terminado` (`id_producto_terminado`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of cat_productos_asoc
-- ----------------------------

-- ----------------------------
-- Table structure for `clientes`
-- ----------------------------
DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `id_clientes` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_empresa` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre_contacto` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo_persona` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `rfc` varchar(13) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado_id_estado` int(11) DEFAULT NULL,
  `cp` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ciudad` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `lada` varchar(3) COLLATE utf8_spanish_ci DEFAULT NULL,
  `num_telefono` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ext` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fax` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `comentario` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `activo` varchar(2) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_clientes`),
  KEY `fk_clientes_estados1` (`estado_id_estado`),
  CONSTRAINT `fk_clientes_estados1` FOREIGN KEY (`estado_id_estado`) REFERENCES `estados` (`id_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of clientes
-- ----------------------------
INSERT INTO `clientes` VALUES ('1', 'asdasd', 'asdasd', 'asdasd', 'asdasd', '2', 'asdas', 'dasda', 'dad', 'ada', 'asdasd', 'asd', 'asdasd', 'asdasd', 'asdasd', null, '0');
INSERT INTO `clientes` VALUES ('2', 'asdada', 'asdasd', 'sdasd', 'asdasd', '4', 'adads', 'ads', 'asdas', 'dad', 'sdas', 'dasda', 'sdas', 'dads', 'asdasd', null, '0');
INSERT INTO `clientes` VALUES ('3', 'asdas', 'undefined', 'dasd', '0', '3', 'asdasd', 'asd', 'asda', 'sda', 'dasd', 'asdas', 'dasd', 'asd', 'asdads', null, '0');
INSERT INTO `clientes` VALUES ('4', 'DASDA', 'undefined', 'DASD', '0', '1', 'ASDAS', 'DASD', 'ASD', 'ASD', 'DASD', 'ASDAS', 'DASD', 'ASDSD', 'ASDASD', '0000-00-00', '0');
INSERT INTO `clientes` VALUES ('5', 'asdas', 'undefined', 'asda', '0', '7', 'asdas', 'dasd', 'asdasd', 'asd', 'dasd', 'asdas', 'dasd', 'asd', 'asdasd', '2012-04-10', '0');
INSERT INTO `clientes` VALUES ('6', '2', 'undefined', '3', '0', '7', '4', '5', '6', '7', '8', '9', '10', '11', '12', '2012-04-10', '0');
INSERT INTO `clientes` VALUES ('7', '1', 'undefined', '3', '0', '14', '4', '5', '6', '7', '8', '9', '10', '11', '12', '2012-04-10', '0');
INSERT INTO `clientes` VALUES ('8', '1', '2', '3', '0', '8', '5', '6', '7', '8', '9', '10', '11', '12', '13', '2012-04-10', '0');
INSERT INTO `clientes` VALUES ('9', 'gh', 'f', 'hf', '0', '11', 'ghf', 'gh', 'fh', 'gf', 'hg', 'fgh', 'f', 'hg', 'fhg', '2012-04-10', '0');
INSERT INTO `clientes` VALUES ('10', '1', '2', '3', '0', '11', '4', '5', '6', '7', '8', '9', '10', '11', '12', '2012-04-10', '0');
INSERT INTO `clientes` VALUES ('11', '2', 'undefined', '3', '0', '11', '4', '5', '6', '7', '8', '9', '10', '11', '12', '2012-04-10', '0');
INSERT INTO `clientes` VALUES ('12', '1', '2', '3', '0', '2', '5', '6', '7', '8', '9', '10', '11', '12', '13', '2012-04-10', '0');
INSERT INTO `clientes` VALUES ('13', '1', '2', '3', '0', '2', '5', '6', '7', '8', '9', '10', '11', '12', '13', '2012-04-10', '0');
INSERT INTO `clientes` VALUES ('14', 'empresa', 'contacto', 'tipo persona', '0', '14', 'cp', 'direccion', 'ciudad', 'lad', 'tel', 'ext', 'fax', 'correo', 'observaciones', '2012-04-10', '0');
INSERT INTO `clientes` VALUES ('16', 'ico', '2', '3', '4', '2', '5', '6', '7', '8', '9', '10', '11', '12', '13', '2012-04-10', '0');
INSERT INTO `clientes` VALUES ('17', 'NOMBRE EMPRESA', 'CONTACTO', 'TIP DE PERSONA', 'RFC', '1', 'CP', 'DIRECCION', 'CIUDAD', 'LAD', 'TELEFONO', 'EXTENCION', 'FAX', 'CORREO ELECTRONICO', 'OBSERVACIONES1', '2012-04-10', '1');
INSERT INTO `clientes` VALUES ('18', 'cead', 'luis', 'moral', 'asdasdlui123', '21', '75200', 'conocida', 'pueblito', '222', '222222222', '12', '1343234343', 'luis.varillas@gmail.com', 'qw', '2012-04-12', '0');
INSERT INTO `clientes` VALUES ('19', 'asdasd', 'asda', 'sdasd', 'asd', '4', 'ad', 'asdas', 'dasd', 'asd', 'sdasd', 'asd', 'asd', 'adsas', 'adasd', '2012-04-13', '0');
INSERT INTO `clientes` VALUES ('20', 'nombre de la empresa', 'nombre del contacto', 'moral', 'rfc', '21', '75200', 'dirccion', 'puebla', '222', '2224246788', '41', 'fax', 'isc.fernando.v@hotmail.com', 'observaciones', '2012-05-13', '0');

-- ----------------------------
-- Table structure for `devoluciones_cliente`
-- ----------------------------
DROP TABLE IF EXISTS `devoluciones_cliente`;
CREATE TABLE `devoluciones_cliente` (
  `id_devoluciones_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `observaciones` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cantidad` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_devolucion` date DEFAULT NULL,
  `activo` varchar(2) COLLATE utf8_spanish_ci DEFAULT NULL,
  `almacen_salida_id_almacen_salida` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_devoluciones_cliente`),
  KEY `fk_devoluciones_cliente_almacen_salida1` (`almacen_salida_id_almacen_salida`),
  CONSTRAINT `fk_devoluciones_cliente_almacen_salida1` FOREIGN KEY (`almacen_salida_id_almacen_salida`) REFERENCES `almacen_salida` (`id_almacen_salida`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of devoluciones_cliente
-- ----------------------------

-- ----------------------------
-- Table structure for `devolucion_proveedor`
-- ----------------------------
DROP TABLE IF EXISTS `devolucion_proveedor`;
CREATE TABLE `devolucion_proveedor` (
  `id_devolucionProveedor` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_devolucion` date DEFAULT NULL,
  `cantidad` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `observaciones` varchar(140) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pedido_proveedor_id_pedido` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_devolucionProveedor`),
  KEY `fk_devolucion_proveedor_pedido_proveedor1` (`pedido_proveedor_id_pedido`),
  CONSTRAINT `fk_devolucion_proveedor_pedido_proveedor1` FOREIGN KEY (`pedido_proveedor_id_pedido`) REFERENCES `pedido_proveedor` (`id_pedido`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of devolucion_proveedor
-- ----------------------------

-- ----------------------------
-- Table structure for `direcciones`
-- ----------------------------
DROP TABLE IF EXISTS `direcciones`;
CREATE TABLE `direcciones` (
  `id_direcciones` int(11) NOT NULL AUTO_INCREMENT,
  `clientes_id_clientes` int(11) DEFAULT NULL,
  `estado_id_estado` int(11) DEFAULT NULL,
  `direccion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `colonia` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ciudad` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `observaciones` varchar(160) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` varchar(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_direcciones`),
  KEY `fk_direcciones_clientes1` (`clientes_id_clientes`),
  KEY `fk_direcciones_estados` (`estado_id_estado`),
  CONSTRAINT `fk_direcciones_clientes1` FOREIGN KEY (`clientes_id_clientes`) REFERENCES `clientes` (`id_clientes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_direcciones_estados` FOREIGN KEY (`estado_id_estado`) REFERENCES `estados` (`id_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of direcciones
-- ----------------------------
INSERT INTO `direcciones` VALUES ('1', '17', '6', 'LUIS', 'mirador', 'puebla', 'sin observaciones', '1');
INSERT INTO `direcciones` VALUES ('2', '17', '21', 'MIGUEL NEGRETE  NUMERO 101', 'SAN JUAN NEGRETE', 'TEPEACA', 'serca de las vias del tren', '1');
INSERT INTO `direcciones` VALUES ('6', '20', '7', 'gerardo', 'margarita', 'puebla', 'sin observaciones', '1');
INSERT INTO `direcciones` VALUES ('7', '20', '3', 'jesus', 'san sebastian', 'tepexi', 'nada', '1');
INSERT INTO `direcciones` VALUES ('8', '20', '2', 'CONOCIDA', 'MIRADOR', 'TLAXCALA', 'nada', '1');

-- ----------------------------
-- Table structure for `diseno`
-- ----------------------------
DROP TABLE IF EXISTS `diseno`;
CREATE TABLE `diseno` (
  `id_diseno` int(11) NOT NULL,
  `archivo` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_ingreso` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_diseno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of diseno
-- ----------------------------

-- ----------------------------
-- Table structure for `diseno_producto`
-- ----------------------------
DROP TABLE IF EXISTS `diseno_producto`;
CREATE TABLE `diseno_producto` (
  `id_diseno_producto` int(11) NOT NULL AUTO_INCREMENT,
  `archivo` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_diseno_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of diseno_producto
-- ----------------------------

-- ----------------------------
-- Table structure for `estados`
-- ----------------------------
DROP TABLE IF EXISTS `estados`;
CREATE TABLE `estados` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `clave` varchar(2) NOT NULL,
  `dsc_estado` varchar(45) NOT NULL,
  `abrev` varchar(16) NOT NULL,
  PRIMARY KEY (`id_estado`),
  KEY `clave` (`clave`),
  KEY `id_estado` (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COMMENT='Tabla de Estados de la República Mexicana';

-- ----------------------------
-- Records of estados
-- ----------------------------
INSERT INTO `estados` VALUES ('1', '01', 'Aguascalientes', 'Ags.');
INSERT INTO `estados` VALUES ('2', '02', 'Baja California', 'BC');
INSERT INTO `estados` VALUES ('3', '03', 'Baja California Sur', 'BCS');
INSERT INTO `estados` VALUES ('4', '04', 'Campeche', 'Camp.');
INSERT INTO `estados` VALUES ('5', '05', 'Coahuila de Zaragoza', 'Coah.');
INSERT INTO `estados` VALUES ('6', '06', 'Colima', 'Col.');
INSERT INTO `estados` VALUES ('7', '07', 'Chiapas', 'Chis.');
INSERT INTO `estados` VALUES ('8', '08', 'Chihuahua', 'Chih.');
INSERT INTO `estados` VALUES ('9', '09', 'Distrito Federal', 'DF');
INSERT INTO `estados` VALUES ('10', '10', 'Durango', 'Dgo.');
INSERT INTO `estados` VALUES ('11', '11', 'Guanajuato', 'Gto.');
INSERT INTO `estados` VALUES ('12', '12', 'Guerrero', 'Gro.');
INSERT INTO `estados` VALUES ('13', '13', 'Hidalgo', 'Hgo.');
INSERT INTO `estados` VALUES ('14', '14', 'Jalisco', 'Jal.');
INSERT INTO `estados` VALUES ('15', '15', 'México', 'Mex.');
INSERT INTO `estados` VALUES ('16', '16', 'Michoacán de Ocampo', 'Mich.');
INSERT INTO `estados` VALUES ('17', '17', 'Morelos', 'Mor.');
INSERT INTO `estados` VALUES ('18', '18', 'Nayarit', 'Nay.');
INSERT INTO `estados` VALUES ('19', '19', 'Nuevo León', 'NL');
INSERT INTO `estados` VALUES ('20', '20', 'Oaxaca', 'Oax.');
INSERT INTO `estados` VALUES ('21', '21', 'Puebla', 'Pue.');
INSERT INTO `estados` VALUES ('22', '22', 'Querétaro', 'Qro.');
INSERT INTO `estados` VALUES ('23', '23', 'Quintana Roo', 'Q. Roo');
INSERT INTO `estados` VALUES ('24', '24', 'San Luis Potosí', 'SLP');
INSERT INTO `estados` VALUES ('25', '25', 'Sinaloa', 'Sin.');
INSERT INTO `estados` VALUES ('26', '26', 'Sonora', 'Son.');
INSERT INTO `estados` VALUES ('27', '27', 'Tabasco', 'Tab.');
INSERT INTO `estados` VALUES ('28', '28', 'Tamaulipas', 'Tamps.');
INSERT INTO `estados` VALUES ('29', '29', 'Tlaxcala', 'Tlax.');
INSERT INTO `estados` VALUES ('30', '30', 'Veracruz de Ignacio de la Llave', 'Ver.');
INSERT INTO `estados` VALUES ('31', '31', 'Yucatán', 'Yuc.');
INSERT INTO `estados` VALUES ('32', '32', 'Zacatecas', 'Zac.');

-- ----------------------------
-- Table structure for `estatus_prod_mat`
-- ----------------------------
DROP TABLE IF EXISTS `estatus_prod_mat`;
CREATE TABLE `estatus_prod_mat` (
  `id_estatus_prod_mat` int(11) NOT NULL,
  `lugar_salida` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `lugar_entrega` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `hora` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_estatus_prod_mat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of estatus_prod_mat
-- ----------------------------

-- ----------------------------
-- Table structure for `lugar_entrega`
-- ----------------------------
DROP TABLE IF EXISTS `lugar_entrega`;
CREATE TABLE `lugar_entrega` (
  `id_lugar_entrega` int(11) NOT NULL AUTO_INCREMENT,
  `oficina_id_oficina` int(11) DEFAULT NULL,
  `clientes_id_clientes` int(11) DEFAULT NULL,
  `proceso` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `lugar_entregacol` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_lugar_entrega`),
  KEY `fk_lugar_entrega_oficina1` (`oficina_id_oficina`),
  KEY `fk_lugar_entrega_clientes1` (`clientes_id_clientes`),
  CONSTRAINT `fk_lugar_entrega_clientes1` FOREIGN KEY (`clientes_id_clientes`) REFERENCES `clientes` (`id_clientes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lugar_entrega_oficina1` FOREIGN KEY (`oficina_id_oficina`) REFERENCES `oficina` (`id_oficina`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of lugar_entrega
-- ----------------------------

-- ----------------------------
-- Table structure for `merma`
-- ----------------------------
DROP TABLE IF EXISTS `merma`;
CREATE TABLE `merma` (
  `id_Merma` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaVenta` date DEFAULT NULL,
  `oficina_id_oficina` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_Merma`),
  KEY `fk_Merma_oficina1` (`oficina_id_oficina`),
  CONSTRAINT `fk_Merma_oficina1` FOREIGN KEY (`oficina_id_oficina`) REFERENCES `oficina` (`id_oficina`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of merma
-- ----------------------------

-- ----------------------------
-- Table structure for `municipios`
-- ----------------------------
DROP TABLE IF EXISTS `municipios`;
CREATE TABLE `municipios` (
  `id_municipio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_municipio` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL COMMENT 'Id de tabla estados',
  PRIMARY KEY (`id_municipio`)
) ENGINE=MyISAM AUTO_INCREMENT=2594 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of municipios
-- ----------------------------
INSERT INTO `municipios` VALUES ('1', 'Aguascalientes', '1');
INSERT INTO `municipios` VALUES ('2', 'Asientos', '1');
INSERT INTO `municipios` VALUES ('3', 'Calvillo', '1');
INSERT INTO `municipios` VALUES ('4', 'Cosío', '1');
INSERT INTO `municipios` VALUES ('5', 'Jesús Maria', '1');
INSERT INTO `municipios` VALUES ('6', 'Pabellón de Arteaga', '1');
INSERT INTO `municipios` VALUES ('7', 'Rincón de Romos', '1');
INSERT INTO `municipios` VALUES ('8', 'San José de Gracia', '1');
INSERT INTO `municipios` VALUES ('9', 'Tepezalá', '1');
INSERT INTO `municipios` VALUES ('10', 'San Francisco de los Romo', '1');
INSERT INTO `municipios` VALUES ('11', 'El Llano', '1');
INSERT INTO `municipios` VALUES ('12', 'Ensenada', '2');
INSERT INTO `municipios` VALUES ('13', 'Mexicali', '2');
INSERT INTO `municipios` VALUES ('14', 'Tecate', '2');
INSERT INTO `municipios` VALUES ('15', 'Tijuana', '2');
INSERT INTO `municipios` VALUES ('16', 'Playas de Rosarito', '2');
INSERT INTO `municipios` VALUES ('17', 'Rosarito', '2');
INSERT INTO `municipios` VALUES ('18', 'Ciudad Guadalupe Victoria', '2');
INSERT INTO `municipios` VALUES ('19', 'San Felipe', '2');
INSERT INTO `municipios` VALUES ('20', 'San Quintín', '2');
INSERT INTO `municipios` VALUES ('21', 'Ciudad Morelos', '2');
INSERT INTO `municipios` VALUES ('22', 'Los Algodones', '2');
INSERT INTO `municipios` VALUES ('23', 'La Rumorosa', '2');
INSERT INTO `municipios` VALUES ('24', 'Cataviña', '2');
INSERT INTO `municipios` VALUES ('25', 'Colonet', '2');
INSERT INTO `municipios` VALUES ('26', 'Cedros', '2');
INSERT INTO `municipios` VALUES ('27', 'Guadalupe', '2');
INSERT INTO `municipios` VALUES ('28', 'Islas Coronado', '2');
INSERT INTO `municipios` VALUES ('29', 'Comondú', '3');
INSERT INTO `municipios` VALUES ('30', 'Mulegé', '3');
INSERT INTO `municipios` VALUES ('31', 'La Paz', '3');
INSERT INTO `municipios` VALUES ('32', 'Los Cabos', '3');
INSERT INTO `municipios` VALUES ('33', 'Loreto', '3');
INSERT INTO `municipios` VALUES ('34', 'CALKINÍ', '4');
INSERT INTO `municipios` VALUES ('35', 'CAMPECHE', '4');
INSERT INTO `municipios` VALUES ('36', 'CARMEN', '4');
INSERT INTO `municipios` VALUES ('37', 'CHAMPOTÓN', '4');
INSERT INTO `municipios` VALUES ('38', 'HECELCHAKÁN', '4');
INSERT INTO `municipios` VALUES ('39', 'HOPELCHÉN', '4');
INSERT INTO `municipios` VALUES ('40', 'PALIZADA', '4');
INSERT INTO `municipios` VALUES ('41', 'TENABO', '4');
INSERT INTO `municipios` VALUES ('42', 'ESCÁRCEGA', '4');
INSERT INTO `municipios` VALUES ('43', 'CALAKMUL', '4');
INSERT INTO `municipios` VALUES ('44', 'CANDELARIA', '4');
INSERT INTO `municipios` VALUES ('45', 'ACACOYAGUA ', '5');
INSERT INTO `municipios` VALUES ('46', 'ACALA ', '5');
INSERT INTO `municipios` VALUES ('47', 'ACAPETAHUA ', '5');
INSERT INTO `municipios` VALUES ('48', 'ALDAMA ', '5');
INSERT INTO `municipios` VALUES ('49', 'ALTAMIRANO ', '5');
INSERT INTO `municipios` VALUES ('50', 'AMATÁN', '5');
INSERT INTO `municipios` VALUES ('51', 'AMATENANGO DE LA FRONTERA ', '5');
INSERT INTO `municipios` VALUES ('52', 'AMATENANGO DEL VALLE ', '5');
INSERT INTO `municipios` VALUES ('53', 'ANGEL ALBINO CORZO ', '5');
INSERT INTO `municipios` VALUES ('54', 'ARRIAGA ', '5');
INSERT INTO `municipios` VALUES ('55', 'BEJUCAL DE OCAMPO ', '5');
INSERT INTO `municipios` VALUES ('56', 'BELLA VISTA ', '5');
INSERT INTO `municipios` VALUES ('57', 'BENEMÉRITO DE LAS AMÉRICAS ', '5');
INSERT INTO `municipios` VALUES ('58', 'BERRIOZÁBAL ', '5');
INSERT INTO `municipios` VALUES ('59', 'BOCHIL ', '5');
INSERT INTO `municipios` VALUES ('60', 'EL BOSQUE \r\n', '5');
INSERT INTO `municipios` VALUES ('61', 'CACAHOATÁN ', '5');
INSERT INTO `municipios` VALUES ('62', 'CATAZAJÁ ', '5');
INSERT INTO `municipios` VALUES ('63', 'CINTALAPA ', '5');
INSERT INTO `municipios` VALUES ('64', 'COAPILLA ', '5');
INSERT INTO `municipios` VALUES ('65', 'COMITÁN DE DOMÍNGUEZ ', '5');
INSERT INTO `municipios` VALUES ('66', 'LA CONCORDIA ', '5');
INSERT INTO `municipios` VALUES ('67', 'COPAINALÁ ', '5');
INSERT INTO `municipios` VALUES ('68', 'CHALCHIHUITÁN ', '5');
INSERT INTO `municipios` VALUES ('69', 'CHAMULA ', '5');
INSERT INTO `municipios` VALUES ('70', 'CHANAL ', '5');
INSERT INTO `municipios` VALUES ('71', 'CHAPULTENANGO ', '5');
INSERT INTO `municipios` VALUES ('72', 'CHENALHÓ ', '5');
INSERT INTO `municipios` VALUES ('73', 'CHIAPA DE CORZO CORZO ', '5');
INSERT INTO `municipios` VALUES ('74', 'CHIAPILLA ', '5');
INSERT INTO `municipios` VALUES ('75', 'CHICOASÉN ', '5');
INSERT INTO `municipios` VALUES ('76', 'CHICOMUSELO ', '5');
INSERT INTO `municipios` VALUES ('77', 'CHILÓN ', '5');
INSERT INTO `municipios` VALUES ('78', 'ESCUINTLA ', '5');
INSERT INTO `municipios` VALUES ('79', 'FRANCISCO LEÓN ', '5');
INSERT INTO `municipios` VALUES ('80', 'FRONTERA COMALAPA ', '5');
INSERT INTO `municipios` VALUES ('81', 'FRONTERA HIDALGO ', '5');
INSERT INTO `municipios` VALUES ('82', 'LA GRANDEZA ', '5');
INSERT INTO `municipios` VALUES ('83', 'HUHUETÁN ', '5');
INSERT INTO `municipios` VALUES ('84', 'HUIXTÁN ', '5');
INSERT INTO `municipios` VALUES ('85', 'HUITIUPÁN ', '5');
INSERT INTO `municipios` VALUES ('86', 'HUIXTLA ', '5');
INSERT INTO `municipios` VALUES ('87', 'LA INDEPENDENCIA ', '5');
INSERT INTO `municipios` VALUES ('88', 'IXHUATÁN ', '5');
INSERT INTO `municipios` VALUES ('89', 'IXTACOMITÁN ', '5');
INSERT INTO `municipios` VALUES ('90', 'IXTAPA ', '5');
INSERT INTO `municipios` VALUES ('91', 'IXTAPANGAJOYA ', '5');
INSERT INTO `municipios` VALUES ('92', 'JIQUIPILAS JIQUIPILAS ', '5');
INSERT INTO `municipios` VALUES ('93', 'JUÁREZ ', '5');
INSERT INTO `municipios` VALUES ('94', 'LARRÁINZAR ', '5');
INSERT INTO `municipios` VALUES ('95', 'LA LIBERTAD ', '5');
INSERT INTO `municipios` VALUES ('96', 'MAPASTEPEC ', '5');
INSERT INTO `municipios` VALUES ('97', 'MARAVILLA TENEJAPA ', '5');
INSERT INTO `municipios` VALUES ('98', 'MARQUÉS DE COMILLAS ', '5');
INSERT INTO `municipios` VALUES ('99', 'MAZAPA DE MADERO ', '5');
INSERT INTO `municipios` VALUES ('100', 'MAZATÁN ', '5');
INSERT INTO `municipios` VALUES ('101', 'METAPA ', '5');
INSERT INTO `municipios` VALUES ('102', 'MITONTIC ', '5');
INSERT INTO `municipios` VALUES ('103', 'MONTECRISTO DE GUERRERO ', '5');
INSERT INTO `municipios` VALUES ('104', 'MOTOZINTLA ', '5');
INSERT INTO `municipios` VALUES ('105', 'NICOLÁS RUÍZ ', '5');
INSERT INTO `municipios` VALUES ('106', 'OCOSINGO \r\n', '5');
INSERT INTO `municipios` VALUES ('107', 'OCOTEPEC ', '5');
INSERT INTO `municipios` VALUES ('108', 'OCOZOCOAUTLA DE ESPINOSA ', '5');
INSERT INTO `municipios` VALUES ('109', 'OSTUACÁN ', '5');
INSERT INTO `municipios` VALUES ('110', 'OSUMACINTA ', '5');
INSERT INTO `municipios` VALUES ('111', 'OXCHUC ', '5');
INSERT INTO `municipios` VALUES ('112', 'PALENQUE ', '5');
INSERT INTO `municipios` VALUES ('113', 'PANTELHÓ ', '5');
INSERT INTO `municipios` VALUES ('114', 'PANTEPEC ', '5');
INSERT INTO `municipios` VALUES ('115', 'PICHUCALCO ', '5');
INSERT INTO `municipios` VALUES ('116', 'PIJIJIAPAN ', '5');
INSERT INTO `municipios` VALUES ('117', 'EL PORVENIR ', '5');
INSERT INTO `municipios` VALUES ('118', 'PUEBLO NUEVO SOLISTAHUACÁN ', '5');
INSERT INTO `municipios` VALUES ('119', 'RAYÓN ', '5');
INSERT INTO `municipios` VALUES ('120', 'REFORMA ', '5');
INSERT INTO `municipios` VALUES ('121', 'LAS ROSAS ', '5');
INSERT INTO `municipios` VALUES ('122', 'LAS ROSAS ', '5');
INSERT INTO `municipios` VALUES ('123', 'SABANILLA ', '5');
INSERT INTO `municipios` VALUES ('124', 'SALTO DE AGUA ', '5');
INSERT INTO `municipios` VALUES ('125', 'SAN ANDRÉS DURAZNAL ', '5');
INSERT INTO `municipios` VALUES ('126', 'SAN CRISTOBAL DE LAS CASAS ', '5');
INSERT INTO `municipios` VALUES ('127', 'SAN FERNANDO ', '5');
INSERT INTO `municipios` VALUES ('128', 'SAN JUAN CANCUC ', '5');
INSERT INTO `municipios` VALUES ('129', 'SAN LUCAS ', '5');
INSERT INTO `municipios` VALUES ('130', 'SANTIAGO EL PINAR ', '5');
INSERT INTO `municipios` VALUES ('131', 'SILTEPEC ', '5');
INSERT INTO `municipios` VALUES ('132', 'SIMOJOVEL ', '5');
INSERT INTO `municipios` VALUES ('133', 'SITALÁ ', '5');
INSERT INTO `municipios` VALUES ('134', 'SOCOLTENANGO ', '5');
INSERT INTO `municipios` VALUES ('135', 'SOLOSUCHIAPA ', '5');
INSERT INTO `municipios` VALUES ('136', 'SOYALÓ ', '5');
INSERT INTO `municipios` VALUES ('137', 'SUCHIAPA ', '5');
INSERT INTO `municipios` VALUES ('138', 'SUCHIATE ', '5');
INSERT INTO `municipios` VALUES ('139', 'SUNUAPA ', '5');
INSERT INTO `municipios` VALUES ('140', 'TAPACHULA ', '5');
INSERT INTO `municipios` VALUES ('141', 'TAPALAPA ', '5');
INSERT INTO `municipios` VALUES ('142', 'TAPILULA ', '5');
INSERT INTO `municipios` VALUES ('143', 'TECPATÁN ', '5');
INSERT INTO `municipios` VALUES ('144', 'TENEJAPA ', '5');
INSERT INTO `municipios` VALUES ('145', 'TEOPISCA ', '5');
INSERT INTO `municipios` VALUES ('146', 'TILA ', '5');
INSERT INTO `municipios` VALUES ('147', 'TONALÁ ', '5');
INSERT INTO `municipios` VALUES ('148', 'TOTOLAPA ', '5');
INSERT INTO `municipios` VALUES ('149', 'LA TRINITARIA ', '5');
INSERT INTO `municipios` VALUES ('150', 'TUMBALÁ ', '5');
INSERT INTO `municipios` VALUES ('151', 'TUXTLA GUTIÉRREZ ', '5');
INSERT INTO `municipios` VALUES ('152', 'TUXTLA CHICO ', '5');
INSERT INTO `municipios` VALUES ('153', 'TUZANTÁN ', '5');
INSERT INTO `municipios` VALUES ('154', 'TZIMOL ', '5');
INSERT INTO `municipios` VALUES ('155', 'UNIÓN JUÁREZ ', '5');
INSERT INTO `municipios` VALUES ('156', 'VENUSTIANO CARRANZA ', '5');
INSERT INTO `municipios` VALUES ('157', 'VILLA COMALTITLÁN ', '5');
INSERT INTO `municipios` VALUES ('158', 'VILLA CORZO ', '5');
INSERT INTO `municipios` VALUES ('159', 'VILLAFLORES ', '5');
INSERT INTO `municipios` VALUES ('160', 'YAJALÓN ', '5');
INSERT INTO `municipios` VALUES ('161', 'ZINACANTÁN ', '5');
INSERT INTO `municipios` VALUES ('162', 'AHUMADA', '6');
INSERT INTO `municipios` VALUES ('163', 'ALDAMA', '6');
INSERT INTO `municipios` VALUES ('164', 'ALLENDE', '6');
INSERT INTO `municipios` VALUES ('165', 'AQUILES SERDÁNSERDÁN', '6');
INSERT INTO `municipios` VALUES ('166', 'ASCENSIÓN', '6');
INSERT INTO `municipios` VALUES ('167', 'BACHÍNIVA', '6');
INSERT INTO `municipios` VALUES ('168', 'BALLEZA', '6');
INSERT INTO `municipios` VALUES ('169', 'BATOPILAS', '6');
INSERT INTO `municipios` VALUES ('170', 'BOCOYNA', '6');
INSERT INTO `municipios` VALUES ('171', 'BUENAVENTURA', '66');
INSERT INTO `municipios` VALUES ('172', 'CAMARGO', '6');
INSERT INTO `municipios` VALUES ('173', 'CARICHI', '6');
INSERT INTO `municipios` VALUES ('174', 'CASAS GRANDES', '6');
INSERT INTO `municipios` VALUES ('175', 'CORONADO', '6');
INSERT INTO `municipios` VALUES ('176', 'COYAME DEL SOTOL', '6');
INSERT INTO `municipios` VALUES ('177', 'LA CRUZ', '6');
INSERT INTO `municipios` VALUES ('178', 'CUAUHTÉMOC', '6');
INSERT INTO `municipios` VALUES ('179', 'CUSIHUIRIÁCHI', '6');
INSERT INTO `municipios` VALUES ('180', 'CHIHUAHUA', '6');
INSERT INTO `municipios` VALUES ('181', 'CHÍNIPAS', '6');
INSERT INTO `municipios` VALUES ('182', 'DELICIAS', '6');
INSERT INTO `municipios` VALUES ('183', 'DR. BELISARIO DOMÍNGUEZ', '6');
INSERT INTO `municipios` VALUES ('184', 'GALEANA', '6');
INSERT INTO `municipios` VALUES ('185', 'SANTA ISABEL', '6');
INSERT INTO `municipios` VALUES ('186', 'GÓMEZ FARÍAS', '6');
INSERT INTO `municipios` VALUES ('187', 'GRAN MORELOS', '6');
INSERT INTO `municipios` VALUES ('188', 'GUACHOCHI', '6');
INSERT INTO `municipios` VALUES ('189', 'GUADALUPE D.B.', '6');
INSERT INTO `municipios` VALUES ('190', 'GUADALUPE Y CALVO', '6');
INSERT INTO `municipios` VALUES ('191', 'GUAZAPARES', '6');
INSERT INTO `municipios` VALUES ('192', 'GUERRERO', '6');
INSERT INTO `municipios` VALUES ('193', 'HIDALGO DEL PARRAL', '6');
INSERT INTO `municipios` VALUES ('194', 'HUEJOTITÁN', '6');
INSERT INTO `municipios` VALUES ('195', 'IGNACIO ZARAGOZA', '6');
INSERT INTO `municipios` VALUES ('196', 'JANOS', '6');
INSERT INTO `municipios` VALUES ('197', 'JIMÉNEZ', '6');
INSERT INTO `municipios` VALUES ('198', 'JUÁREZ', '6');
INSERT INTO `municipios` VALUES ('199', 'JULIMES', '6');
INSERT INTO `municipios` VALUES ('200', 'LÓPEZ', '6');
INSERT INTO `municipios` VALUES ('201', 'MADERA', '6');
INSERT INTO `municipios` VALUES ('202', 'MAGUARICHI', '6');
INSERT INTO `municipios` VALUES ('203', 'MANUEL BENAVIDES', '6');
INSERT INTO `municipios` VALUES ('204', 'MATACHI', '6');
INSERT INTO `municipios` VALUES ('205', 'MATAMOROS', '6');
INSERT INTO `municipios` VALUES ('206', 'MEOQUI', '6');
INSERT INTO `municipios` VALUES ('207', 'MORELOS', '6');
INSERT INTO `municipios` VALUES ('208', 'MORIS', '6');
INSERT INTO `municipios` VALUES ('209', 'NAMIQUIPA', '6');
INSERT INTO `municipios` VALUES ('210', 'NONOAVA', '6');
INSERT INTO `municipios` VALUES ('211', 'NUEVO CASAS GRANDES', '6');
INSERT INTO `municipios` VALUES ('212', 'OCAMPO', '6');
INSERT INTO `municipios` VALUES ('213', 'OJINAGA', '6');
INSERT INTO `municipios` VALUES ('214', 'PRAXEDIS G. GUERRERO', '6');
INSERT INTO `municipios` VALUES ('215', 'RIVA PALACIO', '6');
INSERT INTO `municipios` VALUES ('216', 'ROSALES', '6');
INSERT INTO `municipios` VALUES ('217', 'ROSARIO', '6');
INSERT INTO `municipios` VALUES ('218', 'SAN FRANCISCO DE BORJA', '6');
INSERT INTO `municipios` VALUES ('219', 'SAN FRANCISCO DE CONCHOS', '6');
INSERT INTO `municipios` VALUES ('220', 'SAN FRANCISCO DEL ORO', '6');
INSERT INTO `municipios` VALUES ('221', 'SANTA BÁRBARA', '6');
INSERT INTO `municipios` VALUES ('222', 'SATEVÓ', '6');
INSERT INTO `municipios` VALUES ('223', 'SAUCILLO', '6');
INSERT INTO `municipios` VALUES ('224', 'TEMÓSACHI', '6');
INSERT INTO `municipios` VALUES ('225', 'EL TULE', '6');
INSERT INTO `municipios` VALUES ('226', 'URIQUE', '6');
INSERT INTO `municipios` VALUES ('227', 'URUÁCHI', '6');
INSERT INTO `municipios` VALUES ('228', 'VALLE DE ZARAGOZA', '6');
INSERT INTO `municipios` VALUES ('229', 'ABASOLO', '7');
INSERT INTO `municipios` VALUES ('230', 'ACUÑA', '7');
INSERT INTO `municipios` VALUES ('231', 'ALLENDE', '7');
INSERT INTO `municipios` VALUES ('232', 'ARTEAGA', '7');
INSERT INTO `municipios` VALUES ('233', 'CANDELA', '7');
INSERT INTO `municipios` VALUES ('234', 'CASTAÑOS', '7');
INSERT INTO `municipios` VALUES ('235', 'CUATROCIENEGAS', '7');
INSERT INTO `municipios` VALUES ('236', 'ESCOBEDO', '7');
INSERT INTO `municipios` VALUES ('237', 'FRANCISCO I. MADERO', '7');
INSERT INTO `municipios` VALUES ('238', 'FRONTERA', '7');
INSERT INTO `municipios` VALUES ('239', 'GENERAL CEPEDA', '7');
INSERT INTO `municipios` VALUES ('240', 'GUERRERO', '7');
INSERT INTO `municipios` VALUES ('241', 'HIDALGO', '7');
INSERT INTO `municipios` VALUES ('242', 'JIMENEZ', '7');
INSERT INTO `municipios` VALUES ('243', 'JUAREZ', '7');
INSERT INTO `municipios` VALUES ('244', 'LAMADRID', '7');
INSERT INTO `municipios` VALUES ('245', 'MATAMOROS', '7');
INSERT INTO `municipios` VALUES ('246', 'MONCLOVA', '7');
INSERT INTO `municipios` VALUES ('247', 'MORELOS', '7');
INSERT INTO `municipios` VALUES ('248', 'SAN BUENAVENTURA', '7');
INSERT INTO `municipios` VALUES ('249', 'SAN JUAN DE SABINAS', '7');
INSERT INTO `municipios` VALUES ('250', 'SAN PEDRO', '7');
INSERT INTO `municipios` VALUES ('251', 'SIERRA MOJADA', '7');
INSERT INTO `municipios` VALUES ('252', 'TORREON', '7');
INSERT INTO `municipios` VALUES ('253', 'VIESCA', '7');
INSERT INTO `municipios` VALUES ('254', ' VILLA UNION', '7');
INSERT INTO `municipios` VALUES ('255', 'ARMERÍA', '8');
INSERT INTO `municipios` VALUES ('256', 'COLIMA', '8');
INSERT INTO `municipios` VALUES ('257', 'COMALA', '8');
INSERT INTO `municipios` VALUES ('258', 'COQUIMATLÁN', '8');
INSERT INTO `municipios` VALUES ('259', 'CUAUHTÉMOC', '8');
INSERT INTO `municipios` VALUES ('260', 'IXTLAHUACÁN', '8');
INSERT INTO `municipios` VALUES ('261', 'MANZANILLO', '8');
INSERT INTO `municipios` VALUES ('262', 'MINATITLÁN', '8');
INSERT INTO `municipios` VALUES ('263', 'TECOMÁN', '8');
INSERT INTO `municipios` VALUES ('264', 'VILLA DE ÁLVAREZ', '8');
INSERT INTO `municipios` VALUES ('2579', 'Azcapotzalco', '9');
INSERT INTO `municipios` VALUES ('2578', 'Alvaro Obregón', '9');
INSERT INTO `municipios` VALUES ('2580', 'Benito Juárez', '9');
INSERT INTO `municipios` VALUES ('270', 'CANATLÁN', '10');
INSERT INTO `municipios` VALUES ('271', 'CANELAS', '10');
INSERT INTO `municipios` VALUES ('272', 'CONETO DE COMONFORT', '10');
INSERT INTO `municipios` VALUES ('273', 'CUENCAMÉ', '10');
INSERT INTO `municipios` VALUES ('274', 'DURANGO', '10');
INSERT INTO `municipios` VALUES ('275', 'GENERAL SIMÓN BOLÍVAR', '10');
INSERT INTO `municipios` VALUES ('276', 'GÓMEZ PALACIO', '10');
INSERT INTO `municipios` VALUES ('277', 'GUADALUPE VICTORIA', '10');
INSERT INTO `municipios` VALUES ('278', 'GUANACEVÍ', '10');
INSERT INTO `municipios` VALUES ('279', 'HIDALGO', '10');
INSERT INTO `municipios` VALUES ('280', 'INDÉ', '10');
INSERT INTO `municipios` VALUES ('281', 'CIUDAD LERDO', '10');
INSERT INTO `municipios` VALUES ('282', 'MAPIMÍ', '10');
INSERT INTO `municipios` VALUES ('283', 'MEZQUITAL', '10');
INSERT INTO `municipios` VALUES ('284', 'NAZAS', '10');
INSERT INTO `municipios` VALUES ('285', 'NOMBRE DE DIOS', '10');
INSERT INTO `municipios` VALUES ('286', 'OCAMPO', '10');
INSERT INTO `municipios` VALUES ('287', 'ORO, EL', '10');
INSERT INTO `municipios` VALUES ('288', 'OTÁEZ', '10');
INSERT INTO `municipios` VALUES ('289', 'PÁNUCO DE CORONADO', '10');
INSERT INTO `municipios` VALUES ('290', 'PEÑÓN BLANCO', '10');
INSERT INTO `municipios` VALUES ('291', 'POANAS', '10');
INSERT INTO `municipios` VALUES ('292', 'PUEBLO NUEVO', '10');
INSERT INTO `municipios` VALUES ('293', 'RODEO', '10');
INSERT INTO `municipios` VALUES ('294', 'SAN BERNARDO', '10');
INSERT INTO `municipios` VALUES ('295', 'SAN DIMAS', '10');
INSERT INTO `municipios` VALUES ('296', 'SAN JUAN DE GUADALUPE', '10');
INSERT INTO `municipios` VALUES ('297', 'SAN JUAN DEL RÍO', '10');
INSERT INTO `municipios` VALUES ('298', 'SAN LUIS DEL CORDERO', '10');
INSERT INTO `municipios` VALUES ('299', 'SAN PEDRO DEL GALLO', '10');
INSERT INTO `municipios` VALUES ('300', 'SANTIAGO PAPASQUIARO', '10');
INSERT INTO `municipios` VALUES ('301', 'SÚCHIL', '10');
INSERT INTO `municipios` VALUES ('302', 'TAMAZULA', '10');
INSERT INTO `municipios` VALUES ('303', 'TEPEHUANES', '10');
INSERT INTO `municipios` VALUES ('304', 'TLAHUALILO', '10');
INSERT INTO `municipios` VALUES ('305', 'TOPIA', '10');
INSERT INTO `municipios` VALUES ('306', 'VICENTE GUERRERO', '10');
INSERT INTO `municipios` VALUES ('307', 'NUEVO IDEAL', '10');
INSERT INTO `municipios` VALUES ('308', 'SANTA CLARA', '10');
INSERT INTO `municipios` VALUES ('309', 'SANTIAGO PAPASQUIARO', '10');
INSERT INTO `municipios` VALUES ('310', 'SÚCHIL', '10');
INSERT INTO `municipios` VALUES ('311', 'TAMAZULA', '10');
INSERT INTO `municipios` VALUES ('312', 'TEPEHUANES', '10');
INSERT INTO `municipios` VALUES ('313', 'TLAHUALILO', '10');
INSERT INTO `municipios` VALUES ('314', 'TOPIA', '10');
INSERT INTO `municipios` VALUES ('315', 'VICENTE GUERRERO', '10');
INSERT INTO `municipios` VALUES ('316', 'NUEVO IDEAL', '10');
INSERT INTO `municipios` VALUES ('322', 'ACULCO', '11');
INSERT INTO `municipios` VALUES ('321', 'ACOLMAN', '11');
INSERT INTO `municipios` VALUES ('320', 'ACAMBAY', '11');
INSERT INTO `municipios` VALUES ('323', 'ALMOLOYA DE ALQUISIRAS', '11');
INSERT INTO `municipios` VALUES ('324', 'ALMOLOYA DE  JUÁREZ', '11');
INSERT INTO `municipios` VALUES ('325', 'ALMOLOYA DEL RÍO', '11');
INSERT INTO `municipios` VALUES ('326', 'AMANALCO', '11');
INSERT INTO `municipios` VALUES ('327', 'AMATEPEC', '11');
INSERT INTO `municipios` VALUES ('328', 'AMECAMECA', '11');
INSERT INTO `municipios` VALUES ('329', 'APAXCO', '11');
INSERT INTO `municipios` VALUES ('330', 'ATENCO', '11');
INSERT INTO `municipios` VALUES ('331', 'ATIZAPÁN', '11');
INSERT INTO `municipios` VALUES ('332', 'ATIZAPÁN DE ZARAGOZA', '11');
INSERT INTO `municipios` VALUES ('333', 'ATLACOMULCO', '11');
INSERT INTO `municipios` VALUES ('334', 'ATLAUTLA', '11');
INSERT INTO `municipios` VALUES ('335', 'AXAPUSCO', '11');
INSERT INTO `municipios` VALUES ('336', 'AYAPANGO', '11');
INSERT INTO `municipios` VALUES ('337', 'CALIMAYA', '11');
INSERT INTO `municipios` VALUES ('338', 'CAPULHUAC', '11');
INSERT INTO `municipios` VALUES ('339', 'COACALCO DE BERRIOZÁBAL', '11');
INSERT INTO `municipios` VALUES ('340', 'COATEPEC HARINAS', '11');
INSERT INTO `municipios` VALUES ('341', 'COCOTITLÁN', '11');
INSERT INTO `municipios` VALUES ('342', 'COYOTEPEC', '11');
INSERT INTO `municipios` VALUES ('343', 'CUAUTITLÁN', '11');
INSERT INTO `municipios` VALUES ('344', 'CHALCO', '11');
INSERT INTO `municipios` VALUES ('345', 'CHAPA DE MOTA', '11');
INSERT INTO `municipios` VALUES ('346', 'CHAPULTEPEC', '11');
INSERT INTO `municipios` VALUES ('347', 'CHIAUTLA', '11');
INSERT INTO `municipios` VALUES ('348', 'CHICOLOAPAN', '11');
INSERT INTO `municipios` VALUES ('349', 'CHICONCUAC', '11');
INSERT INTO `municipios` VALUES ('350', 'CHIMALHUACÁN', '11');
INSERT INTO `municipios` VALUES ('351', 'DONATO GUERRA', '11');
INSERT INTO `municipios` VALUES ('352', 'ECATEPEC', '11');
INSERT INTO `municipios` VALUES ('353', 'ECATZINGO', '11');
INSERT INTO `municipios` VALUES ('354', 'HUEYPOXTLA', '11');
INSERT INTO `municipios` VALUES ('355', 'HUIXQUILUCAN', '11');
INSERT INTO `municipios` VALUES ('356', 'ISIDRO FABELA', '11');
INSERT INTO `municipios` VALUES ('357', 'IXTAPALUCA', '11');
INSERT INTO `municipios` VALUES ('358', 'IXTAPAN DE LA SAL', '11');
INSERT INTO `municipios` VALUES ('359', 'IXTAPAN DEL ORO', '11');
INSERT INTO `municipios` VALUES ('360', 'IXTLAHUACA', '11');
INSERT INTO `municipios` VALUES ('361', 'XALATLACO', '11');
INSERT INTO `municipios` VALUES ('362', 'JALTENCO', '11');
INSERT INTO `municipios` VALUES ('363', 'JILOTEPEC', '11');
INSERT INTO `municipios` VALUES ('364', 'JILOTZINGO', '11');
INSERT INTO `municipios` VALUES ('365', 'JIQUIPILCO', '11');
INSERT INTO `municipios` VALUES ('366', 'JOCOTITLÁN', '11');
INSERT INTO `municipios` VALUES ('367', 'JOQUICINGO', '11');
INSERT INTO `municipios` VALUES ('368', 'JUCHITEPEC', '11');
INSERT INTO `municipios` VALUES ('369', 'LERMA', '11');
INSERT INTO `municipios` VALUES ('370', 'MALINALCO', '11');
INSERT INTO `municipios` VALUES ('371', 'MELCHOR OCAMPO', '11');
INSERT INTO `municipios` VALUES ('372', 'METEPEC', '11');
INSERT INTO `municipios` VALUES ('373', 'MEXICALTZINGO', '11');
INSERT INTO `municipios` VALUES ('374', 'MORELOS', '11');
INSERT INTO `municipios` VALUES ('375', 'NAUCALPAN DE JUÁREZ', '11');
INSERT INTO `municipios` VALUES ('376', 'NEZAHUALCÓYOTL', '11');
INSERT INTO `municipios` VALUES ('377', 'NEXTLALPAN', '11');
INSERT INTO `municipios` VALUES ('378', 'NICOLÁS ROMERO', '11');
INSERT INTO `municipios` VALUES ('379', 'NOPALTEPEC', '11');
INSERT INTO `municipios` VALUES ('380', 'OCOYOACAC', '11');
INSERT INTO `municipios` VALUES ('381', 'OCUILAN', '11');
INSERT INTO `municipios` VALUES ('382', 'EL ORO', '11');
INSERT INTO `municipios` VALUES ('383', 'OTUMBA', '11');
INSERT INTO `municipios` VALUES ('384', 'OTZOLOAPAN', '11');
INSERT INTO `municipios` VALUES ('385', 'OTZOLOTEPEC', '11');
INSERT INTO `municipios` VALUES ('386', 'OZUMBA', '11');
INSERT INTO `municipios` VALUES ('387', 'PAPALOTLA', '11');
INSERT INTO `municipios` VALUES ('388', 'LA PAZ', '11');
INSERT INTO `municipios` VALUES ('389', 'POLOTITLÁN', '11');
INSERT INTO `municipios` VALUES ('390', 'RAYÓN', '11');
INSERT INTO `municipios` VALUES ('391', 'SAN ANTONIO LA ISLA', '11');
INSERT INTO `municipios` VALUES ('392', 'SAN FELIPE DEL PROGRESO', '11');
INSERT INTO `municipios` VALUES ('393', 'SAN MARTÍN DE LAS PIRÁMIDES', '11');
INSERT INTO `municipios` VALUES ('394', 'SAN MATEO ATENCO', '11');
INSERT INTO `municipios` VALUES ('395', 'SAN SIMÓN DE GUERRERO', '11');
INSERT INTO `municipios` VALUES ('396', 'SANTO TOMÁS', '11');
INSERT INTO `municipios` VALUES ('397', 'SOYANIQUILPAN DE JUÁREZ', '11');
INSERT INTO `municipios` VALUES ('398', 'SULTEPEC', '11');
INSERT INTO `municipios` VALUES ('399', 'TECÁMAC', '11');
INSERT INTO `municipios` VALUES ('400', 'TEJUPILCO', '11');
INSERT INTO `municipios` VALUES ('401', 'TEMAMATLA', '11');
INSERT INTO `municipios` VALUES ('402', 'TEMASCALAPA', '11');
INSERT INTO `municipios` VALUES ('403', 'TEMASCALCINGO', '11');
INSERT INTO `municipios` VALUES ('404', 'TEMASCALTEPEC', '11');
INSERT INTO `municipios` VALUES ('405', 'TEMOAYA', '11');
INSERT INTO `municipios` VALUES ('406', 'TENANCINGO', '11');
INSERT INTO `municipios` VALUES ('407', 'TENANGO DEL AIRE', '11');
INSERT INTO `municipios` VALUES ('408', 'TENANGO DEL VALLE', '11');
INSERT INTO `municipios` VALUES ('409', 'TEOLOYUCAN', '11');
INSERT INTO `municipios` VALUES ('410', 'TEOTIHUACÁN', '11');
INSERT INTO `municipios` VALUES ('411', 'TEPETLAOXTOC', '11');
INSERT INTO `municipios` VALUES ('412', 'TEPETLIXPA', '11');
INSERT INTO `municipios` VALUES ('413', 'TEPOTZOTLÁN', '11');
INSERT INTO `municipios` VALUES ('414', 'TEQUIXQUIAC', '11');
INSERT INTO `municipios` VALUES ('415', 'TEXCALTITLÁN', '11');
INSERT INTO `municipios` VALUES ('416', 'TEXCALYACAC', '11');
INSERT INTO `municipios` VALUES ('417', 'TEXCOCO', '11');
INSERT INTO `municipios` VALUES ('418', 'TEZOYUCA', '11');
INSERT INTO `municipios` VALUES ('419', 'TIANGUISTENCO', '11');
INSERT INTO `municipios` VALUES ('420', 'TIMILPAN', '11');
INSERT INTO `municipios` VALUES ('421', 'TLALMANALCO', '11');
INSERT INTO `municipios` VALUES ('422', 'TLALNEPANTLA DE BAZ', '11');
INSERT INTO `municipios` VALUES ('423', 'TLATLAYA', '11');
INSERT INTO `municipios` VALUES ('424', 'TOLUCA', '11');
INSERT INTO `municipios` VALUES ('425', 'TONATICO', '11');
INSERT INTO `municipios` VALUES ('426', 'TULTEPEC', '11');
INSERT INTO `municipios` VALUES ('427', 'TULTITLÁN', '11');
INSERT INTO `municipios` VALUES ('428', 'VALLE DE BRAVO', '11');
INSERT INTO `municipios` VALUES ('429', 'VILLA DE ALLENDE', '11');
INSERT INTO `municipios` VALUES ('430', 'VILLA DEL CARBÓN', '11');
INSERT INTO `municipios` VALUES ('431', 'VILLA GUERRERO', '11');
INSERT INTO `municipios` VALUES ('432', 'VILLA VICTORIA', '11');
INSERT INTO `municipios` VALUES ('433', 'XONACATLÁN', '11');
INSERT INTO `municipios` VALUES ('434', 'ZACAZONAPAN', '11');
INSERT INTO `municipios` VALUES ('435', 'ZACUALPAN', '11');
INSERT INTO `municipios` VALUES ('436', 'ZINACANTEPEC', '11');
INSERT INTO `municipios` VALUES ('437', 'ZUMPAHUACÁN', '11');
INSERT INTO `municipios` VALUES ('438', 'ZUMPANGO', '11');
INSERT INTO `municipios` VALUES ('439', 'CUAUTITLÁN IZCALLI', '11');
INSERT INTO `municipios` VALUES ('440', 'VALLE DE CHALCO SOLIDARIDAD', '11');
INSERT INTO `municipios` VALUES ('441', 'LUVIANOS', '11');
INSERT INTO `municipios` VALUES ('442', 'SAN JOSÉ DEL RINCÓN', '11');
INSERT INTO `municipios` VALUES ('443', 'SANTA MARÍA TONANITLA', '11');
INSERT INTO `municipios` VALUES ('444', 'ABASOLO', '12');
INSERT INTO `municipios` VALUES ('445', 'ACAMBARO', '12');
INSERT INTO `municipios` VALUES ('446', 'ALLENDE', '12');
INSERT INTO `municipios` VALUES ('447', 'APASEO EL ALTO', '12');
INSERT INTO `municipios` VALUES ('448', 'ATARJEA', '12');
INSERT INTO `municipios` VALUES ('449', 'CELAYA', '12');
INSERT INTO `municipios` VALUES ('450', 'MANUEL DOBLADO', '12');
INSERT INTO `municipios` VALUES ('451', 'COMONFORT', '12');
INSERT INTO `municipios` VALUES ('452', 'CORONEO', '12');
INSERT INTO `municipios` VALUES ('453', 'CORTAZAR', '12');
INSERT INTO `municipios` VALUES ('454', 'CUERAMARO', '12');
INSERT INTO `municipios` VALUES ('455', 'DOCTOR MORA', '12');
INSERT INTO `municipios` VALUES ('456', 'DOLORES HIDALGO', '12');
INSERT INTO `municipios` VALUES ('457', 'GUANAJUATO', '12');
INSERT INTO `municipios` VALUES ('458', 'HUANIMARO', '12');
INSERT INTO `municipios` VALUES ('459', 'IRAPUATO', '12');
INSERT INTO `municipios` VALUES ('460', 'JARAL DEL PROGRESO', '12');
INSERT INTO `municipios` VALUES ('461', 'JERECUARO', '12');
INSERT INTO `municipios` VALUES ('462', 'LEON', '12');
INSERT INTO `municipios` VALUES ('463', 'MOROLEON', '12');
INSERT INTO `municipios` VALUES ('464', 'OCAMPO', '12');
INSERT INTO `municipios` VALUES ('465', 'PENJAMO', '12');
INSERT INTO `municipios` VALUES ('466', 'PUEBLO NUEVO', '12');
INSERT INTO `municipios` VALUES ('467', 'PURISIMA DEL RINCON', '12');
INSERT INTO `municipios` VALUES ('468', 'ROMITA', '12');
INSERT INTO `municipios` VALUES ('469', 'SALAMANCA', '12');
INSERT INTO `municipios` VALUES ('470', 'SALVATIERRA', '12');
INSERT INTO `municipios` VALUES ('471', 'SAN DIEGO DE LA UNION', '12');
INSERT INTO `municipios` VALUES ('472', 'SAN FELIPE', '12');
INSERT INTO `municipios` VALUES ('473', 'SAN FRANCISCO DEL RINCON', '12');
INSERT INTO `municipios` VALUES ('474', 'SAN JOSE ITURBIDE', '12');
INSERT INTO `municipios` VALUES ('475', 'SAN LUIS DE LA PAZ', '12');
INSERT INTO `municipios` VALUES ('476', 'SANTA CATARINA', '12');
INSERT INTO `municipios` VALUES ('477', 'SANTA CRUZ DE JUVENTINO ROSAS', '12');
INSERT INTO `municipios` VALUES ('478', 'SANTIAGO MARAVATIO', '12');
INSERT INTO `municipios` VALUES ('479', 'SILAO', '12');
INSERT INTO `municipios` VALUES ('480', 'TARANDACUAO', '12');
INSERT INTO `municipios` VALUES ('481', 'TARIMORO', '12');
INSERT INTO `municipios` VALUES ('482', 'TIERRA BLANCA', '12');
INSERT INTO `municipios` VALUES ('483', 'URIANGATO', '12');
INSERT INTO `municipios` VALUES ('484', 'VALLE DE SANTIAGO', '12');
INSERT INTO `municipios` VALUES ('485', 'VICTORIA', '12');
INSERT INTO `municipios` VALUES ('486', 'VILLAGRAN', '12');
INSERT INTO `municipios` VALUES ('487', 'XICHU', '12');
INSERT INTO `municipios` VALUES ('488', 'YURIRIA', '12');
INSERT INTO `municipios` VALUES ('489', 'Acapulco de Juárez  ', '13');
INSERT INTO `municipios` VALUES ('490', 'Acatepec ', '13');
INSERT INTO `municipios` VALUES ('491', 'Ahuacuotzingo ', '13');
INSERT INTO `municipios` VALUES ('492', 'Ajuchitlan del Progreso ', '13');
INSERT INTO `municipios` VALUES ('493', 'Alcozauca de Guerrero ', '13');
INSERT INTO `municipios` VALUES ('494', 'Alpoyeca ', '13');
INSERT INTO `municipios` VALUES ('495', 'Apaxtla ', '13');
INSERT INTO `municipios` VALUES ('496', 'Arcelia ', '13');
INSERT INTO `municipios` VALUES ('497', 'Atenango del Río ', '13');
INSERT INTO `municipios` VALUES ('498', 'Atlamajalcingo del Monte ', '13');
INSERT INTO `municipios` VALUES ('499', 'Atlixtac ', '13');
INSERT INTO `municipios` VALUES ('500', 'Atoyac de Álvarez ', '13');
INSERT INTO `municipios` VALUES ('501', 'Ayutla ', '13');
INSERT INTO `municipios` VALUES ('502', 'Azoyú ', '13');
INSERT INTO `municipios` VALUES ('503', 'Benito Juárez ', '13');
INSERT INTO `municipios` VALUES ('504', 'Buenavista de Cuéllar ', '13');
INSERT INTO `municipios` VALUES ('505', 'Chilapa de Álvarez ', '13');
INSERT INTO `municipios` VALUES ('506', 'Chilpancingo de los Bravo ', '13');
INSERT INTO `municipios` VALUES ('507', 'Coahuayutla de José María Izazaga ', '13');
INSERT INTO `municipios` VALUES ('508', 'Cochoapa el Grande', '13');
INSERT INTO `municipios` VALUES ('509', 'Cocula ', '13');
INSERT INTO `municipios` VALUES ('510', 'Copala ', '13');
INSERT INTO `municipios` VALUES ('511', 'Copalillo ', '13');
INSERT INTO `municipios` VALUES ('512', 'Copanatoyac  ', '13');
INSERT INTO `municipios` VALUES ('513', 'Coyuca de Benítez ', '13');
INSERT INTO `municipios` VALUES ('514', 'Coyuca de Catalán ', '13');
INSERT INTO `municipios` VALUES ('515', 'Cuajinicuilapa ', '13');
INSERT INTO `municipios` VALUES ('516', 'Cualác ', '13');
INSERT INTO `municipios` VALUES ('517', 'Cuautepec ', '13');
INSERT INTO `municipios` VALUES ('518', 'Cuetzala del Progreso ', '13');
INSERT INTO `municipios` VALUES ('519', 'Cutzamala de Pinzón ', '13');
INSERT INTO `municipios` VALUES ('520', 'Eduardo Neri ', '13');
INSERT INTO `municipios` VALUES ('521', 'Florencio Villarreal ', '13');
INSERT INTO `municipios` VALUES ('522', 'General Canuto A. Neri ', '13');
INSERT INTO `municipios` VALUES ('523', 'General Heliodoro Castillo ', '13');
INSERT INTO `municipios` VALUES ('524', 'Huamuxtitlán ', '13');
INSERT INTO `municipios` VALUES ('525', 'Huitzuco de los Figueroa ', '13');
INSERT INTO `municipios` VALUES ('526', 'Iguala ', '13');
INSERT INTO `municipios` VALUES ('527', 'Igualapa ', '13');
INSERT INTO `municipios` VALUES ('528', 'Iliatenco', '13');
INSERT INTO `municipios` VALUES ('529', 'Ixcateopan de Cuauhtémoc ', '13');
INSERT INTO `municipios` VALUES ('530', 'José Joaquín de Herrera', '13');
INSERT INTO `municipios` VALUES ('531', 'Juan R. Escudero  ', '13');
INSERT INTO `municipios` VALUES ('532', 'Juchitán', '13');
INSERT INTO `municipios` VALUES ('533', 'La Unión ', '13');
INSERT INTO `municipios` VALUES ('534', 'Leonardo Bravo ', '13');
INSERT INTO `municipios` VALUES ('535', 'Malinaltepec ', '13');
INSERT INTO `municipios` VALUES ('536', 'Marquelia', '13');
INSERT INTO `municipios` VALUES ('537', 'Mártir de Cuilapan ', '13');
INSERT INTO `municipios` VALUES ('538', 'Metlatónoc ', '13');
INSERT INTO `municipios` VALUES ('539', 'Mochitlán ', '13');
INSERT INTO `municipios` VALUES ('540', 'Olinalá ', '13');
INSERT INTO `municipios` VALUES ('541', 'Ometepec ', '13');
INSERT INTO `municipios` VALUES ('542', 'Pedro Ascencio Alquisiras ', '13');
INSERT INTO `municipios` VALUES ('543', 'Petatlán ', '13');
INSERT INTO `municipios` VALUES ('544', 'Pilcaya ', '13');
INSERT INTO `municipios` VALUES ('545', 'Pungarabato ', '13');
INSERT INTO `municipios` VALUES ('546', 'Quechultenango ', '13');
INSERT INTO `municipios` VALUES ('547', 'San Luis Acatlán ', '13');
INSERT INTO `municipios` VALUES ('548', 'San Marcos ', '13');
INSERT INTO `municipios` VALUES ('549', 'San Miguel Totolapan ', '13');
INSERT INTO `municipios` VALUES ('550', 'Taxco de Alarcón ', '13');
INSERT INTO `municipios` VALUES ('551', 'Tecoanapa ', '13');
INSERT INTO `municipios` VALUES ('552', 'Tecpan de Galeana ', '13');
INSERT INTO `municipios` VALUES ('553', 'Teloloapan  ', '13');
INSERT INTO `municipios` VALUES ('554', 'Teniente José Azueta ', '13');
INSERT INTO `municipios` VALUES ('555', 'Tepecoacuilco de Trujano ', '13');
INSERT INTO `municipios` VALUES ('556', 'Tetipac ', '13');
INSERT INTO `municipios` VALUES ('557', 'Tixtla de Guerrero ', '13');
INSERT INTO `municipios` VALUES ('558', 'Tlacoachistlahuaca ', '13');
INSERT INTO `municipios` VALUES ('559', 'Tlacoapa ', '13');
INSERT INTO `municipios` VALUES ('560', 'Tlalchapa ', '13');
INSERT INTO `municipios` VALUES ('561', 'Tlalixtaquilla ', '13');
INSERT INTO `municipios` VALUES ('562', 'Tlapa de Comonfort ', '13');
INSERT INTO `municipios` VALUES ('563', 'Tlapehuala ', '13');
INSERT INTO `municipios` VALUES ('564', 'Xalpatláhuac ', '13');
INSERT INTO `municipios` VALUES ('565', 'Xochihuehuetlán ', '13');
INSERT INTO `municipios` VALUES ('566', 'Xochistlahuaca ', '13');
INSERT INTO `municipios` VALUES ('567', 'Zapotitlán Tablas ', '13');
INSERT INTO `municipios` VALUES ('568', 'Zirándaro de los Chávez ', '13');
INSERT INTO `municipios` VALUES ('569', 'Zitlala ', '13');
INSERT INTO `municipios` VALUES ('570', 'ACATLAN', '14');
INSERT INTO `municipios` VALUES ('571', 'HUICHAPAN', '14');
INSERT INTO `municipios` VALUES ('572', 'SINGUILUCAN', '14');
INSERT INTO `municipios` VALUES ('573', 'ACAXOCHITLAN', '14');
INSERT INTO `municipios` VALUES ('574', 'IXMIQUILPAN', '14');
INSERT INTO `municipios` VALUES ('575', 'TASQUILLO', '14');
INSERT INTO `municipios` VALUES ('576', 'ACTOPAN', '14');
INSERT INTO `municipios` VALUES ('577', 'JACALA DE LEDEZMA', '14');
INSERT INTO `municipios` VALUES ('578', 'TECOZAUTLA', '14');
INSERT INTO `municipios` VALUES ('579', 'AGUA BLANCA DE ITURBIDE', '14');
INSERT INTO `municipios` VALUES ('580', 'JALTOCAN', '14');
INSERT INTO `municipios` VALUES ('581', 'TENANGO DE DORIA', '14');
INSERT INTO `municipios` VALUES ('582', 'AJACUBA', '14');
INSERT INTO `municipios` VALUES ('583', 'JUAREZ HIDALGO', '14');
INSERT INTO `municipios` VALUES ('584', 'TEPEAPULCO', '14');
INSERT INTO `municipios` VALUES ('585', 'ALFAJAYUCAN', '14');
INSERT INTO `municipios` VALUES ('586', 'LOLOTLA', '14');
INSERT INTO `municipios` VALUES ('587', 'TEPEHUACAN DE GUERRERO', '14');
INSERT INTO `municipios` VALUES ('588', 'ALMOLOYA', '14');
INSERT INTO `municipios` VALUES ('589', 'METEPEC', '14');
INSERT INTO `municipios` VALUES ('590', 'TEPEJI DEL RIO DE OCAMPO', '14');
INSERT INTO `municipios` VALUES ('591', 'APAN', '14');
INSERT INTO `municipios` VALUES ('592', 'SAN AGUSTIN METZQUITITLAN', '14');
INSERT INTO `municipios` VALUES ('593', 'TEPETITLAN', '14');
INSERT INTO `municipios` VALUES ('594', 'EL ARENAL', '14');
INSERT INTO `municipios` VALUES ('595', 'METZTITLAN', '14');
INSERT INTO `municipios` VALUES ('596', 'TETEPANGO', '14');
INSERT INTO `municipios` VALUES ('597', 'ATITALAQUIA', '14');
INSERT INTO `municipios` VALUES ('598', 'MINERAL DEL CHICO', '14');
INSERT INTO `municipios` VALUES ('599', 'VILLA DE TEZONTEPEC', '14');
INSERT INTO `municipios` VALUES ('600', 'ATLAPEXCO', '14');
INSERT INTO `municipios` VALUES ('601', 'MINERAL DEL MONTE', '14');
INSERT INTO `municipios` VALUES ('602', 'TEZONTEPEC DE ALDAMA', '14');
INSERT INTO `municipios` VALUES ('603', 'ATOTONILCO EL GRANDE', '14');
INSERT INTO `municipios` VALUES ('604', 'LA MISION', '14');
INSERT INTO `municipios` VALUES ('605', 'TIANGUISTENGO', '14');
INSERT INTO `municipios` VALUES ('606', 'ATOTONILCO DE TULA', '14');
INSERT INTO `municipios` VALUES ('607', 'MIXQUIAHUALA DE JUAREZ', '14');
INSERT INTO `municipios` VALUES ('608', 'TIZAYUCA', '14');
INSERT INTO `municipios` VALUES ('609', 'CALNALI', '14');
INSERT INTO `municipios` VALUES ('610', 'MOLANGO DE ESCAMILLA', '14');
INSERT INTO `municipios` VALUES ('611', 'TLAHUELILPAN', '14');
INSERT INTO `municipios` VALUES ('612', 'CARDONAL', '14');
INSERT INTO `municipios` VALUES ('613', 'NICOLAS FLORES', '14');
INSERT INTO `municipios` VALUES ('614', 'TLAHUILTEPA', '14');
INSERT INTO `municipios` VALUES ('615', 'CUAUTEPEC DE HINOJOSA', '14');
INSERT INTO `municipios` VALUES ('616', 'NOPALA DE VILLAGRAN', '14');
INSERT INTO `municipios` VALUES ('617', 'TLANALAPA', '14');
INSERT INTO `municipios` VALUES ('618', 'CHAPANTONGO', '14');
INSERT INTO `municipios` VALUES ('619', 'OMITLAN DE JUAREZ', '14');
INSERT INTO `municipios` VALUES ('620', 'TLANCHINOL', '14');
INSERT INTO `municipios` VALUES ('621', 'CHAPULHUACAN', '14');
INSERT INTO `municipios` VALUES ('622', 'SAN FELIPE ORIZATLAN', '14');
INSERT INTO `municipios` VALUES ('623', 'TLAXCOAPAN', '14');
INSERT INTO `municipios` VALUES ('624', 'CHILCUAUTLA', '14');
INSERT INTO `municipios` VALUES ('625', 'PACULA', '14');
INSERT INTO `municipios` VALUES ('626', 'TOLCAYUCA', '14');
INSERT INTO `municipios` VALUES ('627', 'ELOXOCHITLAN', '14');
INSERT INTO `municipios` VALUES ('628', 'PACHUCA DE SOTO', '14');
INSERT INTO `municipios` VALUES ('629', 'TULA DE ALLENDE', '14');
INSERT INTO `municipios` VALUES ('630', 'EMILIANO ZAPATA', '14');
INSERT INTO `municipios` VALUES ('631', 'PISAFLORES', '14');
INSERT INTO `municipios` VALUES ('632', 'TULANCINGO DE BRAVO', '14');
INSERT INTO `municipios` VALUES ('633', 'EPAZOYUCAN', '14');
INSERT INTO `municipios` VALUES ('634', 'PROGRESO DE OBREGON', '14');
INSERT INTO `municipios` VALUES ('635', 'XOCHIATIPAN', '14');
INSERT INTO `municipios` VALUES ('636', 'FRANCISCO I. MADERO', '14');
INSERT INTO `municipios` VALUES ('637', 'MINERAL DE LA REFORMA', '14');
INSERT INTO `municipios` VALUES ('638', 'XOCHICOATLAN', '14');
INSERT INTO `municipios` VALUES ('639', 'HUASCA DE OCAMPO', '14');
INSERT INTO `municipios` VALUES ('640', 'SAN AGUSTIN TLAXIACA', '14');
INSERT INTO `municipios` VALUES ('641', 'YAHUALICA', '14');
INSERT INTO `municipios` VALUES ('642', 'HUAUTLA', '14');
INSERT INTO `municipios` VALUES ('643', 'SAN BARTOLO TUTOTEPEC', '14');
INSERT INTO `municipios` VALUES ('644', 'ZACUALTIPAN DE ANGELES', '14');
INSERT INTO `municipios` VALUES ('645', 'HUAZALINGO', '14');
INSERT INTO `municipios` VALUES ('646', 'SAN SALVADOR', '14');
INSERT INTO `municipios` VALUES ('647', 'ZAPOTLAN DE JUAREZ', '14');
INSERT INTO `municipios` VALUES ('648', 'HUEHUETLA', '14');
INSERT INTO `municipios` VALUES ('649', 'SANTIAGO DE ANAYA', '14');
INSERT INTO `municipios` VALUES ('650', 'ZEMPOALA', '14');
INSERT INTO `municipios` VALUES ('651', 'HUEJUTLA DE REYES', '14');
INSERT INTO `municipios` VALUES ('652', 'SANTIAGO TULANTEPEC DE LUGO GUERRERO', '14');
INSERT INTO `municipios` VALUES ('653', 'ZIMAPAN', '14');
INSERT INTO `municipios` VALUES ('654', 'ACATIC ', '15');
INSERT INTO `municipios` VALUES ('655', 'ACATLÁN DE JUÁREZ ', '15');
INSERT INTO `municipios` VALUES ('656', 'AHUALULCO DE MERCADO ', '15');
INSERT INTO `municipios` VALUES ('657', 'AMACUECA ', '15');
INSERT INTO `municipios` VALUES ('658', 'AMATITÁN ', '15');
INSERT INTO `municipios` VALUES ('659', 'AMECA ', '15');
INSERT INTO `municipios` VALUES ('660', 'SAN JUANITO DE ESCOBEDO ', '15');
INSERT INTO `municipios` VALUES ('661', 'ARANDAS ', '15');
INSERT INTO `municipios` VALUES ('662', 'EL ARENAL ', '15');
INSERT INTO `municipios` VALUES ('663', 'ATEMAJAC DE BRIZUELA ', '15');
INSERT INTO `municipios` VALUES ('664', 'ATENGO ', '15');
INSERT INTO `municipios` VALUES ('665', 'ATENGUILLO ', '15');
INSERT INTO `municipios` VALUES ('666', 'ATOTONILCO EL ALTO ', '15');
INSERT INTO `municipios` VALUES ('667', 'ATOYAC ', '15');
INSERT INTO `municipios` VALUES ('668', 'AUTLÁN DE NAVARRO ', '15');
INSERT INTO `municipios` VALUES ('669', 'AYOTLÁN ', '15');
INSERT INTO `municipios` VALUES ('670', 'AYUTLA ', '15');
INSERT INTO `municipios` VALUES ('671', 'LA BARCA ', '15');
INSERT INTO `municipios` VALUES ('672', 'BOLAÑOS ', '15');
INSERT INTO `municipios` VALUES ('673', 'CABO CORRIENTES ', '15');
INSERT INTO `municipios` VALUES ('674', 'CASIMIRO CASTILLO ', '15');
INSERT INTO `municipios` VALUES ('675', 'CIHUATLÁN ', '15');
INSERT INTO `municipios` VALUES ('676', 'ZAPOTLÁN EL GRANDE ', '15');
INSERT INTO `municipios` VALUES ('677', 'COCULA ', '15');
INSERT INTO `municipios` VALUES ('678', 'COLOTLÁN ', '15');
INSERT INTO `municipios` VALUES ('679', 'CONCEPCIÓN DE BUENOS AIRES ', '15');
INSERT INTO `municipios` VALUES ('680', 'CUAUTITLÁN DE GARCÍA BARRAGÁN ', '15');
INSERT INTO `municipios` VALUES ('681', 'CUAUTLA ', '15');
INSERT INTO `municipios` VALUES ('682', 'CUQUÍO ', '15');
INSERT INTO `municipios` VALUES ('683', 'CHAPALA ', '15');
INSERT INTO `municipios` VALUES ('684', 'CHIMALTITÁN ', '15');
INSERT INTO `municipios` VALUES ('685', 'CHIQUILISTLÁN ', '15');
INSERT INTO `municipios` VALUES ('686', 'DEGOLLADO ', '15');
INSERT INTO `municipios` VALUES ('687', 'EJUTLA ', '15');
INSERT INTO `municipios` VALUES ('688', 'ENCARNACIÓN DE DÍAZ ', '15');
INSERT INTO `municipios` VALUES ('689', 'ETZATLÁN ', '15');
INSERT INTO `municipios` VALUES ('690', 'EL GRULLO ', '15');
INSERT INTO `municipios` VALUES ('691', 'GUACHINANGO ', '15');
INSERT INTO `municipios` VALUES ('692', 'GUADALAJARA ', '15');
INSERT INTO `municipios` VALUES ('693', 'HOSTOTIPAQUILLO ', '15');
INSERT INTO `municipios` VALUES ('694', 'HUEJÚCAR ', '15');
INSERT INTO `municipios` VALUES ('695', 'HUEJUQUILLA EL ALTO ', '15');
INSERT INTO `municipios` VALUES ('696', 'LA HUERTA ', '15');
INSERT INTO `municipios` VALUES ('697', 'IXTLAHACÁN DE LOS MEMBRILLOS ', '15');
INSERT INTO `municipios` VALUES ('698', 'IXTLAHUACÁN DEL RÍO ', '15');
INSERT INTO `municipios` VALUES ('699', 'JALOSTOTITLÁN ', '15');
INSERT INTO `municipios` VALUES ('700', 'JAMAY ', '15');
INSERT INTO `municipios` VALUES ('701', 'JESÚS MARÍA ', '15');
INSERT INTO `municipios` VALUES ('702', 'JILOTLÁN DE LOS DOLORES ', '15');
INSERT INTO `municipios` VALUES ('703', 'JOCOTEPEC ', '15');
INSERT INTO `municipios` VALUES ('704', 'JUANACATLÁN ', '15');
INSERT INTO `municipios` VALUES ('705', 'JUCHITLÁN ', '15');
INSERT INTO `municipios` VALUES ('706', 'LAGOS DE MORENO ', '15');
INSERT INTO `municipios` VALUES ('707', 'EL LIMÓN ', '15');
INSERT INTO `municipios` VALUES ('708', 'MAGDALENA ', '15');
INSERT INTO `municipios` VALUES ('709', 'SANTA MARÍA DEL ORO ', '15');
INSERT INTO `municipios` VALUES ('710', 'LA MANZANILLA DE LA PAZ ', '15');
INSERT INTO `municipios` VALUES ('711', 'MASCOTA ', '15');
INSERT INTO `municipios` VALUES ('712', 'MAZAMITLA ', '15');
INSERT INTO `municipios` VALUES ('713', 'MEXTICACÁN ', '15');
INSERT INTO `municipios` VALUES ('714', 'MEZQUITIC ', '15');
INSERT INTO `municipios` VALUES ('715', 'MIXTLÁN ', '15');
INSERT INTO `municipios` VALUES ('716', 'OCOTLÁN', '15');
INSERT INTO `municipios` VALUES ('717', 'OJUELOS DE  JALISCO', '15');
INSERT INTO `municipios` VALUES ('718', 'PIHUAMO', '15');
INSERT INTO `municipios` VALUES ('719', 'PONCITLÁN', '15');
INSERT INTO `municipios` VALUES ('720', 'PUERTO VALLARTA', '15');
INSERT INTO `municipios` VALUES ('721', 'VILLA PURIFICACIÓN', '15');
INSERT INTO `municipios` VALUES ('722', 'QUITUPAN', '15');
INSERT INTO `municipios` VALUES ('723', 'EL SALTO', '15');
INSERT INTO `municipios` VALUES ('724', 'SAN CRISTÓBAL DE LA BARRANCA', '15');
INSERT INTO `municipios` VALUES ('725', 'SAN DIEGO DE ALEJANDRÍA', '15');
INSERT INTO `municipios` VALUES ('726', 'SAN JUAN DE LOS LAGOS', '15');
INSERT INTO `municipios` VALUES ('727', 'SAN JULIÁN', '15');
INSERT INTO `municipios` VALUES ('728', 'SAN MARCOS', '15');
INSERT INTO `municipios` VALUES ('729', 'SAN MARTÍN DE BOLAÑOS', '15');
INSERT INTO `municipios` VALUES ('730', 'SAN MARTÍN HIDALGO', '15');
INSERT INTO `municipios` VALUES ('731', 'SAN MIGUEL EL ALTO', '15');
INSERT INTO `municipios` VALUES ('732', 'GÓMEZ FARÍAS', '15');
INSERT INTO `municipios` VALUES ('733', 'SAN SEBASTIÁN DEL OESTE', '15');
INSERT INTO `municipios` VALUES ('734', 'SANTA MARÍA DE LOS ÁNGELES', '15');
INSERT INTO `municipios` VALUES ('735', 'SAYULA', '15');
INSERT INTO `municipios` VALUES ('736', 'TALA', '15');
INSERT INTO `municipios` VALUES ('737', 'TALPA DE ALLENDE', '15');
INSERT INTO `municipios` VALUES ('738', 'TAMAZULA DE GORDIANO', '15');
INSERT INTO `municipios` VALUES ('739', 'TAPALPA', '15');
INSERT INTO `municipios` VALUES ('740', 'TECALITLÁN', '15');
INSERT INTO `municipios` VALUES ('741', 'TECOLOTLÁN', '15');
INSERT INTO `municipios` VALUES ('742', 'TECHALUTA DE MONTENEGRO', '15');
INSERT INTO `municipios` VALUES ('743', 'TENAMAXLÁN', '15');
INSERT INTO `municipios` VALUES ('744', 'TEOCALTICHE', '15');
INSERT INTO `municipios` VALUES ('745', 'TEOCUITATLÁN DE CORONA', '15');
INSERT INTO `municipios` VALUES ('746', 'TEPATITLÁN DE MORELOS', '15');
INSERT INTO `municipios` VALUES ('747', 'TEQUILA', '15');
INSERT INTO `municipios` VALUES ('748', 'TEUCHITLÁN', '15');
INSERT INTO `municipios` VALUES ('749', 'TIZAPÁN EL ALTO', '15');
INSERT INTO `municipios` VALUES ('750', 'TLAJOMULCO DE ZÚÑIGA', '15');
INSERT INTO `municipios` VALUES ('751', 'TLAQUEPAQUE', '15');
INSERT INTO `municipios` VALUES ('752', 'TOLIMÁN', '15');
INSERT INTO `municipios` VALUES ('753', 'TOMATLÁN', '15');
INSERT INTO `municipios` VALUES ('754', 'TONALÁ', '15');
INSERT INTO `municipios` VALUES ('755', 'TONAYA', '15');
INSERT INTO `municipios` VALUES ('756', 'TONILA', '15');
INSERT INTO `municipios` VALUES ('757', 'TOTATICHE', '15');
INSERT INTO `municipios` VALUES ('758', 'TOTOTLÁN', '15');
INSERT INTO `municipios` VALUES ('759', 'TUXCACUESCO', '15');
INSERT INTO `municipios` VALUES ('760', 'TUXCUECA', '15');
INSERT INTO `municipios` VALUES ('761', 'TUXPAN', '15');
INSERT INTO `municipios` VALUES ('762', 'UNIÓN DE SAN ANTONIO', '15');
INSERT INTO `municipios` VALUES ('763', 'UNIÓN DE TULA', '15');
INSERT INTO `municipios` VALUES ('764', 'VALLE DE GUADALUPE', '15');
INSERT INTO `municipios` VALUES ('765', 'VALLE DE JUÁREZ', '15');
INSERT INTO `municipios` VALUES ('766', 'SAN GABRIEL', '15');
INSERT INTO `municipios` VALUES ('767', 'VILLA CORONA', '15');
INSERT INTO `municipios` VALUES ('768', 'VILLA GUERRERO', '15');
INSERT INTO `municipios` VALUES ('769', 'VILLA HIDALGO', '15');
INSERT INTO `municipios` VALUES ('770', 'CAÑADAS DE OBREGÓN', '15');
INSERT INTO `municipios` VALUES ('771', 'YAHUALICA DE GONZÁLEZ GALLO', '15');
INSERT INTO `municipios` VALUES ('772', 'ZACOALCO DE TORRES', '15');
INSERT INTO `municipios` VALUES ('773', 'ZAPOPAN', '15');
INSERT INTO `municipios` VALUES ('774', 'ZAPOTILTIC', '15');
INSERT INTO `municipios` VALUES ('775', 'ZAPOTITLÁN DE VADILLO', '15');
INSERT INTO `municipios` VALUES ('776', 'ZAPOTLÁN DEL REY', '15');
INSERT INTO `municipios` VALUES ('777', 'ZAPOTLANEJO', '15');
INSERT INTO `municipios` VALUES ('778', 'SAN IGNACIO CERRO GORDO', '15');
INSERT INTO `municipios` VALUES ('779', 'ACUITZIO', '0');
INSERT INTO `municipios` VALUES ('780', 'HUIRAMBA', '0');
INSERT INTO `municipios` VALUES ('781', 'SAN LUCAS', '0');
INSERT INTO `municipios` VALUES ('782', 'AGUILILLA', '0');
INSERT INTO `municipios` VALUES ('783', 'INDAPARAPEO', '0');
INSERT INTO `municipios` VALUES ('784', 'SANTA ANA MAYA', '0');
INSERT INTO `municipios` VALUES ('785', 'ÁLVARO OBREGÓN', '16');
INSERT INTO `municipios` VALUES ('786', 'IRIMBO', '16');
INSERT INTO `municipios` VALUES ('787', 'SALVADOR ESCALANTE', '16');
INSERT INTO `municipios` VALUES ('788', 'ANGAMACUTIRO', '16');
INSERT INTO `municipios` VALUES ('789', 'IXTLÁN', '16');
INSERT INTO `municipios` VALUES ('790', 'SENGUIO', '16');
INSERT INTO `municipios` VALUES ('791', 'ANGANGUEO', '16');
INSERT INTO `municipios` VALUES ('792', 'JACONA', '16');
INSERT INTO `municipios` VALUES ('793', 'SUSUPUATO', '16');
INSERT INTO `municipios` VALUES ('794', 'APATZINGÁN', '16');
INSERT INTO `municipios` VALUES ('795', 'JIMÉNEZ', '16');
INSERT INTO `municipios` VALUES ('796', 'TACÁMBARO', '16');
INSERT INTO `municipios` VALUES ('797', 'APORO', '16');
INSERT INTO `municipios` VALUES ('798', 'JIQUILPAN', '16');
INSERT INTO `municipios` VALUES ('799', 'TANCÍTARO', '16');
INSERT INTO `municipios` VALUES ('800', 'AQUILA', '16');
INSERT INTO `municipios` VALUES ('801', 'JUÁREZ', '16');
INSERT INTO `municipios` VALUES ('802', 'TANGAMANDAPIO', '16');
INSERT INTO `municipios` VALUES ('803', 'ARIO', '16');
INSERT INTO `municipios` VALUES ('804', 'JUNGAPEO', '16');
INSERT INTO `municipios` VALUES ('805', 'TANGANCÍCUARO', '16');
INSERT INTO `municipios` VALUES ('806', 'ARTEAGA', '16');
INSERT INTO `municipios` VALUES ('807', 'LAGUNILLAS', '16');
INSERT INTO `municipios` VALUES ('808', 'TANHUATO', '16');
INSERT INTO `municipios` VALUES ('809', 'BRISEÑAS', '16');
INSERT INTO `municipios` VALUES ('810', 'MADERO', '16');
INSERT INTO `municipios` VALUES ('811', 'TARETAN', '16');
INSERT INTO `municipios` VALUES ('812', 'BUENAVISTA', '16');
INSERT INTO `municipios` VALUES ('813', 'MARAVATÍO', '16');
INSERT INTO `municipios` VALUES ('814', 'TARÍMBARO', '16');
INSERT INTO `municipios` VALUES ('815', 'CARÁCUARO', '16');
INSERT INTO `municipios` VALUES ('816', 'MARCOS CASTELLANOS', '16');
INSERT INTO `municipios` VALUES ('817', 'TEPALCATEPEC', '16');
INSERT INTO `municipios` VALUES ('818', 'COAHUAYANA', '16');
INSERT INTO `municipios` VALUES ('819', 'LÁZARO CÁRDENAS', '16');
INSERT INTO `municipios` VALUES ('820', 'TINGAMBATO', '16');
INSERT INTO `municipios` VALUES ('821', 'COALCOMÁN DE VÁZQUEZ PALLARES', '16');
INSERT INTO `municipios` VALUES ('822', 'MORELIA', '16');
INSERT INTO `municipios` VALUES ('823', 'TINGUINDÍN', '16');
INSERT INTO `municipios` VALUES ('824', 'COENEO', '16');
INSERT INTO `municipios` VALUES ('825', 'MORELOS', '16');
INSERT INTO `municipios` VALUES ('826', 'TIQUICHEO DE NICOLÁS ROMERO', '16');
INSERT INTO `municipios` VALUES ('827', 'CONTEPEC', '16');
INSERT INTO `municipios` VALUES ('828', 'MÚGICA', '16');
INSERT INTO `municipios` VALUES ('829', 'TLALPUJAHUA', '16');
INSERT INTO `municipios` VALUES ('830', 'COPÁNDARO', '16');
INSERT INTO `municipios` VALUES ('831', 'NAHUATZEN', '16');
INSERT INTO `municipios` VALUES ('832', 'TLAZAZALCA', '16');
INSERT INTO `municipios` VALUES ('833', 'COTIJA', '16');
INSERT INTO `municipios` VALUES ('834', 'NOCUPÉTARO', '16');
INSERT INTO `municipios` VALUES ('835', 'TOCUMBO', '16');
INSERT INTO `municipios` VALUES ('836', 'CUITZEO', '16');
INSERT INTO `municipios` VALUES ('837', 'NUEVO PARANGARICUTIRO', '16');
INSERT INTO `municipios` VALUES ('838', 'TUMBISCATÍO', '16');
INSERT INTO `municipios` VALUES ('839', 'CHARAPAN', '16');
INSERT INTO `municipios` VALUES ('840', 'NUEVO URECHO', '16');
INSERT INTO `municipios` VALUES ('841', 'TURICATO', '16');
INSERT INTO `municipios` VALUES ('842', 'CHARO', '16');
INSERT INTO `municipios` VALUES ('843', 'NUMARÁN', '16');
INSERT INTO `municipios` VALUES ('844', 'TUXPAN', '16');
INSERT INTO `municipios` VALUES ('845', 'CHAVINDA', '16');
INSERT INTO `municipios` VALUES ('846', 'OCAMPO', '16');
INSERT INTO `municipios` VALUES ('847', 'TUZANTLA', '16');
INSERT INTO `municipios` VALUES ('848', 'CHERÁN', '16');
INSERT INTO `municipios` VALUES ('849', 'PAJACUARÁN', '16');
INSERT INTO `municipios` VALUES ('850', 'TZINTZUNTZAN', '16');
INSERT INTO `municipios` VALUES ('851', 'CHILCHOTA', '16');
INSERT INTO `municipios` VALUES ('852', 'PANINDÍCUARO', '16');
INSERT INTO `municipios` VALUES ('853', 'TZITZIO', '16');
INSERT INTO `municipios` VALUES ('854', 'CHINICUILA', '16');
INSERT INTO `municipios` VALUES ('855', 'PARÁCUARO', '16');
INSERT INTO `municipios` VALUES ('856', 'URUAPAN', '16');
INSERT INTO `municipios` VALUES ('857', 'CHUCÁNDIRO', '16');
INSERT INTO `municipios` VALUES ('858', 'PARACHO', '16');
INSERT INTO `municipios` VALUES ('859', 'VENUSTIANO CARRANZA', '16');
INSERT INTO `municipios` VALUES ('860', 'CHURINTZIO', '16');
INSERT INTO `municipios` VALUES ('861', 'PÁTZCUARO', '16');
INSERT INTO `municipios` VALUES ('862', 'VILLAMAR', '16');
INSERT INTO `municipios` VALUES ('863', 'CHURUMUCO', '16');
INSERT INTO `municipios` VALUES ('864', 'PENJAMILLO', '16');
INSERT INTO `municipios` VALUES ('865', 'VISTA HERMOSA', '16');
INSERT INTO `municipios` VALUES ('866', 'ECUANDUREO', '16');
INSERT INTO `municipios` VALUES ('867', 'PERIBÁN', '16');
INSERT INTO `municipios` VALUES ('868', 'YURÉCUARO', '16');
INSERT INTO `municipios` VALUES ('869', 'EPITACIO HUERTA', '16');
INSERT INTO `municipios` VALUES ('870', 'PIEDAD, LA', '16');
INSERT INTO `municipios` VALUES ('871', 'ZACAPU', '16');
INSERT INTO `municipios` VALUES ('872', 'ERONGARÍCUARO', '16');
INSERT INTO `municipios` VALUES ('873', 'PURÉPERO', '16');
INSERT INTO `municipios` VALUES ('874', 'ZAMORA', '16');
INSERT INTO `municipios` VALUES ('875', 'GABRIEL ZAMORA', '16');
INSERT INTO `municipios` VALUES ('876', 'PURUÁNDIRO', '16');
INSERT INTO `municipios` VALUES ('877', 'ZINÁPARO', '16');
INSERT INTO `municipios` VALUES ('878', 'HIDALGO', '16');
INSERT INTO `municipios` VALUES ('879', 'QUERÉNDARO', '16');
INSERT INTO `municipios` VALUES ('880', 'ZINAPÉCUARO', '16');
INSERT INTO `municipios` VALUES ('881', 'HUACANA, LA', '16');
INSERT INTO `municipios` VALUES ('882', 'QUIROGA', '16');
INSERT INTO `municipios` VALUES ('883', 'ZIRACUARETIRO', '16');
INSERT INTO `municipios` VALUES ('884', 'HUANDACAREO', '16');
INSERT INTO `municipios` VALUES ('885', 'RÉGULES, COJUMATLÁN DE', '16');
INSERT INTO `municipios` VALUES ('886', 'ZITÁCUARO', '16');
INSERT INTO `municipios` VALUES ('887', 'HUANIQUEO', '16');
INSERT INTO `municipios` VALUES ('888', 'REYES, LOS', '16');
INSERT INTO `municipios` VALUES ('889', 'JOSÉ SIXTO VERDUZCO', '16');
INSERT INTO `municipios` VALUES ('890', 'HUETAMO', '16');
INSERT INTO `municipios` VALUES ('891', 'SAHUAYO', '16');
INSERT INTO `municipios` VALUES ('892', 'VILLA GUERRERO', '16');
INSERT INTO `municipios` VALUES ('893', 'VILLA HIDALGO', '16');
INSERT INTO `municipios` VALUES ('894', 'CAÑADAS DE OBREGÓN', '16');
INSERT INTO `municipios` VALUES ('895', 'YAHUALICA DE GONZÁLEZ GALLO', '16');
INSERT INTO `municipios` VALUES ('896', 'ZACOALCO DE TORRES', '16');
INSERT INTO `municipios` VALUES ('897', 'ZAPOPAN', '16');
INSERT INTO `municipios` VALUES ('898', 'ZAPOTILTIC', '16');
INSERT INTO `municipios` VALUES ('899', 'ZAPOTITLÁN DE VADILLO', '16');
INSERT INTO `municipios` VALUES ('900', 'ZAPOTLÁN DEL REY', '16');
INSERT INTO `municipios` VALUES ('901', 'ZAPOTLANEJO', '16');
INSERT INTO `municipios` VALUES ('902', 'SAN IGNACIO CERRO GORDO', '16');
INSERT INTO `municipios` VALUES ('903', 'Amacuzac ', '17');
INSERT INTO `municipios` VALUES ('904', 'Atlatlahucan ', '17');
INSERT INTO `municipios` VALUES ('905', 'Axochiapan ', '17');
INSERT INTO `municipios` VALUES ('906', 'Ayala ', '17');
INSERT INTO `municipios` VALUES ('907', 'Coatlan del Río ', '17');
INSERT INTO `municipios` VALUES ('908', 'Cuautla ', '17');
INSERT INTO `municipios` VALUES ('909', 'Cuernavaca ', '17');
INSERT INTO `municipios` VALUES ('910', 'Emiliano Zapata ', '17');
INSERT INTO `municipios` VALUES ('911', 'Huitzilac ', '17');
INSERT INTO `municipios` VALUES ('912', 'Jantetelco ', '17');
INSERT INTO `municipios` VALUES ('913', 'Jiutepec ', '17');
INSERT INTO `municipios` VALUES ('914', 'Jojutla ', '17');
INSERT INTO `municipios` VALUES ('915', 'Jonacatepec ', '17');
INSERT INTO `municipios` VALUES ('916', 'Mazatepec ', '17');
INSERT INTO `municipios` VALUES ('917', 'Miacatlán ', '17');
INSERT INTO `municipios` VALUES ('918', 'Ocuituco ', '17');
INSERT INTO `municipios` VALUES ('919', 'Puente de Ixtla ', '17');
INSERT INTO `municipios` VALUES ('920', 'Temixco ', '17');
INSERT INTO `municipios` VALUES ('921', 'Temoac', '17');
INSERT INTO `municipios` VALUES ('922', 'Tepalcingo ', '17');
INSERT INTO `municipios` VALUES ('923', 'Tepoztlan ', '17');
INSERT INTO `municipios` VALUES ('924', 'Tetecala ', '17');
INSERT INTO `municipios` VALUES ('925', 'Tetela del Volcán ', '17');
INSERT INTO `municipios` VALUES ('926', 'Tlalnepantla', '17');
INSERT INTO `municipios` VALUES ('927', 'Tlaltizapan', '17');
INSERT INTO `municipios` VALUES ('928', 'Tlaquiltenango', '17');
INSERT INTO `municipios` VALUES ('929', 'Tlayacapan', '17');
INSERT INTO `municipios` VALUES ('930', 'Totolapan', '17');
INSERT INTO `municipios` VALUES ('931', 'Xochitepec', '17');
INSERT INTO `municipios` VALUES ('932', 'Yautepec', '17');
INSERT INTO `municipios` VALUES ('933', 'Yecapixtla', '17');
INSERT INTO `municipios` VALUES ('934', 'Zacatepec', '17');
INSERT INTO `municipios` VALUES ('935', 'Zacualpan de Amilpas', '17');
INSERT INTO `municipios` VALUES ('936', 'ACAPONETA ', '18');
INSERT INTO `municipios` VALUES ('937', 'AHUACATLÁN ', '18');
INSERT INTO `municipios` VALUES ('938', 'AMATLÁN DE CAÑAS ', '18');
INSERT INTO `municipios` VALUES ('939', 'BAHÍA DE BANDERAS', '18');
INSERT INTO `municipios` VALUES ('940', 'COMPOSTELA ', '18');
INSERT INTO `municipios` VALUES ('941', 'HUAJICORI ', '18');
INSERT INTO `municipios` VALUES ('942', 'IXTLÁN DEL RÍO ', '18');
INSERT INTO `municipios` VALUES ('943', 'JALA ', '18');
INSERT INTO `municipios` VALUES ('944', 'NAYAR, EL ', '18');
INSERT INTO `municipios` VALUES ('945', 'ROSAMORADA ', '18');
INSERT INTO `municipios` VALUES ('946', 'RUÍZ', '18');
INSERT INTO `municipios` VALUES ('947', 'SAN BLAS', '18');
INSERT INTO `municipios` VALUES ('948', 'SAN PEDRO LAGUNILLAS', '18');
INSERT INTO `municipios` VALUES ('949', 'SANTA MARÍA DEL ORO', '18');
INSERT INTO `municipios` VALUES ('950', 'SANTIAGO IXCUINTLA', '18');
INSERT INTO `municipios` VALUES ('951', 'TECUALA', '18');
INSERT INTO `municipios` VALUES ('952', 'TEPIC', '18');
INSERT INTO `municipios` VALUES ('953', 'TUXPAN', '18');
INSERT INTO `municipios` VALUES ('954', 'XALISCO ', '18');
INSERT INTO `municipios` VALUES ('955', 'YESCA, LA', '18');
INSERT INTO `municipios` VALUES ('956', 'Abasolo  ', '19');
INSERT INTO `municipios` VALUES ('957', 'Agualeguas ', '19');
INSERT INTO `municipios` VALUES ('958', 'Aldamas, Los ', '19');
INSERT INTO `municipios` VALUES ('959', 'Allende ', '19');
INSERT INTO `municipios` VALUES ('960', 'Anáhuac ', '19');
INSERT INTO `municipios` VALUES ('961', 'Apodaca ', '19');
INSERT INTO `municipios` VALUES ('962', 'Aramberri ', '19');
INSERT INTO `municipios` VALUES ('963', 'Bustamante ', '19');
INSERT INTO `municipios` VALUES ('964', 'Cadereyta Jiménez ', '19');
INSERT INTO `municipios` VALUES ('965', 'Carmen, El ', '19');
INSERT INTO `municipios` VALUES ('966', 'Cerralvo ', '19');
INSERT INTO `municipios` VALUES ('967', 'China ', '19');
INSERT INTO `municipios` VALUES ('968', 'Ciénega de Flores ', '19');
INSERT INTO `municipios` VALUES ('969', 'Doctor Arroyo ', '19');
INSERT INTO `municipios` VALUES ('970', 'Doctor Coss ', '19');
INSERT INTO `municipios` VALUES ('971', 'Doctor González ', '19');
INSERT INTO `municipios` VALUES ('972', 'Galeana ', '19');
INSERT INTO `municipios` VALUES ('973', 'García ', '19');
INSERT INTO `municipios` VALUES ('974', 'General Bravo ', '19');
INSERT INTO `municipios` VALUES ('975', 'General Escobedo ', '19');
INSERT INTO `municipios` VALUES ('976', 'General Terán ', '19');
INSERT INTO `municipios` VALUES ('977', 'General Treviño ', '19');
INSERT INTO `municipios` VALUES ('978', 'General Zaragoza ', '19');
INSERT INTO `municipios` VALUES ('979', 'General Zuazua ', '19');
INSERT INTO `municipios` VALUES ('980', 'Guadalupe ', '19');
INSERT INTO `municipios` VALUES ('981', 'Herreras, Los ', '19');
INSERT INTO `municipios` VALUES ('982', 'Hidalgo', '19');
INSERT INTO `municipios` VALUES ('983', 'Higueras', '19');
INSERT INTO `municipios` VALUES ('984', 'Hualahuises', '19');
INSERT INTO `municipios` VALUES ('985', 'Iturbide', '19');
INSERT INTO `municipios` VALUES ('986', 'Juárez', '19');
INSERT INTO `municipios` VALUES ('987', 'Lampazos de Naranjo', '19');
INSERT INTO `municipios` VALUES ('988', 'Linares', '19');
INSERT INTO `municipios` VALUES ('989', 'Marín', '19');
INSERT INTO `municipios` VALUES ('990', 'Melchor Ocampo', '19');
INSERT INTO `municipios` VALUES ('991', 'Mier y Noriega', '19');
INSERT INTO `municipios` VALUES ('992', 'Mina', '19');
INSERT INTO `municipios` VALUES ('993', 'Montemorelos', '19');
INSERT INTO `municipios` VALUES ('994', 'Monterrey', '19');
INSERT INTO `municipios` VALUES ('995', 'Parás', '19');
INSERT INTO `municipios` VALUES ('996', 'Pesquería', '19');
INSERT INTO `municipios` VALUES ('997', 'Ramones, Los', '19');
INSERT INTO `municipios` VALUES ('998', 'Rayones', '19');
INSERT INTO `municipios` VALUES ('999', 'Sabinas Hidalgo', '19');
INSERT INTO `municipios` VALUES ('1000', 'Salinas Victoria', '19');
INSERT INTO `municipios` VALUES ('1001', 'San Nicolás de los Garza', '19');
INSERT INTO `municipios` VALUES ('1002', 'San Pedro Garza García', '19');
INSERT INTO `municipios` VALUES ('1003', 'Santa Catarina', '19');
INSERT INTO `municipios` VALUES ('1004', 'Santiago', '19');
INSERT INTO `municipios` VALUES ('1005', 'Vallecillo', '19');
INSERT INTO `municipios` VALUES ('1006', 'Villaldama', '19');
INSERT INTO `municipios` VALUES ('1007', 'ABEJONES', '20');
INSERT INTO `municipios` VALUES ('1008', 'ACATLAN DE PEREZ FIGUEROA', '20');
INSERT INTO `municipios` VALUES ('1009', 'ANIMAS TRUJANO', '20');
INSERT INTO `municipios` VALUES ('1010', 'ASUNCION CACALOTEPEC', '20');
INSERT INTO `municipios` VALUES ('1011', 'ASUNCION CUYOTEPEJI', '20');
INSERT INTO `municipios` VALUES ('1012', 'ASUNCION IXTALTEPEC', '20');
INSERT INTO `municipios` VALUES ('1013', 'ASUNCION NOCHIXTLAN', '20');
INSERT INTO `municipios` VALUES ('1014', 'ASUNCION OCOTLAN', '20');
INSERT INTO `municipios` VALUES ('1015', 'ASUNCION TLACOLULITA', '20');
INSERT INTO `municipios` VALUES ('1016', 'AYOQUEZCO DE ALDAMA', '20');
INSERT INTO `municipios` VALUES ('1017', 'AYOTZINTEPEC', '20');
INSERT INTO `municipios` VALUES ('1018', 'CALIHUALA', '20');
INSERT INTO `municipios` VALUES ('1019', 'CANDELARIA LOXICHA', '20');
INSERT INTO `municipios` VALUES ('1020', 'CAPULALPAM DE MENDEZ', '20');
INSERT INTO `municipios` VALUES ('1021', 'CIENEGA DE ZIMATLAN', '20');
INSERT INTO `municipios` VALUES ('1022', 'CIUDAD IXTEPEC', '20');
INSERT INTO `municipios` VALUES ('1023', 'COATECAS ALTAS', '20');
INSERT INTO `municipios` VALUES ('1024', 'COICOYAN DE LAS FLORES', '20');
INSERT INTO `municipios` VALUES ('1025', 'CONCEPCION BUENAVISTA', '20');
INSERT INTO `municipios` VALUES ('1026', 'CONCEPCION PAPALO', '20');
INSERT INTO `municipios` VALUES ('1027', 'CONSTANCIA DEL ROSARIO', '20');
INSERT INTO `municipios` VALUES ('1028', 'COSOLAPA', '20');
INSERT INTO `municipios` VALUES ('1029', 'COSOLTEPEC', '20');
INSERT INTO `municipios` VALUES ('1030', 'CUILAPAM DE GUERRERO', '20');
INSERT INTO `municipios` VALUES ('1031', 'CUYAMECALCO VILLA DE ZARAGOZA', '20');
INSERT INTO `municipios` VALUES ('1032', 'CHAHUITES', '20');
INSERT INTO `municipios` VALUES ('1033', 'CHALCATONGO DE HIDALGO', '20');
INSERT INTO `municipios` VALUES ('1034', 'CHIQUIHUITLAN DE BENITO JUAREZ', '20');
INSERT INTO `municipios` VALUES ('1035', 'EL BARRIO DE LA SOLEDAD', '20');
INSERT INTO `municipios` VALUES ('1036', 'EL ESPINAL', '20');
INSERT INTO `municipios` VALUES ('1037', 'ELOXOCHITLAN DE FLORES MAGON', '20');
INSERT INTO `municipios` VALUES ('1038', 'FRESNILLO DE TRUJANO', '20');
INSERT INTO `municipios` VALUES ('1039', 'GUADALUPE DE RAMIREZ', '20');
INSERT INTO `municipios` VALUES ('1040', 'GUADALUPE ETLA', '20');
INSERT INTO `municipios` VALUES ('1041', 'GUELATAO DE JUAREZ', '20');
INSERT INTO `municipios` VALUES ('1042', 'GUEVEA DE HUMBOLDT', '20');
INSERT INTO `municipios` VALUES ('1043', 'HEROICA CIUDAD DE EJUTLA DE CRESPO', '20');
INSERT INTO `municipios` VALUES ('1044', 'HEROICA CIUDAD DE HUAJUAPAN DE LEON', '20');
INSERT INTO `municipios` VALUES ('1045', 'HEROICA CIUDAD DE TLAXIACO', '20');
INSERT INTO `municipios` VALUES ('1046', 'HUAUTEPEC', '20');
INSERT INTO `municipios` VALUES ('1047', 'HUAUTLA DE JIMENEZ', '20');
INSERT INTO `municipios` VALUES ('1048', 'IXPANTEPEC NIEVES', '20');
INSERT INTO `municipios` VALUES ('1049', 'IXTLAN DE JUAREZ', '20');
INSERT INTO `municipios` VALUES ('1050', 'JUCHITAN DE ZARAGOZA', '20');
INSERT INTO `municipios` VALUES ('1051', 'LA COMPAÑIA', '20');
INSERT INTO `municipios` VALUES ('1052', 'LA PE', '20');
INSERT INTO `municipios` VALUES ('1053', 'LA REFORMA', '20');
INSERT INTO `municipios` VALUES ('1054', 'LA TRINIDAD VISTA HERMOSA', '20');
INSERT INTO `municipios` VALUES ('1055', 'LOMA BONITA', '20');
INSERT INTO `municipios` VALUES ('1056', 'MAGDALENA APASCO', '20');
INSERT INTO `municipios` VALUES ('1057', 'MAGDALENA JALTEPEC', '20');
INSERT INTO `municipios` VALUES ('1058', 'MAGDALENA MIXTEPEC', '20');
INSERT INTO `municipios` VALUES ('1059', 'MAGDALENA OCOTLAN', '20');
INSERT INTO `municipios` VALUES ('1060', 'MAGDALENA PEÑASCO', '20');
INSERT INTO `municipios` VALUES ('1061', 'MAGDALENA TEITIPAC', '20');
INSERT INTO `municipios` VALUES ('1062', 'MAGDALENA TEQUISISTLAN', '20');
INSERT INTO `municipios` VALUES ('1063', 'MAGDALENA TLACOTEPEC', '20');
INSERT INTO `municipios` VALUES ('1064', 'MAGDALENA YODOCONO DE PORFIRIO DIAZ', '20');
INSERT INTO `municipios` VALUES ('1065', 'MAGDALENA ZAHUATLAN', '20');
INSERT INTO `municipios` VALUES ('1066', 'MARISCALA DE JUAREZ', '20');
INSERT INTO `municipios` VALUES ('1067', 'MARTIRES DE TACUBAYA', '20');
INSERT INTO `municipios` VALUES ('1068', 'MATIAS ROMERO', '20');
INSERT INTO `municipios` VALUES ('1069', 'MAZATLAN VILLA DE FLORES', '20');
INSERT INTO `municipios` VALUES ('1070', 'MESONES HIDALGO', '20');
INSERT INTO `municipios` VALUES ('1071', 'MIAHUATLAN DE PORFIRIO DIAZ', '20');
INSERT INTO `municipios` VALUES ('1072', 'MIXISTLAN DE LA REFORMA', '20');
INSERT INTO `municipios` VALUES ('1073', 'MONJAS', '20');
INSERT INTO `municipios` VALUES ('1074', 'NATIVIDAD', '20');
INSERT INTO `municipios` VALUES ('1075', 'NAZARENO ETLA', '20');
INSERT INTO `municipios` VALUES ('1076', 'NEJAPA DE MADERO', '20');
INSERT INTO `municipios` VALUES ('1077', 'NUEVO ZOQUIAPAM', '20');
INSERT INTO `municipios` VALUES ('1078', 'OAXACA DE JUAREZ', '20');
INSERT INTO `municipios` VALUES ('1079', 'OCOTLAN DE MORELOS', '20');
INSERT INTO `municipios` VALUES ('1080', 'PINOTEPA DE DON LUIS', '20');
INSERT INTO `municipios` VALUES ('1081', 'PLUMA HIDALGO', '20');
INSERT INTO `municipios` VALUES ('1082', 'PUTLA VILLA DE GUERRERO', '20');
INSERT INTO `municipios` VALUES ('1083', 'REFORMA DE PINEDA', '20');
INSERT INTO `municipios` VALUES ('1084', 'REYES ETLA', '20');
INSERT INTO `municipios` VALUES ('1085', 'ROJAS DE CUAUHTEMOC', '20');
INSERT INTO `municipios` VALUES ('1086', 'SALINA CRUZ', '20');
INSERT INTO `municipios` VALUES ('1087', 'SAN AGUSTIN AMATENGO', '20');
INSERT INTO `municipios` VALUES ('1088', 'SAN AGUSTIN ATENANGO', '20');
INSERT INTO `municipios` VALUES ('1089', 'SAN AGUSTIN CHAYUCO', '20');
INSERT INTO `municipios` VALUES ('1090', 'SAN AGUSTIN DE LAS JUNTAS', '20');
INSERT INTO `municipios` VALUES ('1091', 'SAN AGUSTIN ETLA', '20');
INSERT INTO `municipios` VALUES ('1092', 'SAN AGUSTIN LOXICHA', '20');
INSERT INTO `municipios` VALUES ('1093', 'SAN AGUSTIN TLACOTEPEC', '20');
INSERT INTO `municipios` VALUES ('1094', 'SAN AGUSTIN YATARENI', '20');
INSERT INTO `municipios` VALUES ('1095', 'SAN ANDRES CABECERA NUEVA', '20');
INSERT INTO `municipios` VALUES ('1096', 'SAN ANDRES DINICUITI', '20');
INSERT INTO `municipios` VALUES ('1097', 'SAN ANDRES HUAXPALTEPEC', '20');
INSERT INTO `municipios` VALUES ('1098', 'SAN ANDRES HUAYAPAM', '20');
INSERT INTO `municipios` VALUES ('1099', 'SAN ANDRES IXTLAHUACA', '20');
INSERT INTO `municipios` VALUES ('1100', 'SAN ANDRES LAGUNAS', '20');
INSERT INTO `municipios` VALUES ('1101', 'SAN ANDRES NUXIÑO', '20');
INSERT INTO `municipios` VALUES ('1102', 'SAN ANDRES PAXTLAN', '20');
INSERT INTO `municipios` VALUES ('1103', 'SAN ANDRES SINAXTLA', '20');
INSERT INTO `municipios` VALUES ('1104', 'SAN ANDRES SOLAGA', '20');
INSERT INTO `municipios` VALUES ('1105', 'SAN ANDRES TEOTILALPAM', '20');
INSERT INTO `municipios` VALUES ('1106', 'SAN ANDRES TEPETLAPA', '20');
INSERT INTO `municipios` VALUES ('1107', 'SAN ANDRES YAA', '20');
INSERT INTO `municipios` VALUES ('1108', 'SAN ANDRES ZABACHE', '20');
INSERT INTO `municipios` VALUES ('1109', 'SAN ANDRES ZAUTLA', '20');
INSERT INTO `municipios` VALUES ('1110', 'SAN ANTONINO CASTILLO VELASCO', '20');
INSERT INTO `municipios` VALUES ('1111', 'SAN ANTONINO EL ALTO', '20');
INSERT INTO `municipios` VALUES ('1112', 'SAN ANTONINO MONTEVERDE', '20');
INSERT INTO `municipios` VALUES ('1113', 'SAN ANTONIO ACUTLA', '20');
INSERT INTO `municipios` VALUES ('1114', 'SAN ANTONIO DE LA CAL', '20');
INSERT INTO `municipios` VALUES ('1115', 'SAN ANTONIO HUITEPEC', '20');
INSERT INTO `municipios` VALUES ('1116', 'SAN ANTONIO NANAHUATIPAM', '20');
INSERT INTO `municipios` VALUES ('1117', 'SAN ANTONIO SINICAHUA', '20');
INSERT INTO `municipios` VALUES ('1118', 'SAN ANTONIO TEPETLAPA', '20');
INSERT INTO `municipios` VALUES ('1119', 'SAN BALTAZAR CHICHICAPAM', '20');
INSERT INTO `municipios` VALUES ('1120', 'SAN BALTAZAR LOXICHA', '20');
INSERT INTO `municipios` VALUES ('1121', 'SAN BALTAZAR YATZACHI EL BAJO', '20');
INSERT INTO `municipios` VALUES ('1122', 'SAN BARTOLO COYOTEPEC', '20');
INSERT INTO `municipios` VALUES ('1123', 'SAN BARTOLO SOYALTEPEC', '20');
INSERT INTO `municipios` VALUES ('1124', 'SAN BARTOLO YAUTEPEC', '20');
INSERT INTO `municipios` VALUES ('1125', 'SAN BARTOLOME AYAUTLA', '20');
INSERT INTO `municipios` VALUES ('1126', 'SAN BARTOLOME LOXICHA', '20');
INSERT INTO `municipios` VALUES ('1127', 'SAN BARTOLOME QUIALANA', '20');
INSERT INTO `municipios` VALUES ('1128', 'SAN BARTOLOME YUCUAÑE', '20');
INSERT INTO `municipios` VALUES ('1129', 'SAN BARTOLOME ZOOGOCHO', '20');
INSERT INTO `municipios` VALUES ('1130', 'SAN BERNARDO MIXTEPEC', '20');
INSERT INTO `municipios` VALUES ('1131', 'SAN BLAS ATEMPA', '20');
INSERT INTO `municipios` VALUES ('1132', 'SAN CARLOS YAUTEPEC', '20');
INSERT INTO `municipios` VALUES ('1133', 'SAN CRISTOBAL AMATLAN', '20');
INSERT INTO `municipios` VALUES ('1134', 'SAN CRISTOBAL AMOLTEPEC', '20');
INSERT INTO `municipios` VALUES ('1135', 'SAN CRISTOBAL LACHIRIOAG', '20');
INSERT INTO `municipios` VALUES ('1136', 'SAN CRISTOBAL SUCHIXTLAHUACA', '20');
INSERT INTO `municipios` VALUES ('1137', 'SAN DIONISIO DEL MAR', '20');
INSERT INTO `municipios` VALUES ('1138', 'SAN DIONISIO OCOTEPEC', '20');
INSERT INTO `municipios` VALUES ('1139', 'SAN DIONISIO OCOTLAN', '20');
INSERT INTO `municipios` VALUES ('1140', 'SAN ESTEBAN ATATLAHUCA', '20');
INSERT INTO `municipios` VALUES ('1141', 'SAN FELIPE JALAPA DE DIAZ', '20');
INSERT INTO `municipios` VALUES ('1142', 'SAN FELIPE TEJALAPAM', '20');
INSERT INTO `municipios` VALUES ('1143', 'SAN FELIPE USILA', '20');
INSERT INTO `municipios` VALUES ('1144', 'SAN FRANCISCO CAHUACUA', '20');
INSERT INTO `municipios` VALUES ('1145', 'SAN FRANCISCO CAJONOS', '20');
INSERT INTO `municipios` VALUES ('1146', 'SAN FRANCISCO CHAPULAPA', '20');
INSERT INTO `municipios` VALUES ('1147', 'SAN FRANCISCO CHINDUA', '20');
INSERT INTO `municipios` VALUES ('1148', 'SAN FRANCISCO DEL MAR', '20');
INSERT INTO `municipios` VALUES ('1149', 'SAN FRANCISCO HUEHUETLAN', '20');
INSERT INTO `municipios` VALUES ('1150', 'SAN FRANCISCO IXHUATAN', '20');
INSERT INTO `municipios` VALUES ('1151', 'SAN FRANCISCO JALTEPETONGO', '20');
INSERT INTO `municipios` VALUES ('1152', 'SAN FRANCISCO LACHIGOLO', '20');
INSERT INTO `municipios` VALUES ('1153', 'SAN FRANCISCO LOGUECHE', '20');
INSERT INTO `municipios` VALUES ('1154', 'SAN FRANCISCO NUXAÑO', '20');
INSERT INTO `municipios` VALUES ('1155', 'SAN FRANCISCO OZOLOTEPEC', '20');
INSERT INTO `municipios` VALUES ('1156', 'SAN FRANCISCO SOLA', '20');
INSERT INTO `municipios` VALUES ('1157', 'SAN FRANCISCO TELIXTLAHUACA', '20');
INSERT INTO `municipios` VALUES ('1158', 'SAN FRANCISCO TEOPAN', '20');
INSERT INTO `municipios` VALUES ('1159', 'SAN FRANCISCO TLAPANCINGO', '20');
INSERT INTO `municipios` VALUES ('1160', 'SAN GABRIEL MIXTEPEC', '20');
INSERT INTO `municipios` VALUES ('1161', 'SAN ILDEFONSO AMATLAN', '20');
INSERT INTO `municipios` VALUES ('1162', 'SAN ILDEFONSO SOLA', '20');
INSERT INTO `municipios` VALUES ('1163', 'SAN ILDEFONSO VILLA ALTA', '20');
INSERT INTO `municipios` VALUES ('1164', 'SAN JACINTO AMILPAS', '20');
INSERT INTO `municipios` VALUES ('1165', 'SAN JACINTO TLACOTEPEC', '20');
INSERT INTO `municipios` VALUES ('1166', 'SAN JERONIMO COATLAN', '20');
INSERT INTO `municipios` VALUES ('1167', 'SAN JERONIMO SILACAYOAPILLA', '20');
INSERT INTO `municipios` VALUES ('1168', 'SAN JERONIMO SOSOLA', '20');
INSERT INTO `municipios` VALUES ('1169', 'SAN JERONIMO TAVICHE', '20');
INSERT INTO `municipios` VALUES ('1170', 'SAN JERONIMO TECOATL', '20');
INSERT INTO `municipios` VALUES ('1171', 'SAN JERONIMO TLACOCHAHUAYA', '20');
INSERT INTO `municipios` VALUES ('1172', 'SAN JORGE NUCHITA', '20');
INSERT INTO `municipios` VALUES ('1173', 'SAN JOSE AYUQUILA', '20');
INSERT INTO `municipios` VALUES ('1174', 'SAN JOSE CHILTEPEC', '20');
INSERT INTO `municipios` VALUES ('1175', 'SAN JOSE DEL PEÑASCO', '20');
INSERT INTO `municipios` VALUES ('1176', 'SAN JOSE DEL PROGRESO', '20');
INSERT INTO `municipios` VALUES ('1177', 'SAN JOSE ESTANCIA GRANDE', '20');
INSERT INTO `municipios` VALUES ('1178', 'SAN JOSE INDEPENDENCIA', '20');
INSERT INTO `municipios` VALUES ('1179', 'SAN JOSE LACHIGUIRI', '20');
INSERT INTO `municipios` VALUES ('1180', 'SAN JOSE TENANGO', '20');
INSERT INTO `municipios` VALUES ('1181', 'SAN JUAN ACHIUTLA', '20');
INSERT INTO `municipios` VALUES ('1182', 'SAN JUAN ATEPEC', '20');
INSERT INTO `municipios` VALUES ('1183', 'SAN JUAN BAUTISTA ATATLAHUCA', '20');
INSERT INTO `municipios` VALUES ('1184', 'SAN JUAN BAUTISTA COIXTLAHUACA', '20');
INSERT INTO `municipios` VALUES ('1185', 'SAN JUAN BAUTISTA CUICATLAN', '20');
INSERT INTO `municipios` VALUES ('1186', 'SAN JUAN BAUTISTA GUELACHE', '20');
INSERT INTO `municipios` VALUES ('1187', 'SAN JUAN BAUTISTA JAYACATLAN', '20');
INSERT INTO `municipios` VALUES ('1188', 'SAN JUAN BAUTISTA LO DE SOTO', '20');
INSERT INTO `municipios` VALUES ('1189', 'SAN JUAN BAUTISTA SUCHITEPEC', '20');
INSERT INTO `municipios` VALUES ('1190', 'SAN JUAN BAUTISTA TLACOATZINTEPEC', '20');
INSERT INTO `municipios` VALUES ('1191', 'SAN JUAN BAUTISTA TLACHICHILCO', '20');
INSERT INTO `municipios` VALUES ('1192', 'SAN JUAN BAUTISTA TUXTEPEC', '20');
INSERT INTO `municipios` VALUES ('1193', 'SAN JUAN BAUTISTA VALLE NACIONAL', '20');
INSERT INTO `municipios` VALUES ('1194', 'SAN JUAN CACAHUATEPEC', '20');
INSERT INTO `municipios` VALUES ('1195', 'SAN JUAN CIENEGUILLA', '20');
INSERT INTO `municipios` VALUES ('1196', 'SAN JUAN COATZOSPAM', '20');
INSERT INTO `municipios` VALUES ('1197', 'SAN JUAN COLORADO', '20');
INSERT INTO `municipios` VALUES ('1198', 'SAN JUAN COMALTEPEC', '20');
INSERT INTO `municipios` VALUES ('1199', 'SAN JUAN COTZOCON', '20');
INSERT INTO `municipios` VALUES ('1200', 'SAN JUAN CHICOMEZUCHIL', '20');
INSERT INTO `municipios` VALUES ('1201', 'SAN JUAN CHILATECA', '20');
INSERT INTO `municipios` VALUES ('1202', 'SAN JUAN DE LOS CUES', '20');
INSERT INTO `municipios` VALUES ('1203', 'SAN JUAN DEL ESTADO', '20');
INSERT INTO `municipios` VALUES ('1204', 'SAN JUAN DEL RIO', '20');
INSERT INTO `municipios` VALUES ('1205', 'SAN JUAN DIUXI', '20');
INSERT INTO `municipios` VALUES ('1206', 'SAN JUAN EVANGELISTA ANALCO', '20');
INSERT INTO `municipios` VALUES ('1207', 'SAN JUAN GUELAVIA', '20');
INSERT INTO `municipios` VALUES ('1208', 'SAN JUAN GUICHICOVI', '20');
INSERT INTO `municipios` VALUES ('1209', 'SAN JUAN IHUALTEPEC', '20');
INSERT INTO `municipios` VALUES ('1210', 'SAN JUAN JUQUILA MIXES', '20');
INSERT INTO `municipios` VALUES ('1211', 'SAN JUAN JUQUILA VIJANOS', '20');
INSERT INTO `municipios` VALUES ('1212', 'SAN JUAN LACHAO', '20');
INSERT INTO `municipios` VALUES ('1213', 'SAN JUAN LACHIGALLA', '20');
INSERT INTO `municipios` VALUES ('1214', 'SAN JUAN LAJARCIA', '20');
INSERT INTO `municipios` VALUES ('1215', 'SAN JUAN LALANA', '20');
INSERT INTO `municipios` VALUES ('1216', 'SAN JUAN MAZATLAN', '20');
INSERT INTO `municipios` VALUES ('1217', 'SAN JUAN MIXTEPEC - DISTR. 08', '20');
INSERT INTO `municipios` VALUES ('1218', 'SAN JUAN MIXTEPEC - DISTR. 26', '20');
INSERT INTO `municipios` VALUES ('1219', 'SAN JUAN ÑUMI', '20');
INSERT INTO `municipios` VALUES ('1220', 'SAN JUAN OZOLOTEPEC', '20');
INSERT INTO `municipios` VALUES ('1221', 'SAN JUAN PETLAPA', '20');
INSERT INTO `municipios` VALUES ('1222', 'SAN JUAN QUIAHIJE', '20');
INSERT INTO `municipios` VALUES ('1223', 'SAN JUAN QUIOTEPEC', '20');
INSERT INTO `municipios` VALUES ('1224', 'SAN JUAN SAYULTEPEC', '20');
INSERT INTO `municipios` VALUES ('1225', 'SAN JUAN TABAA', '20');
INSERT INTO `municipios` VALUES ('1226', 'SAN JUAN TAMAZOLA', '20');
INSERT INTO `municipios` VALUES ('1227', 'SAN JUAN TEITA', '20');
INSERT INTO `municipios` VALUES ('1228', 'SAN JUAN TEITIPAC', '20');
INSERT INTO `municipios` VALUES ('1229', 'SAN JUAN TEPEUXILA', '20');
INSERT INTO `municipios` VALUES ('1230', 'SAN JUAN TEPOSCOLULA', '20');
INSERT INTO `municipios` VALUES ('1231', 'SAN JUAN YAEE', '20');
INSERT INTO `municipios` VALUES ('1232', 'SAN JUAN YATZONA', '20');
INSERT INTO `municipios` VALUES ('1233', 'SAN JUAN YUCUITA', '20');
INSERT INTO `municipios` VALUES ('1234', 'SAN LORENZO', '20');
INSERT INTO `municipios` VALUES ('1235', 'SAN LORENZO ALBARRADAS', '20');
INSERT INTO `municipios` VALUES ('1236', 'SAN LORENZO CACAOTEPEC', '20');
INSERT INTO `municipios` VALUES ('1237', 'SAN LORENZO CUAUNECUILTITLA', '20');
INSERT INTO `municipios` VALUES ('1238', 'SAN LORENZO TEXMELUCAN', '20');
INSERT INTO `municipios` VALUES ('1239', 'SAN LORENZO VICTORIA', '20');
INSERT INTO `municipios` VALUES ('1240', 'SAN LUCAS CAMOTLAN', '20');
INSERT INTO `municipios` VALUES ('1241', 'SAN LUCAS OJITLAN', '20');
INSERT INTO `municipios` VALUES ('1242', 'SAN LUCAS QUIAVINI', '20');
INSERT INTO `municipios` VALUES ('1243', 'SAN LUCAS ZOQUIAPAM', '20');
INSERT INTO `municipios` VALUES ('1244', 'SAN LUIS AMATLAN', '20');
INSERT INTO `municipios` VALUES ('1245', 'SAN MARCIAL OZOLOTEPEC', '20');
INSERT INTO `municipios` VALUES ('1246', 'SAN MARCOS ARTEAGA', '20');
INSERT INTO `municipios` VALUES ('1247', 'SAN MARTIN DE LOS CANSECOS', '20');
INSERT INTO `municipios` VALUES ('1248', 'SAN MARTIN HUAMELULPAM', '20');
INSERT INTO `municipios` VALUES ('1249', 'SAN MARTIN ITUNYOSO', '20');
INSERT INTO `municipios` VALUES ('1250', 'SAN MARTIN LACHILA', '20');
INSERT INTO `municipios` VALUES ('1251', 'SAN MARTIN PERAS', '20');
INSERT INTO `municipios` VALUES ('1252', 'SAN MARTIN TILCAJETE', '20');
INSERT INTO `municipios` VALUES ('1253', 'SAN MARTIN TOXPALAN', '20');
INSERT INTO `municipios` VALUES ('1254', 'SAN MARTIN ZACATEPEC', '20');
INSERT INTO `municipios` VALUES ('1255', 'SAN MATEO CAJONOS', '20');
INSERT INTO `municipios` VALUES ('1256', 'SAN MATEO DEL MAR', '20');
INSERT INTO `municipios` VALUES ('1257', 'SAN MATEO ETLATONGO', '20');
INSERT INTO `municipios` VALUES ('1258', 'SAN MATEO NEJAPAM', '20');
INSERT INTO `municipios` VALUES ('1259', 'SAN MATEO PEÑASCO', '20');
INSERT INTO `municipios` VALUES ('1260', 'SAN MATEO PIÑAS', '20');
INSERT INTO `municipios` VALUES ('1261', 'SAN MATEO RIO HONDO', '20');
INSERT INTO `municipios` VALUES ('1262', 'SAN MATEO SINDIHUI', '20');
INSERT INTO `municipios` VALUES ('1263', 'SAN MATEO TLAPILTEPEC', '20');
INSERT INTO `municipios` VALUES ('1264', 'SAN MATEO YOLOXOCHITLAN', '20');
INSERT INTO `municipios` VALUES ('1265', 'SAN MELCHOR BETAZA', '20');
INSERT INTO `municipios` VALUES ('1266', 'SAN MIGUEL ACHIUTLA', '20');
INSERT INTO `municipios` VALUES ('1267', 'SAN MIGUEL AHUEHUETITLAN', '20');
INSERT INTO `municipios` VALUES ('1268', 'SAN MIGUEL ALOAPAM', '20');
INSERT INTO `municipios` VALUES ('1269', 'SAN MIGUEL AMATITLAN', '20');
INSERT INTO `municipios` VALUES ('1270', 'SAN MIGUEL AMATLAN', '20');
INSERT INTO `municipios` VALUES ('1271', 'SAN MIGUEL COATLAN', '20');
INSERT INTO `municipios` VALUES ('1272', 'SAN MIGUEL CHICAHUA', '20');
INSERT INTO `municipios` VALUES ('1273', 'SAN MIGUEL CHIMALAPA', '20');
INSERT INTO `municipios` VALUES ('1274', 'SAN MIGUEL DEL PUERTO', '20');
INSERT INTO `municipios` VALUES ('1275', 'SAN MIGUEL DEL RIO', '20');
INSERT INTO `municipios` VALUES ('1276', 'SAN MIGUEL EJUTLA', '20');
INSERT INTO `municipios` VALUES ('1277', 'SAN MIGUEL EL GRANDE', '20');
INSERT INTO `municipios` VALUES ('1278', 'SAN MIGUEL HUAUTLA', '20');
INSERT INTO `municipios` VALUES ('1279', 'SAN MIGUEL MIXTEPEC', '20');
INSERT INTO `municipios` VALUES ('1280', 'SAN MIGUEL PANIXTLAHUACA', '20');
INSERT INTO `municipios` VALUES ('1281', 'SAN MIGUEL PERAS', '20');
INSERT INTO `municipios` VALUES ('1282', 'SAN MIGUEL PIEDRAS', '20');
INSERT INTO `municipios` VALUES ('1283', 'SAN MIGUEL QUETZALTEPEC', '20');
INSERT INTO `municipios` VALUES ('1284', 'SAN MIGUEL SANTA FLOR', '20');
INSERT INTO `municipios` VALUES ('1285', 'SAN MIGUEL SOYALTEPEC', '20');
INSERT INTO `municipios` VALUES ('1286', 'SAN MIGUEL SUCHIXTEPEC', '20');
INSERT INTO `municipios` VALUES ('1287', 'SAN MIGUEL TECOMATLAN', '20');
INSERT INTO `municipios` VALUES ('1288', 'SAN MIGUEL TENANGO', '20');
INSERT INTO `municipios` VALUES ('1289', 'SAN MIGUEL TEQUIXTEPEC', '20');
INSERT INTO `municipios` VALUES ('1290', 'SAN MIGUEL TILQUIAPAM', '20');
INSERT INTO `municipios` VALUES ('1291', 'SAN MIGUEL TLACAMAMA', '20');
INSERT INTO `municipios` VALUES ('1292', 'SAN MIGUEL TLACOTEPEC', '20');
INSERT INTO `municipios` VALUES ('1293', 'SAN MIGUEL TULANCINGO', '20');
INSERT INTO `municipios` VALUES ('1294', 'SAN MIGUEL YOTAO', '20');
INSERT INTO `municipios` VALUES ('1295', 'SAN NICOLAS', '20');
INSERT INTO `municipios` VALUES ('1296', 'SAN NICOLAS HIDALGO', '20');
INSERT INTO `municipios` VALUES ('1297', 'SAN PABLO COATLAN', '20');
INSERT INTO `municipios` VALUES ('1298', 'SAN PABLO CUATRO VENADOS', '20');
INSERT INTO `municipios` VALUES ('1299', 'SAN PABLO ETLA', '20');
INSERT INTO `municipios` VALUES ('1300', 'SAN PABLO HUITZO', '20');
INSERT INTO `municipios` VALUES ('1301', 'SAN PABLO HUIXTEPEC', '20');
INSERT INTO `municipios` VALUES ('1302', 'SAN PABLO MACUILTIANGUIS', '20');
INSERT INTO `municipios` VALUES ('1303', 'SAN PABLO TIJALTEPEC', '20');
INSERT INTO `municipios` VALUES ('1304', 'SAN PABLO VILLA DE MITLA', '20');
INSERT INTO `municipios` VALUES ('1305', 'SAN PABLO YAGANIZA', '20');
INSERT INTO `municipios` VALUES ('1306', 'SAN PEDRO AMUZGOS', '20');
INSERT INTO `municipios` VALUES ('1307', 'SAN PEDRO APOSTOL', '20');
INSERT INTO `municipios` VALUES ('1308', 'SAN PEDRO ATOYAC', '20');
INSERT INTO `municipios` VALUES ('1309', 'SAN PEDRO CAJONOS', '20');
INSERT INTO `municipios` VALUES ('1310', 'SAN PEDRO COMITANCILLO', '20');
INSERT INTO `municipios` VALUES ('1311', 'SAN PEDRO COXCALTEPEC CANTAROS', '20');
INSERT INTO `municipios` VALUES ('1312', 'SAN PEDRO EL ALTO', '20');
INSERT INTO `municipios` VALUES ('1313', 'SAN PEDRO HUAMELULA', '20');
INSERT INTO `municipios` VALUES ('1314', 'SAN PEDRO HUILOTEPEC', '20');
INSERT INTO `municipios` VALUES ('1315', 'SAN PEDRO IXCATLAN', '20');
INSERT INTO `municipios` VALUES ('1316', 'SAN PEDRO IXTLAHUACA', '20');
INSERT INTO `municipios` VALUES ('1317', 'SAN PEDRO JALTEPETONGO', '20');
INSERT INTO `municipios` VALUES ('1318', 'SAN PEDRO JICAYAN', '20');
INSERT INTO `municipios` VALUES ('1319', 'SAN PEDRO JOCOTIPAC', '20');
INSERT INTO `municipios` VALUES ('1320', 'SAN PEDRO JUCHATENGO', '20');
INSERT INTO `municipios` VALUES ('1321', 'SAN PEDRO MARTIR', '20');
INSERT INTO `municipios` VALUES ('1322', 'SAN PEDRO MARTIR QUIECHAPA', '20');
INSERT INTO `municipios` VALUES ('1323', 'SAN PEDRO MARTIR YUCUXACO', '20');
INSERT INTO `municipios` VALUES ('1324', 'SAN PEDRO MIXTEPEC - DISTR. 22 -', '20');
INSERT INTO `municipios` VALUES ('1325', 'SAN PEDRO MIXTEPEC - DISTR. 26 -', '20');
INSERT INTO `municipios` VALUES ('1326', 'SAN PEDRO MOLINOS', '20');
INSERT INTO `municipios` VALUES ('1327', 'SAN PEDRO NOPALA', '20');
INSERT INTO `municipios` VALUES ('1328', 'SAN PEDRO OCOPETATILLO', '20');
INSERT INTO `municipios` VALUES ('1329', 'SAN PEDRO OCOTEPEC', '20');
INSERT INTO `municipios` VALUES ('1330', 'SAN PEDRO POCHUTLA', '20');
INSERT INTO `municipios` VALUES ('1331', 'SAN PEDRO QUIATONI', '20');
INSERT INTO `municipios` VALUES ('1332', 'SAN PEDRO SOCHIAPAM', '20');
INSERT INTO `municipios` VALUES ('1333', 'SAN PEDRO TAPANATEPEC', '20');
INSERT INTO `municipios` VALUES ('1334', 'SAN PEDRO TAVICHE', '20');
INSERT INTO `municipios` VALUES ('1335', 'SAN PEDRO TEOZACOALCO', '20');
INSERT INTO `municipios` VALUES ('1336', 'SAN PEDRO TEUTILA', '20');
INSERT INTO `municipios` VALUES ('1337', 'SAN PEDRO TIDAA', '20');
INSERT INTO `municipios` VALUES ('1338', 'SAN PEDRO TOPILTEPEC', '20');
INSERT INTO `municipios` VALUES ('1339', 'SAN PEDRO TOTOLAPA', '20');
INSERT INTO `municipios` VALUES ('1340', 'SAN PEDRO Y SAN PABLO AYUTLA', '20');
INSERT INTO `municipios` VALUES ('1341', 'SAN PEDRO Y SAN PABLO TEPOSCOLULA', '20');
INSERT INTO `municipios` VALUES ('1342', 'SAN PEDRO Y SAN PABLO TEQUIXTEPEC', '20');
INSERT INTO `municipios` VALUES ('1343', 'SAN PEDRO YANERI', '20');
INSERT INTO `municipios` VALUES ('1344', 'SAN PEDRO YOLOX', '20');
INSERT INTO `municipios` VALUES ('1345', 'SAN PEDRO YUCUNAMA', '20');
INSERT INTO `municipios` VALUES ('1346', 'SAN RAYMUNDO JALPAN', '20');
INSERT INTO `municipios` VALUES ('1347', 'SAN SEBASTIAN ABASOLO', '20');
INSERT INTO `municipios` VALUES ('1348', 'SAN SEBASTIAN COATLAN', '20');
INSERT INTO `municipios` VALUES ('1349', 'SAN SEBASTIAN IXCAPA', '20');
INSERT INTO `municipios` VALUES ('1350', 'SAN SEBASTIAN NICANANDUTA', '20');
INSERT INTO `municipios` VALUES ('1351', 'SAN SEBASTIAN RIO HONDO', '20');
INSERT INTO `municipios` VALUES ('1352', 'SAN SEBASTIAN TECOMAXTLAHUACA', '20');
INSERT INTO `municipios` VALUES ('1353', 'SAN SEBASTIAN TEITIPAC', '20');
INSERT INTO `municipios` VALUES ('1354', 'SAN SEBASTIAN TUTLA', '20');
INSERT INTO `municipios` VALUES ('1355', 'SAN SIMON ALMOLONGAS', '20');
INSERT INTO `municipios` VALUES ('1356', 'SAN SIMON ZAHUATLAN', '20');
INSERT INTO `municipios` VALUES ('1357', 'SAN VICENTE COATLAN', '20');
INSERT INTO `municipios` VALUES ('1358', 'SAN VICENTE LACHIXIO', '20');
INSERT INTO `municipios` VALUES ('1359', 'SAN VICENTE NUÑU', '20');
INSERT INTO `municipios` VALUES ('1360', 'SANTA ANA', '20');
INSERT INTO `municipios` VALUES ('1361', 'SANTA ANA ATEIXTLAHUACA', '20');
INSERT INTO `municipios` VALUES ('1362', 'SANTA ANA CUAUHTEMOC', '20');
INSERT INTO `municipios` VALUES ('1363', 'SANTA ANA DEL VALLE', '20');
INSERT INTO `municipios` VALUES ('1364', 'SANTA ANA TAVELA', '20');
INSERT INTO `municipios` VALUES ('1365', 'SANTA ANA TLAPACOYAN', '20');
INSERT INTO `municipios` VALUES ('1366', 'SANTA ANA YARENI', '20');
INSERT INTO `municipios` VALUES ('1367', 'SANTA ANA ZEGACHE', '20');
INSERT INTO `municipios` VALUES ('1368', 'SANTA CATALINA QUIERI', '20');
INSERT INTO `municipios` VALUES ('1369', 'SANTA CATARINA CUIXTLA', '20');
INSERT INTO `municipios` VALUES ('1370', 'SANTA CATARINA IXTEPEJI', '20');
INSERT INTO `municipios` VALUES ('1371', 'SANTA CATARINA JUQUILA', '20');
INSERT INTO `municipios` VALUES ('1372', 'SANTA CATARINA LACHATAO', '20');
INSERT INTO `municipios` VALUES ('1373', 'SANTA CATARINA LOXICHA', '20');
INSERT INTO `municipios` VALUES ('1374', 'SANTA CATARINA MECHOACAN', '20');
INSERT INTO `municipios` VALUES ('1375', 'SANTA CATARINA MINAS', '20');
INSERT INTO `municipios` VALUES ('1376', 'SANTA CATARINA QUIANE', '20');
INSERT INTO `municipios` VALUES ('1377', 'SANTA CATARINA QUIOQUITANI', '20');
INSERT INTO `municipios` VALUES ('1378', 'SANTA CATARINA TAYATA', '20');
INSERT INTO `municipios` VALUES ('1379', 'SANTA CATARINA TICUA', '20');
INSERT INTO `municipios` VALUES ('1380', 'SANTA CATARINA YOSONOTU', '20');
INSERT INTO `municipios` VALUES ('1381', 'SANTA CATARINA ZAPOQUILA', '20');
INSERT INTO `municipios` VALUES ('1382', 'SANTA CRUZ ACATEPEC', '20');
INSERT INTO `municipios` VALUES ('1383', 'SANTA CRUZ AMILPAS', '20');
INSERT INTO `municipios` VALUES ('1384', 'SANTA CRUZ DE BRAVO', '20');
INSERT INTO `municipios` VALUES ('1385', 'SANTA CRUZ ITUNDUJIA', '20');
INSERT INTO `municipios` VALUES ('1386', 'SANTA CRUZ MIXTEPEC', '20');
INSERT INTO `municipios` VALUES ('1387', 'SANTA CRUZ NUNDACO', '20');
INSERT INTO `municipios` VALUES ('1388', 'SANTA CRUZ PAPALUTLA', '20');
INSERT INTO `municipios` VALUES ('1389', 'SANTA CRUZ TACACHE DE MINA', '20');
INSERT INTO `municipios` VALUES ('1390', 'SANTA CRUZ TACAHUA', '20');
INSERT INTO `municipios` VALUES ('1391', 'SANTA CRUZ TAYATA', '20');
INSERT INTO `municipios` VALUES ('1392', 'SANTA CRUZ XITLA', '20');
INSERT INTO `municipios` VALUES ('1393', 'SANTA CRUZ XOXOCOTLAN', '20');
INSERT INTO `municipios` VALUES ('1394', 'SANTA CRUZ ZENZONTEPEC', '20');
INSERT INTO `municipios` VALUES ('1395', 'SANTA GERTRUDIS', '20');
INSERT INTO `municipios` VALUES ('1396', 'SANTA INES DE ZARAGOZA', '20');
INSERT INTO `municipios` VALUES ('1397', 'SANTA INES DEL MONTE', '20');
INSERT INTO `municipios` VALUES ('1398', 'SANTA INES YATZECHE', '20');
INSERT INTO `municipios` VALUES ('1399', 'SANTA LUCIA DEL CAMINO', '20');
INSERT INTO `municipios` VALUES ('1400', 'SANTA LUCIA MIAHUATLAN', '20');
INSERT INTO `municipios` VALUES ('1401', 'SANTA LUCIA MONTEVERDE', '20');
INSERT INTO `municipios` VALUES ('1402', 'SANTA LUCIA OCOTLAN', '20');
INSERT INTO `municipios` VALUES ('1403', 'SANTA MAGDALENA JICOTLAN', '20');
INSERT INTO `municipios` VALUES ('1404', 'SANTA MARIA ALOTEPEC', '20');
INSERT INTO `municipios` VALUES ('1405', 'SANTA MARIA APAZCO', '20');
INSERT INTO `municipios` VALUES ('1406', 'SANTA MARIA ATZOMPA', '20');
INSERT INTO `municipios` VALUES ('1407', 'SANTA MARIA CAMOTLAN', '20');
INSERT INTO `municipios` VALUES ('1408', 'SANTA MARIA COLOTEPEC', '20');
INSERT INTO `municipios` VALUES ('1409', 'SANTA MARIA CORTIJO', '20');
INSERT INTO `municipios` VALUES ('1410', 'SANTA MARIA COYOTEPEC', '20');
INSERT INTO `municipios` VALUES ('1411', 'SANTA MARIA CHACHOAPAM', '20');
INSERT INTO `municipios` VALUES ('1412', 'SANTA MARIA CHILCHOTLA', '20');
INSERT INTO `municipios` VALUES ('1413', 'SANTA MARIA CHIMALAPA', '20');
INSERT INTO `municipios` VALUES ('1414', 'SANTA MARIA DEL ROSARIO', '20');
INSERT INTO `municipios` VALUES ('1415', 'SANTA MARIA DEL TULE', '20');
INSERT INTO `municipios` VALUES ('1416', 'SANTA MARIA ECATEPEC', '20');
INSERT INTO `municipios` VALUES ('1417', 'SANTA MARIA GUELACE', '20');
INSERT INTO `municipios` VALUES ('1418', 'SANTA MARIA GUIENAGATI', '20');
INSERT INTO `municipios` VALUES ('1419', 'SANTA MARIA HUATULCO', '20');
INSERT INTO `municipios` VALUES ('1420', 'SANTA MARIA HUAZOLOTITLAN', '20');
INSERT INTO `municipios` VALUES ('1421', 'SANTA MARIA IPALAPA', '20');
INSERT INTO `municipios` VALUES ('1422', 'SANTA MARIA IXCATLAN', '20');
INSERT INTO `municipios` VALUES ('1423', 'SANTA MARIA JACATEPEC', '20');
INSERT INTO `municipios` VALUES ('1424', 'SANTA MARIA JALAPA DEL MARQUES', '20');
INSERT INTO `municipios` VALUES ('1425', 'SANTA MARIA JALTIANGUIS', '20');
INSERT INTO `municipios` VALUES ('1426', 'SANTA MARIA LA ASUNCION', '20');
INSERT INTO `municipios` VALUES ('1427', 'SANTA MARIA LACHIXIO', '20');
INSERT INTO `municipios` VALUES ('1428', 'SANTA MARIA MIXTEQUILLA', '20');
INSERT INTO `municipios` VALUES ('1429', 'SANTA MARIA NATIVITAS', '20');
INSERT INTO `municipios` VALUES ('1430', 'SANTA MARIA NDUAYACO', '20');
INSERT INTO `municipios` VALUES ('1431', 'SANTA MARIA OZOLOTEPEC', '20');
INSERT INTO `municipios` VALUES ('1432', 'SANTA MARIA PAPALO', '20');
INSERT INTO `municipios` VALUES ('1433', 'SANTA MARIA PEÑOLES', '20');
INSERT INTO `municipios` VALUES ('1434', 'SANTA MARIA PETAPA', '20');
INSERT INTO `municipios` VALUES ('1435', 'SANTA MARIA QUIEGOLANI', '20');
INSERT INTO `municipios` VALUES ('1436', 'SANTA MARIA SOLA', '20');
INSERT INTO `municipios` VALUES ('1437', 'SANTA MARIA TATALTEPEC', '20');
INSERT INTO `municipios` VALUES ('1438', 'SANTA MARIA TECOMAVACA', '20');
INSERT INTO `municipios` VALUES ('1439', 'SANTA MARIA TEMAXCALAPA', '20');
INSERT INTO `municipios` VALUES ('1440', 'SANTA MARIA TEMAXCALTEPEC', '20');
INSERT INTO `municipios` VALUES ('1441', 'SANTA MARIA TEOPOXCO', '20');
INSERT INTO `municipios` VALUES ('1442', 'SANTA MARIA TEPANTLALI', '20');
INSERT INTO `municipios` VALUES ('1443', 'SANTA MARIA TEXCATITLAN', '20');
INSERT INTO `municipios` VALUES ('1444', 'SANTA MARIA TLAHUITOLTEPEC', '20');
INSERT INTO `municipios` VALUES ('1445', 'SANTA MARIA TLALIXTAC', '20');
INSERT INTO `municipios` VALUES ('1446', 'SANTA MARIA TONAMECA', '20');
INSERT INTO `municipios` VALUES ('1447', 'SANTA MARIA TOTOLAPILLA', '20');
INSERT INTO `municipios` VALUES ('1448', 'SANTA MARIA XADANI', '20');
INSERT INTO `municipios` VALUES ('1449', 'SANTA MARIA YALINA', '20');
INSERT INTO `municipios` VALUES ('1450', 'SANTA MARIA YAVESIA', '20');
INSERT INTO `municipios` VALUES ('1451', 'SANTA MARIA YOLOTEPEC', '20');
INSERT INTO `municipios` VALUES ('1452', 'SANTA MARIA YOSOYUA', '20');
INSERT INTO `municipios` VALUES ('1453', 'SANTA MARIA YUCUHITI', '20');
INSERT INTO `municipios` VALUES ('1454', 'SANTA MARIA ZACATEPEC', '20');
INSERT INTO `municipios` VALUES ('1455', 'SANTA MARIA ZANIZA', '20');
INSERT INTO `municipios` VALUES ('1456', 'SANTA MARIA ZOQUITLAN', '20');
INSERT INTO `municipios` VALUES ('1457', 'SANTIAGO AMOLTEPEC', '20');
INSERT INTO `municipios` VALUES ('1458', 'SANTIAGO APOALA', '20');
INSERT INTO `municipios` VALUES ('1459', 'SANTIAGO APOSTOL', '20');
INSERT INTO `municipios` VALUES ('1460', 'SANTIAGO ASTATA', '20');
INSERT INTO `municipios` VALUES ('1461', 'SANTIAGO ATITLAN', '20');
INSERT INTO `municipios` VALUES ('1462', 'SANTIAGO AYUQUILILLA', '20');
INSERT INTO `municipios` VALUES ('1463', 'SANTIAGO CACALOXTEPEC', '20');
INSERT INTO `municipios` VALUES ('1464', 'SANTIAGO CAMOTLAN', '20');
INSERT INTO `municipios` VALUES ('1465', 'SANTIAGO COMALTEPEC', '20');
INSERT INTO `municipios` VALUES ('1466', 'SANTIAGO CHAZUMBA', '20');
INSERT INTO `municipios` VALUES ('1467', 'SANTIAGO CHOAPAM', '20');
INSERT INTO `municipios` VALUES ('1468', 'SANTIAGO DEL RIO', '20');
INSERT INTO `municipios` VALUES ('1469', 'SANTIAGO HUAJOLOTITLAN', '20');
INSERT INTO `municipios` VALUES ('1470', 'SANTIAGO HUAUCLILLA', '20');
INSERT INTO `municipios` VALUES ('1471', 'SANTIAGO IHUITLAN PLUMAS', '20');
INSERT INTO `municipios` VALUES ('1472', 'SANTIAGO IXCUINTEPEC', '20');
INSERT INTO `municipios` VALUES ('1473', 'SANTIAGO IXTAYUTLA', '20');
INSERT INTO `municipios` VALUES ('1474', 'SANTIAGO JAMILTEPEC', '20');
INSERT INTO `municipios` VALUES ('1475', 'SANTIAGO JOCOTEPEC', '20');
INSERT INTO `municipios` VALUES ('1476', 'SANTIAGO JUXTLAHUACA', '20');
INSERT INTO `municipios` VALUES ('1477', 'SANTIAGO LACHIGUIRI', '20');
INSERT INTO `municipios` VALUES ('1478', 'SANTIAGO LALOPA', '20');
INSERT INTO `municipios` VALUES ('1479', 'SANTIAGO LAOLLAGA', '20');
INSERT INTO `municipios` VALUES ('1480', 'SANTIAGO LAXOPA', '20');
INSERT INTO `municipios` VALUES ('1481', 'SANTIAGO LLANO GRANDE', '20');
INSERT INTO `municipios` VALUES ('1482', 'SANTIAGO MATATLAN', '20');
INSERT INTO `municipios` VALUES ('1483', 'SANTIAGO MILTEPEC', '20');
INSERT INTO `municipios` VALUES ('1484', 'SANTIAGO MINAS', '20');
INSERT INTO `municipios` VALUES ('1485', 'SANTIAGO NACALTEPEC', '20');
INSERT INTO `municipios` VALUES ('1486', 'SANTIAGO NEJAPILLA', '20');
INSERT INTO `municipios` VALUES ('1487', 'SANTIAGO NILTEPEC', '20');
INSERT INTO `municipios` VALUES ('1488', 'SANTIAGO NUNDICHE', '20');
INSERT INTO `municipios` VALUES ('1489', 'SANTIAGO NUYOO', '20');
INSERT INTO `municipios` VALUES ('1490', 'SANTIAGO PINOTEPA NACIONAL', '20');
INSERT INTO `municipios` VALUES ('1491', 'SANTIAGO SUCHILQUITONGO', '20');
INSERT INTO `municipios` VALUES ('1492', 'SANTIAGO TAMAZOLA', '20');
INSERT INTO `municipios` VALUES ('1493', 'SANTIAGO TAPEXTLA', '20');
INSERT INTO `municipios` VALUES ('1494', 'SANTIAGO TENANGO', '20');
INSERT INTO `municipios` VALUES ('1495', 'SANTIAGO TEPETLAPA', '20');
INSERT INTO `municipios` VALUES ('1496', 'SANTIAGO TETEPEC', '20');
INSERT INTO `municipios` VALUES ('1497', 'SANTIAGO TEXCALCINGO', '20');
INSERT INTO `municipios` VALUES ('1498', 'SANTIAGO TEXTITLAN', '20');
INSERT INTO `municipios` VALUES ('1499', 'SANTIAGO TILANTONGO', '20');
INSERT INTO `municipios` VALUES ('1500', 'SANTIAGO TILLO', '20');
INSERT INTO `municipios` VALUES ('1501', 'SANTIAGO TLAZOYALTEPEC', '20');
INSERT INTO `municipios` VALUES ('1502', 'SANTIAGO XANICA', '20');
INSERT INTO `municipios` VALUES ('1503', 'SANTIAGO XIACUI', '20');
INSERT INTO `municipios` VALUES ('1504', 'SANTIAGO YAITEPEC', '20');
INSERT INTO `municipios` VALUES ('1505', 'SANTIAGO YAVEO', '20');
INSERT INTO `municipios` VALUES ('1506', 'SANTIAGO YOLOMECATL', '20');
INSERT INTO `municipios` VALUES ('1507', 'SANTIAGO YOSONDUA', '20');
INSERT INTO `municipios` VALUES ('1508', 'SANTIAGO YUCUYACHI', '20');
INSERT INTO `municipios` VALUES ('1509', 'SANTIAGO ZACATEPEC', '20');
INSERT INTO `municipios` VALUES ('1510', 'SANTIAGO ZOOCHILA', '20');
INSERT INTO `municipios` VALUES ('1511', 'SANTO DOMINGO ALBARRADAS', '20');
INSERT INTO `municipios` VALUES ('1512', 'SANTO DOMINGO ARMENTA', '20');
INSERT INTO `municipios` VALUES ('1513', 'SANTO DOMINGO CHIHUITAN', '20');
INSERT INTO `municipios` VALUES ('1514', 'SANTO DOMINGO DE MORELOS', '20');
INSERT INTO `municipios` VALUES ('1515', 'SANTO DOMINGO INGENIO', '20');
INSERT INTO `municipios` VALUES ('1516', 'SANTO DOMINGO IXCATLAN', '20');
INSERT INTO `municipios` VALUES ('1517', 'SANTO DOMINGO NUXAA', '20');
INSERT INTO `municipios` VALUES ('1518', 'SANTO DOMINGO OZOLOTEPEC', '20');
INSERT INTO `municipios` VALUES ('1519', 'SANTO DOMINGO PETAPA', '20');
INSERT INTO `municipios` VALUES ('1520', 'SANTO DOMINGO ROAYAGA', '20');
INSERT INTO `municipios` VALUES ('1521', 'SANTO DOMINGO TEHUANTEPEC', '20');
INSERT INTO `municipios` VALUES ('1522', 'SANTO DOMINGO TEOJOMULCO', '20');
INSERT INTO `municipios` VALUES ('1523', 'SANTO DOMINGO TEPUXTEPEC', '20');
INSERT INTO `municipios` VALUES ('1524', 'SANTO DOMINGO TLATAYAPAM', '20');
INSERT INTO `municipios` VALUES ('1525', 'SANTO DOMINGO TOMALTEPEC', '20');
INSERT INTO `municipios` VALUES ('1526', 'SANTO DOMINGO TONALA', '20');
INSERT INTO `municipios` VALUES ('1527', 'SANTO DOMINGO TONALTEPEC', '20');
INSERT INTO `municipios` VALUES ('1528', 'SANTO DOMINGO XAGACIA', '20');
INSERT INTO `municipios` VALUES ('1529', 'SANTO DOMINGO YANHUITLAN', '20');
INSERT INTO `municipios` VALUES ('1530', 'SANTO DOMINGO YODOHINO', '20');
INSERT INTO `municipios` VALUES ('1531', 'SANTO DOMINGO ZANATEPEC', '20');
INSERT INTO `municipios` VALUES ('1532', 'SANTO TOMAS JALIEZA', '20');
INSERT INTO `municipios` VALUES ('1533', 'SANTO TOMAS MAZALTEPEC', '20');
INSERT INTO `municipios` VALUES ('1534', 'SANTO TOMAS OCOTEPEC', '20');
INSERT INTO `municipios` VALUES ('1535', 'SANTO TOMAS TAMAZULAPAN', '20');
INSERT INTO `municipios` VALUES ('1536', 'SANTOS REYES NOPALA', '20');
INSERT INTO `municipios` VALUES ('1537', 'SANTOS REYES PAPALO', '20');
INSERT INTO `municipios` VALUES ('1538', 'SANTOS REYES TEPEJILLO', '20');
INSERT INTO `municipios` VALUES ('1539', 'SANTOS REYES YUCUNA', '20');
INSERT INTO `municipios` VALUES ('1540', 'SILACAYOAPAM', '20');
INSERT INTO `municipios` VALUES ('1541', 'SITIO DE XITLAPEHUA', '20');
INSERT INTO `municipios` VALUES ('1542', 'SOLEDAD ETLA', '20');
INSERT INTO `municipios` VALUES ('1543', 'TAMAZULAPAM DEL ESPIRITU SANTO', '20');
INSERT INTO `municipios` VALUES ('1544', 'TANETZE DE ZARAGOZA', '20');
INSERT INTO `municipios` VALUES ('1545', 'TANICHE', '20');
INSERT INTO `municipios` VALUES ('1546', 'TATALTEPEC DE VALDES', '20');
INSERT INTO `municipios` VALUES ('1547', 'TEOCOCUILCO DE MARCOS PEREZ', '20');
INSERT INTO `municipios` VALUES ('1548', 'TEOTITLAN DE FLORES MAGON', '20');
INSERT INTO `municipios` VALUES ('1549', 'TEOTITLAN DEL VALLE', '20');
INSERT INTO `municipios` VALUES ('1550', 'TEOTONGO', '20');
INSERT INTO `municipios` VALUES ('1551', 'TEPELMEME VILLA DE MORELOS', '20');
INSERT INTO `municipios` VALUES ('1552', 'TEZOATLAN DE SEGURA Y LUNA', '20');
INSERT INTO `municipios` VALUES ('1553', 'TLACOLULA DE MATAMOROS', '20');
INSERT INTO `municipios` VALUES ('1554', 'TLACOTEPEC PLUMAS', '20');
INSERT INTO `municipios` VALUES ('1555', 'TLALIXTAC DE CABRERA', '20');
INSERT INTO `municipios` VALUES ('1556', 'TOTONTEPEC VILLA DE MORELOS', '20');
INSERT INTO `municipios` VALUES ('1557', 'TRINIDAD ZAACHILA', '20');
INSERT INTO `municipios` VALUES ('1558', 'UNION HIDALGO HIDALGO', '20');
INSERT INTO `municipios` VALUES ('1559', 'VALERIO TRUJANO', '20');
INSERT INTO `municipios` VALUES ('1560', 'VILLA DE CHILAPA DE DIAZ', '20');
INSERT INTO `municipios` VALUES ('1561', 'VILLA DE ETLA', '20');
INSERT INTO `municipios` VALUES ('1562', 'VILLA DE TAMAZULAPAM DEL PROGRESO', '20');
INSERT INTO `municipios` VALUES ('1563', 'VILLA DE TUTUTEPEC DE MELCHOR OCAMPO', '20');
INSERT INTO `municipios` VALUES ('1564', 'VILLA DE ZAACHILA', '20');
INSERT INTO `municipios` VALUES ('1565', 'VILLA DIAZ ORDAZ', '20');
INSERT INTO `municipios` VALUES ('1566', 'VILLA HIDALGO', '20');
INSERT INTO `municipios` VALUES ('1567', 'VILLA SOLA DE VEGA', '20');
INSERT INTO `municipios` VALUES ('1568', 'VILLA TALEA DE CASTRO', '20');
INSERT INTO `municipios` VALUES ('1569', 'VILLA TEJUPAM DE LA UNION', '20');
INSERT INTO `municipios` VALUES ('1570', 'YAXE', '20');
INSERT INTO `municipios` VALUES ('1571', 'YOGANA', '20');
INSERT INTO `municipios` VALUES ('1572', 'YUTANDUCHI DE GUERRERO', '20');
INSERT INTO `municipios` VALUES ('1573', 'ZAPOTITLAN DEL RIO', '20');
INSERT INTO `municipios` VALUES ('1574', 'ZAPOTITLAN LAGUNAS', '20');
INSERT INTO `municipios` VALUES ('1575', 'ZAPOTITLAN PALMAS', '20');
INSERT INTO `municipios` VALUES ('1576', 'ZIMATLAN DE ALVAREZ', '20');
INSERT INTO `municipios` VALUES ('1577', 'ACAJETE ', '21');
INSERT INTO `municipios` VALUES ('1578', 'ACATENO ', '21');
INSERT INTO `municipios` VALUES ('1579', 'ACATLÁN ', '21');
INSERT INTO `municipios` VALUES ('1580', 'ACATZINGO ', '21');
INSERT INTO `municipios` VALUES ('1581', 'ACTEOPAN ', '21');
INSERT INTO `municipios` VALUES ('1582', 'AHUACATLÁN ', '21');
INSERT INTO `municipios` VALUES ('1583', 'AHUATLÁN ', '21');
INSERT INTO `municipios` VALUES ('1584', 'AHUAZOTEPEC ', '21');
INSERT INTO `municipios` VALUES ('1585', 'AHUEHUETITLA ', '21');
INSERT INTO `municipios` VALUES ('1586', 'AJALPAN ', '21');
INSERT INTO `municipios` VALUES ('1587', 'ALBINO ZERTUCHE ', '21');
INSERT INTO `municipios` VALUES ('1588', 'ALJOJUCA ', '21');
INSERT INTO `municipios` VALUES ('1589', 'ALTEPEXI ', '21');
INSERT INTO `municipios` VALUES ('1590', 'AMIXTLÁN ', '21');
INSERT INTO `municipios` VALUES ('1591', 'AMOZOC ', '21');
INSERT INTO `municipios` VALUES ('1592', 'AQUIXTLA ', '21');
INSERT INTO `municipios` VALUES ('1593', 'ATEMPAN ', '21');
INSERT INTO `municipios` VALUES ('1594', 'ATEXCAL ', '21');
INSERT INTO `municipios` VALUES ('1595', 'ATLIXCO ', '21');
INSERT INTO `municipios` VALUES ('1596', 'ATOYATEMPAN ', '21');
INSERT INTO `municipios` VALUES ('1597', 'ATZALA ', '21');
INSERT INTO `municipios` VALUES ('1598', 'ATZITZIHUACÁN ', '21');
INSERT INTO `municipios` VALUES ('1599', 'ATZITZINTLA ', '21');
INSERT INTO `municipios` VALUES ('1600', 'AXUTLA ', '21');
INSERT INTO `municipios` VALUES ('1601', 'AYOTOXCO DE GUERRERO ', '21');
INSERT INTO `municipios` VALUES ('1602', 'CALPAN ', '21');
INSERT INTO `municipios` VALUES ('1603', 'CALTEPEC ', '21');
INSERT INTO `municipios` VALUES ('1604', 'CAMOCUAUTLA ', '21');
INSERT INTO `municipios` VALUES ('1605', 'CAXHUACAN ', '21');
INSERT INTO `municipios` VALUES ('1606', 'COATEPEC ', '21');
INSERT INTO `municipios` VALUES ('1607', 'COATZINGO ', '21');
INSERT INTO `municipios` VALUES ('1608', 'COHETZALA ', '21');
INSERT INTO `municipios` VALUES ('1609', 'COHUECÁN ', '21');
INSERT INTO `municipios` VALUES ('1610', 'CORONANGO ', '21');
INSERT INTO `municipios` VALUES ('1611', 'COXCATLÁN ', '21');
INSERT INTO `municipios` VALUES ('1612', 'COYOMEAPAN ', '21');
INSERT INTO `municipios` VALUES ('1613', 'COYOTEPEC ', '21');
INSERT INTO `municipios` VALUES ('1614', 'CUAPIAXTLA DE MADERO ', '21');
INSERT INTO `municipios` VALUES ('1615', 'CUAUTEMPAN ', '21');
INSERT INTO `municipios` VALUES ('1616', 'CUANTINCHÁN ', '21');
INSERT INTO `municipios` VALUES ('1617', 'CUAUTLANCINGO ', '21');
INSERT INTO `municipios` VALUES ('1618', 'COAYUCA DE ANDRADE ', '21');
INSERT INTO `municipios` VALUES ('1619', 'CUETZALAN DEL PROGRESO ', '21');
INSERT INTO `municipios` VALUES ('1620', 'CUYOACO ', '21');
INSERT INTO `municipios` VALUES ('1621', 'CHALCHICOMULA DE SESMA ', '21');
INSERT INTO `municipios` VALUES ('1622', 'CHAPULCO ', '21');
INSERT INTO `municipios` VALUES ('1623', 'CHIAUTLA ', '21');
INSERT INTO `municipios` VALUES ('1624', 'CHIAUTZINGO ', '21');
INSERT INTO `municipios` VALUES ('1625', 'CHICONCUAUTLA ', '21');
INSERT INTO `municipios` VALUES ('1626', 'CHICHIQUILA ', '21');
INSERT INTO `municipios` VALUES ('1627', 'CHIETLA ', '21');
INSERT INTO `municipios` VALUES ('1628', 'CHIGMECATITLAN ', '21');
INSERT INTO `municipios` VALUES ('1629', 'CHIGNAHUAPAN ', '21');
INSERT INTO `municipios` VALUES ('1630', 'CHIGNAUTLA ', '21');
INSERT INTO `municipios` VALUES ('1631', 'CHILA ', '21');
INSERT INTO `municipios` VALUES ('1632', 'CHILA DE LA SAL ', '21');
INSERT INTO `municipios` VALUES ('1633', 'HONEY ', '21');
INSERT INTO `municipios` VALUES ('1634', 'CHILCHOTLA ', '21');
INSERT INTO `municipios` VALUES ('1635', 'CHINANTLA ', '21');
INSERT INTO `municipios` VALUES ('1636', 'DOMINGO ARENAS ', '21');
INSERT INTO `municipios` VALUES ('1637', 'ELOXOCHITLÁN ', '21');
INSERT INTO `municipios` VALUES ('1638', 'EPATLÁN ', '21');
INSERT INTO `municipios` VALUES ('1639', 'ESPERANZA ', '21');
INSERT INTO `municipios` VALUES ('1640', 'FRANCISCO Z. MENA ', '21');
INSERT INTO `municipios` VALUES ('1641', 'GENERAL FELIPE ANGELES ', '21');
INSERT INTO `municipios` VALUES ('1642', 'GUADALUPE ', '21');
INSERT INTO `municipios` VALUES ('1643', 'GUADALUPE VICTORIA ', '21');
INSERT INTO `municipios` VALUES ('1644', 'HERMENEGILDO GALEANA ', '21');
INSERT INTO `municipios` VALUES ('1645', 'HUAQUECHULA ', '21');
INSERT INTO `municipios` VALUES ('1646', 'HUATLATLAUCA ', '21');
INSERT INTO `municipios` VALUES ('1647', 'HUAUCHINANGO ', '21');
INSERT INTO `municipios` VALUES ('1648', 'HUEHUETLA ', '21');
INSERT INTO `municipios` VALUES ('1649', 'HUEHUETLÁN EL CHICO ', '21');
INSERT INTO `municipios` VALUES ('1650', 'HUEJOTZINGO ', '21');
INSERT INTO `municipios` VALUES ('1651', 'HUEYAPAN ', '21');
INSERT INTO `municipios` VALUES ('1652', 'HUEYTAMALCO ', '21');
INSERT INTO `municipios` VALUES ('1653', 'HUEYTLALPAN ', '21');
INSERT INTO `municipios` VALUES ('1654', 'HUITZILAN DE SERDÁN ', '21');
INSERT INTO `municipios` VALUES ('1655', 'HUITZILTEPEC ', '21');
INSERT INTO `municipios` VALUES ('1656', 'ATLEQUIZAYAN ', '21');
INSERT INTO `municipios` VALUES ('1657', 'IXCAMILPA DE GUERRERO ', '21');
INSERT INTO `municipios` VALUES ('1658', 'IXCAQUIXTLA ', '21');
INSERT INTO `municipios` VALUES ('1659', 'IXTACAMAXTITLÁN ', '21');
INSERT INTO `municipios` VALUES ('1660', 'IXTEPEC ', '21');
INSERT INTO `municipios` VALUES ('1661', 'IZÚCAR DE MATAMOROS ', '21');
INSERT INTO `municipios` VALUES ('1662', 'JALPAN ', '21');
INSERT INTO `municipios` VALUES ('1663', 'JOLALPAN ', '21');
INSERT INTO `municipios` VALUES ('1664', 'JONOTLA ', '21');
INSERT INTO `municipios` VALUES ('1665', 'JOPALA ', '21');
INSERT INTO `municipios` VALUES ('1666', 'JUAN C. BONILLA ', '21');
INSERT INTO `municipios` VALUES ('1667', 'JUAN GALINDO ', '21');
INSERT INTO `municipios` VALUES ('1668', 'JUAN N. MÉNDEZ ', '21');
INSERT INTO `municipios` VALUES ('1669', 'LAFRAGUA ', '21');
INSERT INTO `municipios` VALUES ('1670', 'LIBRES ', '21');
INSERT INTO `municipios` VALUES ('1671', 'MAGDALENA TLATLAUQUITEPEC, LA ', '21');
INSERT INTO `municipios` VALUES ('1672', 'MAZAPILTEPEC DE JUÁREZ ', '21');
INSERT INTO `municipios` VALUES ('1673', 'MIXTLA ', '21');
INSERT INTO `municipios` VALUES ('1674', 'MOLCAXAC ', '21');
INSERT INTO `municipios` VALUES ('1675', 'MORELOS CAÑADA ', '21');
INSERT INTO `municipios` VALUES ('1676', 'NAUPAN ', '21');
INSERT INTO `municipios` VALUES ('1677', 'NAUZONTLA ', '21');
INSERT INTO `municipios` VALUES ('1678', 'NEALTICAN ', '21');
INSERT INTO `municipios` VALUES ('1679', 'NICOLÁS BRAVO ', '21');
INSERT INTO `municipios` VALUES ('1680', 'NOPALUCAN ', '21');
INSERT INTO `municipios` VALUES ('1681', 'OCOTEPEC ', '21');
INSERT INTO `municipios` VALUES ('1682', 'OCOYUCAN ', '21');
INSERT INTO `municipios` VALUES ('1683', 'OLINTLA ', '21');
INSERT INTO `municipios` VALUES ('1684', 'ORIENTAL ', '21');
INSERT INTO `municipios` VALUES ('1685', 'PAHUATLÁN ', '21');
INSERT INTO `municipios` VALUES ('1686', 'PALMAR DE BRAVO ', '21');
INSERT INTO `municipios` VALUES ('1687', 'PANTEPEC ', '21');
INSERT INTO `municipios` VALUES ('1688', 'PETLALCINGO ', '21');
INSERT INTO `municipios` VALUES ('1689', 'PIAXTLA ', '21');
INSERT INTO `municipios` VALUES ('1690', 'PUEBLA ', '21');
INSERT INTO `municipios` VALUES ('1691', 'QUECHOLAC ', '21');
INSERT INTO `municipios` VALUES ('1692', 'QUIMIXTLÁN ', '21');
INSERT INTO `municipios` VALUES ('1693', 'RAFAEL LARA GRAJALES ', '21');
INSERT INTO `municipios` VALUES ('1694', 'REYES DE JUÁREZ, LOS ', '21');
INSERT INTO `municipios` VALUES ('1695', 'SAN ANDRÉS CHOLULA ', '21');
INSERT INTO `municipios` VALUES ('1696', 'SAN ANTONIO CAÑADA ', '21');
INSERT INTO `municipios` VALUES ('1697', 'SAN DIEGO LA MEZA TOCHIMILTZINGO ', '21');
INSERT INTO `municipios` VALUES ('1698', 'SAN FELIPE TEOTLALCINGO ', '21');
INSERT INTO `municipios` VALUES ('1699', 'SAN FELIPE TEPATLÁN ', '21');
INSERT INTO `municipios` VALUES ('1700', 'SAN GABRIEL CHILAC ', '21');
INSERT INTO `municipios` VALUES ('1701', 'SAN GREGORIO ATZOMPA ', '21');
INSERT INTO `municipios` VALUES ('1702', 'SAN JERÓNIMO TECUANIPAN ', '21');
INSERT INTO `municipios` VALUES ('1703', 'SAN JERÓNIMO XAYACATLÁN ', '21');
INSERT INTO `municipios` VALUES ('1704', 'SAN JOSÉ CHIAPA ', '21');
INSERT INTO `municipios` VALUES ('1705', 'SAN JOSÉ MIAHUATLÁN ', '21');
INSERT INTO `municipios` VALUES ('1706', 'SAN JUAN ATENCO ', '21');
INSERT INTO `municipios` VALUES ('1707', 'SAN JUAN ATZOMPA ', '21');
INSERT INTO `municipios` VALUES ('1708', 'SAN MARTÍN TEXMELUCAN ', '21');
INSERT INTO `municipios` VALUES ('1709', 'SAN MARTÍN TOTOLTEPEC ', '21');
INSERT INTO `municipios` VALUES ('1710', 'SAN MATÍAS TLALANCALECA ', '21');
INSERT INTO `municipios` VALUES ('1711', 'SAN MIGUEL IXITLÁN ', '21');
INSERT INTO `municipios` VALUES ('1712', 'SAN MIGUEL XOXTLA ', '21');
INSERT INTO `municipios` VALUES ('1713', 'SAN NICOLÁS BUENOS AIRES ', '21');
INSERT INTO `municipios` VALUES ('1714', 'SAN NICOLÁS DE LOS RANCHOS ', '21');
INSERT INTO `municipios` VALUES ('1715', 'SAN PABLO ANICANO ', '21');
INSERT INTO `municipios` VALUES ('1716', 'SAN PEDRO CHOLULA ', '21');
INSERT INTO `municipios` VALUES ('1717', 'SAN PEDRO YELOIXTLAHUACA ', '21');
INSERT INTO `municipios` VALUES ('1718', 'SAN SALVADOR EL SECO ', '21');
INSERT INTO `municipios` VALUES ('1719', 'SAN SALVADOR EL VERDE ', '21');
INSERT INTO `municipios` VALUES ('1720', 'SAN SALVADOR HUIXCOLOTLA ', '21');
INSERT INTO `municipios` VALUES ('1721', 'SAN SEBASTIÁN TLACOTEPEC ', '21');
INSERT INTO `municipios` VALUES ('1722', 'SANTA CATARINA TLALTEMPAN ', '21');
INSERT INTO `municipios` VALUES ('1723', 'SANTA INÉS AHUATEMPAN', '21');
INSERT INTO `municipios` VALUES ('1724', 'SANTA ISABEL CHOLULA', '21');
INSERT INTO `municipios` VALUES ('1725', 'SANTIAGO MIAHUATLÁN', '21');
INSERT INTO `municipios` VALUES ('1726', 'HUEHUETLÁN EL GRANDE', '21');
INSERT INTO `municipios` VALUES ('1727', 'SANTO TOMÁS HUEYOTLIPAN', '21');
INSERT INTO `municipios` VALUES ('1728', 'SOLTEPEC', '21');
INSERT INTO `municipios` VALUES ('1729', 'TECALI DE HERRERA', '21');
INSERT INTO `municipios` VALUES ('1730', 'TECAMACHALCO', '21');
INSERT INTO `municipios` VALUES ('1731', 'TECOMATLÁN', '21');
INSERT INTO `municipios` VALUES ('1732', 'TEHUACÁN', '21');
INSERT INTO `municipios` VALUES ('1733', 'TEHUITZINGO', '21');
INSERT INTO `municipios` VALUES ('1734', 'TENAMPULCO', '21');
INSERT INTO `municipios` VALUES ('1735', 'TEOPANTLÁN', '21');
INSERT INTO `municipios` VALUES ('1736', 'TEOTLALCO', '21');
INSERT INTO `municipios` VALUES ('1737', 'TEPANCO DE LÓPEZ', '21');
INSERT INTO `municipios` VALUES ('1738', 'TEPANGO DE RODRÍGUEZ', '21');
INSERT INTO `municipios` VALUES ('1739', 'TEPATLAXCO DE HIDALGO', '21');
INSERT INTO `municipios` VALUES ('1740', 'TEPEACA', '21');
INSERT INTO `municipios` VALUES ('1741', 'TEPEMAXALCO', '21');
INSERT INTO `municipios` VALUES ('1742', 'TEPEOJUMA', '21');
INSERT INTO `municipios` VALUES ('1743', 'TEPETZINTLA', '21');
INSERT INTO `municipios` VALUES ('1744', 'TEPEXCO', '21');
INSERT INTO `municipios` VALUES ('1745', 'TEPEXI DE RODRÍGUEZ', '21');
INSERT INTO `municipios` VALUES ('1746', 'TEPEYAHUALCO', '21');
INSERT INTO `municipios` VALUES ('1747', 'TEPEYAHUALCO DE CUAUHTÉMOC', '21');
INSERT INTO `municipios` VALUES ('1748', 'TETELA DE OCAMPO', '21');
INSERT INTO `municipios` VALUES ('1749', 'TETELES DE ÁVILA CASTILLO', '21');
INSERT INTO `municipios` VALUES ('1750', 'TEZIUTLÁN', '21');
INSERT INTO `municipios` VALUES ('1751', 'TIANGUISMANALCO', '21');
INSERT INTO `municipios` VALUES ('1752', 'TILAPA', '21');
INSERT INTO `municipios` VALUES ('1753', 'TLACOTEPEC DE BENITO JUÁREZ', '21');
INSERT INTO `municipios` VALUES ('1754', 'TLACUILOTEPEC', '21');
INSERT INTO `municipios` VALUES ('1755', 'TLACHICHUCA', '21');
INSERT INTO `municipios` VALUES ('1756', 'TLAHUAPAN', '21');
INSERT INTO `municipios` VALUES ('1757', 'TLALTENANGO', '21');
INSERT INTO `municipios` VALUES ('1758', 'TLANEPANTLA', '21');
INSERT INTO `municipios` VALUES ('1759', 'TLAOLA', '21');
INSERT INTO `municipios` VALUES ('1760', 'TLAPACOYA', '21');
INSERT INTO `municipios` VALUES ('1761', 'TLAPANALÁ', '21');
INSERT INTO `municipios` VALUES ('1762', 'TLATLAUQUITEPEC', '21');
INSERT INTO `municipios` VALUES ('1763', 'TLAXCO', '21');
INSERT INTO `municipios` VALUES ('1764', 'TOCHIMILCO', '21');
INSERT INTO `municipios` VALUES ('1765', 'TOCHTEPEC', '21');
INSERT INTO `municipios` VALUES ('1766', 'TOTOLTEPEC DE GUERRERO', '21');
INSERT INTO `municipios` VALUES ('1767', 'TULCINGO', '21');
INSERT INTO `municipios` VALUES ('1768', 'TUZAMAPAN DE GALEANA', '21');
INSERT INTO `municipios` VALUES ('1769', 'TZICATLACOYAN', '21');
INSERT INTO `municipios` VALUES ('1770', 'VENUSTIANO CARRANZA', '21');
INSERT INTO `municipios` VALUES ('1771', 'VICENTE GUERRERO', '21');
INSERT INTO `municipios` VALUES ('1772', 'XAYACATLÁN DE BRAVO', '21');
INSERT INTO `municipios` VALUES ('1773', 'XICOTEPEC', '21');
INSERT INTO `municipios` VALUES ('1774', 'XICOTLÁN', '21');
INSERT INTO `municipios` VALUES ('1775', 'XIUTETELCO', '21');
INSERT INTO `municipios` VALUES ('1776', 'XOCHIAPULCO', '21');
INSERT INTO `municipios` VALUES ('1777', 'XOCHILTEPEC', '21');
INSERT INTO `municipios` VALUES ('1778', 'XOCHITLÁN DE VICENTE SUÁREZ', '21');
INSERT INTO `municipios` VALUES ('1779', 'XOCHITLÁN TODOS SANTOS', '21');
INSERT INTO `municipios` VALUES ('1780', 'YAONÁHUAC', '21');
INSERT INTO `municipios` VALUES ('1781', 'YEHUALTEPEC', '21');
INSERT INTO `municipios` VALUES ('1782', 'ZACAPALA', '21');
INSERT INTO `municipios` VALUES ('1783', 'ZACAPOAXTLA', '21');
INSERT INTO `municipios` VALUES ('1784', 'ZACATLÁN', '21');
INSERT INTO `municipios` VALUES ('1785', 'ZAPOTITLÁN', '21');
INSERT INTO `municipios` VALUES ('1786', 'ZAPOTITLÁN DE MÉNDEZ', '21');
INSERT INTO `municipios` VALUES ('1787', 'ZARAGOZA', '21');
INSERT INTO `municipios` VALUES ('1788', 'ZAUTLA', '21');
INSERT INTO `municipios` VALUES ('1789', 'ZIHUATEUTLA', '21');
INSERT INTO `municipios` VALUES ('1790', 'ZINACATEPEC', '21');
INSERT INTO `municipios` VALUES ('1791', 'ZONGOZOTLA', '21');
INSERT INTO `municipios` VALUES ('1792', 'ZOQUIAPAN', '21');
INSERT INTO `municipios` VALUES ('1793', 'ZOQUITLÁN', '21');
INSERT INTO `municipios` VALUES ('1794', 'AMEALCO DE BONFIL ', '22');
INSERT INTO `municipios` VALUES ('1795', 'ARROYO SECO ', '22');
INSERT INTO `municipios` VALUES ('1796', 'CADEREYTA DE MONTES ', '22');
INSERT INTO `municipios` VALUES ('1797', 'COLÓN ', '22');
INSERT INTO `municipios` VALUES ('1798', 'CORREGIDORA ', '22');
INSERT INTO `municipios` VALUES ('1799', 'EL MARQUÉS', '22');
INSERT INTO `municipios` VALUES ('1800', 'EZEQUIEL MONTES ', '22');
INSERT INTO `municipios` VALUES ('1801', 'HUIMILPAN ', '22');
INSERT INTO `municipios` VALUES ('1802', 'JALPAN DE SERRA ', '22');
INSERT INTO `municipios` VALUES ('1803', 'LANDA DE MATAMOROS ', '22');
INSERT INTO `municipios` VALUES ('1804', 'PEDRO ESCOBEDO', '22');
INSERT INTO `municipios` VALUES ('1805', 'PEÑAMILLER', '22');
INSERT INTO `municipios` VALUES ('1806', 'PINAL DE AMOLES', '22');
INSERT INTO `municipios` VALUES ('1807', 'QUERÉTARO', '22');
INSERT INTO `municipios` VALUES ('1808', 'SAN JOAQUÍN', '22');
INSERT INTO `municipios` VALUES ('1809', 'SAN JUAN DEL RÍO', '22');
INSERT INTO `municipios` VALUES ('1810', 'TEQUISQUIAPAN', '22');
INSERT INTO `municipios` VALUES ('1811', 'TOLIMÁN', '22');
INSERT INTO `municipios` VALUES ('1812', 'COZUMEL ', '23');
INSERT INTO `municipios` VALUES ('1813', 'FELIPE CARRILLO PUERTO ', '23');
INSERT INTO `municipios` VALUES ('1814', 'ISLA MUJERES ', '23');
INSERT INTO `municipios` VALUES ('1815', 'OTHÓN P. BLANCO ', '23');
INSERT INTO `municipios` VALUES ('1816', 'BENITO JUÁREZ', '23');
INSERT INTO `municipios` VALUES ('1817', 'JOSÉ MARÍA MORELOS', '23');
INSERT INTO `municipios` VALUES ('1818', 'LÁZARO CÁRDENAS', '23');
INSERT INTO `municipios` VALUES ('1819', 'SOLIDARIDAD', '23');
INSERT INTO `municipios` VALUES ('1871', 'CÁRDENAS ', '24');
INSERT INTO `municipios` VALUES ('1870', 'AXTLA DE TERRAZAS ', '24');
INSERT INTO `municipios` VALUES ('1869', 'ARMADILLO DE LOS INFANTE ', '24');
INSERT INTO `municipios` VALUES ('1868', 'AQUISMÓN ', '24');
INSERT INTO `municipios` VALUES ('1867', 'ALAQUINES ', '24');
INSERT INTO `municipios` VALUES ('1866', 'AHUALULCO  ', '24');
INSERT INTO `municipios` VALUES ('1886', 'MATLAPA ', '24');
INSERT INTO `municipios` VALUES ('1885', 'MATEHUALA ', '24');
INSERT INTO `municipios` VALUES ('1884', 'LAGUNILLAS ', '24');
INSERT INTO `municipios` VALUES ('1883', 'HUEHUETLÁN ', '24');
INSERT INTO `municipios` VALUES ('1882', 'GUADALCÁZAR ', '24');
INSERT INTO `municipios` VALUES ('1881', 'ÉBANO  ', '24');
INSERT INTO `municipios` VALUES ('1880', 'CHARCAS ', '24');
INSERT INTO `municipios` VALUES ('1879', 'COXCATLÁN ', '24');
INSERT INTO `municipios` VALUES ('1878', 'CIUDAD VALLES ', '24');
INSERT INTO `municipios` VALUES ('1877', 'CIUDAD FERNÁNDEZ ', '24');
INSERT INTO `municipios` VALUES ('1876', 'CIUDAD DEL MAÍZ ', '24');
INSERT INTO `municipios` VALUES ('1875', 'CERRO DE SAN PEDRO ', '24');
INSERT INTO `municipios` VALUES ('1874', 'CERRITOS ', '24');
INSERT INTO `municipios` VALUES ('1873', 'CEDRAL ', '24');
INSERT INTO `municipios` VALUES ('1872', 'CATORCE ', '24');
INSERT INTO `municipios` VALUES ('1887', 'MEXQUITIC DE CARMONA ', '24');
INSERT INTO `municipios` VALUES ('1888', 'MOCTEZUMA ', '24');
INSERT INTO `municipios` VALUES ('1889', 'EL NARANJO ', '24');
INSERT INTO `municipios` VALUES ('1890', 'RAYÓN ', '24');
INSERT INTO `municipios` VALUES ('1891', 'RIOVERDE ', '24');
INSERT INTO `municipios` VALUES ('1892', 'SALINAS ', '24');
INSERT INTO `municipios` VALUES ('1893', 'SAN ANTONIO ', '24');
INSERT INTO `municipios` VALUES ('1894', 'SAN CIRO DE ACOSTA ', '24');
INSERT INTO `municipios` VALUES ('1895', 'SAN LUIS POTOSÍ ', '24');
INSERT INTO `municipios` VALUES ('1896', 'SAN MARTÍN CHALCHICUAUTLA  ', '24');
INSERT INTO `municipios` VALUES ('1897', 'SAN NICOLÁS TOLENTINO ', '24');
INSERT INTO `municipios` VALUES ('1898', 'SAN VICENTE TANCUAYALAB ', '24');
INSERT INTO `municipios` VALUES ('1899', 'SANTA CATARINA ', '24');
INSERT INTO `municipios` VALUES ('1900', 'SANTA MARÍA DEL RÍO ', '24');
INSERT INTO `municipios` VALUES ('1901', 'SANTO DOMINGO ', '24');
INSERT INTO `municipios` VALUES ('1902', 'SOLEDAD DE GRACIANO SÁNCHEZ ', '24');
INSERT INTO `municipios` VALUES ('1903', 'TAMASOPO ', '24');
INSERT INTO `municipios` VALUES ('1904', 'TAMAZUNCHALE ', '24');
INSERT INTO `municipios` VALUES ('1905', 'TAMPACÁN ', '24');
INSERT INTO `municipios` VALUES ('1906', 'TAMPAMOLÓN CORONA ', '24');
INSERT INTO `municipios` VALUES ('1907', 'TAMUÍN ', '24');
INSERT INTO `municipios` VALUES ('1908', 'TANCANHUITZ DE SANTOS ', '24');
INSERT INTO `municipios` VALUES ('1909', 'TANLAJÁS ', '24');
INSERT INTO `municipios` VALUES ('1910', 'TANQUIÁN DE ESCOBEDO', '24');
INSERT INTO `municipios` VALUES ('1911', 'TIERRANUEVA', '24');
INSERT INTO `municipios` VALUES ('1912', 'VANEGAS', '24');
INSERT INTO `municipios` VALUES ('1913', 'VENADO', '24');
INSERT INTO `municipios` VALUES ('1914', 'VILLA DE ARISTA', '24');
INSERT INTO `municipios` VALUES ('1915', 'VILLA DE ARRIAGA', '24');
INSERT INTO `municipios` VALUES ('1916', 'VILLA DE GUADALUPE', '24');
INSERT INTO `municipios` VALUES ('1917', 'VILLA DE LA PAZ', '24');
INSERT INTO `municipios` VALUES ('1918', 'VILLA DE RAMOS', '24');
INSERT INTO `municipios` VALUES ('1919', 'VILLA DE REYES', '24');
INSERT INTO `municipios` VALUES ('1920', 'VILLA HIDALGO', '24');
INSERT INTO `municipios` VALUES ('1921', 'VILLA JUÁREZ', '24');
INSERT INTO `municipios` VALUES ('1922', 'XILITLA', '24');
INSERT INTO `municipios` VALUES ('1923', 'ZARAGOZA', '24');
INSERT INTO `municipios` VALUES ('1946', 'ESCUINAPA ', '25');
INSERT INTO `municipios` VALUES ('1945', 'ELOTA ', '25');
INSERT INTO `municipios` VALUES ('1944', 'CHOIX ', '25');
INSERT INTO `municipios` VALUES ('1943', 'CULIACÁN ', '25');
INSERT INTO `municipios` VALUES ('1942', 'COSALÁ ', '25');
INSERT INTO `municipios` VALUES ('1941', 'CONCORDIA ', '25');
INSERT INTO `municipios` VALUES ('1940', 'BADIRAGUATO ', '25');
INSERT INTO `municipios` VALUES ('1939', 'ANGOSTURA ', '25');
INSERT INTO `municipios` VALUES ('1938', 'AHOME ', '25');
INSERT INTO `municipios` VALUES ('1947', 'FUERTE, EL', '25');
INSERT INTO `municipios` VALUES ('1948', 'GUASAVE', '25');
INSERT INTO `municipios` VALUES ('1949', 'MAZATLÁN', '25');
INSERT INTO `municipios` VALUES ('1950', 'MOCORITO', '25');
INSERT INTO `municipios` VALUES ('1951', 'NAVOLATO', '25');
INSERT INTO `municipios` VALUES ('1952', 'ROSARIO', '25');
INSERT INTO `municipios` VALUES ('1953', 'SALVADOR ALVARADO', '25');
INSERT INTO `municipios` VALUES ('1954', 'SAN IGNACIO', '25');
INSERT INTO `municipios` VALUES ('1955', 'SINALOA', '25');
INSERT INTO `municipios` VALUES ('2026', 'Caborca ', '26');
INSERT INTO `municipios` VALUES ('2025', 'Benjamín Hill ', '26');
INSERT INTO `municipios` VALUES ('2024', 'Bavispe ', '26');
INSERT INTO `municipios` VALUES ('2023', 'Baviácora ', '26');
INSERT INTO `municipios` VALUES ('2022', 'Banámichi ', '26');
INSERT INTO `municipios` VALUES ('2021', 'Bácum ', '26');
INSERT INTO `municipios` VALUES ('2020', 'Bacoachi ', '26');
INSERT INTO `municipios` VALUES ('2019', 'Bacerac ', '26');
INSERT INTO `municipios` VALUES ('2018', 'Bacanora ', '26');
INSERT INTO `municipios` VALUES ('2017', 'Bacadéhuachi ', '26');
INSERT INTO `municipios` VALUES ('2016', 'Atil ', '26');
INSERT INTO `municipios` VALUES ('2015', 'Arizpe ', '26');
INSERT INTO `municipios` VALUES ('2014', 'Arivechi ', '26');
INSERT INTO `municipios` VALUES ('2013', 'Altar ', '26');
INSERT INTO `municipios` VALUES ('2012', 'Alamos ', '26');
INSERT INTO `municipios` VALUES ('2011', 'Agua Prieta ', '26');
INSERT INTO `municipios` VALUES ('2010', 'Aconchi ', '26');
INSERT INTO `municipios` VALUES ('2040', 'Huachinera ', '26');
INSERT INTO `municipios` VALUES ('2039', 'Hermosillo ', '26');
INSERT INTO `municipios` VALUES ('2038', 'Guaymas ', '26');
INSERT INTO `municipios` VALUES ('2037', 'Granados ', '26');
INSERT INTO `municipios` VALUES ('2036', 'Fronteras ', '26');
INSERT INTO `municipios` VALUES ('2035', 'Etchojoa ', '26');
INSERT INTO `municipios` VALUES ('2034', 'Empalme ', '26');
INSERT INTO `municipios` VALUES ('2033', 'Divisaderos ', '26');
INSERT INTO `municipios` VALUES ('2032', 'Cumpas ', '26');
INSERT INTO `municipios` VALUES ('2031', 'Cucurpe ', '26');
INSERT INTO `municipios` VALUES ('2030', 'La Colorada ', '26');
INSERT INTO `municipios` VALUES ('2029', 'Carbó ', '26');
INSERT INTO `municipios` VALUES ('2028', 'Cananea ', '26');
INSERT INTO `municipios` VALUES ('2027', 'Cajeme ', '26');
INSERT INTO `municipios` VALUES ('2041', 'Huásabas ', '26');
INSERT INTO `municipios` VALUES ('2042', 'Huatabampo ', '26');
INSERT INTO `municipios` VALUES ('2043', 'Huépac ', '26');
INSERT INTO `municipios` VALUES ('2044', 'Imuris ', '26');
INSERT INTO `municipios` VALUES ('2045', 'Magdalena ', '26');
INSERT INTO `municipios` VALUES ('2046', 'Mazatán ', '26');
INSERT INTO `municipios` VALUES ('2047', 'Moctezuma ', '26');
INSERT INTO `municipios` VALUES ('2048', 'Naco ', '26');
INSERT INTO `municipios` VALUES ('2049', 'Nácori Chico ', '26');
INSERT INTO `municipios` VALUES ('2050', 'Nacozari de García ', '26');
INSERT INTO `municipios` VALUES ('2051', 'Navojoa ', '26');
INSERT INTO `municipios` VALUES ('2052', 'Nogales ', '26');
INSERT INTO `municipios` VALUES ('2053', 'Onavas ', '26');
INSERT INTO `municipios` VALUES ('2054', 'Opodepe ', '26');
INSERT INTO `municipios` VALUES ('2055', 'Oquitoa ', '26');
INSERT INTO `municipios` VALUES ('2056', 'Pitiquito ', '26');
INSERT INTO `municipios` VALUES ('2057', 'Puerto Peñasco ', '26');
INSERT INTO `municipios` VALUES ('2058', 'Quiriego', '26');
INSERT INTO `municipios` VALUES ('2059', 'Rayón', '26');
INSERT INTO `municipios` VALUES ('2060', 'Rosario', '26');
INSERT INTO `municipios` VALUES ('2061', 'Sahuaripa', '26');
INSERT INTO `municipios` VALUES ('2062', 'San Felipe de Jesús', '26');
INSERT INTO `municipios` VALUES ('2063', 'San Javier', '26');
INSERT INTO `municipios` VALUES ('2064', 'San Luis Río Colorado', '26');
INSERT INTO `municipios` VALUES ('2065', 'San Miguel de Horcasitas', '26');
INSERT INTO `municipios` VALUES ('2066', 'San Pedro de la Cueva', '26');
INSERT INTO `municipios` VALUES ('2067', 'Santa Ana', '26');
INSERT INTO `municipios` VALUES ('2068', 'Santa Cruz', '26');
INSERT INTO `municipios` VALUES ('2069', 'Sáric', '26');
INSERT INTO `municipios` VALUES ('2070', 'Soyopa', '26');
INSERT INTO `municipios` VALUES ('2071', 'Suaqui Grande', '26');
INSERT INTO `municipios` VALUES ('2072', 'Tepachi', '26');
INSERT INTO `municipios` VALUES ('2073', 'Trincheras', '26');
INSERT INTO `municipios` VALUES ('2074', 'Tubutama', '26');
INSERT INTO `municipios` VALUES ('2075', 'Ures', '26');
INSERT INTO `municipios` VALUES ('2076', 'Villa Hidalgo', '26');
INSERT INTO `municipios` VALUES ('2077', 'Villa Pesqueira', '26');
INSERT INTO `municipios` VALUES ('2078', 'Yécora', '26');
INSERT INTO `municipios` VALUES ('2079', 'Plutarco Elías Calles', '26');
INSERT INTO `municipios` VALUES ('2080', 'Benito Juárez', '26');
INSERT INTO `municipios` VALUES ('2081', 'San Ignacio Río Muerto', '26');
INSERT INTO `municipios` VALUES ('2082', 'BALANCÁN ', '27');
INSERT INTO `municipios` VALUES ('2083', 'CÁRDENAS ', '27');
INSERT INTO `municipios` VALUES ('2084', 'CENTLA ', '27');
INSERT INTO `municipios` VALUES ('2085', 'CENTRO ', '27');
INSERT INTO `municipios` VALUES ('2086', 'COMALCALCO ', '27');
INSERT INTO `municipios` VALUES ('2087', 'CUNDUACÁN ', '27');
INSERT INTO `municipios` VALUES ('2088', 'EMILIANO ZAPATA ', '27');
INSERT INTO `municipios` VALUES ('2089', 'HUIMANGUILLO ', '27');
INSERT INTO `municipios` VALUES ('2090', 'JALAPA ', '27');
INSERT INTO `municipios` VALUES ('2091', 'JALPA DE MÉNDEZ', '27');
INSERT INTO `municipios` VALUES ('2092', 'JONUTA', '27');
INSERT INTO `municipios` VALUES ('2093', 'MACUSPANA', '27');
INSERT INTO `municipios` VALUES ('2094', 'NACAJUCA', '27');
INSERT INTO `municipios` VALUES ('2095', 'PARAÍSO', '27');
INSERT INTO `municipios` VALUES ('2096', 'TACOTALPA', '27');
INSERT INTO `municipios` VALUES ('2097', 'TEAPA', '27');
INSERT INTO `municipios` VALUES ('2098', 'TENOSIQUE', '27');
INSERT INTO `municipios` VALUES ('2099', 'Abasolo ', '28');
INSERT INTO `municipios` VALUES ('2100', 'Aldama ', '28');
INSERT INTO `municipios` VALUES ('2101', 'Altamira ', '28');
INSERT INTO `municipios` VALUES ('2102', 'Antiguo Morelos ', '28');
INSERT INTO `municipios` VALUES ('2103', 'Burgos ', '28');
INSERT INTO `municipios` VALUES ('2104', 'Bustamante ', '28');
INSERT INTO `municipios` VALUES ('2105', 'Camargo ', '28');
INSERT INTO `municipios` VALUES ('2106', 'Casas ', '28');
INSERT INTO `municipios` VALUES ('2107', 'Ciudad Madero ', '28');
INSERT INTO `municipios` VALUES ('2108', 'Cruillas ', '28');
INSERT INTO `municipios` VALUES ('2109', 'Gómez Farías ', '28');
INSERT INTO `municipios` VALUES ('2110', 'González ', '28');
INSERT INTO `municipios` VALUES ('2111', 'Guémez ', '28');
INSERT INTO `municipios` VALUES ('2112', 'Guerrero ', '28');
INSERT INTO `municipios` VALUES ('2113', 'Gustavo Díaz Ordaz ', '28');
INSERT INTO `municipios` VALUES ('2114', 'Hidalgo ', '28');
INSERT INTO `municipios` VALUES ('2115', 'Jaumave ', '28');
INSERT INTO `municipios` VALUES ('2116', 'Jiménez ', '28');
INSERT INTO `municipios` VALUES ('2117', 'Llera ', '28');
INSERT INTO `municipios` VALUES ('2118', 'Mainero ', '28');
INSERT INTO `municipios` VALUES ('2119', 'El Mante ', '28');
INSERT INTO `municipios` VALUES ('2120', 'Matamoros ', '28');
INSERT INTO `municipios` VALUES ('2121', 'Méndez ', '28');
INSERT INTO `municipios` VALUES ('2122', 'Mier ', '28');
INSERT INTO `municipios` VALUES ('2123', 'Miguel Alemán ', '28');
INSERT INTO `municipios` VALUES ('2124', 'Miquihuana ', '28');
INSERT INTO `municipios` VALUES ('2125', 'Nuevo Laredo ', '28');
INSERT INTO `municipios` VALUES ('2126', 'Nuevo Morelos ', '28');
INSERT INTO `municipios` VALUES ('2127', 'Ocampo ', '28');
INSERT INTO `municipios` VALUES ('2128', 'Padilla ', '28');
INSERT INTO `municipios` VALUES ('2129', 'Palmillas ', '28');
INSERT INTO `municipios` VALUES ('2130', 'Reynosa ', '28');
INSERT INTO `municipios` VALUES ('2131', 'Río Bravo ', '28');
INSERT INTO `municipios` VALUES ('2132', 'San Carlos', '28');
INSERT INTO `municipios` VALUES ('2133', 'San Fernando', '28');
INSERT INTO `municipios` VALUES ('2134', 'San Nicolás', '28');
INSERT INTO `municipios` VALUES ('2135', 'Soto la Marina', '28');
INSERT INTO `municipios` VALUES ('2136', 'Tampico', '28');
INSERT INTO `municipios` VALUES ('2137', 'Tula', '28');
INSERT INTO `municipios` VALUES ('2138', 'Valle Hermoso', '28');
INSERT INTO `municipios` VALUES ('2139', 'Victoria', '28');
INSERT INTO `municipios` VALUES ('2140', 'Villagrán', '28');
INSERT INTO `municipios` VALUES ('2141', 'Xicoténcatl', '28');
INSERT INTO `municipios` VALUES ('2142', 'AMAXAC DE GUERRERO', '29');
INSERT INTO `municipios` VALUES ('2143', 'TETLA DE LA SOLIDARIDAD', '29');
INSERT INTO `municipios` VALUES ('2144', 'APETATITLÁN DE ANTONIO CARVAJAL', '29');
INSERT INTO `municipios` VALUES ('2145', 'TETLATLAHUCA', '29');
INSERT INTO `municipios` VALUES ('2146', 'ATLANGATEPEC', '29');
INSERT INTO `municipios` VALUES ('2147', 'TLAXCALA', '29');
INSERT INTO `municipios` VALUES ('2148', 'ALTZAYANCA', '29');
INSERT INTO `municipios` VALUES ('2149', 'TLAXCO', '29');
INSERT INTO `municipios` VALUES ('2150', 'APIZACO', '29');
INSERT INTO `municipios` VALUES ('2151', 'TOCATLÁN', '29');
INSERT INTO `municipios` VALUES ('2152', 'CALPULALPAN', '29');
INSERT INTO `municipios` VALUES ('2153', 'TOTOLAC', '29');
INSERT INTO `municipios` VALUES ('2154', 'EL CARMEN TEQUEXQUITLA', '29');
INSERT INTO `municipios` VALUES ('2155', 'ZITLALTEPEC DE TRINIDAD SÁNCHEZ SANTOS', '29');
INSERT INTO `municipios` VALUES ('2156', 'CUAPIAXTLA', '29');
INSERT INTO `municipios` VALUES ('2157', 'TZOMPANTEPEC', '29');
INSERT INTO `municipios` VALUES ('2158', 'CUAXOMULCO', '29');
INSERT INTO `municipios` VALUES ('2159', 'XALOSTOC', '29');
INSERT INTO `municipios` VALUES ('2160', 'CHIAUTEMPAN', '29');
INSERT INTO `municipios` VALUES ('2161', 'XALTOCAN', '29');
INSERT INTO `municipios` VALUES ('2162', 'MUÑOZ DE DOMINGO ARENAS', '29');
INSERT INTO `municipios` VALUES ('2163', 'PAPALOTLA DE XICOHTÉNCATL', '29');
INSERT INTO `municipios` VALUES ('2164', 'ESPAÑITA', '29');
INSERT INTO `municipios` VALUES ('2165', 'XICOHTZINCO', '29');
INSERT INTO `municipios` VALUES ('2166', 'HUAMANTLA', '29');
INSERT INTO `municipios` VALUES ('2167', 'YAUHQUEMECAN', '29');
INSERT INTO `municipios` VALUES ('2168', 'HUEYOTLIPAN', '29');
INSERT INTO `municipios` VALUES ('2169', 'ZACATELCO', '29');
INSERT INTO `municipios` VALUES ('2170', 'IXTACUIXTLA DE MARIANO MATAMOROS', '29');
INSERT INTO `municipios` VALUES ('2171', 'BENITO JUÁREZ', '29');
INSERT INTO `municipios` VALUES ('2172', 'IXTENCO', '29');
INSERT INTO `municipios` VALUES ('2173', 'EMILIANO ZAPATA', '29');
INSERT INTO `municipios` VALUES ('2174', 'MAZATECOCHCO DE JOSÉ MARÍA MORELOS', '29');
INSERT INTO `municipios` VALUES ('2175', 'LÁZARO CÁRDENAS', '29');
INSERT INTO `municipios` VALUES ('2176', 'CONTLA DE  JUAN CUAMATZI', '29');
INSERT INTO `municipios` VALUES ('2177', 'LA MAGDALENA TLALTELULCO', '29');
INSERT INTO `municipios` VALUES ('2178', 'TEPETITLA DE LARDIZÁBAL', '29');
INSERT INTO `municipios` VALUES ('2179', 'SAN DAMIÁN TEXOLOC', '29');
INSERT INTO `municipios` VALUES ('2180', 'SANCTORUM DE LÁZARO CÁRDENAS', '29');
INSERT INTO `municipios` VALUES ('2181', 'SAN FRANCISCO TETLANOHCAN', '29');
INSERT INTO `municipios` VALUES ('2182', 'NANACAMILPA DE MARIANO ARISTA', '29');
INSERT INTO `municipios` VALUES ('2183', 'SAN JERÓNIMO ZACUALPAN', '29');
INSERT INTO `municipios` VALUES ('2184', 'ACUAMANALA DE MIGUEL HIDALGO', '29');
INSERT INTO `municipios` VALUES ('2185', 'SAN JOSÉ  TEACALCO', '29');
INSERT INTO `municipios` VALUES ('2186', 'NATIVITAS', '29');
INSERT INTO `municipios` VALUES ('2187', 'SAN JUAN HUACTZINCO', '29');
INSERT INTO `municipios` VALUES ('2188', 'PANOTLA', '29');
INSERT INTO `municipios` VALUES ('2189', 'SAN LORENZO AXOCOMANITLA', '29');
INSERT INTO `municipios` VALUES ('2190', 'SAN PABLO DEL MONTE', '29');
INSERT INTO `municipios` VALUES ('2191', 'SAN LUCAS TECOPILCO', '29');
INSERT INTO `municipios` VALUES ('2192', 'SANTA CRUZ TLAXCALA', '29');
INSERT INTO `municipios` VALUES ('2193', 'SANTA ANA NOPALUCAN', '29');
INSERT INTO `municipios` VALUES ('2194', 'TENANCINGO', '29');
INSERT INTO `municipios` VALUES ('2195', 'SANTA APOLONIA TEACALCO', '29');
INSERT INTO `municipios` VALUES ('2196', 'TEOLOCHOLCO', '29');
INSERT INTO `municipios` VALUES ('2197', 'SANTA CATARINA AYOMETLA', '29');
INSERT INTO `municipios` VALUES ('2198', 'TEPEYANCO', '29');
INSERT INTO `municipios` VALUES ('2199', 'SANTA CRUZ QUILEHTLA', '29');
INSERT INTO `municipios` VALUES ('2200', 'TERRENATE', '29');
INSERT INTO `municipios` VALUES ('2201', 'SANTA ISABEL XILOXOXTLA', '29');
INSERT INTO `municipios` VALUES ('2202', 'ACAJETE  ', '30');
INSERT INTO `municipios` VALUES ('2203', 'ACATLÁN ', '30');
INSERT INTO `municipios` VALUES ('2204', 'ACAYUCAN ', '30');
INSERT INTO `municipios` VALUES ('2205', 'ACTOPAN ', '30');
INSERT INTO `municipios` VALUES ('2206', 'ACULA ', '30');
INSERT INTO `municipios` VALUES ('2207', 'ACULTZINGO ', '30');
INSERT INTO `municipios` VALUES ('2208', 'AGUA DULCE', '30');
INSERT INTO `municipios` VALUES ('2209', 'ALPATLÁHUAC ', '30');
INSERT INTO `municipios` VALUES ('2210', 'ALTO LUCERO DE GUTIÉRREZ BARRIOS ', '30');
INSERT INTO `municipios` VALUES ('2211', 'ALTOTONGA ', '30');
INSERT INTO `municipios` VALUES ('2212', 'ALVARADO ', '30');
INSERT INTO `municipios` VALUES ('2213', 'AMATITLÁN ', '30');
INSERT INTO `municipios` VALUES ('2214', 'AMATLÁN DE LOS REYES ', '30');
INSERT INTO `municipios` VALUES ('2215', 'ANGEL R. CABADA ', '30');
INSERT INTO `municipios` VALUES ('2216', 'ANTIGUA, LA ', '30');
INSERT INTO `municipios` VALUES ('2217', 'APAZAPAN ', '30');
INSERT INTO `municipios` VALUES ('2218', 'AQUILA ', '30');
INSERT INTO `municipios` VALUES ('2219', 'ASTACINGA ', '30');
INSERT INTO `municipios` VALUES ('2220', 'ATLAHUILCO ', '30');
INSERT INTO `municipios` VALUES ('2221', 'ATOYAC ', '30');
INSERT INTO `municipios` VALUES ('2222', 'ATZACAN ', '30');
INSERT INTO `municipios` VALUES ('2223', 'ATZALAN ', '30');
INSERT INTO `municipios` VALUES ('2224', 'AYAHUALULCO ', '30');
INSERT INTO `municipios` VALUES ('2225', 'BANDERILLA ', '30');
INSERT INTO `municipios` VALUES ('2226', 'BENITO JUÁREZ ', '30');
INSERT INTO `municipios` VALUES ('2227', 'BOCA DEL RÍO ', '30');
INSERT INTO `municipios` VALUES ('2228', 'CALCAHUALCO ', '30');
INSERT INTO `municipios` VALUES ('2229', 'CAMARÓN DE TEJEDA ', '30');
INSERT INTO `municipios` VALUES ('2230', 'CAMERINO Z. MENDOZA ', '30');
INSERT INTO `municipios` VALUES ('2231', 'CARLOS A. CARRILLO', '30');
INSERT INTO `municipios` VALUES ('2232', 'CARRILLO PUERTO ', '30');
INSERT INTO `municipios` VALUES ('2233', 'CASTILLO DE TEAYO', '30');
INSERT INTO `municipios` VALUES ('2234', 'CATEMACO ', '30');
INSERT INTO `municipios` VALUES ('2235', 'CAZONES DE HERRERA ', '30');
INSERT INTO `municipios` VALUES ('2236', 'CERRO AZUL ', '30');
INSERT INTO `municipios` VALUES ('2237', 'CHACALTIANGUIS ', '30');
INSERT INTO `municipios` VALUES ('2238', 'CHALMA ', '30');
INSERT INTO `municipios` VALUES ('2239', 'CHICONAMEL ', '30');
INSERT INTO `municipios` VALUES ('2240', 'CHICONQUIACO ', '30');
INSERT INTO `municipios` VALUES ('2241', 'CHICONTEPEC ', '30');
INSERT INTO `municipios` VALUES ('2242', 'CHINAMECA ', '30');
INSERT INTO `municipios` VALUES ('2243', 'CHINAMPA DE GOROSTIZA ', '30');
INSERT INTO `municipios` VALUES ('2244', 'CHOAPAS, LAS ', '30');
INSERT INTO `municipios` VALUES ('2245', 'CHOCAMÁN ', '30');
INSERT INTO `municipios` VALUES ('2246', 'CHONTLA ', '30');
INSERT INTO `municipios` VALUES ('2247', 'CHUMATLÁN ', '30');
INSERT INTO `municipios` VALUES ('2248', 'CITLALTÉPETL ', '30');
INSERT INTO `municipios` VALUES ('2249', 'COACOATZINTLA ', '30');
INSERT INTO `municipios` VALUES ('2250', 'COAHUITLÁN ', '30');
INSERT INTO `municipios` VALUES ('2251', 'COATEPEC ', '30');
INSERT INTO `municipios` VALUES ('2252', 'COATZACOALCOS ', '30');
INSERT INTO `municipios` VALUES ('2253', 'COATZINTLA ', '30');
INSERT INTO `municipios` VALUES ('2254', 'COETZALA ', '30');
INSERT INTO `municipios` VALUES ('2255', 'COLIPA ', '30');
INSERT INTO `municipios` VALUES ('2256', 'COMAPA ', '30');
INSERT INTO `municipios` VALUES ('2257', 'CÓRDOBA ', '30');
INSERT INTO `municipios` VALUES ('2258', 'COSAMALOAPAN ', '30');
INSERT INTO `municipios` VALUES ('2259', 'COSAUTLÁN DE CARVAJAL ', '30');
INSERT INTO `municipios` VALUES ('2260', 'COSCOMATEPEC ', '30');
INSERT INTO `municipios` VALUES ('2261', 'COSOLEACAQUE ', '30');
INSERT INTO `municipios` VALUES ('2262', 'COTAXTLA ', '30');
INSERT INTO `municipios` VALUES ('2263', 'COXQUIHUI ', '30');
INSERT INTO `municipios` VALUES ('2264', 'COYUTLA ', '30');
INSERT INTO `municipios` VALUES ('2265', 'CUICHAPA ', '30');
INSERT INTO `municipios` VALUES ('2266', 'CUITLÁHUAC ', '30');
INSERT INTO `municipios` VALUES ('2267', 'EMILIANO ZAPATA ', '30');
INSERT INTO `municipios` VALUES ('2268', 'ESPINAL ', '30');
INSERT INTO `municipios` VALUES ('2269', 'FILOMENO MATA ', '30');
INSERT INTO `municipios` VALUES ('2270', 'FORTÍN ', '30');
INSERT INTO `municipios` VALUES ('2271', 'GUTIÉRREZ ZAMORA ', '30');
INSERT INTO `municipios` VALUES ('2272', 'HIDALGOTITLÁN ', '30');
INSERT INTO `municipios` VALUES ('2273', 'HIGO, EL', '30');
INSERT INTO `municipios` VALUES ('2274', 'HUATUSCO ', '30');
INSERT INTO `municipios` VALUES ('2275', 'HUAYACOCOTLA ', '30');
INSERT INTO `municipios` VALUES ('2276', 'HUEYAPAN DE OCAMPO ', '30');
INSERT INTO `municipios` VALUES ('2277', 'HUILOAPAN DE CUAUHTÉMOC ', '30');
INSERT INTO `municipios` VALUES ('2278', 'IGNACIO DE LA LLAVE ', '30');
INSERT INTO `municipios` VALUES ('2279', 'ILAMATLÁN ', '30');
INSERT INTO `municipios` VALUES ('2280', 'ISLA ', '30');
INSERT INTO `municipios` VALUES ('2281', 'IXCATEPEC ', '30');
INSERT INTO `municipios` VALUES ('2282', 'IXHUACÁN DE LOS REYES ', '30');
INSERT INTO `municipios` VALUES ('2283', 'IXHUATLAN DE MADERO ', '30');
INSERT INTO `municipios` VALUES ('2284', 'IXHUATLÁN DEL CAFE ', '30');
INSERT INTO `municipios` VALUES ('2285', 'IXHUATLÁN DEL SURESTE ', '30');
INSERT INTO `municipios` VALUES ('2286', 'IXHUATLANCILLO ', '30');
INSERT INTO `municipios` VALUES ('2287', 'IXMATLAHUACAN ', '30');
INSERT INTO `municipios` VALUES ('2288', 'IXTACZOQUITLÁN ', '30');
INSERT INTO `municipios` VALUES ('2289', 'JALACINGO ', '30');
INSERT INTO `municipios` VALUES ('2290', 'JALCOMULCO ', '30');
INSERT INTO `municipios` VALUES ('2291', 'JÁLTIPAN ', '30');
INSERT INTO `municipios` VALUES ('2292', 'JAMAPA ', '30');
INSERT INTO `municipios` VALUES ('2293', 'JESÚS CARRANZA ', '30');
INSERT INTO `municipios` VALUES ('2294', 'JILOTEPEC ', '30');
INSERT INTO `municipios` VALUES ('2295', 'JOSÉ AZUETA', '30');
INSERT INTO `municipios` VALUES ('2296', 'JUAN RODRÍGUEZ CLARA ', '30');
INSERT INTO `municipios` VALUES ('2297', 'JUCHIQUE DE FERRER ', '30');
INSERT INTO `municipios` VALUES ('2298', 'LANDERO Y COSS ', '30');
INSERT INTO `municipios` VALUES ('2299', 'LERDO DE TEJADA ', '30');
INSERT INTO `municipios` VALUES ('2300', 'MAGDALENA ', '30');
INSERT INTO `municipios` VALUES ('2301', 'MALTRATA ', '30');
INSERT INTO `municipios` VALUES ('2302', 'MANLIO FABIO ALTAMIRANO ', '30');
INSERT INTO `municipios` VALUES ('2303', 'MARIANO ESCOBEDO ', '30');
INSERT INTO `municipios` VALUES ('2304', 'MARTÍNEZ DE LA TORRE ', '30');
INSERT INTO `municipios` VALUES ('2305', 'MECATLÁN ', '30');
INSERT INTO `municipios` VALUES ('2306', 'MECAYAPAN ', '30');
INSERT INTO `municipios` VALUES ('2307', 'MEDELLÍN ', '30');
INSERT INTO `municipios` VALUES ('2308', 'MIAHUATLÁN', '30');
INSERT INTO `municipios` VALUES ('2309', 'MINAS, LAS', '30');
INSERT INTO `municipios` VALUES ('2310', 'MINATITLÁN', '30');
INSERT INTO `municipios` VALUES ('2311', 'MISANTLA', '30');
INSERT INTO `municipios` VALUES ('2312', 'MIXTLA DE ALTAMIRANO', '30');
INSERT INTO `municipios` VALUES ('2313', 'MOLOACÁN', '30');
INSERT INTO `municipios` VALUES ('2314', 'NANCHITAL DE LÁZARO CARDENAS DEL RÍO', '30');
INSERT INTO `municipios` VALUES ('2315', 'NAOLINCO', '30');
INSERT INTO `municipios` VALUES ('2316', 'NARANJAL', '30');
INSERT INTO `municipios` VALUES ('2317', 'NARANJOS-AMATLÁN ', '30');
INSERT INTO `municipios` VALUES ('2318', 'NAUTLA', '30');
INSERT INTO `municipios` VALUES ('2319', 'NOGALES', '30');
INSERT INTO `municipios` VALUES ('2320', 'OLUTA', '30');
INSERT INTO `municipios` VALUES ('2321', 'OMEALCA', '30');
INSERT INTO `municipios` VALUES ('2322', 'ORIZABA', '30');
INSERT INTO `municipios` VALUES ('2323', 'OTATITLÁN', '30');
INSERT INTO `municipios` VALUES ('2324', 'OTEAPAN', '30');
INSERT INTO `municipios` VALUES ('2325', 'OZULUAMA', '30');
INSERT INTO `municipios` VALUES ('2326', 'PAJAPAN', '30');
INSERT INTO `municipios` VALUES ('2327', 'PÁNUCO', '30');
INSERT INTO `municipios` VALUES ('2328', 'PAPANTLA', '30');
INSERT INTO `municipios` VALUES ('2329', 'PASO DE OVEJAS', '30');
INSERT INTO `municipios` VALUES ('2330', 'PASO DEL MACHO', '30');
INSERT INTO `municipios` VALUES ('2331', 'PERLA, LA', '30');
INSERT INTO `municipios` VALUES ('2332', 'PEROTE', '30');
INSERT INTO `municipios` VALUES ('2333', 'PLATÓN SÁNCHEZ', '30');
INSERT INTO `municipios` VALUES ('2334', 'PLAYA VICENTE', '30');
INSERT INTO `municipios` VALUES ('2335', 'POZA RICA DE HIDALGO', '30');
INSERT INTO `municipios` VALUES ('2336', 'PUEBLO VIEJO', '30');
INSERT INTO `municipios` VALUES ('2337', 'PUENTE NACIONAL', '30');
INSERT INTO `municipios` VALUES ('2338', 'RAFAEL DELGADO', '30');
INSERT INTO `municipios` VALUES ('2339', 'RAFAEL LUCIO', '30');
INSERT INTO `municipios` VALUES ('2340', 'REYES, LOS', '30');
INSERT INTO `municipios` VALUES ('2341', 'RÍO BLANCO', '30');
INSERT INTO `municipios` VALUES ('2342', 'SALTABARRANCA', '30');
INSERT INTO `municipios` VALUES ('2343', 'SAN ANDRÉS TENEJAPAN', '30');
INSERT INTO `municipios` VALUES ('2344', 'SAN ANDRÉS TUXTLA', '30');
INSERT INTO `municipios` VALUES ('2345', 'SAN JUAN EVANGELISTA', '30');
INSERT INTO `municipios` VALUES ('2346', 'SAN RAFAEL ', '30');
INSERT INTO `municipios` VALUES ('2347', 'SANTIAGO SOCHIAPAN', '30');
INSERT INTO `municipios` VALUES ('2348', 'SANTIAGO TUXTLA', '30');
INSERT INTO `municipios` VALUES ('2349', 'SAYULA DE ALEMÁN', '30');
INSERT INTO `municipios` VALUES ('2350', 'SOCHIAPA', '30');
INSERT INTO `municipios` VALUES ('2351', 'SOCONUSCO', '30');
INSERT INTO `municipios` VALUES ('2352', 'SOLEDAD ATZOMPA', '30');
INSERT INTO `municipios` VALUES ('2353', 'SOLEDAD DE DOBLADO', '30');
INSERT INTO `municipios` VALUES ('2354', 'SOTEAPAN', '30');
INSERT INTO `municipios` VALUES ('2355', 'TAMALÍN', '30');
INSERT INTO `municipios` VALUES ('2356', 'TAMIAHUA', '30');
INSERT INTO `municipios` VALUES ('2357', 'TAMPICO ALTO', '30');
INSERT INTO `municipios` VALUES ('2358', 'TANCOCO', '30');
INSERT INTO `municipios` VALUES ('2359', 'TANTIMA', '30');
INSERT INTO `municipios` VALUES ('2360', 'TANTOYUCA', '30');
INSERT INTO `municipios` VALUES ('2361', 'TATAHUICAPAN DE JUÁREZ', '30');
INSERT INTO `municipios` VALUES ('2362', 'TATATILA', '30');
INSERT INTO `municipios` VALUES ('2363', 'TECOLUTLA', '30');
INSERT INTO `municipios` VALUES ('2364', 'TEHUIPANGO', '30');
INSERT INTO `municipios` VALUES ('2365', 'TEMAPACHE', '30');
INSERT INTO `municipios` VALUES ('2366', 'TEMPOAL', '30');
INSERT INTO `municipios` VALUES ('2367', 'TENAMPA', '30');
INSERT INTO `municipios` VALUES ('2368', 'TENOCHTITLÁN', '30');
INSERT INTO `municipios` VALUES ('2369', 'TEOCELO', '30');
INSERT INTO `municipios` VALUES ('2370', 'TEPATLAXCO', '30');
INSERT INTO `municipios` VALUES ('2371', 'TEPETLÁN', '30');
INSERT INTO `municipios` VALUES ('2372', 'TEPETZINTLA', '30');
INSERT INTO `municipios` VALUES ('2373', 'TEQUILA', '30');
INSERT INTO `municipios` VALUES ('2374', 'TEXCATEPEC', '30');
INSERT INTO `municipios` VALUES ('2375', 'TEXHUACÁN', '30');
INSERT INTO `municipios` VALUES ('2376', 'TEXISTEPEC', '30');
INSERT INTO `municipios` VALUES ('2377', 'TEZONAPA', '30');
INSERT INTO `municipios` VALUES ('2378', 'TIERRA BLANCA', '30');
INSERT INTO `municipios` VALUES ('2379', 'TIHUATLÁN', '30');
INSERT INTO `municipios` VALUES ('2380', 'TLACHICHILCO', '30');
INSERT INTO `municipios` VALUES ('2381', 'TLACOJALPAN', '30');
INSERT INTO `municipios` VALUES ('2382', 'TLACOLULAN', '30');
INSERT INTO `municipios` VALUES ('2383', 'TLACOTALPAN', '30');
INSERT INTO `municipios` VALUES ('2384', 'TLACOTEPEC DE MEJÍA', '30');
INSERT INTO `municipios` VALUES ('2385', 'TLALIXCOYAN', '30');
INSERT INTO `municipios` VALUES ('2386', 'TLALNELHUAYOCAN', '30');
INSERT INTO `municipios` VALUES ('2387', 'TLALTETELA ', '30');
INSERT INTO `municipios` VALUES ('2388', 'TLAPACOYAN', '30');
INSERT INTO `municipios` VALUES ('2389', 'TLAQUILPA', '30');
INSERT INTO `municipios` VALUES ('2390', 'TLILAPAN', '30');
INSERT INTO `municipios` VALUES ('2391', 'TOMATLÁN', '30');
INSERT INTO `municipios` VALUES ('2392', 'TONAYÁN', '30');
INSERT INTO `municipios` VALUES ('2393', 'TOTUTLA', '30');
INSERT INTO `municipios` VALUES ('2394', 'TRES VALLES', '30');
INSERT INTO `municipios` VALUES ('2395', 'TUXPAN', '30');
INSERT INTO `municipios` VALUES ('2396', 'TUXTILLA', '30');
INSERT INTO `municipios` VALUES ('2397', 'ÚRSULO GALVÁN', '30');
INSERT INTO `municipios` VALUES ('2398', 'UXPANAPA', '30');
INSERT INTO `municipios` VALUES ('2399', 'VEGA DE ALATORRE', '30');
INSERT INTO `municipios` VALUES ('2400', 'VERACRUZ', '30');
INSERT INTO `municipios` VALUES ('2401', 'VIGAS DE RAMÍREZ, LAS', '30');
INSERT INTO `municipios` VALUES ('2402', 'VILLA ALDAMA', '30');
INSERT INTO `municipios` VALUES ('2403', 'XALAPA ', '30');
INSERT INTO `municipios` VALUES ('2404', 'XICO ', '30');
INSERT INTO `municipios` VALUES ('2405', 'XOXOCOTLA', '30');
INSERT INTO `municipios` VALUES ('2406', 'YANGA', '30');
INSERT INTO `municipios` VALUES ('2407', 'YECUATLA', '30');
INSERT INTO `municipios` VALUES ('2408', 'ZACUALPAN', '30');
INSERT INTO `municipios` VALUES ('2409', 'ZARAGOZA', '30');
INSERT INTO `municipios` VALUES ('2410', 'ZENTLA', '30');
INSERT INTO `municipios` VALUES ('2411', 'ZONGOLICA', '30');
INSERT INTO `municipios` VALUES ('2412', 'ZONTECOMATLÁN', '30');
INSERT INTO `municipios` VALUES ('2413', 'ZOZOCOLCO DE HIDALGO', '30');
INSERT INTO `municipios` VALUES ('2414', 'Abalá', '31');
INSERT INTO `municipios` VALUES ('2415', 'Acanceh', '31');
INSERT INTO `municipios` VALUES ('2416', 'Akil', '31');
INSERT INTO `municipios` VALUES ('2417', 'Baca', '31');
INSERT INTO `municipios` VALUES ('2418', 'Bokobá', '31');
INSERT INTO `municipios` VALUES ('2419', 'Buctzotz', '31');
INSERT INTO `municipios` VALUES ('2420', 'Cacalchén', '31');
INSERT INTO `municipios` VALUES ('2421', 'Calotmul', '31');
INSERT INTO `municipios` VALUES ('2422', 'Cansahcab', '31');
INSERT INTO `municipios` VALUES ('2423', 'Cantamayec', '31');
INSERT INTO `municipios` VALUES ('2424', 'Celestún', '31');
INSERT INTO `municipios` VALUES ('2425', 'Cenotillo', '31');
INSERT INTO `municipios` VALUES ('2426', 'Conkal', '31');
INSERT INTO `municipios` VALUES ('2427', 'Cuncunul', '31');
INSERT INTO `municipios` VALUES ('2428', 'Cuzamá', '31');
INSERT INTO `municipios` VALUES ('2429', 'Chacsinkín', '31');
INSERT INTO `municipios` VALUES ('2430', 'Chankom', '31');
INSERT INTO `municipios` VALUES ('2431', 'Chapab', '31');
INSERT INTO `municipios` VALUES ('2432', 'Chemax', '31');
INSERT INTO `municipios` VALUES ('2433', 'Chicxulub Pueblo', '31');
INSERT INTO `municipios` VALUES ('2434', 'Chichimilá', '31');
INSERT INTO `municipios` VALUES ('2435', 'Chikindzonot', '31');
INSERT INTO `municipios` VALUES ('2436', 'Chocholá', '31');
INSERT INTO `municipios` VALUES ('2437', 'Chumayel', '31');
INSERT INTO `municipios` VALUES ('2438', 'Dzan', '31');
INSERT INTO `municipios` VALUES ('2439', 'Dzemul', '31');
INSERT INTO `municipios` VALUES ('2440', 'Dzidzantún', '31');
INSERT INTO `municipios` VALUES ('2441', 'Dzilam de Bravo', '31');
INSERT INTO `municipios` VALUES ('2442', 'Dzilam González', '31');
INSERT INTO `municipios` VALUES ('2443', 'Dzitás', '31');
INSERT INTO `municipios` VALUES ('2444', 'Dzoncauich', '31');
INSERT INTO `municipios` VALUES ('2445', 'Espita', '31');
INSERT INTO `municipios` VALUES ('2446', 'Halachó', '31');
INSERT INTO `municipios` VALUES ('2447', 'Hocabá', '31');
INSERT INTO `municipios` VALUES ('2448', 'Hoctún', '31');
INSERT INTO `municipios` VALUES ('2449', 'Homún', '31');
INSERT INTO `municipios` VALUES ('2450', 'Huhí', '31');
INSERT INTO `municipios` VALUES ('2451', 'Hunucmá', '31');
INSERT INTO `municipios` VALUES ('2452', 'Ixil', '31');
INSERT INTO `municipios` VALUES ('2453', 'Izamal', '31');
INSERT INTO `municipios` VALUES ('2454', 'Kanasín', '31');
INSERT INTO `municipios` VALUES ('2455', 'Kantunil', '31');
INSERT INTO `municipios` VALUES ('2456', 'Kaua', '31');
INSERT INTO `municipios` VALUES ('2457', 'Kinchil', '31');
INSERT INTO `municipios` VALUES ('2458', 'Kopomá', '31');
INSERT INTO `municipios` VALUES ('2459', 'Mama', '31');
INSERT INTO `municipios` VALUES ('2460', 'Maní', '31');
INSERT INTO `municipios` VALUES ('2461', 'Maxcanú', '31');
INSERT INTO `municipios` VALUES ('2462', 'Mayapán', '31');
INSERT INTO `municipios` VALUES ('2463', 'Mérida', '31');
INSERT INTO `municipios` VALUES ('2464', 'Mocochá', '31');
INSERT INTO `municipios` VALUES ('2465', 'Motul', '31');
INSERT INTO `municipios` VALUES ('2466', 'Muna', '31');
INSERT INTO `municipios` VALUES ('2467', 'Muxupip', '31');
INSERT INTO `municipios` VALUES ('2468', 'Opichén', '31');
INSERT INTO `municipios` VALUES ('2469', 'Oxkutzcab', '31');
INSERT INTO `municipios` VALUES ('2470', 'Panabá', '31');
INSERT INTO `municipios` VALUES ('2471', 'Peto', '31');
INSERT INTO `municipios` VALUES ('2472', 'Progreso', '31');
INSERT INTO `municipios` VALUES ('2473', 'Quintana Roo Roo', '31');
INSERT INTO `municipios` VALUES ('2474', 'Río Lagartos', '31');
INSERT INTO `municipios` VALUES ('2475', 'Sacalum', '31');
INSERT INTO `municipios` VALUES ('2476', 'Samahil', '31');
INSERT INTO `municipios` VALUES ('2477', 'Sanahcat', '31');
INSERT INTO `municipios` VALUES ('2478', 'San Felipe', '31');
INSERT INTO `municipios` VALUES ('2479', 'Santa Elena', '31');
INSERT INTO `municipios` VALUES ('2480', 'Seyé', '31');
INSERT INTO `municipios` VALUES ('2481', 'Sinanché', '31');
INSERT INTO `municipios` VALUES ('2482', 'Sotuta', '31');
INSERT INTO `municipios` VALUES ('2483', 'Sucilá', '31');
INSERT INTO `municipios` VALUES ('2484', 'Sudzal', '31');
INSERT INTO `municipios` VALUES ('2485', 'Suma', '31');
INSERT INTO `municipios` VALUES ('2486', 'Tahdziú', '31');
INSERT INTO `municipios` VALUES ('2487', 'Tahmek', '31');
INSERT INTO `municipios` VALUES ('2488', 'Teabo', '31');
INSERT INTO `municipios` VALUES ('2489', 'Tecoh', '31');
INSERT INTO `municipios` VALUES ('2490', 'Tekal de Venegas', '31');
INSERT INTO `municipios` VALUES ('2491', 'Tekantó', '31');
INSERT INTO `municipios` VALUES ('2492', 'Tekax', '31');
INSERT INTO `municipios` VALUES ('2493', 'Tekit', '31');
INSERT INTO `municipios` VALUES ('2494', 'Tekom', '31');
INSERT INTO `municipios` VALUES ('2495', 'Telchac Pueblo', '31');
INSERT INTO `municipios` VALUES ('2496', 'Telchac Puerto', '31');
INSERT INTO `municipios` VALUES ('2497', 'Temax', '31');
INSERT INTO `municipios` VALUES ('2498', 'Temozón', '31');
INSERT INTO `municipios` VALUES ('2499', 'Tepakán', '31');
INSERT INTO `municipios` VALUES ('2500', 'Tetiz', '31');
INSERT INTO `municipios` VALUES ('2501', 'Teya', '31');
INSERT INTO `municipios` VALUES ('2502', 'Ticul', '31');
INSERT INTO `municipios` VALUES ('2503', 'Timucuy', '31');
INSERT INTO `municipios` VALUES ('2504', 'Tinúm', '31');
INSERT INTO `municipios` VALUES ('2505', 'Tixcacalcupul', '31');
INSERT INTO `municipios` VALUES ('2506', 'Tixkokob', '31');
INSERT INTO `municipios` VALUES ('2507', 'Tixméhuac', '31');
INSERT INTO `municipios` VALUES ('2508', 'Tixpéhual', '31');
INSERT INTO `municipios` VALUES ('2509', 'Tizimín', '31');
INSERT INTO `municipios` VALUES ('2510', 'Tunkás', '31');
INSERT INTO `municipios` VALUES ('2511', 'Tzucacab', '31');
INSERT INTO `municipios` VALUES ('2512', 'Uayma', '31');
INSERT INTO `municipios` VALUES ('2513', 'Ucú', '31');
INSERT INTO `municipios` VALUES ('2514', 'Umán', '31');
INSERT INTO `municipios` VALUES ('2515', 'Valladolid', '31');
INSERT INTO `municipios` VALUES ('2516', 'Xocchel', '31');
INSERT INTO `municipios` VALUES ('2517', 'Yaxcabá', '31');
INSERT INTO `municipios` VALUES ('2518', 'Yaxkukul', '31');
INSERT INTO `municipios` VALUES ('2519', 'Yobaín', '31');
INSERT INTO `municipios` VALUES ('2520', 'Apozol ', '32');
INSERT INTO `municipios` VALUES ('2521', 'Apulco ', '32');
INSERT INTO `municipios` VALUES ('2522', 'Atolinga ', '32');
INSERT INTO `municipios` VALUES ('2523', 'Benito Juárez ', '32');
INSERT INTO `municipios` VALUES ('2524', 'Calera ', '32');
INSERT INTO `municipios` VALUES ('2525', 'Cañitas de Feilpe Pescador ', '32');
INSERT INTO `municipios` VALUES ('2526', 'Concepción del Oro ', '32');
INSERT INTO `municipios` VALUES ('2527', 'Cuauhtémoc ', '32');
INSERT INTO `municipios` VALUES ('2528', 'Chalchihuites ', '32');
INSERT INTO `municipios` VALUES ('2529', 'Fresnillo ', '32');
INSERT INTO `municipios` VALUES ('2530', 'Genaro Codina ', '32');
INSERT INTO `municipios` VALUES ('2531', 'General Enrique Estrada ', '32');
INSERT INTO `municipios` VALUES ('2532', 'General Francisco R. Murguía ', '32');
INSERT INTO `municipios` VALUES ('2533', 'General Pánfilo Natera ', '32');
INSERT INTO `municipios` VALUES ('2534', 'Guadalupe ', '32');
INSERT INTO `municipios` VALUES ('2535', 'Huanusco ', '32');
INSERT INTO `municipios` VALUES ('2536', 'Jalpa ', '32');
INSERT INTO `municipios` VALUES ('2537', 'Jerez ', '32');
INSERT INTO `municipios` VALUES ('2538', 'Jiménez del Teul ', '32');
INSERT INTO `municipios` VALUES ('2539', 'Santa María de la Paz ', '32');
INSERT INTO `municipios` VALUES ('2540', 'Juan Aldama ', '32');
INSERT INTO `municipios` VALUES ('2541', 'Juchipila ', '32');
INSERT INTO `municipios` VALUES ('2542', 'Loreto ', '32');
INSERT INTO `municipios` VALUES ('2543', 'Luis Moya ', '32');
INSERT INTO `municipios` VALUES ('2544', 'Mazapil ', '32');
INSERT INTO `municipios` VALUES ('2545', 'Melchor Ocampo ', '32');
INSERT INTO `municipios` VALUES ('2546', 'Mezquital del Oro ', '32');
INSERT INTO `municipios` VALUES ('2547', 'Miguel Auza ', '32');
INSERT INTO `municipios` VALUES ('2548', 'Momax ', '32');
INSERT INTO `municipios` VALUES ('2549', 'Monte Escobedo ', '32');
INSERT INTO `municipios` VALUES ('2550', 'Morelos ', '32');
INSERT INTO `municipios` VALUES ('2551', 'Moyahua de Estrada ', '32');
INSERT INTO `municipios` VALUES ('2552', 'Nochistlán de Mejía ', '32');
INSERT INTO `municipios` VALUES ('2553', 'Noria de Ángeles ', '32');
INSERT INTO `municipios` VALUES ('2554', 'Ojocaliente ', '32');
INSERT INTO `municipios` VALUES ('2555', 'Pánuco ', '32');
INSERT INTO `municipios` VALUES ('2556', 'Pinos ', '32');
INSERT INTO `municipios` VALUES ('2557', 'Plateado de Joaquín Amaro, El ', '32');
INSERT INTO `municipios` VALUES ('2558', 'Río Grande ', '32');
INSERT INTO `municipios` VALUES ('2559', 'Saín Alto', '32');
INSERT INTO `municipios` VALUES ('2560', 'Salvador, El', '32');
INSERT INTO `municipios` VALUES ('2561', 'Sombrerete', '32');
INSERT INTO `municipios` VALUES ('2562', 'Susticacán', '32');
INSERT INTO `municipios` VALUES ('2563', 'Tabasco', '32');
INSERT INTO `municipios` VALUES ('2564', 'Tepechitlán', '32');
INSERT INTO `municipios` VALUES ('2565', 'Tepetongo', '32');
INSERT INTO `municipios` VALUES ('2566', 'Teul de González Ortega', '32');
INSERT INTO `municipios` VALUES ('2567', 'Tlaltenango de Sánchez Román', '32');
INSERT INTO `municipios` VALUES ('2568', 'Trancoso', '32');
INSERT INTO `municipios` VALUES ('2569', 'Trinidad García de la Cadena', '32');
INSERT INTO `municipios` VALUES ('2570', 'Valparaíso', '32');
INSERT INTO `municipios` VALUES ('2571', 'Vetagrande', '32');
INSERT INTO `municipios` VALUES ('2572', 'Villa de Cos', '32');
INSERT INTO `municipios` VALUES ('2573', 'Villa García', '32');
INSERT INTO `municipios` VALUES ('2574', 'Villa González Ortega', '32');
INSERT INTO `municipios` VALUES ('2575', 'Villa Hidalgo', '32');
INSERT INTO `municipios` VALUES ('2576', 'Villanueva', '32');
INSERT INTO `municipios` VALUES ('2577', 'Zacatecas', '32');
INSERT INTO `municipios` VALUES ('2581', 'Coyoacán', '9');
INSERT INTO `municipios` VALUES ('2582', 'Cuajimalpa', '9');
INSERT INTO `municipios` VALUES ('2583', 'Cuauhtémoc', '9');
INSERT INTO `municipios` VALUES ('2584', 'Gustavo A. Madero', '9');
INSERT INTO `municipios` VALUES ('2585', 'Iztacalco', '9');
INSERT INTO `municipios` VALUES ('2586', 'Iztapalapa', '9');
INSERT INTO `municipios` VALUES ('2587', 'Magdalena Contreras', '9');
INSERT INTO `municipios` VALUES ('2588', 'Miguel Hidalgo', '9');
INSERT INTO `municipios` VALUES ('2589', 'Milpa Alta', '9');
INSERT INTO `municipios` VALUES ('2590', 'Tláhuac ', '9');
INSERT INTO `municipios` VALUES ('2591', 'Tlalpan ', '9');
INSERT INTO `municipios` VALUES ('2592', 'Venustiano Carranza', '9');
INSERT INTO `municipios` VALUES ('2593', 'Xochimilco', '9');

-- ----------------------------
-- Table structure for `obrero`
-- ----------------------------
DROP TABLE IF EXISTS `obrero`;
CREATE TABLE `obrero` (
  `id_obrero` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_obrero` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `a_paterno` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `a_materno` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `direccion` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `celular` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono_casa` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `puestos_id_tipo_puesto` int(11) DEFAULT NULL,
  `oficina_id_oficina` int(11) DEFAULT NULL,
  `estado_civil` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `sexo` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `colonia` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ciudad` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado_id_estado` int(11) DEFAULT NULL,
  `activo` varchar(2) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_obrero`),
  KEY `fk_obrero_puestos1` (`puestos_id_tipo_puesto`),
  KEY `fk_obrero_oficina1` (`oficina_id_oficina`),
  KEY `fk_obrero_estados1` (`estado_id_estado`),
  CONSTRAINT `fk_obrero_estados1` FOREIGN KEY (`estado_id_estado`) REFERENCES `estados` (`id_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_obrero_oficina1` FOREIGN KEY (`oficina_id_oficina`) REFERENCES `oficina` (`id_oficina`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_obrero_puestos1` FOREIGN KEY (`puestos_id_tipo_puesto`) REFERENCES `puestos` (`id_tipo_puesto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of obrero
-- ----------------------------
INSERT INTO `obrero` VALUES ('1', 'AUGUSTO', 'ARANDA', 'RODRIGUEZ', '1977-03-26', 'CONOCIDA', '123123123', '1231231231', '5', '2', 'CASADO', 'F', 'COLONOIA', 'ASDASD', '21', '0');
INSERT INTO `obrero` VALUES ('2', 'FERNANDO', 'RAMIREZ', 'VELEZ', '1987-01-17', 'CUAHUTEMOC NORTE #101', '2224246788', '2231062450', '2', '3', 'CASADO', 'M', 'SAN JOSE EL CONDE', 'TLAXCALA', '12', '0');
INSERT INTO `obrero` VALUES ('3', 'Jesus', 'ramirez', 'velez', '1991-01-12', 'principal norte 101', '223104576', '2435610200', '8', '2', 'soltero', 'M', 'san miguel nacotepec', 'desconocida', '3', '0');
INSERT INTO `obrero` VALUES ('4', 'carlos', 'Hernandez', 'velez', '1987-01-01', 'avenida miguel mateos 102', '2234516980', '2234515255', '4', '2', 'soltero', 'M', 'centro', 'tepeaca', '9', '0');
INSERT INTO `obrero` VALUES ('6', 'ji', 'yhb', 'hy', '0000-00-00', 'lkjh', 'lkj', 'hl', '6', '2', 'hgkjh', 'M', 'mjhnklhjhkjh', 'kjhkj', '7', '0');
INSERT INTO `obrero` VALUES ('7', 'fernando', 'ramirez', 'velez', '1987-01-17', 'cuahutemoc norte 102', '2224246788', '2231062450', '8', '2', '', 'M', 'san juan negrete', 'tepeaca', '21', '1');
INSERT INTO `obrero` VALUES ('8', 'Emiliano', 'Gomez', 'Ramos', '1973-07-05', 'mirador 103', '2355652310', '2223106552', '2', '3', '', 'M', 'viveros san miguel', 'tecamachalco', '21', '0');

-- ----------------------------
-- Table structure for `oficina`
-- ----------------------------
DROP TABLE IF EXISTS `oficina`;
CREATE TABLE `oficina` (
  `id_oficina` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_oficina` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo_oficina_id_tipo_oficina` int(11) DEFAULT NULL,
  `direccion` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `colonia` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `rfc` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ciudad` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado_id_estado` int(11) DEFAULT NULL,
  `cp` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `logo` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `observaciones` varchar(140) COLLATE utf8_spanish_ci DEFAULT NULL,
  `coordx` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `coordy` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` varchar(2) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_oficina`),
  KEY `fk_oficina_tipo_oficina1` (`tipo_oficina_id_tipo_oficina`),
  KEY `fk_oficina_estados1` (`estado_id_estado`),
  CONSTRAINT `fk_oficina_estados1` FOREIGN KEY (`estado_id_estado`) REFERENCES `estados` (`id_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_oficina_tipo_oficina1` FOREIGN KEY (`tipo_oficina_id_tipo_oficina`) REFERENCES `tipo_oficina` (`id_tipo_oficina`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of oficina
-- ----------------------------
INSERT INTO `oficina` VALUES ('1', 'CRISTINA LOPEZ ESPINOZA', '1', 'CAMINO A LAS BOMBAS S/N', '', '', 'LOEC-740929-CU4', 'SAN MIGUEL TENANCINGO', '21', '90980', 'EASYLOAD.JPG', '', '19.129498', '-98.189449', '1');
INSERT INTO `oficina` VALUES ('2', 'Easy Load Empaques Bodega Puebla\r\n', '2', 'Carretera via corta Santa Ana Chiautempam', 'San Jose del Conde', '222 1228955', '', 'Puebla', '21', '', 'easyload.jpg\r\n', 'Ubicado muy cerca de las oficinas de la SCT Puebla\r\n', '19.102797', '-98.182111', '1');
INSERT INTO `oficina` VALUES ('3', 'EASY LOAD EMPAQUES BODEGA TLAXCALA', '2', 'CAMINO A LAS BOMBAS S/N', '222 0000000', '', '', 'SAN MIGUEL TENANCINGO', '29', '90980', 'EASYLOAD.JPG', 'DELANTE DE PINTUMEX VINEINDO DE SANTA ANA CHIAUTEMPAM A PUEBLA , EN LA ENTRADA DEL CAMINO HAY UN ASFALTADORA', '19.129498', '-98.189449', '1');
INSERT INTO `oficina` VALUES ('5', 'sdsdfsdf', '1', 'sdfsdfsd', 'fsdfsd', 'dfsdfsd', 'fsdfs', 'fsdf', '24', 'sdfsdf', 'sdfsdf', 'sdf', 'sdfsdf', 'sdsdfsdf', '0');
INSERT INTO `oficina` VALUES ('6', 'zxczxc', '1', 'zxczx', 'czxc', 'zxcz', 'xczx', 'czxc', '32', 'zxczxc', 'zxczx', 'czxc', 'zxczx', 'zxczxc', '0');

-- ----------------------------
-- Table structure for `orden`
-- ----------------------------
DROP TABLE IF EXISTS `orden`;
CREATE TABLE `orden` (
  `id_orden` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_entrega` date DEFAULT NULL,
  `prioridad` varchar(1) COLLATE utf8_spanish_ci DEFAULT '1',
  `cantidad` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `clientes_id_clientes` int(11) DEFAULT NULL,
  `descripcion` varchar(140) COLLATE utf8_spanish_ci DEFAULT NULL,
  `oficina_id_oficina` int(11) DEFAULT NULL,
  `diseno_producto_id_diseno_producto` int(11) DEFAULT NULL,
  `activo` varchar(2) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direcciones_id_direcciones` int(11) DEFAULT NULL,
  `cat_productos_asoc_id_cat_productos_asoc` int(11) DEFAULT NULL,
  `devoluciones_cliente_id_devoluciones_cliente` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_orden`),
  KEY `fk_orden_clientes1` (`clientes_id_clientes`),
  KEY `fk_orden_oficina1` (`oficina_id_oficina`),
  KEY `fk_orden_diseno_producto1` (`diseno_producto_id_diseno_producto`),
  KEY `fk_orden_direcciones1` (`direcciones_id_direcciones`),
  KEY `fk_orden_cat_productos_asoc1` (`cat_productos_asoc_id_cat_productos_asoc`),
  KEY `fk_orden_devoluciones_cliente1` (`devoluciones_cliente_id_devoluciones_cliente`),
  CONSTRAINT `fk_orden_cat_productos_asoc1` FOREIGN KEY (`cat_productos_asoc_id_cat_productos_asoc`) REFERENCES `cat_productos_asoc` (`id_cat_productos_asoc`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_orden_clientes1` FOREIGN KEY (`clientes_id_clientes`) REFERENCES `clientes` (`id_clientes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_orden_devoluciones_cliente1` FOREIGN KEY (`devoluciones_cliente_id_devoluciones_cliente`) REFERENCES `devoluciones_cliente` (`id_devoluciones_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_orden_direcciones1` FOREIGN KEY (`direcciones_id_direcciones`) REFERENCES `direcciones` (`id_direcciones`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_orden_diseno_producto1` FOREIGN KEY (`diseno_producto_id_diseno_producto`) REFERENCES `diseno_producto` (`id_diseno_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_orden_oficina1` FOREIGN KEY (`oficina_id_oficina`) REFERENCES `oficina` (`id_oficina`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of orden
-- ----------------------------

-- ----------------------------
-- Table structure for `pantallas`
-- ----------------------------
DROP TABLE IF EXISTS `pantallas`;
CREATE TABLE `pantallas` (
  `id_pantalla` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `url` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `orden` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `status` varchar(2) COLLATE utf8_spanish_ci DEFAULT '0',
  PRIMARY KEY (`id_pantalla`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of pantallas
-- ----------------------------
INSERT INTO `pantallas` VALUES ('1', 'Almacen', 'Modulo', null, null, null, '1');
INSERT INTO `pantallas` VALUES ('2', 'Oficinas', 'Modulo', null, null, null, '1');
INSERT INTO `pantallas` VALUES ('3', 'Clientes', 'Modulo', null, null, null, '1');
INSERT INTO `pantallas` VALUES ('4', 'Proveedores', 'Modulo', null, null, null, '1');
INSERT INTO `pantallas` VALUES ('5', 'Usuarios', 'Modulo', null, null, null, '1');
INSERT INTO `pantallas` VALUES ('6', 'Roles', 'Modulo', null, null, null, '1');
INSERT INTO `pantallas` VALUES ('7', 'Desperdicios', 'Modulo', null, null, null, '1');
INSERT INTO `pantallas` VALUES ('8', 'Pedidos a Proveedores', 'Modulo', null, null, null, '1');
INSERT INTO `pantallas` VALUES ('9', 'Pedidos de Clientes', 'Modulo', null, null, null, '1');
INSERT INTO `pantallas` VALUES ('10', 'Catalogo de Porductos', 'Modulo', null, null, null, '1');
INSERT INTO `pantallas` VALUES ('11', 'Catalogo de Materia Prima', 'Modulo', null, null, null, '1');
INSERT INTO `pantallas` VALUES ('12', 'Devoluciones Cliente', 'Modulo', null, null, null, '1');
INSERT INTO `pantallas` VALUES ('13', 'Devoluciones Proveedor', 'Modulo', null, null, null, '1');

-- ----------------------------
-- Table structure for `pedidos_reutilizable`
-- ----------------------------
DROP TABLE IF EXISTS `pedidos_reutilizable`;
CREATE TABLE `pedidos_reutilizable` (
  `id_pedido_reutilizable` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_pedido` date DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `proveedores_id_proveedores` int(11) DEFAULT NULL,
  `oficina` int(11) DEFAULT NULL,
  `cantidad` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` int(1) DEFAULT '1',
  `verificacion_almacen` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_pedido_reutilizable`),
  KEY `fk_pedido_reutilizable_proveedor` (`proveedores_id_proveedores`),
  KEY `fk_pedido_reutilizable_oficina` (`oficina`),
  CONSTRAINT `fk_pedido_reutilizable_oficina` FOREIGN KEY (`oficina`) REFERENCES `oficina` (`id_oficina`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedido_reutilizable_proveedor` FOREIGN KEY (`proveedores_id_proveedores`) REFERENCES `proveedores` (`id_proveedores`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of pedidos_reutilizable
-- ----------------------------
INSERT INTO `pedidos_reutilizable` VALUES ('11', '2012-06-08', '2012-06-09', '1', '3', '3', '0', null);
INSERT INTO `pedidos_reutilizable` VALUES ('12', '2012-06-08', '2012-06-16', '1', '2', '2', '0', null);
INSERT INTO `pedidos_reutilizable` VALUES ('13', '2012-06-08', '2012-06-09', '1', '3', '3', '0', null);

-- ----------------------------
-- Table structure for `pedido_proveedor`
-- ----------------------------
DROP TABLE IF EXISTS `pedido_proveedor`;
CREATE TABLE `pedido_proveedor` (
  `id_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_pedido` date DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `proveedores_id_proveedores` int(11) DEFAULT NULL,
  `oficina` int(11) DEFAULT NULL,
  `activo` int(1) DEFAULT '1',
  `verificacion_almacen` int(1) DEFAULT '1',
  PRIMARY KEY (`id_pedido`),
  KEY `fk_pedido_proveedor_proveedores1` (`proveedores_id_proveedores`),
  KEY `fk_pedidos_proveedor_oficina` (`oficina`),
  CONSTRAINT `fk_pedidos_proveedor_oficina` FOREIGN KEY (`oficina`) REFERENCES `oficina` (`id_oficina`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedido_proveedor_proveedores1` FOREIGN KEY (`proveedores_id_proveedores`) REFERENCES `proveedores` (`id_proveedores`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of pedido_proveedor
-- ----------------------------
INSERT INTO `pedido_proveedor` VALUES ('33', '2012-05-14', '2012-05-16', '1', '2', '0', '1');
INSERT INTO `pedido_proveedor` VALUES ('36', '2012-06-05', '2012-06-05', '1', '2', '0', '1');
INSERT INTO `pedido_proveedor` VALUES ('37', '2012-06-05', '2012-06-06', '1', '3', '0', '1');
INSERT INTO `pedido_proveedor` VALUES ('38', '2012-06-08', '2012-06-28', '1', '3', '1', '1');

-- ----------------------------
-- Table structure for `permisos`
-- ----------------------------
DROP TABLE IF EXISTS `permisos`;
CREATE TABLE `permisos` (
  `id_permisos` int(11) NOT NULL AUTO_INCREMENT,
  `permiso` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `status` varchar(2) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_roles` int(11) NOT NULL,
  `id_pantalla` int(11) NOT NULL,
  PRIMARY KEY (`id_permisos`),
  KEY `fk_permisos_roles1` (`id_roles`),
  KEY `fk_permisos_pantallas1` (`id_pantalla`),
  CONSTRAINT `fk_permisos_pantallas1` FOREIGN KEY (`id_pantalla`) REFERENCES `pantallas` (`id_pantalla`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_permisos_roles1` FOREIGN KEY (`id_roles`) REFERENCES `roles` (`id_roles`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of permisos
-- ----------------------------
INSERT INTO `permisos` VALUES ('13', '0010', '1', '4', '1');
INSERT INTO `permisos` VALUES ('14', '0010', '1', '4', '2');
INSERT INTO `permisos` VALUES ('15', '0010', '1', '4', '3');
INSERT INTO `permisos` VALUES ('16', '0010', '1', '4', '4');
INSERT INTO `permisos` VALUES ('17', '0010', '1', '4', '5');
INSERT INTO `permisos` VALUES ('18', '0010', '1', '4', '6');
INSERT INTO `permisos` VALUES ('19', '0010', '1', '4', '7');
INSERT INTO `permisos` VALUES ('20', '0010', '1', '4', '8');
INSERT INTO `permisos` VALUES ('21', '0010', '1', '4', '9');
INSERT INTO `permisos` VALUES ('22', '0010', '1', '4', '10');
INSERT INTO `permisos` VALUES ('23', '0010', '1', '4', '11');
INSERT INTO `permisos` VALUES ('24', '0010', '1', '4', '12');
INSERT INTO `permisos` VALUES ('25', '0010', '1', '4', '13');
INSERT INTO `permisos` VALUES ('26', '1111', '1', '1', '1');
INSERT INTO `permisos` VALUES ('27', '1111', '1', '1', '2');
INSERT INTO `permisos` VALUES ('28', '1111', '1', '1', '3');
INSERT INTO `permisos` VALUES ('29', '1111', '1', '1', '4');
INSERT INTO `permisos` VALUES ('30', '1111', '1', '1', '5');
INSERT INTO `permisos` VALUES ('31', '1111', '1', '1', '6');
INSERT INTO `permisos` VALUES ('32', '1111', '1', '1', '7');
INSERT INTO `permisos` VALUES ('33', '1111', '1', '1', '8');
INSERT INTO `permisos` VALUES ('34', '1111', '1', '1', '9');
INSERT INTO `permisos` VALUES ('35', '1111', '1', '1', '10');
INSERT INTO `permisos` VALUES ('36', '1111', '1', '1', '11');
INSERT INTO `permisos` VALUES ('37', '1111', '1', '1', '12');
INSERT INTO `permisos` VALUES ('38', '1111', '1', '1', '13');
INSERT INTO `permisos` VALUES ('39', '0010', '1', '5', '1');
INSERT INTO `permisos` VALUES ('40', '0010', '1', '5', '3');
INSERT INTO `permisos` VALUES ('41', '0010', '1', '5', '5');
INSERT INTO `permisos` VALUES ('42', '0010', '1', '5', '7');
INSERT INTO `permisos` VALUES ('43', '0010', '1', '5', '10');
INSERT INTO `permisos` VALUES ('44', '0010', '1', '5', '11');
INSERT INTO `permisos` VALUES ('45', '0010', '1', '5', '12');
INSERT INTO `permisos` VALUES ('46', '0010', '1', '5', '13');

-- ----------------------------
-- Table structure for `producto_terminado`
-- ----------------------------
DROP TABLE IF EXISTS `producto_terminado`;
CREATE TABLE `producto_terminado` (
  `id_producto_terminado` int(11) NOT NULL AUTO_INCREMENT,
  `observaciones` varchar(145) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` varchar(2) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cat_productos_asoc_id_cat_productos_asoc` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_producto_terminado`),
  KEY `fk_producto_terminado_cat_productos_asoc1` (`cat_productos_asoc_id_cat_productos_asoc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of producto_terminado
-- ----------------------------

-- ----------------------------
-- Table structure for `proveedores`
-- ----------------------------
DROP TABLE IF EXISTS `proveedores`;
CREATE TABLE `proveedores` (
  `id_proveedores` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_contacto` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre_empresa` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado_id_estado` int(11) DEFAULT NULL,
  `cp` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ciudad` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `lada` varchar(3) COLLATE utf8_spanish_ci DEFAULT NULL,
  `num_telefono` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ext` varchar(5) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fax` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `comentario` varchar(140) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` varchar(2) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_proveedores`),
  KEY `fk_proveedores_estados` (`estado_id_estado`),
  CONSTRAINT `fk_proveedores_estados` FOREIGN KEY (`estado_id_estado`) REFERENCES `estados` (`id_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of proveedores
-- ----------------------------
INSERT INTO `proveedores` VALUES ('1', 'GERMAN HERNANDEZ', 'ALTIPLANO', '21', '345678', 'CONOCIDA', 'DF', '555', '22134959', '34', '3434343433', 'ISC.FERNANDO.V@GMAIL.COM', 'NADA1', '1');
INSERT INTO `proveedores` VALUES ('2', 'GERMAN HERNANDEZ', 'Cartones puebla', '21', '345678', 'CONOCIDA', 'DF', '555', '22134959', '34', '3434343433', 'ISC.FERNANDO.V@GMAIL.COM', 'NADA', '0');
INSERT INTO `proveedores` VALUES ('9', 'sdfsdsdf', 'sd', '1', 'f', 'hj', 'hg', 'gjh', 'g', 'hjg', 'jh', 'gjh', 'g', '0');
INSERT INTO `proveedores` VALUES ('10', 'jhg', 'jhgj', '13', 'hjg', 'gjh', 'hj', 'g', 'jh', 'gj', 'hg', 'jh', 'g', '0');

-- ----------------------------
-- Table structure for `puestos`
-- ----------------------------
DROP TABLE IF EXISTS `puestos`;
CREATE TABLE `puestos` (
  `id_tipo_puesto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` varchar(2) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_tipo_puesto`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of puestos
-- ----------------------------
INSERT INTO `puestos` VALUES ('1', 'Socio Directivo', '1');
INSERT INTO `puestos` VALUES ('2', 'Director General', '1');
INSERT INTO `puestos` VALUES ('3', 'Gerente Administrativo', '1');
INSERT INTO `puestos` VALUES ('4', 'Jefe de Producción', '1');
INSERT INTO `puestos` VALUES ('5', 'Agente de ventas', '1');
INSERT INTO `puestos` VALUES ('6', 'Asistentes de Dirección', '1');
INSERT INTO `puestos` VALUES ('7', 'Asistente de Gerencia', '1');
INSERT INTO `puestos` VALUES ('8', 'Obreros', '1');

-- ----------------------------
-- Table structure for `resistencia_mprima`
-- ----------------------------
DROP TABLE IF EXISTS `resistencia_mprima`;
CREATE TABLE `resistencia_mprima` (
  `id_resistencia_mprima` int(11) NOT NULL AUTO_INCREMENT,
  `resistencia` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `caracteristica` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` varchar(2) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_resistencia_mprima`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of resistencia_mprima
-- ----------------------------
INSERT INTO `resistencia_mprima` VALUES ('1', 'SG', 'SG', '1');
INSERT INTO `resistencia_mprima` VALUES ('2', '21', '21', '1');
INSERT INTO `resistencia_mprima` VALUES ('3', '23', '23', '1');
INSERT INTO `resistencia_mprima` VALUES ('4', '26', '26', '1');
INSERT INTO `resistencia_mprima` VALUES ('5', '30', '36', '1');
INSERT INTO `resistencia_mprima` VALUES ('6', '36', '36', '1');
INSERT INTO `resistencia_mprima` VALUES ('7', '42', '42', '1');
INSERT INTO `resistencia_mprima` VALUES ('8', '51', '51', '1');
INSERT INTO `resistencia_mprima` VALUES ('9', '61', '61', '1');
INSERT INTO `resistencia_mprima` VALUES ('10', '71', '71', '1');
INSERT INTO `resistencia_mprima` VALUES ('11', '81', '81', '1');

-- ----------------------------
-- Table structure for `roles`
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id_roles` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `dsc_rol` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `status` varchar(2) COLLATE utf8_spanish_ci DEFAULT '1',
  PRIMARY KEY (`id_roles`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'ADMIN', 'PERMISOS  NIVEL 4', '1');
INSERT INTO `roles` VALUES ('2', 'fernando', 'nivel 4', '0');
INSERT INTO `roles` VALUES ('3', 'vistas', 'solo vistas', '0');
INSERT INTO `roles` VALUES ('4', 'Vistas', 'solo vistas', '0');
INSERT INTO `roles` VALUES ('5', 'administrativo', 'solo consultas', '1');

-- ----------------------------
-- Table structure for `tipo_oficina`
-- ----------------------------
DROP TABLE IF EXISTS `tipo_oficina`;
CREATE TABLE `tipo_oficina` (
  `id_tipo_oficina` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_tipo_oficina`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of tipo_oficina
-- ----------------------------
INSERT INTO `tipo_oficina` VALUES ('1', 'Oficina Fiscal\r\n', 'Oficina en tlaxcala', '1');
INSERT INTO `tipo_oficina` VALUES ('2', 'Bodega\r\n', 'oficina ', '1');

-- ----------------------------
-- Table structure for `usuarios`
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `password` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_roles` int(11) DEFAULT NULL,
  `fecha_alta` datetime DEFAULT NULL,
  `ultima_edicion` datetime DEFAULT NULL,
  `status` varchar(2) COLLATE utf8_spanish_ci DEFAULT '1',
  `email` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `oficina_id_oficina` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_roles1` (`id_roles`),
  KEY `fk_usuarios_oficina1` (`oficina_id_oficina`),
  CONSTRAINT `fk_usuarios_oficina1` FOREIGN KEY (`oficina_id_oficina`) REFERENCES `oficina` (`id_oficina`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_roles1` FOREIGN KEY (`id_roles`) REFERENCES `roles` (`id_roles`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES ('1', 'fer', '2$iPhdHr.qmpw', '1', '2012-01-17 00:00:00', '2012-04-03 00:00:00', '1', 'isc.fernando.v@gmail.com', 'Fernando', null);
INSERT INTO `usuarios` VALUES ('3', 'prueba3', '2$iPhdHr.qmpw', '1', '2012-05-11 09:02:46', null, '0', 'easy@easyload.com.mx', 'prueba3', '1');
