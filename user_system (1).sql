-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:5306
-- Generation Time: Jan 07, 2025 at 03:48 PM
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
-- Database: `user_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `type` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `content`, `image`, `created_at`, `updated_at`, `type`, `category`) VALUES
(1, 'Mastering HTML & CSS', 'Dive into the world of web design with our comprehensive HTML & CSS course. Learn to create stunning websites from scratch and master responsive design techniques!\r\n\r\n', 'uploads/671fdda6c55a6_webdevlopmentcourses.png', '2024-10-28 18:53:26', '2024-10-28 19:13:38', NULL, NULL),
(2, 'JavaScript Essentials for Beginners', ' Unlock the power of JavaScript! This course is perfect for beginners, teaching you how to create interactive web applications. Join us and start coding today!\r\n\r\n', 'uploads/671fe17c56a01_Web-Development1.png', '2024-10-28 19:09:48', '2024-10-28 19:13:43', NULL, NULL),
(3, 'Full Stack Course ', 'Full stack course 6 months course .. in it clear all about  basic to advanced .', 'uploads/6720734e95632_online course social media template.png', '2024-10-29 05:31:58', '2024-10-29 06:09:54', NULL, NULL),
(4, 'Here is a new combo ', 'Responsive  Website Design , Mobile Application Development , E-commerce , Design ', 'uploads/672f311203381_add1.jpg', '2024-11-09 09:53:22', '2024-11-26 10:54:35', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`id`, `name`, `course_name`, `created_at`) VALUES
(1, 'Yash Sangram Bandgar ', 'Graphic Design Course', '2024-11-27 15:13:48'),
(2, 'Srushti Rakesh Awati ', 'Brand Building Course', '2024-11-27 16:49:27'),
(4, 'Avishkar Ashok Kesarkar', 'Reactjs Course', '2024-11-28 08:39:16'),
(5, 'Utkarsh Ananda Patil', 'Digital Marketing Course', '2024-11-28 08:39:57'),
(6, 'Deepak Datattray Budake ', 'Mern Stack Course', '2024-11-28 08:41:34'),
(7, 'Prathmesh Pradip Patil', 'Laravel-PHP Framework Course', '2024-11-28 08:42:39'),
(8, 'Rutuja Jaganath Madane', 'Advance Java Course', '2024-11-28 08:43:25'),
(9, 'Akash Namdev Patil', 'Advanced JavaScript Course', '2024-11-28 08:44:35'),
(10, 'Akash Namdev Patil', 'Advanced JavaScript Course', '2024-11-28 08:44:36'),
(11, 'Ankita Mahesh Jadhav', 'Core Java Course', '2024-11-28 08:45:02'),
(12, 'Gokul Ganesh ', 'MERN STACK DEVELOPER ', '2024-11-30 07:34:19');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `services` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `first_name`, `last_name`, `email`, `phone`, `services`, `message`, `created_at`) VALUES
(1, 'Yash ', 'Bandgar', 'yashbandgar5560@gmail.com', '8432725050', 'Other', 'you provide course about Internet of things (IOT) ....', '2024-11-27 17:23:13'),
(2, 'Srushti ', 'Awati', 'awatisrushti3004@gmail.com', '9370619878', 'Other', 'I learn about AWS ... so please provide information of this on your webiste ,,,', '2024-11-27 17:29:17'),
(3, 'Snehal', 'Patil', 'patilsnehal9090@gmail.com', '8956237845', 'Other', 'please available  springboot course ....... ', '2024-11-28 07:50:03'),
(4, 'Akash ', 'Singh', 'akashs3434@gmail.com', '7845128956', 'Other', 'i want the learn  full stack in python ... please available course ', '2024-11-28 07:51:27'),
(86, '', '', '', '', '', '', '2024-11-27 17:12:27'),
(89, '', '', '', '', '', '', '2024-11-27 17:12:27'),
(90, '', '', '', '', '', '', '2024-11-27 17:12:27'),
(91, '', '', '', '', '', '', '2024-11-27 17:12:27'),
(92, '', '', '', '', '', '', '2024-11-27 17:12:27'),
(93, '', '', '', '', '', '', '2024-11-27 17:12:27'),
(94, '', '', '', '', '', '', '2024-11-27 17:12:27'),
(95, '', '', '', '', '', '', '2024-11-27 17:12:27'),
(96, '', '', '', '', '', '', '2024-11-27 17:12:27'),
(97, '', '', '', '', '', '', '2024-11-27 17:12:27'),
(98, '', '', '', '', '', '', '2024-11-27 17:12:27'),
(100, '', '', '', '', '', '', '2024-11-27 17:12:27'),
(101, '', '', '', '', '', '', '2024-11-27 17:12:32'),
(102, '', '', '', '', '', '', '2024-11-27 17:12:32'),
(103, '', '', '', '', '', '', '2024-11-27 17:12:32'),
(104, '', '', '', '', '', '', '2024-11-27 17:12:32'),
(105, '', '', '', '', '', '', '2024-11-27 17:12:32'),
(106, '', '', '', '', '', '', '2024-11-27 17:12:32'),
(107, '', '', '', '', '', '', '2024-11-27 17:12:32'),
(108, '', '', '', '', '', '', '2024-11-27 17:12:32'),
(109, '', '', '', '', '', '', '2024-11-27 17:12:32'),
(110, '', '', '', '', '', '', '2024-11-27 17:12:32'),
(111, '', '', '', '', '', '', '2024-11-27 17:12:32'),
(112, '', '', '', '', '', '', '2024-11-27 17:12:32'),
(113, '', '', '', '', '', '', '2024-11-27 17:12:32'),
(114, '', '', '', '', '', '', '2024-11-27 17:12:33'),
(115, '', '', '', '', '', '', '2024-11-27 17:12:33'),
(116, '', '', '', '', '', '', '2024-11-27 17:12:33'),
(117, '', '', '', '', '', '', '2024-11-27 17:12:33'),
(118, '', '', '', '', '', '', '2024-11-27 17:12:33'),
(119, '', '', '', '', '', '', '2024-11-27 17:12:33'),
(120, '', '', '', '', '', '', '2024-11-27 17:12:33'),
(121, '', '', '', '', '', '', '2024-11-27 17:13:09'),
(122, '', '', '', '', '', '', '2024-11-27 17:13:09'),
(123, '', '', '', '', '', '', '2024-11-27 17:13:09'),
(124, '', '', '', '', '', '', '2024-11-27 17:13:09'),
(125, '', '', '', '', '', '', '2024-11-27 17:13:09'),
(126, '', '', '', '', '', '', '2024-11-27 17:13:09'),
(127, '', '', '', '', '', '', '2024-11-27 17:13:09'),
(128, '', '', '', '', '', '', '2024-11-27 17:13:09'),
(129, '', '', '', '', '', '', '2024-11-27 17:13:09'),
(130, '', '', '', '', '', '', '2024-11-27 17:13:09'),
(131, '', '', '', '', '', '', '2024-11-27 17:13:09'),
(132, '', '', '', '', '', '', '2024-11-27 17:13:09'),
(133, '', '', '', '', '', '', '2024-11-27 17:13:10'),
(134, '', '', '', '', '', '', '2024-11-27 17:13:10'),
(135, '', '', '', '', '', '', '2024-11-27 17:13:10'),
(136, '', '', '', '', '', '', '2024-11-27 17:13:10'),
(137, '', '', '', '', '', '', '2024-11-27 17:13:10'),
(138, '', '', '', '', '', '', '2024-11-27 17:13:10'),
(139, '', '', '', '', '', '', '2024-11-27 17:13:10'),
(140, '', '', '', '', '', '', '2024-11-27 17:13:10'),
(141, '', '', '', '', '', '', '2024-11-27 17:13:11'),
(142, '', '', '', '', '', '', '2024-11-27 17:13:11'),
(143, '', '', '', '', '', '', '2024-11-27 17:13:11'),
(144, '', '', '', '', '', '', '2024-11-27 17:13:11'),
(145, '', '', '', '', '', '', '2024-11-27 17:13:11'),
(146, '', '', '', '', '', '', '2024-11-27 17:13:11'),
(147, '', '', '', '', '', '', '2024-11-27 17:13:11'),
(148, '', '', '', '', '', '', '2024-11-27 17:13:11'),
(149, '', '', '', '', '', '', '2024-11-27 17:13:11'),
(150, '', '', '', '', '', '', '2024-11-27 17:13:11'),
(151, '', '', '', '', '', '', '2024-11-27 17:13:11'),
(152, '', '', '', '', '', '', '2024-11-27 17:13:11'),
(153, '', '', '', '', '', '', '2024-11-27 17:13:11'),
(154, '', '', '', '', '', '', '2024-11-27 17:13:11'),
(155, '', '', '', '', '', '', '2024-11-27 17:13:11'),
(156, '', '', '', '', '', '', '2024-11-27 17:13:11'),
(157, '', '', '', '', '', '', '2024-11-27 17:13:11'),
(158, '', '', '', '', '', '', '2024-11-27 17:13:11'),
(159, '', '', '', '', '', '', '2024-11-27 17:13:11'),
(160, '', '', '', '', '', '', '2024-11-27 17:13:11'),
(161, '', '', '', '', '', '', '2024-11-27 17:13:16'),
(162, '', '', '', '', '', '', '2024-11-27 17:13:16'),
(163, '', '', '', '', '', '', '2024-11-27 17:13:16'),
(164, '', '', '', '', '', '', '2024-11-27 17:13:16'),
(165, '', '', '', '', '', '', '2024-11-27 17:13:16'),
(166, '', '', '', '', '', '', '2024-11-27 17:13:16'),
(167, '', '', '', '', '', '', '2024-11-27 17:13:16'),
(168, '', '', '', '', '', '', '2024-11-27 17:13:16'),
(169, '', '', '', '', '', '', '2024-11-27 17:13:16'),
(170, '', '', '', '', '', '', '2024-11-27 17:13:16'),
(171, '', '', '', '', '', '', '2024-11-27 17:13:16'),
(172, '', '', '', '', '', '', '2024-11-27 17:13:16'),
(173, '', '', '', '', '', '', '2024-11-27 17:13:16'),
(174, '', '', '', '', '', '', '2024-11-27 17:13:16'),
(175, '', '', '', '', '', '', '2024-11-27 17:13:16'),
(176, '', '', '', '', '', '', '2024-11-27 17:13:16'),
(177, '', '', '', '', '', '', '2024-11-27 17:13:16'),
(178, '', '', '', '', '', '', '2024-11-27 17:13:16'),
(179, '', '', '', '', '', '', '2024-11-27 17:13:16'),
(180, '', '', '', '', '', '', '2024-11-27 17:13:16'),
(181, '', '', '', '', '', '', '2024-11-27 17:14:37'),
(182, '', '', '', '', '', '', '2024-11-27 17:14:37'),
(183, '', '', '', '', '', '', '2024-11-27 17:14:37'),
(184, '', '', '', '', '', '', '2024-11-27 17:14:37'),
(185, '', '', '', '', '', '', '2024-11-27 17:14:37'),
(186, '', '', '', '', '', '', '2024-11-27 17:14:37'),
(187, '', '', '', '', '', '', '2024-11-27 17:14:37'),
(188, '', '', '', '', '', '', '2024-11-27 17:14:37'),
(189, '', '', '', '', '', '', '2024-11-27 17:14:37'),
(190, '', '', '', '', '', '', '2024-11-27 17:14:37'),
(191, '', '', '', '', '', '', '2024-11-27 17:14:37'),
(192, '', '', '', '', '', '', '2024-11-27 17:14:37'),
(193, '', '', '', '', '', '', '2024-11-27 17:14:37'),
(194, '', '', '', '', '', '', '2024-11-27 17:14:37'),
(195, '', '', '', '', '', '', '2024-11-27 17:14:37'),
(196, '', '', '', '', '', '', '2024-11-27 17:14:37'),
(197, '', '', '', '', '', '', '2024-11-27 17:14:37'),
(198, '', '', '', '', '', '', '2024-11-27 17:14:38'),
(199, '', '', '', '', '', '', '2024-11-27 17:14:38'),
(200, '', '', '', '', '', '', '2024-11-27 17:14:38'),
(201, '', '', '', '', '', '', '2024-11-27 17:15:08'),
(202, '', '', '', '', '', '', '2024-11-27 17:15:08'),
(203, '', '', '', '', '', '', '2024-11-27 17:15:08'),
(204, '', '', '', '', '', '', '2024-11-27 17:15:08'),
(205, '', '', '', '', '', '', '2024-11-27 17:15:08'),
(206, '', '', '', '', '', '', '2024-11-27 17:15:08'),
(207, '', '', '', '', '', '', '2024-11-27 17:15:08'),
(208, '', '', '', '', '', '', '2024-11-27 17:15:08'),
(209, '', '', '', '', '', '', '2024-11-27 17:15:08'),
(210, '', '', '', '', '', '', '2024-11-27 17:15:08'),
(211, '', '', '', '', '', '', '2024-11-27 17:15:08'),
(212, '', '', '', '', '', '', '2024-11-27 17:15:08'),
(213, '', '', '', '', '', '', '2024-11-27 17:15:08'),
(214, '', '', '', '', '', '', '2024-11-27 17:15:08'),
(215, '', '', '', '', '', '', '2024-11-27 17:15:08'),
(216, '', '', '', '', '', '', '2024-11-27 17:15:08'),
(217, '', '', '', '', '', '', '2024-11-27 17:15:08'),
(218, '', '', '', '', '', '', '2024-11-27 17:15:08'),
(219, '', '', '', '', '', '', '2024-11-27 17:15:08'),
(220, '', '', '', '', '', '', '2024-11-27 17:15:08'),
(221, '', '', '', '', '', '', '2024-11-27 17:16:08'),
(222, '', '', '', '', '', '', '2024-11-27 17:16:08'),
(223, '', '', '', '', '', '', '2024-11-27 17:16:08'),
(224, '', '', '', '', '', '', '2024-11-27 17:16:08'),
(225, '', '', '', '', '', '', '2024-11-27 17:16:08'),
(226, '', '', '', '', '', '', '2024-11-27 17:16:08'),
(227, '', '', '', '', '', '', '2024-11-27 17:16:08'),
(228, '', '', '', '', '', '', '2024-11-27 17:16:08'),
(229, '', '', '', '', '', '', '2024-11-27 17:16:08'),
(230, '', '', '', '', '', '', '2024-11-27 17:16:08'),
(231, '', '', '', '', '', '', '2024-11-27 17:16:08'),
(232, '', '', '', '', '', '', '2024-11-27 17:16:08'),
(233, '', '', '', '', '', '', '2024-11-27 17:16:08'),
(234, '', '', '', '', '', '', '2024-11-27 17:16:08'),
(235, '', '', '', '', '', '', '2024-11-27 17:16:08'),
(236, '', '', '', '', '', '', '2024-11-27 17:16:08'),
(237, '', '', '', '', '', '', '2024-11-27 17:16:08'),
(238, '', '', '', '', '', '', '2024-11-27 17:16:08'),
(239, '', '', '', '', '', '', '2024-11-27 17:16:08'),
(240, '', '', '', '', '', '', '2024-11-27 17:16:08');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `content`, `image`, `created_at`) VALUES
(1, 'UI / UX Design', 'Our expert designers craft captivating user interfaces and seamless user experiences, ensuring your digital products are both visually appealing and highly functional.', 'uploads/67207d6025386_UIUX.png', '2024-10-29 06:14:56'),
(3, 'Graphics Design', 'From logos to marketing materials, our graphic design team creates visually stunning assets that elevate your brand and capture your audiences attentio', 'uploads/672080ab4e244_GraphicDesign.png', '2024-10-29 06:28:59'),
(4, '3D Design', 'We bring ideas to life with cutting-edge 3D modeling and animation, perfect for product visualization, architectural renderings and immersive experiences.', 'uploads/672082ed64bf1_3D Design.png', '2024-10-29 06:38:37'),
(5, 'Game Design', 'Our game designers combine creativity with technical expertise to develop engaging, innovative games across various platforms and genres.', 'uploads/67208318998e5_Game.Design.png', '2024-10-29 06:39:20'),
(6, 'Static & Dynamic Website', 'We create both static websites for simplicity and speed and dynamic websites for interactive, data-driven experiences, tailored to your specific needs', 'uploads/67208338573e9_Dynamic website.png', '2024-10-29 06:39:52'),
(7, 'ERP / CRM Development', 'Our custom ERP and CRM solutions streamline your business processes, improve customer relationships and boost overall operational efficiency.', 'uploads/6720834ed137b_ERPCRM Development.png', '2024-10-29 06:40:14'),
(8, 'E-Com Website', 'We build robust, user-friendly e-commerce platforms that provide seamless shopping experiences and help grow your online business.', 'uploads/67208375839f4_E-Com Website.png', '2024-10-29 06:40:53'),
(9, 'Mobile application', 'Our team develops intuitive, high-performance mobile apps for iOS and Android, helping you reach and engage your audience on the go.', 'uploads/6720838ee14cb_Mobile application..png', '2024-10-29 06:41:18'),
(11, 'Website Hosting', 'We offer reliable, secure and scalable hosting solutions to ensure your website remains fast, accessible and protected at all times.', 'uploads/6745f32c536f3_WebisteHosting.jpg', '2024-11-26 16:11:24'),
(12, 'Domain Registration & Management', 'Secure your online identity with our domain registration and management services, including renewals, transfers and DNS management.', 'uploads/6745f39155774_Domain.jpg', '2024-11-26 16:13:05'),
(13, 'Dedicated Server Hosting', 'Our dedicated server hosting provides powerful, customizable and secure infrastructure for high-traffic websites and resource-intensive applications.', 'uploads/6745f3ddc13aa_Dedicatedserver.jpg', '2024-11-26 16:14:21'),
(14, 'Website Maintenance & Support', 'Keep your website running smoothly with our comprehensive maintenance and support services, including updates, backups and technical assistance.\r\n\r\n', 'uploads/6745f40c92830_Maintenance.jpg', '2024-11-26 16:15:08'),
(15, 'SEO & Digital Marketing', 'Boost your online visibility and drive targeted traffic with our SEO and digital marketing strategies, tailored to your business goals.', 'uploads/6745f4460f1e8_SEO.jpg', '2024-11-26 16:16:06'),
(16, 'Social Media Management', 'We help you build and maintain a strong social media presence, engaging your audience and growing your brand across various platforms.', 'uploads/6745f478b3ece_Social.jpg', '2024-11-26 16:16:56'),
(17, 'Brand Evolution', 'Transform and elevate your brand with our strategic brand evolution services, ensuring your identity remains relevant and impactful in a changing market.', 'uploads/6745f4ae0432d_Brand.jpg', '2024-11-26 16:17:50'),
(18, 'Content Marketing', 'Our content marketing strategies help you create and distribute valuable, relevant content to attract and retain a clearly defined audience.', 'uploads/6745f4e166391_ContentMarketing.jpg', '2024-11-26 16:18:41');

-- --------------------------------------------------------

--
-- Table structure for table `custom_courses`
--

CREATE TABLE `custom_courses` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `desired_course` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `custom_courses`
--

INSERT INTO `custom_courses` (`id`, `username`, `email`, `desired_course`, `description`, `created_at`) VALUES
(1, 'Yash Bandgar ', 'yashbandgar5560@gmail.com', 'Reactjs ', 'i want a Reactjs course. i will learn about this course', '2024-10-30 06:43:19'),
(2, 'Srushti Awati', 'awatisrushti3004@gmail.com', 'ReactJs ', 'ReactJs is Booming technology now .. i will learn about it .. so you provide in your website .', '2024-11-26 11:01:38'),
(3, 'Swarup Palange', 'swaruppalange01@gmail.com', 'AngularJs ', 'i want to learn about Frontend and Backend of this technology .. ', '2024-11-26 11:03:32'),
(4, 'Vikas singh', 'vikassingh45@gmail.com', 'CyberSecurity', 'To secure data and systems from cyber threats', '2024-11-26 13:56:47'),
(5, 'Sneha Patil', 'patilsneha6798@gmail.com', 'AWS', 'I want to get information for AWS to my project so you available this course .. ', '2024-11-26 13:58:13'),
(6, 'Vikas singh', 'vikassingh45@gmail.com', 'CyberSecurity', 'To secure data and systems from cyber threats', '2024-11-26 14:03:03');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `status` enum('current','completed') DEFAULT 'current',
  `enrollment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`id`, `user_id`, `course_id`, `status`, `enrollment_date`) VALUES
(1, 4, 7, 'completed', '2024-10-30 05:45:32'),
(2, 4, 3, 'completed', '2024-10-30 05:45:57'),
(3, 4, 6, 'current', '2024-10-30 05:46:43'),
(4, 6, 1, 'completed', '2024-10-31 07:05:31'),
(5, 6, 6, 'completed', '2024-10-31 07:05:36'),
(6, 6, 4, 'completed', '2024-11-02 04:54:54'),
(7, 8, 1, 'completed', '2024-11-04 13:10:23'),
(8, 8, 9, 'current', '2024-11-04 13:10:36'),
(9, 9, 3, 'completed', '2024-11-09 10:28:54'),
(10, 9, 5, 'current', '2024-11-09 10:29:15'),
(11, 6, 7, 'completed', '2024-11-09 10:37:47'),
(12, 6, 9, 'current', '2024-11-26 14:41:23');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `feedback` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `contact`, `email`, `feedback`, `created_at`) VALUES
(1, 'Srushti Awati', '9789568569', 'awatisrushti3004@gmail.com', 'Very Excellent Website .. very useful website.', '2024-11-06 09:14:53'),
(2, 'Yash Bandgar', '8432725050', 'yashbandgar5560@gmail.com', 'Your courses are very helpful....', '2024-11-06 10:33:32'),
(3, 'Avishkar Kesarkar ', '7845128956', 'aviak2611@gmail.com', 'its amzing website for learning leading course in industries.', '2024-11-06 10:36:55'),
(4, 'Debra Washington', '9451264765', 'jennifer28@yahoo.com', ' Research official ball clearly its catch western. Out factor military someone. One chair like green girl consider garden meeting. Shoulder suffer current bag life.', '2024-11-07 07:53:54'),
(5, 'Ram Patil', '9876543210', 'ramp123@gmail.com', 'Very informative and easy to understand. Learned a lot!', '2024-11-07 07:56:50'),
(6, 'Siya Dhingra', '7895643870', 'siya345@gmail.com', 'Great course, helped me improve my app development skills.', '2024-11-07 07:57:52'),
(7, 'tanu chavan', '7845125689', 'tanuc5510@gmail.com', 'In-depth tutorials, but the pace could be a bit faster.', '2024-11-07 08:01:27'),
(8, 'yash rathod', '9874563210', 'yashrathod9876@gmail.com', 'i like the all the courses ', '2024-11-07 08:05:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_picture` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `profile_picture`, `birthday`) VALUES
(1, 'yashbandgar0430', 'yashbandgar5560@gmail.com', '$2y$10$1262ATYMpwKeZuQoS3OlGusMR3b.kbM8FEbjjQVIfpGn.HEKzQgpG', '2024-10-28 14:28:00', NULL, NULL),
(2, 'rutu', 'rutu@gmail.com', '$2y$10$eX18OYZr6h7YnD7RFZ8dvebH3YpX9Oh1QcXfEC/8KJ36V7vAEzCAm', '2024-10-29 05:07:47', NULL, NULL),
(4, 'Aviak2611', 'avikesarkar2611@gmail.com', '$2y$10$uL9O9FSaV9zn8hO9w8UJaOdbpnSiUrlCQNfmfE3GDW3l8u3jB9nq6', '2024-10-29 18:55:27', './uploads/profile_pictures/profile_67213c0e68c002.50566931-avi1.png', '2001-11-26'),
(6, 'Srush3004', 'awatisrushti3004@gmail.com', '$2y$10$NCW2dvTeRtXjSZH03hKQjOBWgOC94yqsBNv33gAFvTv2.YA0oGFju', '2024-10-31 07:05:04', './uploads/profile_pictures/profile_672f3b6bd9eb29.86605432-Screenshot_2024-10-31-12-29-43-60_254de13a4bc8758c9908fff1f73e3725.jpg', '2001-07-30'),
(7, 'JohnDoe			', 'johndoe@gmail.com', '$2y$10$1sPg.BCLKD9GXvKyLIC85uNoXrKaOBBEInz8F9ZF7KI9l6dD31052', '2024-11-02 06:44:39', 'uploads/profileicon2.png', '1995-07-19'),
(8, 'AB895', 'anubhavb895@gmail.com', '$2y$10$D02Nw2tlj8ngjhSmTW4cC.8/GVPeDKNbaVZzf98w/yKm04CLbc0J.', '2024-11-04 13:09:31', 'uploads/image.png', '2002-06-20'),
(9, 'Snehal2002', 'snehalbagadi2002@gmail.com', '$2y$10$4OBABxnBhXc1Jm/uYAQ10usczs.IIW3OgxPQVwiPbnY9GkIUzx1dm', '2024-11-09 10:28:20', NULL, '2002-03-01'),
(10, 'akshay0707', 'akshaypatil26@gmail.com', '$2y$10$LZ1/tHLWoxa7nmxmiE.6Ce12u0gCvEGWHmNGftz1CEVHk1PpRqGlu', '2024-11-26 09:39:21', 'uploads/profilelogo.png', '2004-07-07'),
(11, 'avadhut012', 'avadhut@gmail.com', '$2y$10$.R8QEzMn84sMfDdvPPcwO.HXbt8OOQW2xp55wlGyY4Vh4SmpPcrpm', '2024-11-28 07:59:51', 'uploads/profilelogo.png', '2002-05-12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_courses`
--
ALTER TABLE `custom_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `custom_courses`
--
ALTER TABLE `custom_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `enrollments_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
