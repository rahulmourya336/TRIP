-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2018 at 10:15 AM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trip`
--

-- --------------------------------------------------------

--
-- Table structure for table `dummy_table`
--

CREATE TABLE `dummy_table` (
  `id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dummy_table`
--

INSERT INTO `dummy_table` (`id`, `t_id`, `u_id`) VALUES
(21, 1, 2),
(22, 29, 0),
(23, 31, 0),
(24, 1, 2),
(25, 29, 24),
(26, 31, 24);

-- --------------------------------------------------------

--
-- Table structure for table `trip_expenese`
--

CREATE TABLE `trip_expenese` (
  `ex_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `ex_name` varchar(45) DEFAULT NULL,
  `ex_date` date DEFAULT NULL,
  `ex_amount` decimal(10,0) DEFAULT NULL,
  `c_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trip_expense_category`
--

CREATE TABLE `trip_expense_category` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trip_list`
--

CREATE TABLE `trip_list` (
  `t_id` int(11) NOT NULL,
  `t_url` varchar(400) DEFAULT NULL,
  `t_name` varchar(45) DEFAULT NULL,
  `t_start_date` date DEFAULT NULL,
  `t_end_date` date DEFAULT NULL,
  `t_creator_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trip_list`
--

INSERT INTO `trip_list` (`t_id`, `t_url`, `t_name`, `t_start_date`, `t_end_date`, `t_creator_id`) VALUES
(64, 'https://media-cdn.tripadvisor.com/media/photo-s/03/9b/2f/ce/maldives.jpg', 'Maldives', '2018-08-09', '2018-08-09', 31);

-- --------------------------------------------------------

--
-- Table structure for table `trip_traveller`
--

CREATE TABLE `trip_traveller` (
  `tr_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trip_traveller`
--

INSERT INTO `trip_traveller` (`tr_id`, `t_id`, `u_id`) VALUES
(10, 64, 29),
(11, 64, 30),
(12, 64, 31);

-- --------------------------------------------------------

--
-- Table structure for table `trip_user`
--

CREATE TABLE `trip_user` (
  `u_id` int(11) NOT NULL,
  `u_name` varchar(45) DEFAULT NULL,
  `u_email` varchar(45) DEFAULT NULL,
  `u_mobile` varchar(45) DEFAULT NULL,
  `u_password` varchar(45) DEFAULT NULL,
  `u_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trip_user`
--

INSERT INTO `trip_user` (`u_id`, `u_name`, `u_email`, `u_mobile`, `u_password`, `u_status`) VALUES
(29, 'Rahul Mourya', 'abc@gmail.com', '123413123', 'e10adc3949ba59abbe56e057f20f883e', 1),
(30, 'Shivali', 'shivali@gmail.com', '2345789', '827ccb0eea8a706c4c34a16891f84e7b', 1),
(31, 'Bipin', 'bipin@bipin.com', '123456789', '81dc9bdb52d04dc20036dbd8313ed055', 1),
(32, 'Vedant', 'noname@gmail.com', '12345678', '827ccb0eea8a706c4c34a16891f84e7b', 1),
(33, 'James', 'james@jhon.com', '1234567', '827ccb0eea8a706c4c34a16891f84e7b', 1),
(34, 'Jira', 'jira@home.com', '1234567', '827ccb0eea8a706c4c34a16891f84e7b', 1),
(35, 'one', 'one@one.com', '12345678', '962012d09b8170d912f0669f6d7d9d07', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dummy_table`
--
ALTER TABLE `dummy_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trip_expenese`
--
ALTER TABLE `trip_expenese`
  ADD PRIMARY KEY (`ex_id`),
  ADD KEY `t_id_idx` (`t_id`),
  ADD KEY `u_id_idx` (`u_id`),
  ADD KEY `c_id_idx` (`c_id`);

--
-- Indexes for table `trip_expense_category`
--
ALTER TABLE `trip_expense_category`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `trip_list`
--
ALTER TABLE `trip_list`
  ADD PRIMARY KEY (`t_id`),
  ADD KEY `t_creator_id_idx` (`t_creator_id`);

--
-- Indexes for table `trip_traveller`
--
ALTER TABLE `trip_traveller`
  ADD PRIMARY KEY (`tr_id`),
  ADD KEY `t_id` (`t_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `trip_user`
--
ALTER TABLE `trip_user`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dummy_table`
--
ALTER TABLE `dummy_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `trip_list`
--
ALTER TABLE `trip_list`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `trip_traveller`
--
ALTER TABLE `trip_traveller`
  MODIFY `tr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `trip_user`
--
ALTER TABLE `trip_user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `trip_list`
--
ALTER TABLE `trip_list`
  ADD CONSTRAINT `trip_list_ibfk_1` FOREIGN KEY (`t_creator_id`) REFERENCES `trip_user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trip_traveller`
--
ALTER TABLE `trip_traveller`
  ADD CONSTRAINT `trip_traveller_ibfk_1` FOREIGN KEY (`t_id`) REFERENCES `trip_list` (`t_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trip_traveller_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `trip_user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
