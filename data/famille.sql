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
-- Structure de la table `famille`
--

CREATE TABLE IF NOT EXISTS `famille` (
  `cod_fam` varchar(5) NOT NULL,
  `lib_fam` varchar(45) NOT NULL COMMENT 'Libellé',
  PRIMARY KEY (`cod_fam`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `famille`
--

INSERT INTO `famille` (`cod_fam`, `lib_fam`) VALUES
('1', 'Famille 3'),
('5', 'Famille 2');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
