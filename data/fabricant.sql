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
-- Structure de la table `fabricant`
--

CREATE TABLE IF NOT EXISTS `fabricant` (
  `cod_lab` int(11) NOT NULL AUTO_INCREMENT,
  `nom_lab` varchar(45) NOT NULL COMMENT 'Nom commercial',
  `sit_web` varchar(250) DEFAULT NULL COMMENT 'Lien vers site web du fabricant',
  `tel_lab` varchar(15) DEFAULT NULL COMMENT 'Téléphone',
  `fax_lab` varchar(15) DEFAULT NULL COMMENT 'Fax',
  `bal_lab` varchar(45) DEFAULT NULL COMMENT 'E-mail',
  `nom_rep` varchar(45) DEFAULT NULL COMMENT 'Nom du repésentant',
  `tel_rep` varchar(15) DEFAULT NULL COMMENT 'Téléphone du repésentant',
  `fax_rep` varchar(15) DEFAULT NULL COMMENT 'Fax du repésentant',
  `bal_rep` varchar(45) DEFAULT NULL COMMENT 'E-mail du repésentant',
  `com_lab` varchar(250) DEFAULT NULL COMMENT 'Commentaire',
  PRIMARY KEY (`cod_lab`),
  UNIQUE KEY `nom_lab` (`nom_lab`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `fabricant`
--

INSERT INTO `fabricant` (`cod_lab`, `nom_lab`, `sit_web`, `tel_lab`, `fax_lab`, `bal_lab`, `nom_rep`, `tel_rep`, `fax_rep`, `bal_rep`, `com_lab`) VALUES
(1, 'Pierre Fabre', 'www.pfabre.fr', '0442099828', '', 'pierrefabre@free.fr', 'Alexandra', '33442099828', '', 'alex.habchi@orange.fr', '50% de réduction\n+2% UG\n450€ = franco'),
(2, 'Alexandra Habchi', '', '33442099828', '', 'alex.habchi@orange.fr', '', '', '', '', ''),
(4, 'hythy', '', '83585', '42575378', 'sqdgqrth', '', '', '', '', 'cdZVv');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
