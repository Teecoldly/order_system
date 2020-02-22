-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 22, 2020 at 08:25 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `order_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `personnel`
--

CREATE TABLE `personnel` (
  `personnel_id` int(11) NOT NULL,
  `id_card` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `lastname` text COLLATE utf8_unicode_ci NOT NULL,
  `username` text COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `type_ID` int(11) NOT NULL DEFAULT 1,
  `permission` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `personnel`
--

INSERT INTO `personnel` (`personnel_id`, `id_card`, `name`, `lastname`, `username`, `password`, `phone`, `type_ID`, `permission`) VALUES
(1, '1234567890123', 'teecoldly', 'thegame', 'admin', 'admin', '0883829183', 1, 1),
(7, '1009001899001', 'Test', 'KKK', '59091', '59091', '', 3, 1),
(12, '1234567890324', '12345678903242', '12345678903242', '12345678903242', '12345678903242', '1234567890', 2, 1),
(13, '1234567890324', '12345678903241', '12345678903241', '12345678903241', '12345678903241', '1234567890', 2, 1),
(14, '1123123412345', 'อณิรุต', 'ศรีวิรัช', 'teecoldly', 'love4542', '0818291341', 2, 1),
(15, '1234567891234', '1234567891234', '1234567891234', '1234567891234', '1234567891234', '1234567891', 2, 0),
(19, '1234567890192', 'teecoldly', 'thegame', 'love4542', 'bigbang4542', '1111111111', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_key` text COLLATE utf8_unicode_ci NOT NULL,
  `product_name` text COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `unit_type` text COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'หน่วยเรียก',
  `product_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_key`, `product_name`, `price`, `unit_type`, `product_type`) VALUES
(1, '124121', 'อะไรสะอย่าง', 5555, '1', 2),
(2, '12415', '12412', 0, 'xxxx', 2),
(3, '1213', '123123', 0, '', 2),
(5, 'erer', 'wrwrw', 25567, '', 3),
(7, '2', '2', 2, 'xxxx', 2),
(8, '13x', '11', 111, '', 2),
(9, '1', '1', 1, '', 2),
(10, '1231', '123123', 12312, 'xxx', 2),
(12, '123123', '123123', 123123, '123', 2),
(17, 'xd', 'xd', 123, 'xd', 2),
(18, '12312312', '3123123', 123123123, '12312312', 6);

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `type_ID` int(11) NOT NULL,
  `type_name` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`type_ID`, `type_name`) VALUES
(2, 'ช่าง'),
(3, 'test'),
(6, 'ของใช้สิ้นเปลือง'),
(7, 'sss');

-- --------------------------------------------------------

--
-- Table structure for table `semeste`
--

CREATE TABLE `semeste` (
  `semester_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `semester` int(11) NOT NULL,
  `tern` int(11) NOT NULL,
  `time_temp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `semeste`
--

INSERT INTO `semeste` (`semester_code`, `semester`, `tern`, `time_temp`) VALUES
('1/2563', 2563, 1, '2020-02-08 13:39:34'),
('2/2564', 2564, 2, '2020-02-09 07:52:55');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `subject_name` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `subject_name`) VALUES
('1', 'XD'),
('1234', 'นัทนนาการ'),
('124', '11245');

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `order_id` int(11) NOT NULL,
  `teach_id` int(11) NOT NULL,
  `status_admin_id` int(11) DEFAULT NULL,
  `timelog` int(11) NOT NULL,
  `admin_summit_order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`order_id`, `teach_id`, `status_admin_id`, `timelog`, `admin_summit_order`) VALUES
(11, 5, 7, 1581231685, 1581341430),
(13, 19, NULL, 1581337724, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_order_details`
--

CREATE TABLE `tb_order_details` (
  `details_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amout` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_order_details`
--

INSERT INTO `tb_order_details` (`details_id`, `order_id`, `product_id`, `amout`) VALUES
(7, 11, 7, 1),
(11, 13, 5, 114),
(12, 13, 8, 4),
(13, 13, 17, 4);

-- --------------------------------------------------------

--
-- Table structure for table `teach`
--

CREATE TABLE `teach` (
  `teach_id` int(11) NOT NULL,
  `semester_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `subject_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `personnel_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `teach`
--

INSERT INTO `teach` (`teach_id`, `semester_code`, `subject_id`, `personnel_id`) VALUES
(5, '1/2563', '1234 ', 14),
(6, '1/2563', '124 ', 14),
(18, '2/2564', '124 ', 14),
(19, '2/2564', '1234 ', 14),
(20, '2/2564', '1 ', 14),
(21, '2/2564', '1 ', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `personnel`
--
ALTER TABLE `personnel`
  ADD PRIMARY KEY (`personnel_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_type` (`product_type`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`type_ID`);

--
-- Indexes for table `semeste`
--
ALTER TABLE `semeste`
  ADD PRIMARY KEY (`semester_code`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `teach_id` (`teach_id`);

--
-- Indexes for table `tb_order_details`
--
ALTER TABLE `tb_order_details`
  ADD PRIMARY KEY (`details_id`);

--
-- Indexes for table `teach`
--
ALTER TABLE `teach`
  ADD PRIMARY KEY (`teach_id`),
  ADD KEY `semester_code` (`semester_code`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `personnel_id` (`personnel_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `personnel`
--
ALTER TABLE `personnel`
  MODIFY `personnel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `type_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_order_details`
--
ALTER TABLE `tb_order_details`
  MODIFY `details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `teach`
--
ALTER TABLE `teach`
  MODIFY `teach_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`product_type`) REFERENCES `product_type` (`type_ID`);

--
-- Constraints for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD CONSTRAINT `tb_order_ibfk_1` FOREIGN KEY (`teach_id`) REFERENCES `teach` (`teach_id`);

--
-- Constraints for table `teach`
--
ALTER TABLE `teach`
  ADD CONSTRAINT `teach_ibfk_1` FOREIGN KEY (`semester_code`) REFERENCES `semeste` (`semester_code`),
  ADD CONSTRAINT `teach_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`),
  ADD CONSTRAINT `teach_ibfk_3` FOREIGN KEY (`personnel_id`) REFERENCES `personnel` (`personnel_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
