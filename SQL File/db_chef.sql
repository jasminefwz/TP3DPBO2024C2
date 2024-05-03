/*
Navicat MySQL Data Transfer

Source Server         : koneksi01
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : db_chef

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-05-03 18:17:02
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `chef`
-- ----------------------------
DROP TABLE IF EXISTS `chef`;
CREATE TABLE `chef` (
  `id_chef` int(11) NOT NULL AUTO_INCREMENT,
  `foto_chef` varchar(255) NOT NULL,
  `name_chef` varchar(100) NOT NULL,
  `asal_chef` varchar(50) NOT NULL,
  `telp_chef` int(20) NOT NULL,
  `id_food` int(11) DEFAULT NULL,
  `id_resto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_chef`),
  KEY `FOODD` (`id_food`),
  KEY `RESTOO` (`id_resto`),
  CONSTRAINT `FOODD` FOREIGN KEY (`id_food`) REFERENCES `food` (`id_food`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `RESTOO` FOREIGN KEY (`id_resto`) REFERENCES `resto` (`id_resto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of chef
-- ----------------------------
INSERT INTO `chef` VALUES ('5', 'jay.png', 'Jay Park', 'Washington', '6211111', '10', '6');
INSERT INTO `chef` VALUES ('11', 'baek.jpg', 'Baek Jongwon', 'Yesan County', '6222222', '6', '7');
INSERT INTO `chef` VALUES ('12', 'jihyo.jpg', 'Jihyo Park', 'Singapore', '6233333', '11', '6');
INSERT INTO `chef` VALUES ('13', 'jin.jpg', 'Seokjin Kim', 'Singapore', '6244444', '10', '6');
INSERT INTO `chef` VALUES ('14', 'mingyu.jpg', 'Mingyu Kim', 'Indonesia', '6255555', '9', '7');
INSERT INTO `chef` VALUES ('15', 'yoona.jpeg', 'Yoona Im', 'Seoul', '6266666', '13', '4');

-- ----------------------------
-- Table structure for `food`
-- ----------------------------
DROP TABLE IF EXISTS `food`;
CREATE TABLE `food` (
  `id_food` int(11) NOT NULL AUTO_INCREMENT,
  `name_food` varchar(100) NOT NULL,
  PRIMARY KEY (`id_food`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of food
-- ----------------------------
INSERT INTO `food` VALUES ('5', 'Bingsoo');
INSERT INTO `food` VALUES ('6', 'Jjampong');
INSERT INTO `food` VALUES ('9', 'Tangsuyuk');
INSERT INTO `food` VALUES ('10', 'Dakgalbi');
INSERT INTO `food` VALUES ('11', 'Kimchi Jigae');
INSERT INTO `food` VALUES ('12', 'Japchae');
INSERT INTO `food` VALUES ('13', 'Tteokbokki');

-- ----------------------------
-- Table structure for `resto`
-- ----------------------------
DROP TABLE IF EXISTS `resto`;
CREATE TABLE `resto` (
  `id_resto` int(11) NOT NULL AUTO_INCREMENT,
  `name_resto` varchar(100) NOT NULL,
  PRIMARY KEY (`id_resto`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of resto
-- ----------------------------
INSERT INTO `resto` VALUES ('3', 'Gaon Restaurant');
INSERT INTO `resto` VALUES ('4', 'Seoul Restaurant');
INSERT INTO `resto` VALUES ('6', 'Itaewoon Restaurant');
INSERT INTO `resto` VALUES ('7', 'Jungsik Restaurant');
