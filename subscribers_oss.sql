-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2017 at 04:16 AM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oss-tc`
--

-- --------------------------------------------------------

--
-- Table structure for table `subscribers_oss`
--

CREATE TABLE `subscribers_oss` (
  `oss_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `oss_name` varchar(1000) NOT NULL
) ;

--
-- Dumping data for table `subscribers_oss`
--

INSERT INTO `subscribers_oss` (`oss_id`, `user_id`, `oss_name`) VALUES
(2, 19, 'Zabbix'),
(3, 19, 'Ansible'),
(6, 28, 'Zabbix'),
(11, 29, 'Zabbix'),
(12, 29, 'Ansible');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `subscribers_oss`
--
ALTER TABLE `subscribers_oss`
  ADD PRIMARY KEY (`oss_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subscribers_oss`
--
ALTER TABLE `subscribers_oss`
  MODIFY `oss_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `subscribers_oss`
--
ALTER TABLE `subscribers_oss`
  ADD CONSTRAINT `subscribers_oss_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `subscribers` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
