-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 17, 2023 at 09:34 PM
-- Server version: 8.0.25
-- PHP Version: 8.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `21_bogacz`
--

-- --------------------------------------------------------

--
-- Table structure for table `niezlekwiatki_categories`
--

CREATE TABLE `niezlekwiatki_categories` (
  `category_id` int NOT NULL,
  `category_name` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  `category_desc` text COLLATE utf8_polish_ci NOT NULL,
  `last_updated_when` datetime NOT NULL,
  `last_updated_by` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  `number_of_posts` int NOT NULL,
  `last_updated_name` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  `last_updated_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `niezlekwiatki_categories`
--

INSERT INTO `niezlekwiatki_categories` (`category_id`, `category_name`, `category_desc`, `last_updated_when`, `last_updated_by`, `number_of_posts`, `last_updated_name`, `last_updated_id`) VALUES
(1, 'Uprawa', 'tematy dotyczące uprawy roślin', '2023-01-17 21:31:21', 'miloszek', 1, 'Hello world!', 14),
(2, 'Gatunki', 'tematy dedykowane konkretnym gatunkom roślin', '0000-00-00 00:00:00', '0', 0, '', 0),
(3, 'Zastosowania', 'tematy dotyczące zastosowań medycznych i nie tylko', '0000-00-00 00:00:00', '0', 0, '', 0),
(4, 'Kompendium', 'wyczerpujące opracowania danych kwestii', '0000-00-00 00:00:00', '0', 0, '', 0),
(5, 'Ciekawostki', 'off-top', '0000-00-00 00:00:00', '0', 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `niezlekwiatki_posts`
--

CREATE TABLE `niezlekwiatki_posts` (
  `post_id` int NOT NULL,
  `category_id` int NOT NULL,
  `topic_id` int NOT NULL,
  `post_creator` varchar(32) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `post_date` datetime DEFAULT NULL,
  `post_content` text CHARACTER SET utf8 COLLATE utf8_polish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `niezlekwiatki_posts`
--

INSERT INTO `niezlekwiatki_posts` (`post_id`, `category_id`, `topic_id`, `post_creator`, `post_date`, `post_content`) VALUES
(27, 1, 14, '1', '2023-01-17 21:31:15', 'hello world!            '),
(28, 1, 14, '1', '2023-01-17 21:31:21', 'hello world!');

-- --------------------------------------------------------

--
-- Table structure for table `niezlekwiatki_topics`
--

CREATE TABLE `niezlekwiatki_topics` (
  `topic_id` int NOT NULL,
  `category_id` int NOT NULL,
  `topic_title` varchar(128) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `last_reply_date` datetime NOT NULL,
  `last_replier` varchar(20) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `topic_views` int DEFAULT '0',
  `topic_replies` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `niezlekwiatki_topics`
--

INSERT INTO `niezlekwiatki_topics` (`topic_id`, `category_id`, `topic_title`, `last_reply_date`, `last_replier`, `topic_views`, `topic_replies`) VALUES
(14, 1, 'Hello world!', '2023-01-17 21:31:21', 'miloszek', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `niezlekwiatki_users`
--

CREATE TABLE `niezlekwiatki_users` (
  `user_id` int NOT NULL,
  `username` varchar(32) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `pronouns` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `niezlekwiatki_users_credits`
--

CREATE TABLE `niezlekwiatki_users_credits` (
  `user_id` int NOT NULL,
  `username` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `account_creation_date` date NOT NULL,
  `total_posts` int DEFAULT '0',
  `pronouns` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `profile_picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
--
-- Indexes for dumped tables
--

--
-- Indexes for table `niezlekwiatki_categories`
--
ALTER TABLE `niezlekwiatki_categories`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `last_updated_id` (`last_updated_id`);

--
-- Indexes for table `niezlekwiatki_posts`
--
ALTER TABLE `niezlekwiatki_posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `topic_id` (`topic_id`),
  ADD KEY `post_creator` (`post_creator`);

--
-- Indexes for table `niezlekwiatki_topics`
--
ALTER TABLE `niezlekwiatki_topics`
  ADD PRIMARY KEY (`topic_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `niezlekwiatki_users`
--
ALTER TABLE `niezlekwiatki_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `niezlekwiatki_users_credits`
--
ALTER TABLE `niezlekwiatki_users_credits`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `niezlekwiatki_categories`
--
ALTER TABLE `niezlekwiatki_categories`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `niezlekwiatki_posts`
--
ALTER TABLE `niezlekwiatki_posts`
  MODIFY `post_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `niezlekwiatki_topics`
--
ALTER TABLE `niezlekwiatki_topics`
  MODIFY `topic_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `niezlekwiatki_users`
--
ALTER TABLE `niezlekwiatki_users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `niezlekwiatki_categories`
--
ALTER TABLE `niezlekwiatki_categories`
  ADD CONSTRAINT `niezlekwiatki_categories_ibfk_1` FOREIGN KEY (`last_updated_id`) REFERENCES `niezlekwiatki_topics` (`topic_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
