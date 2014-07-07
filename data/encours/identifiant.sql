-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 07 Juillet 2014 à 07:43
-- Version du serveur: 5.5.37
-- Version de PHP: 5.4.4-14+deb7u10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `omnes`
--

-- --------------------------------------------------------

--
-- Structure de la table `identifiant`
--

CREATE TABLE IF NOT EXISTS `identifiant` (
 `id_cli` int(11) NOT NULL COMMENT 'Code client',
  `pseudo` varchar(45) NOT NULL COMMENT 'Pseudo utilisateur',
  `email` varchar(45) NOT NULL COMMENT 'Adresse mail client',
  `valid` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Blocage du compte',
  `profil` varchar(45) NOT NULL COMMENT 'Profil du compte',
  `session` varchar(10) DEFAULT NULL COMMENT 'Numero de la derniere session',
  PRIMARY KEY (`id_cli`),
  UNIQUE KEY `pseudo` (`pseudo`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Liste des Identifiants' AUTO_INCREMENT=3 ;

--
-- Contenu de la table `identifiant`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
