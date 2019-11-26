-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 26, 2019 at 08:04 AM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms-blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'HTML'),
(3, 'Javascript'),
(4, 'PHP'),
(5, 'Angular'),
(6, 'React'),
(8, 'Laravel');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_user` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `comment_status` varchar(20) NOT NULL DEFAULT 'unapproved',
  `comment_date` date NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_user`, `comment`, `comment_status`, `comment_date`, `post_id`) VALUES
(5, 'mtn', 'Thsdfsdf', 'unapproved', '2019-11-20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `post_title` varchar(100) NOT NULL,
  `post_image` varchar(100) NOT NULL,
  `post_date` date NOT NULL,
  `post_body` text NOT NULL,
  `post_author` varchar(100) DEFAULT NULL,
  `post_status` varchar(20) NOT NULL DEFAULT 'draft'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `category_id`, `post_title`, `post_image`, `post_date`, `post_body`, `post_author`, `post_status`) VALUES
(1, 1, 'Post One', 'placeholder-900x300.png', '2019-11-13', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Autem id natus fuga nulla quaerat adipisci, at hic laborum nostrum est unde dicta, perferendis enim consequatur eligendi, ipsa architecto totam possimus?\r\n\r\nLorem ipsum, dolor sit amet consectetur adipisicing elit. Autem id natus fuga nulla quaerat adipisci, at hic laborum nostrum est unde dicta, perferendis enim consequatur eligendi, ipsa architecto totam possimus?\r\n\r\nLorem ipsum, dolor sit amet consectetur adipisicing elit. Autem id natus fuga nulla quaerat adipisci, at hic laborum nostrum est unde dicta, perferendis enim consequatur eligendi, ipsa architecto totam possimus?', 'rico', 'draft'),
(2, 6, 'Post Two', 'placeholder-900x300.png', '2019-11-14', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Autem id natus fuga nulla quaerat adipisci, at hic laborum nostrum est unde dicta, perferendis enim consequatur eligendi, ipsa architecto totam possimus?\r\n\r\nLorem ipsum, dolor sit amet consectetur adipisicing elit. Autem id natus fuga nulla quaerat adipisci, at hic laborum nostrum est unde dicta, perferendis enim consequatur eligendi, ipsa architecto totam possimus?\r\n\r\nLorem ipsum, dolor sit amet consectetur adipisicing elit. Autem id natus fuga nulla quaerat adipisci, at hic laborum nostrum est unde dicta, perferendis enim consequatur eligendi, ipsa architecto totam possimus?', 'swave', 'draft'),
(3, 4, 'Post Three', 'placeholder-900x300.png', '2019-11-14', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Facilis enim error nam expedita eos nulla reprehenderit. Eius ipsam a nihil in repellendus culpa. Fuga ut ea, repellendus dolorem nesciunt dignissimos.\r\n\r\nLorem ipsum, dolor sit amet consectetur adipisicing elit. Facilis enim error nam expedita eos nulla reprehenderit. Eius ipsam a nihil in repellendus culpa. Fuga ut ea, repellendus dolorem nesciunt dignissimos.\r\n\r\nLorem ipsum, dolor sit amet consectetur adipisicing elit. Facilis enim error nam expedita eos nulla reprehenderit. Eius ipsam a nihil in repellendus culpa. Fuga ut ea, repellendus dolorem nesciunt dignissimos.', 'mtn', 'draft'),
(4, 5, 'Post Four', 'placeholder-900x300.png', '2019-11-14', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Facilis enim error nam expedita eos nulla reprehenderit. Eius ipsam a nihil in repellendus culpa. Fuga ut ea, repellendus dolorem nesciunt dignissimos.\r\n\r\nLorem ipsum, dolor sit amet consectetur adipisicing elit. Facilis enim error nam expedita eos nulla reprehenderit. Eius ipsam a nihil in repellendus culpa. Fuga ut ea, repellendus dolorem nesciunt dignissimos.\r\n\r\nLorem ipsum, dolor sit amet consectetur adipisicing elit. Facilis enim error nam expedita eos nulla reprehenderit. Eius ipsam a nihil in repellendus culpa. Fuga ut ea, repellendus dolorem nesciunt dignissimos.', 'nwh', 'draft'),
(6, 3, 'Post Six', '5dd24a84ea9ab-itone-logo.png', '2019-11-18', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Autem id natus fuga nulla quaerat adipisci, at hic laborum nostrum est unde dicta, perferendis enim consequatur eligendi, ipsa architecto totam possimus?\r\n\r\nLorem ipsum, dolor sit amet consectetur adipisicing elit. Autem id natus fuga nulla quaerat adipisci, at hic laborum nostrum est unde dicta, perferendis enim consequatur eligendi, ipsa architecto totam possimus?\r\n\r\nLorem ipsum, dolor sit amet consectetur adipisicing elit. Autem id natus fuga nulla quaerat adipisci, at hic laborum nostrum est unde dicta, perferendis enim consequatur eligendi, ipsa architecto totam possimus?', 'mtn', 'published'),
(7, 4, 'Using Array', '5dd24e6a4ade7-Screenshot from 2019-08-19 15-12-32.png', '2019-11-18', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Autem id natus fuga nulla quaerat adipisci, at hic laborum nostrum est unde dicta, perferendis enim consequatur eligendi, ipsa architecto totam possimus?\r\n\r\nLorem ipsum, dolor sit amet consectetur adipisicing elit. Autem id natus fuga nulla quaerat adipisci, at hic laborum nostrum est unde dicta, perferendis enim consequatur eligendi, ipsa architecto totam possimus?\r\n\r\nLorem ipsum, dolor sit amet consectetur adipisicing elit. Autem id natus fuga nulla quaerat adipisci, at hic laborum nostrum est unde dicta, perferendis enim consequatur eligendi, ipsa architecto totam possimus?', 'nwh', 'published'),
(8, 4, 'Variable', '5dd24e7fb8a70-Screenshot from 2019-08-19 16-11-26.png', '2019-11-18', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Autem id natus fuga nulla quaerat adipisci, at hic laborum nostrum est unde dicta, perferendis enim consequatur eligendi, ipsa architecto totam possimus?\r\n\r\nLorem ipsum, dolor sit amet consectetur adipisicing elit. Autem id natus fuga nulla quaerat adipisci, at hic laborum nostrum est unde dicta, perferendis enim consequatur eligendi, ipsa architecto totam possimus?\r\n\r\nLorem ipsum, dolor sit amet consectetur adipisicing elit. Autem id natus fuga nulla quaerat adipisci, at hic laborum nostrum est unde dicta, perferendis enim consequatur eligendi, ipsa architecto totam possimus?', 'mtn', 'draft');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_role` varchar(50) NOT NULL DEFAULT 'subscriber'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `user_role`) VALUES
(1, 'mtn', '$2y$12$c5LBG1Abc.RAwLlv99soM.bb.iP.pjppS2NHmpoIXKATLyzxXzzZ2', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
