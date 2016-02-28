-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 20 Janvier 2016 à 17:25
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `fetedeslumieres`
--

-- --------------------------------------------------------

--
-- Structure de la table `lieu`
--

CREATE TABLE IF NOT EXISTS `lieu` (
  `idLieu` int(11) NOT NULL AUTO_INCREMENT,
  `lieu` varchar(50) NOT NULL,
  PRIMARY KEY (`idLieu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

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
-- Structure de la table `oeuvre_attente`
--

CREATE TABLE IF NOT EXISTS `oeuvre_attente` (
  `idOeuvre` int(3) NOT NULL AUTO_INCREMENT,
  `nomOeuvre` varchar(30) NOT NULL,
  `nomArtiste` varchar(30) NOT NULL,
  `lieu` varchar(30) NOT NULL,
  `partenaire` varchar(30) NOT NULL,
  `nomPhoto` varchar(30) NOT NULL,
  PRIMARY KEY (`idOeuvre`),
  KEY `nomArtiste` (`nomArtiste`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `oeuvre_validee`
--

CREATE TABLE IF NOT EXISTS `oeuvre_validee` (
  `idOeuvre` int(11) NOT NULL AUTO_INCREMENT,
  `nomOeuvre` varchar(30) NOT NULL,
  `nomArtiste` varchar(30) NOT NULL,
  `lieu` varchar(30) NOT NULL,
  `partenaire` varchar(30) NOT NULL,
  `nomPhoto` varchar(30) NOT NULL,
  PRIMARY KEY (`idOeuvre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `oeuvre_validee`
--

INSERT INTO `oeuvre_validee` (`idOeuvre`, `nomOeuvre`, `nomArtiste`, `lieu`, `partenaire`, `nomPhoto`) VALUES
(6, 'Ballons', 'Gabolde', 'Parc de la tete d''or', 'Thomas', 'lyon.jpg'),
(7, 'Thomas', 'Thomas', 'Place Louis Pradel', 'thomas', 'lyon.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
