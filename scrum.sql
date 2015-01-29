-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 15 jan 2015 om 13:43
-- Serverversie: 5.6.20
-- PHP-versie: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `scrum`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `activities`
--

CREATE TABLE IF NOT EXISTS `activities` (
`id` int(10) unsigned NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `place` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Gegevens worden geëxporteerd voor tabel `activities`
--

INSERT INTO `activities` (`id`, `date_start`, `date_end`, `time_start`, `time_end`, `title`, `body`, `place`, `created_at`, `updated_at`) VALUES
(1, '2014-12-04', '2014-12-04', '08:30:00', '16:00:00', 'Bezoek Hopmuseum', 'Wat was het toch weer fijn :)', 'Poperinge', '2014-12-19 14:12:11', '2014-12-19 14:12:11'),
(2, '2014-11-12', '2014-11-13', '11:00:00', '12:00:00', 'Sinterklaasfeest', 'Wie zoet is krijgt lekkers, wie stout is een klets om zijn oren!', 'De Spiegel', '2014-12-19 14:12:11', '2014-12-19 14:12:11'),
(3, '2014-12-12', '2014-12-13', '11:30:00', '18:00:00', 'Fietstocht', 'Dit is ook een test, woooooooooooooop', 'Ardennen', '2014-12-19 14:12:11', '2014-12-19 14:12:11'),
(4, '2014-11-13', '2014-11-15', '12:00:00', '13:00:00', 'Feestje voor de toffe mensen', 'Dit is nog een test, mimimimimimimimimimimimimi', 'CC de coole kikker, Kortrijk', '2014-12-19 14:12:11', '2014-12-19 14:12:11');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `forum_categories`
--

CREATE TABLE IF NOT EXISTS `forum_categories` (
`id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `group_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Gegevens worden geëxporteerd voor tabel `forum_categories`
--

INSERT INTO `forum_categories` (`id`, `title`, `group_id`, `author_id`, `created_at`, `updated_at`) VALUES
(1, 'categorie in de test', 1, 1, '2014-12-19 14:33:11', '2014-12-19 14:33:11');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `forum_comments`
--

CREATE TABLE IF NOT EXISTS `forum_comments` (
`id` int(10) unsigned NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `group_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Gegevens worden geëxporteerd voor tabel `forum_comments`
--

INSERT INTO `forum_comments` (`id`, `body`, `group_id`, `category_id`, `thread_id`, `author_id`, `created_at`, `updated_at`) VALUES
(1, '(verwijderd)', 1, 1, 1, 1, '2014-12-19 14:34:02', '2014-12-19 14:35:37'),
(2, '(verwijderd)', 1, 1, 1, 1, '2014-12-19 14:35:48', '2014-12-19 14:43:10'),
(3, 'commentaar', 1, 1, 1, 1, '2014-12-19 15:01:47', '2014-12-19 15:01:47');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `forum_groups`
--

CREATE TABLE IF NOT EXISTS `forum_groups` (
`id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Gegevens worden geëxporteerd voor tabel `forum_groups`
--

INSERT INTO `forum_groups` (`id`, `title`, `author_id`, `created_at`, `updated_at`) VALUES
(1, 'testen als alles werkt', 1, '2014-12-19 14:32:56', '2014-12-19 14:32:56');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `forum_replies`
--

CREATE TABLE IF NOT EXISTS `forum_replies` (
`id` int(10) unsigned NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `group_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `like` int(11) NOT NULL,
  `dislike` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `forum_replies_replies`
--

CREATE TABLE IF NOT EXISTS `forum_replies_replies` (
`id` int(10) unsigned NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `group_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `reply_id` int(11) NOT NULL,
  `like` int(11) NOT NULL,
  `dislike` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `forum_threads`
--

CREATE TABLE IF NOT EXISTS `forum_threads` (
`id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `group_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Gegevens worden geëxporteerd voor tabel `forum_threads`
--

INSERT INTO `forum_threads` (`id`, `title`, `body`, `group_id`, `category_id`, `author_id`, `created_at`, `updated_at`) VALUES
(1, 'onderwerp toevoegen "titel"', 'ONDERWERP BOODSCHAP bla bla bla bla bla', 1, 1, 1, '2014-12-19 14:33:42', '2014-12-19 14:33:42');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `forum_voting_ip`
--

CREATE TABLE IF NOT EXISTS `forum_voting_ip` (
`id` int(10) unsigned NOT NULL,
  `ip_add` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `forum_comments_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_09_12_064534_create_activities_table', 1),
('2014_09_12_064619_add_activities', 1),
('2014_10_30_095829_create_users_table', 1),
('2014_10_30_095845_create_forum_groups_table', 1),
('2014_10_30_095857_create_forum_categories_table', 1),
('2014_10_30_095910_create_forum_comments_table', 1),
('2014_10_30_095924_create_forum_threads_table', 1),
('2014_12_05_101102_create_forum_voting_ip', 1),
('2014_12_05_121224_create_forum_replies_table', 1),
('2014_12_18_091929_create_forum_replies_replies_table', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lvl_auth` enum('0','1','2') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `firstname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `adress` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `zip` int(11) NOT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci,
  `news` tinyint(1) NOT NULL DEFAULT '1',
  `news_extra` tinyint(1) NOT NULL,
  `banknr` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `lvl_auth`, `firstname`, `lastname`, `adress`, `zip`, `city`, `email`, `phone`, `message`, `news`, `news_extra`, `banknr`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'ValentinoGahide', '$2y$10$4ak0Udk6Pc.tUhLNT0tAzeJ6.XRI9J7RiqDYGF.85TSz1xDQ24VZS', '2', 'Valentino', 'Gahide', 'Ingooigemstraat 14', 8553, 'Otegem', 'valentinogahide@gmail.com', '0479/45.42.13', 'Test', 1, 0, '123456789.007', '2014-12-19 14:12:34', '2014-12-19 15:02:05', '9LnSMXH21dGpknzAez2XODWMyt9QSIJTv1yoSnVGJpc0K94nDuYHiRjQ3AvY'),
(2, 'MaartenPasschyn', '$2y$10$5DPeOakNEYhZ5n6h4TRB6OwlEDW.a6I7Kw.IaSMwuVmkYwyQRoP6C', '1', 'Maarten ', 'Passchyn', '', 8450, 'Otegem', 'maarten.passchyn@gmail.com', '0496/23.58.94', 'Test', 0, 0, '266376931.001', '2014-12-19 14:12:34', '2014-12-19 14:12:34', NULL),
(3, 'SebastiaanDeslypere', '$2y$10$I2uE3oMl2fDcpM31t8mjK.HMaH.VohqDFglk9yA.KgZlY/FmB7xgK', '0', 'Sebastiaan', 'Deslypere', '', 9000, 'Otegem', 'sebastiaanslyper@gmail.com', '0479/45.42.13', 'Test', 1, 0, '123456789.007', '2014-12-19 14:12:34', '2014-12-19 14:12:34', NULL),
(4, 'admin', '$2y$10$OzbL3IjXiHdyk03JP0AOO.mFMNo5lTcGbfrlEiH/1jodVeMuHMolq', '2', 'admin', 'admin', '', 8553, 'Otegem', 'admin@admin.com', '0479/45.42.13', 'Test', 1, 1, '123456789.007', '2014-12-19 14:12:34', '2014-12-19 14:12:34', NULL);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `activities`
--
ALTER TABLE `activities`
 ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `forum_categories`
--
ALTER TABLE `forum_categories`
 ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `forum_comments`
--
ALTER TABLE `forum_comments`
 ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `forum_groups`
--
ALTER TABLE `forum_groups`
 ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `forum_replies`
--
ALTER TABLE `forum_replies`
 ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `forum_replies_replies`
--
ALTER TABLE `forum_replies_replies`
 ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `forum_threads`
--
ALTER TABLE `forum_threads`
 ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `forum_voting_ip`
--
ALTER TABLE `forum_voting_ip`
 ADD PRIMARY KEY (`id`), ADD KEY `forum_voting_ip_forum_comments_id_foreign` (`forum_comments_id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_username_unique` (`username`), ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `activities`
--
ALTER TABLE `activities`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT voor een tabel `forum_categories`
--
ALTER TABLE `forum_categories`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `forum_comments`
--
ALTER TABLE `forum_comments`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT voor een tabel `forum_groups`
--
ALTER TABLE `forum_groups`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `forum_replies`
--
ALTER TABLE `forum_replies`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `forum_replies_replies`
--
ALTER TABLE `forum_replies_replies`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `forum_threads`
--
ALTER TABLE `forum_threads`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `forum_voting_ip`
--
ALTER TABLE `forum_voting_ip`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `forum_voting_ip`
--
ALTER TABLE `forum_voting_ip`
ADD CONSTRAINT `forum_voting_ip_forum_comments_id_foreign` FOREIGN KEY (`forum_comments_id`) REFERENCES `forum_comments` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
