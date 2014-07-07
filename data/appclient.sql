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
-- Structure de la table `appclient`
--

CREATE TABLE IF NOT EXISTS `appclient` (
  `app_cod` int(11) NOT NULL COMMENT 'code application',
  `cli_cod` int(11) NOT NULL COMMENT 'code client',
  `gra_sel` char(1) NOT NULL DEFAULT 'O' COMMENT 'Droits pour la consultation',
  `gra_ins` char(1) NOT NULL COMMENT 'Droits de création',
  `gra_del` char(1) NOT NULL COMMENT 'Droit de suppression',
  `gra_upd` char(1) NOT NULL COMMENT 'Droits de modification',
  `dat_val` date NOT NULL COMMENT 'Date de validité de l''application',
  PRIMARY KEY (`app_cod`,`cli_cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Liste des applications attribuées à un client, droits d''accès et dates valid ';

--
-- Contenu de la table `appclient`
--

INSERT INTO `appclient` (`app_cod`, `cli_cod`, `gra_sel`, `gra_ins`, `gra_del`, `gra_upd`, `dat_val`) VALUES
(1, 1, 'O', 'N', 'N', 'N', '2014-12-12'),
(1, 2, 'O', 'N', 'N', 'N', '2014-12-12'),
(2, 1, 'O', 'N', 'N', 'N', '2014-12-12'),
(2, 2, 'O', 'N', 'N', 'N', '2014-12-12'),
(3, 1, 'O', 'N', 'N', 'N', '2014-12-12'),
(4, 1, 'O', 'O', 'O', 'O', '2014-12-12'),
(5, 2, 'O', 'O', 'O', 'O', '2014-12-12'),
(6, 1, 'O', 'O', 'O', 'N', '2014-12-12'),
(7, 1, 'O', 'O', 'O', 'N', '2014-12-12'),
(7, 2, 'O', 'O', 'O', 'N', '2014-12-12'),
(8, 1, 'O', 'N', 'N', 'N', '2014-12-12'),
(8, 2, 'O', 'N', 'N', 'N', '2014-12-12'),
(9, 1, 'O', 'O', 'O', 'N', '2015-12-21'),
(10, 1, 'O', 'O', 'O', 'N', '2015-12-21'),
(11, 1, 'O', 'O', 'O', 'N', '2015-12-21'),
(12, 1, 'O', 'O', 'O', 'N', '2015-12-21');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
