# Host: localhost  (Version: 5.5.47)
# Date: 2018-05-23 12:42:06
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "admin"
#

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(20) NOT NULL DEFAULT '',
  `admin_pwd` varchar(20) DEFAULT '',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "admin"
#

/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin','admin');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

#
# Structure for table "history"
#

DROP TABLE IF EXISTS `history`;
CREATE TABLE `history` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(25) NOT NULL DEFAULT '0',
  `content` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

#
# Data for table "history"
#

/*!40000 ALTER TABLE `history` DISABLE KEYS */;
INSERT INTO `history` VALUES (1,'2018-05-17 14:29:46','用户phone','充值了10元'),(2,'2018-05-17 14:29:50','用户phone','充值了10元'),(3,'2018-05-17 14:30:07','用户phone','充值了10元');
/*!40000 ALTER TABLE `history` ENABLE KEYS */;

#
# Structure for table "myorder"
#

DROP TABLE IF EXISTS `myorder`;
CREATE TABLE `myorder` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `time` datetime DEFAULT NULL,
  `bh` bigint(20) NOT NULL DEFAULT '0',
  `user_name` bigint(12) NOT NULL DEFAULT '0',
  `shop_name` bigint(12) NOT NULL DEFAULT '0',
  `addr_id` int(11) NOT NULL DEFAULT '0',
  `money` double(9,2) NOT NULL DEFAULT '0.00',
  `remarks` text,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "myorder"
#

/*!40000 ALTER TABLE `myorder` DISABLE KEYS */;
INSERT INTO `myorder` VALUES (1,'2018-05-17 14:26:58',20180517142355401,phone,phone,1,29.00,'淡淡的',2);
/*!40000 ALTER TABLE `myorder` ENABLE KEYS */;

#
# Structure for table "order_dli"
#

DROP TABLE IF EXISTS `order_dli`;
CREATE TABLE `order_dli` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `bh` bigint(20) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

#
# Data for table "order_dli"
#

/*!40000 ALTER TABLE `order_dli` DISABLE KEYS */;
INSERT INTO `order_dli` VALUES (1,20180517142355401,1,2),(2,20180517142355401,2,1),(3,20180517142355401,3,2);
/*!40000 ALTER TABLE `order_dli` ENABLE KEYS */;

#
# Structure for table "product"
#

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_name` bigint(12) NOT NULL DEFAULT '0',
  `product_name` varchar(40) NOT NULL DEFAULT '',
  `product_img` varchar(40) NOT NULL DEFAULT '0',
  `product_class` varchar(20) NOT NULL DEFAULT '',
  `product_money` double(7,2) NOT NULL DEFAULT '0.00',
  `product_sv` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

#
# Data for table "product"
#

/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,phone,'鸭心','20180516233624696.png','美食',10.00,0),(2,phone,'鸭爪','20180516233638992.png','美食',3.00,0),(3,phone,'鸭胗','20180516233702926.png','美食',3.00,0),(4,phone,'鸭肠','20180516233722777.png','美食',6.00,0),(5,phone,'藕片','20180516233902748.png','素食',5.00,0),(6,phone,'土豆片','20180516233946388.png','素食',2.00,0),(7,15729520401,'米饭','20180516234634356.png','热销',2.00,0),(8,15729520401,'金针菇','20180516234704981.png','热销',1.98,0),(9,15729520401,'精品肥牛','20180516234733620.png','热销',5.00,0),(10,15729520401,'娃娃菜（折扣）','20180516234826481.png','优惠',4.38,0),(11,15729520401,'可乐','20180516234916793.png','饮料',5.00,0),(12,15729520401,'雪碧','20180516234946438.png','饮料',5.00,0),(13,15729520401,'加多宝','20180516235022492.png','饮料',7.00,0),(14,13695864037,'水果沙拉','20180517001132653.png','美食小吃',18.00,0),(15,13695864037,'麻辣小龙虾','20180517001247207.png','招牌炒菜',68.00,0),(16,13695864037,'凉拌黄瓜','20180517001318655.png','凉菜下酒菜',12.00,0),(17,13695864037,'江小白','20180517001347830.png','酒水',20.00,0),(18,13695864037,'糯米丸子','20180517001409425.png','甜品',10.00,0),(19,phone,'鸭脖1','20180517142811537.png','美食',12.00,0);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;

#
# Structure for table "product_class"
#

DROP TABLE IF EXISTS `product_class`;
CREATE TABLE `product_class` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_name` bigint(12) DEFAULT NULL,
  `product_class` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

#
# Data for table "product_class"
#

/*!40000 ALTER TABLE `product_class` DISABLE KEYS */;
INSERT INTO `product_class` VALUES (1,phone,'美食'),(2,phone,'素食'),(3,15729520401,'热销'),(4,15729520401,'优惠'),(5,15729520401,'饮料'),(6,13695864037,'美食小吃'),(7,13695864037,'招牌炒菜'),(8,13695864037,'凉菜下酒菜'),(9,13695864037,'酒水'),(10,13695864037,'甜品'),(11,phone,'优惠');
/*!40000 ALTER TABLE `product_class` ENABLE KEYS */;

#
# Structure for table "shop"
#

DROP TABLE IF EXISTS `shop`;
CREATE TABLE `shop` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_name` bigint(12) NOT NULL DEFAULT '0',
  `store_name` varchar(255) DEFAULT NULL,
  `logo` varchar(40) DEFAULT NULL,
  `shop_tel` bigint(12) DEFAULT NULL,
  `shop_class` varchar(20) DEFAULT NULL,
  `open_time` time DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `shop_addr` varchar(255) DEFAULT NULL,
  `shop_lng` double(9,6) DEFAULT NULL,
  `shop_lat` double(9,6) DEFAULT NULL,
  `introduce` text,
  `notice` text,
  `psf` int(3) DEFAULT NULL,
  `qbj` int(3) DEFAULT NULL,
  `sdsj` int(10) DEFAULT NULL,
  `tjzs` double(3,2) DEFAULT NULL,
  `shop_money` double(9,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

#
# Data for table "shop"
#

/*!40000 ALTER TABLE `shop` DISABLE KEYS */;
INSERT INTO `shop` VALUES (1,phone,'传奇劲道鸭脖','20180516233216694.png',13613613611,'小吃夜宵','08:00:00','17:00:00','石嘴山市大武口区宁夏理工学院',106.420503,38.976259,'传奇劲道鸭脖，采用七七四十九道工序，经过九九八十一天秘制而成，原料都是最新鲜自然的。','好吃听的见，网上不接单',0,0,15,0.98,29.00),(2,15729520401,'e家冒菜','20180516234407678.png',15729520301,'特色菜系','07:00:00','20:00:00','石嘴山市大武口区宁夏理工学院',106.420503,38.976259,'','',0,0,16,0.80,0.00),(3,15729520402,'益聪龙虾','20180516235424576.png',15729520302,'晚餐','18:00:00','02:00:00','石嘴山市大武口区宁夏理工学院',106.420503,38.976259,'','',0,0,13,0.70,0.00),(4,15729520403,'李先生烧烤','20180516235652191.png',15729520303,'小吃夜宵','18:00:00','03:00:00','石嘴山市大武口区宁夏理工学院',106.420503,38.976259,'','',0,0,25,0.60,0.00),(5,15729520404,'德克士','20180516235845716.png',15729520304,'简餐','08:00:00','22:00:00','石嘴山市大武口区宁夏理工学院',106.420503,38.976259,'','',0,0,30,0.50,0.00),(6,15729520406,'理工花花世界鲜花店','20180517000120942.png',15729520306,'鲜花绿植','08:00:00','17:00:00','石嘴山市大武口区宁夏理工学院',106.420503,38.976259,'','',0,0,31,0.40,0.00),(7,15729520407,'全部都有超市','20180517000303334.png',15729520306,'商店超市','08:00:00','22:00:00','石嘴山市大武口区宁夏理工学院',106.420503,38.976259,'','',0,0,24,0.70,0.00),(8,15729520408,'宜丰大药房','20180517000457967.png',15729520308,'医药健康','08:00:00','17:00:00','石嘴山市大武口区宁夏理工学院',106.420503,38.976259,'传统的小吃美食唤醒你儿时的记忆 传承中华文化的茶艺改良后上市的贡茶，茶与奶盖的碰撞给你不一样的味道！','谢谢惠顾（另有需要请备注，食品都是微辣出餐）',3,20,19,0.80,0.00),(9,13695864037,'泡泡公举','20180517000839541.png',13695864031,'早餐','08:00:00','18:00:00','温州市永嘉县桥下镇',120.563294,28.167137,'传统的小吃美食唤醒你儿时的记忆 传承中华文化的茶艺改良后上市的贡茶，茶与奶盖的碰撞给你不一样的味道！','谢谢惠顾（另有需要请备注，食品都是微辣出餐）',5,15,10,0.99,788.00);
/*!40000 ALTER TABLE `shop` ENABLE KEYS */;

#
# Structure for table "shop_code"
#

DROP TABLE IF EXISTS `shop_code`;
CREATE TABLE `shop_code` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_name` bigint(12) NOT NULL DEFAULT '0',
  `code` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

#
# Data for table "shop_code"
#

/*!40000 ALTER TABLE `shop_code` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_code` ENABLE KEYS */;

#
# Structure for table "user"
#

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` bigint(12) NOT NULL DEFAULT '0',
  `user_pwd` varchar(20) NOT NULL DEFAULT '',
  `user_img` varchar(40) DEFAULT NULL,
  `user_money` double(11,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "user"
#

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,phone,'qq602923957','20180516232706377.jpg',479.00);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

#
# Structure for table "user_addr"
#

DROP TABLE IF EXISTS `user_addr`;
CREATE TABLE `user_addr` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` bigint(12) NOT NULL DEFAULT '0',
  `name` varchar(10) NOT NULL DEFAULT '',
  `sex` varchar(4) NOT NULL DEFAULT '先生',
  `tel` bigint(12) NOT NULL DEFAULT '0',
  `addr` varchar(20) NOT NULL DEFAULT '',
  `addrDetails` varchar(40) NOT NULL DEFAULT '',
  `lng` double(9,6) NOT NULL DEFAULT '0.000000',
  `lat` double(9,6) NOT NULL DEFAULT '0.000000',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "user_addr"
#

/*!40000 ALTER TABLE `user_addr` DISABLE KEYS */;
INSERT INTO `user_addr` VALUES (1,phone,'李悦','先生',15729520340,'石嘴山市大武口区宁夏理工学院','4号楼B131',106.420503,38.976259);
/*!40000 ALTER TABLE `user_addr` ENABLE KEYS */;

#
# Structure for table "user_ct"
#

DROP TABLE IF EXISTS `user_ct`;
CREATE TABLE `user_ct` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` bigint(12) NOT NULL DEFAULT '0',
  `shop_name` bigint(12) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "user_ct"
#

/*!40000 ALTER TABLE `user_ct` DISABLE KEYS */;
INSERT INTO `user_ct` VALUES (1,phone,phone);
/*!40000 ALTER TABLE `user_ct` ENABLE KEYS */;
