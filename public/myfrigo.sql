-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- HÃ´te : 127.0.0.1:3306
-- GÃ©nÃ©rÃ© le :  lun. 30 dÃ©c. 2019 Ã  20:24
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de donnÃ©es :  `myfrigo`
--

-- --------------------------------------------------------

--
-- Structure de la table `frigo`
--

DROP TABLE IF EXISTS `frigo`;
CREATE TABLE IF NOT EXISTS `frigo` (
  `id_user` int(11) NOT NULL,
  `id_ingrd` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `id_unite` int(11) NOT NULL,
  PRIMARY KEY (`id_user`,`id_ingrd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- DÃ©chargement des donnÃ©es de la table `frigo`
--

INSERT INTO `frigo` (`id_user`, `id_ingrd`, `quantite`, `id_unite`) VALUES
(1, 2, 1, 2),
(1, 3, 10, 2),
(1, 4, 3, 1),
(1, 6, 13, 2),
(1, 7, 4, 2);

-- --------------------------------------------------------

--
-- Structure de la table `ingredients`
--

DROP TABLE IF EXISTS `ingredients`;
CREATE TABLE IF NOT EXISTS `ingredients` (
  `id_ingrd` int(11) NOT NULL AUTO_INCREMENT,
  `label_ingrd` varchar(100) NOT NULL,
  `image_ingred` varchar(1000) NOT NULL,
  PRIMARY KEY (`id_ingrd`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

--
-- DÃ©chargement des donnÃ©es de la table `ingredients`
--

INSERT INTO `ingredients` (`id_ingrd`, `label_ingrd`, `image_ingred`) VALUES
(1, 'tomate', '\\image_ingred\\tomate.jpg'),
(2, 'carotte', '\\image_ingred\\carotte.jpg'),
(3, 'artichaut', '\\image_ingred\\artichaut.jpg'),
(4, 'betterave', '\\image_ingred\\betterave.jpg'),
(5, 'brocoli', '\\image_ingred\\brocoli.jpg'),
(6, 'courgette', '\\image_ingred\\coquille.jpg'),
(7, 'petit pois', '\\image_ingred\\petits_pois.jpg'),
(8, 'laitue', '\\image_ingred\\laitue.jpg'),
(9, 'poivron', '\\image_ingred\\poivron.jpg'),
(10, 'pommes de terre', '\\image_ingred\\pommes_de_terre.jpg'),
(11, 'poireau', '\\image_ingred\\poireau.jpg'),
(12, 'radis', '\\image_ingred\\radis.jpg'),
(14, 'abricot', '\\image_ingred\\abricot.jpg'),
(15, 'avocat', '\\image_ingred\\avocat.jpg'),
(16, 'pomme', '\\image_ingred\\pomme.jpg'),
(17, 'banane', '\\image_ingred\\banane.jpg'),
(18, 'cassis', '\\image_ingred\\cassis.jpg'),
(19, 'peche', '\\image_ingred\\peche.jpg'),
(20, 'fraise', '\\image_ingred\\fraise.jpg'),
(21, 'orange', '\\image_ingred\\orange.jpg'),
(22, 'citron', '\\image_ingred\\citron.jpg'),
(23, 'framboise', '\\image_ingred\\framboise.jpg'),
(24, 'mirabelle', '\\image_ingred\\mirabelle.jpg'),
(25, 'ananas', '\\image_ingred\\ananas.jpg'),
(26, 'poire', '\\image_ingred\\poire.jpg'),
(27, 'mangue', '\\image_ingred\\mangue.jpg'),
(28, 'figue', '\\image_ingred\\figue.jpg'),
(29, 'coco', '\\image_ingred\\coco.jpg'),
(30, 'amande', '\\image_ingred\\amande.jpg'),
(31, 'chocolat', '\\image_ingred\\chocolat.jpg'),
(32, 'foie', '\\image_ingred\\foie.jpg'),
(33, 'boeuf', '\\image_ingred\\boeuf.jpg'),
(34, 'agneau', '\\image_ingred\\agneau.jpg'),
(35, 'caille', '\\image_ingred\\caille.jpg'),
(36, 'huÃ®tre', '\\image_ingred\\huitre.jpg'),
(37, 'caviar', '\\image_ingred\\caviar.jpg'),
(38, 'saumon', '\\image_ingred\\saumon.jpg'),
(39, 'homard', '\\image_ingred\\homard.jpg'),
(40, 'cabillaud', '\\image_ingred\\cabillaud.jpg'),
(41, 'fromage', '\\image_ingred\\fromage.jpg'),
(43, 'poulet', '\\image_ingred\\poulet.jpeg'),
(44, 'beurre', '\\image_ingred\\beurre.jpg'),
(45, 'cafe', '\\image_ingred\\cafe.jpg'),
(47, 'lait', '\\image_ingred\\lait.jpg'),
(48, 'miel', '\\image_ingred\\miel.jpg'),
(49, 'pates', '\\image_ingred\\pates.jpg'),
(50, 'oeuf', '\\image_ingred\\oeuf.jpg'),
(51, 'sucre', '\\image_ingred\\sucre.jpg'),
(52, 'sel', '\\image_ingred\\sel.jpg'),
(53, 'aneth', '\\image_ingred\\aneth.jpg'),
(54, 'noix', ''),
(55, 'dette', ''),
(56, 'cumin', ''),
(57, 'persil', ''),
(58, 'feve', ''),
(59, 'oignon', ''),
(60, 'poivre', ''),
(61, 'gingembre', ''),
(62, 'ail', '');

-- --------------------------------------------------------

--
-- Structure de la table `recette_info`
--

DROP TABLE IF EXISTS `recette_info`;
CREATE TABLE IF NOT EXISTS `recette_info` (
  `id_recette` int(11) NOT NULL AUTO_INCREMENT,
  `titre_recette` varchar(100) NOT NULL,
  `temps_recette` int(11) NOT NULL,
  `difficulte_recette` int(11) NOT NULL,
  `reviews_recette` int(11) NOT NULL,
  `image_recette` varchar(100) NOT NULL,
  PRIMARY KEY (`id_recette`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- DÃ©chargement des donnÃ©es de la table `recette_info`
--

INSERT INTO `recette_info` (`id_recette`, `titre_recette`, `temps_recette`, `difficulte_recette`, `reviews_recette`, `image_recette`) VALUES
(1, 'Tacos mexicains', 50, 2, 4, '\\image_ingred\\tacos.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `recette_ingrd`
--

DROP TABLE IF EXISTS `recette_ingrd`;
CREATE TABLE IF NOT EXISTS `recette_ingrd` (
  `id_recette` int(11) NOT NULL,
  `id_ingrd` int(11) NOT NULL,
  `quantite` float DEFAULT NULL,
  `id_unite` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_recette`,`id_ingrd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- DÃ©chargement des donnÃ©es de la table `recette_ingrd`
--

INSERT INTO `recette_ingrd` (`id_recette`, `id_ingrd`, `quantite`, `id_unite`) VALUES
(1, 1, 2, 2),
(1, 8, 0.1, 1),
(1, 9, 1, 2),
(1, 33, 0.25, 1),
(1, 52, NULL, NULL),
(1, 56, NULL, NULL),
(1, 59, 1, 2),
(1, 60, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `recette_step`
--

DROP TABLE IF EXISTS `recette_step`;
CREATE TABLE IF NOT EXISTS `recette_step` (
  `id_recette` int(11) NOT NULL,
  `step_no` int(11) NOT NULL,
  `desc` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- DÃ©chargement des donnÃ©es de la table `recette_step`
--

INSERT INTO `recette_step` (`id_recette`, `step_no`, `desc`) VALUES
(1, 1, 'A la poÃªle, faire dorer l\'oignon Ã©mincÃ© dans un peu d\'huile d\'olive.'),
(1, 2, 'Rajouter la viande, assaisonner et laisser cuire 5 min.'),
(1, 3, 'Laver les feuilles de laitue.'),
(1, 4, 'Couper les tomates et le poivron en petits dÃ©s.'),
(1, 5, 'Incorporer le tout Ã  la poÃªlÃ©e avec le coulis de tomate, et poursuivre la cuisson pendant 5 min.\r\n'),
(1, 6, 'Egoutter les haricots rouges et les ajouter 2 min avant la fin de cuisson.'),
(1, 7, 'Hors du feu, ajuster l\'assaisonnement et saupoudrer gÃ©nÃ©reusement de cumin; on peut aussi rajouter quelques gouttes de Tabasco.'),
(1, 8, 'Garnir les tortillas de prÃ©paration et les refermer en les roulant comme des crÃªpes. Disposer 1 feuille de laitue sur chaque tacos avant de servir');

-- --------------------------------------------------------

--
-- Structure de la table `regime`
--

DROP TABLE IF EXISTS `regime`;
CREATE TABLE IF NOT EXISTS `regime` (
  `id_regime` int(11) NOT NULL AUTO_INCREMENT,
  `label_regime` varchar(25) NOT NULL,
  PRIMARY KEY (`id_regime`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- DÃ©chargement des donnÃ©es de la table `regime`
--

INSERT INTO `regime` (`id_regime`, `label_regime`) VALUES
(1, 'vegetarien'),
(2, 'protÃ©inÃ©'),
(3, 'sans sel');

-- --------------------------------------------------------

--
-- Structure de la table `regime_recette`
--

DROP TABLE IF EXISTS `regime_recette`;
CREATE TABLE IF NOT EXISTS `regime_recette` (
  `id_regime` int(11) NOT NULL,
  `id_recette` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- DÃ©chargement des donnÃ©es de la table `regime_recette`
--

INSERT INTO `regime_recette` (`id_regime`, `id_recette`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `unite`
--

DROP TABLE IF EXISTS `unite`;
CREATE TABLE IF NOT EXISTS `unite` (
  `id_unite` int(11) NOT NULL,
  `label` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- DÃ©chargement des donnÃ©es de la table `unite`
--

INSERT INTO `unite` (`id_unite`, `label`) VALUES
(1, 'kilogramme'),
(2, 'piece');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) NOT NULL,
  `id_regime` int(11) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- DÃ©chargement des donnÃ©es de la table `user`
--

INSERT INTO `user` (`id_user`, `nom`, `id_regime`) VALUES
(1, 'zineb', 1),
(2, 'youssef', 2),
(3, 'mouna', 1),
(4, 'meryem', 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
