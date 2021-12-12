/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 100413
 Source Host           : localhost:3306
 Source Schema         : bank_abc

 Target Server Type    : MySQL
 Target Server Version : 100413
 File Encoding         : 65001

 Date: 12/12/2021 13:49:07
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for customer
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer`  (
  `application_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `date_of_birth` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `month_of_birth` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `postcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `contact_number` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `product` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `application_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `application_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `lucky_draw_entries` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`application_id`) USING BTREE,
  INDEX `application_id`(`application_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of customer
-- ----------------------------
INSERT INTO `customer` VALUES ('aaul0631693', 'a', 'a', '31', '05', 's21 3ul', '44100000100', '15000', 'withdrawn', '06/12/21', '60');
INSERT INTO `customer` VALUES ('asasas06606172', 'as', 'as', 'as', 'as', 'as', '44100000100', '10000', 'new', '06/12/21', '55');
INSERT INTO `customer` VALUES ('bbUL06822923', 'b', 'b', '31', '05', 'S21 3UL', '44100000100', '10000', 'new', '06/12/21', '55');
INSERT INTO `customer` VALUES ('BlDadf06146500', 'Dave', 'Blakemore', '31', '05', 's1 4df', '44100000100', '10000', 'new', '06/12/21', '55');
INSERT INTO `customer` VALUES ('ddfd06777325', 'd', 'd', '31', '05', 'ox27 8fd', '44100000100', '15000', 'new', '06/12/21', '60');
INSERT INTO `customer` VALUES ('eeDF06844222', 'e', 'e', '31', '05', 'S1 4DF', '44100000100', '10000', 'new', '06/12/21', '55');
INSERT INTO `customer` VALUES ('fej06349650', 'e', 'f', 'g', 'h', 'j', '44100000100', '10000', 'new', '06/12/21', '55');
INSERT INTO `customer` VALUES ('iil06469744', 'i', 'i', 'k', 'k', 'l', '44100000100', '5000', 'new', '06/12/21', '45');
INSERT INTO `customer` VALUES ('jamaul02962770', 'mackenzie', 'james', '31', '05', 's21 3ul', '44100000100', '15000', 'new', '02/11/21', '60');
INSERT INTO `customer` VALUES ('ooo06879549', 'o', 'o', 'o', 'o', 'o', '44100000100', '10000', 'new', '06/12/21', '55');
INSERT INTO `customer` VALUES ('PeJofd06950666', 'Johnny', 'Pew', '31', '05', 'ox27 8fd', '44100000100', '15000', 'new', '06/12/21', '60');
INSERT INTO `customer` VALUES ('ppr06663539', 'p', 'p', 'q', 'q', 'r', '44100000100', '15000', 'new', '06/12/21', '60');
INSERT INTO `customer` VALUES ('RuBrul06610858', 'Brownley', 'Ruth', '31', '05', 's21 3ul', '44100000100', '15000', 'new', '06/12/21', '60');
INSERT INTO `customer` VALUES ('ttt06111200', 't', 't', 't', 't', 't', '44100000100', '10000', 'new', '06/12/21', '55');

-- ----------------------------
-- Table structure for log
-- ----------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `application_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `action` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 36 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of log
-- ----------------------------
INSERT INTO `log` VALUES (1, 'jamaul02962770', 'james', 'Withdrew Application');
INSERT INTO `log` VALUES (2, 'jamaul02962770', 'james', 'Changed to product 100');
INSERT INTO `log` VALUES (3, 'jamaul02962770', 'james', 'Changed to product 100');
INSERT INTO `log` VALUES (4, 'jamaul02962770', 'james', 'Changed to product 15000');
INSERT INTO `log` VALUES (5, 'jamaul02962770', 'james', 'Changed to product 10000');
INSERT INTO `log` VALUES (6, 'jamaul02962770', 'james', 'Withdrew Application');
INSERT INTO `log` VALUES (7, 'jamaul02962770', '[ADMIN] Mackenzie', 'Changed to product 500');
INSERT INTO `log` VALUES (8, 'jamaul02962770', '[ADMIN] Mackenzie', 'Changed to product 10000');
INSERT INTO `log` VALUES (9, 'jamaul02962770', '[ADMIN] Mackenzie', 'Changed to product 10000');
INSERT INTO `log` VALUES (10, 'jamaul02962770', '[ADMIN] Mackenzie', 'Changed to product 15000');
INSERT INTO `log` VALUES (11, 'jamaul02962770', '[ADMIN] Mackenzie', 'Changed to product 15000');
INSERT INTO `log` VALUES (12, 'jamaul02962770', '[ADMIN] Mackenzie', 'Changed to product 15000');
INSERT INTO `log` VALUES (13, 'jamaul02962770', '[ADMIN] Mackenzie', 'Changed to product 15000');
INSERT INTO `log` VALUES (14, 'jamaul02962770', '[ADMIN] Mackenzie', 'Changed to product 15000');
INSERT INTO `log` VALUES (15, 'jamaul02962770', '[ADMIN] Mackenzie', 'Changed to product 15000');
INSERT INTO `log` VALUES (16, 'jamaul02962770', '[ADMIN] Mackenzie', 'Changed to product 15000');
INSERT INTO `log` VALUES (17, 'jamaul02962770', '[ADMIN] Mackenzie', 'Changed to product 15000');
INSERT INTO `log` VALUES (18, 'jamaul02962770', '[ADMIN] Mackenzie', 'Changed to product 15000');
INSERT INTO `log` VALUES (19, 'jamaul02962770', '[ADMIN] Mackenzie', 'Changed to product 15000');
INSERT INTO `log` VALUES (20, 'jamaul02962770', '[ADMIN] Mackenzie', 'Changed to product 15000');
INSERT INTO `log` VALUES (21, 'jamaul02962770', '[ADMIN] Mackenzie', 'Changed to product 15000, First Name To mackenzie, Last Name Tojames, Contact Number To 1142477987, Postcode To s21 3ul, Application Status To withdrawn');
INSERT INTO `log` VALUES (22, 'jamaul02962770', '[ADMIN] Mackenzie', 'Changed to product 15000, First Name To mackenzie, Last Name Tojames, Contact Number To 1142477987, Postcode To s21 3ul, Application Status To in-process');
INSERT INTO `log` VALUES (23, 'jamaul02962770', '[ADMIN] Mackenzie', 'Changed to product 15000, First Name To mackenzie, Last Name Tojames, Contact Number To 1142477987, Postcode To s21 3ul, Application Status To in-process');
INSERT INTO `log` VALUES (24, 'jamaul02962770', '[ADMIN] Mackenzie', 'Changed to product 15000, First Name To mackenzie, Last Name Tojames, Contact Number To 1142477987, Postcode To s21 3ul, Application Status To withdrawn');
INSERT INTO `log` VALUES (25, 'jamaul02962770', '[ADMIN] Mackenzie', 'Changed to product 15000, First Name To mackenzie, Last Name Tojames, Contact Number To 1142477987, Postcode To s21 3ul, Application Status To withdrawn');
INSERT INTO `log` VALUES (26, 'jamaul02962770', '[ADMIN] Mackenzie', 'Changed to product 15000, First Name To mackenzie, Last Name Tojames, Contact Number To 1142477987, Postcode To s21 3ul, Application Status To withdrawn');
INSERT INTO `log` VALUES (27, 'jamaul02962770', '[ADMIN] Mackenzie', 'Changed to product 15000, First Name To mackenzie, Last Name Tojames, Contact Number To 1142477987, Postcode To s21 3ul, Application Status To withdrawn');
INSERT INTO `log` VALUES (28, 'jamaul02962770', '[ADMIN] Mackenzie', 'Changed to product 15000, First Name To mackenzie, Last Name Tojames, Contact Number To 1142477987, Postcode To s21 3ul, Application Status To withdrawn');
INSERT INTO `log` VALUES (29, 'jamaul02962770', '[ADMIN] Mackenzie', 'Changed to product 15000, First Name To mackenzie, Last Name Tojames, Contact Number To 1142477987, Postcode To s21 3ul, Application Status To withdrawn');
INSERT INTO `log` VALUES (30, 'jamaul02962770', '[ADMIN] Mackenzie', 'Changed to product 15000, First Name To mackenzie, Last Name Tojames, Contact Number To 1142477987, Postcode To s21 3ul, Application Status To withdrawn');
INSERT INTO `log` VALUES (31, 'jamaul02962770', '[ADMIN] Mackenzie', 'Changed to product 15000, First Name To mackenzie, Last Name Tojames, Contact Number To 1142477987, Postcode To s21 3ul, Application Status To withdrawn');
INSERT INTO `log` VALUES (32, 'brrurx02298676', '[ADMIN] Mackenzie', 'Changed to product 10000, First Name To ruth, Last Name Tobrown, Contact Number To 2147483647, Postcode To s18 1rx, Application Status To withdrawn');
INSERT INTO `log` VALUES (33, 'brrurx02298676', '[ADMIN] Mackenzie', 'Deleted This User');
INSERT INTO `log` VALUES (34, 'aaul0631693', '[ADMIN] Mackenzie', 'Changed to product 15000, First Name To a, Last Name Toa, Contact Number To 44100000100, Postcode To s21 3ul, Application Status To in-process');
INSERT INTO `log` VALUES (35, 'aaul0631693', '[ADMIN] Mackenzie', 'Changed to product 15000, First Name To a, Last Name Toa, Contact Number To 44100000100, Postcode To s21 3ul, Application Status To withdrawn');

-- ----------------------------
-- Table structure for staff
-- ----------------------------
DROP TABLE IF EXISTS `staff`;
CREATE TABLE `staff`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of staff
-- ----------------------------
INSERT INTO `staff` VALUES (1, 'Mackenzie', '9791d7dc0d627d8be59c8f2dea17bfc3');

SET FOREIGN_KEY_CHECKS = 1;
