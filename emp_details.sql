-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2025 at 05:40 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emp_details`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `username`) VALUES
(13, NULL, 'admin@gmail.com', '123456', 'Admin'),
(14, NULL, 'abhiraman@gmail.com', '123456', 'Abhiraman'),
(17, NULL, 'sankar@tcs.com', '123456', 'superadmin'),
(20, NULL, 'rohit@gmail.com', '123456', 'Rohit'),
(21, NULL, 'surya@gm.com', '123456', 'Surya');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `emp_id` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1,
  `created_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `full_name`, `emp_id`, `email`, `password`, `is_active`, `created_by`, `created_at`) VALUES
(2, NULL, '6980', 'dummy@gmail.com', '$2y$10$Ya79Ombua7B2OgJZ2QBjLeERKYY.1ZQvCfppTcCv9mQUues4.BMAa', 1, 'superadmin', '2025-07-24 11:29:48'),
(4, 'Abhi', '0327', 'abhi@gmail.com', '$2y$10$EICexoQVv0H7kenf14Y66.hoTvXTMb2hrxpXolLNzqysrPO.YzQ/u', 1, 'superadmin', '2025-07-24 12:50:46'),
(15, NULL, 'EMP01', 'emp@gmail.com', '$2y$10$0cIjzGV9Q8nE8WHrL5JFQuqYJn3KOUklsEav2MBX6awqE8UJMQ94u', 1, 'admin_Admin', '2025-07-27 11:27:54'),
(16, NULL, '9090', 'admin.hari@gmail.com', '$2y$10$0mDPCLhd7FZjGuG2T/jQk.6cYWzVYNacHQnWsWlg44piOgeJYYjXm', 1, 'admin_Rohit', '2025-07-27 11:41:19');

-- --------------------------------------------------------

--
-- Table structure for table `employee_details`
--

CREATE TABLE `employee_details` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `contact_number` varchar(10) DEFAULT NULL,
  `permanent_address` text DEFAULT NULL,
  `current_address` text DEFAULT NULL,
  `personal_email` varchar(255) DEFAULT NULL,
  `pan_card_no` varchar(20) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `blood_group` varchar(5) DEFAULT NULL,
  `uan_number` varchar(20) DEFAULT NULL,
  `aadhaar_name` varchar(255) DEFAULT NULL,
  `aadhaar_dob` date DEFAULT NULL,
  `father_or_husband` varchar(255) DEFAULT NULL,
  `marital_status` varchar(20) DEFAULT NULL,
  `aadhaar_number` varchar(20) DEFAULT NULL,
  `mobile_number` varchar(10) DEFAULT NULL,
  `account_holder` varchar(255) DEFAULT NULL,
  `account_number` varchar(30) DEFAULT NULL,
  `ifsc_code` varchar(15) DEFAULT NULL,
  `branch_name` varchar(100) DEFAULT NULL,
  `experience` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_details`
--

INSERT INTO `employee_details` (`id`, `emp_id`, `contact_number`, `permanent_address`, `current_address`, `personal_email`, `pan_card_no`, `dob`, `blood_group`, `uan_number`, `aadhaar_name`, `aadhaar_dob`, `father_or_husband`, `marital_status`, `aadhaar_number`, `mobile_number`, `account_holder`, `account_number`, `ifsc_code`, `branch_name`, `experience`, `department`) VALUES
(3, 6938, '2147483647', 'Andhra Pradesh', 'Bangalore', 'sankar.1999@gmail.com', 'AFJDE3349H', '2000-12-01', 'O+', '956543225865', 'Sankara Rao', '2000-12-01', 'Simhachalam', 'Single', '985125656262', '9010733494', 'sankar', '50340100002613', 'SBIN0001006', 'Palasa', '3 Years', 'Admin'),
(15, 327, '9010733494', 'banglore', 'bangalore', 'rohit.sharma@india.com', 'AFJDD3349H', '1999-11-06', 'AB+', '956543256212', 'Rohit Sharma', '1999-11-06', 'Kabir', 'Single', '985125656262', '7895223666', 'sankar', '50340100002614', 'BARB0PALASA', 'Palasa', '2 Y', 'Development'),
(16, 9090, '6565325655', 'Andhra Pradesh', 'Bangalore', 'rohit.sharma@india.com', 'AFJSF1333F', '2000-12-02', 'O+', '956543256212', 'Rohit Sharma', '2022-02-20', 'Kabir', 'Single', '912565626226', '7895223666', 'Rohit', '50340100002613', 'BARB0VIZAGG', 'Palasa', '3 Years', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `super_admin`
--

CREATE TABLE `super_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `super_admin`
--

INSERT INTO `super_admin` (`id`, `username`, `email`, `password`, `mobile`) VALUES
(1, 'superadmin', 'rellasankararao327@gmail.com', 'India@pro2024', '9010733494'),
(2, 'sankarrella', 'sankar.provabmail@gmail.com', 'Admin@123', '9010733494');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emp_id` (`emp_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `emp_id_unique` (`emp_id`);

--
-- Indexes for table `employee_details`
--
ALTER TABLE `employee_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `super_admin`
--
ALTER TABLE `super_admin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `employee_details`
--
ALTER TABLE `employee_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `super_admin`
--
ALTER TABLE `super_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
