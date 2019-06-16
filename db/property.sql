/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 100138
 Source Host           : localhost:3306
 Source Schema         : property

 Target Server Type    : MySQL
 Target Server Version : 100138
 File Encoding         : 65001

 Date: 16/06/2019 06:31:07
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for adv_instalments
-- ----------------------------
DROP TABLE IF EXISTS `adv_instalments`;
CREATE TABLE `adv_instalments`  (
  `adv_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NULL DEFAULT NULL,
  `sale_id` int(11) NULL DEFAULT NULL,
  `adv_amount` decimal(23, 2) NULL DEFAULT NULL,
  `adv_date` date NULL DEFAULT NULL,
  `adv_status` enum('Pending','Paid') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `adv_receive_date` date NULL DEFAULT NULL,
  `adv_receive_by` int(255) NULL DEFAULT NULL,
  `instalment_number` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `instalment_description` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `amount_in_words` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `adv_paid_amount` decimal(23, 2) NULL DEFAULT NULL,
  `slip_number` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`adv_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of adv_instalments
-- ----------------------------
INSERT INTO `adv_instalments` VALUES (1, 1, 1, 50.00, '2019-06-15', 'Paid', '2019-06-15', 1, 'ADV-4', 'This is instalment', NULL, 50.00, '1234');
INSERT INTO `adv_instalments` VALUES (2, 1, 1, 15.00, '2019-07-08', 'Paid', '2019-06-15', 1, 'ADV-5', 'This is instalment', NULL, 15.00, '1234');
INSERT INTO `adv_instalments` VALUES (3, 1, 1, 25.67, '2019-07-08', 'Pending', NULL, NULL, NULL, NULL, NULL, 0.00, NULL);
INSERT INTO `adv_instalments` VALUES (4, 1, 1, 10.00, '2019-06-17', 'Pending', NULL, NULL, NULL, NULL, NULL, 0.00, NULL);

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers`  (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL,
  `customer_first_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `customer_last_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `customer_phone` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cutomer_email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `customer_identity` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cutomer_identity_type` enum('ID','Passport') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'ID',
  `customer_cast` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `customer_address` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `customer_status` enum('Active','Inactive','Blocked','Defaulter') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`customer_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES (1, 1, 'Kalil', 'Raza', '23658774', NULL, '4562155201252', 'ID', NULL, 'Roadside Drive', 'Active');
INSERT INTO `customers` VALUES (2, 1, 'Usman', 'Tahir', '23658774', NULL, '4562155201253', 'ID', NULL, 'Roadside Drive', 'Active');

-- ----------------------------
-- Table structure for dayopenclose
-- ----------------------------
DROP TABLE IF EXISTS `dayopenclose`;
CREATE TABLE `dayopenclose`  (
  `day_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL,
  `day_open_amount` decimal(23, 5) NULL DEFAULT NULL,
  `day_close_amount` decimal(23, 5) NULL DEFAULT NULL,
  `day_opendate` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `day_closedate` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `day_status` enum('open','closed') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`day_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of dayopenclose
-- ----------------------------
INSERT INTO `dayopenclose` VALUES (1, 1, 600.00000, -149121.66000, '2019-06-13 17:02:47', '2019-06-16 00:00:00', 'closed');
INSERT INTO `dayopenclose` VALUES (2, 1, 100000.00000, 100000.00000, '2019-06-16 05:11:24', '2019-06-16 00:00:00', 'closed');
INSERT INTO `dayopenclose` VALUES (3, 1, 1000.00000, 1000.00000, '2019-06-16 05:18:40', '2019-06-16 00:00:00', 'closed');

-- ----------------------------
-- Table structure for instalments
-- ----------------------------
DROP TABLE IF EXISTS `instalments`;
CREATE TABLE `instalments`  (
  `instalment_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL,
  `property_id` int(11) NULL DEFAULT NULL,
  `instalment_number` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `instalment_date` datetime(0) NULL DEFAULT NULL,
  `property_number` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `customer_id` int(11) NULL DEFAULT NULL,
  `amount_type` enum('Advance','Installment') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Installment',
  `instalment_amount` decimal(20, 5) NULL DEFAULT NULL,
  `instalment_description` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `customer_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_created` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `total_amount` decimal(20, 5) NULL DEFAULT NULL,
  `amount_in_words` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sale_id` int(11) NULL DEFAULT NULL,
  `installment_status` enum('Pending','Paid','Late') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Pending',
  `date_paid` date NULL DEFAULT NULL,
  `slip_number` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`instalment_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of instalments
-- ----------------------------
INSERT INTO `instalments` VALUES (1, 1, 1, 'RV-4', '2019-07-15 00:00:00', '12345', 1, 'Installment', 106.67000, 'This is Sale', 'Kalil Raza', '2019-06-16 02:07:01', 106.67000, 'One Lak Fifty Thousand', 1, 'Paid', '2019-06-15', '12345');
INSERT INTO `instalments` VALUES (2, 1, 1, 'RV-5', '2019-08-15 00:00:00', '12345', 1, 'Installment', 106.67000, 'This is Sale', 'Kalil Raza', '2019-06-16 02:07:01', 106.67000, 'One Lak Fifty Thousand', 1, 'Paid', '2019-06-15', '123456');
INSERT INTO `instalments` VALUES (3, NULL, 1, NULL, '2019-09-15 00:00:00', '12345', 1, 'Installment', 106.67000, NULL, 'Kalil Raza', '2019-06-16 02:07:01', 106.67000, NULL, 1, 'Pending', NULL, NULL);
INSERT INTO `instalments` VALUES (4, NULL, 1, NULL, '2019-10-15 00:00:00', '12345', 1, 'Installment', 106.67000, NULL, 'Kalil Raza', '2019-06-16 02:07:01', 106.67000, NULL, 1, 'Pending', NULL, NULL);

-- ----------------------------
-- Table structure for ledger
-- ----------------------------
DROP TABLE IF EXISTS `ledger`;
CREATE TABLE `ledger`  (
  `ledger_id` int(11) NOT NULL AUTO_INCREMENT COMMENT ' ',
  `day_id` int(11) NULL DEFAULT NULL,
  `user_id` int(11) NULL DEFAULT NULL,
  `customer_id` int(11) NULL DEFAULT NULL,
  `type` enum('debit','credit') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `customer_type` enum('vender','customer') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'customer',
  `date_created` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `amount` decimal(23, 5) NULL DEFAULT NULL,
  `vocher_number` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `vocher_type` enum('vender','advance','instalment') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ledger_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ledger
-- ----------------------------
INSERT INTO `ledger` VALUES (1, 1, 1, 1, 'debit', 'customer', '2019-06-16 02:07:21', 50.00000, 'ADV-4', 'advance');
INSERT INTO `ledger` VALUES (2, 1, 1, 1, 'debit', 'customer', '2019-06-16 02:07:50', 106.67000, 'RV-4', 'instalment');
INSERT INTO `ledger` VALUES (3, 1, 1, 1, 'debit', 'customer', '2019-06-16 02:08:05', 106.67000, 'RV-5', 'instalment');
INSERT INTO `ledger` VALUES (4, 1, 1, 1, 'debit', 'customer', '2019-06-16 02:08:31', 15.00000, 'ADV-5', 'advance');
INSERT INTO `ledger` VALUES (5, 1, 1, 2, 'credit', 'vender', '2019-06-16 02:08:58', 150000.00000, 'VR-4', 'vender');

-- ----------------------------
-- Table structure for nominee
-- ----------------------------
DROP TABLE IF EXISTS `nominee`;
CREATE TABLE `nominee`  (
  `nominee_id` int(11) NOT NULL AUTO_INCREMENT,
  `nominee_first_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nominee_last_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nominee_identity` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nominee_identity_type` enum('ID','Passport') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'ID',
  `nominee_phone` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nominee_relation` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nominee_address` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nominee_cast` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `customer_id` int(11) NULL DEFAULT NULL,
  `property_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`nominee_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of nominee
-- ----------------------------
INSERT INTO `nominee` VALUES (1, 'Taha', 'Tahir', '986532147896', 'ID', '7410556328', 'Brothor', 'Roadside Drive', 'Rajpoot', 1, 1);
INSERT INTO `nominee` VALUES (2, 'Taha', 'Tahir', '986532147896', 'ID', '7410556328', 'Brothor', 'Roadside Drive', 'Rajpoot', 1, 1);
INSERT INTO `nominee` VALUES (3, 'Taha', 'Tahir', '986532147896', 'ID', '7410556328', 'Brothor', 'Roadside Drive', 'Rajpoot', 1, 1);

-- ----------------------------
-- Table structure for payments
-- ----------------------------
DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments`  (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `vender_id` int(11) NULL DEFAULT NULL,
  `payment_date` datetime(0) NULL DEFAULT NULL,
  `r_p_number` int(11) NULL DEFAULT NULL,
  `slip_number` int(11) NULL DEFAULT NULL,
  `amount` decimal(23, 5) NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `user_id` int(11) NULL DEFAULT NULL,
  `day_id` int(11) NULL DEFAULT NULL,
  `vocher_number` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`payment_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of payments
-- ----------------------------
INSERT INTO `payments` VALUES (1, 2, '2019-06-15 00:00:00', 123, 1234, 150000.00000, 'This is instalment', 1, 1, 'VR-4');

-- ----------------------------
-- Table structure for property
-- ----------------------------
DROP TABLE IF EXISTS `property`;
CREATE TABLE `property`  (
  `property_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL,
  `property_number` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `property_in_marla` decimal(23, 1) NULL DEFAULT NULL,
  `property_in_sarsahi` decimal(23, 1) NULL DEFAULT NULL,
  `property_per_marla` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `property_total_price` decimal(10, 2) NULL DEFAULT NULL,
  `property_status` enum('Available','Sold','Hold','Instalment','Transferrd','Booked') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Available',
  `property_date_created` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`property_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of property
-- ----------------------------
INSERT INTO `property` VALUES (1, 1, '12345', 5.0, 3.0, '100', 533.33, 'Booked', '2019-06-16 02:07:01');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `role` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `role_status` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`role_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'Administrator', 'administrator', 'Active');
INSERT INTO `roles` VALUES (2, 'Manager', 'manager', 'Active');

-- ----------------------------
-- Table structure for sale
-- ----------------------------
DROP TABLE IF EXISTS `sale`;
CREATE TABLE `sale`  (
  `sale_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NULL DEFAULT NULL,
  `customer_id` int(11) NULL DEFAULT NULL,
  `nominee_id` int(11) NULL DEFAULT NULL,
  `user_id` int(11) NULL DEFAULT NULL,
  `total_price` decimal(20, 5) NULL DEFAULT NULL,
  `advance_percent` int(10) NULL DEFAULT NULL,
  `advance_amount` decimal(20, 5) NULL DEFAULT NULL,
  `remaining_advance` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `remaning_advance_payment_date` datetime(0) NULL DEFAULT NULL,
  `total_instalments` int(100) NULL DEFAULT NULL,
  `instalment_amount` decimal(20, 5) NULL DEFAULT NULL,
  `instalment_payment_date` datetime(0) NULL DEFAULT NULL,
  `token_number` varchar(100) CHARACTER SET swe7 COLLATE swe7_swedish_ci NULL DEFAULT NULL,
  `property_token` decimal(20, 5) NULL DEFAULT NULL,
  `sale_date_created` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `description` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `customer_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `customer_identity` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `property_number` int(11) NULL DEFAULT NULL,
  `customer_image` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `customer_file` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`sale_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sale
-- ----------------------------
INSERT INTO `sale` VALUES (1, 1, 1, NULL, 1, 533.33000, 20, 106.67000, '56.67', '2019-06-05 00:00:00', 4, 106.67000, '2019-06-05 00:00:00', '20190615230521', 50.00000, '2019-06-16 02:07:01', 'This is Sale', 'Kalil Raza', '4562155201252', 12345, '1560632821_image.png', '1560632821_file.png');

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings`  (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `vocher_prefix` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `vocher_number` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `slip_prefix` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `slip_number` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `adv_prefix` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `adv_number` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`setting_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO `settings` VALUES (1, 'VR', '5', 'RV', '6', 'ADV', '6');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `first_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `role_id` int(11) NULL DEFAULT NULL,
  `status` enum('Active','Inactive') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Inactive',
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin@admin.com', 'Admin', 'Account', 1, 'Active', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `users` VALUES (9, 'usmantahir78@gmail.com', 'Usman', 'Tahir', 1, 'Active', '202cb962ac59075b964b07152d234b70');

-- ----------------------------
-- Table structure for venders
-- ----------------------------
DROP TABLE IF EXISTS `venders`;
CREATE TABLE `venders`  (
  `vender_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL,
  `vender_first_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `vender_last_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `vender_phone` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `vender_email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `vender_identity` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `vender_identity_type` enum('ID','Passport') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'ID',
  `vender_address` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `vender_status` enum('Active','Inactive','Blocked','Defaulter') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Active',
  PRIMARY KEY (`vender_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of venders
-- ----------------------------
INSERT INTO `venders` VALUES (1, 1, 'Kalil', 'Raza', '23658774', 'e', '4562155201252', 'ID', 'Roadside Drive', 'Active');
INSERT INTO `venders` VALUES (2, 1, 'Usman', 'Tahir', '23658774', 'email', '4562155201253', 'ID', 'Roadside Drive', 'Inactive');
INSERT INTO `venders` VALUES (5, NULL, '', '', '', '', '', 'ID', '', 'Active');

SET FOREIGN_KEY_CHECKS = 1;
