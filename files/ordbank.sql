-- phpMyAdmin SQL Dump
-- version 5.2.3deb1
-- https://www.phpmyadmin.net/
--
-- Värd: localhost:3306
-- Tid vid skapande: 17 nov 2026 kl 11:30
-- Serverversion: 8.4.13-0ubuntu0.26.04.2
-- PHP-version: 8.5.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `ordbank`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `administrator`
--

CREATE TABLE `administrator` (
  `admin_id` int NOT NULL,
  `anvandarnamn` varchar(45) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `losenord` varchar(255) NOT NULL,
  `roll` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `anvandare`
--

CREATE TABLE `anvandare` (
  `anv_id` int NOT NULL,
  `anvandarnamn` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `losenord` varchar(255) NOT NULL,
  `roll` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'anvandare'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumpning av Data i tabell `anvandare`
--

INSERT INTO `anvandare` (`anv_id`, `anvandarnamn`, `email`, `losenord`, `roll`) VALUES
(3, 't', 't@t.se', '$2y$12$hL4CT05UnX6JLbaDGoc/8OLBzxl1g4l8rzVUxGCk27UD6PicQ0dau', 'anvandare'),
(11, 'test', 'test@test.se', '$2y$12$rlUO4uYfiJGhB6fDg6Y9jOn9mGB1HSr3ImoQbO1cnxQpd.lNMBNx6', 'anvandare'),
(12, 'test2', 'test2@test2.se', '$2y$12$JhE/Ctwnl3A7JVuJHQMMo.v6qd2NlXF3jfq33A3d73J43VkXL0P8K', 'anvandare'),
(13, 'test3', 'test3@test3.se', '$2y$12$sjSS0gwn4YCM.APVrdu0VuQx1nOwMY19Omwn2w0cYRXjmocM2JNtm', 'anvandare'),
(14, 't2', '', '$2y$12$etVt/QHS2CmyLLqhw9tvDuITujkFQo7GpPCDFemG/VxRbsawJ66kC', 'anvandare');

-- --------------------------------------------------------

--
-- Tabellstruktur `definition`
--

CREATE TABLE `definition` (
  `def_id` int NOT NULL,
  `ord_id` int NOT NULL,
  `definition` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `ex_mening`
--

CREATE TABLE `ex_mening` (
  `exm_id` int NOT NULL,
  `mening` text NOT NULL,
  `def_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `ord`
--

CREATE TABLE `ord` (
  `ord_id` int NOT NULL,
  `ord` varchar(100) NOT NULL,
  `ord_typ` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumpning av Data i tabell `ord`
--

INSERT INTO `ord` (`ord_id`, `ord`, `ord_typ`) VALUES
(1, 'test', 'substantiv'),
(2, 'prov', 'substantiv'),
(3, 'test', 'substantiv');

-- --------------------------------------------------------

--
-- Tabellstruktur `ord_relation`
--

CREATE TABLE `ord_relation` (
  `id` int NOT NULL,
  `ord_id` int NOT NULL,
  `relaterat_ord_id` int NOT NULL,
  `relations_typ` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumpning av Data i tabell `ord_relation`
--

INSERT INTO `ord_relation` (`id`, `ord_id`, `relaterat_ord_id`, `relations_typ`) VALUES
(1, 1, 2, 'synonym');

-- --------------------------------------------------------

--
-- Tabellstruktur `sok_historik`
--

CREATE TABLE `sok_historik` (
  `his_id` int NOT NULL,
  `anv_id` int NOT NULL,
  `ord_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `sparade_ord`
--

CREATE TABLE `sparade_ord` (
  `anv_id` int NOT NULL,
  `ord_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Index för tabell `anvandare`
--
ALTER TABLE `anvandare`
  ADD PRIMARY KEY (`anv_id`),
  ADD UNIQUE KEY `anvandarnamn_UNIQUE` (`anvandarnamn`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Index för tabell `definition`
--
ALTER TABLE `definition`
  ADD PRIMARY KEY (`def_id`),
  ADD KEY `fk_definition_1_idx` (`ord_id`);

--
-- Index för tabell `ex_mening`
--
ALTER TABLE `ex_mening`
  ADD PRIMARY KEY (`exm_id`),
  ADD KEY `fk_def_id_idx` (`def_id`);

--
-- Index för tabell `ord`
--
ALTER TABLE `ord`
  ADD PRIMARY KEY (`ord_id`);

--
-- Index för tabell `ord_relation`
--
ALTER TABLE `ord_relation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ord_relation_id_idx` (`relaterat_ord_id`),
  ADD KEY `fk_ord_id_2_idx` (`ord_id`);

--
-- Index för tabell `sok_historik`
--
ALTER TABLE `sok_historik`
  ADD PRIMARY KEY (`his_id`),
  ADD KEY `fk_anv_id_idx` (`anv_id`),
  ADD KEY `fk_ord_id_idx` (`ord_id`);

--
-- Index för tabell `sparade_ord`
--
ALTER TABLE `sparade_ord`
  ADD PRIMARY KEY (`anv_id`,`ord_id`),
  ADD KEY `fk_sparade_ord_1_idx` (`ord_id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `administrator`
--
ALTER TABLE `administrator`
  MODIFY `admin_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT för tabell `anvandare`
--
ALTER TABLE `anvandare`
  MODIFY `anv_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT för tabell `definition`
--
ALTER TABLE `definition`
  MODIFY `def_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT för tabell `ex_mening`
--
ALTER TABLE `ex_mening`
  MODIFY `exm_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT för tabell `ord`
--
ALTER TABLE `ord`
  MODIFY `ord_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT för tabell `ord_relation`
--
ALTER TABLE `ord_relation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT för tabell `sok_historik`
--
ALTER TABLE `sok_historik`
  MODIFY `his_id` int NOT NULL AUTO_INCREMENT;

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `definition`
--
ALTER TABLE `definition`
  ADD CONSTRAINT `fk_ord_id_def` FOREIGN KEY (`ord_id`) REFERENCES `ord` (`ord_id`);

--
-- Restriktioner för tabell `ex_mening`
--
ALTER TABLE `ex_mening`
  ADD CONSTRAINT `fk_def_id_exm` FOREIGN KEY (`def_id`) REFERENCES `definition` (`def_id`);

--
-- Restriktioner för tabell `ord_relation`
--
ALTER TABLE `ord_relation`
  ADD CONSTRAINT `fk_ord_id_ord_rel` FOREIGN KEY (`ord_id`) REFERENCES `ord` (`ord_id`),
  ADD CONSTRAINT `fk_ord_id_relaterat_ord` FOREIGN KEY (`relaterat_ord_id`) REFERENCES `ord` (`ord_id`);

--
-- Restriktioner för tabell `sok_historik`
--
ALTER TABLE `sok_historik`
  ADD CONSTRAINT `fk_anv_id_sok_his` FOREIGN KEY (`anv_id`) REFERENCES `anvandare` (`anv_id`),
  ADD CONSTRAINT `fk_ord_id_sok_his` FOREIGN KEY (`ord_id`) REFERENCES `ord` (`ord_id`);

--
-- Restriktioner för tabell `sparade_ord`
--
ALTER TABLE `sparade_ord`
  ADD CONSTRAINT `fk_anv_id_spo` FOREIGN KEY (`anv_id`) REFERENCES `anvandare` (`anv_id`),
  ADD CONSTRAINT `fk_ord_id_spo` FOREIGN KEY (`ord_id`) REFERENCES `ord` (`ord_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
