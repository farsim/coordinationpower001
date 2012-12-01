-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 01, 2012 at 05:23 AM
-- Server version: 5.1.36-community-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE IF NOT EXISTS `agenda` (
  `AgendaId` int(11) NOT NULL AUTO_INCREMENT,
  `Agenda` text,
  `CreateDate` datetime DEFAULT NULL,
  `Type` int(1) NOT NULL,
  `Status` int(11) DEFAULT NULL,
  PRIMARY KEY (`AgendaId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`AgendaId`, `Agenda`, `CreateDate`, `Type`, `Status`) VALUES
(1, 'বিগত সভার কার্যবিবরণী পাঠ ও অনুমোদন হয়েছে কিনা?', '2012-12-01 00:00:00', 1, 1),
(2, 'বিগত সভার সিদ্ধান্তসমূহ বাস্তবায়ন অগ্রগতি কতটুকু হয়েছে?', '2012-12-01 00:00:00', 2, 1),
(3, 'বিভিন্ন বিভাগ/সংস্থা ওয়ারী কার্যক্রম বাস্তবায়নের অগ্রগতি কতটুকু হয়েছে?', '2012-12-01 00:00:00', 2, 1),
(4, 'ইউনিয়ন এলাকার সেবা সরবরাহ পরিস্থিতি পর্যালোচনা, উন্নয়ন সহযোগী কর্তৃক বাস্তবায়নাধীন কর্মকান্ডের অগ্রগতি আলোচনা এবং পরিকল্পনা প্রণয়ন কতটুকু হয়েছে?', '2012-12-01 00:00:00', 2, 1),
(5, 'পরবর্তি সভার আলোচ্যসূচী নির্ধারন হয়েছে কি?', '2012-12-01 00:00:00', 1, 1),
(6, 'বিবিধ', '2012-12-01 00:00:00', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('a2124fd6ec9716b3aa3cf03268013bc9', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:16.0) Gecko/20100101 Firefox/16.0 FirePHP/0.7.1', 1354338968, 'a:7:{s:9:"user_data";s:0:"";s:6:"userID";s:1:"2";s:8:"username";s:5:"bappi";s:5:"email";s:20:"bappi.sust@gmail.com";s:9:"user_type";s:1:"0";s:10:"union_name";s:7:"Aorjona";s:8:"union_id";s:1:"3";}');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE IF NOT EXISTS `district` (
  `DistrictId` int(11) NOT NULL AUTO_INCREMENT,
  `DistrictName` varchar(45) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  PRIMARY KEY (`DistrictId`),
  UNIQUE KEY `DistrictName_UNIQUE` (`DistrictName`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`DistrictId`, `DistrictName`, `Status`) VALUES
(1, 'Tangail', 1);

-- --------------------------------------------------------

--
-- Table structure for table `meeting`
--

CREATE TABLE IF NOT EXISTS `meeting` (
  `MeetingId` int(11) NOT NULL AUTO_INCREMENT,
  `MeetingDate` int(45) DEFAULT NULL,
  `UnionId` int(11) NOT NULL,
  `Status` int(11) DEFAULT NULL,
  PRIMARY KEY (`MeetingId`),
  KEY `fk_Meeting_Union1_idx` (`UnionId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `meeting`
--

INSERT INTO `meeting` (`MeetingId`, `MeetingDate`, `UnionId`, `Status`) VALUES
(5, 1354325922, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `meetingagenda`
--

CREATE TABLE IF NOT EXISTS `meetingagenda` (
  `MeetingAgendaId` int(11) NOT NULL AUTO_INCREMENT,
  `AgendaId` int(11) NOT NULL,
  `MeetingId` int(11) NOT NULL,
  PRIMARY KEY (`MeetingAgendaId`),
  KEY `fk_MeetingAgenda_Agenda1_idx` (`AgendaId`),
  KEY `fk_MeetingAgenda_Meeting1_idx` (`MeetingId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `meetingagenda`
--

INSERT INTO `meetingagenda` (`MeetingAgendaId`, `AgendaId`, `MeetingId`) VALUES
(25, 1, 5),
(26, 2, 5),
(27, 3, 5),
(28, 4, 5),
(29, 5, 5),
(30, 6, 5);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `ReviewId` int(11) NOT NULL AUTO_INCREMENT,
  `MeetingAgendaId` int(11) NOT NULL,
  `UserMeetingId` int(11) NOT NULL,
  `Review` int(11) DEFAULT NULL,
  PRIMARY KEY (`ReviewId`),
  KEY `fk_Review_MeetingAgenda1_idx` (`MeetingAgendaId`),
  KEY `fk_Review_UserMeeting1_idx` (`UserMeetingId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`ReviewId`, `MeetingAgendaId`, `UserMeetingId`, `Review`) VALUES
(1, 25, 8, 10),
(2, 26, 8, 5),
(3, 27, 8, 7),
(4, 28, 8, 2),
(5, 29, 8, 0),
(6, 25, 10, 10),
(7, 26, 10, 6),
(8, 27, 10, 3),
(9, 28, 10, 5),
(10, 29, 10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `unions`
--

CREATE TABLE IF NOT EXISTS `unions` (
  `UnionId` int(11) NOT NULL AUTO_INCREMENT,
  `UnionName` varchar(45) DEFAULT NULL,
  `Longitude` varchar(200) DEFAULT NULL,
  `Latitude` varchar(200) DEFAULT NULL,
  `UpazilaId` int(11) NOT NULL,
  `Status` int(11) DEFAULT NULL,
  PRIMARY KEY (`UnionId`),
  KEY `fk_Union_Upazila1_idx` (`UpazilaId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `unions`
--

INSERT INTO `unions` (`UnionId`, `UnionName`, `Longitude`, `Latitude`, `UpazilaId`, `Status`) VALUES
(1, 'Habla', NULL, NULL, 1, 1),
(2, 'Basail', NULL, NULL, 1, 1),
(3, 'Aorjona', NULL, NULL, 2, 1),
(4, 'Delduar', NULL, NULL, 3, 1),
(5, 'Deuli', NULL, NULL, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `upazila`
--

CREATE TABLE IF NOT EXISTS `upazila` (
  `UpazilaId` int(11) NOT NULL AUTO_INCREMENT,
  `UpazilaName` varchar(45) DEFAULT NULL,
  `DistrictId` int(11) NOT NULL,
  `Status` int(11) DEFAULT NULL,
  PRIMARY KEY (`UpazilaId`),
  KEY `fk_Upazila_District_idx` (`DistrictId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `upazila`
--

INSERT INTO `upazila` (`UpazilaId`, `UpazilaName`, `DistrictId`, `Status`) VALUES
(1, 'Basail', 1, 1),
(2, 'Bhuapur', 1, 1),
(3, 'Delduar', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `UserId` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(45) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Password` varchar(45) DEFAULT NULL,
  `NationalId` varchar(50) DEFAULT NULL,
  `Type` int(11) DEFAULT NULL,
  `Designation` varchar(45) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  PRIMARY KEY (`UserId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserId`, `UserName`, `Email`, `Password`, `NationalId`, `Type`, `Designation`, `Status`) VALUES
(1, 'arnab', 'arnab.sust@gmail.com', '670b14728ad9902aecba32e22fa4f6bd', '1111111111111', 0, 'Chairman', 1),
(2, 'bappi', 'bappi.sust@gmail.com', '670b14728ad9902aecba32e22fa4f6bd', '2222222222222', 0, 'MD', 1),
(3, 'Farsim', 'farsim@ymail.com', '670b14728ad9902aecba32e22fa4f6bd', '3333333333333', 0, 'asd', 1),
(4, 'admin', 'admin@admin.com', '670b14728ad9902aecba32e22fa4f6bd', '5555555555555', 1, 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usermeeting`
--

CREATE TABLE IF NOT EXISTS `usermeeting` (
  `UserMeetingId` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `MeetingId` int(11) NOT NULL,
  PRIMARY KEY (`UserMeetingId`),
  KEY `fk_UserMeeting_User1_idx` (`UserId`),
  KEY `fk_UserMeeting_Meeting1_idx` (`MeetingId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `usermeeting`
--

INSERT INTO `usermeeting` (`UserMeetingId`, `UserId`, `MeetingId`) VALUES
(8, 2, 5),
(9, 3, 5),
(10, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `userunion`
--

CREATE TABLE IF NOT EXISTS `userunion` (
  `UserUnioId` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `UnionId` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  PRIMARY KEY (`UserUnioId`),
  KEY `fk_UserUnion_User1_idx` (`UserId`),
  KEY `fk_UserUnion_Union1_idx` (`UnionId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `userunion`
--

INSERT INTO `userunion` (`UserUnioId`, `UserId`, `UnionId`, `Status`) VALUES
(1, 4, 3, 1),
(2, 2, 3, 1),
(3, 3, 3, 1),
(4, 1, 3, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `meeting`
--
ALTER TABLE `meeting`
  ADD CONSTRAINT `fk_Meeting_Union1` FOREIGN KEY (`UnionId`) REFERENCES `unions` (`UnionId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `meetingagenda`
--
ALTER TABLE `meetingagenda`
  ADD CONSTRAINT `fk_MeetingAgenda_Agenda1` FOREIGN KEY (`AgendaId`) REFERENCES `agenda` (`AgendaId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_MeetingAgenda_Meeting1` FOREIGN KEY (`MeetingId`) REFERENCES `meeting` (`MeetingId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `fk_Review_MeetingAgenda1` FOREIGN KEY (`MeetingAgendaId`) REFERENCES `meetingagenda` (`MeetingAgendaId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Review_UserMeeting1` FOREIGN KEY (`UserMeetingId`) REFERENCES `usermeeting` (`UserMeetingId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `unions`
--
ALTER TABLE `unions`
  ADD CONSTRAINT `fk_Union_Upazila1` FOREIGN KEY (`UpazilaId`) REFERENCES `upazila` (`UpazilaId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `upazila`
--
ALTER TABLE `upazila`
  ADD CONSTRAINT `fk_Upazila_District` FOREIGN KEY (`DistrictId`) REFERENCES `district` (`DistrictId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `usermeeting`
--
ALTER TABLE `usermeeting`
  ADD CONSTRAINT `fk_UserMeeting_Meeting1` FOREIGN KEY (`MeetingId`) REFERENCES `meeting` (`MeetingId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_UserMeeting_User1` FOREIGN KEY (`UserId`) REFERENCES `user` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `userunion`
--
ALTER TABLE `userunion`
  ADD CONSTRAINT `fk_UserUnion_Union1` FOREIGN KEY (`UnionId`) REFERENCES `unions` (`UnionId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_UserUnion_User1` FOREIGN KEY (`UserId`) REFERENCES `user` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
