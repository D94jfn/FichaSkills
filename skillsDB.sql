-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.7.0.6850
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for skills
CREATE DATABASE IF NOT EXISTS `skills` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `skills`;

-- Dumping structure for table skills.cinemas
CREATE TABLE IF NOT EXISTS `cinemas` (
  `id_cinema` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `id_local` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cinema`),
  KEY `FK_cinemas_local` (`id_local`),
  CONSTRAINT `FK_cinemas_local` FOREIGN KEY (`id_local`) REFERENCES `localizacoes` (`id_local`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2147483648 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table skills.cinemas: ~6 rows (approximately)
INSERT INTO `cinemas` (`id_cinema`, `nome`, `id_local`) VALUES
	(1, 'O1ºCinema', 2),
	(2, 'O2ºCinemaTeste', 2),
	(3, 'O3ºCinemaTeste', 1),
	(4, 'aqueleQueFicaAli', 3);

-- Dumping structure for table skills.filmes
CREATE TABLE IF NOT EXISTS `filmes` (
  `codigo_filme` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `ano` date DEFAULT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo_filme`),
  KEY `FK_filmes_tipofilme` (`id_tipo`),
  CONSTRAINT `FK_filmes_tipofilme` FOREIGN KEY (`id_tipo`) REFERENCES `tipofilme` (`id_tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2223 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table skills.filmes: ~5 rows (approximately)
INSERT INTO `filmes` (`codigo_filme`, `nome`, `ano`, `descricao`, `id_tipo`) VALUES
	(2, 'MATRIX-8', '2024-06-06', 'A furia do NEtO', 1),
	(3, 'os 2 porquinhos ', '2024-06-06', 'I SMELL BACON!', 2),
	(4, 'Os Lentos e os Calmos - 15 tudo pelus manus ', '2024-06-09', 'Trotinetes Extra Rapidas ,Sem rodinhas de treino ,', 2),
	(5, 'O Tomás e o Jeremias - Em busca do queijo Sagrado!', '2213-04-03', '+18 anos (NSFW)', 1),
	(6, 'Transformadores', '1994-05-03', 'DAWN OF THE FULL BRIDGE RECTIFIER', 3);

-- Dumping structure for table skills.localizacoes
CREATE TABLE IF NOT EXISTS `localizacoes` (
  `id_local` int(11) NOT NULL,
  `descricao` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_local`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table skills.localizacoes: ~2 rows (approximately)
INSERT INTO `localizacoes` (`id_local`, `descricao`) VALUES
	(1, 'Porto'),
	(2, 'Lisboa'),
	(3, 'Algarve');

-- Dumping structure for table skills.salas
CREATE TABLE IF NOT EXISTS `salas` (
  `codigo_sala` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) DEFAULT NULL,
  `id_cinema` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo_sala`),
  KEY `FK_salas_cinemas` (`id_cinema`),
  CONSTRAINT `FK_salas_cinemas` FOREIGN KEY (`id_cinema`) REFERENCES `cinemas` (`id_cinema`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4445 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table skills.salas: ~5 rows (approximately)
INSERT INTO `salas` (`codigo_sala`, `descricao`, `id_cinema`) VALUES
	(1, 'salaSuja', 1),
	(2, 'salaMenosSuja', 4),
	(3, 'salaBunita', 2),
	(4, 'salaFea', 3),
	(5, 'SalaMutoFea', 1);

-- Dumping structure for table skills.sessoes
CREATE TABLE IF NOT EXISTS `sessoes` (
  `id_sessao` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_sala` int(11) DEFAULT NULL,
  `codigo_filme` int(11) DEFAULT NULL,
  `data_sessao` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_sessao`),
  KEY `FK_sessoes_salas` (`codigo_sala`),
  KEY `FK_sessoes_filmes` (`codigo_filme`),
  CONSTRAINT `FK_sessoes_filmes` FOREIGN KEY (`codigo_filme`) REFERENCES `filmes` (`codigo_filme`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_sessoes_salas` FOREIGN KEY (`codigo_sala`) REFERENCES `salas` (`codigo_sala`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2147483648 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table skills.sessoes: ~3 rows (approximately)
INSERT INTO `sessoes` (`id_sessao`, `codigo_sala`, `codigo_filme`, `data_sessao`, `hora`, `estado`) VALUES
	(1, 5, 6, '2024-06-13', '13:15:00', 1),
	(2, 3, 3, '2024-06-22', '13:23:00', 1),
	(3, 1, 2, '2024-06-02', '13:23:00', 0),
	(4, 4, 6, '2024-06-22', '13:23:00', 0);

-- Dumping structure for table skills.tipofilme
CREATE TABLE IF NOT EXISTS `tipofilme` (
  `id_tipo` int(11) NOT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table skills.tipofilme: ~2 rows (approximately)
INSERT INTO `tipofilme` (`id_tipo`, `descricao`) VALUES
	(1, 'Terror'),
	(2, 'Romance'),
	(3, 'Acção');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
