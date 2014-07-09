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
-- Structure de la table `tauxtva`
--

CREATE TABLE IF NOT EXISTS `tauxtva` (
  `cod_tva` int(2) NOT NULL,
  `lib_tva` varchar(45) NOT NULL COMMENT 'Libellé',
  `tau_tva` float(5,2) NOT NULL COMMENT 'Taux de tva à diviser par 100',
  `dat_cre` date NOT NULL COMMENT 'Date de création',
  PRIMARY KEY (`cod_tva`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tauxtva`
--

INSERT INTO `tauxtva` (`cod_tva`, `lib_tva`, `tau_tva`, `dat_cre`) VALUES
(1, 'Taux 1', 10.00, '2014-04-09'),
(2, 'Taux 2', 5.20, '2014-04-09'),
(3, 'Taux 3', 20.00, '2014-04-09');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
