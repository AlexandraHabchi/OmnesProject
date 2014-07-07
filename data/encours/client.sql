-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 07 Juillet 2014 à 07:41
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
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(45) NOT NULL COMMENT 'Pseudo de connexion',
  `email` varchar(45) NOT NULL COMMENT 'Adresse mail principale',
  `nom_ccm` varchar(45) NOT NULL COMMENT 'Nom commercial de l''entreprise',
  `nom_cli` varchar(40) DEFAULT NULL COMMENT 'Nom du(des) contact(s) ou responsable(s)',
  `com_cli` varchar(250) DEFAULT NULL COMMENT 'Commentaire',
  `siret` varchar(25) DEFAULT NULL COMMENT 'Numero de siret + code etablissement',
  `tva` varchar(25) DEFAULT NULL COMMENT 'code tva intra-communautaire',
  `tel` varchar(15) DEFAULT NULL COMMENT 'Numero de téléphone fixe',
  `gsm` varchar(15) DEFAULT NULL COMMENT 'Numero de telephone mobile',
  `fax` varchar(15) DEFAULT NULL COMMENT 'Numero de fax',
  `email_sec` varchar(45) DEFAULT NULL COMMENT 'Adresse mail secondaire',
  `dat_crea` date NOT NULL COMMENT 'Date de creation du client',
  `dat_supp` date DEFAULT NULL COMMENT 'Date de suppression',
  `valid` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Blocage du compte',
  `dat_last_connect` date DEFAULT NULL COMMENT 'Date de la derniere connexion',
  `session` varchar(10) DEFAULT NULL COMMENT 'Numero de session du client',
  PRIMARY KEY (`id`),
  UNIQUE KEY `pseudo` (`pseudo`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `client`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
