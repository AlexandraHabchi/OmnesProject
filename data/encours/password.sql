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
-- Structure de la table `motdepasse`
--

CREATE TABLE IF NOT EXISTS `password` (
  `id_cli` int(11) NOT NULL COMMENT 'Code d''identification',
  `hashed` varchar(250) NOT NULL COMMENT 'Mot de passe',
  `clear` varchar(250) NOT NULL COMMENT 'Mot de passe',
  `change` tinyint(1) DEFAULT '1' COMMENT 'Changement obligatoire de mot de passe',
  `nbr_cnx` int(11) DEFAULT NULL COMMENT 'Nombre de connexions avec le meme mot de passe',
  `last_chg` date DEFAULT NULL COMMENT 'Date du dernier changement de mot de passe',
  `nbr_oub` int(11) DEFAULT NULL COMMENT 'Nombre de demandes pour oubli de mot de passe',
  UNIQUE KEY `id_cli_UNIQUE` (`id_cli`),
  KEY `id_cli` (`id_cli`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Liste des mots de passe et stats';

--
-- Contenu de la table `motdepasse`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
