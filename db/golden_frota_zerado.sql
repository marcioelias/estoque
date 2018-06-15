-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: golden_frota
-- ------------------------------------------------------
-- Server version	5.7.22-0ubuntu18.04.1

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
-- Table structure for table `abastecimentos`
--

DROP TABLE IF EXISTS `abastecimentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `abastecimentos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_automacao` int(11) DEFAULT NULL,
  `ns_automacao` int(11) DEFAULT NULL,
  `bico_id` int(10) unsigned DEFAULT NULL,
  `encerrante_inicial` double(15,3) DEFAULT NULL,
  `encerrante_final` double(15,3) DEFAULT NULL,
  `volume_abastecimento` double(15,3) NOT NULL,
  `valor_litro` double(15,3) NOT NULL,
  `valor_abastecimento` double(15,3) NOT NULL,
  `atendente_id` int(10) unsigned DEFAULT NULL,
  `veiculo_id` int(10) unsigned DEFAULT NULL,
  `km_veiculo` double(15,1) DEFAULT NULL,
  `media_veiculo` decimal(15,3) NOT NULL,
  `requisicao_abastecimento` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `data_hora_abastecimento` datetime NOT NULL,
  `abastecimento_local` tinyint(1) NOT NULL DEFAULT '1',
  `inconsistencias_importacao` tinyint(1) NOT NULL DEFAULT '0',
  `obs_abastecimento` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tanque_movimentacao_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `abastecimentos_bico_id_foreign` (`bico_id`),
  KEY `abastecimentos_atendente_id_foreign` (`atendente_id`),
  KEY `abastecimentos_veiculo_id_foreign` (`veiculo_id`),
  KEY `abastecimentos_tanque_movimentacao_id_foreign` (`tanque_movimentacao_id`),
  CONSTRAINT `abastecimentos_atendente_id_foreign` FOREIGN KEY (`atendente_id`) REFERENCES `atendentes` (`id`),
  CONSTRAINT `abastecimentos_bico_id_foreign` FOREIGN KEY (`bico_id`) REFERENCES `bicos` (`id`),
  CONSTRAINT `abastecimentos_tanque_movimentacao_id_foreign` FOREIGN KEY (`tanque_movimentacao_id`) REFERENCES `tanque_movimentacoes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `abastecimentos_veiculo_id_foreign` FOREIGN KEY (`veiculo_id`) REFERENCES `veiculos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `abastecimentos`
--

LOCK TABLES `abastecimentos` WRITE;
/*!40000 ALTER TABLE `abastecimentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `abastecimentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `atendentes`
--

DROP TABLE IF EXISTS `atendentes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atendentes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome_atendente` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario_atendente` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha_atendente` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `atendentes_usuario_atendente_unique` (`usuario_atendente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atendentes`
--

LOCK TABLES `atendentes` WRITE;
/*!40000 ALTER TABLE `atendentes` DISABLE KEYS */;
/*!40000 ALTER TABLE `atendentes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bicos`
--

DROP TABLE IF EXISTS `bicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bicos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `num_bico` int(11) NOT NULL,
  `tanque_id` int(10) unsigned NOT NULL,
  `bomba_id` int(10) unsigned NOT NULL,
  `encerrante` double(15,3) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bicos_num_bico_unique` (`num_bico`),
  KEY `bicos_tanque_id_foreign` (`tanque_id`),
  KEY `bicos_bomba_id_foreign` (`bomba_id`),
  CONSTRAINT `bicos_bomba_id_foreign` FOREIGN KEY (`bomba_id`) REFERENCES `bombas` (`id`),
  CONSTRAINT `bicos_tanque_id_foreign` FOREIGN KEY (`tanque_id`) REFERENCES `tanques` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bicos`
--

LOCK TABLES `bicos` WRITE;
/*!40000 ALTER TABLE `bicos` DISABLE KEYS */;
/*!40000 ALTER TABLE `bicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bombas`
--

DROP TABLE IF EXISTS `bombas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bombas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao_bomba` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_bomba_id` int(10) unsigned NOT NULL,
  `modelo_bomba_id` int(10) unsigned NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bombas_descricao_bomba_unique` (`descricao_bomba`),
  KEY `bombas_tipo_bomba_id_foreign` (`tipo_bomba_id`),
  KEY `bombas_modelo_bomba_id_foreign` (`modelo_bomba_id`),
  CONSTRAINT `bombas_modelo_bomba_id_foreign` FOREIGN KEY (`modelo_bomba_id`) REFERENCES `modelo_bombas` (`id`),
  CONSTRAINT `bombas_tipo_bomba_id_foreign` FOREIGN KEY (`tipo_bomba_id`) REFERENCES `tipo_bombas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bombas`
--

LOCK TABLES `bombas` WRITE;
/*!40000 ALTER TABLE `bombas` DISABLE KEYS */;
/*!40000 ALTER TABLE `bombas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome_razao` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fantasia` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cpf_cnpj` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rg_ie` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_pessoa_id` int(10) unsigned NOT NULL,
  `fone1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fone2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `endereco` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bairro` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cidade` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cep` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uf_id` int(10) unsigned NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clientes_nome_razao_unique` (`nome_razao`),
  KEY `clientes_tipo_pessoa_id_foreign` (`tipo_pessoa_id`),
  KEY `clientes_uf_id_foreign` (`uf_id`),
  CONSTRAINT `clientes_tipo_pessoa_id_foreign` FOREIGN KEY (`tipo_pessoa_id`) REFERENCES `tipo_pessoas` (`id`),
  CONSTRAINT `clientes_uf_id_foreign` FOREIGN KEY (`uf_id`) REFERENCES `ufs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `combustiveis`
--

DROP TABLE IF EXISTS `combustiveis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `combustiveis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao_reduzida` char(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` decimal(5,3) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `combustiveis_descricao_unique` (`descricao`),
  UNIQUE KEY `combustiveis_descricao_reduzida_unique` (`descricao_reduzida`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `combustiveis`
--

LOCK TABLES `combustiveis` WRITE;
/*!40000 ALTER TABLE `combustiveis` DISABLE KEYS */;
/*!40000 ALTER TABLE `combustiveis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departamentos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `departamento` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cliente_id` int(10) unsigned NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `departamentos_cliente_id_foreign` (`cliente_id`),
  CONSTRAINT `departamentos_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamentos`
--

LOCK TABLES `departamentos` WRITE;
/*!40000 ALTER TABLE `departamentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `departamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estoque_movimentacoes`
--

DROP TABLE IF EXISTS `estoque_movimentacoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estoque_movimentacoes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `entrada_produto` tinyint(1) NOT NULL,
  `data_movimentacao` date NOT NULL,
  `documento_movimentacao` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `produto_id` int(10) unsigned NOT NULL,
  `quantidade_movimentada` decimal(15,2) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `estoque_movimentacoes_produto_id_foreign` (`produto_id`),
  CONSTRAINT `estoque_movimentacoes_produto_id_foreign` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estoque_movimentacoes`
--

LOCK TABLES `estoque_movimentacoes` WRITE;
/*!40000 ALTER TABLE `estoque_movimentacoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `estoque_movimentacoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupo_produtos`
--

DROP TABLE IF EXISTS `grupo_produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupo_produtos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `grupo_produto` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `grupo_produtos_grupo_produto_unique` (`grupo_produto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo_produtos`
--

LOCK TABLES `grupo_produtos` WRITE;
/*!40000 ALTER TABLE `grupo_produtos` DISABLE KEYS */;
/*!40000 ALTER TABLE `grupo_produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupo_veiculos`
--

DROP TABLE IF EXISTS `grupo_veiculos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupo_veiculos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `grupo_veiculo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `grupo_veiculos_grupo_veiculo_unique` (`grupo_veiculo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo_veiculos`
--

LOCK TABLES `grupo_veiculos` WRITE;
/*!40000 ALTER TABLE `grupo_veiculos` DISABLE KEYS */;
/*!40000 ALTER TABLE `grupo_veiculos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marca_veiculos`
--

DROP TABLE IF EXISTS `marca_veiculos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marca_veiculos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `marca_veiculo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `marca_veiculos_marca_veiculo_unique` (`marca_veiculo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marca_veiculos`
--

LOCK TABLES `marca_veiculos` WRITE;
/*!40000 ALTER TABLE `marca_veiculos` DISABLE KEYS */;
/*!40000 ALTER TABLE `marca_veiculos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2017_09_30_031905_create_table_combustiveis',1),(4,'2017_10_01_044935_create_tipo_bombas_table',1),(5,'2017_10_01_052448_create_modelo_bombas_table',1),(6,'2017_10_01_054247_alter_table_modelo_bombas_create_field_num_bicos',1),(7,'2017_10_03_032701_create_tanques_table',1),(8,'2017_10_03_043420_create_bombas_table',1),(9,'2017_10_03_054002_alter_table_users_create_field_ativo',1),(10,'2017_10_04_042356_create_grupo_produtos_table',1),(11,'2017_10_05_045547_create_marca_veiculos_table',1),(12,'2017_10_12_052728_create_unidades_table',1),(13,'2017_10_14_040756_create_produtos_table',1),(14,'2017_10_14_161238_create_bicos_table',1),(15,'2017_10_15_011737_create_modelo_veiculos_table',1),(16,'2017_10_15_021350_create_tipo_pessoas_table',1),(17,'2017_10_15_021402_create_clientes_table',1),(18,'2017_10_15_215130_create_ufs_table',1),(19,'2017_10_15_215246_alter_table_clientes_add_column_uf_id',1),(20,'2017_10_16_212744_create_veiculos_table',1),(21,'2017_10_17_032250_alter_table_bicos_create_column_encerrante',1),(22,'2017_10_17_034928_create_atendentes_table',1),(23,'2017_10_19_024234_create_grupo_veiculos_table',1),(24,'2017_10_19_024408_alter_table_veiculos_add_column_grupo_veiculo_id',1),(25,'2017_10_19_025523_alter_table_grupo_veiculos_add_column_ativo',1),(26,'2017_10_20_024601_create_table_abastecimentos',1),(27,'2017_10_23_042506_alter_table_abastecimentos_add_column_inconsistencias_importacao',1),(28,'2017_10_28_033140_alter_table_abastecimento_create_column_media_veiculo',1),(29,'2017_10_29_032013_create_estoque_movimentacoes_table',1),(30,'2017_10_29_032943_create_tanque_movimentacoes_table',1),(31,'2017_11_01_013106_alter_table_abastecimentos_add_column_tanque_movimentacao_id',1),(32,'2017_11_10_025247_create_departamentos_table',1),(33,'2017_11_10_033927_alter_table_veiculos_add_column_departamento_id',1),(34,'2017_11_28_040239_create_parametros_table',1),(35,'2017_11_29_051635_alter_table_clientes_add_column_cep',1),(36,'2017_12_05_041031_create_sessions_table',1),(37,'2018_04_22_150458_laratrust_setup_tables',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modelo_bombas`
--

DROP TABLE IF EXISTS `modelo_bombas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modelo_bombas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `modelo_bomba` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_bicos` int(11) NOT NULL DEFAULT '1',
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modelo_bombas`
--

LOCK TABLES `modelo_bombas` WRITE;
/*!40000 ALTER TABLE `modelo_bombas` DISABLE KEYS */;
/*!40000 ALTER TABLE `modelo_bombas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modelo_veiculos`
--

DROP TABLE IF EXISTS `modelo_veiculos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modelo_veiculos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `modelo_veiculo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacidade_tanque` int(11) NOT NULL,
  `marca_veiculo_id` int(10) unsigned NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `modelo_veiculos_modelo_veiculo_unique` (`modelo_veiculo`),
  KEY `modelo_veiculos_marca_veiculo_id_foreign` (`marca_veiculo_id`),
  CONSTRAINT `modelo_veiculos_marca_veiculo_id_foreign` FOREIGN KEY (`marca_veiculo_id`) REFERENCES `marca_veiculos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modelo_veiculos`
--

LOCK TABLES `modelo_veiculos` WRITE;
/*!40000 ALTER TABLE `modelo_veiculos` DISABLE KEYS */;
/*!40000 ALTER TABLE `modelo_veiculos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parametros`
--

DROP TABLE IF EXISTS `parametros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parametros` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cliente_id` int(10) unsigned NOT NULL,
  `logotipo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parametros_cliente_id_foreign` (`cliente_id`),
  CONSTRAINT `parametros_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parametros`
--

LOCK TABLES `parametros` WRITE;
/*!40000 ALTER TABLE `parametros` DISABLE KEYS */;
/*!40000 ALTER TABLE `parametros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_user`
--

DROP TABLE IF EXISTS `permission_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_user` (
  `permission_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  KEY `permission_user_permission_id_foreign` (`permission_id`),
  CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_user`
--

LOCK TABLES `permission_user` WRITE;
/*!40000 ALTER TABLE `permission_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `produto_descricao` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `produto_desc_red` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unidade_id` int(10) unsigned NOT NULL,
  `valor_unitario` double(10,3) NOT NULL,
  `grupo_produto_id` int(10) unsigned NOT NULL,
  `qtd_estoque` double(10,3) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `produtos_produto_descricao_unique` (`produto_descricao`),
  KEY `produtos_unidade_id_foreign` (`unidade_id`),
  KEY `produtos_grupo_produto_id_foreign` (`grupo_produto_id`),
  CONSTRAINT `produtos_grupo_produto_id_foreign` FOREIGN KEY (`grupo_produto_id`) REFERENCES `grupo_produtos` (`id`),
  CONSTRAINT `produtos_unidade_id_foreign` FOREIGN KEY (`unidade_id`) REFERENCES `unidades` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tanque_movimentacoes`
--

DROP TABLE IF EXISTS `tanque_movimentacoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tanque_movimentacoes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `entrada_combustivel` tinyint(1) NOT NULL,
  `data_movimentacao` date NOT NULL,
  `documento` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanque_id` int(10) unsigned NOT NULL,
  `quantidade_combustivel` decimal(15,2) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tanque_movimentacoes_tanque_id_foreign` (`tanque_id`),
  CONSTRAINT `tanque_movimentacoes_tanque_id_foreign` FOREIGN KEY (`tanque_id`) REFERENCES `tanques` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tanque_movimentacoes`
--

LOCK TABLES `tanque_movimentacoes` WRITE;
/*!40000 ALTER TABLE `tanque_movimentacoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `tanque_movimentacoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tanques`
--

DROP TABLE IF EXISTS `tanques`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tanques` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao_tanque` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `combustivel_id` int(10) unsigned NOT NULL,
  `capacidade` decimal(9,3) NOT NULL,
  `posicao` decimal(9,3) NOT NULL DEFAULT '0.000',
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tanques_descricao_tanque_unique` (`descricao_tanque`),
  KEY `tanques_combustivel_id_foreign` (`combustivel_id`),
  CONSTRAINT `tanques_combustivel_id_foreign` FOREIGN KEY (`combustivel_id`) REFERENCES `combustiveis` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tanques`
--

LOCK TABLES `tanques` WRITE;
/*!40000 ALTER TABLE `tanques` DISABLE KEYS */;
/*!40000 ALTER TABLE `tanques` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_bombas`
--

DROP TABLE IF EXISTS `tipo_bombas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_bombas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_bomba` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_bombas`
--

LOCK TABLES `tipo_bombas` WRITE;
/*!40000 ALTER TABLE `tipo_bombas` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_bombas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_pessoas`
--

DROP TABLE IF EXISTS `tipo_pessoas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_pessoas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_pessoa` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_pessoas`
--

LOCK TABLES `tipo_pessoas` WRITE;
/*!40000 ALTER TABLE `tipo_pessoas` DISABLE KEYS */;
INSERT INTO `tipo_pessoas` VALUES (1,'Física',NULL,NULL),(2,'Jurídica',NULL,NULL);
/*!40000 ALTER TABLE `tipo_pessoas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ufs`
--

DROP TABLE IF EXISTS `ufs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ufs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uf` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ufs`
--

LOCK TABLES `ufs` WRITE;
/*!40000 ALTER TABLE `ufs` DISABLE KEYS */;
INSERT INTO `ufs` VALUES (1,'AC',NULL,NULL),(2,'AL',NULL,NULL),(3,'AM',NULL,NULL),(4,'AP',NULL,NULL),(5,'BA',NULL,NULL),(6,'CE',NULL,NULL),(7,'DF',NULL,NULL),(8,'ES',NULL,NULL),(9,'GO',NULL,NULL),(10,'MA',NULL,NULL),(11,'MG',NULL,NULL),(12,'MS',NULL,NULL),(13,'MT',NULL,NULL),(14,'PA',NULL,NULL),(15,'PB',NULL,NULL),(16,'PE',NULL,NULL),(17,'PI',NULL,NULL),(18,'PR',NULL,NULL),(19,'RJ',NULL,NULL),(20,'RN',NULL,NULL),(21,'RO',NULL,NULL),(22,'RR',NULL,NULL),(23,'RS',NULL,NULL),(24,'SC',NULL,NULL),(25,'SE',NULL,NULL),(26,'SP',NULL,NULL),(27,'TO',NULL,NULL);
/*!40000 ALTER TABLE `ufs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unidades`
--

DROP TABLE IF EXISTS `unidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unidades` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `unidade` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permite_fracionamento` tinyint(1) NOT NULL DEFAULT '1',
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unidades_unidade_unique` (`unidade`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unidades`
--

LOCK TABLES `unidades` WRITE;
/*!40000 ALTER TABLE `unidades` DISABLE KEYS */;
INSERT INTO `unidades` VALUES (1,'UN',0,1,NULL,NULL),(2,'LT',1,1,NULL,NULL),(3,'KG',1,1,NULL,NULL);
/*!40000 ALTER TABLE `unidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrador','admin@localhost','admin','$2y$10$HZIkzRJ7dO70uUHIpN99KuZzbRB9HUnRsYAW993DuW9Db5OAtaVx6','Ws6OxwRo8ooAqWKpWAmdJ2SG0EhRLMX0OV9ZhfwgMdI7ZwkEnXYzdnK4JCP1',NULL,NULL,1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `veiculos`
--

DROP TABLE IF EXISTS `veiculos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `veiculos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `placa` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grupo_veiculo_id` int(10) unsigned NOT NULL,
  `cliente_id` int(10) unsigned NOT NULL,
  `departamento_id` int(10) unsigned DEFAULT NULL,
  `modelo_veiculo_id` int(10) unsigned NOT NULL,
  `ano` int(11) NOT NULL,
  `renavam` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chassi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hodometro` int(11) NOT NULL DEFAULT '0',
  `media_minima` double(8,2) NOT NULL DEFAULT '0.00',
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `veiculos_placa_unique` (`placa`),
  KEY `veiculos_cliente_id_foreign` (`cliente_id`),
  KEY `veiculos_modelo_veiculo_id_foreign` (`modelo_veiculo_id`),
  KEY `veiculos_grupo_veiculo_id_foreign` (`grupo_veiculo_id`),
  KEY `veiculos_departamento_id_foreign` (`departamento_id`),
  CONSTRAINT `veiculos_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  CONSTRAINT `veiculos_departamento_id_foreign` FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`),
  CONSTRAINT `veiculos_grupo_veiculo_id_foreign` FOREIGN KEY (`grupo_veiculo_id`) REFERENCES `grupo_veiculos` (`id`),
  CONSTRAINT `veiculos_modelo_veiculo_id_foreign` FOREIGN KEY (`modelo_veiculo_id`) REFERENCES `modelo_veiculos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `veiculos`
--

LOCK TABLES `veiculos` WRITE;
/*!40000 ALTER TABLE `veiculos` DISABLE KEYS */;
/*!40000 ALTER TABLE `veiculos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-16 23:05:48
