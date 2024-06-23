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

-- Dumping data for table skills.cinemas: ~7 rows (approximately)
INSERT INTO `cinemas` (`id_cinema`, `nome`, `id_local`) VALUES
	(1, 'asdSADds', 1),
	(4, 'fdg', 2),
	(5, 'fdg', 2),
	(7, 'fdg', 3),
	(9, 'fdg', 2),
	(69, 'aquela cinema', 2),
	(2147483647, 'f', 1);

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

-- Dumping data for table skills.filmes: ~3 rows (approximately)
INSERT INTO `filmes` (`codigo_filme`, `nome`, `ano`, `descricao`, `id_tipo`) VALUES
	(69, 'aqueleFilme', '2000-02-13', 'mesmo aserio', 2),
	(1111, 'ggggggggggg', '0000-00-00', 'fewef', 2),
	(2222, 'ffffffffff', '0000-00-00', 'fffffffffffffffffffff', 3);

-- Dumping structure for table skills.localizacoes
CREATE TABLE IF NOT EXISTS `localizacoes` (
  `id_local` int(11) NOT NULL,
  `descricao` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_local`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table skills.localizacoes: ~3 rows (approximately)
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
	(1, 'eee', 1),
	(2, 'fffffffffffffff', 2147483647),
	(3, 'eee', 1),
	(69, 'aquela sala', 69),
	(4444, 'estaSala', 1);

-- Dumping structure for table skills.sessoes
CREATE TABLE IF NOT EXISTS `sessoes` (
  `id_sessao` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_sala` int(11) DEFAULT NULL,
  `codigo_filme` int(11) DEFAULT NULL,
  `data_sessao` date DEFAULT NULL,
  `hora` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_sessao`),
  KEY `FK_sessoes_salas` (`codigo_sala`),
  KEY `FK_sessoes_filmes` (`codigo_filme`),
  CONSTRAINT `FK_sessoes_filmes` FOREIGN KEY (`codigo_filme`) REFERENCES `filmes` (`codigo_filme`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_sessoes_salas` FOREIGN KEY (`codigo_sala`) REFERENCES `salas` (`codigo_sala`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2147483648 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table skills.sessoes: ~6 rows (approximately)
INSERT INTO `sessoes` (`id_sessao`, `codigo_sala`, `codigo_filme`, `data_sessao`, `hora`, `estado`) VALUES
	(4, 2, 1111, '0000-00-00', 12341234, 0),
	(5, 2, 1111, '0000-00-00', 222, 0),
	(7, 2, 1111, '0000-00-00', 12341234, 1),
	(8, 2, 1111, '0000-00-00', 12341234, 1),
	(69, 69, 69, '2000-01-23', 123, 1),
	(1233, 3, 1111, '0000-00-00', 123123, 1),
	(12334, 3, 1111, '0000-00-00', 123123, 1);

-- Dumping structure for table skills.tipofilme
CREATE TABLE IF NOT EXISTS `tipofilme` (
  `id_tipo` int(11) NOT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table skills.tipofilme: ~3 rows (approximately)
INSERT INTO `tipofilme` (`id_tipo`, `descricao`) VALUES
	(1, 'Terror'),
	(2, 'Romance'),
	(3, 'Acção');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
