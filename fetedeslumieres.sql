-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 10 Mars 2016 à 16:37
-- Version du serveur :  5.7.9
-- Version de PHP :  5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `fetedeslumieres`
--

-- --------------------------------------------------------

--
-- Structure de la table `artiste`
--

DROP TABLE IF EXISTS `artiste`;
CREATE TABLE IF NOT EXISTS `artiste` (
  `idArtiste` int(11) NOT NULL AUTO_INCREMENT,
  `nomArtiste` varchar(30) NOT NULL,
  `mailArtiste` varchar(30) NOT NULL,
  PRIMARY KEY (`idArtiste`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `artiste`
--

INSERT INTO `artiste` (`idArtiste`, `nomArtiste`, `mailArtiste`) VALUES
(17, 'ijzaroijoizarj', 'oijrzaoijrzaoijoirazjoi@re.Fr'),
(16, 'Pablo', 'test@test.fr'),
(15, 'test', 'test@test.fr'),
(14, 'test', 'test@test.fr'),
(13, 'test', 'test@test.fr'),
(12, 'test', 'test@test.fr'),
(11, 'rjoirzajiorjza', 'joij@tjiejtea.fr'),
(18, 'jriozajirozaj', 'jriozajrzaoijza@araizj.fr'),
(19, 'etztzegqrehtjy', 'yktk@ivjif.fr'),
(20, 'azroaiz', 'jriozajrz@zrfE.fr');

-- --------------------------------------------------------

--
-- Structure de la table `lieu`
--

DROP TABLE IF EXISTS `lieu`;
CREATE TABLE IF NOT EXISTS `lieu` (
  `idLieu` int(11) NOT NULL AUTO_INCREMENT,
  `lieu` varchar(50) NOT NULL,
  PRIMARY KEY (`idLieu`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `lieu`
--

INSERT INTO `lieu` (`idLieu`, `lieu`) VALUES
(1, 'Parc de la tete d''or'),
(2, 'Berges du Rhône'),
(3, 'Place Chazette'),
(4, 'Place Maréchal Lyautey'),
(9, 'Place Louis Pradel'),
(10, 'Place des Terreaux');

-- --------------------------------------------------------

--
-- Structure de la table `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `login` varchar(10) NOT NULL,
  `mdp` varchar(4) NOT NULL,
  `jury` int(11) DEFAULT NULL,
  PRIMARY KEY (`login`),
  KEY `login` (`login`,`mdp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `logs`
--

INSERT INTO `logs` (`login`, `mdp`, `jury`) VALUES
('pablo', '1005', 0),
('paul', '1201', 1),
('pierre', '0000', 1),
('thomas', '0801', 1);

-- --------------------------------------------------------

--
-- Structure de la table `oeuvre_admin`
--

DROP TABLE IF EXISTS `oeuvre_admin`;
CREATE TABLE IF NOT EXISTS `oeuvre_admin` (
  `idOeuvre` int(3) NOT NULL AUTO_INCREMENT,
  `idArtiste` int(11) NOT NULL,
  `nomOeuvre` varchar(30) NOT NULL,
  `nomArtiste` varchar(30) NOT NULL,
  `lieu` varchar(30) NOT NULL,
  `nomPhoto` varchar(30) NOT NULL,
  `budget` int(10) NOT NULL,
  `société` varchar(40) DEFAULT NULL,
  `superficie` int(5) NOT NULL,
  `poids` int(5) DEFAULT NULL,
  PRIMARY KEY (`idOeuvre`),
  KEY `idArtiste` (`idArtiste`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `oeuvre_admin`
--

INSERT INTO `oeuvre_admin` (`idOeuvre`, `idArtiste`, `nomOeuvre`, `nomArtiste`, `lieu`, `nomPhoto`, `budget`, `société`, `superficie`, `poids`) VALUES
(1, 14, 'test', 'test', 'Parc de la tete d''or', 'IMG_1113.JPG', 25000, 'arzaz', 8, 6),
(9, 11, 'zaroizarjio', 'rjoirzajiorjza', 'Parc de la tete d''or', 'IMG_0476.JPG', 0, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `oeuvre_attente`
--

DROP TABLE IF EXISTS `oeuvre_attente`;
CREATE TABLE IF NOT EXISTS `oeuvre_attente` (
  `idOeuvre` int(3) NOT NULL AUTO_INCREMENT,
  `idArtiste` int(11) NOT NULL,
  `nomOeuvre` varchar(30) NOT NULL,
  `nomArtiste` varchar(30) NOT NULL,
  `lieu` varchar(30) NOT NULL,
  `nomPhoto` varchar(30) NOT NULL,
  `budget` int(10) NOT NULL,
  `société` varchar(40) DEFAULT NULL,
  `superficie` int(5) NOT NULL,
  `poids` int(5) DEFAULT NULL,
  PRIMARY KEY (`idOeuvre`),
  KEY `nomArtiste` (`nomArtiste`),
  KEY `idArtiste` (`idArtiste`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `oeuvre_attente`
--

INSERT INTO `oeuvre_attente` (`idOeuvre`, `idArtiste`, `nomOeuvre`, `nomArtiste`, `lieu`, `nomPhoto`, `budget`, `société`, `superficie`, `poids`) VALUES
(2, 15, 'test', 'test', 'Parc de la tete d''or', 'IMG_1113.JPG', 515, NULL, 4545, NULL),
(3, 18, 'zojrzaop', 'jriozajirozaj', 'Parc de la tete d''or', 'IMG_1112.JPG', 25, 'zarza', 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `oeuvre_validee`
--

DROP TABLE IF EXISTS `oeuvre_validee`;
CREATE TABLE IF NOT EXISTS `oeuvre_validee` (
  `idOeuvre` int(11) NOT NULL AUTO_INCREMENT,
  `idArtiste` int(11) NOT NULL,
  `nomOeuvre` varchar(30) NOT NULL,
  `nomArtiste` varchar(30) NOT NULL,
  `lieu` varchar(30) NOT NULL,
  `nomPhoto` varchar(30) NOT NULL,
  `budget` int(10) NOT NULL,
  `société` varchar(50) DEFAULT NULL,
  `superficie` int(11) NOT NULL,
  `poids` int(11) DEFAULT NULL,
  PRIMARY KEY (`idOeuvre`),
  KEY `idArtiste` (`idArtiste`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `oeuvre_validee`
--

INSERT INTO `oeuvre_validee` (`idOeuvre`, `idArtiste`, `nomOeuvre`, `nomArtiste`, `lieu`, `nomPhoto`, `budget`, `société`, `superficie`, `poids`) VALUES
(1, 14, 'test', 'test', 'Parc de la tete d''or', 'IMG_1113.JPG', 25000, 'arzaz', 8, 6),
(9, 11, 'zaroizarjio', 'rjoirzajiorjza', 'Parc de la tete d''or', 'IMG_0476.JPG', 0, NULL, 0, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
