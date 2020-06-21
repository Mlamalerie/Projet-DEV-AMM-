-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 21 juin 2020 à 23:24
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projetweb`
--

-- --------------------------------------------------------

--
-- Structure de la table `beat`
--

DROP TABLE IF EXISTS `beat`;
CREATE TABLE IF NOT EXISTS `beat` (
  `beat_id` int(15) UNSIGNED NOT NULL AUTO_INCREMENT,
  `beat_title` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `beat_author` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `beat_author_id` int(10) UNSIGNED NOT NULL,
  `beat_genre` int(2) UNSIGNED DEFAULT 0,
  `beat_description` text COLLATE utf8mb4_unicode_ci DEFAULT '  ',
  `beat_tags` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `beat_year` int(4) NOT NULL,
  `beat_price` double(7,2) UNSIGNED DEFAULT 0.00,
  `beat_format` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `beat_source` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `beat_cover` text COLLATE utf8mb4_unicode_ci DEFAULT 'assets/img/cover_default.jpg',
  `beat_nbvente` int(15) UNSIGNED NOT NULL DEFAULT 0,
  `beat_like` int(6) DEFAULT 0,
  `beat_dateupload` datetime NOT NULL,
  PRIMARY KEY (`beat_id`),
  KEY `beat_author_id` (`beat_author_id`),
  KEY `beat_author` (`beat_author`),
  KEY `beat_genre` (`beat_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `beat`
--

INSERT INTO `beat` (`beat_id`, `beat_title`, `beat_author`, `beat_author_id`, `beat_genre`, `beat_description`, `beat_tags`, `beat_year`, `beat_price`, `beat_format`, `beat_source`, `beat_cover`, `beat_nbvente`, `beat_like`, `beat_dateupload`) VALUES
(10, 'BlueCup', 'Wanabilini', 17, 16, '200k vue sur youtube ', 'Black D,Cheu B, Rep Cup', 2017, 0.00, 'mp3', 'data/17-Wanabilini/beats/17-beat-10.mp3', 'data/17-Wanabilini/images/cover/17-cover-10.png', 5, 8, '2020-05-14 00:00:00'),
(11, 'Malsain 2', 'Wanabilini', 17, 16, 'Type beat Leto\r\nFollow insta @wanabilini', 'Leto,Kepler, Wanabilini', 2020, 25.00, 'mp3', 'data/17-Wanabilini/beats/17-beat-11.mp3', 'data/17-Wanabilini/images/cover/17-cover-11.png', 5, 10, '2020-05-18 00:00:00'),
(12, 'Psykokwak', 'Wanabilini', 17, 16, 'Instru de Game boy un peu', 'Black D, Pokemon, Mlachahe', 2019, 45.00, 'mp3', 'data/17-Wanabilini/beats/17-beat-12.mp3', 'data/17-Wanabilini/images/cover/17-cover-12.png', 0, 5, '2020-06-19 00:00:00'),
(13, 'Telo', 'Wanabilini', 17, 16, 'Instru piano', 'koba, leto', 2018, 33.00, 'mp3', 'data/17-Wanabilini/beats/17-beat-13.mp3', 'data/17-Wanabilini/images/cover/17-cover-13.png', 3, 5, '2020-06-17 00:00:00'),
(14, 'Montant', 'Wanabilini', 17, 16, 'Instru type beat Bosh - French Drill', 'Bosh, French Drill', 2019, 39.99, 'mp3', 'data/17-Wanabilini/beats/17-beat-14.mp3', 'data/17-Wanabilini/images/cover/17-cover-14.png', 6, 7, '2020-06-20 00:00:00'),
(15, 'Temps Mort ', 'Wanabilini', 17, 16, 'Instrumental Original du titre \"Temps Mort\" de Bosh', 'bosh, wanabilini', 2017, 49.99, 'mp3', 'data/17-Wanabilini/beats/17-beat-15.mp3', 'data/17-Wanabilini/images/cover/17-cover-15.png', 0, 4, '2020-05-29 00:00:00'),
(16, 'Raconte', 'Wanabilini', 17, 13, 'Instrumental Piano Triste Modern Old School Trap / Sample Instrumental ', 'Guizmo, Rémy', 2018, 10.00, 'mp3', 'data/17-Wanabilini/beats/17-beat-16.mp3', 'data/17-Wanabilini/images/cover/17-cover-16.png', 0, 2, '2020-05-31 00:00:00'),
(20, 'Yembe', 'Wanabilini', 17, 5, 'La prod préféré des youtubeuse', 'zoken,2t,Wanabilini, Afro Beat', 2020, 0.00, 'mp3', 'data/17-Wanabilini/beats/17-beat-20.mp3', 'data/17-Wanabilini/images/cover/17-cover-20.png', 3, 3, '2020-05-20 00:00:00'),
(21, 'Baby Yes', 'Wanabilini', 17, 0, 'Instru été ', 'DanceHall, Playa, Wanabilini', 2019, 19.00, 'mp3', 'data/17-Wanabilini/beats/17-beat-21.mp3', 'data/17-Wanabilini/images/cover/17-cover-21.png', 2, 6, '2020-06-20 03:00:00'),
(22, 'Burny', 'Wanabilini', 17, 5, '  Instrument Afro Beat New Vibes', 'burna boy,wanabilini', 2020, 15.00, 'mp3', 'data/17-Wanabilini/beats/17-beat-22.mp3', 'data/17-Wanabilini/images/cover/17-cover-22.png', 0, 4, '2020-06-17 09:09:00'),
(23, 'Butin', 'Wanabilini', 17, 0, '  La MG type Beat Afro beat', 'La MG, 4keus', 2018, 25.00, 'mp3', 'data/17-Wanabilini/beats/17-beat-23.mp3', 'data/17-Wanabilini/images/cover/17-cover-23.png', 0, 1, '2020-05-14 00:00:00'),
(24, 'Timide', 'Wanabilini', 17, 0, '  Tayc type Beat Love Instrumental', 'Tayc,Leto', 2019, 3.99, 'mp3', 'data/17-Wanabilini/beats/17-beat-24.mp3', 'data/17-Wanabilini/images/cover/17-cover-24.png', 0, 2, '2020-06-12 00:00:00'),
(25, 'Humeur', 'Akuma', 10, 16, '  Chinese Sample, Meilleur prod du monde', 'RMR, Akuma, Sample', 2020, 50.00, 'mp3', 'data/10-Akuma/beats/10-beat-25.mp3', 'data/10-Akuma/images/cover/10-cover-25.png', 1, 3, '2020-06-20 20:00:00'),
(30, 'Disrepect', 'SeniorAlaProd', 20, 16, 'Trap drill', 'Hamza', 2020, 30.00, 'mp3', 'data/20-SeniorAlaProd/beats/20-beat-30.mp3', 'data/20-SeniorAlaProd/images/cover/20-cover-30.png', 3, 3, '2020-06-18 00:00:00'),
(31, 'Encore', 'SeniorAlaProd', 20, 3, 'Chill', 'Luidji,Krisy', 2019, 19.00, 'mp3', 'data/20-SeniorAlaProd/beats/20-beat-31.mp3', 'data/20-SeniorAlaProd/images/cover/20-cover-31.png', 3, 4, '2020-06-10 00:00:00'),
(32, 'Go On', 'SeniorAlaProd', 20, 0, 'Afro Beat', 'BurnaBoy', 2020, 19.00, 'mp3', 'data/20-SeniorAlaProd/beats/20-beat-32.mp3', 'data/20-SeniorAlaProd/images/cover/20-cover-32.png', 0, 1, '2020-04-22 00:00:00'),
(33, 'Mi Vida', 'SeniorAlaProd', 20, 10, 'Du zouk en 2020', 'Zouk', 2017, 15.00, 'mp3', 'data/20-SeniorAlaProd/beats/20-beat-33.mp3', 'data/20-SeniorAlaProd/images/cover/20-cover-33.png', 2, 2, '2020-06-09 00:00:00'),
(34, 'Masterpiece', 'SarutoBeats', 21, 15, 'Beat orchestral', 'RickRoss', 2018, 0.00, 'mp3', 'data/21-SarutoBeats/beats/21-beat-34.mp3', 'data/21-SarutoBeats/images/cover/21-cover-34.png', 4, 5, '2020-06-23 00:00:00'),
(35, 'Hustlers', 'SarutoBeats', 21, 1, 'C\'est New York ici', 'RickRoss', 2019, 0.00, 'mp3', 'data/21-SarutoBeats/beats/21-beat-35.mp3', 'data/21-SarutoBeats/images/cover/21-cover-35.png', 2, 3, '2020-06-24 00:00:00'),
(36, 'Right Round', 'SarutoBeats', 21, 14, 'Funky beat', 'BrunoMars,MichaelJackson', 2016, 24.00, 'mp3', 'data/21-SarutoBeats/beats/21-beat-36.mp3', 'data/21-SarutoBeats/images/cover/21-cover-36.png', 1, 1, '2020-05-14 00:00:00'),
(37, 'Monaco', 'SarutoBeats', 21, 12, 'Zumba d\'été  ', 'Maes', 2020, 25.00, 'mp3', 'data/21-SarutoBeats/beats/21-beat-37.mp3', 'data/21-SarutoBeats/images/cover/21-cover-37.png', 3, 5, '2020-06-16 00:00:00'),
(50, 'Persia', 'PascalProd', 30, 5, 'Deviens le prince de Perse', 'Yxng Bane', 2020, 72.50, 'mp3', 'data/30-PascalProd/beats/30-beat-50.mp3', 'data/30-PascalProd/images/cover/30-cover-50.png', 5, 4, '2020-06-19 21:56:00'),
(51, 'Petite', 'PascalProd', 30, 9, 'Vien par ici ma petite ;)', 'J Balvin, Bad Bunny, Ozuna', 2020, 44.45, 'mp3', 'data/30-PascalProd/beats/30-beat-51.mp3', 'data/30-PascalProd/images/cover/30-cover-51.png', 0, 0, '2020-06-19 21:58:00'),
(52, 'Utopia', 'PascalProd', 30, 18, 'La vie n\'est qu\'une utopie ?', 'Tory Lanez, Swae Lee, Wizkid', 2019, 24.50, 'mp3', 'data/30-PascalProd/beats/30-beat-52.mp3', 'data/30-PascalProd/images/cover/30-cover-52.png', 1, 4, '2019-06-19 22:03:00'),
(53, 'Sale', 'BeaBeatz', 31, 16, ' C\'est pas propre', 'sale', 2018, 18.50, 'mp3', 'data/31-BeaBeatz/beats/31-beat-53.mp3', 'data/31-BeaBeatz/images/cover/31-cover-53.png', 0, 1, '2018-08-08 22:05:21'),
(54, 'No more beginning', 'BeaBeatz', 31, 4, '  Je suis saoul', 'soul', 2016, 12.00, 'mp3', 'data/31-BeaBeatz/beats/31-beat-54.mp3', 'data/31-BeaBeatz/images/cover/31-cover-54.png', 1, 0, '2016-12-16 22:07:46'),
(55, 'Rock-n Roll-up', 'BeaBeatz', 31, 8, '  Rock\'n Roll Babyyyy!!!', 'rock', 2012, 0.00, 'mp3', 'data/31-BeaBeatz/beats/31-beat-55.mp3', 'data/31-BeaBeatz/images/cover/31-cover-55.png', 1, 2, '2012-10-01 19:35:32'),
(56, 'Better', 'WillyFunk', 32, 1, '  It\'s better', 'better, mieux', 2020, 66.60, 'mp3', 'data/32-WillyFunk/beats/32-beat-56.mp3', 'data/32-WillyFunk/images/cover/32-cover-56.png', 1, 1, '2020-06-09 22:13:04'),
(57, 'True Love', 'WillyFunk', 32, 3, ' Pour une vraie déclaration...', 'love', 2017, 33.25, 'mp3', 'data/32-WillyFunk/beats/32-beat-57.mp3', 'data/32-WillyFunk/images/cover/32-cover-57.png', 1, 2, '2017-02-14 14:25:26'),
(58, 'Sang', 'WillyFunk', 32, 16, ' Rouge Sang', 'Timal, Maes', 2020, 88.88, 'mp3', 'data/32-WillyFunk/beats/32-beat-58.mp3', 'data/32-WillyFunk/images/cover/32-cover-58.png', 0, 0, '2020-06-19 22:21:35'),
(59, 'Profond', 'WillyFunk', 32, 6, ' Entre dans les profondeurs', 'deep, piano', 2019, 50.00, 'mp3', 'data/32-WillyFunk/beats/32-beat-59.mp3', 'data/32-WillyFunk/images/cover/32-cover-59.png', 1, 2, '2019-09-10 20:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `genre_nom` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `genre_nom` (`genre_nom`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`genre_nom`, `id`) VALUES
('Afro', 5),
('DanceHall', 18),
('Deep\r\n', 6),
('Hip-Hop', 1),
('Indéfini', 0),
('Latino', 12),
('Old School', 13),
('Orchestral', 15),
('Pop/Funk', 14),
('R&B', 3),
('Reggae', 9),
('Rock', 8),
('Soul', 4),
('Trap', 16),
('Zouk', 10);

-- --------------------------------------------------------

--
-- Structure de la table `likelike`
--

DROP TABLE IF EXISTS `likelike`;
CREATE TABLE IF NOT EXISTS `likelike` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `like_beat_id` int(15) UNSIGNED NOT NULL,
  `like_user_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `like_beat_id` (`like_beat_id`),
  KEY `like_user_id` (`like_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `likelike`
--

INSERT INTO `likelike` (`id`, `like_beat_id`, `like_user_id`) VALUES
(10, 11, 36),
(11, 11, 37),
(12, 11, 38),
(13, 11, 39),
(14, 11, 43),
(15, 11, 40),
(16, 11, 41),
(17, 11, 44),
(18, 11, 42),
(19, 10, 36),
(20, 11, 17),
(21, 12, 17),
(22, 14, 17),
(23, 15, 17),
(24, 22, 17),
(25, 34, 36),
(26, 25, 36),
(27, 14, 36),
(28, 21, 36),
(29, 12, 36),
(30, 22, 36),
(31, 24, 36),
(32, 33, 36),
(33, 15, 36),
(34, 52, 36),
(35, 55, 36),
(36, 13, 36),
(37, 21, 37),
(38, 14, 37),
(39, 12, 37),
(40, 10, 37),
(41, 23, 37),
(42, 14, 38),
(43, 10, 38),
(44, 21, 38),
(45, 16, 38),
(46, 14, 39),
(47, 15, 39),
(48, 16, 39),
(49, 25, 39),
(50, 21, 40),
(51, 22, 40),
(52, 13, 40),
(53, 24, 40),
(54, 20, 40),
(55, 10, 41),
(56, 12, 41),
(58, 13, 41),
(59, 14, 42),
(60, 12, 42),
(61, 21, 42),
(62, 35, 42),
(63, 34, 42),
(64, 20, 42),
(65, 10, 42),
(66, 55, 42),
(67, 25, 17),
(68, 15, 40),
(69, 50, 40),
(70, 10, 40),
(71, 14, 40),
(72, 37, 40),
(73, 52, 41),
(74, 37, 41),
(75, 30, 41),
(76, 50, 42),
(77, 22, 42),
(78, 56, 42),
(79, 33, 42),
(80, 57, 42),
(81, 53, 42),
(82, 59, 42),
(83, 13, 43),
(84, 20, 43),
(85, 52, 43),
(86, 10, 43),
(87, 50, 43),
(88, 36, 44),
(89, 57, 44),
(90, 52, 44),
(91, 59, 44),
(92, 10, 44),
(93, 13, 44),
(94, 50, 44),
(95, 37, 36),
(96, 31, 36),
(97, 34, 37),
(98, 35, 37),
(99, 30, 37),
(100, 37, 37),
(101, 31, 37),
(102, 34, 38),
(106, 30, 38),
(107, 37, 38),
(108, 31, 38),
(109, 32, 38),
(110, 34, 39),
(111, 35, 39),
(112, 21, 39),
(113, 31, 39);

-- --------------------------------------------------------

--
-- Structure de la table `messagerie`
--

DROP TABLE IF EXISTS `messagerie`;
CREATE TABLE IF NOT EXISTS `messagerie` (
  `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_from` int(10) UNSIGNED NOT NULL,
  `id_to` int(10) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_message` datetime NOT NULL,
  `lu` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_to` (`id_to`),
  KEY `id_from` (`id_from`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messagerie_signal`
--

DROP TABLE IF EXISTS `messagerie_signal`;
CREATE TABLE IF NOT EXISTS `messagerie_signal` (
  `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
  `message_id` int(255) UNSIGNED NOT NULL,
  `motif` int(1) UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `message_id` (`message_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `panier_user_id` int(10) UNSIGNED NOT NULL,
  `panier_beat_id` int(15) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `panier_user_id` (`panier_user_id`),
  KEY `panier_beat_id` (`panier_beat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=307 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id`, `panier_user_id`, `panier_beat_id`) VALUES
(249, 41, 13),
(250, 41, 11),
(251, 41, 10);

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

DROP TABLE IF EXISTS `pays`;
CREATE TABLE IF NOT EXISTS `pays` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` int(3) NOT NULL,
  `alpha2` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alpha3` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_en_gb` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_fr_fr` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `alpha2` (`alpha2`),
  UNIQUE KEY `alpha3` (`alpha3`),
  UNIQUE KEY `code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=242 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pays`
--

INSERT INTO `pays` (`id`, `code`, `alpha2`, `alpha3`, `nom_en_gb`, `nom_fr_fr`) VALUES
(1, 4, 'AF', 'AFG', 'Afghanistan', 'Afghanistan'),
(2, 8, 'AL', 'ALB', 'Albania', 'Albanie'),
(3, 10, 'AQ', 'ATA', 'Antarctica', 'Antarctique'),
(4, 12, 'DZ', 'DZA', 'Algeria', 'Algérie'),
(5, 16, 'AS', 'ASM', 'American Samoa', 'Samoa Américaines'),
(6, 20, 'AD', 'AND', 'Andorra', 'Andorre'),
(7, 24, 'AO', 'AGO', 'Angola', 'Angola'),
(8, 28, 'AG', 'ATG', 'Antigua and Barbuda', 'Antigua-et-Barbuda'),
(9, 31, 'AZ', 'AZE', 'Azerbaijan', 'Azerbaïdjan'),
(10, 32, 'AR', 'ARG', 'Argentina', 'Argentine'),
(11, 36, 'AU', 'AUS', 'Australia', 'Australie'),
(12, 40, 'AT', 'AUT', 'Austria', 'Autriche'),
(13, 44, 'BS', 'BHS', 'Bahamas', 'Bahamas'),
(14, 48, 'BH', 'BHR', 'Bahrain', 'Bahreïn'),
(15, 50, 'BD', 'BGD', 'Bangladesh', 'Bangladesh'),
(16, 51, 'AM', 'ARM', 'Armenia', 'Arménie'),
(17, 52, 'BB', 'BRB', 'Barbados', 'Barbade'),
(18, 56, 'BE', 'BEL', 'Belgium', 'Belgique'),
(19, 60, 'BM', 'BMU', 'Bermuda', 'Bermudes'),
(20, 64, 'BT', 'BTN', 'Bhutan', 'Bhoutan'),
(21, 68, 'BO', 'BOL', 'Bolivia', 'Bolivie'),
(22, 70, 'BA', 'BIH', 'Bosnia and Herzegovina', 'Bosnie-Herzégovine'),
(23, 72, 'BW', 'BWA', 'Botswana', 'Botswana'),
(24, 74, 'BV', 'BVT', 'Bouvet Island', 'Île Bouvet'),
(25, 76, 'BR', 'BRA', 'Brazil', 'Brésil'),
(26, 84, 'BZ', 'BLZ', 'Belize', 'Belize'),
(27, 86, 'IO', 'IOT', 'British Indian Ocean Territory', 'Territoire Britannique de l\'Océan Indien'),
(28, 90, 'SB', 'SLB', 'Solomon Islands', 'Îles Salomon'),
(29, 92, 'VG', 'VGB', 'British Virgin Islands', 'Îles Vierges Britanniques'),
(30, 96, 'BN', 'BRN', 'Brunei Darussalam', 'Brunéi Darussalam'),
(31, 100, 'BG', 'BGR', 'Bulgaria', 'Bulgarie'),
(32, 104, 'MM', 'MMR', 'Myanmar', 'Myanmar'),
(33, 108, 'BI', 'BDI', 'Burundi', 'Burundi'),
(34, 112, 'BY', 'BLR', 'Belarus', 'Bélarus'),
(35, 116, 'KH', 'KHM', 'Cambodia', 'Cambodge'),
(36, 120, 'CM', 'CMR', 'Cameroon', 'Cameroun'),
(37, 124, 'CA', 'CAN', 'Canada', 'Canada'),
(38, 132, 'CV', 'CPV', 'Cape Verde', 'Cap-vert'),
(39, 136, 'KY', 'CYM', 'Cayman Islands', 'Îles Caïmanes'),
(40, 140, 'CF', 'CAF', 'Central African', 'République Centrafricaine'),
(41, 144, 'LK', 'LKA', 'Sri Lanka', 'Sri Lanka'),
(42, 148, 'TD', 'TCD', 'Chad', 'Tchad'),
(43, 152, 'CL', 'CHL', 'Chile', 'Chili'),
(44, 156, 'CN', 'CHN', 'China', 'Chine'),
(45, 158, 'TW', 'TWN', 'Taiwan', 'Taïwan'),
(46, 162, 'CX', 'CXR', 'Christmas Island', 'Île Christmas'),
(47, 166, 'CC', 'CCK', 'Cocos (Keeling) Islands', 'Îles Cocos (Keeling)'),
(48, 170, 'CO', 'COL', 'Colombia', 'Colombie'),
(49, 174, 'KM', 'COM', 'Comoros', 'Comores'),
(50, 175, 'YT', 'MYT', 'Mayotte', 'Mayotte'),
(51, 178, 'CG', 'COG', 'Republic of the Congo', 'République du Congo'),
(52, 180, 'CD', 'COD', 'The Democratic Republic Of The Congo', 'République Démocratique du Congo'),
(53, 184, 'CK', 'COK', 'Cook Islands', 'Îles Cook'),
(54, 188, 'CR', 'CRI', 'Costa Rica', 'Costa Rica'),
(55, 191, 'HR', 'HRV', 'Croatia', 'Croatie'),
(56, 192, 'CU', 'CUB', 'Cuba', 'Cuba'),
(57, 196, 'CY', 'CYP', 'Cyprus', 'Chypre'),
(58, 203, 'CZ', 'CZE', 'Czech Republic', 'République Tchèque'),
(59, 204, 'BJ', 'BEN', 'Benin', 'Bénin'),
(60, 208, 'DK', 'DNK', 'Denmark', 'Danemark'),
(61, 212, 'DM', 'DMA', 'Dominica', 'Dominique'),
(62, 214, 'DO', 'DOM', 'Dominican Republic', 'République Dominicaine'),
(63, 218, 'EC', 'ECU', 'Ecuador', 'Équateur'),
(64, 222, 'SV', 'SLV', 'El Salvador', 'El Salvador'),
(65, 226, 'GQ', 'GNQ', 'Equatorial Guinea', 'Guinée Équatoriale'),
(66, 231, 'ET', 'ETH', 'Ethiopia', 'Éthiopie'),
(67, 232, 'ER', 'ERI', 'Eritrea', 'Érythrée'),
(68, 233, 'EE', 'EST', 'Estonia', 'Estonie'),
(69, 234, 'FO', 'FRO', 'Faroe Islands', 'Îles Féroé'),
(70, 238, 'FK', 'FLK', 'Falkland Islands', 'Îles (malvinas) Falkland'),
(71, 239, 'GS', 'SGS', 'South Georgia and the South Sandwich Islands', 'Géorgie du Sud et les Îles Sandwich du Sud'),
(72, 242, 'FJ', 'FJI', 'Fiji', 'Fidji'),
(73, 246, 'FI', 'FIN', 'Finland', 'Finlande'),
(74, 248, 'AX', 'ALA', 'Åland Islands', 'Îles Åland'),
(75, 250, 'FR', 'FRA', 'France', 'France'),
(76, 254, 'GF', 'GUF', 'French Guiana', 'Guyane Française'),
(77, 258, 'PF', 'PYF', 'French Polynesia', 'Polynésie Française'),
(78, 260, 'TF', 'ATF', 'French Southern Territories', 'Terres Australes Françaises'),
(79, 262, 'DJ', 'DJI', 'Djibouti', 'Djibouti'),
(80, 266, 'GA', 'GAB', 'Gabon', 'Gabon'),
(81, 268, 'GE', 'GEO', 'Georgia', 'Géorgie'),
(82, 270, 'GM', 'GMB', 'Gambia', 'Gambie'),
(83, 275, 'PS', 'PSE', 'Occupied Palestinian Territory', 'Territoire Palestinien Occupé'),
(84, 276, 'DE', 'DEU', 'Germany', 'Allemagne'),
(85, 288, 'GH', 'GHA', 'Ghana', 'Ghana'),
(86, 292, 'GI', 'GIB', 'Gibraltar', 'Gibraltar'),
(87, 296, 'KI', 'KIR', 'Kiribati', 'Kiribati'),
(88, 300, 'GR', 'GRC', 'Greece', 'Grèce'),
(89, 304, 'GL', 'GRL', 'Greenland', 'Groenland'),
(90, 308, 'GD', 'GRD', 'Grenada', 'Grenade'),
(91, 312, 'GP', 'GLP', 'Guadeloupe', 'Guadeloupe'),
(92, 316, 'GU', 'GUM', 'Guam', 'Guam'),
(93, 320, 'GT', 'GTM', 'Guatemala', 'Guatemala'),
(94, 324, 'GN', 'GIN', 'Guinea', 'Guinée'),
(95, 328, 'GY', 'GUY', 'Guyana', 'Guyana'),
(96, 332, 'HT', 'HTI', 'Haiti', 'Haïti'),
(97, 334, 'HM', 'HMD', 'Heard Island and McDonald Islands', 'Îles Heard et Mcdonald'),
(98, 336, 'VA', 'VAT', 'Vatican City State', 'Saint-Siège (état de la Cité du Vatican)'),
(99, 340, 'HN', 'HND', 'Honduras', 'Honduras'),
(100, 344, 'HK', 'HKG', 'Hong Kong', 'Hong-Kong'),
(101, 348, 'HU', 'HUN', 'Hungary', 'Hongrie'),
(102, 352, 'IS', 'ISL', 'Iceland', 'Islande'),
(103, 356, 'IN', 'IND', 'India', 'Inde'),
(104, 360, 'ID', 'IDN', 'Indonesia', 'Indonésie'),
(105, 364, 'IR', 'IRN', 'Islamic Republic of Iran', 'République Islamique d\'Iran'),
(106, 368, 'IQ', 'IRQ', 'Iraq', 'Iraq'),
(107, 372, 'IE', 'IRL', 'Ireland', 'Irlande'),
(108, 376, 'IL', 'ISR', 'Israel', 'Israël'),
(109, 380, 'IT', 'ITA', 'Italy', 'Italie'),
(110, 384, 'CI', 'CIV', 'Côte d\'Ivoire', 'Côte d\'Ivoire'),
(111, 388, 'JM', 'JAM', 'Jamaica', 'Jamaïque'),
(112, 392, 'JP', 'JPN', 'Japan', 'Japon'),
(113, 398, 'KZ', 'KAZ', 'Kazakhstan', 'Kazakhstan'),
(114, 400, 'JO', 'JOR', 'Jordan', 'Jordanie'),
(115, 404, 'KE', 'KEN', 'Kenya', 'Kenya'),
(116, 408, 'KP', 'PRK', 'Democratic People\'s Republic of Korea', 'République Populaire Démocratique de Corée'),
(117, 410, 'KR', 'KOR', 'Republic of Korea', 'République de Corée'),
(118, 414, 'KW', 'KWT', 'Kuwait', 'Koweït'),
(119, 417, 'KG', 'KGZ', 'Kyrgyzstan', 'Kirghizistan'),
(120, 418, 'LA', 'LAO', 'Lao People\'s Democratic Republic', 'République Démocratique Populaire Lao'),
(121, 422, 'LB', 'LBN', 'Lebanon', 'Liban'),
(122, 426, 'LS', 'LSO', 'Lesotho', 'Lesotho'),
(123, 428, 'LV', 'LVA', 'Latvia', 'Lettonie'),
(124, 430, 'LR', 'LBR', 'Liberia', 'Libéria'),
(125, 434, 'LY', 'LBY', 'Libyan Arab Jamahiriya', 'Jamahiriya Arabe Libyenne'),
(126, 438, 'LI', 'LIE', 'Liechtenstein', 'Liechtenstein'),
(127, 440, 'LT', 'LTU', 'Lithuania', 'Lituanie'),
(128, 442, 'LU', 'LUX', 'Luxembourg', 'Luxembourg'),
(129, 446, 'MO', 'MAC', 'Macao', 'Macao'),
(130, 450, 'MG', 'MDG', 'Madagascar', 'Madagascar'),
(131, 454, 'MW', 'MWI', 'Malawi', 'Malawi'),
(132, 458, 'MY', 'MYS', 'Malaysia', 'Malaisie'),
(133, 462, 'MV', 'MDV', 'Maldives', 'Maldives'),
(134, 466, 'ML', 'MLI', 'Mali', 'Mali'),
(135, 470, 'MT', 'MLT', 'Malta', 'Malte'),
(136, 474, 'MQ', 'MTQ', 'Martinique', 'Martinique'),
(137, 478, 'MR', 'MRT', 'Mauritania', 'Mauritanie'),
(138, 480, 'MU', 'MUS', 'Mauritius', 'Maurice'),
(139, 484, 'MX', 'MEX', 'Mexico', 'Mexique'),
(140, 492, 'MC', 'MCO', 'Monaco', 'Monaco'),
(141, 496, 'MN', 'MNG', 'Mongolia', 'Mongolie'),
(142, 498, 'MD', 'MDA', 'Republic of Moldova', 'République de Moldova'),
(143, 500, 'MS', 'MSR', 'Montserrat', 'Montserrat'),
(144, 504, 'MA', 'MAR', 'Morocco', 'Maroc'),
(145, 508, 'MZ', 'MOZ', 'Mozambique', 'Mozambique'),
(146, 512, 'OM', 'OMN', 'Oman', 'Oman'),
(147, 516, 'NA', 'NAM', 'Namibia', 'Namibie'),
(148, 520, 'NR', 'NRU', 'Nauru', 'Nauru'),
(149, 524, 'NP', 'NPL', 'Nepal', 'Népal'),
(150, 528, 'NL', 'NLD', 'Netherlands', 'Pays-Bas'),
(151, 530, 'AN', 'ANT', 'Netherlands Antilles', 'Antilles Néerlandaises'),
(152, 533, 'AW', 'ABW', 'Aruba', 'Aruba'),
(153, 540, 'NC', 'NCL', 'New Caledonia', 'Nouvelle-Calédonie'),
(154, 548, 'VU', 'VUT', 'Vanuatu', 'Vanuatu'),
(155, 554, 'NZ', 'NZL', 'New Zealand', 'Nouvelle-Zélande'),
(156, 558, 'NI', 'NIC', 'Nicaragua', 'Nicaragua'),
(157, 562, 'NE', 'NER', 'Niger', 'Niger'),
(158, 566, 'NG', 'NGA', 'Nigeria', 'Nigéria'),
(159, 570, 'NU', 'NIU', 'Niue', 'Niué'),
(160, 574, 'NF', 'NFK', 'Norfolk Island', 'Île Norfolk'),
(161, 578, 'NO', 'NOR', 'Norway', 'Norvège'),
(162, 580, 'MP', 'MNP', 'Northern Mariana Islands', 'Îles Mariannes du Nord'),
(163, 581, 'UM', 'UMI', 'United States Minor Outlying Islands', 'Îles Mineures Éloignées des États-Unis'),
(164, 583, 'FM', 'FSM', 'Federated States of Micronesia', 'États Fédérés de Micronésie'),
(165, 584, 'MH', 'MHL', 'Marshall Islands', 'Îles Marshall'),
(166, 585, 'PW', 'PLW', 'Palau', 'Palaos'),
(167, 586, 'PK', 'PAK', 'Pakistan', 'Pakistan'),
(168, 591, 'PA', 'PAN', 'Panama', 'Panama'),
(169, 598, 'PG', 'PNG', 'Papua New Guinea', 'Papouasie-Nouvelle-Guinée'),
(170, 600, 'PY', 'PRY', 'Paraguay', 'Paraguay'),
(171, 604, 'PE', 'PER', 'Peru', 'Pérou'),
(172, 608, 'PH', 'PHL', 'Philippines', 'Philippines'),
(173, 612, 'PN', 'PCN', 'Pitcairn', 'Pitcairn'),
(174, 616, 'PL', 'POL', 'Poland', 'Pologne'),
(175, 620, 'PT', 'PRT', 'Portugal', 'Portugal'),
(176, 624, 'GW', 'GNB', 'Guinea-Bissau', 'Guinée-Bissau'),
(177, 626, 'TL', 'TLS', 'Timor-Leste', 'Timor-Leste'),
(178, 630, 'PR', 'PRI', 'Puerto Rico', 'Porto Rico'),
(179, 634, 'QA', 'QAT', 'Qatar', 'Qatar'),
(180, 638, 'RE', 'REU', 'Réunion', 'Réunion'),
(181, 642, 'RO', 'ROU', 'Romania', 'Roumanie'),
(182, 643, 'RU', 'RUS', 'Russian Federation', 'Fédération de Russie'),
(183, 646, 'RW', 'RWA', 'Rwanda', 'Rwanda'),
(184, 654, 'SH', 'SHN', 'Saint Helena', 'Sainte-Hélène'),
(185, 659, 'KN', 'KNA', 'Saint Kitts and Nevis', 'Saint-Kitts-et-Nevis'),
(186, 660, 'AI', 'AIA', 'Anguilla', 'Anguilla'),
(187, 662, 'LC', 'LCA', 'Saint Lucia', 'Sainte-Lucie'),
(188, 666, 'PM', 'SPM', 'Saint-Pierre and Miquelon', 'Saint-Pierre-et-Miquelon'),
(189, 670, 'VC', 'VCT', 'Saint Vincent and the Grenadines', 'Saint-Vincent-et-les Grenadines'),
(190, 674, 'SM', 'SMR', 'San Marino', 'Saint-Marin'),
(191, 678, 'ST', 'STP', 'Sao Tome and Principe', 'Sao Tomé-et-Principe'),
(192, 682, 'SA', 'SAU', 'Saudi Arabia', 'Arabie Saoudite'),
(193, 686, 'SN', 'SEN', 'Senegal', 'Sénégal'),
(194, 690, 'SC', 'SYC', 'Seychelles', 'Seychelles'),
(195, 694, 'SL', 'SLE', 'Sierra Leone', 'Sierra Leone'),
(196, 702, 'SG', 'SGP', 'Singapore', 'Singapour'),
(197, 703, 'SK', 'SVK', 'Slovakia', 'Slovaquie'),
(198, 704, 'VN', 'VNM', 'Vietnam', 'Viet Nam'),
(199, 705, 'SI', 'SVN', 'Slovenia', 'Slovénie'),
(200, 706, 'SO', 'SOM', 'Somalia', 'Somalie'),
(201, 710, 'ZA', 'ZAF', 'South Africa', 'Afrique du Sud'),
(202, 716, 'ZW', 'ZWE', 'Zimbabwe', 'Zimbabwe'),
(203, 724, 'ES', 'ESP', 'Spain', 'Espagne'),
(204, 732, 'EH', 'ESH', 'Western Sahara', 'Sahara Occidental'),
(205, 736, 'SD', 'SDN', 'Sudan', 'Soudan'),
(206, 740, 'SR', 'SUR', 'Suriname', 'Suriname'),
(207, 744, 'SJ', 'SJM', 'Svalbard and Jan Mayen', 'Svalbard etÎle Jan Mayen'),
(208, 748, 'SZ', 'SWZ', 'Swaziland', 'Swaziland'),
(209, 752, 'SE', 'SWE', 'Sweden', 'Suède'),
(210, 756, 'CH', 'CHE', 'Switzerland', 'Suisse'),
(211, 760, 'SY', 'SYR', 'Syrian Arab Republic', 'République Arabe Syrienne'),
(212, 762, 'TJ', 'TJK', 'Tajikistan', 'Tadjikistan'),
(213, 764, 'TH', 'THA', 'Thailand', 'Thaïlande'),
(214, 768, 'TG', 'TGO', 'Togo', 'Togo'),
(215, 772, 'TK', 'TKL', 'Tokelau', 'Tokelau'),
(216, 776, 'TO', 'TON', 'Tonga', 'Tonga'),
(217, 780, 'TT', 'TTO', 'Trinidad and Tobago', 'Trinité-et-Tobago'),
(218, 784, 'AE', 'ARE', 'United Arab Emirates', 'Émirats Arabes Unis'),
(219, 788, 'TN', 'TUN', 'Tunisia', 'Tunisie'),
(220, 792, 'TR', 'TUR', 'Turkey', 'Turquie'),
(221, 795, 'TM', 'TKM', 'Turkmenistan', 'Turkménistan'),
(222, 796, 'TC', 'TCA', 'Turks and Caicos Islands', 'Îles Turks et Caïques'),
(223, 798, 'TV', 'TUV', 'Tuvalu', 'Tuvalu'),
(224, 800, 'UG', 'UGA', 'Uganda', 'Ouganda'),
(225, 804, 'UA', 'UKR', 'Ukraine', 'Ukraine'),
(226, 807, 'MK', 'MKD', 'The Former Yugoslav Republic of Macedonia', 'L\'ex-République Yougoslave de Macédoine'),
(227, 818, 'EG', 'EGY', 'Egypt', 'Égypte'),
(228, 826, 'GB', 'GBR', 'United Kingdom', 'Royaume-Uni'),
(229, 833, 'IM', 'IMN', 'Isle of Man', 'Île de Man'),
(230, 834, 'TZ', 'TZA', 'United Republic Of Tanzania', 'République-Unie de Tanzanie'),
(231, 840, 'US', 'USA', 'United States', 'États-Unis'),
(232, 850, 'VI', 'VIR', 'U.S. Virgin Islands', 'Îles Vierges des États-Unis'),
(233, 854, 'BF', 'BFA', 'Burkina Faso', 'Burkina Faso'),
(234, 858, 'UY', 'URY', 'Uruguay', 'Uruguay'),
(235, 860, 'UZ', 'UZB', 'Uzbekistan', 'Ouzbékistan'),
(236, 862, 'VE', 'VEN', 'Venezuela', 'Venezuela'),
(237, 876, 'WF', 'WLF', 'Wallis and Futuna', 'Wallis et Futuna'),
(238, 882, 'WS', 'WSM', 'Samoa', 'Samoa'),
(239, 887, 'YE', 'YEM', 'Yemen', 'Yémen'),
(240, 891, 'CS', 'SCG', 'Serbia and Montenegro', 'Serbie-et-Monténégro'),
(241, 894, 'ZM', 'ZMB', 'Zambia', 'Zambie');

-- --------------------------------------------------------

--
-- Structure de la table `relation`
--

DROP TABLE IF EXISTS `relation`;
CREATE TABLE IF NOT EXISTS `relation` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `id_demandeur` int(10) UNSIGNED NOT NULL,
  `id_receveur` int(10) UNSIGNED NOT NULL,
  `statut` int(255) NOT NULL,
  `date_relation` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_demandeur` (`id_demandeur`),
  KEY `id_receveur` (`id_receveur`)
) ENGINE=InnoDB AUTO_INCREMENT=264 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `relation`
--

INSERT INTO `relation` (`id`, `id_demandeur`, `id_receveur`, `statut`, `date_relation`) VALUES
(262, 2, 17, 1, '2020-06-17 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_role` int(2) UNSIGNED NOT NULL DEFAULT 2,
  `user_pseudo` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_image` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'assets/img/user.png',
  `user_prenom` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_nom` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_description` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '\' \'',
  `user_sexe` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_datenaissance` date DEFAULT NULL,
  `user_ville` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_pays` int(3) DEFAULT NULL,
  `user_password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_dateinscription` datetime NOT NULL,
  `user_dateconnexion` datetime NOT NULL,
  `user_statut` int(2) DEFAULT 1,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_pseudo` (`user_pseudo`),
  UNIQUE KEY `user_mail` (`user_email`),
  KEY `user_pays` (`user_pays`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`user_id`, `user_role`, `user_pseudo`, `user_email`, `user_image`, `user_prenom`, `user_nom`, `user_description`, `user_sexe`, `user_datenaissance`, `user_ville`, `user_pays`, `user_password`, `user_dateinscription`, `user_dateconnexion`, `user_statut`) VALUES
(1, 0, 'AriduBinks', 'ari@gmail.com', 'assets/img/user.png', 'Ari', 'Rajaofera', ' Babinks', 'M', '2000-04-02', 'Montmagny', 450, '$6$rounds=5000$grzgirjzgrpzhte9$eWM.Yc29LjPJRHe9uYpgmczTkRbnex.5Y2Q227Jg/nyXktILjyHkvisfwFZT593T9P6PQ2K/P7.jEGJHojfoj.', '2020-05-17 18:00:30', '2020-06-20 00:58:30', 1),
(2, 0, 'Mlamali95600', 'mlamali@gmail.com', 'assets/img/user.png', 'Mlamali', 'Said Salimo', ' Pfpeajgfrzapg', 'M', '2001-06-28', 'Eaubonne', 4, '$6$rounds=5000$grzgirjzgrpzhte9$eWM.Yc29LjPJRHe9uYpgmczTkRbnex.5Y2Q227Jg/nyXktILjyHkvisfwFZT593T9P6PQ2K/P7.jEGJHojfoj.', '2020-05-17 18:01:03', '2020-06-20 20:17:23', 1),
(3, 0, 'Mathieu', 'mathieu@gmail.com', 'assets/img/user.png', 'Mathieu', 'Cissé', ' Tysmé ', 'M', '2000-01-01', 'Aix', 4, '$6$rounds=5000$grzgirjzgrpzhte9$eWM.Yc29LjPJRHe9uYpgmczTkRbnex.5Y2Q227Jg/nyXktILjyHkvisfwFZT593T9P6PQ2K/P7.jEGJHojfoj.', '2020-05-17 18:01:22', '2020-06-10 15:20:55', 1),
(10, 2, 'Akuma', 'akuma@gmail.com', 'assets/img/user.png', NULL, NULL, '\' \'', '0', NULL, 'Paris', 250, '$6$rounds=5000$grzgirjzgrpzhte9$vHl3DtVy1.KNo0EFNRyGm7GDXPZWPJyPMI2aQ1xrErBSaiGNKkYF0k5iAVa9kkeR0yZaxidsoUhjgz2XmlzZo0', '2020-06-20 02:37:00', '2020-06-20 18:34:14', 1),
(17, 2, 'Wanabilini', 'saidou@gmail.com', 'data/17-Wanabilini/images/17-photo.png', 'Mlamali wan', 'Said Salimo', 'producer young beatmakeur', 'F', '2001-06-28', 'ville', 8, '$6$rounds=5000$grzgirjzgrpzhte9$vHl3DtVy1.KNo0EFNRyGm7GDXPZWPJyPMI2aQ1xrErBSaiGNKkYF0k5iAVa9kkeR0yZaxidsoUhjgz2XmlzZo0', '2020-05-10 15:51:15', '2020-06-21 23:23:25', 1),
(20, 2, 'SeniorAlaProd', 'senior@gmail.com', 'assets/img/user.png', NULL, NULL, '\' \'', '0', NULL, 'Cergy', 250, '$6$rounds=5000$grzgirjzgrpzhte9$vHl3DtVy1.KNo0EFNRyGm7GDXPZWPJyPMI2aQ1xrErBSaiGNKkYF0k5iAVa9kkeR0yZaxidsoUhjgz2XmlzZo0', '2020-06-19 23:50:27', '2020-06-19 23:50:27', 1),
(21, 2, 'SarutoBeats', 'sarutobeats@gmail.com', 'assets/img/user.png', NULL, NULL, '\' \'', '0', NULL, 'Cergy', 250, '$6$rounds=5000$grzgirjzgrpzhte9$vHl3DtVy1.KNo0EFNRyGm7GDXPZWPJyPMI2aQ1xrErBSaiGNKkYF0k5iAVa9kkeR0yZaxidsoUhjgz2XmlzZo0', '2020-06-19 23:53:59', '2020-06-19 23:53:59', 1),
(30, 2, 'PascalProd', 'pascalprod@mail.com', 'assets/img/user.png', NULL, NULL, '\' \'', 'M', NULL, 'Paris', 250, '$6$rounds=5000$grzgirjzgrpzhte9$vHl3DtVy1.KNo0EFNRyGm7GDXPZWPJyPMI2aQ1xrErBSaiGNKkYF0k5iAVa9kkeR0yZaxidsoUhjgz2XmlzZo0', '2020-06-19 21:37:59', '2020-06-19 21:37:59', 1),
(31, 2, 'BeaBeatz', 'bea@mail.com', 'assets/img/user.png', NULL, NULL, '\' \'', 'F', NULL, 'Manchester', 826, '$6$rounds=5000$grzgirjzgrpzhte9$vHl3DtVy1.KNo0EFNRyGm7GDXPZWPJyPMI2aQ1xrErBSaiGNKkYF0k5iAVa9kkeR0yZaxidsoUhjgz2XmlzZo0', '2020-06-19 21:42:42', '2020-06-19 21:42:42', 1),
(32, 2, 'WillyFunk', 'willy@mail.com', 'assets/img/user.png', NULL, NULL, '\' \'', 'M', NULL, 'Kingston', 388, '$6$rounds=5000$grzgirjzgrpzhte9$vHl3DtVy1.KNo0EFNRyGm7GDXPZWPJyPMI2aQ1xrErBSaiGNKkYF0k5iAVa9kkeR0yZaxidsoUhjgz2XmlzZo0', '2020-06-19 21:44:40', '2020-06-19 21:44:40', 1),
(36, 1, 'Inconnu1', 'Inconnu1@gmail.com', 'assets/img/user.png', NULL, NULL, '\' \'', NULL, NULL, 'inconnuville', 4, '$6$rounds=5000$grzgirjzgrpzhte9$vHl3DtVy1.KNo0EFNRyGm7GDXPZWPJyPMI2aQ1xrErBSaiGNKkYF0k5iAVa9kkeR0yZaxidsoUhjgz2XmlzZo0', '2020-06-20 00:00:00', '2020-06-20 20:05:06', 1),
(37, 1, 'Inconnu2', 'inconnu2@gmail.com', 'assets/img/user.png', NULL, NULL, '\' \'', NULL, NULL, NULL, 4, '$6$rounds=5000$grzgirjzgrpzhte9$vHl3DtVy1.KNo0EFNRyGm7GDXPZWPJyPMI2aQ1xrErBSaiGNKkYF0k5iAVa9kkeR0yZaxidsoUhjgz2XmlzZo0', '2020-06-20 00:00:00', '2020-06-20 19:40:28', 1),
(38, 1, 'Inconnu3', 'Inconnu3@gmail.com', 'assets/img/user.png', NULL, NULL, '\' \'', NULL, NULL, NULL, 4, '$6$rounds=5000$grzgirjzgrpzhte9$vHl3DtVy1.KNo0EFNRyGm7GDXPZWPJyPMI2aQ1xrErBSaiGNKkYF0k5iAVa9kkeR0yZaxidsoUhjgz2XmlzZo0', '2020-06-20 00:00:00', '2020-06-20 19:41:42', 1),
(39, 1, 'Inconnu4', 'Inconnu4@gmail.com', 'assets/img/user.png', NULL, NULL, '\' \'', NULL, NULL, NULL, 4, '$6$rounds=5000$grzgirjzgrpzhte9$vHl3DtVy1.KNo0EFNRyGm7GDXPZWPJyPMI2aQ1xrErBSaiGNKkYF0k5iAVa9kkeR0yZaxidsoUhjgz2XmlzZo0', '2020-06-20 00:00:00', '2020-06-20 19:42:53', 1),
(40, 1, 'Inconnu5', 'Inconnu5@gmail.com', 'assets/img/user.png', NULL, NULL, '\' \'', NULL, NULL, NULL, 4, '$6$rounds=5000$grzgirjzgrpzhte9$vHl3DtVy1.KNo0EFNRyGm7GDXPZWPJyPMI2aQ1xrErBSaiGNKkYF0k5iAVa9kkeR0yZaxidsoUhjgz2XmlzZo0', '2020-06-20 00:00:00', '2020-06-20 19:44:10', 1),
(41, 1, 'Inconnu6', 'Inconnu6@gmail.com', 'assets/img/user.png', NULL, NULL, '\' \'', NULL, NULL, NULL, 4, '$6$rounds=5000$grzgirjzgrpzhte9$vHl3DtVy1.KNo0EFNRyGm7GDXPZWPJyPMI2aQ1xrErBSaiGNKkYF0k5iAVa9kkeR0yZaxidsoUhjgz2XmlzZo0', '2020-06-13 00:00:00', '2020-06-20 19:44:46', 1),
(42, 1, 'Inconnu7', 'Inconnu7@gmail.com', 'assets/img/user.png', NULL, NULL, '\' \'', NULL, NULL, NULL, 4, '$6$rounds=5000$grzgirjzgrpzhte9$vHl3DtVy1.KNo0EFNRyGm7GDXPZWPJyPMI2aQ1xrErBSaiGNKkYF0k5iAVa9kkeR0yZaxidsoUhjgz2XmlzZo0', '2020-06-20 00:00:00', '2020-06-20 19:50:03', 1),
(43, 1, 'Inconnu8', 'Inconnu8@gmail.com', 'assets/img/user.png', NULL, NULL, '\' \'', NULL, NULL, NULL, 4, '$6$rounds=5000$grzgirjzgrpzhte9$vHl3DtVy1.KNo0EFNRyGm7GDXPZWPJyPMI2aQ1xrErBSaiGNKkYF0k5iAVa9kkeR0yZaxidsoUhjgz2XmlzZo0', '2020-06-20 00:00:00', '2020-06-20 00:00:00', 1),
(44, 1, 'Inconnu9', 'Inconnu9@gmail.com', 'assets/img/user.png', NULL, NULL, '\' \'', NULL, NULL, NULL, 4, '$6$rounds=5000$grzgirjzgrpzhte9$vHl3DtVy1.KNo0EFNRyGm7GDXPZWPJyPMI2aQ1xrErBSaiGNKkYF0k5iAVa9kkeR0yZaxidsoUhjgz2XmlzZo0', '2020-06-20 00:00:00', '2020-06-20 00:00:00', 1),
(45, 1, 'Inconnu10', 'Inconnu10@gmail.com', 'assets/img/user.png', NULL, NULL, '\' \'', NULL, NULL, NULL, 4, '$6$rounds=5000$grzgirjzgrpzhte9$vHl3DtVy1.KNo0EFNRyGm7GDXPZWPJyPMI2aQ1xrErBSaiGNKkYF0k5iAVa9kkeR0yZaxidsoUhjgz2XmlzZo0', '2020-06-20 00:00:00', '2020-06-20 00:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `vente`
--

DROP TABLE IF EXISTS `vente`;
CREATE TABLE IF NOT EXISTS `vente` (
  `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vente_beat_id` int(15) UNSIGNED NOT NULL,
  `vente_user_id` int(10) UNSIGNED NOT NULL,
  `vente_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `vente_beat_id` (`vente_beat_id`),
  KEY `vente_user_id` (`vente_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `vente`
--

INSERT INTO `vente` (`id`, `vente_beat_id`, `vente_user_id`, `vente_date`) VALUES
(11, 20, 40, '2020-06-21 00:04:12'),
(12, 50, 40, '2020-06-21 00:04:13'),
(13, 14, 40, '2020-06-21 00:04:13'),
(14, 13, 41, '2020-06-21 00:10:09'),
(15, 11, 41, '2020-06-21 00:10:10'),
(16, 10, 41, '2020-06-21 00:10:11'),
(17, 14, 41, '2020-06-21 00:10:12'),
(18, 30, 41, '2020-06-21 00:10:13'),
(19, 50, 41, '2020-06-21 00:10:16'),
(20, 50, 42, '2020-06-21 00:17:02'),
(21, 56, 42, '2020-06-21 00:17:03'),
(22, 33, 42, '2020-06-21 00:17:03'),
(23, 20, 42, '2020-06-21 00:17:04'),
(24, 11, 42, '2020-06-21 00:17:05'),
(25, 57, 42, '2020-06-21 00:17:05'),
(26, 59, 42, '2020-06-21 00:17:06'),
(27, 55, 42, '2020-06-21 00:17:07'),
(28, 20, 43, '2020-06-21 00:21:28'),
(29, 10, 43, '2020-06-21 00:21:28'),
(30, 13, 43, '2020-06-21 00:21:28'),
(31, 50, 43, '2020-06-21 00:21:28'),
(32, 36, 44, '2020-06-21 00:24:37'),
(33, 54, 44, '2020-06-21 00:24:38'),
(34, 52, 44, '2020-06-21 00:24:39'),
(35, 10, 44, '2020-06-21 00:24:40'),
(36, 13, 44, '2020-06-21 00:24:41'),
(37, 50, 44, '2020-06-21 00:24:42'),
(38, 34, 36, '2020-06-20 23:17:58'),
(39, 14, 36, '2020-06-20 23:17:59'),
(40, 11, 36, '2020-06-20 23:18:05'),
(41, 10, 36, '2020-06-20 23:18:06'),
(42, 37, 36, '2020-06-20 23:18:16'),
(43, 33, 36, '2020-06-20 23:18:17'),
(44, 21, 36, '2020-06-20 23:18:17'),
(45, 14, 37, '2020-06-20 23:23:07'),
(46, 30, 37, '2020-06-20 23:23:07'),
(47, 34, 37, '2020-06-20 23:23:07'),
(48, 37, 37, '2020-06-20 23:23:07'),
(49, 35, 37, '2020-06-20 23:23:58'),
(50, 31, 37, '2020-06-20 23:23:58'),
(51, 14, 38, '2020-06-20 23:31:47'),
(52, 37, 38, '2020-06-20 23:31:47'),
(53, 31, 38, '2020-06-20 23:31:47'),
(54, 30, 38, '2020-06-20 23:31:47'),
(55, 34, 38, '2020-06-20 23:31:47'),
(56, 11, 38, '2020-06-20 23:32:41'),
(57, 25, 39, '2020-06-20 23:36:56'),
(58, 21, 39, '2020-06-20 23:36:56'),
(59, 14, 39, '2020-06-20 23:36:56'),
(60, 31, 39, '2020-06-20 23:36:56'),
(61, 34, 39, '2020-06-20 23:36:56'),
(62, 11, 39, '2020-06-20 23:36:56'),
(63, 10, 39, '2020-06-20 23:36:56'),
(64, 35, 39, '2020-06-20 23:57:58');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `beat`
--
ALTER TABLE `beat`
  ADD CONSTRAINT `beat_ibfk_1` FOREIGN KEY (`beat_author_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `beat_ibfk_2` FOREIGN KEY (`beat_author`) REFERENCES `user` (`user_pseudo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `beat_ibfk_3` FOREIGN KEY (`beat_genre`) REFERENCES `genre` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `likelike`
--
ALTER TABLE `likelike`
  ADD CONSTRAINT `likelike_ibfk_1` FOREIGN KEY (`like_beat_id`) REFERENCES `beat` (`beat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likelike_ibfk_2` FOREIGN KEY (`like_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `messagerie`
--
ALTER TABLE `messagerie`
  ADD CONSTRAINT `messagerie_ibfk_1` FOREIGN KEY (`id_from`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messagerie_ibfk_2` FOREIGN KEY (`id_to`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `messagerie_signal`
--
ALTER TABLE `messagerie_signal`
  ADD CONSTRAINT `messagerie_signal_ibfk_1` FOREIGN KEY (`message_id`) REFERENCES `messagerie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`panier_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `panier_ibfk_2` FOREIGN KEY (`panier_beat_id`) REFERENCES `beat` (`beat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `relation`
--
ALTER TABLE `relation`
  ADD CONSTRAINT `relation_ibfk_1` FOREIGN KEY (`id_demandeur`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `relation_ibfk_2` FOREIGN KEY (`id_receveur`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`user_pays`) REFERENCES `pays` (`code`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `vente`
--
ALTER TABLE `vente`
  ADD CONSTRAINT `vente_ibfk_1` FOREIGN KEY (`vente_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vente_ibfk_2` FOREIGN KEY (`vente_beat_id`) REFERENCES `beat` (`beat_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
