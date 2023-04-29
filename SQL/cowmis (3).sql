-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-04-29 20:25:45
-- 伺服器版本： 10.4.21-MariaDB
-- PHP 版本： 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `cowmis`
--

-- --------------------------------------------------------

--
-- 資料表結構 `cows_information`
--

CREATE TABLE `cows_information` (
  `sn` int(6) NOT NULL,
  `id` varchar(64) NOT NULL,
  `dob` date NOT NULL,
  `mid` varchar(64) NOT NULL,
  `fid` varchar(64) NOT NULL,
  `birthParity` int(64) NOT NULL,
  `calvingInterval` varchar(64) NOT NULL,
  `area` varchar(64) NOT NULL,
  `areatime` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `cows_information`
--

INSERT INTO `cows_information` (`sn`, `id`, `dob`, `mid`, `fid`, `birthParity`, `calvingInterval`, `area`, `areatime`) VALUES
(1, '05Q119', '2016-07-14', '0', '1H012964', 4, '0天', '高乳', '2023-04-20'),
(2, '05Q127', '2016-07-25', '0', '1H012964', 5, '365天', '高乳', '2023-04-20'),
(3, '06Q5446', '2017-04-06', '0', '1H012964', 3, '564天', '高乳', '2023-04-20'),
(4, '06Q5448', '2017-04-08', '0', '1H012964', 4, '301天', '低乳', '2023-04-20'),
(5, '06Q5450', '2017-04-12', '0', '1H012964', 4, '350天', '高乳', '2023-04-20'),
(6, '06Q5451', '2017-04-20', '0', '1H012964', 4, '337天', '乾乳', '2023-04-20'),
(7, '06Q5483', '2017-05-19', '0', '1H012964', 2, '449天', '乾乳', '2023-04-20'),
(8, '06Q6685', '2017-08-06', '0', '1H012964', 3, '315天', '高乳', '2023-04-20'),
(9, '06Q6695', '2017-08-12', '0', '1H012964', 3, '321天', '乾乳', '2023-04-20'),
(10, '07Q2846', '2018-02-17', '0', '1H012964', 4, '361天', '乾乳', '2023-04-20'),
(11, '07Q2849', '2018-02-25', '0', '1H012964', 3, '453天', '高乳', '2023-04-20'),
(12, '07Q2857', '2018-03-08', '0', '1H012964', 2, '453天', '低乳', '2023-04-20'),
(13, '07Q2859', '2018-03-10', '0', '1H012964', 3, '355天', '低乳', '2023-04-12'),
(14, '07Q2869', '2018-03-18', '0', '1H012964', 2, '380天', '低乳', '2023-01-19'),
(15, '07Q2870', '2018-03-19', '0', '1H012964', 2, '435天', '乾乳', '2023-04-18'),
(16, '07Q2876', '2018-03-23', '0', '1H012964', 2, '457天', '乾乳', '2023-04-18'),
(17, '08Q3982', '2019-04-04', '0', '1H012964', 2, '515天', '高乳', '2023-04-20'),
(18, '08Q3983', '2019-04-06', '0', '1H012964', 2, '493天', '高乳', '2023-04-20'),
(19, '08Q3994', '2019-04-12', '0', '1H012964', 1, '0天', '低乳', '2023-04-20'),
(20, '08Q3995', '2019-04-12', '0', '1H012964', 2, '358天', '乾乳', '2023-04-20'),
(21, '08Q4005', '2019-04-20', '0', '1H012964', 1, '0天', '乾乳', '2023-04-20'),
(22, '08Q4006', '2019-04-21', '0', '1H012964', 1, '0天', '低乳', '2023-04-20'),
(23, '08Q4014', '2019-04-24', '0', '1H012964', 1, '0天', '低乳', '2023-04-20'),
(24, '08Q4038', '2019-04-30', '0', '1H012964', 2, '307天', '乾乳', '2023-04-20'),
(25, '08Q4039', '2019-05-02', '0', '1H012964', 2, '370天', '乾乳', '2023-04-20'),
(26, '09Q2381', '2020-02-06', '0', '1H012964', 1, '0天', '高乳', '2023-04-20'),
(27, '09Q2388', '2020-02-10', '0', '1H012964', 1, '0天', '低乳', '2023-04-20'),
(28, '09Q2393', '2020-02-14', '0', '1H012964', 1, '0天', '低乳', '2023-04-20'),
(29, '09Q2400', '2020-02-21', '0', '1H012964', 1, '0天', '高乳', '2023-04-20'),
(30, '09Q2401', '2020-02-22', '0', '1H012964', 1, '0天', '已受孕', '2023-04-20'),
(31, '09Q2407', '2020-02-25', '0', '1H012964', 1, '0天', '已受孕', '2023-04-20'),
(32, '09Q2408', '2020-02-26', '0', '1H012964', 1, '0天', '已受孕', '2023-04-20'),
(33, '09Q2415', '2020-02-28', '0', '1H012964', 1, '0天', '已受孕', '2023-04-20'),
(34, '09Q2418', '2020-02-29', '0', '1H012964', 1, '0天', '已受孕', '2023-04-20'),
(35, '09Q2419', '2020-02-29', '0', '1H012964', 1, '0天', '已受孕', '2023-04-20'),
(36, '09Q2421', '2020-03-01', '0', '1H012964', 1, '0天', '已受孕', '2023-04-20'),
(37, '09Q2425', '2020-03-03', '0', '1H012964', 1, '0天', '已受孕', '2023-04-20'),
(38, '09Q2426', '2020-03-04', '0', '1H012964', 1, '0天', '已受孕', '2023-04-20'),
(39, '09Q2433', '2020-03-06', '0', '1H012964', 1, '0天', '已受孕', '2023-04-20'),
(40, '09Q2499', '2020-03-15', '0', '1H012964', 1, '0天', '低乳', '2023-04-20'),
(41, '10Q3722', '2021-04-12', '0', '1H012964', 0, '0天', '小牛', '2023-04-20'),
(42, '10Q3723', '2021-04-12', '0', '1H012964', 0, '0天', '小牛', '2023-04-20'),
(43, '10Q3724', '2021-04-12', '0', '1H012964', 0, '0天', '小牛', '2023-04-20'),
(44, '10Q3726', '2021-04-12', '0', '1H012964', 0, '0天', '小牛', '2023-04-20'),
(45, '10Q3727', '2021-04-12', '0', '1H012964', 0, '0天', '小牛', '2023-04-20'),
(46, '10Q3736', '2021-04-14', '0', '1H012964', 0, '0天', '小牛', '2023-04-20'),
(47, '10Q3751', '2021-04-16', '0', '1H012964', 0, '0天', '未受孕', '2022-10-28'),
(48, '10Q3760', '2021-04-16', '0', '1H012964', 0, '0天', '小牛', '2023-04-20'),
(49, '10Q3762', '2021-04-18', '0', '1H012964', 0, '0天', '小牛', '2023-04-20'),
(50, '10Q4728', '2021-05-20', '0', '1H012964', 0, '0天', '未受孕', '2022-07-14'),
(51, '10Q6887', '2021-07-14', '0', '1H012964', 0, '0天', '未受孕', '2022-09-16'),
(52, '10Q6892', '2021-07-14', '0', '1H012964', 1, '0天', '未受孕', '2022-09-16'),
(53, '10Q6895', '2021-07-15', '0', '1H012964', 0, '0天', '未受孕', '2022-09-19'),
(54, '10Q6899', '2021-07-15', '0', '1H012964', 0, '0天', '未受孕', '2022-09-19'),
(55, '10Q6900', '2021-07-15', '0', '1H012964', 0, '0天', '未受孕', '2022-09-19'),
(56, '10Q6901', '2021-07-16', '0', '1H012964', 0, '0天', '未受孕', '2022-09-21'),
(57, '10Q6909', '2021-07-16', '0', '1H012964', 0, '0天', '未受孕', '2022-09-21'),
(58, '10Q7004', '2021-08-23', '0', '1H012964', 0, '0天', '未受孕', '2022-10-28'),
(59, '10Q7005', '2021-08-23', '0', '1H012964', 0, '0天', '小牛', '2023-04-20'),
(60, '10Q7007', '2021-08-24', '0', '1H012964', 0, '0天', '小牛', '2023-04-20');

-- --------------------------------------------------------

--
-- 資料表結構 `cull_module`
--

CREATE TABLE `cull_module` (
  `sn` int(6) NOT NULL,
  `id` varchar(6) NOT NULL,
  `standUp` datetime NOT NULL,
  `crouch` datetime NOT NULL,
  `ingestion` datetime NOT NULL,
  `mating` datetime NOT NULL,
  `buttocksUp` datetime NOT NULL,
  `headOn` datetime NOT NULL,
  `isDel` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `dht`
--

CREATE TABLE `dht` (
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `humidity` double NOT NULL,
  `temperature` double NOT NULL,
  `thi` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `disease_management`
--

CREATE TABLE `disease_management` (
  `sn` int(6) NOT NULL,
  `id` varchar(64) NOT NULL,
  `date` date NOT NULL,
  `disease` varchar(64) NOT NULL,
  `drugs` varchar(64) NOT NULL,
  `vaccines` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `estrus_record`
--

CREATE TABLE `estrus_record` (
  `sn` int(6) NOT NULL,
  `id` varchar(64) NOT NULL,
  `estrusDate` date NOT NULL,
  `intervalDays` varchar(64) NOT NULL,
  `isMating` varchar(64) NOT NULL,
  `semenNumber` varchar(64) NOT NULL,
  `isDel` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `feed_record`
--

CREATE TABLE `feed_record` (
  `sn` int(6) NOT NULL,
  `id` varchar(64) NOT NULL,
  `date` date NOT NULL,
  `genealogy` varchar(64) NOT NULL,
  `concentrate` varchar(64) NOT NULL,
  `forage` varchar(64) NOT NULL,
  `isPregnancy` varchar(64) NOT NULL,
  `lactation` varchar(64) NOT NULL,
  `waterIntake` varchar(64) NOT NULL,
  `feedTime` datetime NOT NULL,
  `recordTime` datetime NOT NULL,
  `isDel` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `mating_module`
--

CREATE TABLE `mating_module` (
  `sn` int(6) NOT NULL,
  `id` varchar(64) NOT NULL,
  `dueDate` date NOT NULL,
  `dateCompleted` date NOT NULL,
  `birthParity` varchar(64) NOT NULL,
  `birthEvent` varchar(64) NOT NULL,
  `area` varchar(64) NOT NULL,
  `class` varchar(64) NOT NULL,
  `isDel` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `mating_record`
--

CREATE TABLE `mating_record` (
  `sn` int(6) NOT NULL,
  `id` varchar(64) NOT NULL,
  `matingDate` date NOT NULL,
  `frequency` varchar(64) NOT NULL,
  `status` varchar(64) NOT NULL,
  `matingMethod` varchar(64) NOT NULL,
  `abortion` varchar(64) NOT NULL,
  `isDel` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `milk_quality_old`
--

CREATE TABLE `milk_quality_old` (
  `sn` int(6) NOT NULL,
  `id` varchar(64) NOT NULL,
  `date` date NOT NULL,
  `milkFatPrecentage` varchar(64) NOT NULL,
  `milkProtein` varchar(64) NOT NULL,
  `somaticCellCount` varchar(64) NOT NULL,
  `acidity` varchar(64) NOT NULL,
  `bloodyMilk` varchar(64) NOT NULL,
  `milkSolidsNotFat` varchar(64) NOT NULL,
  `totalBacteria` varchar(64) NOT NULL,
  `isDel` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `milk_record`
--

CREATE TABLE `milk_record` (
  `sn` int(6) NOT NULL,
  `date` date NOT NULL,
  `quality` varchar(64) NOT NULL,
  `volume` varchar(64) NOT NULL,
  `milkSolidsNotFat` varchar(64) NOT NULL,
  `milkFatPrecentage` varchar(64) NOT NULL,
  `milkProtein` varchar(64) NOT NULL,
  `somaticCellCount` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `parturition_history`
--

CREATE TABLE `parturition_history` (
  `sn` int(6) NOT NULL,
  `id` varchar(64) NOT NULL,
  `date` date NOT NULL,
  `birthParity` varchar(64) NOT NULL,
  `events` varchar(64) NOT NULL,
  `details` varchar(64) NOT NULL,
  `isDel` varchar(64) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `pregnancy_check`
--

CREATE TABLE `pregnancy_check` (
  `sn` int(6) NOT NULL,
  `id` varchar(64) NOT NULL,
  `estrusdate` date NOT NULL,
  `matingdate` date NOT NULL,
  `birthparity` int(64) DEFAULT NULL,
  `intervaldays` varchar(64) DEFAULT NULL,
  `pregnancydate` date DEFAULT NULL,
  `pregnancyresult` varchar(64) DEFAULT NULL,
  `parturitiondate` date DEFAULT NULL,
  `events` varchar(64) DEFAULT NULL,
  `details` varchar(64) DEFAULT NULL,
  `matingcount` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `pregnancy_check`
--

INSERT INTO `pregnancy_check` (`sn`, `id`, `estrusdate`, `matingdate`, `birthparity`, `intervaldays`, `pregnancydate`, `pregnancyresult`, `parturitiondate`, `events`, `details`, `matingcount`) VALUES
(1, '05Q119', '2018-01-16', '2017-11-30', 1, '47天', '2018-01-16', '有', '2018-08-28', '正常', '', 3),
(2, '05Q119', '2019-07-25', '2019-05-18', 2, '68天', '2019-07-25', '有', '2020-03-17', '正常', '', 1),
(3, '05Q119', '2020-12-27', '2020-10-25', 3, '63天', '2020-12-27', '有', '2022-09-23', '正常', '', 5),
(4, '05Q119', '2022-02-21', '2021-12-24', 4, '59天', '2022-02-21', '有', '2022-09-23', '正常', '', 4),
(5, '05Q119', '2023-04-06', '2023-04-06', 5, '0天', '2023-03-27', '無', NULL, NULL, '', 2),
(6, '05Q127', '2018-04-02', '2018-01-10', 1, '82天', '2018-04-02', '有', '2018-10-10', '正常', '', 1),
(7, '05Q127', '2019-01-13', '2018-11-11', 2, '63天', '2019-01-13', '有', '2019-08-09', '正常', '', 1),
(8, '05Q127', '2020-05-10', '2020-03-13', 3, '58天', '2020-05-10', '有', '2020-10-18', '正常', '', 2),
(9, '05Q127', '2021-05-23', '2021-02-17', 4, '95天', '2021-05-23', '有', '2021-11-12', '正常', '', 2),
(10, '05Q127', '2022-05-07', '2022-03-13', 5, '55天', '2022-05-07', '有', '2022-11-12', '正常', '', 1),
(11, '05Q127', '2023-03-25', '2023-03-25', 6, '0天', NULL, NULL, NULL, NULL, NULL, 2),
(12, '06Q5446', '2018-09-08', '2018-07-11', 1, '59天', '2018-09-08', '有', '2019-04-16', '正常', '', 1),
(13, '06Q5446', '2020-11-16', '2020-09-19', 2, '58天', '2020-11-16', '有', '2021-06-20', '正常', '', 2),
(14, '06Q5446', '2022-05-27', '2022-04-07', 3, '50天', '2022-05-27', '有', '2023-01-05', '正常', '', 5),
(15, '06Q5446', '2023-04-06', '2023-04-06', 4, '0天', NULL, NULL, NULL, NULL, NULL, 2),
(16, '06Q5448', '2018-09-07', '2018-07-07', 1, '62天', '2018-09-07', '有', '2019-05-01', '正常', '', 1),
(17, '06Q5448', '2019-12-22', '2019-10-29', 2, '54天', '2019-12-22', '有', '2020-07-30', '正常', '', 3),
(18, '06Q5448', '2021-03-22', '2021-02-01', 3, '49天', '2021-03-22', '有', '2021-10-30', '正常', '', 1),
(19, '06Q5448', '2022-01-23', '2021-11-25', 4, '59天', '2022-01-23', '有', '2022-08-27', '正常', '', 1),
(20, '06Q5448', '2023-03-10', '2023-03-10', 5, '0天', NULL, NULL, NULL, NULL, NULL, 1),
(21, '06Q5450', '2018-11-15', '2018-09-19', 1, '57天', '2018-11-15', '有', '2019-06-17', '正常', '', 1),
(22, '06Q5450', '2019-12-08', '2019-10-13', 2, '56天', '2019-12-08', '有', '2020-07-12', '正常', '', 1),
(23, '06Q5450', '2021-03-22', '2021-01-21', 3, '60天', '2021-03-22', '有', '2021-10-30', '正常', '', 5),
(24, '06Q5450', '2022-04-13', '2022-02-19', 4, '53天', '2022-04-13', '有', '2022-10-15', '正常', '', 3),
(25, '06Q5450', '2023-03-26', '2023-03-26', 5, '0天', NULL, NULL, NULL, NULL, NULL, 2),
(26, '06Q5451', '2018-11-15', '2018-09-18', 1, '58天', '2018-11-15', '有', '2019-06-06', '正常', '', 1),
(27, '06Q5451', '2020-02-09', '2019-11-24', 2, '77天', '2020-02-09', '有', '2020-08-22', '正常', '', 6),
(28, '06Q5451', '2020-11-16', '2020-10-04', 3, '43天', '2020-11-16', '有', '2021-07-02', '正常', '', 1),
(29, '06Q5451', '2021-11-08', '2021-09-06', 4, '63天', '2021-11-08', '有', '2022-06-04', '正常', '', 1),
(30, '06Q5451', '2022-09-24', '2022-07-29', 5, '57天', '2022-09-24', '有', NULL, '', '', 1),
(31, '06Q5483', '2019-10-13', '2019-06-28', 1, '107天', '2019-10-13', '有', '2020-03-25', '正常', '', 1),
(32, '06Q5483', '2020-10-27', '2020-09-12', 2, '45天', '2020-10-27', '有', '2021-06-17', '正常', '', 2),
(33, '06Q5483', '2022-10-23', '2022-08-19', 3, '65天', '2022-10-23', '有', NULL, '', '', 2),
(34, '06Q6685', '2019-10-13', '2019-07-31', 1, '74天', '2019-10-13', '有', '2020-04-30', '正常', '', 2),
(35, '06Q6685', '2021-07-14', '2021-05-09', 2, '66天', '2021-07-14', '有', '2022-02-10', '正常', '', 4),
(36, '06Q6685', '2022-05-09', '2022-03-18', 3, '52天', '2022-05-09', '有', '2022-12-22', '正常', '', 2),
(37, '06Q6685', '2023-04-06', '2023-04-06', 4, '0天', NULL, NULL, NULL, NULL, NULL, 2),
(38, '06Q6695', '2019-10-13', '2019-08-06', 1, '68天', '2019-10-13', '有', '2020-05-03', '正常', '', 2),
(39, '06Q6695', '2020-09-14', '2020-08-01', 2, '44天', '2020-09-14', '有', '2021-04-28', '正常', '', 2),
(40, '06Q6695', '2021-07-26', '2021-06-05', 3, '51天', '2021-07-26', '有', '2022-03-15', '正常', '', 2),
(41, '06Q6695', '2022-09-24', '2022-07-29', 4, '57天', '2022-09-24', '有', NULL, '', '', 1),
(42, '07Q2846', '2019-12-08', '2019-10-16', 1, '53天', '2019-12-08', '有', '2020-07-13', '正常', '', 1),
(43, '07Q2846', '2020-11-16', '2020-09-26', 2, '51天', '2020-11-16', '有', '2021-06-25', '正常', '', 1),
(44, '07Q2846', '2021-11-08', '2021-09-22', 3, '47天', '2021-11-08', '有', '2022-06-21', '正常', '', 2),
(45, '07Q2846', '2022-10-23', '2022-08-19', 4, '65天', '2022-10-23', '有', NULL, '', '', 2),
(46, '07Q2849', '2019-08-17', '2019-06-06', 1, '72天', '2019-08-17', '有', '2020-03-06', '正常', '', 1),
(47, '07Q2849', '2020-10-11', '2020-08-16', 2, '56天', '2020-10-11', '有', '2021-05-16', '正常', '', 4),
(48, '07Q2849', '2022-01-09', '2021-11-12', 3, '58天', '2022-01-09', '有', '2022-08-12', '正常', '', 4),
(49, '07Q2849', '2023-03-25', '2023-03-25', 4, '0天', '2023-02-27', '無', NULL, '', '', 3),
(50, '07Q2857', '2020-07-27', '2020-06-04', 1, '53天', '2020-07-27', '有', '2021-03-05', '正常', '', 3),
(51, '07Q2857', '2021-11-04', '2021-09-01', 2, '64天', '2021-11-04', '有', '2022-06-01', '正常', '', 2),
(52, '07Q2857', '2023-01-10', '2022-11-19', 3, '52天', '2023-01-10', '有', NULL, '', '', 5),
(53, '07Q2859', '2020-10-27', '2020-08-10', 1, '78天', '2020-10-27', '有', '2021-05-10', '正常', '', 3),
(54, '07Q2859', '2021-09-13', '2021-07-29', 2, '46天', '2021-09-13', '有', '2022-04-30', '正常', '', 1),
(55, '07Q2859', '2023-01-09', '2022-11-11', 3, '59天', '2023-01-09', '有', NULL, '', '', 3),
(56, '07Q2869', '2021-03-22', '2021-01-13', 1, '68天', '2021-03-22', '有', '2021-10-05', '正常', '', 6),
(57, '07Q2869', '2022-03-13', '2022-01-17', 2, '55天', '2022-03-13', '有', '2022-10-20', '正常', '', 1),
(58, '07Q2870', '2020-07-26', '2020-05-31', 1, '56天', '2020-07-26', '有', '2021-03-01', '正常', '', 3),
(59, '07Q2870', '2021-09-27', '2021-08-11', 2, '47天', '2021-09-27', '有', '2022-05-10', '正常', '', 2),
(60, '07Q2870', '2022-10-09', '2022-08-16', 3, '54天', '2022-10-09', '有', NULL, '', '', 4),
(61, '07Q2876', '2020-07-26', '2020-06-02', 1, '54天', '2020-07-26', '有', '2021-03-02', '正常', '', 1),
(62, '07Q2876', '2021-11-04', '2021-09-03', 2, '62天', '2021-11-04', '有', '2022-06-02', '正常', '', 4),
(63, '07Q2876', '2022-10-09', '2022-08-06', 3, '64天', '2022-10-09', '有', NULL, '', '', 2),
(64, '08Q3982', '2020-12-27', '2020-11-01', 1, '56天', '2020-12-27', '有', '2021-08-02', '正常', '', 1),
(65, '08Q3982', '2022-05-27', '2022-04-02', 2, '55天', '2022-05-27', '有', '2022-12-30', '正常', '', 3),
(66, '08Q3982', '2023-04-04', '2023-04-04', 3, '0天', NULL, NULL, NULL, NULL, NULL, 1),
(67, '08Q3983', '2020-12-05', '2020-10-18', 1, '48天', '2020-12-05', '有', '2021-07-20', '正常', '', 1),
(68, '08Q3983', '2022-04-13', '2022-02-25', 2, '47天', '2022-04-13', '有', '2022-11-25', '正常', '', 3),
(69, '08Q3983', '2023-03-10', '2023-03-10', 3, '0天', NULL, NULL, NULL, NULL, NULL, 2),
(70, '08Q3994', '2021-06-13', '2021-04-07', 1, '67天', '2021-06-13', '有', '2022-01-05', '正常', '', 1),
(71, '08Q3994', '2022-10-25', '2022-09-11', 2, '44天', '2022-10-25', '有', NULL, '', '', 5),
(72, '08Q3995', '2021-03-22', '2020-11-20', 1, '122天', '2021-03-22', '有', '2021-08-20', '正常', '', 2),
(73, '08Q3995', '2022-01-09', '2021-11-13', 2, '57天', '2022-01-09', '有', '2022-08-13', '正常', '', 1),
(74, '08Q3995', '2022-12-25', '2022-10-25', 3, '61天', '2022-12-25', '有', NULL, '', '', 2),
(75, '08Q4005', '2021-08-22', '2021-06-19', 1, '64天', '2021-08-22', '有', '2022-03-20', '正常', '', 1),
(76, '08Q4005', '2022-10-23', '2022-08-20', 2, '64天', '2022-10-23', '有', NULL, '', '', 1),
(77, '08Q4006', '2021-07-14', '2021-05-08', 1, '67天', '2021-07-14', '有', '2022-02-07', '正常', '', 1),
(78, '08Q4006', '2023-01-10', '2022-11-24', 2, '47天', '2023-01-10', '有', NULL, '', '', 2),
(79, '08Q4014', '2021-07-26', '2021-06-11', 1, '45天', '2021-07-26', '有', '2022-04-10', '正常', '', 1),
(80, '08Q4014', '2023-02-19', '2022-12-26', 2, '55天', '2023-02-19', '有', NULL, '', '', 8),
(81, '08Q4038', '2020-12-05', '2020-10-06', 1, '60天', '2020-12-05', '有', '2021-07-07', '正常', '', 5),
(82, '08Q4038', '2021-09-27', '2021-08-11', 2, '47天', '2021-09-27', '有', '2022-05-10', '正常', '', 1),
(83, '08Q4038', '2022-10-09', '2022-08-14', 3, '56天', '2022-10-09', '有', NULL, '', '', 1),
(84, '08Q4039', '2020-10-27', '2020-08-04', 1, '84天', '2020-10-27', '有', '2021-05-05', '正常', '', 2),
(85, '08Q4039', '2021-09-27', '2021-08-14', 2, '44天', '2021-09-27', '有', '2022-05-10', '正常', '', 3),
(86, '08Q4039', '2022-10-25', '2022-09-10', 3, '45天', '2022-10-25', '有', NULL, '', '', 3),
(87, '09Q2381', '2022-05-27', '2022-04-02', 1, '55天', '2022-05-27', '有', '2023-01-02', '正常', '', 2),
(88, '09Q2381', '2023-04-06', '2023-04-06', 2, '0天', NULL, NULL, NULL, NULL, NULL, 1),
(89, '09Q2388', '2022-06-13', '2022-04-15', 1, '59天', '2022-06-13', '有', '2023-01-14', '正常', '', 3),
(90, '09Q2388', '2023-03-05', '2023-03-05', 2, '0天', NULL, NULL, NULL, NULL, NULL, 1),
(91, '09Q2393', '2022-05-27', '2022-04-04', 1, '53天', '2022-05-27', '有', '2023-01-03', '正常', '', 1),
(92, '09Q2400', '2022-06-13', '2022-05-03', 1, '41天', '2022-06-13', '有', '2023-02-03', '正常', '', 1),
(93, '09Q2400', '2023-02-21', '2023-02-21', 2, '0天', NULL, NULL, NULL, NULL, NULL, 1),
(94, '09Q2401', '2022-05-09', '2022-03-04', 1, '66天', '2022-05-09', '有', NULL, '', '', 1),
(95, '09Q2407', '2023-02-19', '2022-12-22', 1, '59天', '2023-02-19', '有', NULL, '', '', 1),
(96, '09Q2408', '2022-11-20', '2022-08-04', 1, '108天', '2022-11-20', '有', NULL, '', '', 3),
(97, '09Q2415', '2022-07-30', '2022-06-06', 1, '54天', '2022-07-30', '有', NULL, '', '', 1),
(98, '09Q2418', '2022-12-25', '2022-10-12', 1, '74天', '2022-12-25', '有', NULL, '', '', 1),
(99, '09Q2419', '2022-08-28', '2022-06-17', 1, '72天', '2022-08-28', '有', '0000-00-00', '', '', 1),
(100, '09Q2421', '2022-08-28', '2022-06-28', 1, '61天', '2022-08-28', '有', NULL, '', '', 1),
(101, '09Q2425', '2022-08-28', '2022-06-30', 1, '59天', '2022-08-28', '有', NULL, '', '', 1),
(102, '09Q2426', '2022-11-20', '2022-09-20', 1, '61天', '2022-11-20', '有', NULL, '', '', 2),
(103, '09Q2433', '2023-02-19', '2022-12-12', 1, '69天', '2023-02-19', '有', NULL, '', '', 1),
(104, '09Q2499', '2022-05-09', '2022-03-23', 1, '47天', '2022-05-09', '有', NULL, '', '', 1),
(105, '10Q6892', '2023-01-03', '2023-01-03', 1, '0天', NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `rectal_examination`
--

CREATE TABLE `rectal_examination` (
  `sn` int(6) NOT NULL,
  `id` varchar(64) NOT NULL,
  `checkDate` date NOT NULL,
  `pregnancyResult` varchar(64) NOT NULL,
  `isDel` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `sensor_management`
--

CREATE TABLE `sensor_management` (
  `uuid` varchar(64) NOT NULL,
  `model` varchar(64) NOT NULL,
  `states` varchar(64) NOT NULL,
  `cid` varchar(64) NOT NULL,
  `recordTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `sensor_management`
--

INSERT INTO `sensor_management` (`uuid`, `model`, `states`, `cid`, `recordTime`) VALUES
('test!', 'BWT901CL', '活動量高', '05Q127', '2023-04-27 18:12:30'),
('test!123', 'WT901BLECL5.0', '正常', '05Q119', '2023-04-27 18:12:36'),
('test!22', 'nRF52840', '未連接', '06Q5446', '2023-04-27 18:12:40');

-- --------------------------------------------------------

--
-- 資料表結構 `test`
--

CREATE TABLE `test` (
  `time` timestamp(3) NOT NULL DEFAULT current_timestamp(3) ON UPDATE current_timestamp(3),
  `deviceName` varchar(255) NOT NULL,
  `ax` decimal(10,4) NOT NULL,
  `ay` decimal(10,4) NOT NULL,
  `az` decimal(10,4) NOT NULL,
  `wx` decimal(10,4) NOT NULL,
  `wy` decimal(10,4) NOT NULL,
  `wz` decimal(10,4) NOT NULL,
  `x` decimal(10,4) NOT NULL,
  `y` decimal(10,4) NOT NULL,
  `z` decimal(10,4) NOT NULL,
  `hx` decimal(10,4) NOT NULL,
  `hy` decimal(10,4) NOT NULL,
  `hz` decimal(10,4) NOT NULL,
  `temp` decimal(10,4) NOT NULL,
  `q0` decimal(10,4) NOT NULL,
  `q1` decimal(10,4) NOT NULL,
  `q2` decimal(10,4) NOT NULL,
  `q3` decimal(10,4) NOT NULL,
  `battery` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `test2`
--

CREATE TABLE `test2` (
  `time` timestamp(3) NOT NULL DEFAULT current_timestamp(3) ON UPDATE current_timestamp(3),
  `deviceName` varchar(255) NOT NULL,
  `ax` decimal(10,4) NOT NULL,
  `ay` decimal(10,4) NOT NULL,
  `az` decimal(10,4) NOT NULL,
  `wx` decimal(10,4) NOT NULL,
  `wy` decimal(10,4) NOT NULL,
  `wz` decimal(10,4) NOT NULL,
  `x` decimal(10,4) NOT NULL,
  `y` decimal(10,4) NOT NULL,
  `z` decimal(10,4) NOT NULL,
  `hx` decimal(10,4) NOT NULL,
  `hy` decimal(10,4) NOT NULL,
  `hz` decimal(10,4) NOT NULL,
  `temp` decimal(10,4) NOT NULL,
  `q0` decimal(10,4) NOT NULL,
  `q1` decimal(10,4) NOT NULL,
  `q2` decimal(10,4) NOT NULL,
  `q3` decimal(10,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `sn` int(6) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `hint` varchar(64) NOT NULL,
  `hintAns` varchar(64) NOT NULL,
  `showPassword` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`sn`, `username`, `password`, `hint`, `hintAns`, `showPassword`) VALUES
(1, 'Admin', 'e3afed0047b08059d0fada10f400c1e5', 'Admin', 'Admin', 'Admin'),
(2, 'test', 'test', '', '', ''),
(3, 'test', 'test', '', '', ''),
(4, 'test', '098f6bcd4621d373cade4e832627b4f6', 'test', 'test', 'test');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `cows_information`
--
ALTER TABLE `cows_information`
  ADD PRIMARY KEY (`sn`);

--
-- 資料表索引 `cull_module`
--
ALTER TABLE `cull_module`
  ADD PRIMARY KEY (`sn`);

--
-- 資料表索引 `dht`
--
ALTER TABLE `dht`
  ADD PRIMARY KEY (`time`);

--
-- 資料表索引 `disease_management`
--
ALTER TABLE `disease_management`
  ADD PRIMARY KEY (`sn`);

--
-- 資料表索引 `estrus_record`
--
ALTER TABLE `estrus_record`
  ADD PRIMARY KEY (`sn`);

--
-- 資料表索引 `feed_record`
--
ALTER TABLE `feed_record`
  ADD PRIMARY KEY (`sn`);

--
-- 資料表索引 `mating_module`
--
ALTER TABLE `mating_module`
  ADD PRIMARY KEY (`sn`);

--
-- 資料表索引 `mating_record`
--
ALTER TABLE `mating_record`
  ADD PRIMARY KEY (`sn`);

--
-- 資料表索引 `milk_quality_old`
--
ALTER TABLE `milk_quality_old`
  ADD PRIMARY KEY (`sn`);

--
-- 資料表索引 `milk_record`
--
ALTER TABLE `milk_record`
  ADD PRIMARY KEY (`sn`);

--
-- 資料表索引 `parturition_history`
--
ALTER TABLE `parturition_history`
  ADD PRIMARY KEY (`sn`);

--
-- 資料表索引 `pregnancy_check`
--
ALTER TABLE `pregnancy_check`
  ADD PRIMARY KEY (`sn`);

--
-- 資料表索引 `rectal_examination`
--
ALTER TABLE `rectal_examination`
  ADD PRIMARY KEY (`sn`);

--
-- 資料表索引 `sensor_management`
--
ALTER TABLE `sensor_management`
  ADD PRIMARY KEY (`uuid`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`sn`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `cows_information`
--
ALTER TABLE `cows_information`
  MODIFY `sn` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `cull_module`
--
ALTER TABLE `cull_module`
  MODIFY `sn` int(6) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `disease_management`
--
ALTER TABLE `disease_management`
  MODIFY `sn` int(6) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `estrus_record`
--
ALTER TABLE `estrus_record`
  MODIFY `sn` int(6) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `feed_record`
--
ALTER TABLE `feed_record`
  MODIFY `sn` int(6) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `mating_module`
--
ALTER TABLE `mating_module`
  MODIFY `sn` int(6) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `mating_record`
--
ALTER TABLE `mating_record`
  MODIFY `sn` int(6) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `milk_quality_old`
--
ALTER TABLE `milk_quality_old`
  MODIFY `sn` int(6) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `milk_record`
--
ALTER TABLE `milk_record`
  MODIFY `sn` int(6) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `parturition_history`
--
ALTER TABLE `parturition_history`
  MODIFY `sn` int(6) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `pregnancy_check`
--
ALTER TABLE `pregnancy_check`
  MODIFY `sn` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `rectal_examination`
--
ALTER TABLE `rectal_examination`
  MODIFY `sn` int(6) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `sn` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
