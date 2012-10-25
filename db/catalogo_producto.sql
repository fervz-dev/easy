/*
Navicat MySQL Data Transfer

Source Server         : www.easyload.com.mx
Source Server Version : 50165
Source Host           : easyload.com.mx:3306
Source Database       : wwweasy_db

Target Server Type    : MYSQL
Target Server Version : 50165
File Encoding         : 65001

Date: 2012-10-15 11:18:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `catalogo_producto`
-- ----------------------------
DROP TABLE IF EXISTS `catalogo_producto`;
CREATE TABLE `catalogo_producto` (
  `id_catalogo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `largo` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ancho` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `alto` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `resistencia` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `corrugado` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `score` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` varchar(600) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `activo` varchar(2) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_sucursal` int(11) DEFAULT NULL,
  `id_archivos` int(11) DEFAULT '0',
  PRIMARY KEY (`id_catalogo`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of catalogo_producto
-- ----------------------------
INSERT INTO `catalogo_producto` VALUES ('9', 'sb8r', '120', '124', '122', '3', 'SENCILLO', '', '\n			', '2012-09-14', '0', '1', '1', '0');
INSERT INTO `catalogo_producto` VALUES ('10', 'prueba', '120', '123', '212', '2', 'SENCILLO', '', '\n			', '2012-09-14', '0', '1', '1', '0');
INSERT INTO `catalogo_producto` VALUES ('11', 'volvo', '52', '35', '5', '7', 'DOBLE', '', '\n			', '2012-09-14', '0', '3', '1', '0');
INSERT INTO `catalogo_producto` VALUES ('12', 'volvo', '52', '35', '5', '7', 'DOBLE', '', '\n			', '2012-09-14', '0', '3', '1', '0');
INSERT INTO `catalogo_producto` VALUES ('13', 'volvo', '52', '35', '5', '7', 'DOBLE', '', '\n			', '2012-09-14', '0', '3', '1', '0');
INSERT INTO `catalogo_producto` VALUES ('14', 'volvo', '52', '35', '5', '7', 'DOBLE', 'si', '\n			', '2012-09-14', '0', '3', '1', '0');
INSERT INTO `catalogo_producto` VALUES ('15', 'volvo', '52', '35', '5', '7', 'DOBLE', 'si', '\n			', '2012-09-14', '0', '3', '1', '0');
INSERT INTO `catalogo_producto` VALUES ('16', 'caja chica (troquelada)', '154', '104', '', '7', 'DOBLE', '', '\n			', '2012-09-14', '1', '3', '1', '0');
INSERT INTO `catalogo_producto` VALUES ('17', 'caja mediana (traquelada)', '193', '104', '', '7', 'DOBLE', '', '\n			', '2012-09-14', '1', '3', '1', '0');
INSERT INTO `catalogo_producto` VALUES ('18', 'caja grande (troquelada)', '265', '25', '18.5', '7', 'DOBLE', '', '\n			', '2012-09-14', '1', '3', '1', '0');
INSERT INTO `catalogo_producto` VALUES ('19', 'separador', '104', '111', '', '1', 'SENCILLO', '', '\n			', '2012-09-14', '0', '3', '1', '0');
INSERT INTO `catalogo_producto` VALUES ('20', 'caja pizza', '1.20', '90', '', '7', 'DOBLE', '', '\n			', '2012-09-20', '1', '3', '1', '0');
INSERT INTO `catalogo_producto` VALUES ('21', 'caja regular 6949 c/banda', '112', '98', '50', '7', 'DOBLE', '', '\n			', '2012-09-20', '1', '3', '1', '0');
INSERT INTO `catalogo_producto` VALUES ('22', 'separador de la caja', '110', '97', '', '1', 'SENCILLO', '', '\n			', '2012-09-20', '1', '3', '1', '0');
INSERT INTO `catalogo_producto` VALUES ('23', 'caja volvo', '50', '33', '18.5', '7', 'DOBLE', '', '\n			', '2012-09-20', '1', '3', '1', '0');
INSERT INTO `catalogo_producto` VALUES ('24', 'caja volvo', '50', '33', '18.5', '7', 'DOBLE', '', '\n			', '2012-09-20', '0', '3', '1', '0');
INSERT INTO `catalogo_producto` VALUES ('25', 'sujetador de 1 hilera', '8', '25', '', '1', 'SENCILLO', '', '\n			', '2012-09-20', '1', '3', '1', '0');
INSERT INTO `catalogo_producto` VALUES ('26', 'sujetador de 3 hileras', '9', '25', '', '1', 'SENCILLO', '', '\n			', '2012-09-20', '1', '3', '1', '0');
INSERT INTO `catalogo_producto` VALUES ('27', 'sujetador de 3 hileras', '9', '25', '', '1', 'SENCILLO', '', '\n			', '2012-09-20', '0', '3', '1', '0');
INSERT INTO `catalogo_producto` VALUES ('28', 'TACON', '10', '5', '5', '1', 'SENCILLO', '', '\n			', '2012-09-20', '1', '3', '1', '0');
INSERT INTO `catalogo_producto` VALUES ('29', 'TACON', '10', '5', '3.5', '1', 'SENCILLO', '', '\n			', '2012-09-20', '1', '3', '1', '0');
INSERT INTO `catalogo_producto` VALUES ('30', 'SEPARADOR ROPACK', '104', '111', '', '1', 'SENCILLO', '', '\n			', '2012-09-20', '1', '3', '1', '0');
INSERT INTO `catalogo_producto` VALUES ('31', 'BANDA SOLUTIA C/ TAPA Y BASE', '101.5', '101.5', '90', '7', 'DOBLE', '', '\n			', '2012-09-20', '1', '3', '1', '0');
INSERT INTO `catalogo_producto` VALUES ('32', 'BANDA SOLUTIA', '101.5', '101.5', '90', '7', 'DOBLE', '', '\n			', '2012-09-20', '1', '3', '1', '0');
INSERT INTO `catalogo_producto` VALUES ('33', '1/2 CAJA EK 5983', '116', '73', '67', '7', 'DOBLE', '', '\n			', '2012-09-20', '1', '3', '1', '0');
INSERT INTO `catalogo_producto` VALUES ('34', 'TAPA OARA CAJA EK59 83', '118', '75', '', '5', 'DOBLE', '', '\n			', '2012-09-20', '1', '3', '1', '0');
INSERT INTO `catalogo_producto` VALUES ('35', 'BANDA DE LA 1/2 CAJA EK 59 83', '69', '36', '66', '5', 'DOBLE', '', '\n			', '2012-09-20', '1', '3', '1', '0');
INSERT INTO `catalogo_producto` VALUES ('36', 'asdas', '12', '12', '12', '4', 'DOBLE', '', '\n	asdasdasd		', '2012-10-04', '0', '1', '1', '0');
