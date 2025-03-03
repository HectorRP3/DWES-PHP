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
INSERT INTO `Especies` VALUES ('Citrus sinensis','Rico en vitamina C, fortalece el sistema inmunolgico','Naranja','rbol frutal que produce frutos ctricos.','Clima templado clido','Asia',180,'https://upload.wikimedia.org/wikipedia/commons/4/43/Ambersweet_oranges.jpg'),('Coffea arabica','Estimulante natural, fuente de antioxidantes','Caf','Arbusto cuyas semillas se usan para preparar caf.','Clima templado','Etiopa',365,'https://upload.wikimedia.org/wikipedia/commons/4/45/Coffea_arabica_plant.jpg'),('Fragaria  ananassa','Rica en vitamina C y antioxidantes','Fresa','Planta herbcea que produce frutos rojos dulces.','Clima templado','Europa',60,'https://upload.wikimedia.org/wikipedia/commons/2/29/PerfectStrawberry.jpg'),('Helianthus annuus','Fuente de aceite y alimento para aves','Girasol','Planta herbcea conocida por sus grandes flores amarillas.','Clima clido','Amrica del Norte',90,'https://upload.wikimedia.org/wikipedia/commons/e/e0/Sunflower_sky_backdrop.jpg'),('Mangifera indica','Alto contenido de vitamina C y antioxidantes','Mango','rbol tropical que produce frutos dulces y jugosos.','Tropical','India',120,'https://upload.wikimedia.org/wikipedia/commons/6/6a/Mangoes_pic.jpg'),('Oryza sativa','Principal fuente de carbohidratos en el mundo','Arroz','Planta acutica cultivada por sus granos comestibles.','Clima tropical y subtropical','Asia',150,'https://upload.wikimedia.org/wikipedia/commons/7/7f/Rice_fields.jpg'),('Persea americana','Rico en grasas saludables, bueno para el corazn','Aguacate','rbol perenne que produce frutos verdes con una pulpa cremosa.','Clima templado y tropical','Mxico',240,'https://upload.wikimedia.org/wikipedia/commons/f/f5/Avocado_with_cross_section_edit.jpg'),('Pinus pinea','Fuente de piones y madera','Pino pionero','rbol confero que produce piones comestibles.','Clima mediterrneo','Regin Mediterrnea',730,'https://upload.wikimedia.org/wikipedia/commons/a/a4/Pinus_pinea.jpg'),('Solanum lycopersicum','Rico en licopeno, bueno para la salud del corazn','Tomate','Planta herbcea que produce frutos rojos comestibles.','Clima templado y clido','Sudamrica',75,'https://upload.wikimedia.org/wikipedia/commons/8/89/Tomato_je.jpg'),('Theobroma cacao','Base para la produccin de chocolate','Cacao','rbol tropical cuyas semillas se utilizan para producir cacao.','Tropical hmedo','Amrica Central',180,'https://upload.wikimedia.org/wikipedia/commons/e/e4/Cacao_pods.jpg'),('Vaccinium corymbosum','Alto contenido de antioxidantes y fibra','Arndano','Arbusto que produce pequeas bayas comestibles.','Clima templado','Norteamrica',90,'https://upload.wikimedia.org/wikipedia/commons/8/8c/Blueberries.jpg'),('Zea mays','Fuente bsica de alimento, usado en biocombustibles','Maz','Planta gramnea cultivada por sus granos comestibles.','Clima clido y templado','Mxico',180,'https://upload.wikimedia.org/wikipedia/commons/2/27/Zea_mays.jpg');
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
  `Fecha` date DEFAULT NULL,
  `AnfitrionID` varchar(250) NOT NULL,
  `FechaCreacion` date DEFAULT NULL,
  `ImagenURL` varchar(555) NOT NULL DEFAULT 'https://example.com/default-event-image.jpg',
  PRIMARY KEY (`EventoID`),
  KEY `fk_Anfitrion` (`AnfitrionID`),
  CONSTRAINT `fk_Anfitrion` FOREIGN KEY (`AnfitrionID`) REFERENCES `Usuarios` (`Nickname`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Eventos`
--

LOCK TABLES `Eventos` WRITE;
/*!40000 ALTER TABLE `Eventos` DISABLE KEYS */;
INSERT INTO `Eventos` VALUES (1,'MonteVerde','fdasfdas','Alicante','Alicante','Soto Deteriorado','Reforestaci├│n con ├ürboles J├│venes','2024-12-18','Juan23',NULL,'../images/events/Captura de pantalla 2024-04-29 155057.png'),(2,'hector rodr','Arboles y mas arboles','Alicante','Valencia','Soto Deteriorado','Reforestaci├│n con ├ürboles J├│venes','2024-12-26','Juan23',NULL,'../images/events/Captura de pantalla 2024-05-16 161649.png'),(3,'MonteVerde','fdasfdas','Alicante','Alicante','Soto Deteriorado','Reforestaci├│n con ├ürboles J├│venes','2024-12-18','Juan23',NULL,'../images/events/reforesta.png'),(4,'MonteVerde','fdasfdas','Alicante','Alicante','Soto Deteriorado','Reforestaci├│n con ├ürboles J├│venes','2024-12-18','Juan23',NULL,'../images/events/reforesta.png'),(5,'MonteVerde','El montes de los montes','Alicante','Alicante','Incendio','Recogida de Semillas','2024-12-18','Juan23',NULL,'../images/events/reforesta.png'),(6,'MonteVerde2','El montes de los montes','Alicante','Alicante','Colina','Reforestaci├│n con ├ürboles J├│venes','2024-12-31','',NULL,'../images/events/reforesta.png'),(7,'MonteVerde2','El montes de los montes','Alicante','Alicante','Colina','Reforestaci├│n con ├ürboles J├│venes','2024-12-31','Hector23222',NULL,'../images/events/reforesta.png'),(8,'MonteVerde','El montes de los montes','Alicante','Alicante','Ladera','Reforestaci├│n con ├ürboles J├│venes','2024-12-27','Hector23222',NULL,'../images/events/Captura de pantalla 2024-05-30 104423.png');
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
INSERT INTO `EventosEspecies` VALUES (1,'Helianthus annuus',2000),(2,'Helianthus annuus',2000),(3,'Helianthus annuus',2000),(4,'Helianthus annuus',2000),(5,'Fragaria  ananassa',234),(6,'Oryza sativa',1223),(7,'Oryza sativa',1223),(8,'Solanum lycopersicum',45000);
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
INSERT INTO `Participantes` VALUES ('Hector23222',1),('Hector23222',2),('Hector23222',8);
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
  `FechaCreacion` date DEFAULT NULL,
  `Contrasenya` varchar(5555) NOT NULL,
  PRIMARY KEY (`Nickname`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Usuarios`
--

LOCK TABLES `Usuarios` WRITE;
/*!40000 ALTER TABLE `Usuarios` DISABLE KEYS */;
INSERT INTO `Usuarios` VALUES ('','','','',0,0,'2024-11-20',''),('333','fead','fdsa','fdsa3333@gmail.com',0,0,'2024-12-19','d4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35'),('fff','222','222','pepe53@gmail.com',0,0,'2024-12-19','4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a'),('Hector23','hector rodr','rodriguez Planelles','hector3232@gmail.com',40,1,'2024-11-24','03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4'),('Hector232','hector rodr2','rodriguez Planelles2','pepe@gmail.com',46,1,'2024-11-24','d4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35'),('Hector23222','fdafda55','rodriguez Planelles','pepe32323232@gmail.com',15,1,'2024-12-21','d4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35'),('Hector234','hector rodr','rodriguez Planelles','pepe22@gmail.com',0,0,'2024-12-19','d4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35'),('Hector23622','hector rodr','rodriguez Planelles','pepefdsafda@gmail.com',2,1,'2024-12-20','6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b'),('Hectorinking','hector','rodriguez Planelles','hector@gmail.com',0,0,'2024-11-20',''),('Hectorinking52','fdafda','rodriguez Planelles','hector23@gmail.com',0,0,'2024-11-21','03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4'),('Hola12','fdafda','rodriguez Planelles','pepeFDS@gmail.com',0,0,'2024-12-21','d4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35'),('Juan23','Juan','Prez Lpez','juan23@example.com',27,1,NULL,'');
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

-- Dump completed on 2024-12-21 15:10:05
