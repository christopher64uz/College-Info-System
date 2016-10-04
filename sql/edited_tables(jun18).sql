-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 18, 2012 at 12:08 PM
-- Server version: 5.5.22
-- PHP Version: 5.3.10-1ubuntu3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `College_Automation`
--

-- --------------------------------------------------------

--
-- Table structure for table `student_more_details`
--

CREATE TABLE IF NOT EXISTS `student_more_details` (
  `Stud_ID` varchar(15) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `mobile_no` bigint(15) NOT NULL,
  `phy_handicapped` varchar(3) NOT NULL,
  `eco_backward` varchar(3) NOT NULL,
  `f_mobile_no` bigint(15) NOT NULL,
  `m_mobile_no` bigint(15) NOT NULL,
  `att_def_hyp_dis` varchar(3) NOT NULL DEFAULT 'No',
  `learn_disability` varchar(3) NOT NULL DEFAULT 'No',
  `depression` varchar(3) NOT NULL DEFAULT 'No',
  `other_diagnosis` varchar(100) NOT NULL,
  `psychiatric_medicine` varchar(300) NOT NULL,
  `remark` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`Stud_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temp_studid`
--

CREATE TABLE IF NOT EXISTS `temp_studid` (
  `inc_no` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  PRIMARY KEY (`inc_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Table structure for table `staff_other_details`
--

CREATE TABLE IF NOT EXISTS `staff_other_details` (
  `empid` varchar(10) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `middlename` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `mothersname` varchar(30) NOT NULL,
  `fathersname` varchar(30) NOT NULL,
  `domicile` varchar(30) NOT NULL,
  `phy_handicapped` varchar(3) NOT NULL,
  `fax_phone` varchar(15) NOT NULL,
  `bank_branch` varchar(100) NOT NULL,
  `iifc_code` varchar(20) NOT NULL,
  `fy_commsubteacher` varchar(3) NOT NULL,
  `fy_commsubject` varchar(30) NOT NULL,
  `aicte_expert` varchar(3) NOT NULL,
  `aicte_grant` varchar(3) NOT NULL,
  `notice_date` date NOT NULL,
  `resigned_date` date NOT NULL,
  `relieved_date` date NOT NULL,
  PRIMARY KEY (`empid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Other Details';


