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
  `code` varchar(5) NOT NULL,
  `lib` varchar(45) NOT NULL COMMENT 'Libellé',
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `famille`
--

INSERT INTO `famille` (`code`, `lib`) VALUES
('11000', 'Soins du visage       '),
('11100', 'Soins du visage       '),
('11110', 'PS (Peaux sèches) et PTS (Peaux très sèches) '),
('11120', 'PNM (Peaux Normales et Mixtes)     '),
('11130', 'PG (Peaux Grasses)       '),
('11140', 'Peaux Sensibles et irritées      '),
('11150', 'Crèmes hydratantes        '),
('11160', 'Crèmes revitalisantes, anti-pollution...     '),
('11170', 'Crèmes nutritives et/ou de nuit     '),
('11180', 'Crèmes diverses non spécifiques      '),
('11200', 'Démaquillants et nettoyants visage      '),
('11210', 'Laits, crèmes et gels démaquillants     '),
('11220', 'Lotions démaquillantes et toniques      '),
('11230', 'Divers nettoyants visage       '),
('11300', 'Antivieillissements         '),
('11310', 'Action préventive antivieillissement       '),
('11320', 'Antirides (élastine, collagène, antiradicaux.'),
('11330', 'A.H.A ("acides de fruits") / Peeling    \r'),
('11340', 'Action fermeté        '),
('11350', 'Action Rétinol        '),
('11360', 'Antivieillissements d''origine marine ou autre'),
('11370', 'Soin anti-êge à la vitamine C    '),
('11400', 'Anti-acnéiques         '),
('11410', 'Nettoyants de la peau acnéique     '),
('11420', 'Soins anti-acnéiques        '),
('11430', 'Crèmes pour peaux acnéiques      '),
('11500', 'Eaux thermales, florales et brumisateurs     '),
('11600', 'Soins spécifiques du visage      '),
('11610', 'Gommages/Exfoliants         '),
('11620', 'Masques         '),
('11630', 'Dépilatoires, décolorants visage et annexes  '),
('11640', 'Type coup d''éclat        '),
('11650', 'Dépigmentation visage et/ou corps      '),
('11660', 'Couperose et rougeurs       '),
('11670', 'Cicatrisation du visage       '),
('11680', 'Anti-prurit, anti-irritation, antisquame du v'),
('11690', 'Autres soins spécifiques divers      '),
('11700', 'Yeux, Lèvres et Cou      '),
('11710', 'Soins des yeux       '),
('11711', 'Démaquillage des yeux       '),
('11712', 'Soins et traitements des yeux     '),
('11720', 'Soins des lèvres       '),
('11730', 'Soins du cou       '),
('11800', 'Divers visage        '),
('11810', 'Gelules dermopharmaceutiques (voir diététique'),
('11820', 'Accessoires divers visage       '),
('11830', 'Cosmétiques à usage thérapeutique      '),
('11840', 'Trousses et coffrets soins visage     '),
('12000', 'Maquillage         '),
('12100', 'Fonds de teint et crèmes teintées    '),
('12200', 'Fards à joues       '),
('12300', 'Poudres         '),
('12400', 'Rouges et crayons à lèvres     '),
('12410', 'Rouges et/ou brillants à lèvres     '),
('12420', 'Crayons contour des lèvres      '),
('12500', 'Produits pour ongles       '),
('12510', 'Vernis à ongles       '),
('12520', 'Produits annexes vernis       '),
('12530', 'Ongles adhésifs        '),
('12600', 'Maquillage des yeux       '),
('12610', 'Anti-cernes         ');
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
