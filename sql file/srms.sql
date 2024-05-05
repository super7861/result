-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2024 at 02:15 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `srms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `updationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', 'f925916e2754e5e03f75dd58a5733251', '2022-01-01 10:30:57');

-- --------------------------------------------------------

--
-- Table structure for table `tblclasses`
--

CREATE TABLE `tblclasses` (
  `id` int(11) NOT NULL,
  `ClassNameNumeric` int(4) DEFAULT NULL,
  `ClassName` varchar(80) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblclasses`
--

INSERT INTO `tblclasses` (`id`, `ClassNameNumeric`, `ClassName`, `CreationDate`, `UpdationDate`) VALUES
(265, 2, 'MECH', '2024-02-23 15:41:55', NULL),
(266, 1, 'CSE', '2024-02-29 15:24:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblclasses2`
--

CREATE TABLE `tblclasses2` (
  `id` int(11) NOT NULL,
  `ClassNameNumeric` int(4) DEFAULT NULL,
  `ClassName` varchar(80) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblclasses2`
--

INSERT INTO `tblclasses2` (`id`, `ClassNameNumeric`, `ClassName`, `CreationDate`, `UpdationDate`) VALUES
(2, 1, 'CSE', '2024-02-29 15:07:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblclasses3`
--

CREATE TABLE `tblclasses3` (
  `id` int(11) NOT NULL,
  `ClassNameNumeric` int(4) DEFAULT NULL,
  `ClassName` varchar(80) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblclasses3`
--

INSERT INTO `tblclasses3` (`id`, `ClassNameNumeric`, `ClassName`, `CreationDate`, `UpdationDate`) VALUES
(1, 2, 'MECH', '2024-03-01 14:13:29', NULL),
(2, 3, 'CIVIL', '2024-03-01 14:13:31', NULL),
(3, 2, 'CSE', '2024-03-01 14:13:32', NULL),
(4, 1, 'EEE', '2024-03-01 14:13:32', NULL),
(5, 3, 'ECE', '2024-03-01 14:13:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblclasses4`
--

CREATE TABLE `tblclasses4` (
  `id` int(11) NOT NULL,
  `ClassNameNumeric` int(4) DEFAULT NULL,
  `ClassName` varchar(80) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblclasses4`
--

INSERT INTO `tblclasses4` (`id`, `ClassNameNumeric`, `ClassName`, `CreationDate`, `UpdationDate`) VALUES
(1, 2, 'MECH', '2024-02-29 16:12:55', NULL),
(2, 3, 'CIVIL', '2024-02-29 16:13:01', NULL),
(3, 2, 'CSE', '2024-02-29 16:13:03', NULL),
(4, 1, 'EEE', '2024-02-29 16:13:05', NULL),
(5, 3, 'ECE', '2024-02-29 16:13:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblnotice`
--

CREATE TABLE `tblnotice` (
  `id` int(11) NOT NULL,
  `noticeTitle` varchar(255) DEFAULT NULL,
  `noticeDetails` mediumtext DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblnotice`
--

INSERT INTO `tblnotice` (`id`, `noticeTitle`, `noticeDetails`, `postingDate`) VALUES
(3, 'Test Notice', 'This is for testing purposes only.  This is for testing purposes only.  This is for testing purposes only.  This is for testing purposes only.  This is for testing purposes only.  This is for testing purposes only.  This is for testing purposes only.  This is for testing purposes only.  This is for testing purposes only.  This is for testing purposes only.  This is for testing purposes only.  This is for testing purposes only.  This is for testing purposes only.  This is for testing purposes only.  This is for testing purposes only.  This is for testing purposes only.  This is for testing purposes only.  ', '2022-01-01 14:48:32');

-- --------------------------------------------------------

--
-- Table structure for table `tblresult`
--

CREATE TABLE `tblresult` (
  `id` int(11) NOT NULL,
  `StudentId` int(11) DEFAULT NULL,
  `ClassId` int(11) NOT NULL,
  `SubjectId` int(11) DEFAULT NULL,
  `marks` int(11) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL,
  `Status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblresult2`
--

CREATE TABLE `tblresult2` (
  `id` int(11) NOT NULL,
  `StudentId` int(11) DEFAULT NULL,
  `ClassId` int(11) DEFAULT NULL,
  `SubjectId` int(11) DEFAULT NULL,
  `marks` int(11) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblresult2`
--

INSERT INTO `tblresult2` (`id`, `StudentId`, `ClassId`, `SubjectId`, `marks`, `PostingDate`, `UpdationDate`) VALUES
(374, 194, 2, 1, 50, '2024-03-01 15:35:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblresult3`
--

CREATE TABLE `tblresult3` (
  `id` int(11) NOT NULL,
  `StudentId` int(11) DEFAULT NULL,
  `ClassId` int(11) DEFAULT NULL,
  `SubjectId` int(11) DEFAULT NULL,
  `marks` int(11) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblresult3`
--

INSERT INTO `tblresult3` (`id`, `StudentId`, `ClassId`, `SubjectId`, `marks`, `PostingDate`, `UpdationDate`) VALUES
(115, 199, 1, 1, 56, '2024-03-01 14:13:30', NULL),
(116, 199, 1, 2, 67, '2024-03-01 14:13:31', NULL),
(117, 199, 1, 3, 45, '2024-03-01 14:13:31', NULL),
(118, 200, 2, 1, 57, '2024-03-01 14:13:31', NULL),
(119, 200, 2, 2, 68, '2024-03-01 14:13:31', NULL),
(120, 200, 2, 3, 46, '2024-03-01 14:13:32', NULL),
(121, 201, 3, 1, 58, '2024-03-01 14:13:32', NULL),
(122, 201, 3, 2, 69, '2024-03-01 14:13:32', NULL),
(123, 201, 3, 3, 47, '2024-03-01 14:13:32', NULL),
(124, 202, 4, 1, 59, '2024-03-01 14:13:33', NULL),
(125, 202, 4, 2, 70, '2024-03-01 14:13:33', NULL),
(126, 202, 4, 3, 48, '2024-03-01 14:13:33', NULL),
(127, 203, 5, 1, 60, '2024-03-01 14:13:33', NULL),
(128, 203, 5, 2, 71, '2024-03-01 14:13:33', NULL),
(129, 203, 5, 3, 49, '2024-03-01 14:13:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblresult4`
--

CREATE TABLE `tblresult4` (
  `id` int(11) NOT NULL,
  `StudentId` int(11) DEFAULT NULL,
  `ClassId` int(11) DEFAULT NULL,
  `SubjectId` int(11) DEFAULT NULL,
  `marks` int(11) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblresult4`
--

INSERT INTO `tblresult4` (`id`, `StudentId`, `ClassId`, `SubjectId`, `marks`, `PostingDate`, `UpdationDate`) VALUES
(95, 201, 1, 1, 56, '2024-02-29 16:12:58', NULL),
(96, 201, 1, 2, 67, '2024-02-29 16:13:00', NULL),
(97, 201, 1, 3, 45, '2024-02-29 16:13:01', NULL),
(98, 202, 2, 1, 57, '2024-02-29 16:13:03', NULL),
(99, 202, 2, 2, 68, '2024-02-29 16:13:03', NULL),
(100, 202, 2, 3, 46, '2024-02-29 16:13:03', NULL),
(101, 203, 3, 1, 58, '2024-02-29 16:13:04', NULL),
(102, 203, 3, 2, 69, '2024-02-29 16:13:05', NULL),
(103, 203, 3, 3, 47, '2024-02-29 16:13:05', NULL),
(104, 204, 4, 1, 59, '2024-02-29 16:13:06', NULL),
(105, 204, 4, 2, 70, '2024-02-29 16:13:06', NULL),
(106, 204, 4, 3, 48, '2024-02-29 16:13:06', NULL),
(107, 205, 5, 1, 60, '2024-02-29 16:13:06', NULL),
(108, 205, 5, 2, 71, '2024-02-29 16:13:06', NULL),
(109, 205, 5, 3, 49, '2024-02-29 16:13:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents`
--

CREATE TABLE `tblstudents` (
  `StudentId` int(11) NOT NULL,
  `StudentName` varchar(100) DEFAULT NULL,
  `RollId` varchar(100) DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `DOB` varchar(100) DEFAULT NULL,
  `ClassId` int(11) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL,
  `Status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents2`
--

CREATE TABLE `tblstudents2` (
  `StudentId` int(11) NOT NULL,
  `StudentName` varchar(100) DEFAULT NULL,
  `RollId` varchar(100) DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `DOB` varchar(100) DEFAULT NULL,
  `ClassId` int(11) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL,
  `Status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblstudents2`
--

INSERT INTO `tblstudents2` (`StudentId`, `StudentName`, `RollId`, `Gender`, `DOB`, `ClassId`, `RegDate`, `UpdationDate`, `Status`) VALUES
(194, 'amer22', '22', 'Male', '2005-12-03', 2, '2024-02-29 15:15:17', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents3`
--

CREATE TABLE `tblstudents3` (
  `StudentId` int(11) NOT NULL,
  `StudentName` varchar(100) DEFAULT NULL,
  `RollId` varchar(100) DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `DOB` varchar(100) DEFAULT NULL,
  `ClassId` int(11) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL,
  `Status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblstudents3`
--

INSERT INTO `tblstudents3` (`StudentId`, `StudentName`, `RollId`, `Gender`, `DOB`, `ClassId`, `RegDate`, `UpdationDate`, `Status`) VALUES
(199, 'suressh', '2250', NULL, NULL, 1, '2024-03-01 14:13:30', NULL, 1),
(200, 'kumar', '2251', NULL, NULL, 2, '2024-03-01 14:13:31', NULL, 1),
(201, 'lohith', '2252', NULL, NULL, 3, '2024-03-01 14:13:32', NULL, 1),
(202, 'nasheer', '2253', NULL, NULL, 4, '2024-03-01 14:13:33', NULL, 1),
(203, 'kamal', '2254', NULL, NULL, 5, '2024-03-01 14:13:33', NULL, 1),
(204, 'Mohamed', '2270', 'Male', '2005-02-20', 2, '2024-03-01 15:11:47', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents4`
--

CREATE TABLE `tblstudents4` (
  `StudentId` int(11) NOT NULL,
  `StudentName` varchar(100) DEFAULT NULL,
  `RollId` varchar(100) DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `DOB` varchar(100) DEFAULT NULL,
  `ClassId` int(11) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL,
  `Status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblstudents4`
--

INSERT INTO `tblstudents4` (`StudentId`, `StudentName`, `RollId`, `Gender`, `DOB`, `ClassId`, `RegDate`, `UpdationDate`, `Status`) VALUES
(200, 'suressh', '2250', NULL, NULL, 265, '2024-02-23 15:41:57', NULL, 1),
(201, 'suresh', '2250', 'Male', '2005-02-02', 1, '2024-02-29 16:12:58', NULL, 1),
(202, 'kumar', '2251', NULL, NULL, 2, '2024-02-29 16:13:02', NULL, 1),
(203, 'lohith', '2252', NULL, NULL, 3, '2024-02-29 16:13:04', NULL, 1),
(204, 'nasheer', '2253', NULL, NULL, 4, '2024-02-29 16:13:06', NULL, 1),
(205, 'kamal', '2254', NULL, NULL, 5, '2024-02-29 16:13:06', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblsubjectcombination`
--

CREATE TABLE `tblsubjectcombination` (
  `id` int(11) NOT NULL,
  `ClassId` int(11) DEFAULT NULL,
  `SubjectId` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `Updationdate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblsubjectcombination2`
--

CREATE TABLE `tblsubjectcombination2` (
  `id` int(11) NOT NULL,
  `ClassId` int(11) DEFAULT NULL,
  `SubjectId` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `Updationdate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblsubjectcombination2`
--

INSERT INTO `tblsubjectcombination2` (`id`, `ClassId`, `SubjectId`, `status`, `CreationDate`, `Updationdate`) VALUES
(1, 2, 1, 1, '2024-02-29 15:12:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblsubjectcombination3`
--

CREATE TABLE `tblsubjectcombination3` (
  `id` int(11) NOT NULL,
  `ClassId` int(11) DEFAULT NULL,
  `SubjectId` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `Updationdate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblsubjectcombination3`
--

INSERT INTO `tblsubjectcombination3` (`id`, `ClassId`, `SubjectId`, `status`, `CreationDate`, `Updationdate`) VALUES
(1, 2, 2, 1, '2024-03-01 14:46:19', '2024-03-01 14:47:19');

-- --------------------------------------------------------

--
-- Table structure for table `tblsubjectcombination4`
--

CREATE TABLE `tblsubjectcombination4` (
  `id` int(11) NOT NULL,
  `ClassId` int(11) DEFAULT NULL,
  `SubjectId` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `Updationdate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblsubjects`
--

CREATE TABLE `tblsubjects` (
  `id` int(11) NOT NULL,
  `SubjectName` varchar(100) NOT NULL,
  `SubjectCode` varchar(100) DEFAULT NULL,
  `Creationdate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblsubjects`
--

INSERT INTO `tblsubjects` (`id`, `SubjectName`, `SubjectCode`, `Creationdate`, `UpdationDate`) VALUES
(312, 'python', NULL, '2024-02-23 15:41:57', NULL),
(313, 'java', '56', '2024-02-29 15:25:20', NULL),
(314, 'java', '56', '2024-02-29 15:26:45', NULL),
(315, 'java', '56', '2024-02-29 15:28:57', NULL),
(316, 'java', '56', '2024-02-29 15:41:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblsubjects2`
--

CREATE TABLE `tblsubjects2` (
  `id` int(11) NOT NULL,
  `SubjectName` varchar(100) NOT NULL,
  `SubjectCode` varchar(100) DEFAULT NULL,
  `Creationdate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblsubjects2`
--

INSERT INTO `tblsubjects2` (`id`, `SubjectName`, `SubjectCode`, `Creationdate`, `UpdationDate`) VALUES
(1, 'tamil', '34', '2024-02-29 15:08:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblsubjects3`
--

CREATE TABLE `tblsubjects3` (
  `id` int(11) NOT NULL,
  `SubjectName` varchar(100) NOT NULL,
  `SubjectCode` varchar(100) DEFAULT NULL,
  `Creationdate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblsubjects3`
--

INSERT INTO `tblsubjects3` (`id`, `SubjectName`, `SubjectCode`, `Creationdate`, `UpdationDate`) VALUES
(1, 'python', NULL, '2024-03-01 14:13:30', NULL),
(2, 'cciot', NULL, '2024-03-01 14:13:30', NULL),
(3, 'cbt', NULL, '2024-03-01 14:13:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblsubjects4`
--

CREATE TABLE `tblsubjects4` (
  `id` int(11) NOT NULL,
  `SubjectName` varchar(100) NOT NULL,
  `SubjectCode` varchar(100) DEFAULT NULL,
  `Creationdate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblsubjects4`
--

INSERT INTO `tblsubjects4` (`id`, `SubjectName`, `SubjectCode`, `Creationdate`, `UpdationDate`) VALUES
(1, 'python', NULL, '2024-02-29 16:12:58', NULL),
(2, 'cciot', NULL, '2024-02-29 16:13:00', NULL),
(3, 'cbt', NULL, '2024-02-29 16:13:01', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblclasses`
--
ALTER TABLE `tblclasses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblclasses2`
--
ALTER TABLE `tblclasses2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblclasses3`
--
ALTER TABLE `tblclasses3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblclasses4`
--
ALTER TABLE `tblclasses4`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblnotice`
--
ALTER TABLE `tblnotice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblresult`
--
ALTER TABLE `tblresult`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblresult2`
--
ALTER TABLE `tblresult2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblresult3`
--
ALTER TABLE `tblresult3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblresult4`
--
ALTER TABLE `tblresult4`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblstudents`
--
ALTER TABLE `tblstudents`
  ADD PRIMARY KEY (`StudentId`);

--
-- Indexes for table `tblstudents2`
--
ALTER TABLE `tblstudents2`
  ADD PRIMARY KEY (`StudentId`);

--
-- Indexes for table `tblstudents3`
--
ALTER TABLE `tblstudents3`
  ADD PRIMARY KEY (`StudentId`);

--
-- Indexes for table `tblstudents4`
--
ALTER TABLE `tblstudents4`
  ADD PRIMARY KEY (`StudentId`);

--
-- Indexes for table `tblsubjectcombination`
--
ALTER TABLE `tblsubjectcombination`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsubjectcombination2`
--
ALTER TABLE `tblsubjectcombination2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsubjectcombination3`
--
ALTER TABLE `tblsubjectcombination3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsubjectcombination4`
--
ALTER TABLE `tblsubjectcombination4`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsubjects`
--
ALTER TABLE `tblsubjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsubjects2`
--
ALTER TABLE `tblsubjects2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsubjects3`
--
ALTER TABLE `tblsubjects3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsubjects4`
--
ALTER TABLE `tblsubjects4`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblclasses`
--
ALTER TABLE `tblclasses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=267;

--
-- AUTO_INCREMENT for table `tblclasses2`
--
ALTER TABLE `tblclasses2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblclasses3`
--
ALTER TABLE `tblclasses3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblclasses4`
--
ALTER TABLE `tblclasses4`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblnotice`
--
ALTER TABLE `tblnotice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblresult`
--
ALTER TABLE `tblresult`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=371;

--
-- AUTO_INCREMENT for table `tblresult2`
--
ALTER TABLE `tblresult2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=375;

--
-- AUTO_INCREMENT for table `tblresult3`
--
ALTER TABLE `tblresult3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `tblresult4`
--
ALTER TABLE `tblresult4`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `tblstudents`
--
ALTER TABLE `tblstudents`
  MODIFY `StudentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT for table `tblstudents2`
--
ALTER TABLE `tblstudents2`
  MODIFY `StudentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT for table `tblstudents3`
--
ALTER TABLE `tblstudents3`
  MODIFY `StudentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT for table `tblstudents4`
--
ALTER TABLE `tblstudents4`
  MODIFY `StudentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT for table `tblsubjectcombination`
--
ALTER TABLE `tblsubjectcombination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `tblsubjectcombination2`
--
ALTER TABLE `tblsubjectcombination2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblsubjectcombination3`
--
ALTER TABLE `tblsubjectcombination3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblsubjectcombination4`
--
ALTER TABLE `tblsubjectcombination4`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblsubjects`
--
ALTER TABLE `tblsubjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=317;

--
-- AUTO_INCREMENT for table `tblsubjects2`
--
ALTER TABLE `tblsubjects2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblsubjects3`
--
ALTER TABLE `tblsubjects3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblsubjects4`
--
ALTER TABLE `tblsubjects4`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
