-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 07 Juillet 2014 à 07:44
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
-- Structure de la table `parametre`
--

CREATE TABLE IF NOT EXISTS `parametre` (
  `name` varchar(25) NOT NULL COMMENT 'Nom du parametre',
  `value` varchar(45) NOT NULL COMMENT 'Valeur du parametre',
  `comment` varchar(100) DEFAULT NULL COMMENT 'Commentaire',
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Liste des parametre applicatif par defaut...';

--
-- Contenu de la table `parametre`
--

INSERT INTO `parametre` (`name`, `value`, `comment`) VALUES
('depcod', '5', 'Point d''inflexion'),
('logdir', './../logs', 'Dossier de trace applicatif'),
('stdout', '1', 'Mode de sortie 0=Ecran, 1=Fichier, ....'),
('tabcod', '15', 'Tableau de codage'),
('trace', '1', 'Trace applicatif');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
