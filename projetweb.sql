-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 20 juin 2020 à 01:04
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
  `beat_cover` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '''assets/img/cover_default.jpg''',
  `beat_nbvente` int(15) UNSIGNED NOT NULL DEFAULT 0,
  `beat_like` int(6) DEFAULT 0,
  `beat_dateupload` datetime NOT NULL,
  PRIMARY KEY (`beat_id`),
  KEY `beat_author_id` (`beat_author_id`),
  KEY `beat_author` (`beat_author`),
  KEY `beat_genre` (`beat_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `beat`
--

INSERT INTO `beat` (`beat_id`, `beat_title`, `beat_author`, `beat_author_id`, `beat_genre`, `beat_description`, `beat_tags`, `beat_year`, `beat_price`, `beat_format`, `beat_source`, `beat_cover`, `beat_nbvente`, `beat_like`, `beat_dateupload`) VALUES
(10, 'BlueCup', 'Wanabilini', 17, 16, '200k vue sur youtube ', 'Black D,Cheu B, Rep Cup', 2017, 0.00, 'mp3', 'data/17-Wanabilini/beats/17-beat-10.mp3', 'data/17-Wanabilini/images/cover/17-cover-10.png', 0, 0, '2020-05-14 00:00:00'),
(11, 'Malsain 2', 'Wanabilini', 17, 16, 'Type beat Leto\r\nFollow insta @wanabilini', 'Leto,Kepler, Wanabilini', 2020, 25.00, 'mp3', 'data/17-Wanabilini/beats/17-beat-11.mp3', 'data/17-Wanabilini/images/cover/17-cover-11.png', 0, 0, '2020-05-18 00:00:00'),
(12, 'Psykokwak', 'Wanabilini', 17, 16, 'Instru de Game boy un peu', 'Black D, Pokemon, Mlachahe', 2019, 45.00, 'mp3', 'data/17-Wanabilini/beats/17-beat-12.mp3', 'data/17-Wanabilini/images/cover/17-cover-12.png\r\n', 0, 0, '2020-06-19 00:00:00'),
(13, 'Telo', 'Wanabilini', 17, 16, 'Instru piano', 'koba, leto', 2018, 33.00, 'mp3', 'data/17-Wanabilini/beats/17-beat-13.mp3', 'data/17-Wanabilini/images/cover/17-beat-13.png', 0, 0, '2020-06-17 00:00:00'),
(14, 'Montant', 'Wanabilini', 17, 16, 'Instru type beat Bosh - French Drill', 'Bosh, French Drill', 2019, 39.99, 'mp3', 'data/17-Wanabilini/beats/17-beat-14.mp3', 'data/17-Wanabilini/images/cover/17-beat-14.png', 0, 0, '2020-06-20 00:00:00'),
(15, 'Temps Mort ', 'Wanabilini', 17, 16, 'Instrumental Original du titre \"Temps Mort\" de Bosh', 'bosh, wanabilini', 2017, 49.99, 'mp3', 'data/17-Wanabilini/beats/17-beat-15.mp3', 'data/17-Wanabilini/images/cover/17-beat-15.png', 0, 0, '2020-05-29 00:00:00'),
(16, 'Raconte', 'Wanabilini', 17, 13, 'Instrumental Piano Triste Modern Old School Trap / Sample Instrumental ', 'Guizmo, Rémy', 2018, 10.00, 'mp3', 'data/17-Wanabilini/beats/17-beat-16.mp3', 'data/17-Wanabilini/images/cover/17-beat-16.png', 0, 0, '2020-05-31 00:00:00'),
(20, 'Yembe', 'Wanabilini', 17, 5, 'La prod préféré des youtubeuse', 'zoken,2t,Wanabilini, Afro Beat', 2020, 0.00, 'mp3', 'data/17-Wanabilini/beats/17-beat-20.mp3', 'data/17-Wanabilini/images/cover/17-cover-20.png', 0, 0, '2020-05-20 00:00:00'),
(30, 'Disrepect', 'SeniorAlaProd', 32, 16, 'Trap drill', 'Hamza', 2020, 30.00, 'mp3', 'data/20-SeniorAlaProd/beats/20-beat-30.mp3\r\n', 'data/20-SeniorAlaProd/images/cover/20-cover-30.png\r\n', 0, 0, '2020-06-18 00:00:00'),
(31, 'Encore', 'SeniorAlaProd', 32, 3, 'Chill', 'Luidji,Krisy', 2019, 19.00, 'mp3', 'data/20-SeniorAlaProd/beats/20-beat-31.mp3\r\n', 'data/20-SeniorAlaProd/images/cover/20-cover-31.png\r\n', 0, 0, '2020-06-10 00:00:00'),
(32, 'Go On', 'SeniorAlaProd', 32, 0, 'Afro Beat', 'BurnaBoy', 2020, 19.00, 'mp3', 'data/20-SeniorAlaProd/beats/20-beat-32.mp3', 'data/20-SeniorAlaProd/images/cover/20-cover-32.png\r\n', 0, 0, '2020-04-22 00:00:00'),
(33, 'Mi Vida', 'SeniorAlaProd', 32, 10, 'Du zouk en 2020', 'Zouk', 2017, 15.00, 'mp3', 'data/20-SeniorAlaProd/beats/20-beat-33.mp3', 'data/20-SeniorAlaProd/images/cover/20-cover-33.png\r\n', 0, 0, '2020-06-09 00:00:00'),
(34, 'Masterpiece', 'SarutoBeats', 33, 15, 'Beat orchestral', 'RickRoss', 2018, 0.00, 'mp3', 'data/21-SarutoBeats/beats/21-beat-34.mp3\r\n', 'data/21-SarutoBeats/images/cover/21-cover-34.png', 0, 0, '2020-06-23 00:00:00'),
(35, 'Hustlers', 'SarutoBeats', 33, 1, 'C\'est New York ici', 'RickRoss', 2019, 0.00, 'mp3', 'data/21-SarutoBeats/beats/21-beat-35.mp3\r\n', 'data/21-SarutoBeats/images/cover/21-cover-35.png', 0, 0, '2020-06-24 00:00:00'),
(36, 'Right Round', 'SarutoBeats', 33, 14, 'Funky beat', 'BrunoMars,MichaelJackson', 2016, 24.00, 'mp3', 'data/21-SarutoBeats/beats/21-beat-36.mp3\r\n', 'data/21-SarutoBeats/images/cover/21-cover-36.png', 0, 0, '2020-05-14 00:00:00'),
(37, 'Monaco', 'SarutoBeats', 33, 12, 'Zumba d\'été  ', 'Maes', 2020, 25.00, 'mp3', 'data/21-SarutoBeats/beats/21-beat-37.mp3\r\n', 'data/21-SarutoBeats/images/cover/21-cover-37.png\r\n', 0, 0, '2020-06-16 00:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`genre_nom`, `id`) VALUES
('Afro', 5),
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
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

--
-- Déchargement des données de la table `messagerie`
--

INSERT INTO `messagerie` (`id`, `id_from`, `id_to`, `message`, `date_message`, `lu`) VALUES
(52, 1, 17, 'test1', '2020-06-15 00:00:00', 1),
(53, 1, 17, 'test2', '2020-06-15 01:00:00', 1),
(54, 17, 1, 'rep1', '2020-06-15 02:00:00', 1),
(55, 1, 17, 'test3', '2020-06-15 03:00:00', 1),
(56, 3, 17, 'allo', '2020-06-16 00:00:00', 1),
(59, 17, 1, 'wsh t ou ?', '2020-06-15 01:06:08', 1),
(60, 17, 1, 'att', '2020-06-15 01:06:18', 1),
(61, 17, 2, '12345', '2020-06-15 01:06:46', 0),
(62, 17, 2, 'cava ?', '2020-06-15 01:06:53', 0),
(63, 1, 17, '123', '2020-06-15 07:06:06', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=249 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=242 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=263 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `relation`
--

INSERT INTO `relation` (`id`, `id_demandeur`, `id_receveur`, `statut`, `date_relation`) VALUES
(249, 1, 2, 1, '2020-06-12 00:00:00'),
(260, 17, 1, 1, '2020-06-15 00:00:00'),
(261, 17, 2, 0, '2020-06-15 01:06:46'),
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
  `user_pays` int(3) NOT NULL,
  `user_password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_dateinscription` datetime NOT NULL,
  `user_dateconnexion` datetime NOT NULL,
  `user_statut` int(2) DEFAULT 1,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_pseudo` (`user_pseudo`),
  UNIQUE KEY `user_mail` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`user_id`, `user_role`, `user_pseudo`, `user_email`, `user_image`, `user_prenom`, `user_nom`, `user_description`, `user_sexe`, `user_datenaissance`, `user_ville`, `user_pays`, `user_password`, `user_dateinscription`, `user_dateconnexion`, `user_statut`) VALUES
(1, 0, 'AriduBinks', 'ari@gmail.com', 'assets/img/user.png', 'Ari', 'Rajaofera', ' Babinks', 'M', '2000-04-02', 'Montmagny', 450, '$6$rounds=5000$grzgirjzgrpzhte9$eWM.Yc29LjPJRHe9uYpgmczTkRbnex.5Y2Q227Jg/nyXktILjyHkvisfwFZT593T9P6PQ2K/P7.jEGJHojfoj.', '2020-05-17 18:00:30', '2020-06-15 19:41:55', 1),
(2, 0, 'Mlamali95600', 'mlamali@gmail.com', 'assets/2-Mlamali95600/user.png', 'Mlamali', 'Said Salimo', ' Pfpeajgfrzapg', 'M', '2001-06-28', 'Eaubonne', 4, '$6$rounds=5000$grzgirjzgrpzhte9$eWM.Yc29LjPJRHe9uYpgmczTkRbnex.5Y2Q227Jg/nyXktILjyHkvisfwFZT593T9P6PQ2K/P7.jEGJHojfoj.', '2020-05-17 18:01:03', '2020-06-19 00:01:09', 1),
(3, 0, 'Mathieu95', 'mathieu@gmail.com', 'data/3-Mathieu95/images/3-photo.jpg', 'Mathieu', 'Cissé', ' Tysmé ', 'M', '2000-01-01', 'Aix', 4, '$6$rounds=5000$grzgirjzgrpzhte9$eWM.Yc29LjPJRHe9uYpgmczTkRbnex.5Y2Q227Jg/nyXktILjyHkvisfwFZT593T9P6PQ2K/P7.jEGJHojfoj.', '2020-05-17 18:01:22', '2020-06-10 15:20:55', 1),
(17, 2, 'Wanabilini', 'saidou@gmail.com', 'data/17-Wanabilini/images/17-photo.jpg', 'Mlamali wan', 'Said Salimo', 'producer young beatmakeur', 'F', '2001-06-28', 'ville', 8, '$6$rounds=5000$grzgirjzgrpzhte9$vHl3DtVy1.KNo0EFNRyGm7GDXPZWPJyPMI2aQ1xrErBSaiGNKkYF0k5iAVa9kkeR0yZaxidsoUhjgz2XmlzZo0', '2020-05-10 15:51:15', '2020-06-19 01:30:52', 1),
(32, 2, 'SeniorAlaProd', 'senior@gmail.com', 'assets/img/user.png', NULL, NULL, '\' \'', '0', NULL, 'Cergy', 250, '$6$rounds=5000$grzgirjzgrpzhte9$vHl3DtVy1.KNo0EFNRyGm7GDXPZWPJyPMI2aQ1xrErBSaiGNKkYF0k5iAVa9kkeR0yZaxidsoUhjgz2XmlzZo0', '2020-06-19 23:50:27', '2020-06-19 23:50:27', 1),
(33, 2, 'SarutoBeats', 'sarutobeats@gmail.com', 'assets/img/user.png', NULL, NULL, '\' \'', '0', NULL, 'Cergy', 250, '$6$rounds=5000$grzgirjzgrpzhte9$vHl3DtVy1.KNo0EFNRyGm7GDXPZWPJyPMI2aQ1xrErBSaiGNKkYF0k5iAVa9kkeR0yZaxidsoUhjgz2XmlzZo0', '2020-06-19 23:53:59', '2020-06-19 23:53:59', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Contraintes pour la table `vente`
--
ALTER TABLE `vente`
  ADD CONSTRAINT `vente_ibfk_1` FOREIGN KEY (`vente_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vente_ibfk_2` FOREIGN KEY (`vente_beat_id`) REFERENCES `beat` (`beat_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
