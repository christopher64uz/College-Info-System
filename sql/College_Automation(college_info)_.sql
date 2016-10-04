-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 23, 2012 at 12:02 PM
-- Server version: 5.1.58
-- PHP Version: 5.3.6-13ubuntu3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `College_Automation`
--

-- --------------------------------------------------------

--
-- Table structure for table `prev_inst_master`
--

CREATE TABLE IF NOT EXISTS `prev_inst_master` (
  `prev_inst_name` varchar(255) NOT NULL,
  `prev_inst_address` varchar(255) NOT NULL DEFAULT '-'
) ENGINE=MyISAM DEFAULT CHARSET=ascii COMMENT='Student''s Previous Institute';

-- --------------------------------------------------------

--
-- Table structure for table `staff_family_details`
--

CREATE TABLE IF NOT EXISTS `staff_family_details` (
  `empid` varchar(20) NOT NULL,
  `no_of_fmly_membrs` tinyint(10) NOT NULL COMMENT 'total family members',
  `no_depndnt_membrs` tinyint(20) DEFAULT NULL COMMENT 'number of dependent  family members',
  PRIMARY KEY (`empid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff_higheduc_details`
--

CREATE TABLE IF NOT EXISTS `staff_higheduc_details` (
  `empid` varchar(10) NOT NULL,
  `doctrate_deg` varchar(3) NOT NULL,
  `pg_deg` varchar(100) NOT NULL,
  `ug_deg` varchar(100) NOT NULL,
  `other_qual` varchar(100) NOT NULL,
  `area_special` varchar(100) NOT NULL,
  `teach_years` float NOT NULL,
  `research_years` float NOT NULL,
  `nat_public` varchar(500) NOT NULL,
  `patents` varchar(500) NOT NULL,
  `no_pg_proj` int(5) NOT NULL,
  `no_doc_proj` int(5) NOT NULL,
  `inter_public` varchar(500) NOT NULL,
  `books_pub` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Higher Education Details';

-- --------------------------------------------------------

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
  `fy_commsubteacher` varchar(3) NOT NULL,
  `fy_commsubject` varchar(30) NOT NULL,
  `aicte_expert` varchar(3) NOT NULL,
  `aicte_grant` varchar(3) NOT NULL,
  `date_of_resign` date NOT NULL,
  `relieved_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff_personal_details`
--

CREATE TABLE IF NOT EXISTS `staff_personal_details` (
  `empid` varchar(20) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL,
  `ename` varchar(512) NOT NULL,
  `currnt_addr` text CHARACTER SET ascii NOT NULL,
  `prmnt_addr` text CHARACTER SET ascii NOT NULL,
  `nationality` varchar(20) CHARACTER SET ascii NOT NULL DEFAULT 'indian',
  `religion` varchar(50) CHARACTER SET ascii NOT NULL,
  `category` varchar(20) CHARACTER SET ascii NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(10) CHARACTER SET ascii NOT NULL DEFAULT 'male',
  `mobile_no` bigint(15) DEFAULT '0',
  `landln_no` bigint(15) DEFAULT '0',
  `email` varchar(50) CHARACTER SET ascii DEFAULT '-',
  `emrgncy_no` bigint(15) NOT NULL DEFAULT '0',
  `marital_status` varchar(10) CHARACTER SET ascii NOT NULL DEFAULT 'unmarried',
  `passport_no` varchar(15) CHARACTER SET ascii DEFAULT 'None',
  `passport_issue_dt` date DEFAULT NULL,
  `passport_expiry_dt` date DEFAULT NULL,
  `spouse_name` varchar(20) CHARACTER SET ascii DEFAULT '-',
  `entrydate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `qualification` varchar(255) NOT NULL,
  `in_or_out` tinyint(4) NOT NULL,
  `ldap_username` varchar(150) DEFAULT '-',
  `bit` int(255) NOT NULL,
  PRIMARY KEY (`empid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff_work_details`
--

CREATE TABLE IF NOT EXISTS `staff_work_details` (
  `empid` varchar(20) NOT NULL,
  `joining_date` date NOT NULL,
  `pay_type` varchar(255) NOT NULL,
  `emp_type` varchar(20) CHARACTER SET ascii NOT NULL DEFAULT 'permanent' COMMENT 'temporary/permanent/guest',
  `staff_type` varchar(25) DEFAULT NULL COMMENT 'teaching/nonteaching',
  `duration` int(11) NOT NULL COMMENT 'duration for temp/permanent/guest',
  `department` varchar(50) CHARACTER SET ascii DEFAULT NULL COMMENT 'teching & non teaching',
  `designation` varchar(40) CHARACTER SET ascii NOT NULL,
  `confirmation_date` date NOT NULL,
  `PAN_no` varchar(20) CHARACTER SET ascii DEFAULT 'None',
  `PF_accnt_no` varchar(50) CHARACTER SET ascii NOT NULL,
  `bank_accnt_no` varchar(20) NOT NULL,
  `bank_name` varchar(100) CHARACTER SET ascii NOT NULL,
  `entrydate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `univ_appr_status` varchar(255) NOT NULL,
  `ugc_intrvw` varchar(255) NOT NULL,
  `intime` time NOT NULL,
  `outtime` time NOT NULL,
  PRIMARY KEY (`empid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_details`
--

CREATE TABLE IF NOT EXISTS `student_details` (
  `Stud_ID` varchar(15) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `branch` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'none',
  `ldap_username` varchar(255) NOT NULL DEFAULT '-',
  `Name` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL DEFAULT 'none',
  `Sex` varchar(6) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'none',
  `DOB` date NOT NULL DEFAULT '0000-00-00',
  `Local` varchar(500) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'none',
  `Native` varchar(500) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'none',
  `Contact_No` varchar(17) NOT NULL DEFAULT '0',
  `Nationality` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'none',
  `Domicile` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'none',
  `Religion` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'none',
  `Category` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'none',
  `POB` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'none',
  `IM` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'none',
  `Email` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'none',
  `Form_No` varchar(17) NOT NULL DEFAULT '0',
  `prev_inst` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'none',
  `doj` date NOT NULL DEFAULT '0000-00-00',
  `dol` date NOT NULL DEFAULT '0000-00-00',
  `Blood_Grp` varchar(5) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'none',
  `Allergies` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'none',
  `Thalassemia` varchar(15) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'none',
  `doc_name` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'none',
  `doc_contact` varchar(17) NOT NULL DEFAULT '0',
  `doc_email` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'none',
  `F_NAME` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'none',
  `F_Occupation` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'none',
  `F_Contact_No` varchar(17) NOT NULL DEFAULT '0',
  `F_Office_address` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'none',
  `F_Annual_Income` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'none',
  `F_Email_Id` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'none',
  `M_Name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'none',
  `M_Occupation` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'none',
  `M_Contact_No` varchar(17) NOT NULL DEFAULT '0',
  `M_Office_address` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'none',
  `M_Annual_Income` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'none',
  `M_Email_Id` varchar(15) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'none',
  `Ref_Name1` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'none',
  `Contact_No1` varchar(17) NOT NULL DEFAULT '0',
  `Address1` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'none',
  `Relation1` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'none',
  `Ref_Name2` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'none',
  `Contact_No2` varchar(17) NOT NULL DEFAULT '0',
  `Address2` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'none',
  `Relation2` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'none',
  `Entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `DOLI` date NOT NULL DEFAULT '0000-00-00',
  `DOA` date NOT NULL DEFAULT '0000-00-00',
  `semester` varchar(20) CHARACTER SET macroman COLLATE macroman_bin DEFAULT NULL,
  `stream` varchar(50) CHARACTER SET macroman COLLATE macroman_bin DEFAULT NULL,
  PRIMARY KEY (`Stud_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_more_details`
--

CREATE TABLE IF NOT EXISTS `student_more_details` (
  `Stud_ID` varchar(15) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `mobile_no` bigint(15) NOT NULL,
  `phy_handicapped` varchar(3) NOT NULL,
  `eco_backward` varchar(3) NOT NULL,
  `f_mobile_no` bigint(15) NOT NULL,
  `m_mobile_no` bigint(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_prev_qual`
--

CREATE TABLE IF NOT EXISTS `student_prev_qual` (
  `Stud_ID` varchar(15) NOT NULL,
  `cet_score` int(5) NOT NULL,
  `aieee_score` int(5) NOT NULL,
  `hsc_aggregate` int(5) NOT NULL,
  `hsc_outof` int(5) NOT NULL,
  `pcm_total` int(5) NOT NULL,
  `pcm_outof` int(5) NOT NULL,
  `ssc_aggregate` int(5) NOT NULL,
  `ssc_outof` int(5) NOT NULL,
  `diploma_aggregate` int(5) NOT NULL,
  `diploma_outof` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
