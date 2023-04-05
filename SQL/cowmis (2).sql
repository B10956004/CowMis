-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-03-16 09:39:27
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
(1, '09Q139', '2020-06-08', '04Q139', ' 029HO13246', 1, '0天', '高乳', '2023-01-02'),
(2, '10Q139', '2021-12-13', '04Q139', ' 029HO13246', 2, '553天', '未受孕', '2023-01-02'),
(3, '11Q139', '2022-12-17', '04Q139', ' 029HO13246', 3, '369天', '乾乳', '2023-01-04'),
(4, '08Q139', '2019-01-01', '04Q139', '029HO13246', 4, '1446天', '低乳', '2022-12-01');

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

--
-- 傾印資料表的資料 `cull_module`
--

INSERT INTO `cull_module` (`sn`, `id`, `standUp`, `crouch`, `ingestion`, `mating`, `buttocksUp`, `headOn`, `isDel`) VALUES
(1, '05Q139', '2022-09-20 01:56:00', '2022-09-20 01:52:00', '2022-09-20 01:53:00', '2022-09-20 01:54:00', '2022-09-20 01:55:00', '2022-09-20 01:57:00', 0);

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

--
-- 傾印資料表的資料 `disease_management`
--

INSERT INTO `disease_management` (`sn`, `id`, `date`, `disease`, `drugs`, `vaccines`) VALUES
(1, '10Q139', '2022-12-31', '乳房炎', '蹄病藥', '乳房炎疫苗');

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

--
-- 傾印資料表的資料 `estrus_record`
--

INSERT INTO `estrus_record` (`sn`, `id`, `estrusDate`, `intervalDays`, `isMating`, `semenNumber`, `isDel`) VALUES
(1, '05Q139', '2022-09-20', '3', '是', '666666', 0);

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

--
-- 傾印資料表的資料 `feed_record`
--

INSERT INTO `feed_record` (`sn`, `id`, `date`, `genealogy`, `concentrate`, `forage`, `isPregnancy`, `lactation`, `waterIntake`, `feedTime`, `recordTime`, `isDel`) VALUES
(1, '05Q139', '2022-09-20', '97F0039', '否', '1', '否', '否', '100', '2022-09-20 01:13:00', '2022-09-20 13:13:00', 0),
(2, '05Q139', '2022-09-27', '97F0039', '2', '2', '否', '否', '150', '2022-09-27 21:35:00', '2022-09-28 21:35:00', 0);

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

--
-- 傾印資料表的資料 `mating_module`
--

INSERT INTO `mating_module` (`sn`, `id`, `dueDate`, `dateCompleted`, `birthParity`, `birthEvent`, `area`, `class`, `isDel`) VALUES
(1, '05Q139', '2022-12-10', '2022-09-30', '2', '單胎', '泌乳區', '大母牛', 0);

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

--
-- 傾印資料表的資料 `mating_record`
--

INSERT INTO `mating_record` (`sn`, `id`, `matingDate`, `frequency`, `status`, `matingMethod`, `abortion`, `isDel`) VALUES
(1, '05Q139', '2022-09-19', '1', '即時', '人工', '否', 0),
(2, '05Q139', '2022-09-19', '1', '即時', '人工', '否', 0);

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

--
-- 傾印資料表的資料 `milk_quality_old`
--

INSERT INTO `milk_quality_old` (`sn`, `id`, `date`, `milkFatPrecentage`, `milkProtein`, `somaticCellCount`, `acidity`, `bloodyMilk`, `milkSolidsNotFat`, `totalBacteria`, `isDel`) VALUES
(1, '05Q139', '2022-09-19', '7.4', '3.26%', '24.0', '0.12', '有', '7.11', '9.6萬', 0);

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

--
-- 傾印資料表的資料 `milk_record`
--

INSERT INTO `milk_record` (`sn`, `date`, `quality`, `volume`, `milkSolidsNotFat`, `milkFatPrecentage`, `milkProtein`, `somaticCellCount`) VALUES
(1, '2022-12-31', 'A', '30', '7.11', '7.4', '3.26%', '24.0');

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

--
-- 傾印資料表的資料 `parturition_history`
--

INSERT INTO `parturition_history` (`sn`, `id`, `date`, `birthParity`, `events`, `details`, `isDel`) VALUES
(1, '05Q139', '2022-12-08', '2', '胎衣滯留', '一母', '0');

-- --------------------------------------------------------

--
-- 資料表結構 `pregnancy_check`
--

CREATE TABLE `pregnancy_check` (
  `sn` int(6) NOT NULL,
  `id` varchar(64) NOT NULL,
  `estrusdate` date NOT NULL,
  `matingdate` date NOT NULL,
  `birthparity` varchar(64) DEFAULT NULL,
  `intervaldays` varchar(64) DEFAULT NULL,
  `pregnancydate` date DEFAULT NULL,
  `pregnancyresult` varchar(64) DEFAULT NULL,
  `parturitiondate` date DEFAULT NULL,
  `events` varchar(64) DEFAULT NULL,
  `details` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `pregnancy_check`
--

INSERT INTO `pregnancy_check` (`sn`, `id`, `estrusdate`, `matingdate`, `birthparity`, `intervaldays`, `pregnancydate`, `pregnancyresult`, `parturitiondate`, `events`, `details`) VALUES
(3, '11Q139', '2023-02-17', '2023-01-03', '1', '45天', '2022-06-01', '有', '0000-00-00', '', '');

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

--
-- 傾印資料表的資料 `rectal_examination`
--

INSERT INTO `rectal_examination` (`sn`, `id`, `checkDate`, `pregnancyResult`, `isDel`) VALUES
(1, '05Q139', '2022-09-21', '無', 0);

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
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `sn` int(6) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `hint` varchar(64) NOT NULL,
  `hintAns` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`sn`, `username`, `password`, `hint`, `hintAns`) VALUES
(1, 'Admin', 'Admin', 'Admin', 'Admin'),
(2, 'test', 'test', '', ''),
(3, 'test', 'test', '', '');

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
  MODIFY `sn` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `cull_module`
--
ALTER TABLE `cull_module`
  MODIFY `sn` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `disease_management`
--
ALTER TABLE `disease_management`
  MODIFY `sn` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `estrus_record`
--
ALTER TABLE `estrus_record`
  MODIFY `sn` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `feed_record`
--
ALTER TABLE `feed_record`
  MODIFY `sn` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `mating_module`
--
ALTER TABLE `mating_module`
  MODIFY `sn` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `mating_record`
--
ALTER TABLE `mating_record`
  MODIFY `sn` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `milk_quality_old`
--
ALTER TABLE `milk_quality_old`
  MODIFY `sn` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `milk_record`
--
ALTER TABLE `milk_record`
  MODIFY `sn` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `parturition_history`
--
ALTER TABLE `parturition_history`
  MODIFY `sn` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `pregnancy_check`
--
ALTER TABLE `pregnancy_check`
  MODIFY `sn` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `rectal_examination`
--
ALTER TABLE `rectal_examination`
  MODIFY `sn` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `sn` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
