-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2018 at 09:18 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `i_league`
--
CREATE DATABASE IF NOT EXISTS `i_league` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `i_league`;

-- --------------------------------------------------------

--
-- Table structure for table `injuries`
--

CREATE TABLE IF NOT EXISTS `injuries` (
  `p_id` int(3) NOT NULL,
  `i_date` date NOT NULL,
  `t_o_i` varchar(30) DEFAULT NULL,
  `e_date` date NOT NULL,
  PRIMARY KEY (`p_id`,`i_date`),
  KEY `p_id` (`p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE IF NOT EXISTS `matches` (
  `m_date` date NOT NULL,
  `t_home` varchar(30) NOT NULL,
  `t_away` varchar(30) NOT NULL,
  `venue` text NOT NULL,
  `h_goals` int(2) NOT NULL DEFAULT '0',
  `a_goals` int(2) NOT NULL DEFAULT '0',
  `m_referee` text NOT NULL,
  `comment` text,
  PRIMARY KEY (`m_date`,`t_home`,`t_away`),
  KEY `t_home` (`t_home`),
  KEY `t_away` (`t_away`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`m_date`, `t_home`, `t_away`, `venue`, `h_goals`, `a_goals`, `m_referee`, `comment`) VALUES
('2013-10-09', 'LAJONG FC', 'EAST BENGAL', 'Manipal', 0, 4, 'Tony Mark', ''),
('2013-10-10', 'MINERVA PUNJAB FC', 'INDIAN ARROWS', 'Delhi', 2, 0, 'Mr Yu', ''),
('2015-02-01', 'MUMBAI CITY FC', 'EAST BENGAL', 'Chatrapati Shivaji Stadium', 0, 0, 'Bruce Mayne', ''),
('2015-05-30', 'LAJONG FC', 'MOHUN BAGAN', 'Manipal', 5, 1, 'Clark Dent', ''),
('2015-05-31', 'BENGALURU FC', 'MOHUN BAGAN', 'Bangalore Stadium', 1, 1, 'Denver Riddle', ''),
('2016-01-09', 'MOHUN BAGAN', 'AIZAWL', 'Yuva Bharati', 3, 1, 'Wang Shen', ''),
('2016-01-10', 'SPORTING CLUB GOA', 'EAST BENGAL', 'Goa', 1, 3, 'Mike Dean', ''),
('2016-02-27', 'MUMBAI CITY FC', 'SPORTING CLUB GOA', 'Chatrapati Shivaji Stadium', 2, 2, 'Clent Russel', ''),
('2017-11-25', 'MINERVA PUNJAB FC', 'MOHUN BAGAN', 'Guru Nanak Stadium', 1, 1, 'Martin Atkinson', 'Inaugural Match of I league 2017'),
('2017-11-27', 'LAJONG FC', 'GOKULAM KERALA', 'Jin Stadium', 1, 0, 'Wang Shen', ''),
('2017-11-28', 'EAST BENGAL', 'AIZAWL', 'Vybk Stadium', 2, 2, 'Anthony Taylor', ''),
('2017-12-03', 'MOHUN BAGAN', 'EAST BENGAL', 'Vybk Stadium', 1, 0, 'Mike Dean', 'Derby');

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE IF NOT EXISTS `player` (
  `p_id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `position` varchar(30) DEFAULT NULL,
  `skill_level` int(3) DEFAULT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`p_id`, `name`, `position`, `skill_level`) VALUES
(9, 'DAVID NGHIATE', 'FORWARD', 40),
(10, 'DEBJIT MAJUMDER', 'DEFENDER', 30),
(11, 'LAL KAMAL BHOUMIK', 'FORWARD', 60),
(12, 'DENSON DEVDAS', 'MIDFIELDER', 30),
(13, 'BALWANT SINGH', 'FORWARD', 60),
(14, 'SONY NORDE', 'FORWARD', 40),
(15, 'DHANARAJAN', 'DEFENDER', 80),
(16, 'SOUMIK DEY', 'FORWARD', 40),
(17, 'MEHTAB HOSSAIN', 'MIDFIELDER', 90),
(18, 'RANTI MARTIN', 'MIDFIELDER', 50),
(19, 'ABHIJIT DAS', 'DEFENDER', 30),
(20, 'BIKAS JAIRU', 'FORWARD', 40),
(21, 'SUBRATA PAUL', 'GOAL KEEPER', 70),
(22, 'PAWAN KUMAR', 'GOAL KEEPER', 20),
(23, 'SUKHWINDER SINGH', 'MIDFIELDER', 40),
(24, 'HARMANJOT KHABRA', 'DEFENDER', 60),
(25, 'CREASON ANTO', 'FORWARD', 40),
(26, 'BIKRAM PAL', 'GOAL KEEPER', 60),
(27, 'MANIK DEY', 'FORWARD', 50),
(28, 'DAVID LALRINMUANA', 'MIDFIELDER', 58),
(29, 'SUNIL CHHETRI', 'FORWARD', 62),
(30, 'JOYNER LOURENCO', 'DEFENDER', 59),
(31, 'CLINTU CLEETUS', 'DEFENDER', 68),
(32, 'RICHARD COSTA', 'MIDFIELDER', 64),
(33, 'SUSANTH MATHEW', 'GOALKEEPER', 60),
(34, 'AMARJIT KHURANA', 'DEFENDER', 59),
(35, 'SANDEEP SINGH', 'STRIKER', 71),
(37, 'LALIT THAPA', 'GOALKEEPER', 45);

-- --------------------------------------------------------

--
-- Table structure for table `plays_for`
--

CREATE TABLE IF NOT EXISTS `plays_for` (
  `t_name` varchar(30) NOT NULL,
  `p_id` int(3) NOT NULL,
  PRIMARY KEY (`t_name`,`p_id`),
  KEY `t_name` (`t_name`),
  KEY `p_id` (`p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plays_for`
--

INSERT INTO `plays_for` (`t_name`, `p_id`) VALUES
('AIZAWL', 9),
('AIZAWL', 28),
('BENGALURU FC', 29),
('BENGALURU FC', 30),
('CHENNAI CITY', 25),
('CHENNAI CITY', 31),
('EAST BENGAL', 15),
('EAST BENGAL', 16),
('EAST BENGAL', 17),
('EAST BENGAL', 18),
('EAST BENGAL', 26),
('EAST BENGAL', 32),
('GOKULAM KERALA', 22),
('GOKULAM KERALA', 24),
('GOKULAM KERALA', 33),
('INDIAN ARROWS', 19),
('INDIAN ARROWS', 20),
('INDIAN ARROWS', 34),
('LAJONG FC', 21),
('LAJONG FC', 23),
('LAJONG FC', 35),
('MINERVA PUNJAB FC', 37),
('MOHUN BAGAN', 10),
('MOHUN BAGAN', 11),
('MOHUN BAGAN', 12),
('MOHUN BAGAN', 14),
('MUMBAI CITY FC', 13),
('SPORTING CLUB GOA', 27);

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

CREATE TABLE IF NOT EXISTS `points` (
  `season` int(4) NOT NULL,
  `team` varchar(30) NOT NULL,
  `points` int(11) NOT NULL,
  PRIMARY KEY (`season`,`team`),
  KEY `team` (`team`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `points`
--

INSERT INTO `points` (`season`, `team`, `points`) VALUES
(2013, 'EAST BENGAL', 4),
(2013, 'LAJONG FC', 1),
(2013, 'MINERVA PUNJAB FC', 3),
(2015, 'BENGALURU FC', 1),
(2015, 'EAST BENGAL', 1),
(2015, 'LAJONG FC', 3),
(2015, 'MOHUN BAGAN', 1),
(2015, 'MUMBAI CITY FC', 1),
(2016, 'EAST BENGAL', 3),
(2016, 'MOHUN BAGAN', 3),
(2016, 'MUMBAI CITY FC', 1),
(2016, 'SPORTING CLUB GOA', 1),
(2017, 'AIZAWL', 1),
(2017, 'EAST BENGAL', 1),
(2017, 'LAJONG FC', 3),
(2017, 'MINERVA PUNJAB FC', 1),
(2017, 'MOHUN BAGAN', 4);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE IF NOT EXISTS `team` (
  `name` varchar(30) NOT NULL,
  `coach` varchar(30) NOT NULL,
  `home_city` varchar(30) NOT NULL,
  `captain_id` int(3) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `captain_id` (`captain_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`name`, `coach`, `home_city`, `captain_id`) VALUES
('AIZAWL', 'PAULO MENEZES', 'MIZORAM', 28),
('BENGALURU FC', 'ALBERT ROCA', 'BENGALURU', 29),
('CHENNAI CITY', 'V SOUNDARARAJAN', 'CHENNAI', 31),
('EAST BENGAL', 'KHALID JAMIL', 'KOLKATA', 32),
('GOKULAM KERALA', 'BINO GEORGE', 'KERALA', 33),
('INDIAN ARROWS', 'LUIS NORTON DE MATOS', 'DELHI', 34),
('LAJONG FC', 'BOBBY NONGBET', 'SHILLONG', 23),
('MINERVA PUNJAB FC', 'KHOGEN SINGH', 'LUDHIANA', 37),
('MOHUN BAGAN', 'SANJOY SEN', 'KOLKATA', 14),
('MUMBAI CITY FC', 'ALEXANDRE GUIMARAES', 'MUMBAI', 13),
('SPORTING CLUB GOA', 'MATEUS COSTA', 'GOA', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `injuries`
--
ALTER TABLE `injuries`
  ADD CONSTRAINT `fk_injuries_player` FOREIGN KEY (`p_id`) REFERENCES `player` (`p_id`) ON UPDATE CASCADE;

--
-- Constraints for table `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `fk_matches_team_away` FOREIGN KEY (`t_away`) REFERENCES `team` (`name`),
  ADD CONSTRAINT `fk_matches_team_home` FOREIGN KEY (`t_home`) REFERENCES `team` (`name`);

--
-- Constraints for table `plays_for`
--
ALTER TABLE `plays_for`
  ADD CONSTRAINT `fk_plays_player` FOREIGN KEY (`p_id`) REFERENCES `player` (`p_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_plays_team` FOREIGN KEY (`t_name`) REFERENCES `team` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `points`
--
ALTER TABLE `points`
  ADD CONSTRAINT `fk_points_team` FOREIGN KEY (`team`) REFERENCES `team` (`name`);

--
-- Constraints for table `team`
--
ALTER TABLE `team`
  ADD CONSTRAINT `fk_team_player` FOREIGN KEY (`captain_id`) REFERENCES `player` (`p_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
