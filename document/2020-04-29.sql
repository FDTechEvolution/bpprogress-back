-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: 103.86.48.105    Database: wesales_bpprogress
-- ------------------------------------------------------
-- Server version	5.5.5-10.3.22-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brands` (
  `id` char(36) NOT NULL,
  `name` varchar(100) NOT NULL,
  `isactive` enum('Y','N') DEFAULT 'Y',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES ('e8d8cae1-9add-4e0e-a2e3-d67827e68a4d','Brand-01','Y','2020-04-22 05:52:11','2020-04-22 06:54:03','รายละเอียดยี่ห้อสินค้า 01'),('2de9daa1-6cb6-4541-b40a-bd481abc70e2','Brand-02','Y','2020-04-22 05:52:36','2020-04-24 14:28:53','รายละเอียดยี่ห้อสินค้า 02');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `goods_lines`
--

DROP TABLE IF EXISTS `goods_lines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `goods_lines` (
  `id` char(36) NOT NULL,
  `goods_transaction_id` char(36) NOT NULL,
  `product_id` char(36) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 0,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goods_lines`
--

LOCK TABLES `goods_lines` WRITE;
/*!40000 ALTER TABLE `goods_lines` DISABLE KEYS */;
/*!40000 ALTER TABLE `goods_lines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `goods_transactions`
--

DROP TABLE IF EXISTS `goods_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `goods_transactions` (
  `id` char(36) NOT NULL,
  `docdate` date NOT NULL,
  `docno` varchar(45) NOT NULL,
  `user_id` char(36) NOT NULL,
  `warehouse_id` char(36) NOT NULL,
  `type` varchar(45) NOT NULL DEFAULT 'RECEIPT',
  `description` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goods_transactions`
--

LOCK TABLES `goods_transactions` WRITE;
/*!40000 ALTER TABLE `goods_transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `goods_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `id` char(36) NOT NULL,
  `fullpath` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `createdby` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES ('0aecea82-0521-4e7d-8680-8430a6cfe028','http://127.0.0.1:8888/Git/bpprogress-back/img/products/1588152762_593661.jpg','img/products/','1588152762_593661.jpg','2020-04-29 09:32:43','2020-04-29 09:32:43',NULL),('ae4c93e7-8faf-4ccb-b837-39d30b66a6bd','http://127.0.0.1:8888/Git/bpprogress-back/img/products/1588153063_708072.jpg','img/products/','1588153063_708072.jpg','2020-04-29 09:37:43','2020-04-29 09:37:43',NULL);
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_categories` (
  `id` char(36) NOT NULL,
  `name` varchar(50) NOT NULL,
  `isactive` enum('Y','N') DEFAULT 'Y',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_categories`
--

LOCK TABLES `product_categories` WRITE;
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
INSERT INTO `product_categories` VALUES ('efbe0812-e4a3-40fd-902d-789ff1a9c1dd','อุปกรณ์ อิเล็กทรอนิกส์','Y','2020-04-21 07:05:02','2020-04-24 08:45:44',''),('934f8c3f-3194-4fcb-8ba1-1c50241634be','ทีวีและเครื่องใช้ ไฟฟ้าในบ้าน','Y','2020-04-21 07:59:35','2020-04-24 08:46:02',''),('fe810ab0-f97e-4499-b495-83ee56bc9782','สุขภาพและความงาม','Y','2020-04-21 16:26:23','2020-04-24 08:46:21',''),('b20da281-b075-4906-89f3-a1b43deaf1d3','เด็กอ่อน และของเล่น','Y','2020-04-24 08:46:35','2020-04-24 08:46:35',''),('7d1adcd1-f133-4906-8609-c7ff3f4c71f7','ซูเปอร์มาร์เก็ต และสัตว์เลี้ยง','Y','2020-04-24 08:46:47','2020-04-24 08:46:47',''),('b47535f4-b010-41dd-ae90-ada35bcd2dca','บ้านและไลฟ์สไตล์','Y','2020-04-24 08:46:57','2020-04-24 08:46:57',''),('df335ac2-b7d9-4cf4-9917-0e9ecf8034e3','แฟชั่นผู้หญิง','Y','2020-04-24 08:47:08','2020-04-24 08:47:08',''),('6f13d3d0-ba6c-48a4-a7b6-7118a168eb7b','แฟชั่นผู้ชาย','Y','2020-04-24 08:47:18','2020-04-24 08:47:18',''),('913b03f4-7a89-4128-b5e0-c8425799ab1d','เครื่องประดับ','Y','2020-04-24 08:48:29','2020-04-24 08:48:29',''),('88756b29-8fe6-47a4-9ade-89062a718b03','กีฬาและ การเดินทาง','Y','2020-04-24 08:48:41','2020-04-24 08:48:41',''),('864bc535-1bcf-498d-bb27-73821e792b28','ยานยนต์ และอุปกรณ์','Y','2020-04-24 08:48:54','2020-04-24 08:48:54','');
/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_images` (
  `id` char(36) NOT NULL,
  `product_id` char(36) NOT NULL,
  `image_id` char(36) NOT NULL,
  `type` varchar(45) NOT NULL DEFAULT 'NORMAL',
  `seq` int(11) NOT NULL DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
INSERT INTO `product_images` VALUES ('8cd86c8b-dc41-405c-b483-c80fe8f35dc5','ca0713cc-782a-4b92-8497-db09bd41668f','0aecea82-0521-4e7d-8680-8430a6cfe028','NORMAL',1,'2020-04-29 09:32:43','2020-04-29 09:32:43',NULL),('ef7a4623-e6b6-444c-834d-a987e69d6721','ca0713cc-782a-4b92-8497-db09bd41668f','ae4c93e7-8faf-4ccb-b837-39d30b66a6bd','NORMAL',1,'2020-04-29 09:37:43','2020-04-29 09:37:43',NULL);
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` char(36) NOT NULL,
  `brand_id` char(36) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `isretail` enum('Y','N') NOT NULL DEFAULT 'Y',
  `iswholesale` enum('Y','N') NOT NULL DEFAULT 'N',
  `isstock` enum('Y','N') NOT NULL DEFAULT 'N',
  `isactive` enum('Y','N') DEFAULT 'Y',
  `product_category_id` char(36) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `special_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `short_description` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES ('ca0713cc-782a-4b92-8497-db09bd41668f','e8d8cae1-9add-4e0e-a2e3-d67827e68a4d','Product-01','Y','N','N','Y','efbe0812-e4a3-40fd-902d-789ff1a9c1dd',6000.00,4000.00,'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','2020-04-22 13:27:56','2020-04-24 14:39:03','ttttttttttttttttt',12),('51eafcde-a1c3-4657-b9f9-ab1d3e4de5af','2de9daa1-6cb6-4541-b40a-bd481abc70e2','Product-02 edit','Y','Y','N','Y','fe810ab0-f97e-4499-b495-83ee56bc9782',100.00,60.00,'<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. zz</p>','<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32. zz</p>','2020-04-24 08:47:54','2020-04-24 15:25:36','',120),('66e19f82-1760-48fb-93d2-ec77d55325cc',NULL,'hello','N','N','Y','Y','934f8c3f-3194-4fcb-8ba1-1c50241634be',0.00,0.00,NULL,NULL,'2020-04-27 14:08:07','2020-04-27 14:08:07',NULL,0);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shops`
--

DROP TABLE IF EXISTS `shops`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shops` (
  `id` char(36) NOT NULL,
  `name` varchar(50) NOT NULL,
  `code` varchar(45) NOT NULL,
  `username` varchar(50) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `isactive` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shops`
--

LOCK TABLES `shops` WRITE;
/*!40000 ALTER TABLE `shops` DISABLE KEYS */;
INSERT INTO `shops` VALUES ('1111','shop_01','s_01','nauthiz',NULL,NULL,'Y'),('2222','shop_02','s_02','deepduck',NULL,NULL,'Y');
/*!40000 ALTER TABLE `shops` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_authens`
--

DROP TABLE IF EXISTS `user_authens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_authens` (
  `id` char(36) NOT NULL,
  `user_id` char(36) NOT NULL,
  `authencode` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `isused` enum('Y','N') NOT NULL DEFAULT 'N',
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_authens`
--

LOCK TABLES `user_authens` WRITE;
/*!40000 ALTER TABLE `user_authens` DISABLE KEYS */;
INSERT INTO `user_authens` VALUES ('bca431c0-9fc1-4384-bb39-3bab83c9f3f5','ea9d11a3-044c-4b7d-b026-accb7c289a9d','Om6SaG1vkK0E0HEoHXt2','2020-04-20 07:40:18','2020-04-20 07:40:18','N',NULL),('9bc03335-1be2-43da-a884-c27f6f588495','ea9d11a3-044c-4b7d-b026-accb7c289a9d','ByX0TFOeNtehHU0yZizb','2020-04-20 07:47:35','2020-04-20 07:47:35','N',NULL),('d9ea0694-5d3e-4dec-95a7-4785f2f490da','ea9d11a3-044c-4b7d-b026-accb7c289a9d','w4BAuVLpXYjAY2XWQ2cX','2020-04-20 07:48:45','2020-04-20 07:48:45','N',NULL),('d432ca11-d6b3-409b-b66e-555b06f7c59e','ea9d11a3-044c-4b7d-b026-accb7c289a9d','USzyu8vLrzwpdDXeGch7','2020-04-20 07:54:33','2020-04-20 07:54:34','Y',NULL),('e7d5b527-3482-41e1-83e3-cf4e52f60583','ea9d11a3-044c-4b7d-b026-accb7c289a9d','h3LO88LMJeHCaFsVgPDb','2020-04-20 07:56:50','2020-04-20 07:56:51','Y',NULL),('d15131ff-ee21-48a9-aa5c-257113899149','ea9d11a3-044c-4b7d-b026-accb7c289a9d','V2hfGFDt4wE33u32Wo5z','2020-04-20 08:10:57','2020-04-20 08:10:58','Y',NULL),('9bd912c9-2eb3-4ea8-9ca7-f18ada510d12','ea9d11a3-044c-4b7d-b026-accb7c289a9d','cZuomQQME7ANE2cPgAMZ','2020-04-20 08:12:30','2020-04-20 08:12:30','Y',NULL),('1ef92df2-5f67-491b-80b9-a7bea813f0f3','ea9d11a3-044c-4b7d-b026-accb7c289a9d','JLFkXa9IGbaRMu88IBbG','2020-04-20 08:33:39','2020-04-20 08:33:39','N',NULL),('6755303c-d852-45f9-93ee-70b485b3f25f','ea9d11a3-044c-4b7d-b026-accb7c289a9d','wBdGx33vRgVGMb0qXIHc','2020-04-20 08:34:30','2020-04-20 08:34:30','N',NULL),('8d6ca80e-3e29-4e8f-8764-e99e893d0ab2','ea9d11a3-044c-4b7d-b026-accb7c289a9d','BKdxiKvctuWO6H9UtzDq','2020-04-21 03:17:28','2020-04-21 03:17:28','N',NULL),('a0ee38bf-fd4e-420e-b00a-66991fcf51ef','b6cfbf21-157f-45c4-80d5-79ecdb742269','083J5mTDDKYz1XpTuLdy','2020-04-21 09:32:20','2020-04-21 09:32:20','N',NULL),('9a6abec1-3952-4852-a233-c20e11b8253d','b6cfbf21-157f-45c4-80d5-79ecdb742269','tCCa7i6tQQ4JdqiBHQux','2020-04-21 09:35:06','2020-04-21 09:35:06','N',NULL),('614eb291-5981-431d-a3ff-04877c885d9e','b6cfbf21-157f-45c4-80d5-79ecdb742269','OfJHQ8oC2Lr5fzszqjEX','2020-04-21 09:36:18','2020-04-21 09:36:18','N',NULL),('3009fd9a-b9b2-4be0-9604-6f7a19868a80','ea9d11a3-044c-4b7d-b026-accb7c289a9d','8KLsuorbL3LydU5clS1a','2020-04-22 05:39:47','2020-04-22 05:39:47','N',NULL),('100535a5-bf95-41e9-a70f-32c350500912','b6cfbf21-157f-45c4-80d5-79ecdb742269','5TBlvlvOHH3PtXw8Zqwl','2020-04-22 08:41:44','2020-04-22 08:41:44','N',NULL),('c07b5e34-2a87-45aa-8189-6f5ea7303812','b6cfbf21-157f-45c4-80d5-79ecdb742269','8HB7SPrXZhj4mxZxrQ0H','2020-04-22 08:42:35','2020-04-22 08:42:35','N',NULL),('1236652d-70f5-448d-aa44-460b80acce5e','b6cfbf21-157f-45c4-80d5-79ecdb742269','ia2XUWNFcC9LALYzIzKx','2020-04-22 08:42:58','2020-04-22 08:42:58','N',NULL),('8478f072-92d4-4e8b-bbaf-42502b021592','b6cfbf21-157f-45c4-80d5-79ecdb742269','qQ6KtUywOPS1GwgCsDzI','2020-04-22 08:46:04','2020-04-22 08:46:04','N',NULL),('05ee0dc3-5c4e-42b5-85ad-77a544d12d09','b6cfbf21-157f-45c4-80d5-79ecdb742269','rAE0EiZvi6ZRVRmi9lXn','2020-04-22 08:55:48','2020-04-22 08:55:48','N',NULL),('f02c3f69-a3b0-4be2-8717-43e3e07db8d1','b6cfbf21-157f-45c4-80d5-79ecdb742269','zxCdikSA9eyBOdBtvBZN','2020-04-22 09:25:41','2020-04-22 09:25:41','N',NULL),('036e9f74-7e4e-4183-a872-b1884836b24b','b6cfbf21-157f-45c4-80d5-79ecdb742269','ITkK2y6Ad9ObYIMWDT1t','2020-04-22 09:28:40','2020-04-22 09:28:40','N',NULL),('33aa84e1-fc70-4ab5-8724-fbdda23374aa','b6cfbf21-157f-45c4-80d5-79ecdb742269','kqoONORQtQ4O9MgfsbHy','2020-04-22 09:51:22','2020-04-22 09:51:22','N',NULL),('0510776d-056d-45a2-8ff3-ee34d7f70906','e401ae63-c979-4436-be2e-125a27f071fa','KYHwTJELg7sJ3Pc8eQCS','2020-04-22 10:08:01','2020-04-22 10:08:01','N',NULL),('1ec82b9b-f135-4153-9b39-3291e9a090e3','e401ae63-c979-4436-be2e-125a27f071fa','5tq3MQLKnEb6kyKRGQ7G','2020-04-23 04:47:36','2020-04-23 04:47:36','N',NULL),('dbef8708-71b0-47a2-b621-b4519ef10a43','e401ae63-c979-4436-be2e-125a27f071fa','yYe0vSNs2SxijFNML4Io','2020-04-23 04:49:08','2020-04-23 04:49:08','N',NULL),('9b813ae4-6266-4178-81ac-2c0346895a9d','e401ae63-c979-4436-be2e-125a27f071fa','gKlHlImiyUTqH7xOISB6','2020-04-23 04:56:08','2020-04-23 04:56:08','N',NULL),('1224def7-8ee4-4d5f-bbbf-4a85301664fe','e401ae63-c979-4436-be2e-125a27f071fa','OlV3lx6ZUBpx4LA1I00s','2020-04-24 08:45:11','2020-04-24 08:45:11','N',NULL);
/*!40000 ALTER TABLE `user_authens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_otps`
--

DROP TABLE IF EXISTS `user_otps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_otps` (
  `id` char(36) NOT NULL,
  `user_id` char(36) NOT NULL,
  `otp_ref` char(4) NOT NULL,
  `otp_code` int(6) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_otps`
--

LOCK TABLES `user_otps` WRITE;
/*!40000 ALTER TABLE `user_otps` DISABLE KEYS */;
INSERT INTO `user_otps` VALUES ('3626ed3e-70f1-4c80-a038-17d2ded7997d','bed6a290-cc73-4027-a7f0-7b2ee6b8ccec','lNEk',605438,'2020-04-21 08:54:47','2020-04-21 08:54:47'),('acdf86a9-f726-4ffa-a8a4-e84623686de5','9790afd6-69c9-4e58-9b74-babbbc3172c9','vzOq',403182,'2020-04-17 20:36:41','2020-04-17 20:36:41'),('b4548ff3-14dd-47f8-8d94-e5cc07091444','6a2eb009-44bd-4e93-8a59-a341169d6d3e','qsQt',459273,'2020-04-16 11:09:35','2020-04-16 11:09:35'),('962bdf1a-7b10-43d9-82b5-08ae33b72de3','04f508ad-6bc7-4b9d-8cb9-b24023b70d84','qIFj',594607,'2020-04-16 06:41:43','2020-04-16 06:41:43'),('6037f3dc-b04a-4160-b18e-4822d2590783','322a3bfb-38b7-42d2-8651-86a6a8d89ced','ExcY',904851,'2020-04-16 06:07:38','2020-04-16 06:07:38'),('37897c63-4b31-4e4c-91bf-180525bc0cb8','b6cfbf21-157f-45c4-80d5-79ecdb742269','KkTe',429387,'2020-04-16 05:54:25','2020-04-16 05:54:25'),('c58ce3f0-fcf9-44eb-97ec-c18634767d7d','ea9d11a3-044c-4b7d-b026-accb7c289a9d','hQNm',739162,'2020-04-15 12:02:05','2020-04-15 12:02:05'),('ac4e63ad-5496-4052-89e5-bcc31665dc41','e401ae63-c979-4436-be2e-125a27f071fa','xJTv',126034,'2020-04-16 05:52:50','2020-04-16 05:52:50');
/*!40000 ALTER TABLE `user_otps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` char(36) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `image_id` char(36) DEFAULT NULL,
  `isactive` enum('Y','N') NOT NULL DEFAULT 'Y',
  `isverify` enum('Y','N') NOT NULL DEFAULT 'N',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'NORMAL',
  `shop_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('b6cfbf21-157f-45c4-80d5-79ecdb742269','bpshop',NULL,'0888888888','$2y$10$p0OV4WSGLBPYGUM0Qkt16ujIxXD0sQGMK7X.mbY.RITJd2sBt6vrq',NULL,'Y','Y','2020-04-16 05:54:25','2020-04-16 05:54:25',NULL,'SELLER',NULL),('ea9d11a3-044c-4b7d-b026-accb7c289a9d','วัชรินทร์ เขียวกาจ',NULL,'0892666756','$2y$10$g3XJGWw/OqcJGQkRWGUwMOU4lld7FFQxTW4TGHKVQXvZjTh7mzgNS',NULL,'Y','Y','2020-04-15 05:22:02','2020-04-15 05:22:30',NULL,'ADMIN',NULL),('e401ae63-c979-4436-be2e-125a27f071fa','system',NULL,'0999999999','$2y$10$lg/lSWMY.hCKu/f.j2TmyOoA7dtJarIIJIQlFP3fOnkWfEyi6zvEO',NULL,'Y','Y','2020-04-16 05:52:50','2020-04-16 05:52:50',NULL,'ADMIN',NULL),('9790afd6-69c9-4e58-9b74-babbbc3172c9','ทดสอบ1 ทดสอบ1',NULL,'0892666755','$2y$10$O.Ef20GGY/C7T0WMwl9ch.OfFvyoWwnZmvl/b0t4Kmn8Tp2jcbU62',NULL,'Y','Y','2020-04-17 20:36:41','2020-04-17 21:25:05',NULL,'NORMAL',NULL),('bed6a290-cc73-4027-a7f0-7b2ee6b8ccec','athi',NULL,'0992685988','$2y$10$ULafCEnIO/g1guWB5OErcO2t3OcZ8JQVf9VGje.7S6QmLI0MQau3e',NULL,'Y','Y','2020-04-21 08:54:47','2020-04-21 08:55:13',NULL,'NORMAL',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `warehouses`
--

DROP TABLE IF EXISTS `warehouses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `warehouses` (
  `id` char(36) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `isactive` enum('Y','N') DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `shop_id` char(36) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `warehouses`
--

LOCK TABLES `warehouses` WRITE;
/*!40000 ALTER TABLE `warehouses` DISABLE KEYS */;
INSERT INTO `warehouses` VALUES ('5d0c0210-3b36-4e90-91e2-8e1abe240ee0','Warehouse - 02','2020-04-21 05:02:26','2020-04-22 06:51:54','Y','dkdkkdkffk1111 - shop_id = 1111','1111'),('0d6b594f-58ad-476e-98ee-9ce6bb565adc','Warehouse - 01','2020-04-21 05:54:26','2020-04-21 17:38:00','Y','iiaiuaiaiaimm2222 - shop_id = 2222','2222'),('23253a27-d833-4ce4-94c5-102260a5f351','Warehouse - 01','2020-04-21 17:36:49','2020-04-22 06:51:41','Y','ueriwueiruiwer - shop_id = 1111','1111');
/*!40000 ALTER TABLE `warehouses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wholesale_rates`
--

DROP TABLE IF EXISTS `wholesale_rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wholesale_rates` (
  `id` char(36) NOT NULL,
  `seq` int(11) NOT NULL,
  `startqty` int(11) NOT NULL DEFAULT 0,
  `endqty` int(11) DEFAULT 0,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `product_id` char(36) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wholesale_rates`
--

LOCK TABLES `wholesale_rates` WRITE;
/*!40000 ALTER TABLE `wholesale_rates` DISABLE KEYS */;
/*!40000 ALTER TABLE `wholesale_rates` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-29 16:47:01
