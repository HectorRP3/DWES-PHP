mysqldump: [Warning] Using a password on the command line interface can be insecure.
-- MySQL dump 10.13  Distrib 9.0.1, for Linux (x86_64)
--
-- Host: localhost    Database: reforesta
-- ------------------------------------------------------
-- Server version	9.0.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Especies`
--

DROP TABLE IF EXISTS `Especies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Especies` (
  `NombreCientifico` varchar(100) NOT NULL,
  `Beneficios` varchar(255) DEFAULT NULL,
  `NombreComun` varchar(200) NOT NULL,
  `Descripcion` text NOT NULL,
  `Clima` varchar(200) NOT NULL,
  `RegionOrigen` varchar(100) NOT NULL,
  `TiempoMaduracion` int NOT NULL,
  `ImagenURL` varchar(555) NOT NULL,
  PRIMARY KEY (`NombreCientifico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Especies`
--

LOCK TABLES `Especies` WRITE;
/*!40000 ALTER TABLE `Especies` DISABLE KEYS */;
INSERT INTO `Especies` VALUES ('Mangifera indica','Rica en antioxidantes, vitaminas y fibra','Mango','rbol tropical que produce frutos dulces y jugosos. El mango es conocido por su sabor nico y usos culinarios variados.','Tropical y subtropical','Asia del Sur',120,'https://example.com/mango.jpg'),('Ornitorinco','12','orni','El montes de los montes','Nublado','alicante',50,'../images/species/reforesta.png'),('Pedro','12','pedrito','pedrito el palotes','','alicante',120,''),('Pedro222','12','pedrito','El montes de los montes','Nublado','alicante',120,'../images/species/reforesta.png'),('Pedro22212212','12','pedrito','El montes de los montes','Nublado','alicante',120,'../images/species/reforesta.png'),('Pedroca','12','pedrito','pedrito el palotes','','alicante',120,'');
/*!40000 ALTER TABLE `Especies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Eventos`
--

DROP TABLE IF EXISTS `Eventos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Eventos` (
  `EventoID` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` text NOT NULL,
  `Provincia` varchar(250) NOT NULL,
  `Localidad` varchar(200) NOT NULL,
  `TipoTerreno` varchar(250) NOT NULL,
  `TipoEvento` varchar(250) NOT NULL,
  `Fecha` varchar(255) DEFAULT NULL,
  `AnfitrionID` varchar(250) NOT NULL,
  `Estado` varchar(250) DEFAULT 'Pendiente',
  `FechaAprobacion` varchar(255) DEFAULT NULL,
  `FechaCreacion` varchar(255) DEFAULT NULL,
  `ImagenURL` varchar(555) NOT NULL DEFAULT 'https://example.com/default-event-image.jpg',
  PRIMARY KEY (`EventoID`),
  KEY `fk_Anfitrion` (`AnfitrionID`),
  CONSTRAINT `fk_Anfitrion` FOREIGN KEY (`AnfitrionID`) REFERENCES `Usuarios` (`Nickname`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Eventos`
--

LOCK TABLES `Eventos` WRITE;
/*!40000 ALTER TABLE `Eventos` DISABLE KEYS */;
INSERT INTO `Eventos` VALUES (67,'MonteVerde','El montes de los montes','Alicante','Alicante','Ladera','Reforestaci├│n desde Semillas','2024-11-28','Hector23','Aprobado','2024-11-24',NULL,'../images/events/reforesta.png'),(68,'MonteVerde','El montes de los montes','Alicante','Alicante','Incendio','Reforestaci├│n con ├ürboles J├│venes','2024-11-28','Hector23','Aprobado','2024-11-24',NULL,'../images/events/reforesta.png'),(69,'MonteVerde','El montes de los montes','Alicante','Alicante','Soto Deteriorado','Reforestaci├│n con ├ürboles J├│venes','2024-12-05','Hector23','Aprobado','2024-11-24',NULL,'../images/events/reforesta.png'),(70,'MonteVerde','El montes de los montes','Alicante','Alicante','default','default','2024-11-30','','Aprobado','2024-11-24',NULL,'../images/events/reforesta.png'),(72,'Cazador de mariposas','El montes de los montes','Alicante','Alicante','Incendio','Reforestaci├│n con ├ürboles J├│venes','2024-11-30','','Aprobado','2024-11-27',NULL,'../images/events/reforesta.png'),(73,'Cazador de mariposas','El montes de los montes','Alicante','Alicante','Incendio','Reforestaci├│n con ├ürboles J├│venes','2024-11-30','Hector232','Aprobado','2024-11-27',NULL,'../images/events/reforesta.png'),(74,'fdas','fas','fdas','fdsa','Colina','Reforestaci├│n con ├ürboles J├│venes','2024-12-07','Hector232','Aprobado','2024-11-27',NULL,'../images/events/reforesta.png');
/*!40000 ALTER TABLE `Eventos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EventosEspecies`
--

DROP TABLE IF EXISTS `EventosEspecies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `EventosEspecies` (
  `EventoID` int NOT NULL,
  `EspecieID` varchar(100) NOT NULL,
  `Cantidad` int NOT NULL,
  PRIMARY KEY (`EventoID`,`EspecieID`),
  KEY `fk_specioevento` (`EspecieID`),
  CONSTRAINT `fk_evetntospe` FOREIGN KEY (`EventoID`) REFERENCES `Eventos` (`EventoID`) ON DELETE CASCADE,
  CONSTRAINT `fk_specioevento` FOREIGN KEY (`EspecieID`) REFERENCES `Especies` (`NombreCientifico`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EventosEspecies`
--

LOCK TABLES `EventosEspecies` WRITE;
/*!40000 ALTER TABLE `EventosEspecies` DISABLE KEYS */;
INSERT INTO `EventosEspecies` VALUES (68,'Pedroca',67),(69,'Ornitorinco',123),(70,'Pedro22212212',20000),(72,'Mangifera indica',40000),(73,'Mangifera indica',40000),(74,'Ornitorinco',15);
/*!40000 ALTER TABLE `EventosEspecies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Participantes`
--

DROP TABLE IF EXISTS `Participantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Participantes` (
  `UserID` varchar(250) NOT NULL,
  `EventoID` int NOT NULL,
  PRIMARY KEY (`UserID`,`EventoID`),
  KEY `fk_eventopar` (`EventoID`),
  CONSTRAINT `fk_eventopar` FOREIGN KEY (`EventoID`) REFERENCES `Eventos` (`EventoID`) ON DELETE CASCADE,
  CONSTRAINT `fk_userpar` FOREIGN KEY (`UserID`) REFERENCES `Usuarios` (`Nickname`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Participantes`
--

LOCK TABLES `Participantes` WRITE;
/*!40000 ALTER TABLE `Participantes` DISABLE KEYS */;
INSERT INTO `Participantes` VALUES ('Hector23',67),('Hector23',68),('Hector232',68);
/*!40000 ALTER TABLE `Participantes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Usuarios`
--

DROP TABLE IF EXISTS `Usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Usuarios` (
  `Nickname` varchar(250) NOT NULL,
  `Nombre` varchar(150) NOT NULL,
  `Apellidos` varchar(100) NOT NULL,
  `Email` varchar(500) NOT NULL,
  `Karma` int DEFAULT '0',
  `Suscrito` tinyint(1) DEFAULT '0',
  `FechaCreacion` varchar(255) DEFAULT NULL,
  `Contrasea` varchar(5555) NOT NULL,
  PRIMARY KEY (`Nickname`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Usuarios`
--

LOCK TABLES `Usuarios` WRITE;
/*!40000 ALTER TABLE `Usuarios` DISABLE KEYS */;
INSERT INTO `Usuarios` VALUES ('','','','',0,0,'2024-11-20',''),('Hector23','hector rodr','rodriguez Planelles','hector3232@gmail.com',40,1,'2024-11-24','03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4'),('Hector232','hector rodr2','rodriguez Planelles2','pepe@gmail.com',46,1,'2024-11-24','d4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35'),('Hectorinking','hector','rodriguez Planelles','hector@gmail.com',0,0,'2024-11-20',''),('Hectorinking52','fdafda','rodriguez Planelles','hector23@gmail.com',0,0,'2024-11-21','03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4'),('Juan23','Juan','Prez Lpez','juan23@example.com',10,0,NULL,'');
/*!40000 ALTER TABLE `Usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-27 11:57:40
