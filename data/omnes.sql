-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 13 Avril 2014 à 16:24
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `omnes`
--
CREATE DATABASE IF NOT EXISTS `omnes` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `omnes`;

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

CREATE TABLE IF NOT EXISTS `adresse` (
  `cod_adr` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Code adresse, clé primaire',
  `cli_cod` int(11) NOT NULL COMMENT 'Code client, index',
  `nom_rue` varchar(45) NOT NULL COMMENT 'Nom de la rue',
  `cpl_rue` varchar(45) DEFAULT NULL COMMENT 'Complement d''adresse',
  `cod_pos` varchar(5) NOT NULL COMMENT 'Code postal',
  `ville` varchar(45) NOT NULL COMMENT 'Ville',
  PRIMARY KEY (`cod_adr`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Liste des adresses des clients, fournisseurs, labos, ...' AUTO_INCREMENT=11 ;

--
-- Contenu de la table `adresse`
--

INSERT INTO `adresse` (`cod_adr`, `cli_cod`, `nom_rue`, `cpl_rue`, `cod_pos`, `ville`) VALUES
(4, 1, '2 allée des coquelicots', '', '13620', 'Carry-le-Rouet'),
(5, 1, '4 avenue Jean Jaurès', 'Bâtiment B escalier 3', '13700', 'Marignane'),
(10, 1, '32 avenue de la gare', '', '92330', 'Sceaux');

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
  `valid` varchar(1) NOT NULL DEFAULT 'O' COMMENT 'En activité (par default = O, suppression logique = N)',
  `dat_last_connect` date DEFAULT NULL COMMENT 'Date de la derniere connexion',
  `session` varchar(10) DEFAULT NULL COMMENT 'Numero de session du client',
  PRIMARY KEY (`id`),
  UNIQUE KEY `pseudo` (`pseudo`),
  UNIQUE KEY `bal_cli` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `client`
--


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

-- --------------------------------------------------------

--
-- Structure de la table `identifiant`
--

CREATE TABLE IF NOT EXISTS `identifiant` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Code d''identification',
  `id_cli` int(11) NOT NULL COMMENT 'Code client',
  `pseudo` varchar(45) NOT NULL COMMENT 'Pseudo utilisateur',
  `email` varchar(45) NOT NULL COMMENT 'Adresse mail client',
  `valid` BOOLEAN( 1 ) NOT NULL DEFAULT '1' COMMENT 'Blocage du compte',
  `session` varchar(10) DEFAULT NULL COMMENT 'Numero de la derniere session',
  PRIMARY KEY (`cod_ide`),
  UNIQUE KEY `pseudo` (`pseudo`),
  UNIQUE KEY `bal_cli` (`bal_cli`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Liste des Identifiants' AUTO_INCREMENT=3 ;

--
-- Contenu de la table `identifiant`
--

INSERT INTO `identifiant` (`cod_ide`, `pseudo`, `bal_cli`, `val_ide`, `num_ses`) VALUES
(1, 'Alexouille', 'alex.habchi@orange.fr', 'O', ''),
(2, 'issam13', 'i.ihc@orange.fr', 'O', '');

-- --------------------------------------------------------

--
-- Structure de la table `imagerie`
--

CREATE TABLE IF NOT EXISTS `imagerie` (
  `cod_prd` int(11) NOT NULL COMMENT 'Code produit',
  `lnk_prd` varchar(125) DEFAULT NULL COMMENT 'Lien externe',
  UNIQUE KEY `image_produit` (`cod_prd`,`lnk_prd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `cod_msg` varchar(12) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `lib_msg` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`cod_msg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `message`
--

INSERT INTO `message` (`cod_msg`, `lib_msg`) VALUES
('ERR-001', 'Identifiant inconnu'),
('ERR-002', 'Mot de passe Incorrect'),
('ERR-003', 'Compte bloqué, contactez votre administrateur'),
('ERR-004', 'Erreur d''envoi du message'),
('MSG-001', 'Mot de passe envoyé à votre adresse mail');

-- --------------------------------------------------------

--
-- Structure de la table `motdepasse`
--

CREATE TABLE IF NOT EXISTS `motdepasse` (
  `ide_cod` int(11) NOT NULL COMMENT 'Code d''identification',
  `cod_pas` varchar(250) NOT NULL COMMENT 'Mot de passe',
  `pas_chg` char(1) DEFAULT NULL COMMENT 'Changement obligatoire de mot de passe',
  `nbr_cnx` int(11) DEFAULT NULL COMMENT 'Nombre de connexions avec le meme mot de passe',
  `dat_chg` date DEFAULT NULL COMMENT 'Date du dernier changement de mot de passe',
  `nbr_oub` int(11) DEFAULT NULL COMMENT 'Nombre de demandes pour oubli de mot de passe',
  UNIQUE KEY `ide_cod_UNIQUE` (`ide_cod`),
  KEY `ide_cod` (`ide_cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Liste des mots de passe et stats';

--
-- Contenu de la table `motdepasse`
--

INSERT INTO `motdepasse` (`ide_cod`, `cod_pas`, `pas_chg`, `nbr_cnx`, `dat_chg`, `nbr_oub`) VALUES
(1, 'alex21', 'N', 0, '2014-04-02', 0),
(2, 'issam', 'N', 0, '2014-03-31', 0);

-- --------------------------------------------------------

--
-- Structure de la table `parametre`
--

CREATE TABLE IF NOT EXISTS `parametre` (
  `nom_par` varchar(25) NOT NULL COMMENT 'Nom du parametre',
  `val_par` varchar(45) NOT NULL COMMENT 'Valeur du parametre',
  `lib_par` varchar(100) DEFAULT NULL COMMENT 'Commentaire',
  PRIMARY KEY (`nom_par`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Liste des parametre applicatif par defaut...';

--
-- Contenu de la table `parametre`
--

INSERT INTO `parametre` (`nom_par`, `val_par`, `lib_par`) VALUES
('depcod', '5', 'Point d''inflexion'),
('logdir', './../logs', 'Dossier de trace applicatif'),
('stdout', '1', 'Mode de sortie 0=Ecran, 1=Fichier, ....'),
('tabcod', '15', 'Tableau de codage'),
('trace', '1', 'Trace applicatif');

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
