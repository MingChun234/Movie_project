-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-01-08 17:48:13
-- 伺服器版本： 10.4.27-MariaDB
-- PHP 版本： 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `電影訂票系統`
--

-- --------------------------------------------------------

--
-- 資料表結構 `123_cart`
--

CREATE TABLE `123_cart` (
  `name` text NOT NULL,
  `date` date NOT NULL,
  `time` char(20) NOT NULL,
  `number` int(11) NOT NULL,
  `price` int(11) NOT NULL DEFAULT 250
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `account`
--

CREATE TABLE `account` (
  `account_name` varchar(11) NOT NULL,
  `password` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `account`
--

INSERT INTO `account` (`account_name`, `password`) VALUES
('123	', '123');

-- --------------------------------------------------------

--
-- 資料表結構 `場次表`
--

CREATE TABLE `場次表` (
  `電影編號` char(20) NOT NULL,
  `電影場次` char(20) NOT NULL,
  `場次時間` char(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `場次表`
--

INSERT INTO `場次表` (`電影編號`, `電影場次`, `場次時間`) VALUES
('M1', 'E1', '8:00'),
('M1', 'E2', '10:00'),
('M1', 'E3', '12:00'),
('M1', 'E4', '14:00'),
('M1', 'E5', '16:00'),
('M1', 'E6', '18:00'),
('M1', 'E7', '20:00'),
('M2', 'A1', '8:00'),
('M2', 'A2', '10:00'),
('M2', 'A3', '12:00'),
('M2', 'A4', '14:00'),
('M2', 'A5', '16:00'),
('M2', 'A6', '18:00'),
('M2', 'A7', '20:00'),
('M3', 'S1', '8:00'),
('M3', 'S2', '10:00'),
('M3', 'S3', '12:00'),
('M3', 'S4', '14:00'),
('M3', 'S5', '16:00'),
('M3', 'S6', '18:00'),
('M3', 'S7', '20:00');

-- --------------------------------------------------------

--
-- 資料表結構 `訂票表`
--

CREATE TABLE `訂票表` (
  `電影場次` char(20) NOT NULL DEFAULT current_timestamp(),
  `票價` int(1) DEFAULT 250
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `訂票表`
--

INSERT INTO `訂票表` (`電影場次`, `票價`) VALUES
('A1', 250),
('A2', 250),
('A3', 250),
('A4', 250),
('A5', 250),
('A6', 250),
('A7', 250),
('E1', 250),
('E2', 250),
('E3', 250),
('E4', 250),
('E5', 250),
('E6', 250),
('E7', 250),
('S1', 250),
('S2', 250),
('S3', 250),
('S4', 250),
('S5', 250),
('S6', 250),
('S7', 250);

-- --------------------------------------------------------

--
-- 資料表結構 `電影表`
--

CREATE TABLE `電影表` (
  `電影編號` char(5) NOT NULL,
  `電影名稱` text DEFAULT NULL,
  `票價` int(11) DEFAULT 250
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `電影表`
--

INSERT INTO `電影表` (`電影編號`, `電影名稱`, `票價`) VALUES
('M1', '青春豬頭少年不會夢到紅書包女孩', 250),
('M2', '水行俠 失落王國', 250),
('M3', 'spy family code white', 250);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `場次表`
--
ALTER TABLE `場次表`
  ADD UNIQUE KEY `電影編號` (`電影編號`,`電影場次`),
  ADD UNIQUE KEY `電影場次` (`電影場次`),
  ADD UNIQUE KEY `電影場次_2` (`電影場次`),
  ADD UNIQUE KEY `電影場次_3` (`電影場次`);

--
-- 資料表索引 `訂票表`
--
ALTER TABLE `訂票表`
  ADD PRIMARY KEY (`電影場次`);

--
-- 資料表索引 `電影表`
--
ALTER TABLE `電影表`
  ADD PRIMARY KEY (`電影編號`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
