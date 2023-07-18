-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2023 at 03:59 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cesta`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `name`, `quantity`, `price`, `image`) VALUES
(38, 'Blue grapes', 1, 340, 'product-5.png'),
(45, 'potatoes', 10, 90, 'product-19.jpg'),
(46, 'Bio tropical mix flavour Yoghurt', 1, 318, 'product-31.png'),
(47, 'Blue grapes', 1, 340, 'product-5.png'),
(48, 'Blue grapes', 4, 340, 'product-5.png');

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `id` int(11) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `message` longtext NOT NULL,
  `email` text NOT NULL,
  `phone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`id`, `firstname`, `lastname`, `message`, `email`, `phone`) VALUES
(1, '', 'gikunda', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` text NOT NULL,
  `contact` int(11) NOT NULL,
  `shipped` text NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `quantity`, `image`, `contact`, `shipped`) VALUES
(1, 'Blue grapes', 4, 'product-5.png', 2147483647, 'no'),
(2, 'Blue grapes', 4, 'product-5.png', 2147483647, 'no');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `newprice` int(11) NOT NULL,
  `oldprice` int(11) NOT NULL,
  `image` text NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `newprice`, `oldprice`, `image`, `type`) VALUES
(2, 'organic orange', 20, 35, 'product-3.png', 'fruit'),
(3, 'Blue grapes', 340, 410, 'product-5.png', 'fruit'),
(4, 'Royal Red Gala apple', 30, 38, 'product-7.png', 'fruit'),
(5, 'pawpaw', 100, 190, 'product-18.jpg', 'fruit'),
(6, 'organic tomato', 140, 200, 'product-2.png', 'fruit'),
(7, 'natural almonts', 2150, 2250, 'product-6.png', 'fruit'),
(8, 'organic carrot', 210, 250, 'product-9.png', 'vegetable'),
(9, 'dhania/coriander leaves', 20, 30, 'product-10.jpg', 'vegetable'),
(10, 'onions', 50, 80, 'product-11.jpg', 'vegetable'),
(11, 'capsium colored-red', 200, 390, 'product-12.jpg', 'vegetable'),
(12, 'lemon', 31, 50, 'product-13.jpg', 'fruit'),
(13, 'pepper', 10, 25, 'product-14.jpg', 'vegetable'),
(14, 'cabbage', 44, 60, 'product-15.jpg', 'vegetable'),
(15, 'eggs', 120, 189, 'product-16.jpg', 'milk'),
(16, 'garlic', 350, 499, 'product-17.jpg', 'vegetable'),
(17, 'potatoes', 90, 119, 'product-19.jpg', 'vegetable'),
(18, 'natural butter', 330, 450, 'product-8.png', 'milk'),
(19, 'natural cow milk', 75, 80, 'product-4.png', 'milk'),
(20, 'Bio Greek Plain Yoghurt', 154, 201, 'product-20.jpg', 'milk'),
(21, 'Bio tropical mix flavour Yoghurt', 318, 400, 'product-31.png', 'milk'),
(22, 'Bio strawberry flavour Yoghurt', 318, 400, 'product-32.png', 'milk'),
(23, 'Bio berry cocktail flavour Yoghurt', 318, 400, 'product-33.png', 'milk'),
(24, 'Gold crown lactose free milk', 75, 80, 'product-22.jpg', 'milk'),
(25, 'Brookside lactose free milk', 135, 214, 'product-23.jpg', 'milk'),
(26, 'Delia\'s vanilla lactose free ice cream', 840, 860, 'product-27.jpg', 'milk'),
(27, 'Delia\'s salted caramel lactose free ice cream', 840, 860, 'product-28.jpg', 'milk'),
(28, 'delias cookies &cream lactose free ice cream', 840, 860, 'product-30.jpg', 'milk'),
(29, 'similac lactose free baby milk', 1000, 2150, 'product-25.jpg', 'milk'),
(30, 'nan baby powder milk', 1120, 2890, 'product-26.jpg', 'milk');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `contact` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`id`, `username`, `email`, `password`, `contact`) VALUES
(2, 'admin@gmail.com', 'michael@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', '254707667905'),
(3, 'autumn@gmail.com', 'wiral11054@msback.com', '91fb64276c08bb21aded26660f7d81ba92ceea7c', '254707228364'),
(4, 'admin', 'michael@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', '254707667905');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
