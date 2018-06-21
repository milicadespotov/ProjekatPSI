-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 21, 2018 at 09:12 AM
-- Server version: 5.7.20-log
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `psiprojekatbaza`
--

-- --------------------------------------------------------

--
-- Table structure for table `actings`
--

DROP TABLE IF EXISTS `actings`;
CREATE TABLE IF NOT EXISTS `actings` (
  `actor_id` int(10) UNSIGNED NOT NULL,
  `tvshow_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`actor_id`,`tvshow_id`),
  KEY `actings_tvshow_id_foreign` (`tvshow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `actings`
--

INSERT INTO `actings` (`actor_id`, `tvshow_id`, `created_at`, `updated_at`) VALUES
(9, 2, '2018-06-20 15:44:52', '2018-06-20 15:44:52'),
(10, 2, '2018-06-20 15:45:48', '2018-06-20 15:45:48'),
(11, 2, '2018-06-20 15:45:57', '2018-06-20 15:45:57'),
(14, 11, '2018-06-20 16:45:43', '2018-06-20 16:45:43'),
(15, 11, '2018-06-20 16:45:52', '2018-06-20 16:45:52'),
(16, 11, '2018-06-20 16:46:22', '2018-06-20 16:46:22'),
(18, 20, '2018-06-20 17:47:02', '2018-06-20 17:47:02'),
(19, 20, '2018-06-20 17:47:14', '2018-06-20 17:47:14'),
(22, 23, '2018-06-20 21:02:36', '2018-06-20 21:02:36'),
(23, 23, '2018-06-20 21:02:44', '2018-06-20 21:02:44'),
(24, 23, '2018-06-20 21:02:52', '2018-06-20 21:02:52'),
(26, 26, '2018-06-20 21:07:23', '2018-06-20 21:07:23'),
(27, 26, '2018-06-20 21:07:37', '2018-06-20 21:07:37'),
(28, 26, '2018-06-20 21:07:44', '2018-06-20 21:07:44'),
(30, 29, '2018-06-20 21:23:46', '2018-06-20 21:23:46'),
(31, 29, '2018-06-20 21:23:53', '2018-06-20 21:23:53'),
(32, 29, '2018-06-20 21:24:06', '2018-06-20 21:24:06');

-- --------------------------------------------------------

--
-- Table structure for table `actors`
--

DROP TABLE IF EXISTS `actors`;
CREATE TABLE IF NOT EXISTS `actors` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `actors`
--

INSERT INTO `actors` (`category_id`, `created_at`, `updated_at`) VALUES
(9, '2018-06-20 15:44:52', '2018-06-20 15:44:52'),
(10, '2018-06-20 15:45:48', '2018-06-20 15:45:48'),
(11, '2018-06-20 15:45:57', '2018-06-20 15:45:57'),
(14, '2018-06-20 16:45:43', '2018-06-20 16:45:43'),
(15, '2018-06-20 16:45:52', '2018-06-20 16:45:52'),
(16, '2018-06-20 16:46:22', '2018-06-20 16:46:22'),
(18, '2018-06-20 17:47:02', '2018-06-20 17:47:02'),
(19, '2018-06-20 17:47:14', '2018-06-20 17:47:14'),
(22, '2018-06-20 21:02:36', '2018-06-20 21:02:36'),
(23, '2018-06-20 21:02:44', '2018-06-20 21:02:44'),
(24, '2018-06-20 21:02:52', '2018-06-20 21:02:52'),
(26, '2018-06-20 21:07:23', '2018-06-20 21:07:23'),
(27, '2018-06-20 21:07:37', '2018-06-20 21:07:37'),
(28, '2018-06-20 21:07:44', '2018-06-20 21:07:44'),
(30, '2018-06-20 21:23:46', '2018-06-20 21:23:46'),
(31, '2018-06-20 21:23:53', '2018-06-20 21:23:53'),
(32, '2018-06-20 21:24:06', '2018-06-20 21:24:06');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Dokumentarna', NULL, NULL),
(2, 'Komedija', NULL, NULL),
(3, 'Akcija', NULL, NULL),
(4, 'Horor', NULL, NULL),
(5, 'Triler', NULL, NULL),
(6, 'Drama', NULL, NULL),
(7, 'Romansa', NULL, NULL),
(8, 'Animirana', NULL, NULL),
(9, 'Emilija Klark', '2018-06-20 15:44:52', '2018-06-20 15:44:52'),
(10, 'Peter Dinklage', '2018-06-20 15:45:48', '2018-06-20 15:45:48'),
(11, 'Kit Harington', '2018-06-20 15:45:57', '2018-06-20 15:45:57'),
(12, 'David Nutter', '2018-06-20 15:46:10', '2018-06-20 15:46:10'),
(13, 'Alex Graves', '2018-06-20 15:46:16', '2018-06-20 15:46:16'),
(14, 'Gustaf Skarsgård', '2018-06-20 16:45:42', '2018-06-20 16:45:42'),
(15, 'Katheryn Winnick', '2018-06-20 16:45:52', '2018-06-20 16:45:52'),
(16, 'Alexander Ludwig', '2018-06-20 16:46:22', '2018-06-20 16:46:22'),
(17, 'Michael Hirst', '2018-06-20 16:46:29', '2018-06-20 16:46:29'),
(18, 'Paul Giamatti', '2018-06-20 17:47:02', '2018-06-20 17:47:02'),
(19, 'Damian Lewis', '2018-06-20 17:47:14', '2018-06-20 17:47:14'),
(21, 'David Levien', '2018-06-20 17:47:41', '2018-06-20 17:47:41'),
(22, 'Curtis Jackson', '2018-06-20 21:02:36', '2018-06-20 21:02:36'),
(23, 'Mike Miller', '2018-06-20 21:02:44', '2018-06-20 21:02:44'),
(24, 'Stephen Jackson', '2018-06-20 21:02:52', '2018-06-20 21:02:52'),
(25, 'Taurean Towers', '2018-06-20 21:03:10', '2018-06-20 21:03:10'),
(26, 'Steve Buscemi', '2018-06-20 21:07:23', '2018-06-20 21:07:23'),
(27, 'Kelly Macdonald', '2018-06-20 21:07:37', '2018-06-20 21:07:37'),
(28, 'Stephen Klarke', '2018-06-20 21:07:44', '2018-06-20 21:07:44'),
(29, 'Terence Winter', '2018-06-20 21:07:55', '2018-06-20 21:07:55'),
(30, 'Burkely Duffield', '2018-06-20 21:23:45', '2018-06-20 21:23:45'),
(31, 'Dilan Gwyn', '2018-06-20 21:23:53', '2018-06-20 21:23:53'),
(32, 'Jonathan Whitesell', '2018-06-20 21:24:06', '2018-06-20 21:24:06'),
(33, 'John Johnson', '2018-06-20 21:24:14', '2018-06-20 21:24:14');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `episode_id` int(10) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contains_spoiler` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_user_id_foreign` (`user_id`),
  KEY `comments_episode_id_foreign` (`episode_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `episode_id`, `description`, `contains_spoiler`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'Jako dobra epizoda!  Odusevljen sam specijalnim efektima!', 0, '2018-06-20 16:14:50', '2018-06-20 16:14:50'),
(2, 1, 5, 'Bolja od prethodne!', 0, '2018-06-20 16:27:04', '2018-06-20 16:27:04'),
(3, 1, 5, 'Kralj umire u ovoj epizodi', 1, '2018-06-20 16:27:13', '2018-06-20 16:27:13'),
(4, 1, 6, 'Samo jako', 0, '2018-06-20 16:30:30', '2018-06-20 16:30:30'),
(5, 1, 10, 'Najjaca epizoda do sad! Naprosto sam odusevljen!', 0, '2018-06-20 16:40:51', '2018-06-20 16:40:51'),
(6, 1, 19, 'Mnogo dobra epizoda! Odusevljen sam!', 0, '2018-06-20 17:12:50', '2018-06-20 17:12:50'),
(7, 1, 25, 'Jedva cekam da izađe!!', 0, '2018-06-20 21:01:04', '2018-06-20 21:01:04'),
(8, 1, 25, 'Nažalost, najbolji prijatelj Duha umire u prvoj epizodi!', 1, '2018-06-20 21:01:31', '2018-06-20 21:01:31'),
(9, 1, 28, 'Cuo sam da je jako zanimljiva serija!', 0, '2018-06-20 21:13:36', '2018-06-20 21:13:36'),
(10, 3, 4, 'Mnogo mi se svidja epizoda!!', 0, '2018-06-20 21:36:36', '2018-06-20 21:36:36'),
(11, 3, 4, 'Mnogo napeto!', 0, '2018-06-20 21:37:45', '2018-06-20 21:37:45'),
(12, 3, 4, 'Mislim da je ova epizoda najbolja do sada!', 0, '2018-06-20 21:37:59', '2018-06-20 21:37:59'),
(13, 3, 4, 'Jos jednom zelim da kazem da je epizoda predobra', 0, '2018-06-20 21:38:18', '2018-06-20 21:38:18'),
(14, 3, 6, 'Nije kao prethodna', 0, '2018-06-20 21:38:41', '2018-06-20 21:38:41'),
(15, 3, 6, 'mogla bi biti i bolja', 0, '2018-06-20 21:38:50', '2018-06-20 21:38:50'),
(16, 3, 6, 'Deneris ce da se uda u ovoj epizodi', 1, '2018-06-20 21:39:08', '2018-06-20 21:39:08');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

DROP TABLE IF EXISTS `contents`;
CREATE TABLE IF NOT EXISTS `contents` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trailer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `release_date` timestamp NULL DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `number_of_rates` int(11) NOT NULL DEFAULT '0',
  `rating` double(4,2) NOT NULL DEFAULT '0.00',
  `number_of_pictures` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `name`, `trailer`, `release_date`, `description`, `number_of_rates`, `rating`, `number_of_pictures`, `created_at`, `updated_at`) VALUES
(2, 'Igra Prestola', 'BpJYNVhGf1s', '2011-08-02 22:00:00', 'Najgledanija serija u istoriji kanala HBO i svetski televizijski fenomen, „Igra prestola“, i dalje je fantastičan hit. U sedam epizoda koje će biti prikazane ovog leta, sedma sezona će se usredsrediti na uzajamno približavanje vojski i stavova koje su horde obožavalaca očekivali godinama. Na samom početku sezone, Deneris Targarjen, u pratnji svoje vojske Neokaljanih i uz podršku dotračkih/Gvozdenrođenih saveznika i smrtonosnog trija zmajeva, konačno kreće u Vesteros sa Tirionom Lanisterom, novoimenovanom Kraljevom desnicom. Džon Snežni, upečatljivo oživljen u šestoj sezoni, očigledno je učvrstio vlast na Severu posle spektakularne pobede nad Remzijem Boltonom u „Bici kopiladi“ i vratio Vinterfel pod kontrolu kuće Stark. U Kraljevoj luci, Sersej Lanister, lišena preživelih naslednika, uspešno se dočepala Gvozdenog prestola pomoću divlje vatre kojom je spalila Vrhovnog vrapca i ostale neprijatelje u Belorovom obredištu. Ali dok ove i druge frakcije neumoljivo idu ka novim savezima ili (što je verovatnije) nasilnim sukobima, hladna senka još jedne apokaliptične pretnje u obliku vojske nemrtvih Belih hodača, od kojih se očekuje da će probiti Zid i napasti Jug, preti da naruši status kvo i poništi ishod ovih malih, previše ljudskih rivaliteta.', 3, 9.67, 3, '2018-06-20 15:43:56', '2018-06-21 07:12:01'),
(3, 'Sezona 1', 'BpJYNVhGf1s', '2013-05-07 22:00:00', 'Na početku priče gospodar Zimovrela lord Edard \"Ned\" Stark pogubljuje dezertera iz Noćne straže, vojska koja štiti ogroman zid od upada Divljana u 7 kraljevstava. Na putu do kuće nalaze na mrtvu vučicu koja je za sobom ostavila 6 štenaca malih jezovuka. NJegova deca Rob, Sansa, Arja, Bren i Rikon odlučuju da ih usvoje, ali pod uslovom da se sami staraju o njima. Najmanji vuk je pripao njegovom nezakonitom sinu DŽonu Snou. Kasnije te večeri, Ned saznaje da je njegov mentor i kraljeva desnica lord DŽon Erin umro. Nedov prijatelj iz detinjstva, kralj Robert Barateon dolazi u Zimovrel zajedno sa kraljicom Sersej od kuće Lanister, njihovom decom i kraljičinom braćom DŽejmi Lanister i Tirion Lanister. Robert predlaže Nedu da postane nova kraljeva desnica. Ned ne želi da napusti Zimovrel, ali ipak odlučuje da ode kada saznaje da su Lanisteri umešani u smrt DŽona Erina. Kasnije Nedov sedmogodišnji sin Bren dok se pentrao po zidinama Zimovrela, otkriva incest aferu između kraljice i njenog brata blizanca DŽejmija koji kada ga je primetio, gurnuo ga je sa prozora. Ned odlazi sa Arjom i Sansom u kraljevu luku, dok njegova žena Kejtlin ostaje u Zimovrelu sa Brenom, Rikonom i Robom. Rob postaje gospodar Zimovrela u očevom odsustvu.', 0, 0.00, 4, '2018-06-20 16:08:44', '2018-06-20 16:08:44'),
(4, 'Zima dolazi', 'BpJYNVhGf1s&t', '2013-08-06 22:00:00', 'Najgledanija serija u istoriji kanala HBO i svetski televizijski fenomen. U ovoj sezoni mnoštvo zanimljivih zapleta razvijaće se do svoje neizbežne, često krvave završnice. Posle šokantnih smrti Džofrija, Tivina, Oberina i Šije, nova sezona počinje snažnim vakuumom koji protagonisti širom Vesterosa i Esosa pokušavaju da ispune. U Crnom zamku, Džon Snežni pokušava da ispuni zahteve Noćne straže i novopridošlog Stanisa Barateona, koji se ponaša kao da je zakoniti kralj Vesterosa. U međuvremenu, Sersei očajnički pokušava da zadrži moć u Kraljevskoj luci među Tirelovima i sve moćnijom religioznom grupom koju predvodi zagonetni Vrabac, dok Džejmi odlazi na tajni zadatak. S druge strane Uskog mora, Arja traži starog prijatelja dok begunac Tirion pronalazi novi povod. Dok opasnost vreba u Mirinu, Deneris Targarjen saznaje da njena slaba opsada grada zahteva veće žrtve. U ovoj sezoni videćemo neke od najeksplozivnijih scena, dok „dolazak zime“ postaje zloslutniji nego ikada dosad. EP. 1 Sersei i Džejmi se privikavaju na svet bez Tivina. Lord Varis govori Tirionu o zaveri. Deni se suočava s novom pretnjom koja može ugroziti njenu vladavinu. Džon je rastrzan između dva kralja.', 2, 9.50, 4, '2018-06-20 16:14:10', '2018-06-21 07:11:27'),
(5, 'Kraljev put', 'Pdh78cDI4ws', '2014-03-04 23:00:00', 'Zasnovana na bestseler knjigama Džordža R. R. Martina, serija “Igra prestola” prati kraljice i kraljeve, vitezove i odmetnike, lažove i plemiće u njihovoj borbi za vlast. U zemlji u kojoj leta traju decenijama, a zime i po ceo život, nevolja je uvek tu. Od spletkaroškog juga, preko divljih istočnih zemalja, do zamrznutog severa, gde ledeni zid od 240 metara štiti kraljevstvo od mračnih sila koje vrebaju spolja, moćne porodice upletene su u smrtonosnu igru mačke i miša za kontrolu nad Sedam kraljevstava Vesteroa, a borba za Gvozdeni tron je počela. Epizoda 2: Nakn krvave čistke u prestonici, Tirion kori Sersei jer je udaljila kraljeve podanike. Na putu za sever, Arja deli tajnu sa Džendrijem, novajlijom Noćne Straže. Dok su zalihe na izmaku, jedan od Deninih izvidnika se vraća sa novostima o njihovom položaju. Nakon što je proveo devet godina u zatočeništvu kod Starkovih, Teon Grejdžoj se vraća kod svog oca Belona, koji želi da obnovi nekadašnje kraljevstvo Gvozdenih Ostrva. Davos nagovara gusara Saladora Sana da udruži snage sa Stanisom i Melisandrom u pomorskom napadu na Kraljevu Luku.', 2, 7.50, 4, '2018-06-20 16:26:49', '2018-06-21 07:11:39'),
(6, 'Gospodar Snou', '5twFMZEvrdA', '2014-09-09 22:00:00', 'Od spletkaroškog juga i divljih zemalja istoka, do zaleđenog severa i drevnog Zida koji štiti carstvo od tmine, dve moćne porodice uvučene su u smrtonosnu igru mačke i miša u borbi za kontrolu nad Sedam kraljevstava Vesterosa. I dok izdaja, požuda, intrige i natprirodne sile tresu sva četiri ugla kraljevstava, njihova krvava borba za Gvozdeni tron imaće nepredvidive i dalekosežne posledice. Zasnovana na bestseler serijalu knjiga fantastike „Pesme leda i vatre“, Džordža R. R. Martina, nova serija „Igra prestola“, ovog proleća, ekskluzivno na HBO, startuje svoju sezonu od deset epizoda. Epizoda 3: Stigavši u Kraljevu Luku nakon dugog putovanja, Ned je neprijatno iznenađen kada od novih savetnika saznaje za rasipništvo dvora. U Crnom Zamku, Džon Snežni ostavlja utisak na Tiriona iskoristivši neiskustvo ostalih regruta. Naslućujući da je Brenov pad maslo Lanistera, Kejtlin tajno sledi svog muža u Kraljevu Luku, gde je presreće Petir Beliš, poznatiji kao Maloprstić, dugogodišnji prepredeni saveznik i vlasnik bordela. Sersei i Džejmi razmišljaju o posledicama Brenovog oporavka; Arja uči da rukuje mačem. Na putu za Ves Dotrak, Deneris se sukobljava sa Viserisom.', 2, 8.50, 4, '2018-06-20 16:30:17', '2018-06-20 21:39:16'),
(7, 'Sezona 2', 'XuKfFzk1uQs', '2014-12-23 23:00:00', 'U zemlji u kojoj leta traju decenijama, a zime i po ceo život, nevolja je uvek tu. Od spletkaroškog juga, preko divljih istočnih zemalja, do zamrznutog severa, gde ledeni zid od 240 metara štiti kraljevstvo od mračnih sila koje vrebaju spolja, moćne porodice upletene su u smrtonosnu igru mačke i miša za kontrolu nad Sedam kraljevstava Vesteroa, a borba za Gvozdeni tron je počela. Epizoda 1: Dok Rob Stark i njegova severnjačka vojska nastavljaju rat protiv Lanister, Tirion stiže u Kraljevu Luku da bi savetovao Džofrija i obuzdao hirove mladog kralja. Na Zmajkamenu, Stanis Barateon u potaji kuje invaziju radi preuzimanja prestola svog pokojnog brata, udruživši se sa vatrenom Melisandrom, neobičnom sveštenicom još neobičnijeg boga. S druge strane mora, Deneris, njena tri mlada zmaja i kalasar, pešače kroz Crvenu pustinju u potrazi za saveznicima i vodom. Na severu, Bren upravlja zapuštenim Zimovrelom, dok Džon Snežni i Noćna Straža moraju da traže sklonište od opasnih Divljana s one strane Zida.', 0, 0.00, 4, '2018-06-20 16:33:09', '2018-06-20 16:33:09'),
(8, 'Sever pamti', 'bXdMcWi8Tvg', '2015-01-04 23:00:00', 'U zemlji u kojoj leta traju decenijama, a zime i po ceo život, nevolja je uvek tu. Od spletkaroškog juga, preko divljih istočnih zemalja, do zamrznutog severa, gde ledeni zid od 240 metara štiti kraljevstvo od mračnih sila koje vrebaju spolja, moćne porodice upletene su u smrtonosnu igru mačke i miša za kontrolu nad Sedam kraljevstava Vesteroa, a borba za Gvozdeni tron je počela. Epizoda 1: Dok Rob Stark i njegova severnjačka vojska nastavljaju rat protiv Lanister, Tirion stiže u Kraljevu Luku da bi savetovao Džofrija i obuzdao hirove mladog kralja. Na Zmajkamenu, Stanis Barateon u potaji kuje invaziju radi preuzimanja prestola svog pokojnog brata, udruživši se sa vatrenom Melisandrom, neobičnom sveštenicom još neobičnijeg boga. S druge strane mora, Deneris, njena tri mlada zmaja i kalasar, pešače kroz Crvenu pustinju u potrazi za saveznicima i vodom. Na severu, Bren upravlja zapuštenim Zimovrelom, dok Džon Snežni i Noćna Straža moraju da traže sklonište od opasnih Divljana s one strane Zida.', 0, 0.00, 4, '2018-06-20 16:35:12', '2018-06-20 16:35:12'),
(9, 'Zemlje noci', '8zRCVVKwLXw', '2015-02-04 23:00:00', 'Od spletkaroškog juga, preko divljih istočnih zemalja, do zamrznutog severa, gde ledeni zid od 240 metara štiti kraljevstvo od mračnih sila koje vrebaju spolja, moćne porodice upletene su u smrtonosnu igru mačke i miša za kontrolu nad Sedam kraljevstava Vesteroa, a borba za Gvozdeni tron je počela. Epizoda 2: Nakn krvave čistke u prestonici, Tirion kori Sersei jer je udaljila kraljeve podanike. Na putu za sever, Arja deli tajnu sa Džendrijem, novajlijom Noćne Straže. Dok su zalihe na izmaku, jedan od Deninih izvidnika se vraća sa novostima o njihovom položaju. Nakon što je proveo devet godina u zatočeništvu kod Starkovih, Teon Grejdžoj se vraća kod svog oca Belona, koji želi da obnovi nekadašnje kraljevstvo Gvozdenih Ostrva. Davos nagovara gusara Saladora Sana da udruži snage sa Stanisom i Melisandrom u pomorskom napadu na Kraljevu Luku.', 1, 5.00, 4, '2018-06-20 16:37:27', '2018-06-20 16:37:34'),
(10, 'Sto je mrtvo ne moze umreti', 'SKnvr5VJ5Uc', '2015-03-03 23:00:00', 'U zemlji u kojoj leta traju decenijama, a zime i po ceo život, nevolja je uvek tu. Od spletkaroškog juga, preko divljih istočnih zemalja, do zamrznutog severa, gde ledeni zid od 240 metara štiti kraljevstvo od mračnih sila koje vrebaju spolja, moćne porodice upletene su u smrtonosnu igru mačke i miša za kontrolu nad Sedam kraljevstava Vesteroa, a borba za Gvozdeni tron je počela. Epizoda 3: U Crvenoj Tvrđavi, Tirion planira tri saveza putem ugovorenog braka. Kejtlin stiže na Zmajkamen ne bi li i sama sklopila savez. Ali kralj Renli, njegova žena Margeri i njen brat Loras Tirel imaju drugačije planove. U Zimovrelu, Luvin pokušava da odgonetne Brenove snove.', 1, 9.00, 4, '2018-06-20 16:40:23', '2018-06-20 16:40:27'),
(11, 'Vikinzi', 'xdm7Z3TQhDg', '2016-11-30 23:00:00', 'U davna vremena, odzvanjaju udarci čelika o čelik i susreću se mit, istorija i fikcija… Vikingdom. Delimično zasnovan na vinikškim legendama i epskim pesmama koje su Vikinzi ostavili, uz kreativnu interpretaciju, Vikingdom je fantazija, akciona avantura o zaboravljenom kralju Eiriku koji ima nemoguć zadatak da pobedi Tora, boga groma. Tor ima zadatak da sakupi ključne drevne relikvije – “Mjolnir” – svoj čekić iz Valhale, “Ogrlicu Marije Magdalene” iz Mitgarda i “Rog” iz Halhajma. Ovo mora biti izvršeno pre Krvavog pomračenja, koje se dešava jednom u 800 godina, a ukoliko ne bude, paganski vikinški bogovi više nikada neće moći da poraze i vladaju čovečanstvom. Samo jedan čovek može da ga zaustavi… Eirik, probuđen iz mrtvih.', 2, 6.50, 3, '2018-06-20 16:45:09', '2018-06-21 07:12:07'),
(12, 'Sezona 1', 'f5av6OqFwz0', '2016-01-12 23:00:00', 'Druga sezona prepuna je spektakularnih bitki, jer iako je Ragnar siguran u svoju moć više nego ikad, još uvek u vazduhu vise sukobi koji su započeti u finalu druge sezone i čekaju svoj završetak.\r\n\r\nVikinzi (Vikings, 2013) je kanadsko-irska istorijska televizijska drama, čiji je tvorac Majkl Hirst za televizijski kanal \"Histori\".\r\nSerija je inspirisana pričama o vikingu Ragnaru Lodbroku, jednom od najpoznatijih nordijskih mitoloških heroja poznatom po pustošenju Engleske i Francuske. Ona predstavlja Ragnara kao nekadašnjeg farmera, kao prvog koji se proslavio uspešnim pljačkanjem Engleske uz podršku saboraca, svog brata Roloa, sina Bjorna i supruge, ratnice Lagerte i princeze Aslag.', 0, 0.00, 4, '2018-06-20 16:56:06', '2018-06-20 16:56:32'),
(13, 'Lavlje srce', 'JWOzAUNpeGA', '2017-06-05 22:00:00', 'Glumačkoj ekipi koju predvode Travis Fimel i Ketrin Vinik, pridružiće se Piter Franzen, koji će tumačiti ulogu kralja Harolda, Jasper Pekonen, u ulozi Halfdana, Haroldovog brata i Dajen Don, koja će glumiti Jidu, čiji je lik potpuno drugačiji od onog što smo do sada mogli da vidimo u seriji, a to upravo fascinira Ragnara.\r\n\r\nVikinzi (Vikings, 2013) je kanadsko-irska istorijska televizijska drama, čiji je tvorac Majkl Hirst za televizijski kanal \"Histori\".\r\n\r\nKada je Histori kanal počeo da emituje seriju „Vikinzi“ nisu očekivali da će toliki broj žena imati za fanove. Ali možda žene nisu privukli pohodi na Englesku i krvave bitke. U pitanju su glavni glumci serije, koji svojim talentom ali i stasom kradu ženska srca.', 0, 0.00, 4, '2018-06-20 17:01:05', '2018-06-20 17:01:05'),
(14, 'Borba za kralja', '3DMQsGfBW1s', '2016-11-24 23:00:00', 'Australijski tridesetpetogodišnji  glumac je karijeru započeo kao model za Kevin Klajn, ali nije ni sanjao da će biti poznat kao kralj Ragnar Lotbrok. Njegov izgled krase električno plave oči, telo modela a u seriji i stav hladnog zabavnog i radoznalog ratnika.\r\n\r\nTrevisa je u svet mode dovelo bebi lice i dobro telo. Pogledajte kako je on izgledao uperiodu pre \"Vikinga\". Nama se ipak dopada njegova kasnija faza, a vama?\r\n\r\nKlajv je poznati tridesettrogodišnji glumac rođen u britanskoj ratnoj bazi u Holivudu. U seriji on glumi brata kralja Ragnara Lotbroka, Roloa.\r\n\r\nNjegovog lika život nije mazio i sve žene u koje se zaljubi na kraju izgubi. Vešt je ratnik i njegov markantan izgled, pomešan sa impulsivnim ponašanjem je pridobio većinu ženske publike.', 0, 0.00, 4, '2018-06-20 17:03:44', '2018-06-20 17:03:44'),
(15, 'Sezona 2', '-KHVr_Eg8qA', '2017-06-19 22:00:00', 'Druga sezona se završava Ragnarovim pohodom na Pariz i povratkom u Kategat. Međutim, kralj je veoma bolestan, a svi su uplašeni kako će se stvari dalje razvijati. Da li će ga naslediti Bjorn, Aslaug ili neko drugi? Po svemu sudeći Ragnar neće morati da se izbori samo sa svojom bolesti, već i sa mnogim zaverama koje se kuju protiv njega...\r\n\r\nGlumačkoj ekipi koju predvode Travis Fimel i Ketrin Vinik, pridružiće se Piter Franzen, koji će tumačiti ulogu kralja Harolda, Jasper Pekonen, u ulozi Halfdana, Haroldovog brata i Dajen Don, koja će glumiti Jidu, čiji je lik potpuno drugačiji od onog što smo do sada mogli da vidimo u seriji, a to upravo fascinira Ragnara.\r\n\r\nVikinzi (Vikings, 2013) je kanadsko-irska istorijska televizijska drama, čiji je tvorac Majkl Hirst za televizijski kanal \"Histori\".', 0, 0.00, 1, '2018-06-20 17:06:08', '2018-06-20 17:06:08'),
(17, 'Bratov rat', 'FDisCTeRQwI', NULL, 'Serija je inspirisana pričama o vikingu Ragnaru Lodbroku, jednom od najpoznatijih nordijskih mitoloških heroja poznatom po pustošenju Engleske i Francuske. Ona predstavlja Ragnara kao nekadašnjeg farmera, kao prvog koji se proslavio uspešnim pljačkanjem Engleske uz podršku saboraca, svog brata Roloa, sina Bjorna i supruga, ratnice Lagerte i princeze Aslag.\r\nGlavne uloge tumače: Travis Fimel, Klajv Standen, Džeselin Gilsaj, Džeferson Hol, Mod Herst, Torbjon Har, Ajven Kej...', 0, 0.00, 4, '2018-06-20 17:08:24', '2018-06-20 17:08:24'),
(19, 'Invazija', 'RdK5hJPH3Ao', '2017-11-09 23:00:00', 'U drugoj epizodi se glumačkoj ekipi priključuje glumac iz serije \"Tjudori\" Džonatan Ris Mejers kao biskup Hemund, a za njegovu ulogu se kaže da će biti velika i da će promeniti mnoge stvari u seriji.\r\nNa osnovu trejlera možemo zaključiti da su se Ajvar i Lagerta nameračili da prošire svoju moć, a takođe vidimo i Flokija, Bjorna, avanture u pustiji, olujna mora i vulkan!\r\n\r\nFanovi, radujte se! \"Vikinzi\" se vraćaju da nas (na dobar način) stresiraju u drugoj sezoni, a \"History\" je objavio trejler i datum kada možemo očekivati nove epizode.', 1, 10.00, 4, '2018-06-20 17:12:35', '2018-06-20 21:36:06'),
(20, 'Milijarde', 'cDpWdeOfsF8', '2016-11-08 23:00:00', 'Kompleksna drama o ulozi politike u svetu njujorških visokih finansija. Izvanredni magnat hedž fondova, Bobi Eks Ekselrod, i drski državni tužilac, Čak Rouds, igraju opasnu igru sa milijarderskim ulozima, u kojoj pobednik odnosi sve.\r\nDobitnici Emija i Zlatnog globusa, Pol Džijamati i Dejmijan Luis, glume u ovoj zamršenoj drami o ulozi politike u svetu njujorških visokih finansija. Putevi promućurnog i prepredenog državnog tužioca, Čaka Roudsa (Džijamati), i izvanrednog i ambicioznog magnata hedž fondova, Bobija Eksa Ekselroda (Luis), uskoro će se ukrstiti, a svaki od njih koristi svu svoju pamet, moć i uticaj da nadmudri onog drugog. U ovoj provokativnoj seriji, ulozi se mere milijardama. Epizoda 2. Eks uvodi rigorozne mere da bi pripremio kompaniju za istragu državnog tužioca. Kad Vendi počne da preispituje Eksove metode, on je primorava da dokaže svoju odanost. Čakova istraga je privremeno obustavljena jer mora da usmeri resurse u slučaj protiv Eksovog suparnika, milijardera Stivena Berča. Hol, Eksov posrednik, pronalazi krticu unutar kancelarije državnog tužioca, dok Eks povlači agresivan potez pod paravanom humanitarne pomoći da bi poravnao stare račune.', 3, 6.67, 8, '2018-06-20 17:46:47', '2018-06-21 07:11:45'),
(21, 'Sezona 1', '3ZrQkEDRbxk', '2017-02-04 23:00:00', 'Složena drama o politici moći u svijetu njujorških visokih financija. Briljantni titan hedge fondova Bobby „Axe“ Axelrod i drski ovjetnik Chuck Rhoades igraju opasnu igru u kojoj pobjednik odnosi sve, a ulozi se broje u milijardama.\r\nDobitnici Emmyja® i Zlatnoga globusa® Paul Giamatti i Damian Lewis zvijezde su ove složene drame o politici moći u svijetu njujorških visokih financija. Lukavi i snalažljivi državni odvjetnik Chuck Rhoades (Giamatti) i briljantni, ambiciozni kralj hedge fondova Bobby „Axe“ Axelrod (Lewis) nalaze se na putu k eksplozivnoj koliziji, a svaki rabi sve svoje značajne intelektualne vještine i utjecaj kako bi nadmašio onog drugog. U ovoj pravodobnoj, provokativnoj seriji ulozi se broje u milijardama. Složena drama o politici moći u svijetu njujorških visokih financija. Briljantni titan hedge fondova Bobby „Axe“ Axelrod i drski ovjetnik Chuck Rhoades igraju opasnu igru u kojoj pobjednik odnosi sve, a ulozi se broje u milijardama.\r\nDobitnici Emmyja® i Zlatnoga globusa® Paul Giamatti i Damian Lewis zvijezde su ove složene drame o politici moći u svijetu njujorških visokih financija. Lukavi i snalažljivi državni odvjetnik Chuck Rhoades (Giamatti) i briljantni, ambiciozni kralj hedge fondova Bobby „Axe“ Axelrod (Lewis) nalaze se na putu k eksplozivnoj koliziji, a svaki rabi sve svoje značajne intelektualne vještine i utjecaj kako bi nadmašio onog drugog. U ovoj pravodobnoj, provokativnoj seriji ulozi se broje u milijardama.', 2, 8.00, 5, '2018-06-20 18:29:56', '2018-06-21 07:11:51'),
(22, 'Pilot', 'KBpeYD1gneY', '2017-03-29 22:00:00', 'Lukavi i snalažljivi državni odvjetnik Chuck Rhoades (Giamatti) i briljantni, ambiciozni kralj hedge fondova Bobby „Axe“ Axelrod (Lewis) nalaze se na putu k eksplozivnoj koliziji, a svaki rabi sve svoje značajne intelektualne vještine i utjecaj kako bi nadmašio onog drugog. U ovoj pravodobnoj, provokativnoj seriji ulozi se broje u milijardama. EPIZODA 1. Chuck Rhoades, moćni državni odvjetnik njujorškog Južnog distrikta, obaviješten je o slučaju insajderske trgovine povezane s milijarderskim hedge fondom Bobbyja „Axea“ Axelroda. Iako bi to mogao biti Chuckov slučaj karijere, on mora biti oprezan jer je njegova supruga Wendy „performance coach“ u tvrtki „Axe Capital“ i Axeova ključna povjerenica. Ali Axeova skupa kupnja daje Chucku potrebnu priliku pokrenuvši igru mačke i miša u kojoj su ulozi visoki i iznimno osobni.', 1, 7.00, 5, '2018-06-20 19:00:46', '2018-06-21 03:58:49'),
(23, 'Moć', 'w7fuOkF74Zw', '2018-08-23 22:00:00', 'Malo je serija koje u današnje vreme doguraju do broja sezona do kojih je dogurala kriminalistička drama \"Moć\" (Power). \r\n\r\nSve dostupne sezone su od početka prikazivanja gledaoci mogli da gledaju u okviru Pickbox paketa na mts TV, a izvršni producent serije Fifti Sent je nedavno izjavio da veruje da će serija doživeti ukupno 7 sezona. Što znači još veoma mnogo zapleta i događanja u svetu kriminalnog narko miljea u kom niko nikome ne može da veruje, a svako svakome zabija nož u leđa.\r\n\r\nAko idete u korak s novim epizodama, znaćete da vas danas 4.9. očekuje finale 4. sezone u kojoj ćemo saznati šta će se dogoditi Duhu i njegovoj porodici. Ali ako sudimo po spojlerima koje smo pročitali, u svetu njujorške narko scene će doći do velikog zaokreta, a porodica Sent Patrik će biti\r\nposebno pogođena zbog nevolje koja će ih sustići.\r\n\r\nUkoliko još niste gledali seriju, ukratko možemo da kažemo da je „Moć“ krimi drama smeštena u dva oprečna sveta: glamuroznu njujoršku klupsku scenu i brutalnu trgovinu drogom u koju su uključena i ubistva iz osvete. Seriju prate milioni ljudi širom sveta.', 1, 1.00, 4, '2018-06-20 20:53:42', '2018-06-20 21:03:31'),
(24, 'Sezona 1', '0bbwp6feNwM', '2018-12-04 23:00:00', 'Serija Moć (Power) je kriminalistička drama smeštena u dva različita sveta, glamuroznu njujoršku klupsku scenu i brutalni svet trgovine drogom. Džejms St. Patrik (James St. Patrick), zvani Duh (Ghost), ima sve, prelepu suprugu, penthaus na Menhetnu i njujorški noćni klub. Njegov klub, Truth, mesto za elitu, okuplja slavne face Njujorka. Dok mu uspeh raste, rastu i Džejmsovi planovi da stvori carstvo. Međutim Truth zapravo krije ružnu stvarnost, on je paravan za Džejmsovu mrežu prodaje droge. I dok ga privlači zamisao o legalnom poslovanju, sve do čega mu je stalo dolazi u opasnost.\r\n\r\nU čast Duhu, liku koga uprkos svemu volimo, prisetićemo se samo nekih fikcijskih TV likova koji su takođe živeli ovakvim životom. Na primer, Volter Vajt, ćaknuti profesor hemije koji se upustio u proizvodnju droge i ubio sigurno više ljudi nego Duh, potom Dekster Morgan, forenzičar koji je tajno u isto vreme serijski ubica koji napada druge ubice koje su izbegle ruku pravde, i Bafi Samers, srednjoškolka koja se u tajnosti sve vreme bori s vampirima, demonima i ostalim silama tame.', 1, 9.00, 4, '2018-06-20 20:57:00', '2018-06-20 20:57:05'),
(25, 'Pilot', 'yWCpdRKh-bU', '2018-10-30 23:00:00', 'Prva epizoda \"Moći\" specifična je po pitanju zapleta jer je započela pravo u glavu - gledamo medijski propraćeno hapšenje Duha zbog ubistva FBI agenta Grega Noksa, čime se u potpunosti poljulja Duhovo privatno i poslovno carstvo. Duh zločin nije počinio, ali ima mutnu prošlost i zato ne može da dokaže nevinost pred policijom, medijima, ali ni pred samim sobom - osobom koja želi da se izvuče iz sveta koji nosi prefiks „ilegalno“. Ne pomaže previše ni to što je Duh izgubio poverenje bliskih ljudi poput Tomija, Anđele, ali i supruge Taše.', 0, 0.00, 4, '2018-06-20 21:00:43', '2018-06-20 21:00:43'),
(26, 'Carstvo poroka', 'e6z71l6HQwQ', '2018-11-14 23:00:00', '2010 \r\nkrimić, drama\r\nSmeštena u 1920-e i početak prohibicije, ova raskošna HBO dramska serija govori o životu i vremenima Nakija Tomsona, nespornog vladara Atlantik Sitija, koji je istovremeno bio i političar i gangster.\r\nNova dramska serija stiže nam od Terensa Vintersa, dobitnika nagrade Emi za seriju „Sopranovi“ i dobitnika Oskara Martina Skorsezea. Smeštena u 1920-e i početak prohibicije, ova raskošna HBO dramska serija govori o životu i vremenu Nakija Tomsona, nespornog vladara Atlantik Sitija, koji je istovremeno bio i političar i gangster. Zbog svoje blizine okeanu, Atlantik Siti je bio glavno čvorište krijumčara alkohola, uključujući i Arnolda Rotštajna, Lakija Lućana i Ala Kaponea – a Naki je radio sa svima njima.', 0, 0.00, 4, '2018-06-20 21:07:04', '2018-06-20 21:31:35'),
(27, 'Sezona 1', 'qRpqQsdU-dg', '2018-12-05 23:00:00', 'Terens Vinter, koji je dobio nagradu Emi za „Sopranove“ i reditelj nagrađen Oskarom, Martin Skorseze, donose nam raskošnu dramu smeštenu u osvit prohibicije, kad je prodaja alkohola bila nezakonita širom Sjedinjenih Američkih Država. Na plaži u južnom Nju Džerziju smešten je Atlantik Siti, spektakularno odmaralište u kome pravila ne važe. Masivni hoteli nanizani su duž čuvene Promenade, koja vrvi od noćnih klubova, zabavnih parkova i zabave koja parira Brodveju. Neosporni vladar bio je gradski rizničar, Naki Tompson (Stiv Bušemi), politički maher i diler iz senke, koji je ujedno bio i političar i gangster. Zbog blizine okeana, Atlantik Siti je bio glavno stecište proizvođača ruma, uključujući Arnolda Rotstajna, Lakija Lučana i Al Kaponea – a Naki je poslovao sa svima njima.', 0, 0.00, 3, '2018-06-20 21:08:47', '2018-06-20 21:10:16'),
(28, 'Carstvo poroka', '0h_ULVqCP0s', '2019-01-02 23:00:00', 'Januar 1920. Neposredno uoči prohibicije, gradski blagajnik Atlantik Sitija Naki Tompson (Stiv Baskemi), osuđuje alkohol na sastanku Ženske Lige za Umerenost, gde ga primećuje Margaret Šroder (Keli Makdonald), lepa i trudna domaćica, koja mu se obraća sa molbom da pomogne njenom nasilnom mužu Hansu (Džo Sikora) da nađe posao. Kasnije iste večeri, dvolični Naki saopštava svojim šefovima odeljenja za mogućnost da dođu do ogromne zarade prodajom krijumčarenog alkohola. Neposredno pred ponoć u „Babet Saper Klabu“, on uverava Džimija Darmodija (Majkl Pit), veterana koji se nedavno vratio iz I svetskog rata, da će njegovo imenovanje za desnu ruku novog šefa petog odeljenja Pedija Rajana (Samjuel Tejlor) dovesti do većih stvari. Džimi, opet, ima mnogo veće ambicije, pa zato stvara savez koji može imati teške posledice i po njega i po Nakija. 1. deo: Januar, 1920.', 0, 0.00, 4, '2018-06-20 21:12:45', '2018-06-20 21:12:45'),
(29, 'S one strane', 'X8e0FkjzSkI', '2018-08-03 22:00:00', 'Holden, mladić koji se budi iz kome posle 12 godina, otkriva nove sposobnosti zbog kojih postaje deo opasne zavere. Sada Holden mora da pronađe odgovor na jedno pitanje: Zašto mu se ovo desilo?\r\nHolden Metjuz, mladić koji se budi iz kome posle 12 godina, otkriva nove astrofizičke sposobnosti zbog kojih postaje deo opasne zavere. Sada Holden mora da otkrije šta mu se desilo u proteklih dvanaest godina i kako da živi u svetu koji se značajno promenio dok je on bio u komi. Međutim, najveće pitanje od svih je: Zašto mu se ovo desilo? Dok Holden pokušava da se prilagodi životu odrasle osobe, misteriozna žena po imenu Vila upozorava ga da ne sme da veruje ljudima oko sebe.', 0, 0.00, 4, '2018-06-20 21:23:35', '2018-06-20 21:23:35'),
(30, 'Sezona 1', 'v74Hg8sIq0M', '2018-09-19 22:00:00', 'Holden, mladić koji se budi iz kome posle 12 godina, otkriva nove sposobnosti zbog kojih postaje deo opasne zavere. Sada Holden mora da pronađe odgovor na jedno pitanje: Zašto mu se ovo desilo?\r\nHolden Metjuz, mladić koji se budi iz kome posle 12 godina, otkriva nove astrofizičke sposobnosti zbog kojih postaje deo opasne zavere. Sada Holden mora da otkrije šta mu se desilo u proteklih dvanaest godina i kako da živi u svetu koji se značajno promenio dok je on bio u komi. Međutim, najveće pitanje od svih je: Zašto mu se ovo desilo? Dok Holden pokušava da se prilagodi životu odrasle osobe, misteriozna žena po imenu Vila upozorava ga da ne sme da veruje ljudima oko sebe.', 0, 0.00, 4, '2018-06-20 21:27:33', '2018-06-20 21:27:33'),
(31, 'Pilot', 'v74Hg8sIq0M', '2018-11-29 23:00:00', 'Holden, mladić koji se budi iz kome posle 12 godina, otkriva nove sposobnosti zbog kojih postaje deo opasne zavere. Sada Holden mora da pronađe odgovor na jedno pitanje: Zašto mu se ovo desilo?\r\nHolden Metjuz, mladić koji se budi iz kome posle 12 godina, otkriva nove astrofizičke sposobnosti zbog kojih postaje deo opasne zavere. Sada Holden mora da otkrije šta mu se desilo u proteklih dvanaest godina i kako da živi u svetu koji se značajno promenio dok je on bio u komi. Međutim, najveće pitanje od svih je: Zašto mu se ovo desilo? Dok Holden pokušava da se prilagodi životu odrasle osobe, misteriozna žena po imenu Vila upozorava ga da ne sme da veruje ljudima oko sebe.', 0, 0.00, 4, '2018-06-20 21:30:26', '2018-06-20 21:30:26');

-- --------------------------------------------------------

--
-- Table structure for table `directings`
--

DROP TABLE IF EXISTS `directings`;
CREATE TABLE IF NOT EXISTS `directings` (
  `director_id` int(10) UNSIGNED NOT NULL,
  `tvshow_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`director_id`,`tvshow_id`),
  KEY `directings_tvshow_id_foreign` (`tvshow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `directings`
--

INSERT INTO `directings` (`director_id`, `tvshow_id`, `created_at`, `updated_at`) VALUES
(12, 2, '2018-06-20 15:46:11', '2018-06-20 15:46:11'),
(13, 2, '2018-06-20 15:46:16', '2018-06-20 15:46:16'),
(17, 11, '2018-06-20 16:46:30', '2018-06-20 16:46:30'),
(21, 20, '2018-06-20 17:47:41', '2018-06-20 17:47:41'),
(25, 23, '2018-06-20 21:03:11', '2018-06-20 21:03:11'),
(29, 26, '2018-06-20 21:07:55', '2018-06-20 21:07:55'),
(33, 29, '2018-06-20 21:24:15', '2018-06-20 21:24:15');

-- --------------------------------------------------------

--
-- Table structure for table `directors`
--

DROP TABLE IF EXISTS `directors`;
CREATE TABLE IF NOT EXISTS `directors` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `directors`
--

INSERT INTO `directors` (`category_id`, `created_at`, `updated_at`) VALUES
(12, '2018-06-20 15:46:10', '2018-06-20 15:46:10'),
(13, '2018-06-20 15:46:16', '2018-06-20 15:46:16'),
(17, '2018-06-20 16:46:29', '2018-06-20 16:46:29'),
(21, '2018-06-20 17:47:41', '2018-06-20 17:47:41'),
(25, '2018-06-20 21:03:11', '2018-06-20 21:03:11'),
(29, '2018-06-20 21:07:55', '2018-06-20 21:07:55'),
(33, '2018-06-20 21:24:15', '2018-06-20 21:24:15');

-- --------------------------------------------------------

--
-- Table structure for table `episodes`
--

DROP TABLE IF EXISTS `episodes`;
CREATE TABLE IF NOT EXISTS `episodes` (
  `content_id` int(10) UNSIGNED NOT NULL,
  `season_id` int(10) UNSIGNED NOT NULL,
  `length` int(10) UNSIGNED DEFAULT NULL,
  `episode_number` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`content_id`),
  UNIQUE KEY `episodes_season_id_episode_number_unique` (`season_id`,`episode_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `episodes`
--

INSERT INTO `episodes` (`content_id`, `season_id`, `length`, `episode_number`, `created_at`, `updated_at`) VALUES
(4, 3, 52, 1, '2018-06-20 16:14:10', '2018-06-20 16:14:10'),
(5, 3, 47, 2, '2018-06-20 16:26:49', '2018-06-20 16:26:49'),
(6, 3, 48, 3, '2018-06-20 16:30:17', '2018-06-20 16:30:17'),
(8, 7, 45, 1, '2018-06-20 16:35:12', '2018-06-20 16:35:12'),
(9, 7, 51, 2, '2018-06-20 16:37:27', '2018-06-20 16:37:27'),
(10, 7, 44, 3, '2018-06-20 16:40:23', '2018-06-20 16:40:23'),
(13, 12, 51, 1, '2018-06-20 17:01:06', '2018-06-20 17:01:06'),
(14, 12, 44, 2, '2018-06-20 17:03:44', '2018-06-20 17:03:44'),
(17, 15, 55, 1, '2018-06-20 17:08:24', '2018-06-20 17:08:24'),
(19, 15, 55, 2, '2018-06-20 17:12:35', '2018-06-20 17:12:35'),
(22, 21, 60, 1, '2018-06-20 19:00:46', '2018-06-20 19:00:46'),
(25, 24, 47, 1, '2018-06-20 21:00:43', '2018-06-20 21:00:43'),
(28, 27, 44, 1, '2018-06-20 21:12:45', '2018-06-20 21:12:45'),
(31, 30, 44, 1, '2018-06-20 21:30:26', '2018-06-20 21:30:26');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

DROP TABLE IF EXISTS `genres`;
CREATE TABLE IF NOT EXISTS `genres` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`category_id`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL),
(2, NULL, NULL),
(3, NULL, NULL),
(4, NULL, NULL),
(5, NULL, NULL),
(6, NULL, NULL),
(7, NULL, NULL),
(8, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(127, '2014_10_12_000000_create_users_table', 1),
(128, '2014_10_12_100000_create_password_resets_table', 1),
(129, '2018_05_30_135102_create_contents_table', 1),
(130, '2018_05_30_140235_create_tvshows_table', 1),
(131, '2018_05_30_144611_create_seasons_table', 1),
(132, '2018_05_30_145519_create_episodes_table', 1),
(133, '2018_05_30_150425_create_watched_seasons_table', 1),
(134, '2018_05_30_151652_create_watched_episodes_table', 1),
(135, '2018_05_30_152549_create_categories_table', 1),
(136, '2018_05_30_152703_create_genres_table', 1),
(137, '2018_05_30_152941_create_actors_table', 1),
(138, '2018_05_30_153025_create_directors_table', 1),
(139, '2018_05_30_153316_create_pictures_table', 1),
(140, '2018_05_30_154731_create_comments_table', 1),
(141, '2018_05_30_155202_create_actings_table', 1),
(142, '2018_05_30_155637_create_ratings_table', 1),
(143, '2018_05_30_161021_create_type_ofs_table', 1),
(144, '2018_05_30_161634_create_directings_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

DROP TABLE IF EXISTS `pictures`;
CREATE TABLE IF NOT EXISTS `pictures` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `content_id` int(10) UNSIGNED NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `main_picture` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pictures_content_id_foreign` (`content_id`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`id`, `content_id`, `path`, `main_picture`, `created_at`, `updated_at`) VALUES
(4, 2, '2-4.jpg', 0, '2018-06-20 15:43:56', '2018-06-20 15:43:56'),
(5, 2, '2-5.jpg', 0, '2018-06-20 15:43:56', '2018-06-20 15:43:56'),
(6, 2, '2-6.jpg', 0, '2018-06-20 15:43:56', '2018-06-20 15:43:56'),
(7, 2, '2-7.jpg', 1, '2018-06-20 15:50:33', '2018-06-20 15:50:33'),
(8, 3, '3-8.jpg', 1, '2018-06-20 16:08:45', '2018-06-20 16:08:45'),
(9, 3, '3-9.jpg', 0, '2018-06-20 16:08:45', '2018-06-20 16:08:45'),
(10, 3, '3-10.jpg', 0, '2018-06-20 16:08:45', '2018-06-20 16:08:45'),
(11, 3, '3-11.jpg', 0, '2018-06-20 16:08:45', '2018-06-20 16:08:45'),
(12, 4, '4-12.jpg', 1, '2018-06-20 16:14:10', '2018-06-20 16:14:10'),
(13, 4, '4-13.jpg', 0, '2018-06-20 16:14:10', '2018-06-20 16:14:10'),
(14, 4, '4-14.jpg', 0, '2018-06-20 16:14:10', '2018-06-20 16:14:11'),
(15, 4, '4-15.jpg', 0, '2018-06-20 16:14:11', '2018-06-20 16:14:11'),
(16, 5, '5-16.jpg', 1, '2018-06-20 16:26:49', '2018-06-20 16:26:49'),
(17, 5, '5-17.jpg', 0, '2018-06-20 16:26:49', '2018-06-20 16:26:49'),
(18, 5, '5-18.jpg', 0, '2018-06-20 16:26:49', '2018-06-20 16:26:49'),
(19, 5, '5-19.jpg', 0, '2018-06-20 16:26:49', '2018-06-20 16:26:49'),
(20, 6, '6-20.jpg', 1, '2018-06-20 16:30:17', '2018-06-20 16:30:17'),
(21, 6, '6-21.jpg', 0, '2018-06-20 16:30:17', '2018-06-20 16:30:17'),
(22, 6, '6-22.jpg', 0, '2018-06-20 16:30:17', '2018-06-20 16:30:17'),
(23, 6, '6-23.jpg', 0, '2018-06-20 16:30:17', '2018-06-20 16:30:17'),
(24, 7, '7-24.jpg', 1, '2018-06-20 16:33:10', '2018-06-20 16:33:10'),
(25, 7, '7-25.jpg', 0, '2018-06-20 16:33:10', '2018-06-20 16:33:10'),
(26, 7, '7-26.jpg', 0, '2018-06-20 16:33:10', '2018-06-20 16:33:10'),
(27, 7, '7-27.jpg', 0, '2018-06-20 16:33:10', '2018-06-20 16:33:10'),
(28, 8, '8-28.jpg', 1, '2018-06-20 16:35:12', '2018-06-20 16:35:12'),
(29, 8, '8-29.jpg', 0, '2018-06-20 16:35:12', '2018-06-20 16:35:12'),
(30, 8, '8-30.jpg', 0, '2018-06-20 16:35:12', '2018-06-20 16:35:12'),
(31, 8, '8-31.jpg', 0, '2018-06-20 16:35:12', '2018-06-20 16:35:12'),
(32, 9, '9-32.jpg', 1, '2018-06-20 16:37:27', '2018-06-20 16:37:27'),
(33, 9, '9-33.jpg', 0, '2018-06-20 16:37:27', '2018-06-20 16:37:27'),
(34, 9, '9-34.jpg', 0, '2018-06-20 16:37:27', '2018-06-20 16:37:27'),
(35, 9, '9-35.jpg', 0, '2018-06-20 16:37:27', '2018-06-20 16:37:27'),
(36, 10, '10-36.jpg', 1, '2018-06-20 16:40:23', '2018-06-20 16:40:23'),
(37, 10, '10-37.jpg', 0, '2018-06-20 16:40:23', '2018-06-20 16:40:23'),
(38, 10, '10-38.jpg', 0, '2018-06-20 16:40:23', '2018-06-20 16:40:23'),
(39, 10, '10-39.jpg', 0, '2018-06-20 16:40:23', '2018-06-20 16:40:23'),
(40, 11, '11-40.jpg', 0, '2018-06-20 16:45:09', '2018-06-20 16:45:09'),
(41, 11, '11-41.jpg', 0, '2018-06-20 16:45:09', '2018-06-20 16:45:09'),
(42, 11, '11-42.jpg', 0, '2018-06-20 16:45:09', '2018-06-20 16:45:09'),
(43, 11, '11-43.jpg', 1, '2018-06-20 16:47:19', '2018-06-20 16:47:19'),
(44, 12, '12-44.jpg', 1, '2018-06-20 16:56:06', '2018-06-20 16:56:06'),
(45, 12, '12-45.jpg', 0, '2018-06-20 16:56:06', '2018-06-20 16:56:06'),
(46, 12, '12-46.jpg', 0, '2018-06-20 16:56:06', '2018-06-20 16:56:06'),
(47, 12, '12-47.jpg', 0, '2018-06-20 16:56:06', '2018-06-20 16:56:06'),
(48, 13, '13-48.jpg', 1, '2018-06-20 17:01:06', '2018-06-20 17:01:06'),
(49, 13, '13-49.jpg', 0, '2018-06-20 17:01:06', '2018-06-20 17:01:06'),
(50, 13, '13-50.jpg', 0, '2018-06-20 17:01:06', '2018-06-20 17:01:06'),
(51, 13, '13-51.jpg', 0, '2018-06-20 17:01:06', '2018-06-20 17:01:06'),
(52, 14, '14-52.jpg', 1, '2018-06-20 17:03:44', '2018-06-20 17:03:44'),
(53, 14, '14-53.jpg', 0, '2018-06-20 17:03:44', '2018-06-20 17:03:44'),
(54, 14, '14-54.jpg', 0, '2018-06-20 17:03:44', '2018-06-20 17:03:44'),
(55, 14, '14-55.jpg', 0, '2018-06-20 17:03:44', '2018-06-20 17:03:44'),
(56, 15, '15-56.jpg', 1, '2018-06-20 17:06:09', '2018-06-20 17:06:09'),
(57, 17, '17-57.jpg', 1, '2018-06-20 17:08:24', '2018-06-20 17:08:24'),
(58, 17, '17-58.jpg', 0, '2018-06-20 17:08:24', '2018-06-20 17:08:24'),
(59, 17, '17-59.jpg', 0, '2018-06-20 17:08:24', '2018-06-20 17:08:24'),
(60, 17, '17-60.jpg', 0, '2018-06-20 17:08:24', '2018-06-20 17:08:24'),
(61, 19, '19-61.jpg', 1, '2018-06-20 17:12:35', '2018-06-20 17:12:36'),
(62, 19, '19-62.jpg', 0, '2018-06-20 17:12:36', '2018-06-20 17:12:36'),
(63, 19, '19-63.jpg', 0, '2018-06-20 17:12:36', '2018-06-20 17:12:36'),
(64, 19, '19-64.jpg', 0, '2018-06-20 17:12:36', '2018-06-20 17:12:36'),
(66, 20, '20-66.jpg', 0, '2018-06-20 17:46:47', '2018-06-20 17:46:47'),
(67, 20, '20-67.jpg', 0, '2018-06-20 17:46:47', '2018-06-20 17:46:47'),
(68, 20, '20-68.jpg', 0, '2018-06-20 17:46:47', '2018-06-20 17:46:47'),
(69, 20, '20-69.jpg', 0, '2018-06-20 17:46:47', '2018-06-20 17:46:47'),
(72, 20, '20-72.jpg', 0, '2018-06-20 17:50:23', '2018-06-20 17:50:24'),
(73, 21, '21-73.jpg', 1, '2018-06-20 18:29:56', '2018-06-20 18:29:56'),
(74, 21, '21-74.jpg', 0, '2018-06-20 18:30:47', '2018-06-20 18:30:47'),
(75, 21, '21-75.jpg', 0, '2018-06-20 18:30:47', '2018-06-20 18:30:47'),
(76, 21, '21-76.jpg', 0, '2018-06-20 18:30:47', '2018-06-20 18:30:47'),
(77, 21, '21-77.jpg', 0, '2018-06-20 18:30:47', '2018-06-20 18:30:47'),
(79, 20, '20-79.jpg', 1, '2018-06-20 18:36:50', '2018-06-20 18:36:50'),
(80, 22, '22-80.jpg', 1, '2018-06-20 19:00:46', '2018-06-20 19:00:46'),
(81, 22, '22-81.jpg', 0, '2018-06-20 19:00:46', '2018-06-20 19:00:46'),
(82, 22, '22-82.jpg', 0, '2018-06-20 19:00:46', '2018-06-20 19:00:46'),
(83, 22, '22-83.jpg', 0, '2018-06-20 19:00:46', '2018-06-20 19:00:46'),
(84, 22, '22-84.jpg', 0, '2018-06-20 19:00:47', '2018-06-20 19:00:47'),
(85, 23, '23-85.jpg', 1, '2018-06-20 20:53:43', '2018-06-20 20:53:43'),
(86, 23, '23-86.jpg', 0, '2018-06-20 20:53:43', '2018-06-20 20:53:43'),
(87, 23, '23-87.jpg', 0, '2018-06-20 20:53:43', '2018-06-20 20:53:43'),
(88, 23, '23-88.jpg', 0, '2018-06-20 20:53:43', '2018-06-20 20:53:43'),
(89, 24, '24-89.jpg', 1, '2018-06-20 20:57:00', '2018-06-20 20:57:00'),
(90, 24, '24-90.jpg', 0, '2018-06-20 20:57:00', '2018-06-20 20:57:00'),
(91, 24, '24-91.jpg', 0, '2018-06-20 20:57:00', '2018-06-20 20:57:00'),
(92, 24, '24-92.jpg', 0, '2018-06-20 20:57:00', '2018-06-20 20:57:00'),
(93, 25, '25-93.jpg', 1, '2018-06-20 21:00:43', '2018-06-20 21:00:43'),
(94, 25, '25-94.jpg', 0, '2018-06-20 21:00:43', '2018-06-20 21:00:43'),
(95, 25, '25-95.jpg', 0, '2018-06-20 21:00:43', '2018-06-20 21:00:43'),
(96, 25, '25-96.jpg', 0, '2018-06-20 21:00:43', '2018-06-20 21:00:43'),
(97, 26, '26-97.jpg', 1, '2018-06-20 21:07:04', '2018-06-20 21:07:04'),
(98, 26, '26-98.jpg', 0, '2018-06-20 21:07:04', '2018-06-20 21:07:04'),
(99, 26, '26-99.jpg', 0, '2018-06-20 21:07:04', '2018-06-20 21:07:04'),
(100, 26, '26-100.jpg', 0, '2018-06-20 21:07:04', '2018-06-20 21:07:04'),
(101, 27, '27-101.jpg', 1, '2018-06-20 21:10:08', '2018-06-20 21:10:08'),
(102, 27, '27-102.jpg', 0, '2018-06-20 21:10:16', '2018-06-20 21:10:16'),
(103, 27, '27-103.jpg', 0, '2018-06-20 21:10:16', '2018-06-20 21:10:16'),
(104, 27, '27-104.jpg', 0, '2018-06-20 21:10:16', '2018-06-20 21:10:16'),
(105, 28, '28-105.jpg', 1, '2018-06-20 21:12:45', '2018-06-20 21:12:45'),
(106, 28, '28-106.jpg', 0, '2018-06-20 21:12:45', '2018-06-20 21:12:45'),
(107, 28, '28-107.jpg', 0, '2018-06-20 21:12:45', '2018-06-20 21:12:45'),
(108, 28, '1', 0, '2018-06-20 21:12:45', '2018-06-20 21:12:45'),
(109, 29, '29-109.jpg', 1, '2018-06-20 21:23:36', '2018-06-20 21:23:36'),
(110, 29, '29-110.jpg', 0, '2018-06-20 21:23:36', '2018-06-20 21:23:36'),
(111, 29, '29-111.jpg', 0, '2018-06-20 21:23:36', '2018-06-20 21:23:36'),
(112, 29, '29-112.jpg', 0, '2018-06-20 21:23:36', '2018-06-20 21:23:36'),
(113, 30, '30-113.jpg', 1, '2018-06-20 21:27:33', '2018-06-20 21:27:33'),
(114, 30, '30-114.jpg', 0, '2018-06-20 21:27:34', '2018-06-20 21:27:34'),
(115, 30, '30-115.jpg', 0, '2018-06-20 21:27:34', '2018-06-20 21:27:34'),
(116, 30, '30-116.jpg', 0, '2018-06-20 21:27:34', '2018-06-20 21:27:34'),
(117, 31, '31-117.jpg', 1, '2018-06-20 21:30:26', '2018-06-20 21:30:26'),
(118, 31, '31-118.jpg', 0, '2018-06-20 21:30:26', '2018-06-20 21:30:26'),
(119, 31, '31-119.jpg', 0, '2018-06-20 21:30:26', '2018-06-20 21:30:26'),
(120, 31, '31-120.jpg', 0, '2018-06-20 21:30:26', '2018-06-20 21:30:26');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
CREATE TABLE IF NOT EXISTS `ratings` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `content_id` int(10) UNSIGNED NOT NULL,
  `rate` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`,`content_id`),
  KEY `ratings_content_id_foreign` (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`user_id`, `content_id`, `rate`, `created_at`, `updated_at`) VALUES
(1, 2, 9, '2018-06-20 15:46:27', '2018-06-20 16:19:45'),
(1, 5, 9, '2018-06-20 16:26:54', '2018-06-20 16:26:54'),
(1, 6, 7, '2018-06-20 16:30:22', '2018-06-20 16:30:22'),
(1, 9, 5, '2018-06-20 16:37:34', '2018-06-20 16:37:34'),
(1, 10, 9, '2018-06-20 16:40:27', '2018-06-20 16:40:27'),
(1, 20, 7, '2018-06-20 18:04:28', '2018-06-20 18:04:28'),
(1, 21, 10, '2018-06-20 18:43:30', '2018-06-20 18:43:30'),
(1, 22, 7, '2018-06-20 19:01:15', '2018-06-21 03:58:49'),
(1, 23, 1, '2018-06-20 20:53:51', '2018-06-20 21:03:32'),
(1, 24, 9, '2018-06-20 20:57:05', '2018-06-20 20:57:05'),
(3, 2, 10, '2018-06-20 21:35:33', '2018-06-20 21:35:33'),
(3, 4, 9, '2018-06-20 21:36:24', '2018-06-20 21:36:24'),
(3, 6, 10, '2018-06-20 21:39:16', '2018-06-20 21:39:16'),
(3, 11, 4, '2018-06-20 21:35:45', '2018-06-20 21:35:45'),
(3, 19, 10, '2018-06-20 21:36:06', '2018-06-20 21:36:06'),
(3, 20, 8, '2018-06-20 21:35:37', '2018-06-20 21:35:37'),
(4, 2, 10, '2018-06-21 07:12:01', '2018-06-21 07:12:01'),
(4, 4, 10, '2018-06-21 07:11:27', '2018-06-21 07:11:27'),
(4, 5, 6, '2018-06-21 07:11:39', '2018-06-21 07:11:39'),
(4, 11, 9, '2018-06-21 07:12:06', '2018-06-21 07:12:06'),
(4, 20, 5, '2018-06-21 07:11:45', '2018-06-21 07:11:45'),
(4, 21, 6, '2018-06-21 07:11:51', '2018-06-21 07:11:51');

-- --------------------------------------------------------

--
-- Table structure for table `seasons`
--

DROP TABLE IF EXISTS `seasons`;
CREATE TABLE IF NOT EXISTS `seasons` (
  `content_id` int(10) UNSIGNED NOT NULL,
  `tvshow_id` int(10) UNSIGNED NOT NULL,
  `number_of_episodes` int(11) DEFAULT NULL,
  `season_number` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`content_id`),
  UNIQUE KEY `seasons_tvshow_id_season_number_unique` (`tvshow_id`,`season_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seasons`
--

INSERT INTO `seasons` (`content_id`, `tvshow_id`, `number_of_episodes`, `season_number`, `created_at`, `updated_at`) VALUES
(3, 2, 3, 1, '2018-06-20 16:08:44', '2018-06-20 16:08:44'),
(7, 2, 3, 2, '2018-06-20 16:33:09', '2018-06-20 16:33:09'),
(12, 11, 2, 1, '2018-06-20 16:56:06', '2018-06-20 16:56:06'),
(15, 11, 2, 2, '2018-06-20 17:06:08', '2018-06-20 17:06:08'),
(21, 20, 4, 1, '2018-06-20 18:29:56', '2018-06-20 18:29:56'),
(24, 23, 1, 1, '2018-06-20 20:57:00', '2018-06-20 20:57:00'),
(27, 26, 1, 1, '2018-06-20 21:08:47', '2018-06-20 21:08:47'),
(30, 29, 1, 1, '2018-06-20 21:27:33', '2018-06-20 21:27:33');

-- --------------------------------------------------------

--
-- Table structure for table `tvshows`
--

DROP TABLE IF EXISTS `tvshows`;
CREATE TABLE IF NOT EXISTS `tvshows` (
  `content_id` int(10) UNSIGNED NOT NULL,
  `country` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `length` int(10) UNSIGNED DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `number_of_episodes` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tvshows`
--

INSERT INTO `tvshows` (`content_id`, `country`, `language`, `length`, `end_date`, `number_of_episodes`, `created_at`, `updated_at`) VALUES
(2, 'SAD', 'Engleski', 56, NULL, 6, '2018-06-20 15:43:56', '2018-06-20 15:43:56'),
(11, 'SAD', 'Engleski', 51, '2018-06-14 22:00:00', 4, '2018-06-20 16:45:09', '2018-06-20 16:54:29'),
(20, 'SAD', 'Engleski', 55, NULL, 4, '2018-06-20 17:46:47', '2018-06-20 17:46:47'),
(23, 'SAD', 'Engleski', 50, NULL, 5, '2018-06-20 20:53:42', '2018-06-20 20:53:42'),
(26, 'SAD', 'Engleski', 55, NULL, 7, '2018-06-20 21:07:04', '2018-06-20 21:07:04'),
(29, 'SAD', 'Engleski', 55, NULL, 5, '2018-06-20 21:23:36', '2018-06-20 21:23:36');

-- --------------------------------------------------------

--
-- Table structure for table `type_ofs`
--

DROP TABLE IF EXISTS `type_ofs`;
CREATE TABLE IF NOT EXISTS `type_ofs` (
  `tvshow_id` int(10) UNSIGNED NOT NULL,
  `genre_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`tvshow_id`,`genre_id`),
  KEY `type_ofs_genre_id_foreign` (`genre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_ofs`
--

INSERT INTO `type_ofs` (`tvshow_id`, `genre_id`, `created_at`, `updated_at`) VALUES
(2, 3, '2018-06-20 16:41:39', '2018-06-20 16:41:39'),
(2, 5, '2018-06-20 16:41:39', '2018-06-20 16:41:39'),
(2, 6, '2018-06-20 16:41:39', '2018-06-20 16:41:39'),
(11, 3, '2018-06-20 16:45:09', '2018-06-20 16:45:09'),
(11, 6, '2018-06-20 16:45:09', '2018-06-20 16:45:09'),
(20, 3, '2018-06-20 17:46:47', '2018-06-20 17:46:47'),
(20, 6, '2018-06-20 17:46:47', '2018-06-20 17:46:47'),
(23, 3, '2018-06-20 20:53:43', '2018-06-20 20:53:43'),
(23, 6, '2018-06-20 20:53:43', '2018-06-20 20:53:43'),
(26, 6, '2018-06-20 21:07:04', '2018-06-20 21:07:04'),
(29, 4, '2018-06-20 21:23:36', '2018-06-20 21:23:36'),
(29, 6, '2018-06-20 21:23:36', '2018-06-20 21:23:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `security_question` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registration_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `admin_since` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `surname`, `gender`, `email`, `password`, `birth_date`, `is_admin`, `security_question`, `answer`, `picture_path`, `registration_date`, `admin_since`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'leksa', 'Aleksa', 'Simovic', 'm', 'fico1996@hotmail.com', '$2y$10$xtkoPL0hlVL1e13oqUp66./tzt5iADXCuVSKqIR7qVfy5qnFy2zY2', '2018-06-13 22:00:00', 1, 'Sta se radi', 'Na estradi', 'Aleksa-leksa.jpg', '2018-06-20 17:35:45', NULL, 'lmAdhrXhrcxCW1h7lAXRcFof5Z4EBsOGzoO0nXB91o9uswFRGb05GSWGTeyi', '2018-06-20 15:35:45', '2018-06-20 15:35:45'),
(2, 'fipa', 'Filip', 'Djukic', 'm', 'fipa@gmail.com', '$2y$10$xMfjnT/7kP7x9lZgYCGRzu0m8oBSZ5ooxXBueEZ4m9EVak6Ewq86O', '2016-08-10 22:00:00', 1, 'Sta se radi', 'Na estradi', 'Filip-fipa.jpg', '2018-06-20 23:32:54', NULL, 'x2xeGmdgqr278q5hL2eh4DyXoMIG3412Bkc7teiEQXwKftLagG1L3J9jU5vL', '2018-06-20 21:32:54', '2018-06-20 21:32:54'),
(3, 'tiksi', 'Tijana', 'Jovanovic', 'z', 'tica_ubica@gmai.com', '$2y$10$6N.Sa7CBF23btlIY3FOQQ.ytxCiCua91KucwDWpuwFFRQ7/N9Vpae', NULL, 0, 'Sta se radi', 'Na estradi', 'Tijana-tiksi.jpg', '2018-06-20 23:35:21', NULL, 'd7h15h5yeGOYvmNChgOMjPF76k4E7sViUm9n4WKQZlYTCgGsPZnbp405QWvS', '2018-06-20 21:35:21', '2018-06-20 21:39:35'),
(4, 'milica', 'Milica', 'Despotovic', 'f', 'milica@gmai.com', '$2y$10$JZ6BAFWLLP0YTXrWGB635uCQhuDAh5f4g3HscHqk8kOTU8A3RxUQ2', '2018-06-03 22:00:00', 0, 'Sta se radi', 'Na estradi', 'Milica-milica.jpg', '2018-06-21 09:11:01', NULL, NULL, '2018-06-21 07:11:01', '2018-06-21 07:11:01');

-- --------------------------------------------------------

--
-- Table structure for table `watched_episodes`
--

DROP TABLE IF EXISTS `watched_episodes`;
CREATE TABLE IF NOT EXISTS `watched_episodes` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `episode_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`,`episode_id`),
  KEY `watched_episodes_episode_id_foreign` (`episode_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `watched_episodes`
--

INSERT INTO `watched_episodes` (`user_id`, `episode_id`, `created_at`, `updated_at`) VALUES
(1, 4, '2018-06-20 16:14:14', '2018-06-20 16:14:14'),
(1, 5, '2018-06-20 16:26:52', '2018-06-20 16:26:52'),
(1, 6, '2018-06-20 18:21:20', '2018-06-20 18:21:20'),
(1, 8, '2018-06-20 16:35:15', '2018-06-20 16:35:15'),
(1, 9, '2018-06-20 16:37:30', '2018-06-20 16:37:30'),
(1, 13, '2018-06-20 17:01:11', '2018-06-20 17:01:11'),
(3, 4, '2018-06-20 21:36:23', '2018-06-20 21:36:23'),
(3, 13, '2018-06-20 21:35:56', '2018-06-20 21:35:56'),
(3, 19, '2018-06-20 21:36:04', '2018-06-20 21:36:04'),
(4, 4, '2018-06-21 07:11:26', '2018-06-21 07:11:26'),
(4, 5, '2018-06-21 07:11:38', '2018-06-21 07:11:38'),
(4, 22, '2018-06-21 07:11:50', '2018-06-21 07:11:50');

-- --------------------------------------------------------

--
-- Table structure for table `watched_seasons`
--

DROP TABLE IF EXISTS `watched_seasons`;
CREATE TABLE IF NOT EXISTS `watched_seasons` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `season_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`,`season_id`),
  KEY `watched_seasons_season_id_foreign` (`season_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `watched_seasons`
--

INSERT INTO `watched_seasons` (`user_id`, `season_id`, `created_at`, `updated_at`) VALUES
(1, 3, '2018-06-20 18:21:20', '2018-06-20 18:21:20'),
(1, 15, '2018-06-20 17:06:18', '2018-06-20 17:06:18'),
(4, 21, '2018-06-21 07:11:50', '2018-06-21 07:11:50');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `actings`
--
ALTER TABLE `actings`
  ADD CONSTRAINT `actings_actor_id_foreign` FOREIGN KEY (`actor_id`) REFERENCES `actors` (`category_id`),
  ADD CONSTRAINT `actings_tvshow_id_foreign` FOREIGN KEY (`tvshow_id`) REFERENCES `tvshows` (`content_id`);

--
-- Constraints for table `actors`
--
ALTER TABLE `actors`
  ADD CONSTRAINT `actors_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_episode_id_foreign` FOREIGN KEY (`episode_id`) REFERENCES `episodes` (`content_id`),
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `directings`
--
ALTER TABLE `directings`
  ADD CONSTRAINT `directings_director_id_foreign` FOREIGN KEY (`director_id`) REFERENCES `directors` (`category_id`),
  ADD CONSTRAINT `directings_tvshow_id_foreign` FOREIGN KEY (`tvshow_id`) REFERENCES `tvshows` (`content_id`);

--
-- Constraints for table `directors`
--
ALTER TABLE `directors`
  ADD CONSTRAINT `directors_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `episodes`
--
ALTER TABLE `episodes`
  ADD CONSTRAINT `episodes_content_id_foreign` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`),
  ADD CONSTRAINT `episodes_season_id_foreign` FOREIGN KEY (`season_id`) REFERENCES `seasons` (`content_id`);

--
-- Constraints for table `genres`
--
ALTER TABLE `genres`
  ADD CONSTRAINT `genres_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `pictures`
--
ALTER TABLE `pictures`
  ADD CONSTRAINT `pictures_content_id_foreign` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`);

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_content_id_foreign` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`),
  ADD CONSTRAINT `ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `seasons`
--
ALTER TABLE `seasons`
  ADD CONSTRAINT `seasons_content_id_foreign` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`),
  ADD CONSTRAINT `seasons_tvshow_id_foreign` FOREIGN KEY (`tvshow_id`) REFERENCES `tvshows` (`content_id`);

--
-- Constraints for table `tvshows`
--
ALTER TABLE `tvshows`
  ADD CONSTRAINT `tvshows_content_id_foreign` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`);

--
-- Constraints for table `type_ofs`
--
ALTER TABLE `type_ofs`
  ADD CONSTRAINT `type_ofs_genre_id_foreign` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`category_id`),
  ADD CONSTRAINT `type_ofs_tvshow_id_foreign` FOREIGN KEY (`tvshow_id`) REFERENCES `tvshows` (`content_id`);

--
-- Constraints for table `watched_episodes`
--
ALTER TABLE `watched_episodes`
  ADD CONSTRAINT `watched_episodes_episode_id_foreign` FOREIGN KEY (`episode_id`) REFERENCES `episodes` (`content_id`),
  ADD CONSTRAINT `watched_episodes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `watched_seasons`
--
ALTER TABLE `watched_seasons`
  ADD CONSTRAINT `watched_seasons_season_id_foreign` FOREIGN KEY (`season_id`) REFERENCES `seasons` (`content_id`),
  ADD CONSTRAINT `watched_seasons_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
