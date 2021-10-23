-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2021 at 08:50 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proj_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(75) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `slug`, `description`, `image`) VALUES
(1, 'Inspiration', 'inspiration', 'During these times of the Covid-19 pandemic, it is sometimes hard to find something that inspires us. Explore what other people feel inspired about in these blog posts where you can comment and share your ideas about these posts by other users', 'inspiration.png'),
(2, 'Advice', 'advice', 'In times of Covid-19 it is important to share with others some advices from personal experience of how to cope with the new style of life that the pandemic has imposed over us. In this category, find posts that will advise you on what actions to take about Covid-19 so that you can improve your lifestyle.', 'advice.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `authorId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `summary` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `likesCount` int(11) NOT NULL DEFAULT 0,
  `dislikesCount` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `authorId`, `categoryId`, `title`, `slug`, `summary`, `content`, `published`, `image`, `createdAt`, `likesCount`, `dislikesCount`) VALUES
(1, 3, 1, 'Welcome to the Inspiration category', 'welcome-to-the-inspiration-category', 'Welcome post to the Inspiration category of Peace of Mind', 'Welcome to all the users of Peace of Mind, this is the Inspiration category. Here you will find content that will inspire you into new activities, thoughts, insights. We are very grateful that you visit our blog and we hope that you can share your thoughts on the comment section as well as letting us know if you liked or disliked the post.', 1, 'welcome.jpg', '2021-10-16 02:44:57', 0, 0),
(2, 2, 2, 'Welcome to the Advice category', 'welcome-to-the-advice-category', 'Welcome post for the Advice category.', 'Welcome to all the users of the Peace of Mind blog, this is the Advice category, where users will share their advice. Please post your comments about this category here.', 1, 'advice.png', '2021-10-10 03:22:35', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `post_comment`
--

CREATE TABLE `post_comment` (
  `commentId` int(11) NOT NULL,
  `postId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `content` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post_comment`
--

INSERT INTO `post_comment` (`commentId`, `postId`, `userId`, `content`, `createdAt`) VALUES
(1, 1, 3, 'This is a comment example for the Welcome to the Inspiration Category blog post.', '2021-10-16 04:23:07'),
(2, 1, 2, 'Hello, thank you for sharing your post, I find inspiration to be an interesting topic.', '2021-10-16 04:24:53'),
(3, 2, 3, 'Please feel free to share your thoughts on the advice post category, I would really appreciate some feedback!', '2021-10-16 04:37:56'),
(4, 1, 1, 'Hello, I\'m glad to have an inspiration category in this blog.', '2021-10-16 16:53:15'),
(5, 1, 2, 'Trying new comment', '2021-10-16 19:22:32'),
(6, 1, 2, 'This new comment feature is awesome!', '2021-10-16 19:24:18'),
(7, 2, 2, 'Thank you for creating this new Advice category, I like it!', '2021-10-16 20:00:57');

-- --------------------------------------------------------

--
-- Table structure for table `post_likes_dislikes`
--

CREATE TABLE `post_likes_dislikes` (
  `postId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `isLiked` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pwdreset`
--

CREATE TABLE `pwdreset` (
  `pwdResetId` int(11) NOT NULL,
  `pwdResetEmail` text NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` longtext NOT NULL,
  `pwdResetExpires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pwdreset`
--

INSERT INTO `pwdreset` (`pwdResetId`, `pwdResetEmail`, `pwdResetSelector`, `pwdResetToken`, `pwdResetExpires`) VALUES
(3, 'bart@gmail.com', '677b397f3d6778d5', '$2y$10$9LzLy3.ewAXsB6NatkF4D.9JvpwKaxeCQVBPuCjiRVQ9/0fBY065.', '1631497385');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `usersId` int(11) NOT NULL,
  `usersFirst` varchar(128) NOT NULL,
  `usersLast` varchar(128) NOT NULL,
  `usersEmail` varchar(128) NOT NULL,
  `usersName` varchar(128) NOT NULL,
  `usersPwd` varchar(128) NOT NULL,
  `usersImg` varchar(255) DEFAULT NULL,
  `usersBio` text DEFAULT NULL,
  `usersAdmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usersId`, `usersFirst`, `usersLast`, `usersEmail`, `usersName`, `usersPwd`, `usersImg`, `usersBio`, `usersAdmin`) VALUES
(1, 'john', 'doe', 'john@hotmail.com', 'johndoe', '$2y$10$XPy3DY5ZhaZk9QGqALG1netRgd1q8usJeQSbsAQH.rwqUiqIGPOku', NULL, NULL, 0),
(2, 'Bart', 'Simpson', 'bart@gmail.com', 'bart', '$2y$10$qRMLMB80DyL9g/Vv7R/.Yeup/dFN8l1fyflpoOKenSOILr74Yolsa', 'assets/profile-img/profile_bart.png', 'new bio', 1),
(3, 'Mauricio E', 'Rodriguez', 'mauricioretanaiii@gmail.com', 'Mauricio', '$2y$10$SNu.3bMAdwqTcNJ9EUBHTe6o0GFocPPlCUa6vL8V7bKaLiFlxRF02', 'assets/profile-img/profile_Mauricio.jpeg', 'hello Im Mauricio, welcome to my profile', 1),
(4, 'homer', 'simpson', 'homer@gmail.com', 'homer', '$2y$10$UgwhtRtf.mkcRZVnqaSNsOk59u7x1LaSUeE37oVpJsudT5Uw4HI52', NULL, 'My name is Homer and this is my biography for my profile page', 0),
(5, 'jane', 'doe', 'janedoe@gmail.com', 'jane', '$2y$10$CEDJr6wcSVSnaKoYLt1ZjOT1ic5SYENbTPQITm//dxwJqPJSHDa3i', 'assets/profile-img/profile_jane.png', 'hello this is jane doe and im testing this functionality', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `authorId` (`authorId`),
  ADD KEY `post_ibfk_2` (`categoryId`);

--
-- Indexes for table `post_comment`
--
ALTER TABLE `post_comment`
  ADD PRIMARY KEY (`commentId`),
  ADD KEY `postId` (`postId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `post_likes_dislikes`
--
ALTER TABLE `post_likes_dislikes`
  ADD PRIMARY KEY (`postId`,`userId`),
  ADD KEY `post_likes_dislikes_ibfk_1` (`userId`);

--
-- Indexes for table `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`pwdResetId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usersId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post_comment`
--
ALTER TABLE `post_comment`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `pwdResetId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`authorId`) REFERENCES `users` (`usersId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`categoryId`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `post_comment`
--
ALTER TABLE `post_comment`
  ADD CONSTRAINT `post_comment_ibfk_1` FOREIGN KEY (`postId`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `post_comment_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`usersId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `post_likes_dislikes`
--
ALTER TABLE `post_likes_dislikes`
  ADD CONSTRAINT `post_likes_dislikes_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`usersId`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `post_likes_dislikes_ibfk_2` FOREIGN KEY (`postId`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
