-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 17, 2023 at 08:25 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `livestockoutlook`
--

-- --------------------------------------------------------

--
-- Table structure for table `da_personnels`
--

CREATE TABLE `da_personnels` (
  `DAP_ID` int NOT NULL,
  `User_ID` int NOT NULL,
  `Position` text NOT NULL,
  `Division` text NOT NULL,
  `Record_Status` enum('Accessible','Archive') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Accessible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `da_personnels`
--

INSERT INTO `da_personnels` (`DAP_ID`, `User_ID`, `Position`, `Division`, `Record_Status`) VALUES
(1, 2, 'Chief', 'Research', 'Accessible'),
(2, 3, 'Project Manager', 'Research', 'Accessible');

-- --------------------------------------------------------

--
-- Table structure for table `farmerlivestocks`
--

CREATE TABLE `farmerlivestocks` (
  `FL_ID` int NOT NULL,
  `Farmer_ID` int NOT NULL,
  `Livestock_ID` int NOT NULL,
  `Acquired_Date` date NOT NULL,
  `OwnershipStatus` enum('Owned','Sold','Deceased','Transferred') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Owned',
  `Record_Status` enum('Accessible','Archive') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Accessible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `farmerlivestocks`
--

INSERT INTO `farmerlivestocks` (`FL_ID`, `Farmer_ID`, `Livestock_ID`, `Acquired_Date`, `OwnershipStatus`, `Record_Status`) VALUES
(1, 1, 1, '2023-10-30', 'Owned', 'Accessible'),
(2, 1, 2, '2023-10-30', 'Owned', 'Accessible'),
(3, 1, 5, '2023-11-24', 'Owned', 'Accessible'),
(4, 1, 6, '2023-11-24', 'Owned', 'Accessible'),
(5, 1, 7, '2023-11-25', 'Owned', 'Accessible'),
(6, 1, 8, '2023-11-26', 'Owned', 'Accessible'),
(7, 1, 9, '2023-11-28', 'Owned', 'Accessible'),
(8, 1, 10, '2023-11-28', 'Owned', 'Accessible'),
(9, 1, 11, '2023-11-28', 'Owned', 'Accessible'),
(10, 1, 12, '2023-11-28', 'Owned', 'Accessible'),
(11, 1, 13, '2023-11-28', 'Owned', 'Accessible'),
(12, 1, 14, '2023-11-28', 'Owned', 'Accessible'),
(13, 1, 16, '2023-11-28', 'Owned', 'Accessible'),
(14, 1, 17, '2023-11-28', 'Owned', 'Accessible'),
(15, 1, 18, '2023-11-28', 'Owned', 'Accessible'),
(16, 1, 19, '2023-11-29', 'Owned', 'Accessible'),
(17, 1, 20, '2023-11-29', 'Owned', 'Accessible'),
(18, 1, 21, '2023-11-29', 'Owned', 'Accessible'),
(19, 1, 22, '2023-11-29', 'Owned', 'Accessible'),
(20, 1, 23, '2023-11-29', 'Owned', 'Accessible'),
(21, 1, 24, '2023-11-30', 'Owned', 'Accessible'),
(22, 1, 25, '2023-12-01', 'Owned', 'Accessible'),
(23, 1, 26, '2023-12-02', 'Owned', 'Accessible'),
(24, 1, 27, '2023-12-02', 'Owned', 'Accessible'),
(25, 1, 28, '2023-12-02', 'Owned', 'Accessible'),
(26, 1, 29, '2023-12-05', 'Owned', 'Accessible');

-- --------------------------------------------------------

--
-- Table structure for table `farmer_cerficates`
--

CREATE TABLE `farmer_cerficates` (
  `FC_ID` int NOT NULL,
  `Farmer_ID` int NOT NULL,
  `Certificate_Name` text NOT NULL,
  `Certificate_Description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `Record_Status` enum('Accessible','Archive') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Accessible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `farmer_data_history`
--

CREATE TABLE `farmer_data_history` (
  `FDH_ID` int NOT NULL,
  `Farmer_ID` int NOT NULL,
  `Livestock_ID` int NOT NULL,
  `Action` enum('Add','Edit','Delete','Archive') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `Type` enum('Livestock','Vaccination','Breeding','Mortality') NOT NULL,
  `Timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Record_Status` enum('Accessible','Archive') NOT NULL DEFAULT 'Accessible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `farmer_data_history`
--

INSERT INTO `farmer_data_history` (`FDH_ID`, `Farmer_ID`, `Livestock_ID`, `Action`, `Title`, `Description`, `Type`, `Timestamp`, `Record_Status`) VALUES
(30, 1, 17, 'Edit', 'Edit Livestock Record', 'Edited a livestock details of CTL109', 'Livestock', '2023-11-29 19:53:49', 'Accessible'),
(31, 1, 22, 'Add', 'Added New Livestock', 'Added a new Pig', 'Livestock', '2023-11-29 19:57:23', 'Accessible'),
(32, 1, 17, 'Archive', 'Archive Livestock Record', 'Archived the livestock record of CTL109', 'Livestock', '2023-11-29 19:57:49', 'Accessible'),
(33, 1, 18, 'Add', 'Administer Vaccine', 'Adminsiter vaccine to CTL110', 'Vaccination', '2023-11-29 19:58:41', 'Accessible'),
(35, 1, 19, 'Archive', 'Archive Livestock Record', 'Archived the livestock record of PG106', 'Livestock', '2023-11-29 20:02:02', 'Accessible'),
(36, 1, 2, 'Edit', 'Edit Vaccination Record', 'Edited a vaccination record of PG101', 'Vaccination', '2023-11-29 20:14:42', 'Accessible'),
(37, 1, 18, 'Edit', 'Edit Vaccination Record', 'Edited a vaccination record of CTL110', 'Vaccination', '2023-11-29 20:15:09', 'Accessible'),
(38, 1, 18, 'Archive', 'Archive Vaccination Record', 'Archived the vaccination record of CTL110', 'Vaccination', '2023-11-29 20:15:25', 'Accessible'),
(39, 1, 18, 'Edit', 'Edit Mortality Record', 'Edited a mortality record of CTL110', 'Mortality', '2023-11-29 20:18:56', 'Accessible'),
(40, 1, 1, 'Archive', 'Archive Mortality Record', 'Archived the mortality record of CHK101', 'Mortality', '2023-11-29 20:19:10', 'Accessible'),
(41, 1, 20, 'Add', 'Report Livestock Mortality', 'Report mortality record of PG107', 'Mortality', '2023-11-29 20:42:07', 'Accessible'),
(42, 1, 23, 'Add', 'Added New Livestock', 'Added a new Cattle', 'Livestock', '2023-11-30 00:09:52', 'Accessible'),
(43, 1, 24, 'Add', 'Added New Livestock', 'Added a new Pig', 'Livestock', '2023-12-01 00:33:47', 'Accessible'),
(44, 1, 21, 'Edit', 'Edit Livestock Record', 'Edited a livestock details of PG108', 'Livestock', '2023-12-01 00:40:24', 'Accessible'),
(46, 1, 6, 'Add', 'Breed Livestock', 'Breeding of  and 6', 'Breeding', '2023-12-01 03:46:39', 'Accessible'),
(48, 1, 5, 'Add', 'Breed Livestock', 'Breeding of  and 5', 'Breeding', '2023-12-01 03:48:09', 'Accessible'),
(49, 1, 21, 'Add', 'Administer Vaccine', 'Adminsiter vaccine to PG108', 'Vaccination', '2023-12-01 13:00:05', 'Accessible'),
(51, 1, 5, 'Add', 'Breed Livestock', 'Breeding of CTL103 and CTL110', 'Breeding', '2023-12-01 22:51:31', 'Accessible'),
(53, 1, 5, 'Add', 'Breed Livestock', 'Breeding of CTL103 and CTL110', 'Breeding', '2023-12-01 22:53:47', 'Accessible'),
(55, 1, 5, 'Add', 'Breed Livestock', 'Breeding of CTL103 and CTL110', 'Breeding', '2023-12-01 22:56:12', 'Accessible'),
(56, 1, 5, 'Add', 'Breed Livestock', 'Breeding of CTL103 and CTL110', 'Breeding', '2023-12-01 22:57:17', 'Accessible'),
(57, 1, 18, 'Add', 'Breed Livestock', 'Breeding of CTL103 and CTL110', 'Breeding', '2023-12-01 22:57:17', 'Accessible'),
(58, 1, 25, 'Add', 'Added New Livestock', 'Added a new Pig', 'Livestock', '2023-12-01 23:27:37', 'Accessible'),
(59, 1, 21, 'Edit', 'Edit Livestock Record', 'Edited a livestock details of PG108', 'Livestock', '2023-12-01 23:29:38', 'Accessible'),
(60, 1, 24, 'Archive', 'Archive Livestock Record', 'Archived the livestock record of PG112', 'Livestock', '2023-12-01 23:30:20', 'Accessible'),
(61, 1, 2, 'Archive', 'Archive Vaccination Record', 'Archived the vaccination record of PG101', 'Vaccination', '2023-12-01 23:34:26', 'Accessible'),
(62, 1, 25, 'Archive', 'Archive Livestock Record', 'Archived the livestock record of PG114', 'Livestock', '2023-12-01 23:39:34', 'Accessible'),
(63, 1, 6, 'Archive', 'Archive Mortality Record', 'Archived the mortality record of CRB101', 'Mortality', '2023-12-01 23:39:58', 'Accessible'),
(64, 1, 16, 'Archive', 'Archive Mortality Record', 'Archived the mortality record of CRB104', 'Mortality', '2023-12-01 23:41:41', 'Accessible'),
(65, 1, 1, 'Archive', 'Archive Vaccination Record', 'Archived the vaccination record of CHK101', 'Vaccination', '2023-12-01 23:42:57', 'Accessible'),
(66, 1, 26, 'Add', 'Added New Livestock', 'Added a new Pig', 'Livestock', '2023-12-02 20:51:42', 'Accessible'),
(67, 1, 27, 'Add', 'Added New Livestock', 'Added a new Cattle', 'Livestock', '2023-12-02 21:34:48', 'Accessible'),
(68, 1, 22, 'Add', 'Breed Livestock', 'Breeding of PG110 and PG108', 'Breeding', '2023-12-02 21:54:10', 'Accessible'),
(69, 1, 21, 'Add', 'Breed Livestock', 'Breeding of PG110 and PG108', 'Breeding', '2023-12-02 21:54:10', 'Accessible'),
(70, 1, 28, 'Add', 'Added New Livestock', 'Added a new Cattle', 'Livestock', '2023-12-02 21:55:29', 'Accessible'),
(71, 1, 23, 'Add', 'Breed Livestock', 'Breeding of CTL111 and CTL120', 'Breeding', '2023-12-02 21:56:13', 'Accessible'),
(72, 1, 28, 'Add', 'Breed Livestock', 'Breeding of CTL111 and CTL120', 'Breeding', '2023-12-02 21:56:13', 'Accessible'),
(73, 1, 23, 'Add', 'Breed Livestock', 'Breeding of CTL111 and CTL120', 'Breeding', '2023-12-02 21:56:27', 'Accessible'),
(74, 1, 28, 'Add', 'Breed Livestock', 'Breeding of CTL111 and CTL120', 'Breeding', '2023-12-02 21:56:27', 'Accessible'),
(75, 1, 23, 'Add', 'Breed Livestock', 'Breeding of CTL111 and CTL120', 'Breeding', '2023-12-02 21:56:40', 'Accessible'),
(76, 1, 28, 'Add', 'Breed Livestock', 'Breeding of CTL111 and CTL120', 'Breeding', '2023-12-02 21:56:40', 'Accessible'),
(77, 1, 23, 'Add', 'Breed Livestock', 'Breeding of CTL111 and CTL120', 'Breeding', '2023-12-02 21:56:50', 'Accessible'),
(78, 1, 28, 'Add', 'Breed Livestock', 'Breeding of CTL111 and CTL120', 'Breeding', '2023-12-02 21:56:50', 'Accessible'),
(79, 1, 23, 'Add', 'Breed Livestock', 'Breeding of CTL111 and CTL120', 'Breeding', '2023-12-02 21:57:10', 'Accessible'),
(80, 1, 28, 'Add', 'Breed Livestock', 'Breeding of CTL111 and CTL120', 'Breeding', '2023-12-02 21:57:10', 'Accessible'),
(81, 1, 23, 'Add', 'Breed Livestock', 'Breeding of CTL111 and CTL120', 'Breeding', '2023-12-02 21:57:29', 'Accessible'),
(82, 1, 28, 'Add', 'Breed Livestock', 'Breeding of CTL111 and CTL120', 'Breeding', '2023-12-02 21:57:29', 'Accessible'),
(83, 1, 23, 'Add', 'Breed Livestock', 'Breeding of CTL111 and CTL120', 'Breeding', '2023-12-03 00:00:51', 'Accessible'),
(84, 1, 28, 'Add', 'Breed Livestock', 'Breeding of CTL111 and CTL120', 'Breeding', '2023-12-03 00:00:51', 'Accessible'),
(85, 1, 27, 'Add', 'Breed Livestock', 'Breeding of CTL127 and CTL120', 'Breeding', '2023-12-03 00:25:45', 'Accessible'),
(86, 1, 28, 'Add', 'Breed Livestock', 'Breeding of CTL127 and CTL120', 'Breeding', '2023-12-03 00:25:45', 'Accessible'),
(88, 1, 23, 'Add', 'Breed Livestock', 'Breeding of CTL111 to CTL120', 'Breeding', '2023-12-04 16:16:39', 'Accessible'),
(89, 1, 28, 'Add', 'Breed Livestock', 'Breeding of CTL111 to CTL120', 'Breeding', '2023-12-04 16:16:39', 'Accessible'),
(90, 1, 27, 'Add', 'Breed Livestock', 'Breeding of CTL127 to CTL120', 'Breeding', '2023-12-04 16:23:43', 'Accessible'),
(91, 1, 28, 'Add', 'Breed Livestock', 'Breeding of CTL120 to CTL127', 'Breeding', '2023-12-04 16:23:43', 'Accessible'),
(92, 1, 29, 'Add', 'Added New Livestock', 'Added a new Pig', 'Livestock', '2023-12-05 09:03:52', 'Accessible'),
(93, 1, 21, 'Add', 'Report Livestock Mortality', 'Report mortality record of PG108', 'Mortality', '2023-12-05 09:11:37', 'Accessible'),
(94, 1, 23, 'Add', 'Breed Livestock', 'Breeding of CTL111 to CTL120', 'Breeding', '2023-12-05 09:15:46', 'Accessible'),
(95, 1, 28, 'Add', 'Breed Livestock', 'Breeding of CTL120 to CTL111', 'Breeding', '2023-12-05 09:15:46', 'Accessible'),
(96, 1, 29, 'Edit', 'Edit Livestock Record', 'Edited a livestock details of PG129', 'Livestock', '2023-12-08 11:15:57', 'Accessible'),
(97, 1, 18, 'Edit', 'Edit Mortality Record', 'Edited a mortality record of CTL110', 'Mortality', '2023-12-10 23:33:56', 'Accessible'),
(98, 1, 20, 'Edit', 'Edit Mortality Record', 'Edited a mortality record of PG107', 'Mortality', '2023-12-10 23:34:38', 'Accessible'),
(99, 1, 13, 'Edit', 'Edit Mortality Record', 'Edited a mortality record of PG102', 'Mortality', '2023-12-10 23:35:01', 'Accessible'),
(100, 1, 14, 'Edit', 'Edit Mortality Record', 'Edited a mortality record of PG105', 'Mortality', '2023-12-10 23:35:21', 'Accessible'),
(101, 1, 22, 'Edit', 'Edit Livestock Record', 'Edited a livestock details of PG110', 'Livestock', '2023-12-11 10:15:06', 'Accessible'),
(102, 1, 22, 'Add', 'Administer Vaccine', 'Adminsiter vaccine to PG110', 'Vaccination', '2023-12-11 10:46:36', 'Accessible'),
(103, 1, 22, 'Add', 'Administer Vaccine', 'Adminsiter vaccine to PG110', 'Vaccination', '2023-12-11 10:53:40', 'Accessible');

-- --------------------------------------------------------

--
-- Table structure for table `farmer_profile`
--

CREATE TABLE `farmer_profile` (
  `Farmer_ID` int NOT NULL,
  `User_ID` int NOT NULL,
  `Years_Of_Farming` int DEFAULT NULL,
  `Record_Status` enum('Accessible','Archive') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Accessible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `farmer_profile`
--

INSERT INTO `farmer_profile` (`Farmer_ID`, `User_ID`, `Years_Of_Farming`, `Record_Status`) VALUES
(1, 1, 3, 'Accessible'),
(3, 8, 3, 'Accessible');

-- --------------------------------------------------------

--
-- Table structure for table `livestockbacthes`
--

CREATE TABLE `livestockbacthes` (
  `LB_ID` int NOT NULL,
  `Farmer_ID` int NOT NULL,
  `Batch_Name` text NOT NULL,
  `Livestock_Type` text NOT NULL,
  `Record_Status` enum('Accessible','Archive') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Accessible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `livestocks`
--

CREATE TABLE `livestocks` (
  `Livestock_ID` int NOT NULL,
  `Livestock_TagID` varchar(25) DEFAULT NULL,
  `Livestock_Type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Breed_Name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Age_Classification` varchar(50) NOT NULL,
  `Age_Days` int DEFAULT '0',
  `Age_Weeks` int DEFAULT '0',
  `Age_Months` int DEFAULT '0',
  `Age_Years` int DEFAULT '0',
  `Sex` enum('Male','Female') NOT NULL,
  `Breeding_Eligibility` enum('Age-Suited','Not Age-Suited') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Not Age-Suited',
  `Date_Of_Birth` date NOT NULL,
  `Livestock_Status` enum('Alive','Dead') NOT NULL DEFAULT 'Alive',
  `Record_Status` enum('Accessible','Archive') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Accessible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `livestocks`
--

INSERT INTO `livestocks` (`Livestock_ID`, `Livestock_TagID`, `Livestock_Type`, `Breed_Name`, `Age_Classification`, `Age_Days`, `Age_Weeks`, `Age_Months`, `Age_Years`, `Sex`, `Breeding_Eligibility`, `Date_Of_Birth`, `Livestock_Status`, `Record_Status`) VALUES
(1, 'CHK101', 'Chicken', 'Native Chicken', 'Pullet', 0, 3, 0, 0, 'Male', 'Not Age-Suited', '2023-09-12', 'Dead', 'Accessible'),
(2, 'PG101', 'Pig', 'Duroc', 'Piglet', 0, 2, 0, 0, 'Female', 'Not Age-Suited', '2023-09-12', 'Alive', 'Archive'),
(3, 'CTL101', 'Cattle', NULL, 'Calf', 2, 0, 0, 0, 'Female', 'Not Age-Suited', '2023-11-24', 'Alive', 'Accessible'),
(4, 'CTL102', 'Cattle', NULL, 'Calf', 2, 0, 0, 0, 'Female', 'Not Age-Suited', '2023-11-22', 'Alive', 'Accessible'),
(5, 'CTL103', 'Cattle', NULL, 'Yearling', 2, 0, 0, 0, 'Male', 'Not Age-Suited', '2023-11-24', 'Dead', 'Accessible'),
(6, 'CRB101', 'Carabao', NULL, 'Heifer', 3, 0, 0, 0, 'Male', 'Not Age-Suited', '2023-11-22', 'Dead', 'Accessible'),
(7, 'GT101', 'Goat', NULL, 'Kid', 2, 0, 0, 0, 'Female', 'Not Age-Suited', '2023-11-23', 'Alive', 'Archive'),
(8, 'CRB102', 'Carabao', NULL, 'Calf', 3, 0, 0, 0, 'Female', 'Not Age-Suited', '2023-11-24', 'Alive', 'Archive'),
(9, 'CRB103', 'Carabao', NULL, 'Calf', 2, 0, 0, 0, 'Male', 'Not Age-Suited', '2023-11-26', 'Alive', 'Archive'),
(10, 'CTL104', 'Cattle', NULL, 'Calf', 2, 0, 0, 0, 'Female', 'Not Age-Suited', '2023-11-26', 'Dead', 'Accessible'),
(11, 'CTL105', 'Cattle', NULL, 'Calf', 3, 0, 0, 0, 'Female', 'Not Age-Suited', '2023-11-25', 'Alive', 'Archive'),
(12, 'GT103', 'Goat', NULL, 'Kid', 3, 0, 0, 0, 'Female', 'Not Age-Suited', '2023-11-25', 'Alive', 'Archive'),
(13, 'PG102', 'Pig', NULL, 'Finisher', 2, 0, 0, 0, 'Male', 'Not Age-Suited', '2023-11-26', 'Dead', 'Accessible'),
(14, 'PG105', 'Pig', 'Landrace', 'Piglet', 6, 0, 0, 0, 'Male', 'Not Age-Suited', '2023-11-23', 'Dead', 'Accessible'),
(16, 'CRB104', 'Carabao', 'Philippine Native', 'Calf', 2, 0, 0, 0, 'Female', 'Not Age-Suited', '2023-11-26', 'Dead', 'Accessible'),
(17, 'CTL109', 'Cattle', 'Holstein Friesian', 'Calf', 2, 0, 0, 0, 'Male', 'Not Age-Suited', '2023-11-26', 'Alive', 'Archive'),
(18, 'CTL110', 'Cattle', 'Holstein Friesian', 'Heifer', 2, 0, 0, 0, 'Female', 'Not Age-Suited', '2023-11-26', 'Dead', 'Accessible'),
(19, 'PG106', 'Pig', 'Duroc', 'Piglet', 2, 0, 0, 0, 'Male', 'Not Age-Suited', '2023-11-27', 'Alive', 'Archive'),
(20, 'PG107', 'Pig', 'Duroc', 'Piglet', 3, 0, 0, 0, 'Male', 'Not Age-Suited', '2023-11-26', 'Dead', 'Accessible'),
(21, 'PG108', 'Pig', 'Landrace', 'Piglet', 2, 0, 0, 0, 'Female', 'Age-Suited', '2023-11-27', 'Dead', 'Accessible'),
(22, 'PG110', 'Pig', 'Landrace', 'Piglet', 2, 0, 0, 0, 'Male', 'Not Age-Suited', '2023-11-27', 'Alive', 'Accessible'),
(23, 'CTL111', 'Cattle', 'Holstein Friesian', 'Calf', 2, 0, 0, 0, 'Male', 'Not Age-Suited', '2023-11-26', 'Alive', 'Accessible'),
(24, 'PG112', 'Pig', 'Duroc', 'Piglet', 4, 0, 0, 0, 'Male', 'Not Age-Suited', '2023-11-27', 'Alive', 'Archive'),
(25, 'PG114', 'Pig', 'Duroc', 'Piglet', 3, 0, 0, 0, 'Female', 'Not Age-Suited', '2023-11-28', 'Alive', 'Archive'),
(26, 'PG120', 'Pig', 'Landrace', 'Piglet', 2, 0, 0, 0, 'Female', 'Not Age-Suited', '2023-11-30', 'Alive', 'Accessible'),
(27, 'CTL127', 'Cattle', 'Holstein Friesian', 'Calf', 2, 0, 0, 0, 'Male', 'Not Age-Suited', '2023-11-30', 'Alive', 'Accessible'),
(28, 'CTL120', 'Cattle', 'Holstein Friesian', 'Calf', 2, 0, 0, 0, 'Female', 'Not Age-Suited', '2023-11-30', 'Alive', 'Accessible'),
(29, 'PG129', 'Pig', 'Landrace', 'Piglet', 2, 0, 0, 0, 'Male', 'Not Age-Suited', '2023-12-02', 'Alive', 'Accessible');

-- --------------------------------------------------------

--
-- Table structure for table `livestock_advisories`
--

CREATE TABLE `livestock_advisories` (
  `Advisory_ID` int NOT NULL,
  `Subject` varchar(100) NOT NULL,
  `Content` text NOT NULL,
  `Target_Farmer_ID` int DEFAULT NULL,
  `Is_General` tinyint(1) NOT NULL,
  `Date_Published` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Is_Read` tinyint(1) NOT NULL DEFAULT '0',
  `Record_Status` enum('Accessible','Archive') NOT NULL DEFAULT 'Accessible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `livestock_advisories`
--

INSERT INTO `livestock_advisories` (`Advisory_ID`, `Subject`, `Content`, `Target_Farmer_ID`, `Is_General`, `Date_Published`, `Is_Read`, `Record_Status`) VALUES
(1, 'Attention to All 2', 'trial 7', NULL, 1, '2023-12-09 18:47:56', 0, 'Accessible'),
(2, 'Attention to All', 'trial 6', NULL, 1, '2023-12-09 18:47:56', 0, 'Accessible'),
(4, 'Hi Farmer', 'trial 5', 1, 0, '2023-12-10 03:29:51', 0, 'Accessible'),
(5, 'Hello', 'trial 4', 1, 0, '2023-12-10 13:56:50', 0, 'Accessible'),
(6, 'Hi', 'Trial 3', 1, 0, '2023-12-10 13:59:50', 0, 'Accessible'),
(7, 'Hi', 'trial 2', 1, 0, '2023-12-10 14:48:46', 0, 'Accessible'),
(8, 'GLobal to', 'General Advisory', NULL, 1, '2023-12-10 14:51:09', 0, 'Accessible'),
(9, 'Hi', 'andito si Xander', 1, 0, '2023-12-11 10:16:11', 0, 'Accessible'),
(10, 'Hello', 'I\'m now presenting a progress report', 1, 0, '2023-12-12 08:27:25', 0, 'Accessible');

-- --------------------------------------------------------

--
-- Table structure for table `livestock_age_classification`
--

CREATE TABLE `livestock_age_classification` (
  `Age_Classification_ID` int NOT NULL,
  `Age_Classification_Name` varchar(50) NOT NULL,
  `Age_Range` varchar(25) NOT NULL,
  `LT_ID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `livestock_age_classification`
--

INSERT INTO `livestock_age_classification` (`Age_Classification_ID`, `Age_Classification_Name`, `Age_Range`, `LT_ID`) VALUES
(1, 'Chick', '0-4 weeks', 2),
(2, 'Pullet', '2-4 months', 2),
(3, 'Cockerel', '3-6 months', 2),
(4, 'Rooster', '6 months and above', 2),
(5, 'Hen', '6 months and above', 2),
(6, 'Calf', '0-1 year', 1),
(7, 'Heifer', '1-3 years', 1),
(8, 'Bull', '1-3 years', 1),
(9, 'Adult Female', '3 years and above', 1),
(10, 'Adult Male', '3 years and above', 1),
(11, 'Kid', '0-12 months', 3),
(12, 'Yearling', '1-2 years', 3),
(13, 'Mature Goat', '2-4 years', 3),
(14, 'Adult Goat', '4 years and above', 3),
(15, 'Piglet', '0-6 weeks', 4),
(16, 'Weaner', '6 weeks - 3 months', 4),
(17, 'Grower', '3-6 months', 4),
(18, 'Finisher', '6 months and above', 4),
(19, 'Sow', '8-18 months and above', 4),
(20, 'Boar', '8-18 months and above', 4),
(21, 'Calf', '0-6 months', 5),
(22, 'Yearling', '6-12 months', 5),
(23, 'Heifer', '1-3 years', 5),
(24, 'Steer', '1-3 years', 5),
(25, 'Cow', '3 years and above', 5),
(26, 'Bull', '3 years and above', 5),
(28, 'Lamb', '0-6 months', 6),
(29, 'Yearling', '6-12 months', 6),
(30, 'Ewe Lamb', '1-2 years', 6),
(31, 'Wether Lamb', '1-2 years', 6),
(32, 'Ewe', '2 years and above', 6),
(33, 'Ram', '2 years and above', 6);

-- --------------------------------------------------------

--
-- Table structure for table `livestock_batch_associations`
--

CREATE TABLE `livestock_batch_associations` (
  `LBA_ID` int NOT NULL,
  `Batch_ID` int NOT NULL,
  `Livestock_ID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `livestock_breedings`
--

CREATE TABLE `livestock_breedings` (
  `LB_ID` int NOT NULL,
  `Farmer_ID` int NOT NULL,
  `MaleLivestock` varchar(25) NOT NULL,
  `FemaleLivestock` varchar(25) NOT NULL,
  `BreedResults` varchar(255) NOT NULL,
  `BreedNotes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `BreedDate` date NOT NULL,
  `Record_Status` enum('Accessible','Archive') NOT NULL DEFAULT 'Accessible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `livestock_breedings`
--

INSERT INTO `livestock_breedings` (`LB_ID`, `Farmer_ID`, `MaleLivestock`, `FemaleLivestock`, `BreedResults`, `BreedNotes`, `BreedDate`, `Record_Status`) VALUES
(1, 0, 'CTL103', 'CTL104', 'wala lang', 'skdjncskjdnc', '2023-11-30', 'Accessible'),
(2, 0, 'CTL103', 'CTL104', 'wala lang', 'skdjncskjdnc', '2023-11-30', 'Accessible'),
(3, 0, 'CTL103', 'CTL104', 'wala lang', 'skdjncskjdnc', '2023-11-30', 'Accessible'),
(4, 1, 'CTL103', 'CTL104', 'wala lang', 'skdjncskjdnckfbndkvjndjkbdkjcbbsdcjsnc', '2023-11-30', 'Archive'),
(5, 1, 'CTL103', 'CTL104', 'wala lang', 'skdjncskjdncklkasncna', '2023-11-30', 'Archive'),
(6, 1, 'CRB101', 'CRB104', 'askdubua', 'skjdncsk', '2023-11-30', 'Accessible'),
(7, 1, 'CTL103', 'CTL104', 'wala lang', 'mas wala lang', '2023-11-30', 'Accessible'),
(8, 1, 'CTL103', 'CTL110', 'wala nangyari sa kanila', 'kjsndnsck', '2023-12-01', 'Accessible'),
(9, 1, 'CTL103', 'CTL110', 'heheheh', 'hheheheh', '2023-12-01', 'Accessible'),
(10, 1, 'CTL103', 'CTL110', 'heheheh', 'hheheheh', '2023-12-01', 'Accessible'),
(11, 1, 'CTL103', 'CTL110', 'hehehehhe', 'hrhrhhr', '2023-12-01', 'Accessible'),
(12, 1, 'PG110', 'PG108', 'wala hahah', 'asnhdkajsdn', '2023-12-12', 'Accessible'),
(13, 1, 'CTL111', 'CTL120', 'slansclacn', 'lijsdcasx', '2023-11-26', 'Accessible'),
(14, 1, 'CTL111', 'CTL120', 'slansclacn', 'lijsdcasx', '2023-11-29', 'Accessible'),
(15, 1, 'CTL111', 'CTL120', 'slansclacn', 'lijsdcasx', '2023-11-27', 'Accessible'),
(16, 1, 'CTL111', 'CTL120', 'slansclacn', 'lijsdcasx', '2023-11-27', 'Accessible'),
(17, 1, 'CTL111', 'CTL120', 'slansclacn', 'lijsdcasx', '2023-11-29', 'Accessible'),
(18, 1, 'CTL111', 'CTL120', 'slansclacn', 'lijsdcasx', '2023-12-02', 'Accessible'),
(19, 1, 'CTL111', 'CTL120', 'ksbcakj', 'sncskjdnc', '2023-12-02', 'Accessible'),
(20, 1, 'CTL127', 'CTL120', 'kjcbskdb', 'ksjdbcskjb', '2023-12-02', 'Accessible'),
(21, 1, 'CTL111', 'CTL120', 'kasnckjasn', 'sdcksjnc', '2023-12-04', 'Accessible'),
(22, 1, 'CTL127', 'CTL120', 's,cnsnkcjn', 'kjaksjcb', '2023-12-04', 'Accessible'),
(23, 1, 'CTL111', 'CTL120', 'jkfvbjks', 'asjxnak', '2023-12-05', 'Accessible');

-- --------------------------------------------------------

--
-- Table structure for table `livestock_breeds`
--

CREATE TABLE `livestock_breeds` (
  `Breed_ID` int NOT NULL,
  `Breed_Name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Breed_Name_Tagalog` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Breed_Description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `LT_ID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `livestock_breeds`
--

INSERT INTO `livestock_breeds` (`Breed_ID`, `Breed_Name`, `Breed_Name_Tagalog`, `Breed_Description`, `LT_ID`) VALUES
(1, 'Philippine Native', 'Karabaw', 'Native Philippine carabao breed used for plowing and hauling', 1),
(2, 'Holstein Friesian', 'Holstein', 'High milk producing dairy cow imported from US and Europe', 5),
(3, 'Anglo-Nubian', 'Anglo-Nubian', 'Dual purpose goat breed from UK, used for meat and milk', 3),
(4, 'Boer', 'Boer', 'Meat goat breed from South Africa', 3),
(5, 'Saanen', 'Saanen', 'High milk producing dairy goat breed from Switzerland', 3),
(6, 'Native Chicken', 'Manok', 'Native dual purpose chicken breed in Philippines', 2),
(7, 'Rhode Island Red', 'Rhode Island Red', 'Dual purpose chicken breed imported from US', 2),
(8, 'Leghorn', 'Leghorn', 'Egg laying chicken breed imported from Italy', 2),
(9, 'Duroc', 'Duroc', 'Lean meat pig breed from US', 4),
(10, 'Landrace', 'Landrace', 'White pig breed from Denmark used for pork', 4),
(11, 'Brahman', 'Brahman', 'Beef cattle breed adapted to tropics from India', 5),
(13, 'Berk shire', NULL, 'Black pig breed known for quality pork', 4);

-- --------------------------------------------------------

--
-- Table structure for table `livestock_mortalities`
--

CREATE TABLE `livestock_mortalities` (
  `LM_ID` int NOT NULL,
  `Livestock_ID` int NOT NULL,
  `Farmer_ID` int NOT NULL,
  `Cause_Of_Death` text NOT NULL,
  `Date_Of_Death` date NOT NULL,
  `Record_Status` enum('Accessible','Archive') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Accessible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `livestock_mortalities`
--

INSERT INTO `livestock_mortalities` (`LM_ID`, `Livestock_ID`, `Farmer_ID`, `Cause_Of_Death`, `Date_Of_Death`, `Record_Status`) VALUES
(3, 6, 1, 'nadapa', '2023-11-25', 'Archive'),
(4, 1, 1, 'inubo', '2023-11-25', 'Archive'),
(5, 5, 1, 'natapilok', '2023-11-25', 'Archive'),
(6, 10, 1, 'inubo ng malakas', '2023-11-28', 'Archive'),
(7, 13, 1, 'Porcine Reproductive and Respiratory Syndrome', '2023-11-28', 'Accessible'),
(8, 14, 1, 'Salmonellosis', '2023-11-28', 'Accessible'),
(9, 16, 1, 'nabalian', '2023-11-28', 'Archive'),
(10, 18, 1, 'Bovine Respiratory Disease', '2023-11-29', 'Accessible'),
(11, 20, 1, 'Foot and Mouth Disease ', '2023-11-29', 'Accessible'),
(12, 21, 1, 'African Swine Fever', '2023-12-05', 'Accessible');

-- --------------------------------------------------------

--
-- Table structure for table `livestock_sales`
--

CREATE TABLE `livestock_sales` (
  `Sales_ID` int NOT NULL,
  `Farmer_ID` int NOT NULL,
  `Sales_TotalPrice` double(10,2) NOT NULL,
  `PaymentAmount` decimal(10,2) NOT NULL,
  `ChangeAmount` decimal(10,2) NOT NULL,
  `Sales_Date` datetime NOT NULL,
  `Buyer_Name` text NOT NULL,
  `Buyer_Type` enum('Farmer','Other') NOT NULL,
  `Record_Status` enum('Accessible','Archive') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Accessible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `livestock_types`
--

CREATE TABLE `livestock_types` (
  `LT_ID` int NOT NULL,
  `Type_Name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Livestock_Uses` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `livestock_types`
--

INSERT INTO `livestock_types` (`LT_ID`, `Type_Name`, `Livestock_Uses`) VALUES
(1, 'Carabao', 'Plowing, transportation, and milk production'),
(2, 'Chicken', 'Egg and meat production'),
(3, 'Goat', 'Meat and milk production'),
(4, 'Pig', 'Pork production'),
(5, 'Cattle', 'Beef production'),
(6, 'Sheep', 'Wool, Meat and Milk Production'),
(11, 'Rabbit', 'Meat Production');

-- --------------------------------------------------------

--
-- Table structure for table `livestock_vaccinations`
--

CREATE TABLE `livestock_vaccinations` (
  `Vaccination_ID` int NOT NULL,
  `VaccineAdministratorID` int NOT NULL,
  `Livestock_ID` int NOT NULL,
  `Vaccination_Name` varchar(70) NOT NULL,
  `Vaccination_Description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `Vaccination_Date` date NOT NULL,
  `Record_Status` enum('Archive','Accessible') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'Accessible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `livestock_vaccinations`
--

INSERT INTO `livestock_vaccinations` (`Vaccination_ID`, `VaccineAdministratorID`, `Livestock_ID`, `Vaccination_Name`, `Vaccination_Description`, `Vaccination_Date`, `Record_Status`) VALUES
(1, 1, 1, 'vax1', 'vaccine 1', '2023-11-24', 'Archive'),
(2, 1, 2, 'Vax2', 'Vaccine 2.km.k ', '2023-11-24', 'Archive'),
(3, 1, 2, 'Vax2', 'Vaccine 2', '2023-11-24', 'Archive'),
(4, 1, 1, 'Vax 3', 'Vaccine 3', '2023-11-25', 'Archive'),
(5, 1, 1, 'Vax 3', 'Vaccine 3', '2023-11-25', 'Accessible'),
(6, 1, 2, 'Vax4', 'Vaccine 4', '2023-11-22', 'Archive'),
(7, 1, 1, 'Vax 5', 'Vaccine 5', '2023-11-25', 'Accessible'),
(8, 1, 2, 'Vax5', 'vaccine 5', '2023-11-25', 'Accessible'),
(9, 1, 11, 'Vax8', 'Vaccine 8', '2023-11-28', 'Archive'),
(10, 1, 11, 'Vax9', 'Vaccine 9', '2023-11-28', 'Archive'),
(11, 1, 18, 'Vax11', 'vACCINE 11eufbwnjksdc', '2023-11-29', 'Archive'),
(12, 1, 21, 'vaccine 10', 'vax 1010', '2023-12-01', 'Accessible'),
(17, 1, 22, 'Vaccine 101', 'Vaccine 101 Da best', '2023-12-11', 'Accessible'),
(18, 1, 22, 'vaccine 202', 'Vaccine 202 Da Bestiest', '2023-12-11', 'Accessible');

-- --------------------------------------------------------

--
-- Table structure for table `sold_livestocks`
--

CREATE TABLE `sold_livestocks` (
  `Sold_Livestock_ID` int NOT NULL,
  `Sales_ID` int NOT NULL,
  `Livestock_ID` int NOT NULL,
  `Livestock_Price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `User_ID` int NOT NULL,
  `Username` text NOT NULL,
  `Password` text NOT NULL,
  `Email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `Firstname` text NOT NULL,
  `Middlename` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `Lastname` text NOT NULL,
  `Date_Of_Birth` date NOT NULL,
  `Gender` enum('Male','Female','Other') NOT NULL,
  `Civil_Status` text NOT NULL,
  `Sitio` text NOT NULL,
  `Barangay` text NOT NULL,
  `City` text NOT NULL,
  `Province` text NOT NULL,
  `Phone_Number` varchar(11) NOT NULL,
  `Image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `User_Role` enum('Farmer','DA Personnel') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `User_Status` enum('Active','Inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Inactive',
  `Last_Login_Date` datetime DEFAULT NULL,
  `Created_At` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Record_Status` enum('Accessible','Archive') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Accessible',
  `User_Token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`User_ID`, `Username`, `Password`, `Email`, `Firstname`, `Middlename`, `Lastname`, `Date_Of_Birth`, `Gender`, `Civil_Status`, `Sitio`, `Barangay`, `City`, `Province`, `Phone_Number`, `Image`, `User_Role`, `User_Status`, `Last_Login_Date`, `Created_At`, `Record_Status`, `User_Token`) VALUES
(1, 'Farmer', '$2y$10$EnOsFGlLTvjeRGMYR5VYguPlwRpjOwmYIGe7tvvQOyP0WI9uSw/he', 'danielle@gmail.com', 'Marc Danielle', 'Marasigan', 'Cabatay', '2002-10-26', 'Male', 'Single', 'Lagunlong', 'Water', 'Baco', 'Oriental Mindoro', '09876543210', '1700376529_3f6e7e22e84048b5f11a.jpg', 'Farmer', 'Inactive', NULL, '2023-11-11 23:05:25', 'Accessible', NULL),
(2, 'Admin', '$2y$10$at9ik1RpIVyC1MEBFTo5IOd725sJBw3TDaUknW7PtvrSeq5glejMm', 'danielle@gmail.com', 'Marc Danielle', 'Marasigan', 'Cabatay', '2002-10-26', 'Male', 'Single', 'Lagunlong', 'Water', 'Baco', 'Oriental Mindoro', '09876543210', NULL, 'DA Personnel', 'Inactive', NULL, '2023-11-11 23:06:14', 'Accessible', NULL),
(3, 'danielleAdmin', '$2y$10$8.7y9pVxirYXCRqr0HsiWO1UrT4sm9QO5jkw6goqEQl4shM/w4TjO', 'danielleAdmin@gmail.com', 'Marc Danielle', 'Marasigan', 'Cabatay', '2002-10-26', 'Male', 'Single', 'Lagunlong', 'Wate', 'Baco', 'Oriental Mindoro', '09876543210', '1700376736_396262f955f52cfc554b.jpg', 'DA Personnel', 'Inactive', NULL, '2023-11-19 14:52:16', 'Accessible', NULL),
(7, 'edaGFSGH', '$2y$10$7eutjPrNpZOe0N4lqDJ6Hu4x85Zz5Rg2Y0skFLtpvz6fWlzdyViMS', 'tse@gmail.com', 'Esairah Meril', 'Agpalasin', 'Matira', '2023-01-17', 'Female', 'Single', 'Sitio 7', 'Bagong Silang', 'Victoria', 'Oriental Mindoro', '09123456789', '1700388105_ba38a478057c736c8dc8.jpg', 'DA Personnel', 'Inactive', NULL, '2023-11-19 18:01:45', 'Accessible', NULL),
(8, 'juanDelaCruz101', '$2y$10$TzK7EcO6OAMXcOn8KaKWZuuECHZ4iEjqhU3Tou6uXNfmv3eY964py', 'juandcrz@gmail.com', 'Juan', '', 'Dela Cruz', '2000-01-01', 'Male', 'Single', 'Irrigation', 'Masipit', 'Calapan City', 'Oriental Mindoro', '0987654321', '1702764911_66bbe4de557c5c199e78.png', 'Farmer', 'Inactive', NULL, '2023-12-17 06:15:11', 'Accessible', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJMaXZlc3RvY2sgT3V0bG9vayIsImF1ZCI6IkZhcm1lciIsInN1YiI6IkxpdmVzdG9jayBNb25pdG9yaW5nIFN5c3RlbSIsImVtYWlsIjoianVhbmRjcnpAZ21haWwuY29tIiwidXNlcm5hbWUiOiJqdWFuRGVsYUNydXoxMDEiLCJwYXNzd29yZCI6IiQyeSQxMCRUeks3RWNPNk');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `da_personnels`
--
ALTER TABLE `da_personnels`
  ADD PRIMARY KEY (`DAP_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `farmerlivestocks`
--
ALTER TABLE `farmerlivestocks`
  ADD PRIMARY KEY (`FL_ID`),
  ADD KEY `Farmer_ID` (`Farmer_ID`),
  ADD KEY `Livestock_ID` (`Livestock_ID`);

--
-- Indexes for table `farmer_cerficates`
--
ALTER TABLE `farmer_cerficates`
  ADD PRIMARY KEY (`FC_ID`),
  ADD KEY `Farmer_ID` (`Farmer_ID`);

--
-- Indexes for table `farmer_data_history`
--
ALTER TABLE `farmer_data_history`
  ADD PRIMARY KEY (`FDH_ID`),
  ADD KEY `Farmer_ID` (`Farmer_ID`),
  ADD KEY `Livestock_ID` (`Livestock_ID`);

--
-- Indexes for table `farmer_profile`
--
ALTER TABLE `farmer_profile`
  ADD PRIMARY KEY (`Farmer_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `livestockbacthes`
--
ALTER TABLE `livestockbacthes`
  ADD PRIMARY KEY (`LB_ID`),
  ADD KEY `Farmer_ID` (`Farmer_ID`);

--
-- Indexes for table `livestocks`
--
ALTER TABLE `livestocks`
  ADD PRIMARY KEY (`Livestock_ID`),
  ADD UNIQUE KEY `Livestock_TagID` (`Livestock_TagID`),
  ADD KEY `Livestock_Type_ID` (`Livestock_Type`),
  ADD KEY `Breed_ID` (`Breed_Name`),
  ADD KEY `Age_Classification` (`Age_Classification`);

--
-- Indexes for table `livestock_advisories`
--
ALTER TABLE `livestock_advisories`
  ADD PRIMARY KEY (`Advisory_ID`),
  ADD KEY `Target_Farmer_ID` (`Target_Farmer_ID`);

--
-- Indexes for table `livestock_age_classification`
--
ALTER TABLE `livestock_age_classification`
  ADD PRIMARY KEY (`Age_Classification_ID`),
  ADD KEY `LT_ID` (`LT_ID`),
  ADD KEY `Age_Classification_Name` (`Age_Classification_Name`);

--
-- Indexes for table `livestock_batch_associations`
--
ALTER TABLE `livestock_batch_associations`
  ADD PRIMARY KEY (`LBA_ID`),
  ADD KEY `Batch_ID` (`Batch_ID`),
  ADD KEY `Livestock` (`Livestock_ID`);

--
-- Indexes for table `livestock_breedings`
--
ALTER TABLE `livestock_breedings`
  ADD PRIMARY KEY (`LB_ID`),
  ADD KEY `MaleLivestock` (`MaleLivestock`),
  ADD KEY `FemaleLivestock` (`FemaleLivestock`),
  ADD KEY `Farmer_ID` (`Farmer_ID`);

--
-- Indexes for table `livestock_breeds`
--
ALTER TABLE `livestock_breeds`
  ADD PRIMARY KEY (`Breed_ID`),
  ADD UNIQUE KEY `Breed_Name` (`Breed_Name`),
  ADD KEY `LT_ID` (`LT_ID`);

--
-- Indexes for table `livestock_mortalities`
--
ALTER TABLE `livestock_mortalities`
  ADD PRIMARY KEY (`LM_ID`),
  ADD KEY `Livestock_ID` (`Livestock_ID`),
  ADD KEY `Farmer_ID` (`Farmer_ID`);

--
-- Indexes for table `livestock_sales`
--
ALTER TABLE `livestock_sales`
  ADD PRIMARY KEY (`Sales_ID`),
  ADD KEY `Farmer_ID` (`Farmer_ID`);

--
-- Indexes for table `livestock_types`
--
ALTER TABLE `livestock_types`
  ADD PRIMARY KEY (`LT_ID`),
  ADD UNIQUE KEY `Type_Name` (`Type_Name`);

--
-- Indexes for table `livestock_vaccinations`
--
ALTER TABLE `livestock_vaccinations`
  ADD PRIMARY KEY (`Vaccination_ID`),
  ADD KEY `Livestock_ID` (`Livestock_ID`),
  ADD KEY `VaccineAdministratorID` (`VaccineAdministratorID`);

--
-- Indexes for table `sold_livestocks`
--
ALTER TABLE `sold_livestocks`
  ADD PRIMARY KEY (`Sold_Livestock_ID`),
  ADD KEY `Sales_ID` (`Sales_ID`),
  ADD KEY `Livestock_ID` (`Livestock_ID`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`User_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `da_personnels`
--
ALTER TABLE `da_personnels`
  MODIFY `DAP_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `farmerlivestocks`
--
ALTER TABLE `farmerlivestocks`
  MODIFY `FL_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `farmer_cerficates`
--
ALTER TABLE `farmer_cerficates`
  MODIFY `FC_ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `farmer_data_history`
--
ALTER TABLE `farmer_data_history`
  MODIFY `FDH_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `farmer_profile`
--
ALTER TABLE `farmer_profile`
  MODIFY `Farmer_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `livestockbacthes`
--
ALTER TABLE `livestockbacthes`
  MODIFY `LB_ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `livestocks`
--
ALTER TABLE `livestocks`
  MODIFY `Livestock_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `livestock_advisories`
--
ALTER TABLE `livestock_advisories`
  MODIFY `Advisory_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `livestock_age_classification`
--
ALTER TABLE `livestock_age_classification`
  MODIFY `Age_Classification_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `livestock_batch_associations`
--
ALTER TABLE `livestock_batch_associations`
  MODIFY `LBA_ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `livestock_breedings`
--
ALTER TABLE `livestock_breedings`
  MODIFY `LB_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `livestock_breeds`
--
ALTER TABLE `livestock_breeds`
  MODIFY `Breed_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `livestock_mortalities`
--
ALTER TABLE `livestock_mortalities`
  MODIFY `LM_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `livestock_sales`
--
ALTER TABLE `livestock_sales`
  MODIFY `Sales_ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `livestock_types`
--
ALTER TABLE `livestock_types`
  MODIFY `LT_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `livestock_vaccinations`
--
ALTER TABLE `livestock_vaccinations`
  MODIFY `Vaccination_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `sold_livestocks`
--
ALTER TABLE `sold_livestocks`
  MODIFY `Sold_Livestock_ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `User_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `da_personnels`
--
ALTER TABLE `da_personnels`
  ADD CONSTRAINT `da_personnels_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user_accounts` (`User_ID`);

--
-- Constraints for table `farmerlivestocks`
--
ALTER TABLE `farmerlivestocks`
  ADD CONSTRAINT `farmerlivestocks_ibfk_1` FOREIGN KEY (`Livestock_ID`) REFERENCES `livestocks` (`Livestock_ID`),
  ADD CONSTRAINT `farmerlivestocks_ibfk_2` FOREIGN KEY (`Farmer_ID`) REFERENCES `farmer_profile` (`Farmer_ID`);

--
-- Constraints for table `farmer_cerficates`
--
ALTER TABLE `farmer_cerficates`
  ADD CONSTRAINT `farmer_cerficates_ibfk_1` FOREIGN KEY (`Farmer_ID`) REFERENCES `farmer_profile` (`Farmer_ID`);

--
-- Constraints for table `farmer_data_history`
--
ALTER TABLE `farmer_data_history`
  ADD CONSTRAINT `farmer_data_history_ibfk_1` FOREIGN KEY (`Farmer_ID`) REFERENCES `farmer_profile` (`Farmer_ID`),
  ADD CONSTRAINT `farmer_data_history_ibfk_2` FOREIGN KEY (`Livestock_ID`) REFERENCES `livestocks` (`Livestock_ID`);

--
-- Constraints for table `farmer_profile`
--
ALTER TABLE `farmer_profile`
  ADD CONSTRAINT `farmer_profile_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user_accounts` (`User_ID`);

--
-- Constraints for table `livestockbacthes`
--
ALTER TABLE `livestockbacthes`
  ADD CONSTRAINT `livestockbacthes_ibfk_1` FOREIGN KEY (`Farmer_ID`) REFERENCES `farmer_profile` (`Farmer_ID`);

--
-- Constraints for table `livestocks`
--
ALTER TABLE `livestocks`
  ADD CONSTRAINT `livestocks_ibfk_3` FOREIGN KEY (`Breed_Name`) REFERENCES `livestock_breeds` (`Breed_Name`),
  ADD CONSTRAINT `livestocks_ibfk_4` FOREIGN KEY (`Livestock_Type`) REFERENCES `livestock_types` (`Type_Name`),
  ADD CONSTRAINT `livestocks_ibfk_5` FOREIGN KEY (`Age_Classification`) REFERENCES `livestock_age_classification` (`Age_Classification_Name`);

--
-- Constraints for table `livestock_advisories`
--
ALTER TABLE `livestock_advisories`
  ADD CONSTRAINT `livestock_advisories_ibfk_1` FOREIGN KEY (`Target_Farmer_ID`) REFERENCES `farmer_profile` (`Farmer_ID`);

--
-- Constraints for table `livestock_age_classification`
--
ALTER TABLE `livestock_age_classification`
  ADD CONSTRAINT `livestock_age_classification_ibfk_1` FOREIGN KEY (`LT_ID`) REFERENCES `livestock_types` (`LT_ID`);

--
-- Constraints for table `livestock_batch_associations`
--
ALTER TABLE `livestock_batch_associations`
  ADD CONSTRAINT `livestock_batch_associations_ibfk_1` FOREIGN KEY (`Livestock_ID`) REFERENCES `livestocks` (`Livestock_ID`),
  ADD CONSTRAINT `livestock_batch_associations_ibfk_2` FOREIGN KEY (`Batch_ID`) REFERENCES `livestockbacthes` (`LB_ID`);

--
-- Constraints for table `livestock_breeds`
--
ALTER TABLE `livestock_breeds`
  ADD CONSTRAINT `livestock_breeds_ibfk_1` FOREIGN KEY (`LT_ID`) REFERENCES `livestock_types` (`LT_ID`);

--
-- Constraints for table `livestock_mortalities`
--
ALTER TABLE `livestock_mortalities`
  ADD CONSTRAINT `livestock_mortalities_ibfk_1` FOREIGN KEY (`Farmer_ID`) REFERENCES `farmer_profile` (`Farmer_ID`),
  ADD CONSTRAINT `livestock_mortalities_ibfk_2` FOREIGN KEY (`Livestock_ID`) REFERENCES `livestocks` (`Livestock_ID`);

--
-- Constraints for table `livestock_sales`
--
ALTER TABLE `livestock_sales`
  ADD CONSTRAINT `livestock_sales_ibfk_1` FOREIGN KEY (`Farmer_ID`) REFERENCES `farmer_profile` (`Farmer_ID`);

--
-- Constraints for table `livestock_vaccinations`
--
ALTER TABLE `livestock_vaccinations`
  ADD CONSTRAINT `livestock_vaccinations_ibfk_1` FOREIGN KEY (`Livestock_ID`) REFERENCES `livestocks` (`Livestock_ID`),
  ADD CONSTRAINT `livestock_vaccinations_ibfk_2` FOREIGN KEY (`VaccineAdministratorID`) REFERENCES `farmer_profile` (`Farmer_ID`);

--
-- Constraints for table `sold_livestocks`
--
ALTER TABLE `sold_livestocks`
  ADD CONSTRAINT `sold_livestocks_ibfk_1` FOREIGN KEY (`Sales_ID`) REFERENCES `livestock_sales` (`Sales_ID`),
  ADD CONSTRAINT `sold_livestocks_ibfk_2` FOREIGN KEY (`Livestock_ID`) REFERENCES `livestocks` (`Livestock_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
