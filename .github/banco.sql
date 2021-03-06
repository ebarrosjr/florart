-- MySQL dump 10.13  Distrib 5.7.25, for Linux (x86_64)
--
-- Host: localhost    Database: sis_florart
-- ------------------------------------------------------
-- Server version	5.7.25-0ubuntu0.16.04.2

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
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `cpfcnpj` varchar(20) DEFAULT NULL,
  `razao_social` varchar(255) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `telefone` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `active` tinyint(3) unsigned DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT NULL,
  `tipo` enum('C','F','A') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'ORIXAS EM FESTA','29622214/000181','CASA ORIXAS EM FESTA ARTIGOS RELIGIOSOS LTDA','AVN MINISTRO EDGARD ROMERO, 239 MADUREIRA - RIO DE JANEIRO','2133558800','',1,'2019-03-05 23:19:24','2019-03-06 00:20:43','C');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compras`
--

DROP TABLE IF EXISTS `compras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compras` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cliente_id` int(10) unsigned DEFAULT NULL,
  `data` timestamp NULL DEFAULT NULL,
  `numero_nota` varchar(45) DEFAULT NULL,
  `forma_pagamento_id` int(10) unsigned DEFAULT NULL,
  `valor_total` double(15,2) unsigned DEFAULT NULL,
  `pago` tinyint(1) unsigned DEFAULT '0',
  `frete` double(15,2) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compras`
--

LOCK TABLES `compras` WRITE;
/*!40000 ALTER TABLE `compras` DISABLE KEYS */;
INSERT INTO `compras` VALUES (1,1,'2019-05-08 00:00:00','216543',1,15.00,1,NULL);
/*!40000 ALTER TABLE `compras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fabricacao`
--

DROP TABLE IF EXISTS `fabricacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fabricacao` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `produto_id` int(10) unsigned DEFAULT NULL,
  `materia_prima_id` int(10) unsigned DEFAULT NULL,
  `quantidade` double(8,2) unsigned DEFAULT NULL,
  `manufatura_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `valor` double(15,2) unsigned DEFAULT NULL,
  `unitario` tinyint(1) unsigned DEFAULT NULL,
  `data` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fabricacao`
--

LOCK TABLES `fabricacao` WRITE;
/*!40000 ALTER TABLE `fabricacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `fabricacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forma_pagamentos`
--

DROP TABLE IF EXISTS `forma_pagamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forma_pagamentos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forma_pagamentos`
--

LOCK TABLES `forma_pagamentos` WRITE;
/*!40000 ALTER TABLE `forma_pagamentos` DISABLE KEYS */;
INSERT INTO `forma_pagamentos` VALUES (1,'Dinheiro'),(2,'Cartão de crédito ELO'),(3,'Débido Bradesco'),(4,'Débito Banco do Brasil'),(5,'Cartão de Crédito VISA'),(6,'Cheque');
/*!40000 ALTER TABLE `forma_pagamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupo_produtos`
--

DROP TABLE IF EXISTS `grupo_produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupo_produtos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo_produtos`
--

LOCK TABLES `grupo_produtos` WRITE;
/*!40000 ALTER TABLE `grupo_produtos` DISABLE KEYS */;
/*!40000 ALTER TABLE `grupo_produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itens_notas`
--

DROP TABLE IF EXISTS `itens_notas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `itens_notas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nota_id` int(10) unsigned DEFAULT NULL,
  `item` int(10) unsigned DEFAULT NULL,
  `quantidade` double(5,2) unsigned DEFAULT NULL,
  `valor_unitario` double(15,2) unsigned DEFAULT NULL,
  `unidade_medida_id` int(10) unsigned DEFAULT NULL,
  `situacao_id` int(10) unsigned DEFAULT NULL,
  `tipo_nota` enum('C','V') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itens_notas`
--

LOCK TABLES `itens_notas` WRITE;
/*!40000 ALTER TABLE `itens_notas` DISABLE KEYS */;
INSERT INTO `itens_notas` VALUES (1,1,119,10.00,5.00,NULL,NULL,'C'),(2,1,139,5.00,10.00,NULL,NULL,'C');
/*!40000 ALTER TABLE `itens_notas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lotes`
--

DROP TABLE IF EXISTS `lotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lotes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `produto_id` int(10) unsigned DEFAULT NULL,
  `numero` varchar(45) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `validade` date DEFAULT NULL,
  `finalizado` tinyint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lotes`
--

LOCK TABLES `lotes` WRITE;
/*!40000 ALTER TABLE `lotes` DISABLE KEYS */;
/*!40000 ALTER TABLE `lotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manufaturas`
--

DROP TABLE IF EXISTS `manufaturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `manufaturas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) DEFAULT NULL,
  `valor_base` double(15,2) unsigned DEFAULT NULL,
  `unidade` tinyint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manufaturas`
--

LOCK TABLES `manufaturas` WRITE;
/*!40000 ALTER TABLE `manufaturas` DISABLE KEYS */;
INSERT INTO `manufaturas` VALUES (1,'Ensacar pó',0.35,0),(2,'Rotular',0.15,1),(3,'Teste',2.00,1),(4,'Selar',0.01,1);
/*!40000 ALTER TABLE `manufaturas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materia_primas`
--

DROP TABLE IF EXISTS `materia_primas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materia_primas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_materia_prima_id` int(10) unsigned DEFAULT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `estoque_minimo` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materia_primas`
--

LOCK TABLES `materia_primas` WRITE;
/*!40000 ALTER TABLE `materia_primas` DISABLE KEYS */;
INSERT INTO `materia_primas` VALUES (1,7,'AGUA',NULL),(2,8,'ALCOOL CEREAIS COM FIXADOR',1),(3,8,'ALCOOL CEREAIS COMUM',NULL),(4,8,'ALCOOL GEL',NULL),(5,6,'AMONIA',NULL),(6,7,'BASE BRANCA',NULL),(7,2,'BAUNILHA COMESTIVEL',NULL),(8,10,'BENZOATO DE SÓDIO',NULL),(9,5,'BOBINA MEDIA',NULL),(10,2,'CAFE EM PÓ',NULL),(11,5,'CAIXA PAPEL CRAFT COM VISOR',NULL),(12,5,'CAIXA PP2',NULL),(13,1,'CANELA PAU',NULL),(14,1,'CANELA PO',NULL),(15,6,'CANFORA EM PO',NULL),(16,6,'CANFORA TABLETE',NULL),(17,7,'CARVÃO',NULL),(18,9,'CORANTE PO AMARELO',NULL),(19,9,'CORANTE PO AZUL',NULL),(20,9,'CORANTE SABONETE AMARELO',NULL),(21,9,'CORANTE SABONETE AZUL',NULL),(22,9,'CORANTE SABONETE LILAS',NULL),(23,9,'CORANTE SABONETE VERDE',NULL),(24,9,'CORANTE SABONETE VERMELHO',NULL),(25,1,'CRAVO INTEIRO',NULL),(26,1,'CRAVO PO',NULL),(27,1,'FAVA CUMARU',NULL),(28,2,'ESSENCIA DAMA DA NOITE',NULL),(29,1,'FAVA DANDA DA COSTA',NULL),(30,1,'DANDA DA COSTA PO',NULL),(31,2,'DENDE',NULL),(32,5,'ELASTICO VERMELHO',NULL),(33,2,'ESSENCIA ERVA CIDREIRA',NULL),(34,2,'ESSENCIA MIRRA',NULL),(35,2,'ESSENCIA SANDALO',NULL),(36,2,'ESSENCIA ALABASTRO',NULL),(37,2,'ESSENCIA ALECRIM',NULL),(38,2,'ESSENCIA ALFAZEMA',NULL),(39,2,'ESSENCIA ALFAZEMA FAB PROPRIA',NULL),(40,2,'ESSENCIA ALMISCAR',NULL),(41,2,'ESSENCIA ALOÉS',NULL),(42,2,'ESSENCIA ANDIROBA',NULL),(43,2,'ESSENCIA ANGELICA',NULL),(44,2,'ESSENCIA ARRUDA',NULL),(45,2,'ESSENCIA BALSAMO',NULL),(46,2,'ESSENCIA BAUNILHA',NULL),(47,7,'pos antigos',NULL),(48,2,'ESSENCIA BENJOIN',NULL),(49,2,'ESSENCIA CANELA',NULL),(50,2,'ESSENCIA CEREJA',NULL),(51,2,'ESSENCIA CRAVO',NULL),(52,2,'ESSENCIA ACACIA',NULL),(53,14,'ESSENCIA  BAUNILHA FAB PROPRIA',NULL),(54,14,'ESSENCIA  BENJOIM FAB PROPRIA',NULL),(55,14,'ESSENCIA  CANELA FAB PROPRIA',NULL),(56,14,'ESSENCIA  LAVANDA FAB PROPRIA',NULL),(57,14,'ESSENCIA  PATCHOULI FAB PROPRIA',NULL),(58,14,'ESSENCIA  SANDALO FAB PROPRIA',NULL),(59,4,'ETIQUETAS PIMACO',NULL),(60,2,'ESSENCIA EUCALIPTO',NULL),(61,2,'MISTURA PERFUME DA BOTA',NULL),(62,1,'FAVA ANDARA',NULL),(63,1,'FAVA ANIZ ESTRELADO',NULL),(64,1,'FAVA ARIDAN',NULL),(65,2,'ESSENCIA FLOR DE LARANJEIRA',NULL),(66,2,'ESSENCIA FLORAL',NULL),(67,3,'FRASCO 100ML ACETONA',NULL),(68,3,'TAMPA METAL (FRASCO CRISTAL)',NULL),(69,3,'FRASCO CRISTAL 50ML',NULL),(70,3,'BATOQUE',NULL),(71,3,'TAMPA BOLINHA',NULL),(72,3,'TAMPA DIAMANTE',NULL),(73,3,'FRASCO ESMALTE',NULL),(74,3,'FRASCO GELPET COM TAMPA LACRE',NULL),(75,3,'TAMPA METAL (FRASCO REPARADOR)',NULL),(76,3,'FRASCO REPARADOR',NULL),(77,3,'TAMPA ROLHA',NULL),(78,3,'FRASCO PENICILINA',NULL),(79,10,'GOMA XANTANA',NULL),(80,2,'ESSENCIA HERBAIS',NULL),(81,2,'ESSENCIA HORTELA',NULL),(82,4,'TEXTO BOTA',NULL),(83,2,'ESSENCIA JASMIM',NULL),(84,11,'JOANES - ERVA DE SANTA MARIA',NULL),(85,5,'LACRE ADESIVO',NULL),(86,2,'ESSENCIA LARANJA',NULL),(87,2,'ESSENCIA LAVANDA',NULL),(88,1,'FAVA LELECUM',NULL),(89,2,'ESSENCIA LIRIO',NULL),(90,7,'OLEO CANOLA',NULL),(91,2,'ESSENCIA MAÇA VERDE',NULL),(92,2,'ESSENCIA MADEIRA ORIENTE',NULL),(93,2,'ESSENCIA MAMAE E BEBE',NULL),(94,11,'ERVA MANJERICÃO SECA',NULL),(95,9,'CORANTE GEL MARROM',NULL),(96,2,'ESSENCIA MEL',NULL),(97,2,'ESSENCIA MELISSA',NULL),(98,2,'VINAGRE',NULL),(99,11,'MISTURA DEFUMADOR',NULL),(100,2,'ESSENCIA MORANGO',NULL),(101,2,'ESSENCIA MORANGO COM CHAMP',NULL),(102,1,'FAVA NOZ MOSCADA',NULL),(103,1,'NOZ MOSCADA PO',NULL),(104,2,'OLEO ESSENCIAL PATCHOULY ',NULL),(105,7,'OLEO GIRASSOL',NULL),(106,6,'OLEO VELHO DA LOJA',NULL),(107,2,'ESSENCIA OPIUM',NULL),(108,2,'ESSENCIA ORQUIDEA',NULL),(109,4,'PALAVRAS',NULL),(110,4,'PAPEL VERGE RECICLADO',NULL),(111,2,'ESSENCIA PATCHOULI',NULL),(112,6,'PEIXE',NULL),(113,4,'ROTULO BOTA',NULL),(114,4,'ROTULO PERFUME LUXO CORES',NULL),(115,4,'ROTULO PERFUME GD PB',NULL),(116,1,'PIMENTA DA COSTA GRAO',NULL),(117,1,'PIMENTA DA COSTA PO',NULL),(118,9,'CORANTE PO PRETO',NULL),(119,13,'RASPA DE CHIFRE DE BOI',NULL),(120,6,'REMOVEDOR',NULL),(121,10,'RENEX',NULL),(122,13,'RESINA BENJOIM',NULL),(123,2,'ESSENCIA ROSAS',NULL),(124,4,'ROTULO AGUAS',NULL),(125,4,'ROTULO BOTO',NULL),(126,4,'ROTULO ESSENCIA GRANDE PB',NULL),(127,4,'ROTULO ESSENCIA PQ TRANSP',NULL),(128,5,'ROTULO EXTRATO CARRAPATO (m/f)',NULL),(129,4,'ROTULO PO',NULL),(130,5,'SACO 12*25 ',NULL),(131,5,'SACO 6*9',NULL),(132,5,'SACO 8*11',NULL),(133,5,'SACOLA PRETA GD',NULL),(134,5,'SACOLA PRETA mercado',NULL),(135,10,'SAL COZINHA',NULL),(136,13,'SALAMARGO',NULL),(137,11,'ERVA SALVIA',NULL),(138,1,'ANIZ ESTRELADO PO',NULL),(139,12,'TERÇO',NULL),(140,9,'CORANTE VELA AZUL MARINHO',NULL),(141,9,'CORANTE VELA AMARELO',NULL),(142,9,'CORANTE VELA VERDE',NULL),(143,9,'CORANTE VELA VERMELHO',NULL),(144,2,'ESSENCIA VERBENA',NULL),(145,9,'CORANTE PO VERDE',NULL),(146,9,'CORANTE PO VERMELHO',NULL),(147,2,'ESSENCIA VIOLETA',NULL),(148,2,'ESSENCIA YLANG',NULL),(149,11,'ALFAZEMA SECA',NULL),(150,4,'CARTUCHO PB',NULL),(151,4,'CARTUCHO CORES',NULL),(152,7,'PROPILENOGLICOL 100ML',NULL),(153,7,'PROPILENOGLICOL',NULL),(154,5,'CAIXA 30*40*40',NULL),(155,5,'CAIXA PP MUDANÇA',NULL),(156,5,'CAIXA TORTA PP',NULL),(157,13,'YEROSSUM',NULL),(158,9,'CORANTE SABONETE GERAL',NULL);
/*!40000 ALTER TABLE `materia_primas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `grupo_produto_id` int(10) unsigned DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `valor_varejo` double(15,2) unsigned DEFAULT NULL,
  `valor_atacado` double(15,2) unsigned DEFAULT NULL,
  `estoque_minimo` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (1,NULL,'Água de flor: Laranjeira',9.50,8.00,0);
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `situacaos`
--

DROP TABLE IF EXISTS `situacaos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `situacaos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `situacaos`
--

LOCK TABLES `situacaos` WRITE;
/*!40000 ALTER TABLE `situacaos` DISABLE KEYS */;
INSERT INTO `situacaos` VALUES (1,'Recebido'),(2,'Entregue'),(3,'Cancelado'),(4,'Extraviado'),(5,'Estragado'),(6,'Enviado');
/*!40000 ALTER TABLE `situacaos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_materia_primas`
--

DROP TABLE IF EXISTS `tipo_materia_primas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_materia_primas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_materia_primas`
--

LOCK TABLES `tipo_materia_primas` WRITE;
/*!40000 ALTER TABLE `tipo_materia_primas` DISABLE KEYS */;
INSERT INTO `tipo_materia_primas` VALUES (1,'FAVAS'),(2,'ESSENCIAS'),(3,'FRASCO'),(4,'RÓTULO'),(5,'EMBALAGEM'),(6,'AROMATICOS (EXCETO ESSENCIA)'),(7,'BASE'),(8,'SOLVENTE'),(9,'CORANTE'),(10,'ADITIVOS'),(11,'ERVAS'),(12,'MISSANGA'),(13,'RESINAS / MINERAIS ETC'),(14,'FAB PROPRIA');
/*!40000 ALTER TABLE `tipo_materia_primas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unidade_medidas`
--

DROP TABLE IF EXISTS `unidade_medidas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unidade_medidas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unidade_medidas`
--

LOCK TABLES `unidade_medidas` WRITE;
/*!40000 ALTER TABLE `unidade_medidas` DISABLE KEYS */;
INSERT INTO `unidade_medidas` VALUES (1,'Unidade'),(2,'Mililitros'),(3,'Gramas');
/*!40000 ALTER TABLE `unidade_medidas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `role` enum('A','C','F') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Maria Antonietta','mariaversiani@yahoo.com.br','$2y$10$SyNt9aiaUGJWV6LxxAe6/.4RRh1tRdzmnl4X0C0RKi2jN54bCNScq','2019-03-06 00:33:50','2019-03-06 00:34:23',1,'A');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-03-13 16:30:53
