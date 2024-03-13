-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-03-13 12:55:38
-- 伺服器版本： 10.4.32-MariaDB
-- PHP 版本： 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `the_travel_project`
--

-- --------------------------------------------------------

--
-- 資料表結構 `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `registration_time` datetime NOT NULL,
  `last_login_time` datetime DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='管理員';

--
-- 傾印資料表的資料 `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `password`, `email`, `registration_time`, `last_login_time`, `role_id`, `status`) VALUES
(1, '李千囷', '123456', 'lars108218@gmail.com', '2024-03-08 12:45:14', NULL, 1, 1),
(2, '張筱筠', '123456', 'molly3898@gmail.com', '2024-03-08 12:45:14', NULL, 1, 1),
(3, '韓光樺', '123456', 'helenhan46@gmail.com', '2024-03-08 12:45:14', NULL, 1, 1),
(4, '周韋霆', '123456', 'asd0979724893@gmail.com', '2024-03-08 12:45:14', NULL, 1, 1),
(5, '黄柏皓', '123456', 'daniel1761590944@gmail.com', '2024-03-08 12:45:14', NULL, 1, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
