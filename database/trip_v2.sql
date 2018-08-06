-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2018 at 07:52 AM
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
-- Table structure for table `trip_expenese`
--

CREATE TABLE `trip_expenese` (
  `ex_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `ex_name` varchar(45) DEFAULT NULL,
  `ex_date` date DEFAULT NULL,
  `ex_amount` decimal(10,0) DEFAULT NULL,
  `c_id` int(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trip_expenese`
--

INSERT INTO `trip_expenese` (`ex_id`, `t_id`, `u_id`, `ex_name`, `ex_date`, `ex_amount`, `c_id`) VALUES
(28, 68, 29, 'Sanju', '2018-08-09', '180', 9),
(29, 68, 43, 'Petrol', '2018-08-09', '200', 8),
(30, 68, 43, 'Petrol', '2018-08-09', '200', 8),
(31, 68, 43, 'Dinner', '2018-08-09', '200', 7),
(32, 70, 43, 'Dinner', '2018-08-09', '200', 7),
(33, 70, 43, 'Breakfast', '2018-08-09', '2000', 7),
(34, 70, 43, 'Dhadak', '2018-08-09', '200', 9),
(35, 70, 43, 'Beer', '2018-08-09', '20030', 10),
(36, 70, 29, 'Petrol', '2018-08-09', '5000', 8);

-- --------------------------------------------------------

--
-- Table structure for table `trip_expense_category`
--

CREATE TABLE `trip_expense_category` (
  `ex_id` int(11) NOT NULL,
  `ex_name` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trip_expense_category`
--

INSERT INTO `trip_expense_category` (`ex_id`, `ex_name`) VALUES
(7, 'Food'),
(8, 'Travel'),
(9, 'Entertainment'),
(10, 'Misc'),
(11, 'Others');

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
(68, 'http://www.keralatravels.com/webadmin/upload/1444/kerala-houseboat-packages.jpg', 'Kerela', '2018-08-09', '2018-08-09', 29),
(69, 'https://media-cdn.tripadvisor.com/media/photo-s/03/9b/2f/ce/maldives.jpg', 'Maldives', '2018-08-03', '2018-08-25', 43),
(70, 'https://blog.thomascook.in/wp-content/uploads/2017/09/Picture12.jpg', 'St. Lucia', '2018-08-09', '2018-08-17', 43);

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
(53, 68, 30),
(54, 68, 32),
(55, 68, 33),
(56, 68, 29),
(57, 69, 39),
(58, 69, 33),
(59, 69, 34),
(60, 69, 43),
(61, 70, 39),
(62, 70, 33),
(63, 70, 34),
(64, 70, 37),
(65, 70, 38),
(66, 70, 29),
(67, 70, 40),
(68, 70, 30),
(69, 70, 32),
(70, 70, 36),
(71, 70, 43);

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
(32, 'Vedant', 'noname@gmail.com', '12345678', '827ccb0eea8a706c4c34a16891f84e7b', 1),
(33, 'James', 'james@jhon.com', '1234567', '827ccb0eea8a706c4c34a16891f84e7b', 1),
(34, 'Jira', 'jira@home.com', '1234567', '827ccb0eea8a706c4c34a16891f84e7b', 1),
(36, 'VedantKPatwa', 'patwavedant@gmail.com', '7069584513', '25f9e794323b453885f5181f1b624d0b', 1),
(37, 'mudit', 'm@m.com', '123456789', 'e10adc3949ba59abbe56e057f20f883e', 1),
(38, 'parth', 'p@p.com', '12345678', 'e10adc3949ba59abbe56e057f20f883e', 1),
(39, 'Dharmesh', 'd@d.com', '123456789', 'e10adc3949ba59abbe56e057f20f883e', 1),
(40, 'Rahul Mourya', 'rahulmourya336@gmail.com', '8140397093', 'e10adc3949ba59abbe56e057f20f883e', 1),
(43, 'Bipin', 'bipin@bipin.com', '1234567890', 'e10adc3949ba59abbe56e057f20f883e', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `trip_expenese`
--
ALTER TABLE `trip_expenese`
  ADD PRIMARY KEY (`ex_id`),
  ADD KEY `t_id_idx` (`t_id`),
  ADD KEY `u_id_idx` (`u_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `trip_expense_category`
--
ALTER TABLE `trip_expense_category`
  ADD PRIMARY KEY (`ex_id`);

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
  ADD KEY `trip_traveller_ibfk_1` (`t_id`),
  ADD KEY `trip_traveller_ibfk_2` (`u_id`);

--
-- Indexes for table `trip_user`
--
ALTER TABLE `trip_user`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `trip_expenese`
--
ALTER TABLE `trip_expenese`
  MODIFY `ex_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `trip_expense_category`
--
ALTER TABLE `trip_expense_category`
  MODIFY `ex_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `trip_list`
--
ALTER TABLE `trip_list`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `trip_traveller`
--
ALTER TABLE `trip_traveller`
  MODIFY `tr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `trip_user`
--
ALTER TABLE `trip_user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `trip_expenese`
--
ALTER TABLE `trip_expenese`
  ADD CONSTRAINT `trip_expenese_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `trip_expense_category` (`ex_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trip_expenese_ibfk_2` FOREIGN KEY (`t_id`) REFERENCES `trip_list` (`t_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trip_expenese_ibfk_3` FOREIGN KEY (`u_id`) REFERENCES `trip_user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
