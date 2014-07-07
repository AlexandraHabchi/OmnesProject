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
-- Structure de la table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `cod_prd` int(11) NOT NULL AUTO_INCREMENT,
  `lib_prd` varchar(45) NOT NULL COMMENT 'Libellé du produit',
  `tva_cod` int(2) NOT NULL COMMENT 'Code TVA',
  `fam_cod` varchar(5) NOT NULL COMMENT 'Code famille',
  `lab_cod` int(11) NOT NULL COMMENT 'Code Fabricant',
  `prx_cat` float(10,2) NOT NULL COMMENT 'Prix Catalogue Pharmacien',
  `prx_net` float(10,2) NOT NULL COMMENT 'Prix Net Pharmacien',
  `nbp_col` int(5) NOT NULL COMMENT 'Nombre de produit par colis',
  `dat_der_cmd` date DEFAULT NULL COMMENT 'Date de la dernière Commande',
  `dat_pro_cmd` date DEFAULT NULL COMMENT 'Date de la prochaine Commande',
  `cdt_ccm` varchar(200) DEFAULT NULL COMMENT 'Condition Commerciale, commentaire uniquement',
  PRIMARY KEY (`cod_prd`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`cod_prd`, `lib_prd`, `tva_cod`, `fam_cod`, `lab_cod`, `prx_cat`, `prx_net`, `nbp_col`, `dat_der_cmd`, `dat_pro_cmd`, `cdt_ccm`) VALUES
(6, 'Daflon', 1, '1', 2, 5.26, 3.60, 12, '0000-00-00', '0000-00-00', 'Bla bla\nbla\nbla'),
(7, 'Bion 3 junior cp', 3, '5', 1, 10.52, 8.30, 6, '0000-00-00', '0000-00-00', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
