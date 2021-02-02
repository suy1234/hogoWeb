-- MariaDB dump 10.18  Distrib 10.4.17-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: intridcip7k1_payhogoweb
-- ------------------------------------------------------
-- Server version	10.4.17-MariaDB-cll-lve

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coupons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `value` int(11) NOT NULL,
  `ticket` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_code` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `course` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `campaign` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(10) unsigned DEFAULT NULL,
  `amount` decimal(15,3) NOT NULL DEFAULT 0.000,
  `coupon` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `paid_via` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `paid_date` timestamp NULL DEFAULT NULL,
  `payment_complete_email_sent` int(11) DEFAULT 0,
  `sheet_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `referal` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `utm_source` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `client_ip` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `full_url` text COLLATE utf8_unicode_ci NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (27,'160930318750','Huỳnh Ngọc Suy','0931334469','huynhngocsuy@gmail.com','Amazon Global Selling - 3600000',NULL,'VOBF 2020 LIVE FREE Đăng Ký',1,3600000.000,NULL,0,NULL,NULL,'2020-12-30 04:39:47',NULL,0,'1AOCvQ8GEbGUjLl8MtT_Q-vwTTJU2I1fdclqLgEN_Tiw',NULL,'null','118.69.32.88','http://erp.webitop.com/aa.html',8),(28,'160931088557','Huỳnh Ngọc Suy','0931334469','huynhngocsuy@gmail.com','Amazon Global Selling - 3600000',NULL,'VOBF 2020 LIVE FREE Đăng Ký',1,3600000.000,NULL,0,NULL,NULL,'2020-12-30 06:48:05',NULL,0,'1AOCvQ8GEbGUjLl8MtT_Q-vwTTJU2I1fdclqLgEN_Tiw',NULL,'null','118.69.32.88','http://erp.webitop.com/aa.html',9),(29,'160931100185','Huỳnh Ngọc Suy','0931334469','huynhngocsuy@gmail.com','Amazon Global Selling - 3600000',NULL,'VOBF 2020 LIVE FREE Đăng Ký',1,3600000.000,NULL,0,NULL,NULL,'2020-12-30 06:50:01',NULL,0,'1AOCvQ8GEbGUjLl8MtT_Q-vwTTJU2I1fdclqLgEN_Tiw',NULL,'null','118.69.32.88','http://erp.webitop.com/aa.html',9),(30,'160931105889','Huỳnh Ngọc Suy','0931334469','huynhngocsuy@gmail.com','Amazon Global Selling - 3600000',NULL,'VOBF 2020 LIVE FREE Đăng Ký',1,3600000.000,NULL,0,NULL,NULL,'2020-12-30 06:50:58',NULL,0,'1AOCvQ8GEbGUjLl8MtT_Q-vwTTJU2I1fdclqLgEN_Tiw',NULL,'null','118.69.32.88','http://erp.webitop.com/aa.html',9),(31,'160931132468','Huỳnh Ngọc Suy','0931334469','huynhngocsuy@gmail.com','Amazon Global Selling - 3600000',NULL,'VOBF 2020 LIVE FREE Đăng Ký',1,3600000.000,NULL,1,NULL,'{\"redirect\":\"https:\\/\\/imgroup.vn\\/camonbandangkythanhcongvobf2020\",\"vnp_Amount\":\"360000000\",\"vnp_BankCode\":\"NCB\",\"vnp_BankTranNo\":\"20201230135543\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"Thanh toan giao dich pay.imgroup.vn\",\"vnp_PayDate\":\"20201230135530\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"20J5DBMV\",\"vnp_TransactionNo\":\"13442902\",\"vnp_TxnRef\":\"160931132468\",\"vnp_SecureHashType\":\"SHA256\",\"vnp_SecureHash\":\"316e85135c4442518ab16292c6cea6408e958139d6f236c509dce574c40a3ede\"}','2020-12-30 06:55:24',NULL,0,'1AOCvQ8GEbGUjLl8MtT_Q-vwTTJU2I1fdclqLgEN_Tiw',NULL,'null','118.69.32.88','http://erp.webitop.com/aa.html',9),(32,'160931141299','Huỳnh Ngọc Suy','0931334469','huynhngocsuy@gmail.com','Amazon Global Selling - 3600000',NULL,'VOBF 2020 LIVE FREE Đăng Ký',1,3600000.000,NULL,1,NULL,'{\"redirect\":\"https:\\/\\/imgroup.vn\\/camonbandangkythanhcongvobf2020\",\"vnp_Amount\":\"360000000\",\"vnp_BankCode\":\"NCB\",\"vnp_BankTranNo\":\"20201230135729\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"Thanh toan giao dich pay.imgroup.vn\",\"vnp_PayDate\":\"20201230135715\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"20J5DBMV\",\"vnp_TransactionNo\":\"13442903\",\"vnp_TxnRef\":\"160931141299\",\"vnp_SecureHashType\":\"SHA256\",\"vnp_SecureHash\":\"02c100998db15caec40bd7ae1c34f7fe8fea03edb21161f69fae5061be209908\"}','2020-12-30 06:56:52',NULL,0,'1AOCvQ8GEbGUjLl8MtT_Q-vwTTJU2I1fdclqLgEN_Tiw',NULL,'null','118.69.32.88','http://erp.webitop.com/aa.html',10),(33,'160931245238','Huỳnh Ngọc Suy','0931334469','huynhngocsuy@gmail.com','Amazon Global Selling - 3600000',NULL,'VOBF 2020 LIVE FREE Đăng Ký',1,3600000.000,NULL,1,NULL,'{\"redirect\":\"https:\\/\\/imgroup.vn\\/camonbandangkythanhcongvobf2020\",\"vnp_Amount\":\"360000000\",\"vnp_BankCode\":\"NCB\",\"vnp_BankTranNo\":\"20201230141501\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"Thanh toan giao dich pay.imgroup.vn\",\"vnp_PayDate\":\"20201230141448\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"20J5DBMV\",\"vnp_TransactionNo\":\"13442925\",\"vnp_TxnRef\":\"160931245238\",\"vnp_SecureHashType\":\"SHA256\",\"vnp_SecureHash\":\"3383453a39716508c51d53f130f5536b67a4161b217e37b9aaf9a2a70115c1d4\"}','2020-12-30 07:14:12',NULL,0,'1AOCvQ8GEbGUjLl8MtT_Q-vwTTJU2I1fdclqLgEN_Tiw',NULL,'null','118.69.32.88','http://erp.webitop.com/aa.html',11);
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-01-19  8:39:56
