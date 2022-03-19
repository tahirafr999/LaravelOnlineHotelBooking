-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2021 at 02:52 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finalyearproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_author` varchar(255) NOT NULL,
  `add_to_cart_user_id` int(11) NOT NULL,
  `product_category` int(11) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(47, 'shoes'),
(48, 'shirts'),
(49, 'perfume'),
(50, 'pants'),
(51, 'chairs');

-- --------------------------------------------------------

--
-- Table structure for table `checkout_details`
--

CREATE TABLE `checkout_details` (
  `order_id` int(11) NOT NULL,
  `pay_mode` varchar(255) NOT NULL,
  `buyer_name` varchar(255) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `product_gtotal` int(11) NOT NULL,
  `user_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checkout_details`
--

INSERT INTO `checkout_details` (`order_id`, `pay_mode`, `buyer_name`, `buyer_id`, `product_gtotal`, `user_address`) VALUES
(19, '', 'tahir afridi', 72, 211, 'peshawar pakistan'),
(20, '', 'tahir afridi', 72, 300, 'peshawar pakistan'),
(21, '', 'Ds', 73, 200, 'peshawar pakistan'),
(22, '', 'tahir afridi', 72, 11, 'peshawar pakistan');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `product_posted_by_id` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `post_category_id` int(11) NOT NULL,
  `post_description` varchar(255) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_view_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `author`, `product_posted_by_id`, `photo`, `category`, `post_category_id`, `post_description`, `product_price`, `product_quantity`, `product_view_count`) VALUES
(235, 'afridi', 'zarbad shah', 0, 'home 1.png', '48', 48, '<p>dsdsadsdfgdgtdgfdgdfgddfgddfgdfd</p>', '11', 0, 6),
(236, 'name', 'zarbad shah', 0, 'home 1.png', '48', 48, '<p>dsdsadsdfgdgtdgfdgdfgddfgddfgdfd</p>', '100', 0, 16),
(237, 'tahir', 'tahir', 0, 'home 1.png', '48', 48, '<p>dsdsadsdfgdgtdgfdgdfgddfgddfgdfd</p>', '200', 0, 7),
(238, 'ewrrwewewe', 'errewewew', 0, 'download (2).jpg', '47', 47, '<p>werftwewewewewewewewewewewe</p>', '1200', 0, 0),
(239, 'its a testing product', 'tahir afridi', 0, 'download (1).jpg', '48', 48, '<p>rgrtfgrtfgrtfg tr</p>', '200', 0, 8),
(240, 'rerrererere', 'sdsdssdsddssdsds', 0, 'Screenshot (68).png', '47', 47, '<p>gfgfgfgfgffgfgfgfgfg</p>', '4000', 0, 0),
(241, 'tesssss', '', 0, 'images (1).jpg', '48', 48, '<p>wqswassasaasasaaaaaaaasaaaaaaaaaaaaa</p>', '400', 0, 0),
(242, 'xcxcdsc', 'tahir afridi', 72, '84fa7d9f0c6095532c7bafc008be14e5.jpg', '48', 48, '<p>ef dfdfertefrfgrtrt</p>', '2500', 0, 0),
(243, 'ds post', 'Ds', 73, 'big-img-03.jpg', '47', 47, '<p>asdasdadad</p>', '200', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `post_tags`
--

CREATE TABLE `post_tags` (
  `id` int(11) NOT NULL,
  `tag_name` varchar(255) NOT NULL,
  `users_id` int(11) NOT NULL,
  `post_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post_tags`
--

INSERT INTO `post_tags` (`id`, `tag_name`, `users_id`, `post_id`) VALUES
(119, 'shirts', 72, '239'),
(120, 'shoes', 72, '240'),
(121, 'shirts', 72, '240'),
(122, 'perfume', 72, '240'),
(123, 'perfume', 72, '241'),
(124, 'pants', 72, '241'),
(125, 'shirts', 72, '242'),
(126, 'pants', 72, '242'),
(127, 'shoes', 73, '243'),
(128, 'perfume', 73, '243');

-- --------------------------------------------------------

--
-- Table structure for table `register_users`
--

CREATE TABLE `register_users` (
  `id` int(11) NOT NULL,
  `name_of_user` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cpassword` varchar(255) NOT NULL,
  `verify_token` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `verify_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `register_users`
--

INSERT INTO `register_users` (`id`, `name_of_user`, `email`, `username`, `user_role`, `password`, `cpassword`, `verify_token`, `user_image`, `verify_status`) VALUES
(72, 'tahir afridi', 'tahirafridi999@gmail.com', 'tahirafridi', 'admin', '123', ' 123', '701128fce1574d4a9917d6f7accf338a', 'about 2.png', 1),
(73, 'Ds', 'tahirafridi0900@gmail.com', 'Dsoffice', 'admin', '123', ' 123', '4291160d6325462b74ed428721c052e4', 'home 1.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_roll` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `user_email`, `user_image`, `user_password`, `user_roll`) VALUES
(2, 'tahir', 'afridi', 'tahirafridi', 'tahirafridi999@gmail.com', 'about 3.png', '123', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `checkout_details`
--
ALTER TABLE `checkout_details`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_tags`
--
ALTER TABLE `post_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register_users`
--
ALTER TABLE `register_users`
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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=359;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `checkout_details`
--
ALTER TABLE `checkout_details`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT for table `post_tags`
--
ALTER TABLE `post_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `register_users`
--
ALTER TABLE `register_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
