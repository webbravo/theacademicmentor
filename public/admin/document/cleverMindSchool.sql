-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 13, 2017 at 12:19 AM
-- Server version: 5.6.35
-- PHP Version: 7.0.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cleverMindSchool`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE IF NOT EXISTS `activity` (
  `activity_id` int(6) NOT NULL,
  `activityName` varchar(110) NOT NULL,
  `description` varchar(255) NOT NULL,
  `score` int(4) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(3) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `hashedPassword` varchar(60) NOT NULL,
  `dateCreated` datetime(6) NOT NULL,
  `lastLogin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `accountType` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

-- INSERT INTO `admin` ( `firstName`, `lastName`, `email`, `phone`, `hashedPassword`, `dateCreated`, `lastLogin`, `accountType`) VALUES
-- ( 'Cleverminds', 'Schools', 'cleverminds@gmail.com', '08062416692', '$2y$10$kPd7Brq34ZWMOlwdQjCYmObfXMjkuEJohbY/dJI68cEHqZMUywiEG', '2017-11-03 00:00:00.000000', '0000-00-00 00:00:00', '1');

-- --------------------------------------------------------

--
-- Table structure for table `award`
--

CREATE TABLE IF NOT EXISTS `award` (
  `id` int(3) NOT NULL,
  `awardPhoto` varchar(255) NOT NULL,
  `awardTitle` varchar(200) NOT NULL,
  `awardStory` text NOT NULL,
  `dateAdded` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `award`
--

INSERT INTO `award` (`id`, `awardPhoto`, `awardTitle`, `awardStory`, `dateAdded`) VALUES
(3, 'admin/uploads/awards/1510160905netflix.jpg', 'Exellecence in Tech award', '@teamwebbravo was yesterday at the grant entrepreneurial conference awarded.', '0000-00-00'),
(5, 'admin/uploads/awards/1510142479culture1.jpg', 'Standard education award', 'With the educational standard continuing to drop in Nigeria, high rate of poverty and unemployment in the slums, the typical Delta family especially those in the slums and shantyy towns now require the best of education and access to modern technology to make learning effective. ', '0000-00-00'),
(8, 'admin/uploads/awards/1510160905netflix.jpg', 'Exellecence in Tech award', '@teamwebbravo was yesterday at the grant entrepreneurial conference awarded.', '0000-00-00'),
(9, 'admin/uploads/awards/1510238376hangout.jpg', 'Tech Award in Lagos', 'The lagos Tech hub award was present to webbravo team in Nigeria.', '0000-00-00'),
(10, 'admin/uploads/awards/1510160905netflix.jpg', 'New york developers award', '@teamwebbravo was yesterday at the grant entrepreneurial conference awarded.', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `bankDetails`
--

CREATE TABLE IF NOT EXISTS `bankDetails` (
  `id` int(2) NOT NULL,
  `accountName` varchar(100) NOT NULL,
  `bankName` varchar(100) NOT NULL,
  `accountNumber` int(10) NOT NULL,
  `verified` tinyint(1) DEFAULT NULL,
  `dateCreated` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `teacher_id` bigint(20) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE IF NOT EXISTS `blog` (
  `id` int(4) NOT NULL,
  `blogPhoto` varchar(255) NOT NULL,
  `blogTitle` varchar(255) NOT NULL,
  `blogStory` text NOT NULL,
  `dateAdded` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `blogPhoto`, `blogTitle`, `blogStory`, `dateAdded`) VALUES
(1, 'admin/uploads/blog/1510300531culture2.jpg', 'Culture Centric', '<h2>About Urhobo People</h2><p>\r\n            The <b>Urhobos </b>are people of southern Nigeria, near the \r\nnorthwestern Niger delta. The <b>Urhobo </b>is the major ethnic group in Delta \r\nState. Delta State is one of the 36 states of the Federal Republic of \r\nNigeria. The <b>Urhobos </b>speak the <b>Urhobo </b>language. The <b>Urhobo </b>culture is \r\nrelated to several cultures in the Niger-Delta. Isoko is closely related\r\n in language and culture, leading to the missionaries erroneously \r\nlabelling the <b>Urhobo </b>and Isoko cultural groups as Sobo. This name was \r\nstrongly rejected by both tribes. However, there are those of the \r\nopinion that Isoko is a dialect of <b>Urhobo</b>. The <b>Urhobo </b>nation is made up \r\nof twenty four sub-groups, including Okpe[1] the largest of all Urhobo \r\nsub-groups.[2] Isoko used to be regarded as a part of <b>Urhobo </b>nation \r\nuntil the late 1950s when they were granted autonomy.The <b>Urhobos </b>live \r\nvery close to and sometimes on the surface of the Niger river. Thus most\r\n of their histories, mythologies, and philosophies are water-related. \r\nAnnual fishing festivals that includes masquerades, fishing, swimming \r\ncontests, and dancing, are part of the <b>Urhobo </b>heritage. There is an \r\nannual, two-day, Ohworu festival in Evwreni, the southern part of the \r\n<b>Urhobo </b>area when the Ohworhu water spirit and the Eravwe Oganga are \r\ndisplayed. The king in an <b>Urhobo </b>clan or kingdom is called the Ovie.\r\n          </p><p><br><p><br></p></p>', '2017-11-10 08:55:31'),
(2, 'admin/uploads/blog/1510883077ab6bb6ea311891a70b83d3935f69e467IMG-20161025-WA0000.jpg', 'Clever minds school website v1.0.0', '<h2>Website Version 1.1.0</h2><p>At Clever minds, weâ€™re committed to hands-on learning for every child and utilizing wireless technology to deliver great results.Â  We support teachers, tailor lessons and leverage cutting edge innovation and technology to provide families with great schools and high-quality education.</p><p>Below are some examples weâ€™ve developed to help us:</p>', '2017-11-17 02:38:29');

-- --------------------------------------------------------

--
-- Table structure for table `class2teacher`
--

CREATE TABLE IF NOT EXISTS `class2teacher` (
  `id` int(11) NOT NULL,
  `class_id` int(6) unsigned NOT NULL,
  `teacher_id` bigint(20) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `classInfo`
--

CREATE TABLE IF NOT EXISTS `classInfo` (
  `class_id` int(6) unsigned NOT NULL,
  `className` varchar(100) NOT NULL,
  `ageGroup` varchar(30) NOT NULL,
  `classColor` varchar(20) NOT NULL,
  `description` varchar(256) DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `classPerformance`
--

CREATE TABLE IF NOT EXISTS `classPerformance` (
  `id` int(8) unsigned NOT NULL,
  `class_id` int(6) unsigned NOT NULL,
  `performanceIndex` int(4) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `course_id` int(6) NOT NULL,
  `courseName` varchar(255) NOT NULL,
  `description` text,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `courseWork`
--

CREATE TABLE IF NOT EXISTS `courseWork` (
  `coursework_id` int(8) NOT NULL,
  `class_id` int(6) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `academicYear` varchar(10) NOT NULL,
  `term` varchar(20) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `id` int(4) NOT NULL,
  `eventPhoto` varchar(1000) NOT NULL,
  `eventTitle` varchar(255) NOT NULL,
  `eventLocation` varchar(255) NOT NULL,
  `startDate` varchar(100) NOT NULL,
  `endDate` varchar(100) NOT NULL,
  `eventStory` text NOT NULL,
  `timeZone` varchar(200) NOT NULL,
  `dateAdded` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `eventPhoto`, `eventTitle`, `eventLocation`, `startDate`, `endDate`, `eventStory`, `timeZone`, `dateAdded`) VALUES
(4, 'admin/uploads/events/1510843027df847a7fcc09678973d5a424173a3f7dnetflix.jpg', 'Angular.Ng Conference', 'Mountain View, Sillion valley, CA', '0', '0', 'The angular conference for angular developers all across the nation, the hackathron will feature many skilled angular developers, the event is powered by the Angular team in Nigeria @teamwebbravo. ', 'Africa/Lagos', '2017-11-16'),
(5, 'admin/uploads/events/15108758849e5ba3f22653eb47cf1a53efeebb8ce4IMG-20161017-WA0006.jpg', 'The Andela Community learning with Google', 'Mountain View, Sillion valley, CA', '1518773200', '1518873200', 'ï‚§	Clever Minds seeks to recruit entirely from the communities in which we serve, providing local talent the opportunity to be trained as teachers and to become leaders and role models within their communities.\r\nï‚§	Clever Minds complies with government requirements for teacher certifications, and works with governments to find practical solutions in areas with severe teacher shortages.\r\nï‚§	Clever Mindsâ€™ Measurement and Evaluation team works closely with government bodies to understand which teacher training and support techniques are most effective, and which teacher ', 'Africa/Lagos', '2017-11-16'),
(6, 'admin/uploads/events/1510857577314e637695174b8a7f87bdd824bd2a6ahangout.jpg', 'Google developers Conference', 'Mountain View, Sillion valley, CA', '1511773200', '1512184320', 'At Clever minds, weâ€™re committed to hands-on learning for every child and utilising wireless technology to deliver great results.  We support teachers, tailor lessons and leverage cutting edge innovation and technology to provide families with great schools and high-quality education.\r\n\r\nBelow are some examples weâ€™ve developed to help us:', 'Africa/Lagos', '2017-11-16');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE IF NOT EXISTS `exam` (
  `exam_id` int(6) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `course_id` int(6) NOT NULL,
  `studentScore` int(6) DEFAULT NULL,
  `academicYear` int(10) NOT NULL,
  `term` varchar(20) NOT NULL,
  `date` datetime NOT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(6) NOT NULL,
  `expenseName` varchar(255) NOT NULL,
  `amount` decimal(8,4) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `details` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feePayment`
--

CREATE TABLE IF NOT EXISTS `feePayment` (
  `message_id` int(3) NOT NULL,
  `messageName` varchar(10) NOT NULL,
  `emailMsg` text NOT NULL,
  `smsMsg` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feeReminderMsg`
--

CREATE TABLE IF NOT EXISTS `feeReminderMsg` (
  `message_id` int(3) NOT NULL,
  `messageName` varchar(10) NOT NULL,
  `emailMsg` text NOT NULL,
  `smsMsg` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feesCategory`
--

CREATE TABLE IF NOT EXISTS `feesCategory` (
  `fees_cat_id` int(6) NOT NULL,
  `class_id` int(6) unsigned NOT NULL,
  `totalAmount` decimal(8,4) NOT NULL,
  `uniform` decimal(8,4) NOT NULL,
  `books` decimal(8,4) NOT NULL,
  `lunch` decimal(8,4) NOT NULL,
  `stationary` decimal(8,4) NOT NULL,
  `excursion` decimal(8,4) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feesTransaction`
--

CREATE TABLE IF NOT EXISTS `feesTransaction` (
  `transact_id` int(6) NOT NULL,
  `student_id` bigint(20) unsigned NOT NULL,
  `amountPaid` decimal(8,4) NOT NULL,
  `term` varchar(20) NOT NULL,
  `balance` decimal(8,4) NOT NULL,
  `fees_cat_id` int(5) NOT NULL,
  `date` datetime NOT NULL,
  `academicYear` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fundraiser`
--

CREATE TABLE IF NOT EXISTS `fundraiser` (
  `fundraiser_id` int(6) NOT NULL,
  `facebook_id` varchar(255) DEFAULT NULL,
  `fullName` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phoneNumber` varchar(50) DEFAULT NULL,
  `hashedPassword` varchar(60) DEFAULT NULL,
  `recoveryHash` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE IF NOT EXISTS `income` (
  `id` int(6) NOT NULL,
  `incomeName` varchar(255) NOT NULL,
  `amount` decimal(8,4) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `details` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lessonNote`
--

CREATE TABLE IF NOT EXISTS `lessonNote` (
  `lessonNote_id` int(8) NOT NULL,
  `teacher_id` bigint(20) unsigned NOT NULL,
  `course_id` int(8) NOT NULL,
  `class_id` int(6) unsigned NOT NULL,
  `topic` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `photoGallery`
--

CREATE TABLE IF NOT EXISTS `photoGallery` (
  `id` int(5) NOT NULL,
  `photoName` varchar(2000) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photoGallery`
--

INSERT INTO `photoGallery` (`id`, `photoName`, `caption`, `dateAdded`) VALUES
(5, 'admin/uploads/photographs/1510674525290a67eea7135365157628f4cdd47b46IMG_7101.jpg', NULL, '2017-11-14 15:48:45'),
(8, 'admin/uploads/photographs/1510683532320b3353361f18332fe549957d002895IMG_7193.jpg', NULL, '2017-11-14 18:18:52'),
(11, 'admin/uploads/photographs/1510683681314e637695174b8a7f87bdd824bd2a6ahangout.jpg', NULL, '2017-11-14 18:21:21'),
(12, 'admin/uploads/photographs/15106837306d905f0ade5eaf4892b229b154a46b292.jpg', NULL, '2017-11-14 18:22:10'),
(13, 'admin/uploads/photographs/15106837746d905f0ade5eaf4892b229b154a46b292.jpg', NULL, '2017-11-14 18:22:54'),
(14, 'admin/uploads/photographs/15106837893168047a029c9fb4329e53251cb17caaUntitled.png', NULL, '2017-11-14 18:23:09'),
(15, 'admin/uploads/photographs/15106839073168047a029c9fb4329e53251cb17caaUntitled.png', NULL, '2017-11-14 18:25:07'),
(21, 'admin/uploads/photographs/151305206611f104ead9997b56ac1d18430021c23d25k.jpg', NULL, '2017-12-12 04:14:26'),
(22, 'admin/uploads/photographs/1513055423ab6bb6ea311891a70b83d3935f69e467IMG-20161025-WA0000.jpg', NULL, '2017-12-12 05:10:24'),
(23, 'admin/uploads/photographs/15130554775e67cf5bc15a1890b9b48de2c161bc40Screenshot-2017-11-19 Maximiliano Firtman ( firt) Twitter.png', NULL, '2017-12-12 05:11:17'),
(24, 'admin/uploads/photographs/1513055727e48ab642a89490519b1b6556e435f42bken.jpg', NULL, '2017-12-12 05:15:27');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `project_id` int(6) NOT NULL,
  `projectName` varchar(220) NOT NULL,
  `projectCost` decimal(8,4) NOT NULL,
  `location` varchar(120) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `countDown` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `projectFunding`
--

CREATE TABLE IF NOT EXISTS `projectFunding` (
  `id` int(6) NOT NULL,
  `project_id` int(6) NOT NULL,
  `fundraiser_id` int(6) NOT NULL,
  `amountDonated` decimal(8,4) NOT NULL,
  `donationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `salaryCategory`
--

CREATE TABLE IF NOT EXISTS `salaryCategory` (
  `salary_id` int(6) NOT NULL,
  `amount` decimal(10,4) NOT NULL,
  `salaryName` varchar(100) NOT NULL,
  `paymentTime` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sponsor`
--

CREATE TABLE IF NOT EXISTS `sponsor` (
  `sponsor_id` bigint(20) unsigned NOT NULL,
  `facebook_id` bigint(20) unsigned DEFAULT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `otherName` varchar(255) DEFAULT NULL,
  `email` varchar(60) NOT NULL,
  `phoneNumber` varchar(15) NOT NULL,
  `hashedPassword` varchar(60) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(15) NOT NULL,
  `country` varchar(40) DEFAULT NULL,
  `recoveryHash` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `std2courseWork`
--

CREATE TABLE IF NOT EXISTS `std2courseWork` (
  `id` int(8) NOT NULL,
  `coursework_id` int(8) NOT NULL,
  `student_id` bigint(20) unsigned NOT NULL,
  `score` int(4) NOT NULL,
  `academicYear` varchar(10) NOT NULL,
  `term` varchar(20) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `student_id` bigint(20) unsigned NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `otherName` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `phoneNumber` varchar(255) DEFAULT NULL,
  `studentNumber` varchar(20) NOT NULL,
  `hashedPassword` varchar(65) NOT NULL,
  `recoveryHash` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(60) NOT NULL,
  `state` varchar(60) NOT NULL,
  `bio` text,
  `dateOfbirth` varchar(20) NOT NULL,
  `sex` varchar(6) NOT NULL,
  `previousSch` varchar(255) NOT NULL,
  `dateAdmitted` date NOT NULL,
  `sponsor_id` bigint(20) unsigned NOT NULL,
  `class_id` int(6) unsigned NOT NULL,
  `coursework_id` int(8) NOT NULL,
  `fees_cat_id` int(6) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student2activity`
--

CREATE TABLE IF NOT EXISTS `student2activity` (
  `id` int(6) NOT NULL,
  `student_id` bigint(20) unsigned NOT NULL,
  `activity_id` int(6) NOT NULL,
  `studentScore` int(4) NOT NULL,
  `academicYear` varchar(10) NOT NULL,
  `term` varchar(20) NOT NULL,
  `date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `studentPerformance`
--

CREATE TABLE IF NOT EXISTS `studentPerformance` (
  `message_id` int(3) NOT NULL,
  `messageName` varchar(10) NOT NULL,
  `emailMsg` text NOT NULL,
  `smsMsg` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tchAttendance`
--

CREATE TABLE IF NOT EXISTS `tchAttendance` (
  `attendance_id` bigint(20) unsigned NOT NULL,
  `teacher_id` bigint(20) unsigned NOT NULL,
  `dateTime` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `teacher_id` bigint(20) unsigned NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `email` varchar(60) NOT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `teacherNumber` varchar(20) NOT NULL,
  `hashedPassword` varchar(65) NOT NULL,
  `recoveryHash` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(60) DEFAULT NULL,
  `state` varchar(60) DEFAULT NULL,
  `bio` text,
  `dateOfbirth` varchar(20) DEFAULT NULL,
  `sex` varchar(6) DEFAULT NULL,
  `schAttended` varchar(255) DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `dateEmployed` datetime DEFAULT NULL,
  `lastLogin` varchar(255) DEFAULT NULL,
  `bankDetails_id` int(6) DEFAULT NULL,
  `salary_id` int(6) DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ThankyouMsg`
--

CREATE TABLE IF NOT EXISTS `ThankyouMsg` (
  `message_id` int(3) NOT NULL,
  `messageName` varchar(10) NOT NULL,
  `emailMsg` text NOT NULL,
  `smsMsg` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `welcomeMsg`
--

CREATE TABLE IF NOT EXISTS `welcomeMsg` (
  `message_id` int(3) NOT NULL,
  `messageName` varchar(10) NOT NULL,
  `emailMsg` text NOT NULL,
  `smsMsg` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `award`
--
ALTER TABLE `award`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bankDetails`
--
ALTER TABLE `bankDetails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `accountNumber` (`accountNumber`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class2teacher`
--
ALTER TABLE `class2teacher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `classInfo`
--
ALTER TABLE `classInfo`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `classPerformance`
--
ALTER TABLE `classPerformance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `courseWork`
--
ALTER TABLE `courseWork`
  ADD PRIMARY KEY (`coursework_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feePayment`
--
ALTER TABLE `feePayment`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `feeReminderMsg`
--
ALTER TABLE `feeReminderMsg`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `feesCategory`
--
ALTER TABLE `feesCategory`
  ADD PRIMARY KEY (`fees_cat_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `feesTransaction`
--
ALTER TABLE `feesTransaction`
  ADD PRIMARY KEY (`transact_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `fees_cat_id` (`fees_cat_id`);

--
-- Indexes for table `fundraiser`
--
ALTER TABLE `fundraiser`
  ADD PRIMARY KEY (`fundraiser_id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lessonNote`
--
ALTER TABLE `lessonNote`
  ADD PRIMARY KEY (`lessonNote_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `photoGallery`
--
ALTER TABLE `photoGallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `projectFunding`
--
ALTER TABLE `projectFunding`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fundraiser_id` (`fundraiser_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `salaryCategory`
--
ALTER TABLE `salaryCategory`
  ADD PRIMARY KEY (`salary_id`);

--
-- Indexes for table `sponsor`
--
ALTER TABLE `sponsor`
  ADD PRIMARY KEY (`sponsor_id`),
  ADD UNIQUE KEY `sponsor_id` (`sponsor_id`);

--
-- Indexes for table `std2courseWork`
--
ALTER TABLE `std2courseWork`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `coursework_id` (`coursework_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `student_id` (`student_id`),
  ADD KEY `sponsor_id` (`sponsor_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `coursework_id` (`coursework_id`),
  ADD KEY `fees_cat_id` (`fees_cat_id`);

--
-- Indexes for table `student2activity`
--
ALTER TABLE `student2activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `activity_id` (`activity_id`);

--
-- Indexes for table `studentPerformance`
--
ALTER TABLE `studentPerformance`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `tchAttendance`
--
ALTER TABLE `tchAttendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD UNIQUE KEY `attendance_id` (`attendance_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`),
  ADD UNIQUE KEY `teacher_id` (`teacher_id`),
  ADD KEY `salary_id` (`salary_id`);

--
-- Indexes for table `ThankyouMsg`
--
ALTER TABLE `ThankyouMsg`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `welcomeMsg`
--
ALTER TABLE `welcomeMsg`
  ADD PRIMARY KEY (`message_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `activity_id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `award`
--
ALTER TABLE `award`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `bankDetails`
--
ALTER TABLE `bankDetails`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `class2teacher`
--
ALTER TABLE `class2teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `classInfo`
--
ALTER TABLE `classInfo`
  MODIFY `class_id` int(6) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `classPerformance`
--
ALTER TABLE `classPerformance`
  MODIFY `id` int(8) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `courseWork`
--
ALTER TABLE `courseWork`
  MODIFY `coursework_id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `exam_id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `feePayment`
--
ALTER TABLE `feePayment`
  MODIFY `message_id` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `feeReminderMsg`
--
ALTER TABLE `feeReminderMsg`
  MODIFY `message_id` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `feesCategory`
--
ALTER TABLE `feesCategory`
  MODIFY `fees_cat_id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `feesTransaction`
--
ALTER TABLE `feesTransaction`
  MODIFY `transact_id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fundraiser`
--
ALTER TABLE `fundraiser`
  MODIFY `fundraiser_id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lessonNote`
--
ALTER TABLE `lessonNote`
  MODIFY `lessonNote_id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `photoGallery`
--
ALTER TABLE `photoGallery`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `projectFunding`
--
ALTER TABLE `projectFunding`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `salaryCategory`
--
ALTER TABLE `salaryCategory`
  MODIFY `salary_id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sponsor`
--
ALTER TABLE `sponsor`
  MODIFY `sponsor_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `std2courseWork`
--
ALTER TABLE `std2courseWork`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `student2activity`
--
ALTER TABLE `student2activity`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `studentPerformance`
--
ALTER TABLE `studentPerformance`
  MODIFY `message_id` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tchAttendance`
--
ALTER TABLE `tchAttendance`
  MODIFY `attendance_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ThankyouMsg`
--
ALTER TABLE `ThankyouMsg`
  MODIFY `message_id` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `welcomeMsg`
--
ALTER TABLE `welcomeMsg`
  MODIFY `message_id` int(3) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bankDetails`
--
ALTER TABLE `bankDetails`
  ADD CONSTRAINT `bankdetails_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`);

--
-- Constraints for table `class2teacher`
--
ALTER TABLE `class2teacher`
  ADD CONSTRAINT `class2teacher_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classInfo` (`class_id`),
  ADD CONSTRAINT `class2teacher_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`);

--
-- Constraints for table `classPerformance`
--
ALTER TABLE `classPerformance`
  ADD CONSTRAINT `classperformance_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classInfo` (`class_id`);

--
-- Constraints for table `courseWork`
--
ALTER TABLE `courseWork`
  ADD CONSTRAINT `coursework_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classInfo` (`class_id`);

--
-- Constraints for table `feesCategory`
--
ALTER TABLE `feesCategory`
  ADD CONSTRAINT `feescategory_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classInfo` (`class_id`);

--
-- Constraints for table `feesTransaction`
--
ALTER TABLE `feesTransaction`
  ADD CONSTRAINT `feestransaction_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `feestransaction_ibfk_2` FOREIGN KEY (`fees_cat_id`) REFERENCES `feesCategory` (`fees_cat_id`);

--
-- Constraints for table `lessonNote`
--
ALTER TABLE `lessonNote`
  ADD CONSTRAINT `lessonnote_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`),
  ADD CONSTRAINT `lessonnote_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`),
  ADD CONSTRAINT `lessonnote_ibfk_3` FOREIGN KEY (`class_id`) REFERENCES `classInfo` (`class_id`);

--
-- Constraints for table `projectFunding`
--
ALTER TABLE `projectFunding`
  ADD CONSTRAINT `projectfunding_ibfk_1` FOREIGN KEY (`fundraiser_id`) REFERENCES `fundraiser` (`fundraiser_id`),
  ADD CONSTRAINT `projectfunding_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`);

--
-- Constraints for table `std2courseWork`
--
ALTER TABLE `std2courseWork`
  ADD CONSTRAINT `std2coursework_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `std2coursework_ibfk_2` FOREIGN KEY (`coursework_id`) REFERENCES `courseWork` (`coursework_id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`sponsor_id`) REFERENCES `sponsor` (`sponsor_id`),
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classInfo` (`class_id`),
  ADD CONSTRAINT `student_ibfk_3` FOREIGN KEY (`coursework_id`) REFERENCES `courseWork` (`coursework_id`),
  ADD CONSTRAINT `student_ibfk_4` FOREIGN KEY (`fees_cat_id`) REFERENCES `feesCategory` (`fees_cat_id`);

--
-- Constraints for table `student2activity`
--
ALTER TABLE `student2activity`
  ADD CONSTRAINT `student2activity_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `student2activity_ibfk_2` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`activity_id`);

--
-- Constraints for table `tchAttendance`
--
ALTER TABLE `tchAttendance`
  ADD CONSTRAINT `tchattendance_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`);

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`salary_id`) REFERENCES `salaryCategory` (`salary_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
