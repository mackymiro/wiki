-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2017 at 04:10 AM
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
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(60) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`user_id`, `name`, `email`, `start_date`, `end_date`) VALUES
(19, 'ricgabz', 'test@gmail.com', '2017-07-01', '2017-07-31'),
(22, 'jhenise estellore', 'gabunada.rb@ntsp.nec.co.jp', '2017-07-01', '2017-07-31'),
(28, 'test', 'gabunada.rb@ntsp.nec.co.jp', '2017-07-01', '2017-07-31'),
(29, 'tester', 'gabunada.rb@ntsp.nec.co.jp', '2017-08-01', '2017-08-31'),
(30, 'rico', 'gabunada.rb@ntsp.nec.co.jp', '2017-08-01', '2017-08-31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
