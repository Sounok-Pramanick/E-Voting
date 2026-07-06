-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jul 05, 2026 at 10:34 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_voting`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidate_database`
--

CREATE TABLE `candidate_database` (
  `voter_uid` varchar(30) NOT NULL,
  `aadhar_uid` char(12) NOT NULL,
  `name` varchar(40) NOT NULL,
  `age` int(11) NOT NULL,
  `house_no` varchar(10) NOT NULL,
  `street_name` varchar(40) NOT NULL,
  `location` varchar(20) NOT NULL,
  `pincode` int(11) NOT NULL,
  `remarks` varchar(20) DEFAULT NULL,
  `state` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `mob` char(10) NOT NULL,
  `constituency` int(11) NOT NULL,
  `assembly` int(11) NOT NULL,
  `ward_no` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `gender` char(1) NOT NULL,
  `father_or_husband_name` char(40) NOT NULL,
  `expire` date DEFAULT NULL,
  `authenticated_initial` varchar(4) NOT NULL,
  `election` year(4) NOT NULL,
  `election_cons` int(11) NOT NULL,
  `election_assembly` int(11) NOT NULL,
  `election_ward` int(11) NOT NULL,
  `party_name` varchar(30) NOT NULL,
  `party_shortform` varchar(10) NOT NULL,
  `logo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `poll`
--

CREATE TABLE `poll` (
  `constituency` int(11) NOT NULL,
  `assembly` int(11) NOT NULL,
  `ward_no` int(11) NOT NULL,
  `poll_no` int(11) DEFAULT 0,
  `gender` char(1) NOT NULL,
  `year` year(4) NOT NULL DEFAULT 2025
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `voter_database`
--

CREATE TABLE `voter_database` (
  `voter_uid` varchar(20) NOT NULL,
  `aadhar_uid` char(12) NOT NULL,
  `name` varchar(40) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `house_no` varchar(30) DEFAULT NULL,
  `street_name` varchar(40) NOT NULL,
  `location` varchar(20) NOT NULL,
  `pincode` int(11) NOT NULL,
  `remarks` varchar(20) DEFAULT NULL,
  `state` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `mob` char(10) NOT NULL,
  `constituency` int(11) NOT NULL,
  `assembly` int(11) NOT NULL,
  `ward_no` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `gender` char(1) NOT NULL,
  `father_or_husband_name` char(40) NOT NULL,
  `expiry` date DEFAULT NULL,
  `authenticated_initial` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `voter_database_temp`
--

CREATE TABLE `voter_database_temp` (
  `voter_uid` varchar(20) NOT NULL,
  `aadhar_uid` char(12) NOT NULL,
  `name` varchar(40) NOT NULL,
  `dob` date NOT NULL,
  `house_no` varchar(10) NOT NULL,
  `street_name` varchar(40) NOT NULL,
  `location` varchar(20) NOT NULL,
  `pincode` int(11) NOT NULL,
  `remarks` varchar(20) DEFAULT NULL,
  `state` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `mob` char(10) NOT NULL,
  `constituency` int(11) NOT NULL,
  `assembly` int(11) NOT NULL,
  `ward_no` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `gender` char(1) NOT NULL,
  `father_or_husband_name` char(40) NOT NULL,
  `expire` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidate_database`
--
ALTER TABLE `candidate_database`
  ADD PRIMARY KEY (`voter_uid`,`aadhar_uid`,`mob`);

--
-- Indexes for table `voter_database`
--
ALTER TABLE `voter_database`
  ADD PRIMARY KEY (`voter_uid`,`aadhar_uid`,`mob`);

--
-- Indexes for table `voter_database_temp`
--
ALTER TABLE `voter_database_temp`
  ADD PRIMARY KEY (`voter_uid`,`aadhar_uid`,`mob`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
