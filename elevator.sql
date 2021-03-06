/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 100119
Source Host           : 127.0.0.1:3306
Source Database       : elevator

Target Server Type    : MYSQL
Target Server Version : 100119
File Encoding         : 65001

Date: 2018-04-29 10:40:17
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for account
-- ----------------------------
DROP TABLE IF EXISTS `account`;
CREATE TABLE `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `permission` varchar(255) NOT NULL,
  `status` int(5) NOT NULL,
  `menuidarray` text,
  `isdelete` tinyint(2) NOT NULL DEFAULT '0' COMMENT '邏輯刪除用戶',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of account
-- ----------------------------
INSERT INTO `account` VALUES ('8', 'admin', '46f94c8de14fb36680850768ff1b7f2a', 'admin', '1', '0', '1,2,3,4,10,11,12,13,14,15,16', '0');
INSERT INTO `account` VALUES ('10', 'kk', '46f94c8de14fb36680850768ff1b7f2a', 'ja', '3', '0', '5,6,7,8,9,17,18,19,20,21,22,23,24', '0');
INSERT INTO `account` VALUES ('11', 'staff', '0643368ca8849867a3e5bf5a1522676b', '員工', '3', '0', '5,6,7,8,9,17,18,19,20,21,22,23,24', '0');

-- ----------------------------
-- Table structure for config
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `configid` int(5) NOT NULL AUTO_INCREMENT,
  `configkey` varchar(50) NOT NULL COMMENT '關鍵字',
  `configvalue` varchar(255) DEFAULT NULL COMMENT 'value',
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`configid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of config
-- ----------------------------
INSERT INTO `config` VALUES ('1', 'admin_group', '1,2,3,4,5,10,11,12,13,14,15,16,17,25', 'admin預設權限');
INSERT INTO `config` VALUES ('2', 'finance_group', '1,2,3,4,10,11,12,13,14,15,16', '財務預設權限');
INSERT INTO `config` VALUES ('3', 'employee_group', '6,18', '員工預設權限');

-- ----------------------------
-- Table structure for customer
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `company` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `contacter_1` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `contacter_2` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `contacter_3` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `address_1` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `address_2` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `address_3` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `tel_1` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `tel_2` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `tel_3` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `fax_1` varchar(10) DEFAULT NULL,
  `fax_2` varchar(10) DEFAULT NULL,
  `fax_3` varchar(10) DEFAULT NULL,
  `num` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of customer
-- ----------------------------
INSERT INTO `customer` VALUES ('10', 'sad', 'asds', 'asdasd', 'asdasda', 'asd', 'adasd', 'adasd', 'asd', 'adasd', 'asdasd', 'sdfsdf', 'asdasd', 'asdasd', 'sadasd');
INSERT INTO `customer` VALUES ('11', '新光建設', '施勝林', null, null, '台中市北區', null, null, '02-22258586', null, null, '02-5549922', null, null, '995589874');
INSERT INTO `customer` VALUES ('12', '頂旺公司', 'MR SCOTT', null, null, 'USA', 'TTTTT', null, '09200304', '25250959', '', '25200585', '', null, '28906300');

-- ----------------------------
-- Table structure for elevator
-- ----------------------------
DROP TABLE IF EXISTS `elevator`;
CREATE TABLE `elevator` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `model` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `contact` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `tel` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of elevator
-- ----------------------------
INSERT INTO `elevator` VALUES ('1', '永好電梯', '200', null, null, null);
INSERT INTO `elevator` VALUES ('3', '非常好電梯', 'E-666', '台中市北區華信街17號', '林政揚', '0972351003');

-- ----------------------------
-- Table structure for file
-- ----------------------------
DROP TABLE IF EXISTS `file`;
CREATE TABLE `file` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `table_type` int(255) DEFAULT NULL,
  `table_id` int(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `file_type` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of file
-- ----------------------------

-- ----------------------------
-- Table structure for form_action_log
-- ----------------------------
DROP TABLE IF EXISTS `form_action_log`;
CREATE TABLE `form_action_log` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `table_type` int(20) DEFAULT NULL,
  `table_id` int(255) DEFAULT NULL,
  `dispatcher` int(255) DEFAULT NULL,
  `staff` int(255) DEFAULT NULL,
  `dispatch_date` varchar(255) DEFAULT NULL,
  `finish_date` varchar(255) DEFAULT NULL,
  `is_finish` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of form_action_log
-- ----------------------------
INSERT INTO `form_action_log` VALUES ('87', '2', '29', '8', '11', '2018/4/28', null, null);
INSERT INTO `form_action_log` VALUES ('88', '2', '29', '8', '11', '2018/4/28', '2018/4/29', '4');
INSERT INTO `form_action_log` VALUES ('89', '3', '1', '8', '11', '2018/4/29', '2018/4/29', '4');
INSERT INTO `form_action_log` VALUES ('90', '2', '42', '8', '11', '2018/4/29', '2018/4/29', '4');
INSERT INTO `form_action_log` VALUES ('91', '2', '42', '8', '11', '2018/4/29', '2018/4/29', '4');
INSERT INTO `form_action_log` VALUES ('92', '2', '42', '8', '11', '2018/4/29', '2018/4/29', '4');
INSERT INTO `form_action_log` VALUES ('93', '3', '13', '8', '11', '2019/4/29', '2019/4/29', '4');
INSERT INTO `form_action_log` VALUES ('94', '3', '13', '8', '11', '2019/5/29', '2019/5/29', '4');
INSERT INTO `form_action_log` VALUES ('95', '3', '13', '8', '11', '2019/5/29', '2019/5/29', '4');

-- ----------------------------
-- Table structure for imgaddress
-- ----------------------------
DROP TABLE IF EXISTS `imgaddress`;
CREATE TABLE `imgaddress` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) DEFAULT NULL COMMENT '表單歸類項目',
  `typeid` int(10) DEFAULT NULL COMMENT '表單歸類項目id',
  `imgadd` varchar(255) DEFAULT NULL COMMENT '圖檔位置',
  `writedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '寫入時間戳記',
  `isdelete` tinyint(2) DEFAULT '0' COMMENT '邏輯刪除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of imgaddress
-- ----------------------------
INSERT INTO `imgaddress` VALUES ('1', 'warranty', '29', 'warranty_20180428145022.jpg', '2018-04-29 09:01:40', '1');
INSERT INTO `imgaddress` VALUES ('2', 'warranty', '29', 'warranty_20180429025544.jpg', '2018-04-29 08:55:44', '0');
INSERT INTO `imgaddress` VALUES ('3', 'warranty', '29', 'warranty_20180429030248.jpg', '2018-04-29 09:02:48', '0');
INSERT INTO `imgaddress` VALUES ('4', 'service', '1', 'service_20180429033334.jpg', '2018-04-29 09:33:34', '0');
INSERT INTO `imgaddress` VALUES ('5', 'warranty', '42', 'warranty_20180429035605.jpg', '2018-04-29 09:56:05', '0');
INSERT INTO `imgaddress` VALUES ('6', 'service', '13', 'service_20190429040838.jpg', '2019-04-29 10:08:38', '0');

-- ----------------------------
-- Table structure for photo
-- ----------------------------
DROP TABLE IF EXISTS `photo`;
CREATE TABLE `photo` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `form_id` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of photo
-- ----------------------------

-- ----------------------------
-- Table structure for remind
-- ----------------------------
DROP TABLE IF EXISTS `remind`;
CREATE TABLE `remind` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `table_type` int(10) DEFAULT NULL,
  `table_id` int(255) DEFAULT NULL,
  `dispatcher` int(255) DEFAULT NULL,
  `principal` int(11) DEFAULT NULL,
  `dispatch_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of remind
-- ----------------------------

-- ----------------------------
-- Table structure for service
-- ----------------------------
DROP TABLE IF EXISTS `service`;
CREATE TABLE `service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `signing_day` varchar(255) DEFAULT NULL,
  `service_month` varchar(255) DEFAULT NULL,
  `mechanical_warranty` int(255) DEFAULT NULL,
  `license` int(255) DEFAULT NULL,
  `license_day` varchar(255) DEFAULT NULL,
  `Total_price` int(255) DEFAULT NULL,
  `payment_date1` varchar(255) DEFAULT NULL,
  `payment_date2` varchar(255) DEFAULT NULL,
  `payment_date3` varchar(255) DEFAULT NULL,
  `payment_date4` varchar(255) DEFAULT NULL,
  `payment_date5` varchar(255) DEFAULT NULL,
  `payment_date6` varchar(255) DEFAULT NULL,
  `payment_amount1` varchar(255) DEFAULT NULL,
  `payment_amount2` varchar(255) DEFAULT NULL,
  `payment_amount3` varchar(255) DEFAULT NULL,
  `payment_amount4` varchar(255) DEFAULT NULL,
  `payment_amount5` varchar(255) DEFAULT NULL,
  `payment_amount6` varchar(255) DEFAULT NULL,
  `item_status1` varchar(255) DEFAULT NULL,
  `item_status2` varchar(255) DEFAULT NULL,
  `item_status3` varchar(255) DEFAULT NULL,
  `item_status4` varchar(255) DEFAULT NULL,
  `item_status5` varchar(255) DEFAULT NULL,
  `item_status6` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `warranty_id` int(255) DEFAULT NULL,
  `is_signing` int(1) DEFAULT '0',
  `is_remind` int(1) DEFAULT '0',
  `service_times` int(10) DEFAULT '0',
  `do_times` int(10) DEFAULT '1',
  `touch_time` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of service
-- ----------------------------
INSERT INTO `service` VALUES ('1', '2018/02/07', '1', '2', '1', '2018/01/29', '500000', '2018/03/16', '2018/03/30', '', '', '', '', '20000', '50000', '0', '0', '0', '0', '5', '4', '', '', '', '', '            ', '29', '0', '1', '2', '2', '2019/5/29');
INSERT INTO `service` VALUES ('13', '2019/04/29', '2', '1', '1', '2019/04/11', '1000000', '2019/04/08', '', '', '', '', '', '20000', '0', '0', '0', '0', '0', '5', '', '', '', '', '', '  ', '42', '0', '0', '4', '2', '2019/5/29');

-- ----------------------------
-- Table structure for transaction_form
-- ----------------------------
DROP TABLE IF EXISTS `transaction_form`;
CREATE TABLE `transaction_form` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `total_price` int(20) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `is_return` int(1) DEFAULT NULL,
  `is_signing` int(1) DEFAULT NULL,
  `receipt_status` int(1) DEFAULT NULL,
  `item_name1` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `item_name2` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `item_name3` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `item_name4` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `item_name5` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `item_name6` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `item1` int(1) DEFAULT NULL,
  `item2` int(1) DEFAULT NULL,
  `item3` int(1) DEFAULT NULL,
  `item4` int(1) DEFAULT NULL,
  `item5` int(1) DEFAULT NULL,
  `item6` int(1) DEFAULT NULL,
  `item_status1` int(1) DEFAULT NULL,
  `item_status2` int(1) DEFAULT NULL,
  `item_status3` int(1) DEFAULT NULL,
  `item_status4` int(1) DEFAULT NULL,
  `item_status5` int(1) DEFAULT NULL,
  `item_status6` int(1) DEFAULT NULL,
  `customer_id` int(255) DEFAULT NULL,
  `elevator_num` int(20) DEFAULT NULL,
  `remark` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `is_duty` int(1) DEFAULT '0',
  `is_receipt` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of transaction_form
-- ----------------------------
INSERT INTO `transaction_form` VALUES ('34', '力大房屋', '250000', '2017-10-01', null, null, null, '訂金', '貨到', '驗收', null, null, null, '10', '10', '10', null, null, null, '1', '5', '1', null, null, null, '10', '5', null, null, null);
INSERT INTO `transaction_form` VALUES ('35', '1', '5000000', '2017-10-30', null, '2', null, '貨到', null, null, null, null, null, '100', null, null, null, null, null, '5', null, null, null, null, null, '11', '1', null, null, null);
INSERT INTO `transaction_form` VALUES ('36', '利通', '200000', '2017-10-17', null, '2', null, '訂金', '貨到', null, null, null, null, '20', '10', null, null, null, null, '5', '1', null, null, null, null, '11', '5', null, null, null);
INSERT INTO `transaction_form` VALUES ('46', '測試表單', '150000', '2018-01-06', null, '2', null, '訂金', '裝修', null, null, null, null, '10', '90', null, null, null, null, '5', '5', null, null, null, null, '11', '2', null, null, null);
INSERT INTO `transaction_form` VALUES ('47', '林政揚豪宅', '2500000', '2018-01-06', null, '2', null, '訂金', '貨到', '安裝完成', '驗收', null, null, '30', '50', '10', '10', null, null, '5', '5', '5', '5', null, null, '11', '3', null, null, null);
INSERT INTO `transaction_form` VALUES ('49', '測試表單', '150000', '2018-04-05', '1', null, null, '訂金', '第二期', '尾款', null, null, null, '30', '30', '10', null, null, null, '5', '5', '5', null, null, null, '11', '3', '這邊我記錄了一些東西', '1', '1');
INSERT INTO `transaction_form` VALUES ('51', '四月二十九', '10000', '2018-04-29', '1', '1', null, '訂金', '貨到', null, null, null, null, '30', '70', null, null, null, null, '5', '5', null, null, null, null, '11', '1', '', '1', '1');

-- ----------------------------
-- Table structure for usermenu
-- ----------------------------
DROP TABLE IF EXISTS `usermenu`;
CREATE TABLE `usermenu` (
  `menuid` int(5) NOT NULL AUTO_INCREMENT COMMENT '菜單ID',
  `parentid` int(5) NOT NULL DEFAULT '0' COMMENT '上層菜單',
  `title` varchar(30) NOT NULL COMMENT '標題',
  `controller` varchar(40) NOT NULL COMMENT '控制器',
  `actioner` varchar(40) NOT NULL COMMENT '動作',
  `icon` varchar(100) DEFAULT NULL,
  `ismenu` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否顯示',
  `sort` tinyint(4) NOT NULL DEFAULT '0' COMMENT '排序',
  `isdisabled` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否刪除',
  PRIMARY KEY (`menuid`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of usermenu
-- ----------------------------
INSERT INTO `usermenu` VALUES ('1', '0', '表單管理', 'report', '', 'icon-list', '1', '1', '0');
INSERT INTO `usermenu` VALUES ('2', '0', '電梯管理', 'elevator', '', 'icon-folder-open', '1', '2', '0');
INSERT INTO `usermenu` VALUES ('3', '0', '客戶管理', 'customer', '', 'icon-book', '1', '3', '0');
INSERT INTO `usermenu` VALUES ('4', '0', '人員管理', 'personal', '', 'icon-user', '1', '4', '0');
INSERT INTO `usermenu` VALUES ('5', '0', '派遣管理', 'dispatch', '', 'icon-user', '1', '5', '0');
INSERT INTO `usermenu` VALUES ('6', '0', '事務管理', 'dispatch', '', 'icon-user', '1', '6', '0');
INSERT INTO `usermenu` VALUES ('7', '0', '規則', 'rulelist', '', 'icon-list-ol', '1', '3', '1');
INSERT INTO `usermenu` VALUES ('8', '0', '追蹤', 'usertrack', '', 'icon-search', '1', '4', '1');
INSERT INTO `usermenu` VALUES ('9', '0', '圖表', 'dashboard', '', 'icon-th-list', '1', '1', '1');
INSERT INTO `usermenu` VALUES ('10', '1', '買賣單', 'form', 'transaction_home', 'icon-caret-right', '1', '1', '0');
INSERT INTO `usermenu` VALUES ('11', '1', '保固單', 'Warranty', 'warranty_home', 'icon-caret-right', '1', '2', '0');
INSERT INTO `usermenu` VALUES ('12', '1', '保養名冊', 'service', 'service_home', 'icon-caret-right', '1', '3', '0');
INSERT INTO `usermenu` VALUES ('13', '1', '新增上傳檔案', 'form', 'upload', 'icon-caret-right', '1', '4', '0');
INSERT INTO `usermenu` VALUES ('14', '2', '電梯列表', 'elevator', 'elevator_home', 'icon-caret-right', '1', '1', '0');
INSERT INTO `usermenu` VALUES ('15', '3', '客戶列表', 'customer', 'customer_home', 'icon-caret-right', '1', '1', '0');
INSERT INTO `usermenu` VALUES ('16', '4', '人員列表', 'personal', 'personal_list', 'icon-caret-right', '1', '1', '0');
INSERT INTO `usermenu` VALUES ('17', '5', '派遣列表', 'dispatch', 'dispatch_home', 'icon-caret-right', '1', '1', '0');
INSERT INTO `usermenu` VALUES ('18', '6', '事務列表', 'dispatch', 'dispatch_home_staff', 'icon-caret-right', '1', '1', '0');
INSERT INTO `usermenu` VALUES ('19', '6', '專案管理', 'projectadmin', 'project_home', 'icon-caret-right', '1', '1', '1');
INSERT INTO `usermenu` VALUES ('20', '6', '受測名單', '', '', 'icon-caret-right', '1', '2', '1');
INSERT INTO `usermenu` VALUES ('21', '7', '規則清單', 'rulelist', 'rulelistshow', 'icon-caret-right', '1', '1', '1');
INSERT INTO `usermenu` VALUES ('22', '8', '追蹤名單', 'usertrack', 'usertracking', 'icon-caret-right', '1', '1', '1');
INSERT INTO `usermenu` VALUES ('23', '9', '評測結果', '', '', 'icon-caret-right', '1', '1', '1');
INSERT INTO `usermenu` VALUES ('24', '9', '匯出檔案', 'projectadmin', 'excel', 'icon-caret-right', '1', '2', '0');
INSERT INTO `usermenu` VALUES ('25', '4', '權限管理', 'personal', 'personal_power_list', 'icon-caret-right', '1', '1', '0');

-- ----------------------------
-- Table structure for warranty
-- ----------------------------
DROP TABLE IF EXISTS `warranty`;
CREATE TABLE `warranty` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `customer` varchar(255) DEFAULT NULL,
  `mechanical_warranty` int(255) DEFAULT NULL,
  `free_maintenance` int(255) DEFAULT NULL,
  `effective_date` varchar(255) DEFAULT NULL,
  `warranty_times` int(10) DEFAULT '0',
  `contacter_1` varchar(255) DEFAULT NULL,
  `contacter_2` varchar(255) DEFAULT NULL,
  `contacter_3` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `tel_1` varchar(255) DEFAULT NULL,
  `tel_2` varchar(255) DEFAULT NULL,
  `tel_3` varchar(255) DEFAULT NULL,
  `fax_1` varchar(255) DEFAULT NULL,
  `fax_2` varchar(255) DEFAULT NULL,
  `fax_3` varchar(255) DEFAULT NULL,
  `num` varchar(255) DEFAULT NULL,
  `transaction_id` int(255) DEFAULT NULL,
  `is_signing` int(1) DEFAULT '0',
  `is_remind` int(1) DEFAULT '0',
  `touch_time` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of warranty
-- ----------------------------
INSERT INTO `warranty` VALUES ('1', '林政揚阿姆', '2', '1', '2018/03/22', '0', '林政揚阿姆', null, null, '卓蘭鎮豪宅裡', '093333311313', null, null, '04-25250950', null, null, '28906300', '47', null, '1', '2018/4/28');
INSERT INTO `warranty` VALUES ('29', '阿奇', '2', '1', '2018/03/22', '12', '阿奇的媽媽2', null, null, '台中市東勢區', '09200304', null, null, '25250950', null, null, '6985856745', '47', '0', '2', '2018/4/28');
INSERT INTO `warranty` VALUES ('42', '奇儒', '1', '1', '2018/04/29', '14', '楊奇儒', '吳宗憲', null, '台中市北區', '09888333', '09938383', null, '32141241241', null, null, '123124124124', '51', null, '2', '2018/4/29');
SET FOREIGN_KEY_CHECKS=1;
