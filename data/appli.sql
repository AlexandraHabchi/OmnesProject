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
-- Structure de la table `appli`
--

CREATE TABLE IF NOT EXISTS `appli` (
  `cod_app` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Code application, clé primaire',
  `niv_app` int(11) NOT NULL COMMENT 'Niveau de l''application',
  `nom_btn` varchar(20) DEFAULT NULL COMMENT 'Contenu du bouton pour l''affichage',
  `ord_aff_app` int(11) NOT NULL COMMENT 'Ordre d''affichage dans le menu',
  `url_cnx` varchar(70) DEFAULT NULL COMMENT 'Url de connexion',
  `txt_htm` text COMMENT 'Texte au format html à insérer si besoin',
  PRIMARY KEY (`cod_app`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Liste des applications' AUTO_INCREMENT=13 ;

--
-- Contenu de la table `appli`
--

INSERT INTO `appli` (`cod_app`, `niv_app`, `nom_btn`, `ord_aff_app`, `url_cnx`, `txt_htm`) VALUES
(1, 11, 'Promo du mois', 1, '', 'Super promo sur les dafalgan !\n2+1 gratuit\n\nà saisir jusqu''au 21-04-2014 '),
(2, 11, 'Nouveauté', 2, '', 'Nouveau produit :\nVICKS VapoRub 50 mL'),
(3, 1, 'OMNES', 1, './html/omnes_accueil.html', ''),
(4, 12, 'Mes commandes', 1, './html/omnes_cmd.html', ''),
(5, 13, 'A commander', 2, './html/omnes_acmd.html', ''),
(6, 14, 'Mon profil', 3, './html/omnes_profil.html', ''),
(7, 15, 'Mon panier', 3, './html/omnes_panier.html', ''),
(8, 11, 'Dernière minute !', 3, '', 'Réunion d''information le 2 août 2014 à Marseille.\nVenez nombreux !'),
(9, 2, 'Planning', 2, 'planning.html', ''),
(10, 21, 'Modelisation', 1, 'mod_planning.html', ''),
(11, 22, 'Consultation', 2, 'cons_planning.html', ''),
(12, 3, 'Divers', 3, 'divers.html', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
