-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2023 at 04:55 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lara_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_token_logs`
--

CREATE TABLE `api_token_logs` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `request_id` varchar(100) NOT NULL,
  `token_id` varchar(1000) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `ip` varchar(30) NOT NULL,
  `useragent` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `api_token_logs`
--

INSERT INTO `api_token_logs` (`id`, `user_id`, `request_id`, `token_id`, `created_at`, `updated_at`, `ip`, `useragent`, `is_active`) VALUES
(1, 'ADM000001', 'sdasdsa', 'asdasdasd', '2023-03-26 16:57:27', NULL, '', '', 1),
(2, 'ADM000001', '3aIFRfeLGd', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiQURNMDAwMDAxIiwicm9sZV9pZCI6MSwiZW1haWwiOiJyYXZpLnJrdjk2QGdtYWlsLmNvbSIsImxvZ2dlZF9hdCI6IjIwMjMtMDMtMzAgMDA6MTk6MjcifQ.260LAnSKL6JyH_pnf3sMMKwxSFV_z_Ke9e7-5CGWS3E', '2023-03-30 00:19:27', NULL, '::1', 'PostmanRuntime/7.31.3', 1),
(3, 'ADM000001', 'ZyxjjH8ksb', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiQURNMDAwMDAxIiwicm9sZV9pZCI6MSwiZW1haWwiOiJyYXZpLnJrdjk2QGdtYWlsLmNvbSIsImxvZ2dlZF9hdCI6IjIwMjMtMDMtMzAgMDA6MjA6MDkifQ.tdBXlWBwZVbWwiwXY-iqLGv_yj5t1Xh00S4KvIEEZ9s', '2023-03-30 00:20:09', NULL, '::1', 'PostmanRuntime/7.31.3', 1),
(4, 'ADM000001', 'qoNGrmbZjv', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiQURNMDAwMDAxIiwicm9sZV9pZCI6MSwiZW1haWwiOiJyYXZpLnJrdjk2QGdtYWlsLmNvbSIsImxvZ2dlZF9hdCI6IjIwMjMtMDMtMzAgMDA6MjI6MDMifQ.p53Lu7dlzTCYFxqGQsudSjd0JB5xcIP2HdP4Is6y4t0', '2023-03-30 00:22:03', NULL, '::1', 'PostmanRuntime/7.31.3', 1),
(5, 'ADM000001', 'EmGXot7PrI', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiQURNMDAwMDAxIiwicm9sZV9pZCI6MSwiZW1haWwiOiJyYXZpLnJrdjk2QGdtYWlsLmNvbSIsImxvZ2dlZF9hdCI6IjIwMjMtMDMtMzAgMDA6MjQ6MDEifQ.ivipnBz0skhsSIOrrUsIV2VuDgjrE5IxEWSjI5hr6Lo', '2023-03-30 00:24:01', NULL, '::1', 'PostmanRuntime/7.31.3', 1),
(6, 'ADM000001', 'haIuF0Vhvq', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiQURNMDAwMDAxIiwicm9sZV9pZCI6MSwiZW1haWwiOiJyYXZpLnJrdjk2QGdtYWlsLmNvbSIsImxvZ2dlZF9hdCI6IjIwMjMtMDMtMzAgMDA6MjQ6MTIifQ.6uvE7QfYfN80f9NUrIu3r_6PCpkG5UTfVkT7CUrFqO4', '2023-03-30 00:24:12', NULL, '::1', 'PostmanRuntime/7.31.3', 1),
(7, 'ADM000001', 'jCI8Lo5na2', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiQURNMDAwMDAxIiwicm9sZV9pZCI6MSwiZW1haWwiOiJyYXZpLnJrdjk2QGdtYWlsLmNvbSIsImxvZ2dlZF9hdCI6IjIwMjMtMDMtMzAgMDA6MjQ6NDEifQ.IpIOeGW2yLcUkIllUEkqMpDzKOB0Z2B_iPmkTh4kRmM', '2023-03-30 00:24:41', NULL, '::1', 'PostmanRuntime/7.31.3', 1),
(8, 'ADM000001', 'HemggJf1AD', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiQURNMDAwMDAxIiwicm9sZV9pZCI6MSwiZW1haWwiOiJyYXZpLnJrdjk2QGdtYWlsLmNvbSIsImxvZ2dlZF9hdCI6IjIwMjMtMDMtMzAgMDA6MjQ6NTIifQ.I1ZR-zf_aJw0letw_1QaCf38IgUIGsbGm2e1Aez5RUs', '2023-03-30 00:24:52', NULL, '::1', 'PostmanRuntime/7.31.3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification_associates`
--

CREATE TABLE `notification_associates` (
  `id` bigint(20) NOT NULL,
  `notify_id` bigint(20) NOT NULL,
  `notify_on` enum('SMS','EMAIL','PORTAL') NOT NULL,
  `notify_through` varchar(100) DEFAULT NULL COMMENT 'for SMS - Sendername, for EMail - emailfrom',
  `op1` varchar(500) DEFAULT NULL COMMENT 'for SMS - this is headerid, for Email - this is Subject',
  `op2` varchar(500) DEFAULT NULL COMMENT 'for SMS - this is template id',
  `created_on` datetime NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `notification_associates`
--

INSERT INTO `notification_associates` (`id`, `notify_id`, `notify_on`, `notify_through`, `op1`, `op2`, `created_on`, `created_by`, `updated_on`, `updated_by`, `content`, `is_active`) VALUES
(1, 1, 'SMS', 'DivInfoTech', NULL, NULL, '2020-09-28 00:00:00', 'ADMIN', NULL, NULL, '$OTP$ is the One Time Password  for Login at DivInfo Tech Do not share this with anyone.', 1),
(2, 1, 'EMAIL', 'DivInfoTech', 'One Time Password (OTP) for your account', NULL, '2020-09-28 00:00:00', 'ADMIN', NULL, NULL, '<div style=\"width:580px;margin:0 auto;padding:18px;border:10px solid #00bfff; color:grey; font-size:120%;\">\n <p align=\"center\"><img src=\"$OWNERIMAGE$\" width=\"150px\" title=\"BRANDLOGO\"></p>\n \n Hi,<br />$USER$<br />\n \n The <strong>One Time Password (OTP)</strong> for your account at DivInfo Tech  is <strong>$OTP$</strong>.<br /><br />\n \n Use this OTP to authorise the Login request. If you did not placed this request then you can safely ignore this email.\n </div>\n ', 1),
(3, 2, 'SMS', 'DivInfoTech', NULL, NULL, '2020-09-28 00:00:00', 'ADMIN', NULL, NULL, '$OTP$ is the One Time Password  for Reset Password at Astro With You. Do not share this with anyone.', 1),
(4, 2, 'EMAIL', 'DivInfoTech', 'One Time Password (OTP) for your account', NULL, '2020-09-28 00:00:00', 'ADMIN', NULL, NULL, '<div style=\"width:580px;margin:0 auto;padding:18px;border:10px solid #00bfff; color:grey; font-size:120%;\">\r\n<p align=\"center\"><img src=\"$OWNERIMAGE$\" width=\"150px\" title=\"BRANDLOGO\"></p>\r\n\r\nHi,<br /><br />\r\n\r\nThe <strong>One Time Password (OTP)</strong> for your account at Astro With You is <strong>$OTP$</strong>.<br /><br />\r\n\r\nUse this OTP to authorise the Reset Password request. If you did not placed this request then you can safely ignore this email.\r\n</div>\r\n', 1),
(7, 3, 'EMAIL', 'DivInfoTech', 'Your Account Details - $DOMAINOWNER$', NULL, '2020-09-28 00:00:00', 'ADMIN', NULL, NULL, '<div style=\"width:580px;margin:0 auto;padding:18px;border:10px solid #00bfff; color:grey; font-size:120%;\">\r\n<p align=\"center\"><img src=\"$OWNERIMAGE$\" width=\"150px\" title=\"BRANDLOGO\"></p>\r\n\r\nHello,<br /><br />\r\n\r\nYour account has been created <br /> Please find below the login Credentials.<br /><br />\r\n\r\nUserID: $USERID$ <br />\r\nMobile: $MOBILE$ <br />\r\nPassword: $PASSWORD$ <br /><br />\r\nPlease get in touch with helpdesk in case of any issue.\r\n</div>\r\n', 1),
(8, 3, 'SMS', 'DivInfoTech', NULL, NULL, '2020-09-28 00:00:00', 'ADMIN', NULL, NULL, 'Your $Rolename$ Account UserID - $USERID$, Mobile - $MOBILE$ and Password - $PASSWORD$. Login at $DOMAINURL$', 1),
(9, 4, 'SMS', 'DivInfoTech', NULL, NULL, '2020-09-28 00:00:00', 'ADMIN', NULL, NULL, '$OTP$ is the One Time Password  for Changing Login OTP status at Astro With You . Do not share this with anyone.', 1),
(10, 4, 'EMAIL', 'DivInfoTech', 'One Time Password (OTP) for your account', NULL, '2020-09-28 00:00:00', 'ADMIN', NULL, NULL, '<div style=\"width:580px;margin:0 auto;padding:18px;border:10px solid #00bfff; color:grey; font-size:120%;\">\r\n<p align=\"center\"><img src=\"$OWNERIMAGE$\" width=\"150px\" title=\"BRANDLOGO\"></p>\r\n\r\nHi,<br /><br />\r\n\r\nThe <strong>One Time Password (OTP)</strong> for your account at Astro With You is <strong>$OTP$</strong>.<br /><br />\r\n\r\nUse this OTP for Changing Login OTP status. If you did not placed this request then you can safely ignore this email.\r\n</div>\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification_configs`
--

CREATE TABLE `notification_configs` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `event_code` varchar(15) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `notification_configs`
--

INSERT INTO `notification_configs` (`id`, `name`, `event_code`, `created_on`, `created_by`, `updated_on`, `updated_by`, `is_active`) VALUES
(1, 'Login OTP', 'LGNOTP', '2020-04-17 00:00:00', '0', NULL, NULL, 1),
(2, 'Reset Password OTP', 'RSTPASS', '2020-04-17 00:00:00', '0', NULL, NULL, 1),
(3, 'User Creation', 'USRGRT', '2020-04-17 00:00:00', '0', NULL, NULL, 1),
(4, 'OTP for Login OTP OFF Request', 'OTPOFFREQ', '2020-04-17 00:00:00', '0', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification_email_sms_configs`
--

CREATE TABLE `notification_email_sms_configs` (
  `id` int(11) NOT NULL,
  `config_type` varchar(50) NOT NULL COMMENT 'value=EMAIL or SMS',
  `param1` text NOT NULL COMMENT 'SMS URL or email form emailid',
  `param2` varchar(250) DEFAULT NULL COMMENT 'SMTPHOST',
  `param3` varchar(250) DEFAULT NULL COMMENT 'SMTPUSER',
  `param4` varchar(250) DEFAULT NULL COMMENT 'SMTPPASS',
  `param5` varchar(250) DEFAULT NULL COMMENT 'SMTPPORT',
  `created_at` datetime NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `ip` varchar(60) NOT NULL,
  `useragent` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `notification_email_sms_configs`
--

INSERT INTO `notification_email_sms_configs` (`id`, `config_type`, `param1`, `param2`, `param3`, `param4`, `param5`, `created_at`, `created_by`, `ip`, `useragent`) VALUES
(1, 'EMAIL', 'noreply@gmail.com', 'smtp.gmail.com', 'aaryanrk96@gmail.com', 'qjptjhlxdsoajici', '587', '2022-02-10 00:00:00', 'ADMIN', '0.0.0.0.0', 'agent');

-- --------------------------------------------------------

--
-- Table structure for table `notification_logs`
--

CREATE TABLE `notification_logs` (
  `id` int(11) NOT NULL,
  `notify_id` bigint(20) NOT NULL,
  `notify_assoc_id` bigint(20) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `sent_on` varchar(100) NOT NULL,
  `identifier` varchar(50) DEFAULT NULL COMMENT '6 digit OTP for OTP event',
  `extra_identifier` varchar(50) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_valid` tinyint(1) NOT NULL COMMENT 'used for otp, 1 = otp is valid, can be used for verification, 0 = either otp has expired or has been validated'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `notification_logs`
--

INSERT INTO `notification_logs` (`id`, `notify_id`, `notify_assoc_id`, `user_id`, `sent_on`, `identifier`, `extra_identifier`, `content`, `created_at`, `updated_at`, `is_valid`) VALUES
(1, 1, 2, 'ADM000001', 'admin@gmail.com', '123456', '123456', 'Your OTP is 123456', '2023-03-21 22:55:06', '2023-03-30 00:26:49', 0),
(2, 1, 1, 'ADM000001', '7355988863', '879629', '123456', '879629 is the One Time Password  for Login at DivInfo Tech Do not share this with anyone.', '2023-03-21 18:10:35', '2023-03-30 00:26:49', 0),
(3, 1, 1, 'ADM000001', '7355988863', '971173', '123456', '971173 is the One Time Password  for Login at DivInfo Tech Do not share this with anyone.', '2023-03-22 23:12:21', '2023-03-30 00:26:49', 0),
(4, 1, 2, 'ADM000001', 'ravi.rkv96@gmail.com', '971173', '123456', '<div style=\"width:580px;margin:0 auto;padding:18px;border:10px solid #00bfff; color:grey; font-size:120%;\">\n <p align=\"center\"><img src=\"$OWNERIMAGE$\" width=\"150px\" title=\"BRANDLOGO\"></p>\n \n Hi,<br />Admin<br />\n \n The <strong>One Time Password (OTP)</strong> for your account at DivInfo Tech  is <strong>971173</strong>.<br /><br />\n \n Use this OTP to authorise the Login request. If you did not placed this request then you can safely ignore this email.\n </div>\n ', '2023-03-22 23:12:21', '2023-03-30 00:26:49', 0),
(5, 1, 1, 'ADM000001', '7355988863', '586569', '123456', '586569 is the One Time Password  for Login at DivInfo Tech Do not share this with anyone.', '2023-03-22 23:12:53', '2023-03-30 00:26:49', 0),
(6, 1, 1, 'ADM000001', '7355988863', '205005', '180306379432212023', '205005 is the One Time Password  for Login at DivInfo Tech Do not share this with anyone.', '2023-03-26 18:06:21', '2023-03-30 00:26:49', 0),
(7, 1, 2, 'ADM000001', 'ravi.rkv96@gmail.com', '205005', '180306379432212023', '<div style=\"width:580px;margin:0 auto;padding:18px;border:10px solid #00bfff; color:grey; font-size:120%;\">\n <p align=\"center\"><img src=\"$OWNERIMAGE$\" width=\"150px\" title=\"BRANDLOGO\"></p>\n \n Hi,<br />Admin<br />\n \n The <strong>One Time Password (OTP)</strong> for your account at DivInfo Tech  is <strong>205005</strong>.<br /><br />\n \n Use this OTP to authorise the Login request. If you did not placed this request then you can safely ignore this email.\n </div>\n ', '2023-03-26 18:06:21', '2023-03-30 00:26:49', 0),
(8, 1, 1, 'ADM000001', '7355988863', '672750', '200358493343502023', '672750 is the One Time Password  for Login at DivInfo Tech Do not share this with anyone.', '2023-03-26 20:58:50', '2023-03-30 00:26:49', 0),
(9, 1, 2, 'ADM000001', 'ravi.rkv96@gmail.com', '1234', '200358493343502023', '<div style=\"width:580px;margin:0 auto;padding:18px;border:10px solid #00bfff; color:grey; font-size:120%;\">\n <p align=\"center\"><img src=\"$OWNERIMAGE$\" width=\"150px\" title=\"BRANDLOGO\"></p>\n \n Hi,<br />Admin<br />\n \n The <strong>One Time Password (OTP)</strong> for your account at DivInfo Tech  is <strong>672750</strong>.<br /><br />\n \n Use this OTP to authorise the Login request. If you did not placed this request then you can safely ignore this email.\n </div>\n ', '2023-03-26 20:58:50', '2023-03-30 00:26:49', 0),
(10, 1, 1, 'ADM000001', '7355988863', '657715', '220350326382392023', '657715 is the One Time Password  for Login at DivInfo Tech Do not share this with anyone.', '2023-03-28 22:50:39', '2023-03-30 00:26:49', 0),
(11, 1, 2, 'ADM000001', 'ravi.rkv96@gmail.com', '657715', '220350326382392023', '<div style=\"width:580px;margin:0 auto;padding:18px;border:10px solid #00bfff; color:grey; font-size:120%;\">\n <p align=\"center\"><img src=\"$OWNERIMAGE$\" width=\"150px\" title=\"BRANDLOGO\"></p>\n \n Hi,<br />Admin<br />\n \n The <strong>One Time Password (OTP)</strong> for your account at DivInfo Tech  is <strong>657715</strong>.<br /><br />\n \n Use this OTP to authorise the Login request. If you did not placed this request then you can safely ignore this email.\n </div>\n ', '2023-03-28 22:50:39', '2023-03-30 00:26:49', 0),
(12, 1, 1, 'ADM000001', '7355988863', '630512', '000326859336152023', '630512 is the One Time Password  for Login at DivInfo Tech Do not share this with anyone.', '2023-03-30 00:26:15', NULL, 1),
(13, 1, 2, 'ADM000001', 'ravi.rkv96@gmail.com', '630512', '000326859336152023', '<div style=\"width:580px;margin:0 auto;padding:18px;border:10px solid #00bfff; color:grey; font-size:120%;\">\n <p align=\"center\"><img src=\"$OWNERIMAGE$\" width=\"150px\" title=\"BRANDLOGO\"></p>\n \n Hi,<br />Admin<br />\n \n The <strong>One Time Password (OTP)</strong> for your account at DivInfo Tech  is <strong>630512</strong>.<br /><br />\n \n Use this OTP to authorise the Login request. If you did not placed this request then you can safely ignore this email.\n </div>\n ', '2023-03-30 00:26:15', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `role_desc` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `role_desc`, `is_active`) VALUES
(1, 'Admin', 'Administrator', 1),
(2, 'User', 'Normal User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `pincode` varchar(6) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `profile_pic` varchar(150) NOT NULL,
  `role_id` int(11) NOT NULL,
  `twofa_configid` int(3) NOT NULL,
  `twofa_status` tinyint(1) NOT NULL,
  `status` enum('ACTIVE','INACTIVE','PENDING') NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `first_name`, `last_name`, `email`, `mobile`, `dob`, `city`, `state`, `address`, `pincode`, `password`, `profile_pic`, `role_id`, `twofa_configid`, `twofa_status`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'ADM000001', 'Admin', 'Admin', 'ravi.rkv96@gmail.com', '7355988863', '1996-06-19', 'Delhi', 'Delhi', 'Rajiv Chauk , New Delhi', '110020', 'e10adc3949ba59abbe56e057f20f883e', '', 1, 1, 0, 'ACTIVE', '2023-01-30 18:44:28', 'ADM000001', '2023-01-30 18:44:28', ''),
(2, 'USR000001', 'USER', 'USER', 'user@gmail.com', '7355988863', '1996-06-19', 'Delhi', 'Delhi', 'Rajiv Chauk , New Delhi', '110020', 'e10adc3949ba59abbe56e057f20f883e', '', 2, 1, 1, 'ACTIVE', '2023-01-30 18:44:28', 'ADM000001', '2023-01-30 18:44:28', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_token_logs`
--
ALTER TABLE `api_token_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notification_associates`
--
ALTER TABLE `notification_associates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notify_on` (`notify_on`),
  ADD KEY `notify_id` (`notify_id`),
  ADD KEY `is_active` (`is_active`),
  ADD KEY `created_on` (`created_on`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `notification_configs`
--
ALTER TABLE `notification_configs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `notify_code` (`event_code`),
  ADD KEY `created_on` (`created_on`),
  ADD KEY `is_active` (`is_active`);

--
-- Indexes for table `notification_email_sms_configs`
--
ALTER TABLE `notification_email_sms_configs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `config_type` (`config_type`);

--
-- Indexes for table `notification_logs`
--
ALTER TABLE `notification_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `identifier` (`identifier`),
  ADD KEY `notif_sent_on` (`sent_on`),
  ADD KEY `noti_asso_id` (`notify_assoc_id`),
  ADD KEY `notify_id` (`notify_id`),
  ADD KEY `is_valid` (`is_valid`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api_token_logs`
--
ALTER TABLE `api_token_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notification_associates`
--
ALTER TABLE `notification_associates`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `notification_configs`
--
ALTER TABLE `notification_configs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253780000016;

--
-- AUTO_INCREMENT for table `notification_email_sms_configs`
--
ALTER TABLE `notification_email_sms_configs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notification_logs`
--
ALTER TABLE `notification_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
